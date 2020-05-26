<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Rotas extends MY_Controller {

    private $modulo_name = 'rotas';

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


        $where_pontos = array('is_active' => 1);
        if ($this->is_supper == "0") {
            $where_pontos = array(
                'user_id' => $this->admin_id,
                'is_active' => 1
            );
        }
        $dados['pontos'] = $this->ponto_model->getTodosPontos($where_pontos);


        $this->load->view('admin/includes/_header');
        $this->load->view('admin/rotas/rotas_list', $dados);
        $this->load->view('admin/includes/_footer');
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

                $nomes_ponto = array();

                foreach ($pontos as $ponto) {

                    $where_pontos = array(
                        'is_active' => 1,
                        'id' => $ponto);

                    if ($this->is_supper == "0") {
                        $where_pontos = array(
                            'user_id' => $this->session->userdata('admin_id'),
                            'is_active' => 1,
                            'id' => $ponto
                        );
                    }

                    $nomes_ponto[] = $this->ponto_model->getPontosName($where_pontos);
                }


        

                $rota = $this->input->post('rota');
                $operador = $this->user_model->get_user_by_id($this->session->userdata('admin_id'));

                $rota_id = $this->rotas_model->add_rota(array(
                    'nome' => $rota,
                    'created_at' => date('Y-m-d H:i:s'),
                    'user_id' => $this->session->userdata('admin_id'),
                    'pontos' => implode(',', $nomes_ponto),
                    'operador' => $operador[0]['firstname'].' '.$operador[0]['lastname'],
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

    public function datatable_json() {


        if ($this->session->userdata('is_supper') == 1) {
            $where = array();
            $where_pontos = array('is_active' => 1);
        } else {
            $where = array('OP.user_id = ' . $this->session->userdata('admin_id'));
            $where_pontos = array(
                'admin_id' => $this->admin_id,
                'is_active' => 1
            );
        }

        $records = $this->rotas_model->get_all_rotas($where);
        $data = array();

        foreach ($records['data'] as $row) {


            $pontos_array = $this->rotas_model->get_pontos_by_rota_id($row['id']);

            $status = ($row['is_active'] == 1) ? 'checked' : '';


            if (verifica_permissao($this->modulo_name, 'view'))
                $view = '<a title="Visualizar" class="delete btn btn-sm btn-info" href=' . base_url("admin/rotas/visualizar/" . $row['id']) . ' title="Visualizar"><i class="fa fa-eye"></i></a>';

            if (verifica_permissao($this->modulo_name, 'edit'))
                $edit = '<a title="Edit" class="update btn btn-sm btn-warning" href="' . base_url('admin/rotas/edit/' . $row['id']) . '"> <i class="fa fa-pencil-square-o"></i></a>';

            if (verifica_permissao($this->modulo_name, 'delete'))
                $delete = '<a title="Delete" class="delete btn btn-sm btn-danger" href=' . base_url("admin/rotas/delete/" . $row['id']) . ' title="Delete" onclick="return confirm(\'Deseja realmente apagar?\')"> <i class="fa fa-trash-o"></i></a>';

            if (verifica_permissao($this->modulo_name, 'change_status')) {
                $bnt_status = '<input type="checkbox" class="tgl_checkbox tgl-ios" data-id="' . $row['id'] . '" id="cb_' . $row['id'] . '" ' . $status . '><label for="cb_' . $row['id'] . '"></label>';
            } else {
                if ($status)
                    $bnt_status = 'Ativo';
                else
                    $bnt_status = 'Desativado';
            }


            $ponto = '';
            foreach ($pontos_array as $ponto_result) {
                $ponto .= $ponto_result['ponto'] . ', ';
            }




            $data[] = array(
                $row['id'],
                $row['firstname'].' '.$row['lastname'],
                $row['nome'],
                $ponto
            );
        }
        $records['data'] = $data;
        echo json_encode($records);
 
    }

}

?>