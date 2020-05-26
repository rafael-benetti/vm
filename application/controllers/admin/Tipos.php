<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Tipos extends MY_Controller {

    public function __construct() {



        parent::__construct();

        auth_check(); // check login auth

        $this->rbac->check_module_access();


        $this->load->model('admin/tipo_model', 'tipo_model');
    }

    //-----------------------------------------------------------

    public function index() {



        $this->load->view('admin/includes/_header');

        $this->load->view('admin/tipos/tipo_list');

        $this->load->view('admin/includes/_footer');
    }

    public function datatable_json() {

        $records = $this->tipo_model->get_all_tipos();

        $data = array();



        $i = 0;

        foreach ($records['data'] as $row) {

            $status = ($row['is_active'] == 1) ? 'checked' : '';
            $data[] = array(
                $row['id'],
                $row['tipo'],
                '<input class="tgl_checkbox tgl-ios" 
				data-id="' . $row['id'] . '" 
				id="cb_' . $row['id'] . '"
				type="checkbox"  
				' . $status . '><label for="cb_' . $row['id'] . '">
                                </label>',
                '<a title="View" class="view btn btn-sm btn-info" href="' . base_url('admin/tipos/edit/' . $row['id']) . '"> <i class="fa fa-eye"></i></a>
                                 <!--<a title="Edit" class="update btn btn-sm btn-warning" href="' . base_url('admin/tipos/edit/' . $row['id']) . '"> <i class="fa fa-pencil-square-o"></i></a>-->

				<a title="Delete" class="delete btn btn-sm btn-danger" href=' . base_url("admin/tipos/delete/" . $row['id']) . ' title="Delete" onclick="return confirm(\'Tem certeza que deseja apagar ?\')"> <i class="fa fa-trash-o"></i></a>'
            );
        }

        $records['data'] = $data;

        echo json_encode($records);
    }

    //-----------------------------------------------------------

    function change_status() {

        $this->tipo_model->change_status();
    }

    //---------------------------------------------------------------

    public function add() {
        $this->rbac->check_operation_access(); // check opration permission
        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('tipo', 'Tipo', 'trim|is_unique[ci_tipos.tipo]|required');
            if ($this->form_validation->run() == FALSE) {
                $data = array(
                    'errors' => validation_errors()
                );
                $this->session->set_flashdata('errors', $data['errors']);
                redirect(base_url('admin/tipos/add'), 'refresh');
            } else {

                $data = array(
                    'tipo' => $this->input->post('tipo'),
                    'created_at' => date('Y-m-d : h:m:s'),
                    'updated_at' => date('Y-m-d : h:m:s'),
                    'nome_imagem' => '',
                );
                $data = $this->security->xss_clean($data);
                $result = $this->tipo_model->add_tipo($data);

                if ($result > 0) {

                    if (isset($_FILES)) {

                        if ($this->ddoo_upload('file_img_tipos', $result)) {

                            $upload_data = $this->upload->data();
                            $file_cont_inicial = $upload_data['file_name'];

                            $maqData = array(
                                'nome_imagem' => $file_cont_inicial
                            );
                            $this->tipo_model->edit_tipo($maqData, $result);
                            $this->session->set_flashdata('success', 'Tipo adicionado com sucesso');
                            redirect(base_url('admin/tipos'));
                        } else {
                            $this->session->set_flashdata('error', 'Ocorreu erro upload do tipo');
                            redirect(base_url('admin/tipos'));
                        }
                    } else {
                        $this->session->set_flashdata('error', 'Ocorreu erro ao adicionar o tipo');
                        redirect(base_url('admin/tipos'));
                    }
                }
            }
        } else {
            $this->load->view('admin/includes/_header');
            $this->load->view('admin/tipos/tipo_add');
            $this->load->view('admin/includes/_footer');
        }
    }

    public function edit($id = 0) {

        $this->rbac->check_operation_access(); // check opration permission



        if ($this->input->post('submit')) {

            $this->form_validation->set_rules('tipo', 'Tipo', 'trim|required');
            $this->form_validation->set_rules('status', 'Status', 'trim|required');



            if ($this->form_validation->run() == FALSE) {

                $data = array(
                    'errors' => validation_errors()
                );

                $this->session->set_flashdata('errors', $data['errors']);

                redirect(base_url('admin/tipos/tipo_edit/' . $id), 'refresh');
            } else {

                $data = array(
                    'tipo' => $this->input->post('tipo'),
                    'is_active' => $this->input->post('status'),
                    'updated_at' => date('Y-m-d : h:m:s'),
                );

                $data = $this->security->xss_clean($data);

                $result = $this->tipo_model->edit_tipo($data, $id);

                if ($result) {

                    if (isset($_FILES)) {
                        $tipo = $this->tipo_model->get_tipo_by_id($id);
                    
                             $arquivo = $this->config->item('folder_images') . 'tipos/'.$tipo['nome_imagem'];
                      
                        if(is_file($arquivo)){
                           unlink($arquivo);
                       }
                    
                        if ($this->ddoo_upload('file_img_tipos', $tipo['id'])) {

                            $upload_data = $this->upload->data();
                            $file_cont_inicial = $upload_data['file_name'];

                            $maqData = array(
                                'nome_imagem' => $file_cont_inicial
                            );
                            $this->tipo_model->edit_tipo($maqData, $result);
                            $this->session->set_flashdata('success', 'Tipo atualizado com sucesso');
                            redirect(base_url('admin/tipos'));
                        } else {
                            $this->session->set_flashdata('error', 'Ocorreu erro upload do tipo');
                            redirect(base_url('admin/tipos'));
                        }
                    } else {
                        $this->session->set_flashdata('success', 'tipo foi atualizado com sucesso!');
                        redirect(base_url('admin/tipos'));
                    }
                }
            }
        } else {

            


$data['tipo'] = $this->tipo_model->get_tipo_by_id($id);
            $this->load->view('admin/includes/_header');

            $this->load->view('admin/tipos/tipo_edit', $data);

            $this->load->view('admin/includes/_footer');
        }
    }

    //---------------------------------------------------------------

    public function delete($id = 0) {

        $this->rbac->check_operation_access(); // check opration permission



        $this->db->delete('ci_tipos', array('id' => $id));

        $this->session->set_flashdata('success', 'Tipoe apagado com sucesso!');

        redirect(base_url('admin/tipos'));
    }

    //---------------------------------------------------------------
    //  Export tipos PDF 

    public function create_tipos_pdf() {



        $this->load->helper('pdf_helper'); // loaded pdf helper

        $data['all_tipos'] = $this->tipo_model->get_tipos_for_export();

        $this->load->view('admin/tipos/tipos_pdf', $data);
    }

    //---------------------------------------------------------------	
    // Export data in CSV format 

    public function export_csv() {



        // file name 

        $filename = 'tipos_' . date('Y-m-d') . '.csv';

        header("Content-Description: File Transfer");

        header("Content-Disposition: attachment; filename=$filename");

        header("Content-Type: application/csv; ");



        // get data 

        $tipo_data = $this->tipo_model->get_tipos_for_export();



        // file creation 

        $file = fopen('php://output', 'w');


        $header = array("ID", "Tipo", "Created Date");




        fputcsv($file, $header);

        foreach ($tipo_data as $key => $line) {

            fputcsv($file, $line);
        }

        fclose($file);

        exit;
    }

    function ddoo_upload($filename, $id) {

         $config['upload_path'] = $this->config->item('folder_images') . 'tipos/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif|JPG|PNG|JPEG';
        $config['max_size'] = '50000';
        $config['file_name'] = $filename . '_' . $id;
        $config['user_file'] = $filename;
        $config['overwrite'] = false;

        $this->load->library('upload', $config);
        if (!$this->upload->do_upload($filename)) {
            $error = array('error' => $this->upload->display_errors());
            return false;
// $this->load->view('upload_form', $error);
        } else {
            $data = array('upload_data' => $this->upload->data());
            return true;
//$this->load->view('upload_success', $data);
        }
    }

}

?>