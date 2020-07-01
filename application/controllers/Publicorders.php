<?php
    declare(strict_types=1);

    if (!defined('BASEPATH')) exit('No direct script access allowed');

    require APPPATH . '/libraries/BaseControllerWeb.php';
    
    class Publicorders extends BaseControllerWeb
    {
        public function __construct()
        {
            parent::__construct();

            $this->load->helper('url');
            $this->load->helper('form');
            $this->load->helper('validate_data_helper');
            $this->load->helper('utility_helper');
            $this->load->helper('country_helper');
            

            $this->load->model('user_subscription_model');
            $this->load->model('shopcategory_model');
            $this->load->model('shopproduct_model');
            $this->load->model('shopproductex_model');
            $this->load->model('shoporder_model');
            $this->load->model('shoporderex_model');
            $this->load->model('user_model');
            $this->load->model('shopspot_model');

            $this->load->library('language', array('controller' => $this->router->class));
            $this->load->config('custom');
        }

        public function index(): void
        {
            if(!isset($_GET['vendorid'])) {
                redirect(base_url());
            }

            // SAVE VENODR DATA IN SESSION
            $_SESSION['vendor'] = $this->user_model->getUserInfo($_GET['vendorid']);
            if (!$_SESSION['vendor']) {
                redirect(base_url());
            }

            if (isset($_GET['spotid']) && is_numeric($_GET['spotid'])) {

                $this->loadSpotView();
                return;
            }

            if (isset($_GET['vendorid']) && is_numeric($_GET['vendorid'])) {
                $this->loadVendorView();
                return;
            }            
        }

        private function loadSpotView(): void
        {
            $this->global['pageTitle'] = 'TIQS : ORDERING';
            $spotId = intval($_GET['spotid']);
            $userId = intval($_SESSION['vendor']->userId);

            $data = [
                'categoryProducts' => $this->shopproductex_model->getUserLastProductsDetailsPublic($spotId, $userId, 'category'),
                'spotId' => $spotId,
            ];

            if (isset($_SESSION['order'])) {
                $data['ordered'] = $_SESSION['order'];
            }

            $this->loadViews('publicorders/makeOrder', $this->global, $data, null, 'headerWarehousePublic');
            return;
        }

        private function loadVendorView(): void
        {
            $this->global['pageTitle'] = 'TIQS : SELECT SPOT';
            $userId = intval($_SESSION['vendor']->userId);

            $data = [
                'vendor' => $_SESSION['vendor'],
                'spots' => $this->shopspot_model->fetchUserSpots($userId)
            ];

            $this->loadViews('publicorders/selectSpot', $this->global, $data, null, 'headerWarehousePublic');
            return;
        }

        public function checkout_order(): void
        {
            $this->global['pageTitle'] = 'TIQS : CHECKOUT';

            if (empty($_POST) && !isset($_SESSION['order'])) {
                redirect('make_order');
            }

            $post = $this->input->post(null, true);

            if (!empty($post)) {
                $_SESSION['spotId'] = $post['spotId'];
                unset($post['spotId']);
                $_SESSION['order'] = $post;
            }

            $data = [
                'spotId' => $_SESSION['spotId'],
                'orderDetails' => $_SESSION['order'],
                'buyerRole' => $this->config->item('buyer'),
                'usershorturl' => 'tiqs_shop_service',
                'salesagent' => $this->config->item('tiqsId'),
                'countries' => Country_helper::getCountries()
            ];

            $this->loadViews('publicorders/checkoutOrder', $this->global, $data, null, 'headerWarehousePublic');
        }

        public function submitOrder(): void
        {
            if (empty($_POST) && !isset($_SESSION['order'])) {
                redirect('make_order');
            }

            $post = $this->input->post(null, true);
            $makeOrderRedirect = 'make_order?spotid=' . $post['order']['spotId'];

            $this->user_model->manageAndSetBuyer($post['user']);

            if (!$this->user_model->id) {
                $this->session->set_flashdata('error', 'Order not made! Please try again');
                redirect($makeOrderRedirect);
                exit();
            }

            // insert order
            $post['order']['buyerId'] = $this->user_model->id;
            $post['order']['paid'] = '0';

            $this->shoporder_model->setObjectFromArray($post['order'])->create();            
            
            if (!$this->shoporder_model->id) {
                $this->session->set_flashdata('error', 'Order not made! Please try again');
                redirect($makeOrderRedirect);
                exit();
            }

            // insert order details
            foreach ($post['orderExtended'] as $id => $details) {
                $details['productsExtendedId'] = intval($id);
                $details['orderId'] = $this->shoporder_model->id;
                if (!$this->shoporderex_model->setObjectFromArray($details)->create()) {
                    $this->shoporderex_model->orderId = $details['orderId'];
                    $this->shoporderex_model->deleteOrderDetails();
                    $this->shoporder_model->delete();
                    $this->session->set_flashdata('error', 'Order not made! Please try again');
                    redirect($makeOrderRedirect);
                    exit();
                }
            }

            // go to paying if everything OK
            $_SESSION['orderId'] = $this->shoporder_model->id;

            redirect('pay_order');
        }

        public function pay_order(): void
        {
            if (!isset($_SESSION['order'])) {
                redirect('make_order');
            }

            $this->global['pageTitle'] = 'TIQS : PAY';

            $data = [
                'ordered' => $_SESSION['order'],
            ];

            $this->loadViews('publicorders/payOrder', $this->global, $data, null, 'headerWarehousePublic');
        }

        public function paymentEngine(): void
        {
            if (!isset($_SESSION['order'])) {
                redirect('make_order');
            }

            var_dump($_SESSION['order']);

            var_dump($this->shoporder_model->setObjectId($_SESSION['orderId'])->fetchOne());
        }
    }

