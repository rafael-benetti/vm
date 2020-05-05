<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Categorias extends MY_Controller {

    public function __construct() {
        parent::__construct();
        auth_check(); // check login auth
        $this->rbac->check_module_access();
        $this->load->model('admin/categorias_model', 'categorias_model');
    }

    //-----------------------------------------------------------

    public function index() {
        $this->load->view('admin/includes/_header');
        $this->load->view('admin/categorias/cat_list');
        $this->load->view('admin/includes/_footer');
    }

    public function datatable_json(){				   					   
		$records = $this->categorias_model->get_all_categorias();
		$data = array();
		$i=0;
		foreach ($records['data']  as $row) {  
			$status = ($row['is_active'] == 1)? 'checked': '';
			$data[]= array(
				$row['id'],
				$row['categorias'],
				'<input class="tgl_checkbox tgl-ios" 
				data-id="'.$row['id'].'" 
				id="cb_'.$row['id'].'"
				type="checkbox"  
				'.$status.'><label for="cb_'.$row['id'].'">
                                </label>',		
                                '<!--<a title="View" class="view btn btn-sm btn-info" href="'.base_url('admin/categorias/edit/'.$row['id']).'"> <i class="fa fa-eye"></i></a>-->
                                 <a title="Edit" class="update btn btn-sm btn-warning" href="'.base_url('admin/categorias/edit/'.$row['id']).'"> <i class="fa fa-pencil-square-o"></i></a>
				<a title="Delete" class="delete btn btn-sm btn-danger" href='.base_url("admin/categorias/delete/".$row['id']).' title="Delete" onclick="return confirm(\'Tem certeza que deseja apagar ?\')"> <i class="fa fa-trash-o"></i></a>'
			);
		}
		$records['data']=$data;
		echo json_encode($records);						   
	}

    //-----------------------------------------------------------
    function change_status() {
        $this->categorias_model->change_status();
    }

    //---------------------------------------------------------------
    public function add() {
        $this->rbac->check_operation_access(); // check opration permission
        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('categorias', 'Categorias', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
                $data = array(
                    'errors' => validation_errors()
                );
                $this->session->set_flashdata('errors', $data['errors']);
                redirect(base_url('admin/categorias'), 'refresh');
            } else {
                $data = array(
                    'categorias' => $this->input->post('categorias'),
                    'created_at' => date('Y-m-d : h:m:s'),
                    'updated_at' => date('Y-m-d : h:m:s'),
                );

                $data = $this->security->xss_clean($data);
                $result = $this->categorias_model->add_categorias($data);
                if ($result) {
                    $this->session->set_flashdata('success', 'categoria adicionado com sucesso!');
                    redirect(base_url('admin/categorias'));
                }
            }
        } else {
            $this->load->view('admin/includes/_header');
            $this->load->view('admin/categorias/cat_add');
            $this->load->view('admin/includes/_footer');
        }
    }

    //---------------------------------------------------------------
    public function edit($id = 0) {
        $this->rbac->check_operation_access(); // check opration permission
        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('categorias', 'Categorias', 'trim|required');
            $this->form_validation->set_rules('status', 'Status', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
                $data = array(
                    'errors' => validation_errors()
                );
                $this->session->set_flashdata('errors', $data['errors']);
                redirect(base_url('admin/categorias/cat_edit/' . $id), 'refresh');
            } else {
                $data = array(
                    'categorias' => $this->input->post('categorias'),
                    'is_active' => $this->input->post('status'),
                    'updated_at' => date('Y-m-d : h:m:s'),
                );
                $data = $this->security->xss_clean($data);
                $result = $this->categorias_model->edit_categorias($data, $id);
                if ($result) {
                    $this->session->set_flashdata('success', 'Categoria atualizado com sucesso!');
                    redirect(base_url('admin/categorias'));
                }
            }
        } else {
            $data['categorias'] = $this->categorias_model->get_categorias_by_id($id);
            $this->load->view('admin/includes/_header');
            $this->load->view('admin/categorias/cat_edit', $data);
            $this->load->view('admin/includes/_footer');
        }
    }

    //---------------------------------------------------------------
    public function delete($id = 0) {
        $this->rbac->check_operation_access(); // check opration permission
        $this->db->delete('ci_catfin', array('id' => $id));
        $this->session->set_flashdata('success', 'categoria apagada com sucesso!');
        redirect(base_url('admin/categorias'));
    }

    //  Export categorias PDF 
    public function create_categorias_pdf() {
        $this->load->helper('pdf_helper'); // loaded pdf helper
        $data['all_categorias'] = $this->categorias_model->get_categorias_for_export();
        $this->load->view('admin/categorias/categorias_pdf', $data);
    }

    // Export data in CSV format 
    public function export_csv() {
        // file name 
        $filename = 'categorias_' . date('Y-m-d') . '.csv';
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Type: application/csv; ");
        // get data 
        $categorias_data = $this->categorias_model->get_categorias_for_export();
        // file creation 
        $file = fopen('php://output', 'w');
        $header = array("ID", "Categorias", "Created Date");
        fputcsv($file, $header);
        foreach ($categorias_data as $key => $line) {
            fputcsv($file, $line);
        }
        fclose($file);
        exit;
    }

}

?>