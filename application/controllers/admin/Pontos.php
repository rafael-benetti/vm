<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pontos extends MY_Controller {

    private $modulo_name = 'ponto';

    public function __construct() {


        parent::__construct();
        auth_check(); // check login auth
        $this->rbac->check_module_access();
        $this->load->model('admin/user_model', 'user_model');
        $this->load->model('admin/ponto_model', 'ponto_model');
    }

    //-----------------------------------------------------------

    public function index() {



        $this->load->view('admin/includes/_header');

        $this->load->view('admin/pontos/ponto_list');

        $this->load->view('admin/includes/_footer');
    }

    public function datatable_json() {



        if ($this->session->userdata('is_supper') == 1) {
            $records = $this->ponto_model->get_all_pontos();
        } else {

            $records = $this->ponto_model->get_all_pontos($this->session->userdata('admin_id'));
        }


        $data = array();




        $i = 0;

        foreach ($records['data'] as $row) {


            $status = ($row['is_active'] == 1) ? 'checked' : '';
            $bnt_status = '';

            $operador = $this->user_model->getUserByPonto($row['user_id']);
            $dados_operador = '';
            
            if($operador)
             $dados_operador = $operador[0]['firstname'] . ' ' . $operador[0]['lastname'];
            







            if (verifica_permissao($this->modulo_name, 'edit'))
                $edit = '<a title="Edit" class="update btn btn-sm btn-warning" href="' . base_url('admin/pontos/edit/' . $row['id']) . '"> <i class="fa fa-pencil-square-o"></i></a>&nbsp;';

            if (verifica_permissao($this->modulo_name, 'delete'))
                $delete = '<a title="Delete" class="delete btn btn-sm btn-danger" href=' . base_url("admin/pontos/delete/" . $row['id']) . ' title="Delete" onclick="return confirm(\'Deseja realmente apagar ?\')"> <i class="fa fa-trash-o"></i></a>';

            if (verifica_permissao($this->modulo_name, 'change_status')) {
                $bnt_status = '<input class="tgl_checkbox tgl-ios" 

				data-id="' . $row['id'] . '" 

				id="cb_' . $row['id'] . '"

				type="checkbox"  

				' . $status . '><label for="cb_' . $row['id'] . '"></label>';
            } else {
                if ($status)
                    $bnt_status = 'Ativo';
                else
                    $bnt_status = 'Desativado';
            }


            $data[] = array(
                $row['id'],
                $row['ponto'],
                $dados_operador,
                $row['email'],
                $row['telefone'],
                inverteDataHora($row['created_at']),
                $bnt_status,
                @$delete . @$edit
            );
        }

        $records['data'] = $data;

        echo json_encode($records);
    }

    //-----------------------------------------------------------

    function change_status() {

        $this->ponto_model->change_status();
    }

    //---------------------------------------------------------------

    public function add() {


        if (!verifica_permissao($this->modulo_name, 'add')) {
            redirect('access_denied/index/');
        }





        if ($this->input->post('submit')) {
            $numero = $this->input->post('numero');
            $logradouro = $this->input->post('endereco');
            $bairro = $this->input->post('bairro');
            $cidade = $this->input->post('cidade');
            $uf = $this->input->post('estado');
            $apiKey = "AIzaSyDp6K-uwKI_vZYmaB3KPKnmlGlYxS-pXrQ";



            $endereco = $numero . " + " . $logradouro . " + " . $bairro . " + " . $cidade . " + " . $uf;



            // chamada da url do googleapi.
            $geo = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?key=' . $apiKey . '&address=' . urlencode($endereco) . '&sensor=false');


// converte o JSON para um array
            $geo = json_decode($geo, true);

            if ($geo['status'] == 'OK') {
                // capturando a latitude e longitude do arquivo json e colocando numa variavel.
                $latitude = $geo['results'][0]['geometry']['location']['lat'];
                $longitude = $geo['results'][0]['geometry']['location']['lng'];
            }





            $this->form_validation->set_rules('ponto', 'Ponto', 'trim|required');



            $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');

            $this->form_validation->set_rules('comissao', 'comissao', 'trim|required');

            $this->form_validation->set_rules('responsavel', 'responsavel', 'trim|required');

            $this->form_validation->set_rules('telefone', 'telefone', 'trim|required');

            $this->form_validation->set_rules('endereco', 'endereco', 'trim|required');

            $this->form_validation->set_rules('numero', 'numero', 'trim|required');

            $this->form_validation->set_rules('cidade', 'cidade', 'trim|required');

            $this->form_validation->set_rules('estado', 'estado', 'trim|required');





            if ($this->form_validation->run() == FALSE) {

                $data = array(
                    'errors' => validation_errors()
                );

                $this->session->set_flashdata('errors', $data['errors']);

                redirect(base_url('admin/pontos/add'), 'refresh');
            } else {

                $data = array(
                    'ponto' => $this->input->post('ponto'),
                    'email' => $this->input->post('email'),
                    'comissao' => $this->input->post('comissao'),
                    'responsavel' => $this->input->post('responsavel'),
                    'telefone' => $this->input->post('telefone'),
                    'endereco' => $this->input->post('endereco'),
                    'numero' => $this->input->post('numero'),
                    'cidade' => $this->input->post('cidade'),
                    'estado' => $this->input->post('estado'),
                    'latitude' => $latitude,
                    'longitude' => $longitude,
                    'user_id' => $this->session->userdata('admin_id'),
                    'bairro' => $this->input->post('bairro'),
                    'tipo_comissao' => $this->input->post('tipo_comissao'),
                    'cep' => $this->input->post('cep'),
                    'created_at' => date('Y-m-d h:i:s'),
                    'updated_at' => date('Y-m-d h:i:s'),
                    'is_active' => $this->input->post('is_active')
                );


                $data = $this->security->xss_clean($data);

                $result = $this->ponto_model->add_ponto($data);

                if ($result) {

                    $this->session->set_flashdata('success', 'Ponto adicionado com sucesso!');

                    redirect(base_url('admin/pontos'));
                }
            }
        } else {

            $dados['operadores'] = $this->user_model->getAllUsers();

            $this->load->view('admin/includes/_header');

            $this->load->view('admin/pontos/ponto_add', $dados);

            $this->load->view('admin/includes/_footer');
        }
    }

    //---------------------------------------------------------------

    public function edit($id = 0) {



        if (!verifica_permissao($this->modulo_name, 'edit')) {
            redirect('access_denied/index/');
        }



        if ($this->input->post('submit')) {
            $numero = $this->input->post('numero');
            $logradouro = $this->input->post('endereco');
            $bairro = $this->input->post('bairro');
            $cidade = $this->input->post('cidade');
            $uf = $this->input->post('estado');
            $apiKey = "AIzaSyDp6K-uwKI_vZYmaB3KPKnmlGlYxS-pXrQ";



            $endereco = $numero . " + " . $logradouro . " + " . $bairro . " + " . $cidade . " + " . $uf;



            // chamada da url do googleapi.
            $geo = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?key=' . $apiKey . '&address=' . urlencode($endereco) . '&sensor=false');


// converte o JSON para um array
            $geo = json_decode($geo, true);

            if ($geo['status'] == 'OK') {
                // capturando a latitude e longitude do arquivo json e colocando numa variavel.
                $latitude = $geo['results'][0]['geometry']['location']['lat'];
                $longitude = $geo['results'][0]['geometry']['location']['lng'];
            }


            $this->form_validation->set_rules('ponto', 'Ponto', 'trim|required');

            $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');
            $this->form_validation->set_rules('responsavel', 'Responsavel', 'trim|required');
            $this->form_validation->set_rules('telefone', 'Telefone', 'trim|required');
            $this->form_validation->set_rules('endereco', 'Endereco', 'trim|required');
            $this->form_validation->set_rules('numero', 'Numero', 'trim|required');
            $this->form_validation->set_rules('cidade', 'Cidade', 'trim|required');
            $this->form_validation->set_rules('estado', 'Estado', 'trim|required');
            $this->form_validation->set_rules('status', 'Status', 'trim|required');



            if ($this->form_validation->run() == TRUE) {

                $data = array(
                    'errors' => validation_errors()
                );

                $this->session->set_flashdata('errors', $data['errors']);

                redirect(base_url('admin/pontos/ponto_edit/' . $id), 'refresh');
            } else {

                $data = array(
                    'ponto' => $this->input->post('ponto'),
                    'email' => $this->input->post('email'),
                    'user_id' => $this->input->post('user_id'),
                    'responsavel' => $this->input->post('responsavel'),
                    'telefone' => $this->input->post('telefone'),
                    'endereco' => $this->input->post('endereco'),
                    'numero' => $this->input->post('numero'),
                    'cidade' => $this->input->post('cidade'),
                    'estado' => $this->input->post('estado'),
                    'is_active' => $this->input->post('status'),
                    'latitude' => $latitude,
                    'longitude' => $longitude,
                    'bairro' => $this->input->post('bairro'),
                    'tipo_comissao' => $this->input->post('tipo_comissao'),
                    'cep' => $this->input->post('cep'),
                    'is_active' => $this->input->post('is_active'),
                    'updated_at' => date('Y-m-d : h:m:s'),
                );

                $data = $this->security->xss_clean($data);

                $result = $this->ponto_model->edit_ponto($data, $id);

                if ($result) {

                    $this->session->set_flashdata('success', 'Ponto atualizado com sucesso!');

                    redirect(base_url('admin/pontos'));
                }
            }
        }

        
        
        $data['ponto'] = $this->ponto_model->get_ponto_by_id($id);
        $this->load->view('admin/includes/_header');

        $data['operadores'] = $this->user_model->getAllUsers();
        

        $this->load->view('admin/pontos/ponto_edit', $data);

        $this->load->view('admin/includes/_footer');
    }

    //---------------------------------------------------------------

    public function delete($id = 0) {

        $this->rbac->check_operation_access(); // check opration permission



        $this->db->delete('ci_pontos', array('id' => $id));

        $this->session->set_flashdata('success', 'Ponto excluido comsucesso!');

        redirect(base_url('admin/pontos'));
    }

    //---------------------------------------------------------------
    //  Export pontos PDF 

    public function create_pontos_pdf() {



        $this->load->helper('pdf_helper'); // loaded pdf helper

        $data['all_pontos'] = $this->ponto_model->get_pontos_for_export();

        $this->load->view('admin/pontos/pontos_pdf', $data);
    }

    //---------------------------------------------------------------	
    // Export data in CSV format 

    public function export_csv() {



        // file name 

        $filename = 'pontos_' . date('Y-m-d') . '.csv';

        header("Content-Description: File Transfer");

        header("Content-Disposition: attachment; filename=$filename");

        header("Content-Type: application/csv; ");

        // get data 

        $ponto_data = $this->ponto_model->get_pontos_for_export();

        // file creation 

        $file = fopen('php://output', 'w');


        $header = array("ID", "Ponto", "Email", "Responsavel", "Telefone", "cidade", "Created Date");
        fputcsv($file, $header);

        foreach ($ponto_data as $key => $line) {

            fputcsv($file, $line);
        }

        fclose($file);

        exit;
    }

}

?>