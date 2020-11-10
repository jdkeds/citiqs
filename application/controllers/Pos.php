<?php
    declare(strict_types=1);

    if (!defined('BASEPATH')) exit('No direct script access allowed');

    require APPPATH . '/libraries/BaseControllerWeb.php';

    class Pos extends BaseControllerWeb
    {

        public function __construct()
        {
            parent::__construct();

            $this->load->helper('url');
            $this->load->helper('validate_data_helper');
            $this->load->helper('utility_helper');
            $this->load->helper('country_helper');
            $this->load->helper('date');
            $this->load->helper('jwt_helper');

            $this->load->model('user_subscription_model');
            $this->load->model('shopcategory_model');
            $this->load->model('shopproduct_model');
            $this->load->model('shopproductex_model');
            $this->load->model('shoporder_model');
            $this->load->model('shoporderex_model');
            $this->load->model('user_model');
            $this->load->model('shopspot_model');
            $this->load->model('shopvendor_model');
            $this->load->model('shopvisitorreservtaion_model');
            $this->load->model('shopvendortime_model');
            $this->load->model('shopspottime_model');
            $this->load->model('shopvoucher_model');
            $this->load->model('shopsession_model');

            $this->load->config('custom');

            $this->load->library('language', array('controller' => $this->router->class));
            $this->load->library('session');

            $this->isLoggedIn();
        }

        public function index(): void
        {
            $vendorId = intval($_SESSION['userId']);

            $spotId = $_GET['spotid'] ? intval($this->input->get('spotid', true)) : 0;
            if (!$spotId) redirect('pos_spots');

            $spot = $spotId ? $this->shopspot_model->fetchSpot($vendorId, $spotId) : [];
            if (!$spot || ! $this->isLocalSpotOpen($spot)) redirect('pos_spots');

            $allProducts = $spot ? $this->shopproductex_model->getMainProductsOnBuyerSide($vendorId, $spot) : null;
            if (!$allProducts) redirect('pos_spots');


            $data = [
                'mainProducts' => $allProducts['main'],
                'addons' => $allProducts['addons'],
                'maxRemarkLength' => $this->config->item('maxRemarkLength'),
                'categories' => array_keys($allProducts['main'])
            ];

            // echo '<pre>';
            // print_r($data);
            // die();
            $this->global['pageTitle'] = 'TIQS : POS';
            $this->loadViews('pos/pos', $this->global, $data, null, 'headerWarehouse');
            return;
        }

        public function selectPosPost(): void
        {
            var_dump($_SERVER);
            return;
        }

        private function isLocalSpotOpen(array $spot): bool
        {
            $spotTypeId = intval($spot['spotTypeId']);
            $spotId = intval($spot['spotId']);

            if ($spotTypeId === $this->config->item('local') && !$this->shopspottime_model->setProperty('spotId', $spotId)->isOpen() ) {
                return false;;
            }
            return true;
        }

    }
