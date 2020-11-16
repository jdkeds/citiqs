<?php
declare(strict_types=1);

ini_set('memory_limit', '256M');

if(!defined('BASEPATH')) exit('No direct script access allowed');

class Ajaxdorian extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('label_model');
        $this->load->model('user_model');
        $this->load->model('appointment_model');
        $this->load->model('uniquecode_model');
        $this->load->model('user_subscription_model');
        $this->load->model('dhl_model');
        $this->load->model('Bizdir_model');
        $this->load->model('floorplanareas_model');
        $this->load->model('floorplandetails_model');
        $this->load->model('shoporder_model');
        $this->load->model('shopspot_model');
        $this->load->model('shopcategory_model');
        $this->load->model('shopspotproduct_model');
        $this->load->model('shopproductex_model');
        $this->load->model('shopvendor_model');
        $this->load->model('shopvoucher_model');
        $this->load->model('shopsession_model');
        $this->load->model('email_templates_model');

        $this->load->helper('cookie');
        $this->load->helper('validation_helper');
        $this->load->helper('utility_helper');
        $this->load->helper('email_helper');
        $this->load->helper('google_helper');
        $this->load->helper('perfex_helper');
        $this->load->helper('curl_helper');
        $this->load->helper('dhl_helper');
        $this->load->helper('validate_data_helper');

        

        $this->load->library('session');
        $this->load->library('language', array('controller' => $this->router->class));
        $this->load->library('form_validation');

        $this->load->config('custom');
    }

    
    public function getPlaceByLocation(){
        $location = $this->input->post('location');
        $range = $this->input->post('range');

//        var_dump($location);
//        die();

        set_cookie('location', $location, (365 * 24 * 60 * 60));
        set_cookie('range', $range, (365 * 24 * 60 * 60));
        $coordinates = Google_helper::getLatLong($location);
        $lat = $coordinates['lat'];
        $long = $coordinates['long'];
        $data['directories'] = $this->Bizdir_model->get_bizdir_by_location(floatval($lat),floatval($long),$range);
        $result = $this->load->view('bizdir/place_card', $data,true);
        if( isset($result) ) {
            return $this->output
			->set_content_type('application/json')
			->set_status_header(200)
            ->set_output(json_encode($result));
        } else {
            return $this->output
			->set_content_type('application/json')
			->set_status_header(500)
			->set_output(json_encode(array(
                'text' => 'Not Found',
                'type' => 'Error 404'
            )));
        }
		
    }

    public function saveEmailTemplate  () {
        if (!$this->input->is_ajax_request()) return;
        $user_id = $this->input->post('user_id');
		$html = $this->input->post('html');
        $dir = FCPATH.'assets/email_templates/'.$user_id;
		if (!is_dir($dir)) {
			mkdir($dir, 0777, TRUE);
		}

		$clear_name = mb_strtolower(preg_replace('/[^ a-z\d]/ui', '', $this->input->post('template_name')));
		$filename = $clear_name.time().'.html';
        $filepath = $dir.''.$filename;
        if (!write_file($filepath, $html) )
		{
			$msg = 'Unable to write the file';
			$status = 'error';
		} else {
            echo base_url("assets/email_templates/$filename");
        }
		
	}

	public function saveEmailTemplateSource () {
		if (!$this->input->is_ajax_request()) return;

		$user_id = $this->input->post('user_id');
		$html = $this->input->post('html');

		$dir = FCPATH.'assets/email_templates/'.$user_id;
		if (!is_dir($dir)) {
			mkdir($dir, 0777, TRUE);
		}

		$clear_name = mb_strtolower(preg_replace('/[^ a-z\d]/ui', '', $this->input->post('template_name')));
		$filename = $clear_name.time().'.html';
        $filepath = $dir.'/'.$filename;
        

        if($this->email_templates_model->check_template_exists($this->input->post('template_name'),$user_id))
        {
            $template_id = $this->email_templates_model->get_emails_by_name($this->input->post('template_name'));
        } else {
            $template_id = $this->input->post('template_id');
        }

		if ($template_id && $template_id != 'false') {
			$email_template = $this->email_templates_model->get_emails_by_id($template_id);
            $filename = $email_template->template_file;
            $filepath = $dir.'/'.$filename;
		}

		$data = [
			'user_id' => $user_id,
			'template_file' => $filename,
			'template_name' => $this->input->post('template_name')
		];

		if (!write_file($filepath, $html) )
		{
			$msg = 'Unable to write the file';
			$status = 'error';
		}
		else
		{
			if ($template_id && $template_id != 'false') {
				$result = $this->email_templates_model->update_email_template($data, $template_id);
			} else {
				$result = $this->email_templates_model->add_email_template($data);
			}
			if ($result) {
				$msg = "Email saved";
				$status = 'success';
			} else {
				$msg = 'Email not saved in db';
				$status = 'error';
			}

		}

		echo json_encode(array('msg' => $msg, 'status' =>$status));
    }
    
    public function check_template_exists () {
        $userId = $this->session->userdata('userId');
		if($this->email_templates_model->check_template_exists($this->input->post('template_name'),$userId))
        {
            echo 'true';
        } else {
            echo 'false';
        }
    }
    
    public function delete_email_template () {
		$email_id = $this->input->post('email_id');

		if ($this->email_templates_model->deleteEmail($email_id)) {
			$msg = 'Email template deleted!';
			$status = 'success';
		} else {
			$msg = 'Something goes wrong!';
			$status = 'error';
		}
		echo json_encode(array('msg' => $msg, 'status' =>$status));
    }
}
