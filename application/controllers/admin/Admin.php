<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller {

    function __construct() {

        parent::__construct();
        auth_check(); // check login auth
        $this->rbac->check_module_access();
        $this->load->model('admin/admin_model', 'admin');
          $this->load->model('admin/operar_model', 'operar_model');
          $this->load->model('admin/machine_model', 'machine_model');
          $this->load->model('admin/ponto_model', 'ponto_model');
        $this->admin_id = (int) $this->session->userdata('admin_id');
    }

    //-----------------------------------------------------		
    function index($type = '') {

        $this->session->set_userdata('filter_type', $type);
        $this->session->set_userdata('filter_keyword', '');
        $this->session->set_userdata('filter_status', '');

        $data['admin_roles'] = $this->admin->get_admin_roles();

        $this->load->view('admin/includes/_header');
        $this->load->view('admin/admin/index', $data);
        $this->load->view('admin/includes/_footer');
    }

    //---------------------------------------------------------
    function filterdata() {

        $this->session->set_userdata('filter_type', $this->input->post('type'));
        $this->session->set_userdata('filter_status', $this->input->post('status'));
        $this->session->set_userdata('filter_keyword', $this->input->post('keyword'));
    }

    //--------------------------------------------------		
    function list_data() {

        $data['info'] = $this->admin->get_all();
        $this->load->view('admin/admin/list', $data);
    }

    //-----------------------------------------------------------
    function change_status() {

        $this->rbac->check_operation_access(); // check opration permission

        $this->admin->change_status();
    }

    //--------------------------------------------------
    function add($tipo = '1') {

        $this->rbac->check_operation_access(); // check opration permission

        $data['admin_roles'] = $this->admin->get_admin_roles();

        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('username', 'Username', 'trim|alpha_numeric|is_unique[ci_admin.username]|required');
            $this->form_validation->set_rules('firstname', 'Firstname', 'trim|required');
            $this->form_validation->set_rules('lastname', 'Lastname', 'trim|required');
            $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');
            $this->form_validation->set_rules('mobile_no', 'Number', 'trim|required');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');
            $this->form_validation->set_rules('role', 'Role', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
                $data = array(
                    'errors' => validation_errors()
                );
                $this->session->set_flashdata('errors', $data['errors']);
                redirect(base_url('admin/admin/add'), 'refresh');
            } else {
                $data = array(
                    'admin_role_id' => $this->input->post('role'),
                    'username' => $this->input->post('username'),
                    'firstname' => $this->input->post('firstname'),
                    'lastname' => $this->input->post('lastname'),
                    'email' => $this->input->post('email'),
                    'mobile_no' => $this->input->post('mobile_no'),
                    'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
                    'is_active' => 1,
                    'created_at' => date('Y-m-d : h:m:s'),
                    'updated_at' => date('Y-m-d : h:m:s'),
                );
                $data = $this->security->xss_clean($data);
                $result = $this->admin->add_admin($data);
                if ($result) {
                    $this->session->set_flashdata('success', 'Cadastro realizado com sucesso!');
                    redirect(base_url('admin/admin'));
                }
            }
        } else {
            $data['tipo'] = $tipo;
            $this->load->view('admin/includes/_header', $data);
            $this->load->view('admin/admin/add');
            $this->load->view('admin/includes/_footer');
        }
    }

    //--------------------------------------------------
    function edit($id = "") {

        $this->rbac->check_operation_access(); // check opration permission

        $data['admin_roles'] = $this->admin->get_admin_roles();

        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('username', 'Username', 'trim|alpha_numeric|required');
            $this->form_validation->set_rules('firstname', 'Firstname', 'trim|required');
            $this->form_validation->set_rules('lastname', 'Lastname', 'trim|required');
            $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');
            $this->form_validation->set_rules('mobile_no', 'Number', 'trim|required');
            $this->form_validation->set_rules('role', 'Role', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
                $data = array(
                    'errors' => validation_errors()
                );
                $this->session->set_flashdata('errors', $data['errors']);
                redirect(base_url('admin/admin/edit/' . $id), 'refresh');
            } else {
                $data = array(
                    'admin_role_id' => $this->input->post('role'),
                    'username' => $this->input->post('username'),
                    'firstname' => $this->input->post('firstname'),
                    'lastname' => $this->input->post('lastname'),
                    'email' => $this->input->post('email'),
                    'mobile_no' => $this->input->post('mobile_no'),
                    'is_active' => 1,
                    'updated_at' => date('Y-m-d : h:m:s'),
                );
                if ($this->input->post('password') != '') {

                    $data['password'] = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
                }


                $data = $this->security->xss_clean($data);
                $result = $this->admin->edit_admin($data, $id);

                if ($result) {
                    $this->session->set_flashdata('success', 'Usuario atualizado com sucesso');
                    redirect(base_url('admin/admin'));
                }
            }
        } elseif ($id == "") {
            redirect('admin/admin');
        } else {
            $data['admin'] = $this->admin->get_admin_by_id($id);

            $this->load->view('admin/includes/_header');
            $this->load->view('admin/admin/edit', $data);
            $this->load->view('admin/includes/_footer');
        }
    }

    function view($id = "") {

        $this->rbac->check_operation_access(); // check opration permission
       
        $data['detalhes'] = $this->admin->get_admin_by_id($id);
        $data['maquinas'] = $this->machine_model->get_machines_by_user($this->admin_id);
        $data['operacoes'] = $this->operar_model->get_operacoes_by_user($this->admin_id);
        $this->load->view('admin/includes/_header');
        $this->load->view('admin/admin/view', $data);
        $this->load->view('admin/includes/_footer');
        
        
    }

    //--------------------------------------------------
    function check_username($id = 0) {

        $this->db->from('admin');
        $this->db->where('username', $this->input->post('username'));
        $this->db->where('admin_id !=' . $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0)
            echo 'false';
        else
            echo 'true';
    }

    //------------------------------------------------------------
    function delete($id = '') {

        if ($id == 1) {
            return;
        }

        $this->rbac->check_operation_access(); // check opration permission

        $this->admin->delete($id);
        $this->session->set_flashdata('success', 'Usuario apagado com sucesso.');
        redirect('admin/admin');
    }

}

?>