<?php
class Controller extends CI_Controller {
 
	function __construct() {
	parent::__construct();
	$this->load->helper('url');
	$this->load->helper('form');
	$this->load->database();
	$this->load->model('Model');
	}
	public function file_upload(){
		$config['upload_path'] = './assets/images/';
		$config['allowed_types'] = '*';
		$this->load->library('upload', $config);
		$this->upload->do_upload('file_name');
		$up_file_name = $this->upload->data();
		$data = array('file_upload' => $up_file_name['file_name']);
		$this->Model->FileUpload($data);
	}
}
?>