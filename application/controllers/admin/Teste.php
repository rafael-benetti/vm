<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Teste extends MY_Controller {

    public function __construct() {
        parent::__construct();
        auth_check(); // check login auth
    }

    //----------------------------------------------------------------
    public function index() {
        $data['title'] = 'teste';
        $this->load->view('admin/includes/_header');
        $this->load->view('admin/teste/teste', $data);
        $this->load->view('admin/includes/_footer');
     
           
    
        
        $this->load->model('admin/Teste_model');
        $msg = $_POST["mensagem"];
        $this->Post_model->msg = $msg;
        $this->Post_model->inserir();
        
        
          
}

        }