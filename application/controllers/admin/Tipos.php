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
                
                
                 // CONTADOR DE ENTRADA
            // --------------------------------------------------------
            $file_img_tipos = $this->input->post('file_img_tipos');
            $file_img_tipos = $this->security->xss_clean($file_img_tipos);
            $file_tipo = $file_img_tipos;
            $config['upload_path'] = $this->config->item('folder_images') . '/tipos/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('file_tipo')) {
                $upload_data = $this->upload->data();
                $file_tipo = $upload_data['file_name'];
            }
            
            
            
                $data = array(
                    'tipo' => $this->input->post('tipo'),
                    'created_at' => date('Y-m-d : h:m:s'),
                    'updated_at' => date('Y-m-d : h:m:s'),
                    'nome_imagem' => $file_tipo,
                );
                $data = $this->security->xss_clean($data);
                $result = $this->tipo_model->add_tipo($data);
                if ($result) {
                    $this->session->set_flashdata('success', 'Tipo adicionado com sucesso!');
                    redirect(base_url('admin/tipos'));
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

                    $this->session->set_flashdata('success', 'tipo foi atualizado com sucesso!');

                    redirect(base_url('admin/tipos'));
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

}

?>