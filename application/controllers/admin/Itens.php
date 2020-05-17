<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Itens extends MY_Controller {
         private $modulo_name = 'itens';

    
	public function __construct(){
		parent::__construct();
		auth_check(); // check login auth
                		$this->rbac->check_module_access();
		$this->load->model('admin/item_model', 'item_model');
		$this->load->model('admin/user_model', 'user_model');
                $this->load->model('admin/Admin_model', 'Admin_model');
	}
	// padrão do projeto vm ---------------------------

	public function index(){

		$data['title'] = 'operar';

		$this->load->view('admin/includes/_header');

		$this->load->view('admin/itens/list_item', $data);

		$this->load->view('admin/includes/_footer');

	}
        
        public function view_logs($id_item) {
         
            
        $dados['item'] = $this->item_model->get_itens_by_id($id_item);
        
        $this->load->view('admin/includes/_header');
        $this->load->view('admin/itens/item_list_log', $dados);
        $this->load->view('admin/includes/_footer');
        
        
        
       }
       
       public function add_log() {
        // $this->rbac->check_operation_access(); // check opration permission
        if ($this->input->post('submit')) {
       
            $this->form_validation->set_rules('tipo_operacao', 'required');
            $this->form_validation->set_rules('qtde', 'required');
            $this->form_validation->set_rules('item', 'required');

            if ($this->form_validation->run() == TRUE) {

                $data = array(
                    'errors' => validation_errors()
                );

                $this->session->set_flashdata('errors', $data['errors']);

                redirect(base_url('admin/itens/view_logs/'.$this->input->post('item')), 'refresh');
            } else {

                $data = array(
                    'qtde' => $this->input->post('qtde'),
                    'item_id' => $this->input->post('item'),
                    'tipo_operacao' => $this->input->post('tipo_operacao'),
                    'user_id' => $this->session->userdata('admin_id'),
                    'created_at' => date('Y-m-d : h:i:s'),
                    'updated_at' => date('Y-m-d : h:i:s'),
                );
              
                $data = $this->security->xss_clean($data);
                $result = $this->item_model->add_log_itens($data);
                
                if ($result > 0) {
                     $this->session->set_flashdata('success', 'Estoque atualizado com sucesso!');
                     $dados_itens = $this->item_model->get_itens_by_id($this->input->post('item'));
                     
                     $qtde = $this->input->post('qtde');
                     
                     
                     if($this->input->post('tipo_operacao') == 'saida'){
                        $qtde = $qtde  * -1;
                     }
                     
                     
                      $nova_qtde_item =  $dados_itens['quantidade'] - $qtde;
                    
           
                     
                     
                     
                     
                     $this->item_model->edit_item(array('quantidade'=>$nova_qtde_item), $this->input->post('item'));
                     
                     
                      redirect(base_url('admin/itens/view_logs/'.$this->input->post('item')), 'refresh');
                }
            }
        }


        $this->load->view('admin/includes/_header');
        $dados['item'] = $this->item_model->getTodosItens();
        $this->load->view('admin/itens/list_item', $dados);
        $this->load->view('admin/includes/_footer');
    }
       
       public function datatable_log_json($id_item) {
            
            
        $records = $this->item_model->get_estoque_itens($id_item);
        $data = array();       

        foreach ($records['data'] as $row) {
            
            $dados_usuario = $this->user_model->get_dados_usuario($row['user_id']);
            $nome_usuario='';
            if($dados_usuario){
                $nome_usuario = $dados_usuario->firstname. ' '.$dados_usuario->lastname;
            }
          //  var_dump($row['user_id']); exit;
          
            $data[] = array(
                $row['id'],
                $row['data_log'],
                $row['tipo_operacao'],
                $row['qtde'],
                $nome_usuario
               
            );
        }
        $records['data'] = $data;
        echo json_encode($records);
    }
       
        
        	public function add_item(){
		$data['title'] = 'add_item';
		$this->load->view('admin/includes/_header');
		$this->load->view('admin/itens/add_item', $data);
		$this->load->view('admin/includes/_footer');
               	}

                
                
                
                public function datatable_json(){				   					   

		$records = $this->item_model->get_all_itens();

		$data = array();

		$i=0;

		foreach ($records['data']  as $row) 

		{
                         $status = ($row['is_active'] == 1) ? 'checked' : '';

                    
if(verifica_permissao($this->modulo_name, 'edit'))           
$edit ='<a title="Edit" class="update btn btn-sm btn-warning" href="'.base_url('admin/itens/edit/'.$row['id']).'"> <i class="fa fa-pencil-square-o"></i></a>';

if(verifica_permissao($this->modulo_name, 'delete'))
$delete ='<a title="Delete" class="delete btn btn-sm btn-danger" href='.base_url("admin/itens/delete/".$row['id']).' title="Delete" onclick="return confirm(\'Tem certeza que deseja apagar ?\')"> <i class="fa fa-trash-o"></i></a>';

if(verifica_permissao($this->modulo_name, 'view'))
$view ='<a title="View" class="view btn btn-sm btn-info" href="'.base_url('admin/itens/edit/'.$row['id']).'"> <i class="fa fa-eye"></i></a>';

if(verifica_permissao($this->modulo_name, 'change_status')){
$bnt_status = '<input class="tgl_checkbox tgl-ios" 
				data-id="'.$row['id'].'" 
				id="cb_'.$row['id'].'"
				type="checkbox"  
				'.$status.'><label for="cb_'.$row['id'].'">
                                </label>';
}else{
    if($status)
        $bnt_status = 'Ativo';
    else
        $bnt_status = 'Desativado';
}


			$status = ($row['is_active'] == 1)? 'checked': '';
                         $qtde_estoque = $this->item_model->get_total_estoque_itens($row['id']);
        
			$data[]= array(
			
			$row['id'],
			$row['item'],
                         '<a title="View" class="view btn btn-sm btn-info" href="' . base_url('admin/itens/view_logs/' . $row['id']) . '"> <i class="fa fa-list"></i> ('.$qtde_estoque.') </a>',
                                           $row['valor'],
                         
			$bnt_status,		
                         @$delete.@$edit

			);

		}

		$records['data']=$data;

		echo json_encode($records);						   

	}
        
        
        
        
	function change_status()
	{   
		$this->item_model->change_status();
	}


	public function add(){	
            
		
      if(!verifica_permissao($this->modulo_name, 'add')){
                               redirect('access_denied/index/'); 

        }

                if($this->input->post('submit')){		
			
			$this->form_validation->set_rules('item', 'item', 'trim|required');
                        $this->form_validation->set_rules('quantidade', 'quantidade', 'trim|required');
                        $this->form_validation->set_rules('valor', 'valor', 'trim|required');                        
			if ($this->form_validation->run() == FALSE) {

				$data = array(

					'errors' => validation_errors()

				);

				$this->session->set_flashdata('errors', $data['errors']);

				redirect(base_url('admin/itens/add_item'),'refresh');

			}

			else{

				$data = array(
					'item' => $this->input->post('item'),
					'valor' => $this->input->post('valor'),                                        
					'created_at' => date('Y-m-d : h:m:s'),
					'updated_at' => date('Y-m-d : h:m:s'),
				);

				$data = $this->security->xss_clean($data);

				$result = $this->item_model->add_item($data);

				if($result){
                                    
                                    
                                     $data_log_item = array(
		    'qtde' => $this->input->post('quantidade'),
                    'item_id' => $result,
                    'tipo_operacao' => 'entrada',
                    'user_id' => $this->session->userdata('admin_id'),
                    'created_at' => date('Y-m-d : h:i:s'),
                    'updated_at' => date('Y-m-d : h:i:s'),
				);
                                     
                                    
                     $this->item_model->add_log_itens($data_log_item);
                                    

				$this->session->set_flashdata('success', 'Item adicionado com sucesso!');

				redirect(base_url('admin/itens'));

				}

			}

		}

		else{

			$this->load->view('admin/includes/_header');

			$this->load->view('admin/itens/itens_add');

			$this->load->view('admin/includes/_footer');

		}
                
	}


public function edit($id = 0){



		$this->rbac->check_operation_access(); // check opration permission



		if($this->input->post('submit')){		
			
			$this->form_validation->set_rules('item', 'Item', 'trim|required');
                     //   $this->form_validation->set_rules('quantidade', 'Quantidade', 'trim|required');
                        $this->form_validation->set_rules('valor', 'Valor', 'trim|required');
                        $this->form_validation->set_rules('status', 'Status', 'trim|required');
			
			if ($this->form_validation->run() == FALSE) {

					$data = array(

						'errors' => validation_errors()

					);

					$this->session->set_flashdata('errors', $data['errors']);

					redirect(base_url('admin/itens/edit_item/'.$id),'refresh');

			}

			else{

				$data = array(			
					
					'item' => $this->input->post('item'),
                                      //  'quantidade' => $this->input->post('quantidade'),
                                        'valor' => $this->input->post('valor'),
					'is_active' => $this->input->post('status'),
					'updated_at' => date('Y-m-d : h:m:s'),
					
					

				);

				$data = $this->security->xss_clean($data);

				$result = $this->item_model->edit_item($data, $id);

				if($result){

					$this->session->set_flashdata('success', 'item foi atualizado com sucesso!');

					redirect(base_url('admin/itens'));

				}

			}

		}

		else{

			$data['item'] = $this->item_model->get_itens_by_id($id);

			$this->load->view('admin/includes/_header');

			$this->load->view('admin/itens/edit_item', $data);

			$this->load->view('admin/includes/_footer');

		}

	}
        
         public function delete($id = 0) {

        $this->rbac->check_operation_access(); // check opration permission

        $this->db->delete('ci_itens', array('id' => $id));

        $this->session->set_flashdata('success', 'Item has been deleted successfully!');

        redirect(base_url('admin/itens'));
    }
        
        
}?>