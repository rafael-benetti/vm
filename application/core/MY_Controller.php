<?php

	class MY_Controller extends CI_Controller

	{

		function __construct()

		{

			parent::__construct();

			$this->load->model('admin/setting_model', 'setting_model');



			//general settings

	        $global_data['general_settings'] = $this->setting_model->get_general_settings();

	        $this->general_settings = $global_data['general_settings'];



	        //set timezone

	        date_default_timezone_set($this->general_settings['timezone']);



	        //recaptcha status

	        $global_data['recaptcha_status'] = true;

	        if (empty($this->general_settings['recaptcha_site_key']) || empty($this->general_settings['recaptcha_secret_key'])) {

	            $global_data['recaptcha_status'] = false;

	        }

	        $this->recaptcha_status = $global_data['recaptcha_status'];

		}
                

		//verify recaptcha
	    public function recaptcha_verify_request()
	    {
	        if (!$this->recaptcha_status) {
	            return true;
	        }

	        $this->load->library('recaptcha');
	        $recaptcha = $this->input->post('g-recaptcha-response');
	        if (!empty($recaptcha)) {
	            $response = $this->recaptcha->verifyResponse($recaptcha);
	            if (isset($response['success']) && $response['success'] === true) {
	                return true;
	            }
	        }
	        return false;
	    }

	}



?>



    