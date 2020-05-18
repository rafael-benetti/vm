<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Controller {

    public function __construct() {

        parent::__construct();
        auth_check(); // check login auth
        $this->rbac->check_module_access();

        $this->load->model('admin/user_model', 'user_model');
        $this->load->model('admin/ponto_model', 'ponto_model');
        $this->load->model('admin/machine_model', 'machine_model');
                $this->load->model('admin/admin_model', 'admin');

    }

    //-----------------------------------------------------------
    public function index() {

        $this->load->view('admin/includes/_header');
        $this->load->view('admin/users/user_list');
        $this->load->view('admin/includes/_footer');
    }
    
    public function ver_maquinas($user_id) {

 
    
                $where_pontos = array(
                    'is_active' => 1,
                    'user_id'=>$user_id
                );
         
        $dados['pontos'] = $this->ponto_model->getTodosPontos($where_pontos);

        
        $dados['user'] = $this->admin->get_admin_by_id($user_id);
        $dados['user_id'] = $user_id;
        $this->load->view('admin/includes/_header');
        $this->load->view('admin/users/user_list_maquinas', $dados);
        $this->load->view('admin/includes/_footer');
    }
    public function get_machines() {

        $ponto_id = $this->input->post('pontodevenda');
        
        $maquinas= $this->machine_model->get_machine_by_ponto($ponto_id);
     
        foreach($maquinas as $maquina){
        echo '<option value ='.$maquina['id_maquina'].'>'.$maquina['nome_tipo'].' ('.$maquina['serial'].')</option>';
        }
        
       exit;
    }
    
    
     public function add_machines($user_id) {
      
         if ($this->input->post('submit')) {
       
            $this->form_validation->set_rules('id_maquina', 'required');
          
            if ($this->form_validation->run() == TRUE) {

                $data = array(
                    'errors' => validation_errors()
                );

                $this->session->set_flashdata('errors', $data['errors']);

                redirect(base_url('admin/users/ver_maquinas/'.$user_id), 'refresh');
            } else {
                
                    $machines_user = $this->input->post('machines');
                    $pontodevenda= $this->input->post('pontodevenda');



                    $this->user_model->delete_user_machines($user_id,$pontodevenda );

                    $result = 0;
                    foreach ($machines_user as $machine) {
                        
                        $data_users_machines = array(
                            'ponto_id' => $pontodevenda,
                            'user_id' => $user_id,
                            'maq_id' => $machine,
                            
                        );
                        if($this->user_model->add_user_machine($data_users_machines)){
                            $result++;
                        }
                    }
                
                
                if ($result > 0) {
                     $this->session->set_flashdata('success', 'maquina cadastrada com sucesso!');
                 
                    redirect(base_url('admin/users/ver_maquinas/'.$user_id), 'refresh');
                }
            }
        }


        $this->load->view('admin/includes/_header');

        $where_tipos = array('is_active' => 1);
        $where_pontos = array('is_active' => 1);
        
        
        if ($this->is_supper == 1) {
            
            
            $where_tipos = array('is_active' => 1);
        $where_pontos = array('is_active' => 1);
        }else{
            
            $where_tipos = array(
                'user_id' => $this->admin_id,
                'is_active' => 1
            );
            $where_pontos = array(
                'user_id' => $this->admin_id,
                'is_active' => 1
            );
        }
     
        $dados['tipos'] = $this->tipo_model->getTodosTipos($where_tipos);
        $dados['pontos'] = $this->ponto_model->getTodosPontos($where_pontos);
        $dados['item'] = $this->item_model->getTodosItens();
        $this->load->view('admin/machines/machine_add', $dados);
        $this->load->view('admin/includes/_footer');
    }
    
    
    public function datatable_user_maquinas_json($user_id) {

        //$pontos_id = $this->user_model->getPontosByUserId($user_id);
        //var_dump();
        
        $records = $this->user_model->get_user_machines($user_id);
        $data = array();      

        foreach ($records['data'] as $row) {

          
            $data[] = array(
                $row['id'],
                $row['nome_ponto'] ,
                $row['nome_tipo'].' - '.$row['serial'],
                '<a title="Delete" class="delete btn btn-sm btn-danger" href=' . base_url("admin/users/delete_machine/" . $row['id'].'/'. $row['maq_id']) . ' title="Delete" onclick="return confirm(\'Apagar maquina ?\')"> <i class="fa fa-trash-o"></i></a>'
            );
        }
        $records['data'] = $data;
        echo json_encode($records);
    }

    public function datatable_json() {
        $records = $this->admin->get_all_operadores();
        $data = array();
        
                  


        foreach ($records['data'] as $row) {
              $qtde_maquinas = $this->user_model->get_total_machines_user($row['id']);
            $status = ($row['is_active'] == 1) ? 'checked' : '';
            $data[] = array(
       
                $row['id'],
                $row['username'],
                $row['email'],
                $row['mobile_no'],
                inverteDataHora($row['created_at']),
                '<a title="View" class="view btn btn-sm btn-info" href="' . base_url('admin/users/ver_maquinas/' . $row['id']) . '"> <i class="fa fa-list"></i> ('.$qtde_maquinas.') </a>',
             
                '<input class="tgl_checkbox tgl-ios" 
				data-id="' . $row['id'] . '" 
				id="cb_' . $row['id'] . '"
				type="checkbox"  
				' . $status . '><label for="cb_' . $row['id'] . '"></label>',
                '<a title="Edit" class="update btn btn-sm btn-warning" href="' . base_url('admin/admin/edit/' . $row['id']) . '"> <i class="fa fa-pencil-square-o"></i></a>
				<a title="Delete" class="delete btn btn-sm btn-danger" href=' . base_url("admin/users/delete/" . $row['id']) . ' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> <i class="fa fa-trash-o"></i></a>'
            );
        }
        $records['data'] = $data;
        echo json_encode($records);
    }

    //-----------------------------------------------------------
    function change_status() {
        $this->admin->change_status();
    }

    //---------------------------------------------------------------
    public function add() {

        $this->rbac->check_operation_access(); // check opration permission

        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('username', 'Username', 'trim|required');
            $this->form_validation->set_rules('firstname', 'Firstname', 'trim|required');
            $this->form_validation->set_rules('lastname', 'Lastname', 'trim|required');
            $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');
            $this->form_validation->set_rules('mobile_no', 'Number', 'trim|required');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');

            if ($this->form_validation->run() == FALSE) {
                $data = array(
                    'errors' => validation_errors()
                );
                $this->session->set_flashdata('errors', $data['errors']);
                redirect(base_url('admin/users/add'), 'refresh');
            } else {
                $data = array(
                    'username' => $this->input->post('username'),
                    'firstname' => $this->input->post('firstname'),
                    'lastname' => $this->input->post('lastname'),
                    'email' => $this->input->post('email'),
                    'mobile_no' => $this->input->post('mobile_no'),
                    'address' => $this->input->post('address'),
                    'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
                    'created_at' => date('Y-m-d : h:m:s'),
                       'profile_id' => $this->input->post('profile_id'),
                    'updated_at' => date('Y-m-d : h:m:s'),
                );
                $data = $this->security->xss_clean($data);
                $result = $this->user_model->add_user($data);
                if ($result) {
                    
                     $users_pontos = $this->input->post('users_pontos');


                    $this->user_model->delete_user_ponto($result);

                    foreach ($users_pontos as $ponto) {
                        $data_users_pontos = array(
                            'ponto_id' => $ponto,
                            'user_id' => $result
                        );
                        $this->user_model->add_user_ponto($data_users_pontos);
                    }
                    
                    $this->session->set_flashdata('success', 'Usuario adicionado com sucesso');
                    redirect(base_url('admin/users'));
                }
            }
        } else {
            
            
          
            
           //   $data['pontos'] = $this->ponto_model->getTodosPontos($where_pontos);
              $data['perfis'] = $this->user_model->getAllProfile();
            
            $this->load->view('admin/includes/_header');
            $this->load->view('admin/users/user_add', $data);
            $this->load->view('admin/includes/_footer');
        }
    }

    //---------------------------------------------------------------
    public function edit($id = 0) {

        $this->rbac->check_operation_access(); // check opration permission

        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('username', 'Username', 'trim|required');
            $this->form_validation->set_rules('firstname', 'Username', 'trim|required');
            $this->form_validation->set_rules('lastname', 'Lastname', 'trim|required');
            $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');
            $this->form_validation->set_rules('mobile_no', 'Number', 'trim|required');
            $this->form_validation->set_rules('status', 'Status', 'trim|required');
                        $this->form_validation->set_rules('password', 'Password', 'trim');

            if ($this->form_validation->run() == FALSE) {
                $data = array(
                    'errors' => validation_errors()
                );
                $this->session->set_flashdata('errors', $data['errors']);
                redirect(base_url('admin/users/edit/' . $id), 'refresh');
            } else {
                $data = array(
                    'username' => $this->input->post('username'),
                    'firstname' => $this->input->post('firstname'),
                    'lastname' => $this->input->post('lastname'),
                    'email' => $this->input->post('email'),
                    'mobile_no' => $this->input->post('mobile_no'),
                    'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
                    'is_active' => $this->input->post('status'),
                    'profile_id' => $this->input->post('profile_id'),
                    'updated_at' => date('Y-m-d : h:m:s'),
                );
                
                if($this->input->post('password')!=''){
                    
                    $data['password'] = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
                }
                
              
                
                $data = $this->security->xss_clean($data);
                $result = $this->user_model->edit_user($data, $id);

                if ($result) {


                    /*

                    $users_pontos = $this->input->post('users_pontos');


                    $this->user_model->delete_user_ponto($id);

                    foreach ($users_pontos as $ponto) {
                        $data_users_pontos = array(
                            'ponto_id' => $ponto,
                            'user_id' => $id
                        );
                        $this->user_model->add_user_ponto($data_users_pontos);
                    }
                     * 
                     */




                    $this->session->set_flashdata('success', 'usuario atualizado com sucesso!');
                    redirect(base_url('admin/users'));
                }
            }
        } else {


            $where_pontos = array('is_active' => 1);
            if ($this->is_supper == "0") {
                $where_pontos = array(
                    'admin_id' => $this->admin_id,
                    'is_active' => 1
                );
            }
            
             $data['perfis'] = $this->user_model->getAllProfile();
            $data['pontos'] = $this->ponto_model->getTodosPontos($where_pontos);
            
        
            
          //  $data['users_pontos'] = $this->user_model->getPontosByUserId($id);

            $data['user'] = $this->user_model->get_user_by_id($id);

            $this->load->view('admin/includes/_header');
            $this->load->view('admin/users/user_edit', $data);
            $this->load->view('admin/includes/_footer');
        }
    }

    //---------------------------------------------------------------
    public function delete($id = 0) {
        $this->rbac->check_operation_access(); // check opration permission

        $this->db->delete('ci_users', array('id' => $id));
        $this->session->set_flashdata('success', 'Usuario apagado com sucesso');
        redirect(base_url('admin/users'));
    }
    
     public function delete_machine($id, $maq_id) {
        $this->rbac->check_operation_access(); // check opration permission

        $this->db->delete('ci_users_machines', array('id' => $id));
        $this->session->set_flashdata('success', 'maquina apagado com sucesso');
        redirect(base_url('admin/users/ver_maquinas/'.$maq_id));
    }

    //---------------------------------------------------------------
    //  Export Users PDF 
    public function create_users_pdf() {

        $this->load->helper('pdf_helper'); // loaded pdf helper
        $data['all_users'] = $this->user_model->get_users_for_export();
        $this->load->view('admin/users/users_pdf', $data);
    }

    //---------------------------------------------------------------	
    // Export data in CSV format 
    public function export_csv() {

        // file name 
        $filename = 'users_' . date('Y-m-d') . '.csv';
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Type: application/csv; ");

        // get data 
        $user_data = $this->user_model->get_users_for_export();

        // file creation 
        $file = fopen('php://output', 'w');

        $header = array("ID", "Username", "First Name", "Last Name", "Email", "Mobile_no", "Created Date");

        fputcsv($file, $header);
        foreach ($user_data as $key => $line) {
            fputcsv($file, $line);
        }
        fclose($file);
        exit;
    }

}

?>