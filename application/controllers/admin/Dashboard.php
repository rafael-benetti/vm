<?php defined('BASEPATH') OR exit('No direct script access allowed');



class Dashboard extends My_Controller {



	public function __construct(){

		parent::__construct();

		auth_check(); // check login auth

		$this->load->model('admin/dashboard_model', 'dashboard_model');
                $this->load->model('admin/machine_model', 'machine_model');
                $this->load->model('admin/ponto_model', 'ponto_model');
                $this->load->model('admin/dashboard_model', 'google');
                $this->load->model('admin/user_model', 'user_model');
                $this->load->model('admin/operar_model', 'operar_model');
                $this->load->helper(array('url','html','form'));

	}



	//--------------------------------------------------------------------------

	public function index(){
        $users = $this->google->get_list();
        $markers = [];
        $infowindow = [];
        
        foreach($users as $value) {
          $markers[] = [
            $value->ponto, $value->latitude, $value->longitude
          ];          
          $infowindow[] = [
           "<div class=info_content style='line-height: 0.7'><p>"
              . "<b>".$value->cidade."</b></p>"
              . "<p>".$value->ponto."</p></div>"
              . "<p>".$value->telefone."</p></div>"
              . "<p>".$value->responsavel."</p></div>"
              
          ];
        }
        $data['markers'] = json_encode($markers);
        $data['infowindow'] = json_encode($infowindow);
        
        

		$data['all_users'] = $this->dashboard_model->get_all_users();

		$data['active_users'] = $this->dashboard_model->get_active_users();

		$data['deactive_users'] = $this->dashboard_model->get_deactive_users();
                
        	$data['all_clientes'] = $this->dashboard_model->get_all_clientes();
                
                $data['all_admin'] = $this->user_model->getQtdeOperadores();

		$data['active_clientes'] = $this->dashboard_model->get_active_clientes();

		$data['deactive_clientes'] = $this->dashboard_model->get_deactive_clientes();
                
                $data['all_machines'] = $this->dashboard_model->get_all_machines();
                
                $data['all_pontos'] = $this->dashboard_model->get_all_pontos();
                
                $data['all_operacoes'] =  $this->operar_model->getTodasOperacoes();
                $all_operacoes_mensal =  $this->operar_model->getTodasOperacoesMensais();
                
                
                foreach($all_operacoes_mensal as $operacoes_mensal){
                
                   
                $data['operacao_mes'][] =  get_nome_mes((int)$operacoes_mensal->mes);   
                
                
                $data['operacao_vendas'][] =  $operacoes_mensal->venda;   
                $data['operacao_saldo'][] =  $operacoes_mensal->saldo;  
                    
                }
                
             //   echo '<pre>';
             //   var_dump(json_encode($data['operacao_mes'])); exit;
             //  
                
                
                
		$data['title'] = 'Dashboard';
                


	$this->load->view('admin/includes/_header');

    	$this->load->view('admin/dashboard/index', $data);

    	$this->load->view('admin/includes/_footer');

	}


        

	//--------------------------------------------------------------------------        
        



	public function index_2(){

		/*$data['all_users'] = $this->dashboard_model->get_all_users();

		$data['active_users'] = $this->dashboard_model->get_active_users();

		$data['deactive_users'] = $this->dashboard_model->get_deactive_users();*/



		$data['title'] = 'Dashboard';



		$this->load->view('admin/includes/_header');

    	$this->load->view('admin/dashboard/index2');

    	$this->load->view('admin/includes/_footer');

	}



	//--------------------------------------------------------------------------

	public function index_3(){

		/*$data['all_users'] = $this->dashboard_model->get_all_users();

		$data['active_users'] = $this->dashboard_model->get_active_users();

		$data['deactive_users'] = $this->dashboard_model->get_deactive_users();*/



		$data['title'] = 'Dashboard';



		$this->load->view('admin/includes/_header');

    	$this->load->view('admin/dashboard/index3');

    	$this->load->view('admin/includes/_footer');

	}

	

}



?>	