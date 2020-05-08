<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Machines extends MY_Controller {

    public function __construct() {

        parent::__construct();
        auth_check();
        $this->rbac->check_module_access();

        $this->is_supper = (int) $this->session->userdata('is_supper');
        $this->admin_id = (int) $this->session->userdata('admin_id');

        $this->load->model('admin/machine_model', 'machine_model');
        $this->load->model('admin/tipo_model', 'tipo_model');
        $this->load->model('admin/ponto_model', 'ponto_model');
        $this->load->model('admin/item_model', 'item_model');
    }

    //-----------------------------------------------------------

    public function index() {

        $this->load->view('admin/includes/_header');
        $this->load->view('admin/machines/machine_list');
        $this->load->view('admin/includes/_footer');
    }
    public function view_logs($id_maquina) {

        
        $dados['machine'] = $this->machine_model->get_machine_by_id($id_maquina);
        $dados['item'] = $this->item_model->get_itens_by_id($dados['machine']['item_id']);
        $dados['id_maquina'] = $id_maquina;
        $this->load->view('admin/includes/_header');
        $this->load->view('admin/machines/machine_list_log', $dados);
        $this->load->view('admin/includes/_footer');
    }

    public function datatable_log_json($id_maquina) {

        $records = $this->machine_model->get_estoque_machines($id_maquina);
        
       
        $data = array();
       

        foreach ($records['data'] as $row) {

          
            $data[] = array(
                $row['id'],
                $row['data_log'],
                $row['tipo_operacao'],
                $row['qtde'],
                $row['user_id'],
                $row['item']
            );
        }
        $records['data'] = $data;
        echo json_encode($records);
    }
    public function datatable_json() {

        $records = $this->machine_model->get_all_machines();
        $data = array();
        $i = 0;


        foreach ($records['data'] as $row) {

            $status = ($row['is_active'] == 1) ? 'checked' : '';
            
            $qtde_estoque = $this->machine_model->get_total_estoque_machines($row['id_maquina']);
           $operador= $this->machine_model->get_operador_by_machine($row['id_maquina']);
    $dados_operador = '';
           if($operador)
            $dados_operador =  '<a href="'.base_url('admin/users/ver_maquinas/'.$operador->user_id.'').'">'.$operador->firstname.' '.$operador->lastname.'</a>';
              

            $data[] = array(
                $row['id_maquina'],                
                $row['nome_tipo'],
                $row['nome_ponto'],
                $dados_operador,
                $row['observacoes_equip'],
                $row['serial'],
                $row['cont_inicial'],
                $row['cont_saida_inicial'],
                $row['valorvenda'],
                '<a title="View" class="view btn btn-sm btn-info" href="' . base_url('admin/machines/view_logs/' . $row['id_maquina']) . '"> <i class="fa fa-list"></i> ('.$qtde_estoque.') </a>',
                '<input class="tgl_checkbox tgl-ios" 
				data-id="' . $row['id_maquina'] . '" 
				id="cb_' . $row['id_maquina'] . '"
				type="checkbox"  
				' . $status . '><label for="cb_' . $row['id_maquina'] . '">
                                </label>',
                '<a title="View" class="view btn btn-sm btn-info" href="' . base_url('admin/machines/view/' . $row['id_maquina']) . '"> <i class="fa fa-eye"></i></a>
                                 <a title="Edit" class="update btn btn-sm btn-warning" href="' . base_url('admin/machines/edit/' . $row['id_maquina']) . '"> <i class="fa fa-pencil-square-o"></i></a>

				<a title="Delete" class="delete btn btn-sm btn-danger" href=' . base_url("admin/machines/delete/" . $row['id_maquina']) . ' title="Delete" onclick="return confirm(\'Deseja realmente apagar?\')"> <i class="fa fa-trash-o"></i></a>'
            );
        }
        $records['data'] = $data;
        echo json_encode($records);
    }

    //-----------------------------------------------------------

    function change_status() {

        $this->machine_model->change_status();
    }

    //---------------------------------------------------------------

    public function add() {
        // $this->rbac->check_operation_access(); // check opration permission
        if ($this->input->post('submit')) {

            $this->form_validation->set_rules('tipomaquina', 'required');
            $this->form_validation->set_rules('cont_inicial', 'trim|required');
            $this->form_validation->set_rules('cont_saida_inicial', 'trim|required');
            $this->form_validation->set_rules('valorvenda', 'trim|required');
            $this->form_validation->set_rules('serial', 'trim|required');
            $this->form_validation->set_rules('quant_insumo', 'required');
            $this->form_validation->set_rules('descricao', 'trim');

            if ($this->form_validation->run() == TRUE) {

                $data = array(
                    'errors' => validation_errors()
                );

                $this->session->set_flashdata('errors', $data['errors']);

                redirect(base_url('admin/machines/add'), 'refresh');
            } else {

                $data = array(
                    'tipomaquina' => $this->input->post('tipomaquina'),
                    'cont_inicial' => $this->input->post('cont_inicial'),
                    'cont_saida_inicial' => $this->input->post('cont_saida_inicial'),
                    'valorvenda' => grava_money($this->input->post('valorvenda'),2),
                    'serial' => $this->input->post('serial'),
                    'item_id' => $this->input->post('item'),
                    'noteiro' => (int) $this->input->post('noteiro'),
                    'ficheiro' => (int) $this->input->post('ficheiro'),
                    'observacoes_equip' => $this->input->post('observacoes_equip'),
                    'pontodevenda' => $this->input->post('pontodevenda'),
                    'created_at' => date('Y-m-d : h:i:s'),
                    'updated_at' => date('Y-m-d : h:i:s'),
                );
                if ($this->is_supper == "0") {
                    $data["admin_id"] = $this->admin_id;
                }
                $data = $this->security->xss_clean($data);

                $result = $this->machine_model->add_machine($data);
                if ($result > 0) {

                    if (isset($_FILES)) {
                        // --------------------------------------------------------
                        // FOTO DO CONTADOR INICIAL DA MAQUINA
                        // --------------------------------------------------------
                        $file_cont_inicial = '';

                        $config = array(
                            'upload_path' => $this->config->item('folder_images') . '/maquinas/',
                            'allowed_types' => 'jpg|jpeg|png|gif|JPG|PNG|JPEG',
                            'file_name' => 'contador_inicial_' . $result,
                            'overwrite' => true,
                            'max_size' => '50000',
                            'user_file' => 'file_cont_inicial'
                        );
                        $this->load->library('upload', $config);
                        if (!$this->upload->do_upload('file_cont_inicial')) {

                            $this->session->set_flashdata('errors', 'Falha no envio do arquivo, ' . $this->upload->display_errors());
                        } else {

                            $upload_data = $this->upload->data();
                            $file_cont_inicial = $upload_data['file_name'];

                            $maqData = array(
                                'nome_imagem' => $file_cont_inicial
                            );
                            $this->machine_model->edit_machine($maqData, $result);

                            $this->session->set_flashdata('success', 'Máquina adicionada com sucesso!');
                            redirect(base_url('admin/machines'));
                        }
                        // --------------------------------------------------------
                    } // isset : _FILES
                }
            }
        }


        $this->load->view('admin/includes/_header');

        $where_tipos = array('is_active' => 1);
        $where_pontos = array('is_active' => 1);
        if ($this->is_supper == "0") {
            $where_tipos = array(
                'admin_id' => $this->admin_id,
                'is_active' => 1
            );
            $where_pontos = array(
                'admin_id' => $this->admin_id,
                'is_active' => 1
            );
        }
        $dados['tipos'] = $this->tipo_model->getTodosTipos($where_tipos);
        $dados['pontos'] = $this->ponto_model->getTodosPontos($where_pontos);
        $dados['item'] = $this->item_model->getTodosItens();
        $this->load->view('admin/machines/machine_add', $dados);
        $this->load->view('admin/includes/_footer');
    }
    public function add_log() {
        // $this->rbac->check_operation_access(); // check opration permission
        if ($this->input->post('submit')) {
       
            $this->form_validation->set_rules('id_maquina', 'required');
            $this->form_validation->set_rules('tipo_operacao', 'required');
            $this->form_validation->set_rules('qtde', 'required');
            $this->form_validation->set_rules('item', 'required');

            if ($this->form_validation->run() == TRUE) {

                $data = array(
                    'errors' => validation_errors()
                );

                $this->session->set_flashdata('errors', $data['errors']);

                redirect(base_url('admin/machines/view_logs/'.$this->input->post('id_maquina')), 'refresh');
            } else {

                
                $qtde = $this->input->post('qtde');
                     if($this->input->post('tipo_operacao') == 'saida'){
                        $qtde = $qtde  * -1;
                     }
                
                $data = array(
                    'qtde' => $qtde,
                    'item_id' => $this->input->post('item'),
                    'maq_id' => $this->input->post('id_maquina'),
                    'tipo_operacao' => $this->input->post('tipo_operacao'),
                    'user_id' => $this->session->userdata('admin_id'),
                    'created_at' => date('Y-m-d : h:i:s'),
                    'updated_at' => date('Y-m-d : h:i:s'),
                );
              
                
                $data = $this->security->xss_clean($data);
                $result = $this->machine_model->add_log_machine($data);
                
                
                
                if ($result > 0) {
                     $this->session->set_flashdata('success', 'Estoque atualizado com sucesso!');
                 
                     
                    
                     $qtde = $this->input->post('qtde');
                     if($this->input->post('tipo_operacao') == 'entrada'){
                        $qtde = $qtde  * -1;
                     }
                     
                     $data_log_item = array(
		    'qtde' => $qtde,
                    'item_id' => $this->input->post('item'),
                    'tipo_operacao' => $this->input->post('tipo_operacao')=='saida'?'entrada':'saida',
                    'user_id' => $this->session->userdata('admin_id'),
                    'created_at' => date('Y-m-d : h:i:s'),
                    'updated_at' => date('Y-m-d : h:i:s'),
				);
                     
                      $result = $this->item_model->add_log_itens($data_log_item);
                     //$this->item_model->edit_item(array('quantidade'=>$nova_qtde_item), $this->input->post('item'));
                    
                     redirect(base_url('admin/machines/view_logs/'.$this->input->post('id_maquina')), 'refresh');
                }
            }
        }


        $this->load->view('admin/includes/_header');

        $where_tipos = array('is_active' => 1);
        $where_pontos = array('is_active' => 1);
        if ($this->is_supper == "0") {
            $where_tipos = array(
                'admin_id' => $this->admin_id,
                'is_active' => 1
            );
            $where_pontos = array(
                'admin_id' => $this->admin_id,
                'is_active' => 1
            );
        }
        $dados['tipos'] = $this->tipo_model->getTodosTipos($where_tipos);
        $dados['pontos'] = $this->ponto_model->getTodosPontos($where_pontos);
        $dados['item'] = $this->item_model->getTodosItens();
        $this->load->view('admin/machines/machine_add', $dados);
        $this->load->view('admin/includes/_footer');
    }

    //---------------------------------------------------------------

    public function edit($id = 0) {

        $this->rbac->check_operation_access(); // check opration permission

        if ($this->input->post('submit')) {

            $this->form_validation->set_rules('tipomaquina', 'Tipo de máquina','required');
            $this->form_validation->set_rules('cont_inicial','Contador inicial', 'trim');
            $this->form_validation->set_rules('cont_saida_inicial', 'Contador de saída', 'trim|required');
            $this->form_validation->set_rules('valorvenda', 'valor da venda', 'trim|required');
            $this->form_validation->set_rules('serial','Serial', 'trim|required');
            
       
            if ($this->form_validation->run() == false) {

                $data = array(
                    'errors' => validation_errors()
                );

                $this->session->set_flashdata('errors', $data['errors']);
                redirect(base_url('admin/machines/edit/' . $id), 'refresh');
            } else {


                // --------------------------------------------------------
                // FOTO DO CONTADOR INICIAL DA MAQUINA
                // --------------------------------------------------------
                $file_cont_inicial_old = $this->input->post('file_cont_inicial_old');
                $file_cont_inicial_old = $this->security->xss_clean($file_cont_inicial_old);
                $file_cont_inicial = $file_cont_inicial_old;

                $config = array(
                    'upload_path' => $this->config->item('folder_images') . '/maquinas/',
                    'allowed_types' => 'jpg|jpeg|png|gif|JPG|PNG|JPEG',
                    'file_name' => 'contador_inicial_' . $id,
                    'overwrite' => true,
                    'max_size' => '50000',
                        //'user_file' =>'file_cont_inicial'
                );
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('file_cont_inicial')) {

                    $upload_data = $this->upload->data();
                    $file_cont_inicial = $upload_data['file_name'];
                }
                // --------------------------------------------------------

                $data = array(
                    //'id' => $id,

                    'tipomaquina' => $this->input->post('tipomaquina'),
                    'pontodevenda' => $this->input->post('pontodevenda'),
                    'serial' => $this->input->post('serial'),
                    'cont_inicial' => $this->input->post('cont_inicial'),
                    'cont_saida_inicial' => $this->input->post('cont_saida_inicial'),
                    'item_id' => $this->input->post('item'),
                      'valorvenda' => grava_money($this->input->post('valorvenda'), 2),
                    'nome_imagem' => $file_cont_inicial,
                    'noteiro' => (int) $this->input->post('noteiro'),
                    'ficheiro' => (int) $this->input->post('ficheiro'),
                    'observacoes_equip' => $this->input->post('observacoes_equip'),
                    'is_active' => $this->input->post('is_active'),
                    'updated_at' => date('Y-m-d : h:m:s'),
                );
                $data = $this->security->xss_clean($data);
                //var_dump( $data );
               // exit();

                $result = $this->machine_model->edit_machine($data, $id);
                if ($result) {

                    $this->session->set_flashdata('success', 'Maquina atualizada com sucesso!');
                    redirect(base_url('admin/machines'));
                }
            }
        }

        $where_tipos = array('is_active' => 1);
        $where_pontos = array('is_active' => 1);
        if ($this->is_supper == "0") {
            $where_tipos = array(
                'admin_id' => $this->admin_id,
                'is_active' => 1
            );
            $where_pontos = array(
                'admin_id' => $this->admin_id,
                'is_active' => 1
            );
        }
            $dados['item'] = $this->item_model->getTodosItens();
        $dados['tipos'] = $this->tipo_model->getTodosTipos($where_tipos);
        $dados['pontos'] = $this->ponto_model->getTodosPontos($where_pontos);
        $dados['machine'] = $this->machine_model->get_machine_by_id($id);
        $this->load->view('admin/includes/_header');
        $this->load->view('admin/machines/machine_edit', $dados);
        $this->load->view('admin/includes/_footer');
    }

    //---------------------------------------------------------------

    public function delete($id = 0) {

        $this->rbac->check_operation_access(); // check opration permission

        $this->db->delete('ci_machines', array('id' => $id));

        $this->session->set_flashdata('success', 'máquina excluida com sucesso!');

        redirect(base_url('admin/machines'));
    }

    //---------------------------------------------------------------

    public function view($id = 0) {
        $dados['title'] = 'Operar_template';


        $dados['rs'] = array();
        $result = $this->machine_model->get_machine_by_id($id);
        if ($result) {
            $dados['rs'] = $result;
        }

        $this->load->view('admin/includes/_header');
        $this->load->view('admin/machines/machine_view', $dados);
        $this->load->view('admin/includes/_footer');
    }

    //---------------------------------------------------------------
    //  Export machines PDF 

    public function create_machines_pdf() {



        $this->load->helper('pdf_helper'); // loaded pdf helper

        $data['all_machines'] = $this->machine_model->get_machines_for_export();

        $this->load->view('admin/machines/machines_pdf', $data);
    }

    //---------------------------------------------------------------	
    // Export data in CSV format 

    public function export_csv() {



        // file name 

        $filename = 'machines_' . date('Y-m-d') . '.csv';

        header("Content-Description: File Transfer");

        header("Content-Disposition: attachment; filename=$filename");

        header("Content-Type: application/csv; ");



        // get data 

        $machine_data = $this->machine_model->get_machines_for_export();



        // file creation 

        $file = fopen('php://output', 'w');


        $header = array("ID", "Ponto", "Email", "Responsavel", "Telefone", "cidade", "Created Date");




        fputcsv($file, $header);

        foreach ($machine_data as $key => $line) {

            fputcsv($file, $line);
        }

        fclose($file);

        exit;
    }

}

?>
