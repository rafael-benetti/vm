<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Financeiro extends MY_Controller {

    public function __construct() {
        parent::__construct();
        auth_check(); // check login auth
        $this->rbac->check_module_access();
        $this->load->model('admin/financeiro_model', 'financeiro_model');
    }

    // padrão do projeto vm ---------------------------



    public function despesa() {
        $data['title'] = 'add_despesa';
        $this->load->view('admin/includes/_header');
        $this->load->view('admin/financeiro/add_despesa', $data);
        $this->load->view('admin/includes/_footer');
    }
    
    public function receita() {
        $data['title'] = 'add_receita';
        $this->load->view('admin/includes/_header');
        $this->load->view('admin/financeiro/add_receita', $data);
        $this->load->view('admin/includes/_footer');
    }
    
    public function index() {
        $data['title'] = 'add_receita';
        $this->load->view('admin/includes/_header');
        $data  ['financeiro'] = $this->financeiro_model->get();
        $this->load->view('admin/financeiro/relatorio', $data);
        $this->load->view('admin/includes/_footer');
    }
    
    

    public function add_despesa() {
        $this->rbac->check_operation_access(); // check opration permission
        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('nome', 'nome', 'trim|required');
            $this->form_validation->set_rules('nota', 'nota', 'trim|required');
            $this->form_validation->set_rules('data', 'data', 'trim|required');
            $this->form_validation->set_rules('valor', 'valor', 'trim|required');
            $this->form_validation->set_rules('categoria', 'categoria', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
                $data = array(
                    'errors' => validation_errors()
                );
                $this->session->set_flashdata('errors', $data['errors']);
                redirect(base_url('admin/financeiro/add_despesa'), 'refresh');
            } else {
                $data = array(
                    'nome' => $this->input->post('nome'),
                    'nota' => $this->input->post('nota'),
                    'data' => $this->input->post('data'),
                    'valor' => $this->input->post('valor'),
                    'categoria' => $this->input->post('categoria'),
                    'tipo_entrada' => 'Despesa',
                    'created_at' => date('Y-m-d : h:m:s'),
                    'updated_at' => date('Y-m-d : h:m:s'),
                );
                $data = $this->security->xss_clean($data);
                $result = $this->financeiro_model->add_despesa($data);
                if ($result) {
                    $this->session->set_flashdata('success', 'financeiro adicionado com sucesso!');
                    redirect(base_url('admin/financeiro/despesa'));
                }
            }
        } else {
            $this->load->view('admin/includes/_header');
            $this->load->view('admin/financeiro/add_despesa');
            $this->load->view('admin/includes/_footer');
        }
    }
    
    
    public function add_receita() {
        $this->rbac->check_operation_access(); // check opration permission
        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('nome', 'nome', 'trim|required');
            $this->form_validation->set_rules('nota', 'nota', 'trim|required');
            $this->form_validation->set_rules('data', 'data', 'trim|required');
            $this->form_validation->set_rules('valor', 'valor', 'trim|required');
            $this->form_validation->set_rules('tipopgto', 'tipopgto', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
                $data = array(
                    'errors' => validation_errors()
                );
                $this->session->set_flashdata('errors', $data['errors']);
                redirect(base_url('admin/financeiro/add_receita'), 'refresh');
            } else {
                $data = array(
                    'nome' => $this->input->post('nome'),
                    'nota' => $this->input->post('nota'),
                    'data' => $this->input->post('data'),
                    'valor' => $this->input->post('valor'),
                    'tipopgto' => $this->input->post('tipopgto'),
                    'tipo_entrada' => 'Receita',
                    'created_at' => date('Y-m-d : h:m:s'),
                    'updated_at' => date('Y-m-d : h:m:s'),
                );
                $data = $this->security->xss_clean($data);
                $result = $this->financeiro_model->add_despesa($data);
                if ($result) {
                    $this->session->set_flashdata('success', 'financeiro adicionado com sucesso!');
                    redirect(base_url('admin/financeiro/receita'));
                }
            }
        } else {
            $this->load->view('admin/includes/_header');
            $this->load->view('admin/financeiro/add_receita');
            $this->load->view('admin/includes/_footer');
        }
    }

    
    
       
    
    
    public function datatable_json(){				   					   
		$records = $this->item_model->get_all_financeiro();
		$data = array();
		$i=0;
		foreach ($records['data']  as $row) 
		{  
			$status = ($row['is_active'] == 1)? 'checked': '';
			$data[]= array(
			$row['id'],
			$row['data'],
                        $row['nome'],
                        $row['categoria'],
                        $row['nota'],
                        $row['valor'],
                        $row['tipo_entrada'],    
				'<input class="tgl_checkbox tgl-ios" 
				data-id="'.$row['id'].'" 
				id="cb_'.$row['id'].'"
				type="checkbox"  
				'.$status.'><label for="cb_'.$row['id'].'">
                                </label>',
                            
                                '<!--<a title="View" class="view btn btn-sm btn-info" href="'.base_url('admin/itens/edit/'.$row['id']).'"> <i class="fa fa-eye"></i></a>-->
                                 <a title="Edit" class="update btn btn-sm btn-warning" href="'.base_url('admin/itens/edit/'.$row['id']).'"> <i class="fa fa-pencil-square-o"></i></a>
				<a title="Delete" class="delete btn btn-sm btn-danger" href='.base_url("admin/itens/delete/".$row['id']).' title="Delete" onclick="return confirm(\'Tem certeza que deseja apagar ?\')"> <i class="fa fa-trash-o"></i></a>'
			);
		}
		$records['data']=$data;
		echo json_encode($records);						   
	}
        
        


        
    // CATEGORIAS ---------------------------------------------------------

  
    
    
    
    
    
}
?>