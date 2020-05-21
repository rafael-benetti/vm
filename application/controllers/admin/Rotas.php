<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Rotas extends MY_Controller {

    public function __construct() {

        parent::__construct();
        auth_check(); // check login auth
        $this->rbac->check_module_access();
        $this->load->model('admin/rotas_model', 'rotas_model');
        $this->load->model('admin/user_model', 'user_model');
        $this->load->model('admin/ponto_model', 'ponto_model');
        $this->load->model('admin/machine_model', 'machine_model');
    }

    //-----------------------------------------------------------
    public function index() {
        $this->db->select('*');
        $array_rotas = array();
        $rotas = $this->db->get('ci_rotas')->result();
        
        
        
        foreach($rotas as $rota){
            $dados['rotas'][] = array('rota'=>$rota,'pontos'=>$this->rotas_model->get_pontos_by_rota_id($rota->id));
            
        }
        
       
        
       
        $this->load->view('admin/includes/_header');
        $this->load->view('admin/rotas/rotas_list', $dados);
        $this->load->view('admin/includes/_footer');
    }

    public function ver_maquinas($user_id) {

        $where_pontos = array('is_active' => 1);
        if ($this->is_supper == "0") {
            $where_pontos = array(
                'admin_id' => $this->admin_id,
                'is_active' => 1
            );
        }
        $dados['pontos'] = $this->ponto_model->getTodosPontos($where_pontos);


        $dados['user'] = $this->user_model->get_user_by_id($user_id);
        $dados['user_id'] = $user_id;
        $this->load->view('admin/includes/_header');
        $this->load->view('admin/users/user_list_maquinas', $dados);
        $this->load->view('admin/includes/_footer');
    }

    public function get_machines() {

        $ponto_id = $this->input->post('pontodevenda');

        $maquinas = $this->machine_model->get_machine_by_ponto($ponto_id);

        foreach ($maquinas as $maquina) {
            echo '<option value =' . $maquina['id_maquina'] . '>' . $maquina['nome_tipo'] . ' (' . $maquina['observacoes_equip'] . ')</option>';
        }

        exit;
    }

    public function add_rotas() {

        if ($this->input->post('submit')) {

            $this->form_validation->set_rules('ponto_id', 'required');

            if ($this->form_validation->run() == TRUE) {

                $data = array(
                    'errors' => validation_errors()
                );

                $this->session->set_flashdata('errors', $data['errors']);

                redirect(base_url('admin/rotas'), 'refresh');
            } else {

                $pontos = $this->input->post('ponto_id');
                $rota = $this->input->post('rota');

                $rota_id = $this->rotas_model->add_rota(array('nome' => $rota,
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s')
                        ));

                if ($rota_id > 0) {

                    $result = 0;
                    foreach ($pontos as $ponto) {

                        $data_rota_ponto = array(
                            'ponto_id' => $ponto,
                            'rota_id' => $rota_id);
                        if ($this->rotas_model->add_rota_ponto($data_rota_ponto)) {
                            $result++;
                        }
                    }


                    if ($result > 0) {
                        $this->session->set_flashdata('success', 'rota adicionada com sucesso!');

                        redirect(base_url('admin/rotas'), 'refresh');
                    }
                }
            }
        }
    }

    public function datatable_rotas_json() {
        $records = $this->rotas_model->get_all_rotas();
        $data = array();

        foreach ($records['data'] as $row) {
            $data[] = array(
                $row['rota_id'],
                $row['nome'],
                $row['ponto'],
                $row['nome'],
            );
        }
        $records['data'] = $data;
        echo json_encode($records);
    }

}

?>