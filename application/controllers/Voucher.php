<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseControllerWeb.php';

class Voucher extends BaseControllerWeb
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('language', array('controller' => $this->router->class));
		$this->isLoggedIn();
	}

	public function index(){
		$this->global['pageTitle'] = 'TIQS: Vouchers List';
		$vendorId = $this->session->userdata('userId');
        $data['vendorId'] = $vendorId;
		$this->load->model('shopproduct_model');
		$this->load->model('email_templates_model');
		$data['emails'] = $this->email_templates_model->get_voucher_email_by_user($vendorId);
		
		$data['templateName'] = '';

		$join = [
			0 => [
				'tbl_shop_products_extended',
				'tbl_shop_products_extended.productId = tbl_shop_products.id',
				'left',
			],
			1 => [
				'tbl_shop_categories',
				'tbl_shop_categories.id = tbl_shop_products.categoryId',
				'left',
			]
		];
		$what = ['tbl_shop_products.id' ,'tbl_shop_products_extended.name'];
		$where = [
			 "userId" => $vendorId,
			 "tbl_shop_products_extended.name<>" => null
			];
			
		$data['products'] = $this->shopproduct_model->read($what,$where, $join, 'group_by', ['tbl_shop_products.id']);
		$this->loadViews("voucher/index", $this->global, $data, 'footerbusiness', 'headerbusiness'); 
	}

	public function send(){
		$this->global['pageTitle'] = 'TIQS: Voucher Send';
		$vendorId = $this->session->userdata('userId');
        $data['vendorId'] = $vendorId;
		$this->load->model('shopvoucher_model');
		$this->load->model('email_templates_model');
		
		$what = ['*'];
		$where = ["vendorId" => $vendorId, "active" => '1'];
        $data['vouchers'] = $this->shopvoucher_model->read($what,$where, [], "where", ["voucherused < numberOfTimes"]);
		$this->loadViews("voucher/send", $this->global, $data, 'footerbusiness', 'headerbusiness'); 
	}

	public function create(){
		$this->global['pageTitle'] = 'TIQS: Create Vouchers';
		$vendorId = $this->session->userdata('userId');
        $data['vendorId'] = $vendorId;
		$this->load->model('shopproduct_model');
		$join = [
			0 => [
				'tbl_shop_products_extended',
				'tbl_shop_products_extended.productId = tbl_shop_products.id',
				'left',
			],
			1 => [
				'tbl_shop_categories',
				'tbl_shop_categories.id = tbl_shop_products.categoryId',
				'left',
			]
		];
		$what = ['tbl_shop_products.id' ,'tbl_shop_products_extended.name'];
		$where = [
			 "userId" => $vendorId,
			 "tbl_shop_products_extended.name<>" => null
			];
			
		$data['products'] = $this->shopproduct_model->read($what,$where, $join, 'group_by', ['tbl_shop_products.id']);
		$this->loadViews("voucher/create", $this->global, $data, 'footerbusiness', 'headerbusiness'); 
	}

	public function listTemplates(): void
    {
        $vendorId = $this->session->userdata('userId');
		$this->load->model('email_templates_model');

        $data = [
            'templates' => $this->email_templates_model->get_voucher_email_by_user($vendorId),
            'updateTemplate' => base_url() . 'voucher/update_template' . DIRECTORY_SEPARATOR,
        ];

        $this->global['pageTitle'] = 'TIQS : LIST TEMPLATE';
        $this->loadViews('voucher/templates/listTemplates', $this->global, $data, 'footerbusiness', 'headerbusiness');
        return;
    }

	public function updateTemplate($id): void
    {
        $data = [
            'vendorId' => intval($_SESSION['userId']),
            'tiqsId' => $this->config->item('tiqsId'),
        ];
		$this->setEmailTemplateUpdate($data, intval($id));

		$this->global['pageTitle'] = 'TIQS : UPDATE TEMPLATE';
        $this->loadViews('voucher/templates/updateTemplate', $this->global, $data, 'footerbusiness', 'headerbusiness');
        return;
    }

	public function translate_lang(){
		$text = $this->input->post('text');
		echo $this->language->tline($text);
	}

	private function setEmailTemplateUpdate(array &$data, int $id): void
    {
		$this->load->model('shoptemplates_model');
        $this->shoptemplates_model->setObjectId($id)->setObject();
        // to check id
        $data['emailTemplates'] = $this->config->item('emailTemplates');
        $data['templateId'] = $id;
        $data['templateName'] = $this->shoptemplates_model->template_name;
        $data['templateSubject'] = $this->shoptemplates_model->template_subject;
        $data['templateType'] = $this->shoptemplates_model->template_type;
        $data['templateContent'] = file_get_contents($this->shoptemplates_model->getTemplateFile());
        $data['emailTemplatesEdit'] = true;
        $data['landingPagesEdit'] = false;

        return;
    }

}