<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Machines extends MY_Controller {

    private $modulo_name = 'machines';

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
        $this->load->model('admin/user_model', 'user_model');
        $this->load->model('admin/setting_model', 'settings');
    }

    //-----------------------------------------------------------

    public function index() {

        $dados['operadores'] = $this->user_model->getAllOperadores();

        if ($this->is_supper == 1) {
            $where_pontos = array(
                'is_active' => 1
            );
        } else {
            $where_pontos = array('is_active' => 1, 'user_id' => $this->session->userdata('admin_id'));
        }

        $dados['pontos'] = $this->ponto_model->getTodosPontos($where_pontos);

        $this->load->view('admin/includes/_header');
        $this->load->view('admin/machines/machine_list', $dados);
        $this->load->view('admin/includes/_footer');
    }

    public function recibo($id) {

        $dados['proprietario'] = $this->settings->get_general_settings();

        $dados['machine'] = $this->machine_model->get_machine_by_id($id);
        $dados['user'] = $this->machine_model->get_operador_by_machine($id);

        //   echo '<pre>';
        //  var_dump($dados); exit;


        $this->load->view('admin/includes/_header');
        $this->load->view('admin/machines/recibo', $dados);
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

            $usuario = $this->user_model->get_dados_usuario($row['user_id']);


            $data[] = array(
                $row['id'],
                inverteDataHora($row['data_log']),
                $row['tipo_operacao'],
                $row['qtde'],
                $usuario->firstname . ' ' . $usuario->lastname,
                $row['item']
            );
        }
        $records['data'] = $data;
        echo json_encode($records);
    }

    public function datatable_json($user_id = 0, $ponto_id = 0) {

        if ($user_id > 0 || $ponto_id > 0) {
            $records = $this->machine_model->get_all_machines($user_id, $ponto_id);
        } else {

            if ($this->session->userdata('is_supper') == 1) {
                $records = $this->machine_model->get_all_machines();
            } else {

                $records = $this->machine_model->get_all_machines($this->session->userdata('admin_id'));
            }
        }



        $operadores = $this->user_model->getAllOperadores();

        $data = array();
        $i = 0;


        foreach ($records['data'] as $row) {


            $qtde_estoque = $this->machine_model->get_total_estoque_machines($row['id_maquina']);

            $operador = $this->machine_model->get_operador_by_machine($row['id_maquina']);

            $dados_operador = '
               <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#operador_' . $row['id_maquina'] . '">
 Adicionar Operador
</button>
               
<!-- Modal -->
<div class="modal fade" id="operador_' . $row['id_maquina'] . '" tabindex="-1" role="dialog" aria-labelledby="operador_' . $row['id_maquina'] . '" aria-hidden="true">
<script>
    $(\'.select_operar\').select2();
</script>
<div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Adicionar Operador</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
             <form action="' . base_url() . 'admin/machines/add_operador" method="post">

                    
                      
                                    <label for="user_id" class="col-md-6 control-label">Selecione Operador</label>
                                    <div class="input-group">
                                        <select name="user_id" style="width:100%" class="select_operar" id="user_id" >';

            foreach ($operadores as $operador1) {
                $dados_operador .= '<option value="' . $operador1['id'] . '">' . $operador1['firstname'] . ' ' . $operador1['lastname'] . '</option>';
            }

            $dados_operador .= '         </select>
                <input type="hidden" name="maq_id" value="' . $row['id_maquina'] . '">
                                    </div>
                              


     
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <input type="submit" class="btn btn-primary" value="Adicionar Operador">
      </div>
          </form>
    </div>

  </div>
</div>

';


            if ($operador) {
                $dados_operador = $operador->firstname . ' ' . $operador->lastname;
                if ($this->is_supper == 1) {
                    $dados_operador .= '<br><a title="Delete" class="delete btn btn-sm btn-danger" href=' . base_url("admin/machines/delete_operador/" . $row['id_maquina'] . "/" . $operador->user_id) . ' title="Delete" onclick="return confirm(\'Deseja realmente apagar?\')"> <i class="fa fa-trash-o"></i></a>';
                }
            }





            if ($this->is_supper == 1) {
                $where_pontos = array(
                    'is_active' => 1
                );
            } else {
                $where_pontos = array('is_active' => 1, 'user_id' => $this->session->userdata('admin_id'));
            }

            $pontos = $this->ponto_model->getTodosPontos($where_pontos);
            $itens = $this->item_model->getTodosItens(array('is_active' => 1));


            $dados_ponto = '
               <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ponto_' . $row['id_maquina'] . '">
 Adicionar Ponto
</button>
               
<!-- Modal -->
<div class="modal fade" id="ponto_' . $row['id_maquina'] . '" tabindex="-1" role="dialog" aria-labelledby="ponto_' . $row['id_maquina'] . '" aria-hidden="true">
<script>
    $(\'.select_operar\').select2();
</script>
<div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Adicionar Ponto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
             <form action="' . base_url() . 'admin/machines/add_ponto" method="post">

                    
                      
                                    <label for="user_id" class="col-md-6 control-label">Selecione Ponto</label>
                                    <div class="input-group">
                                        <select name="ponto_id" style="width:100%" class="select_operar" id="ponto_id" >';

            foreach ($pontos as $ponto1) {
                $dados_ponto .= '<option value="' . $ponto1->id . '">' . $ponto1->ponto . '</option>';
            }

            $dados_ponto .= '         </select>
                <input type="hidden" name="maq_id" value="' . $row['id_maquina'] . '">
                                    </div>
                                    
 <div class="input-group">
   <label for="user_id" class="col-md-6 control-label">Selecione o Insumo</label>
                                  
                                        <select name="item_id" style="width:100%" class="select_operar" id="ponto_id" >';

            
            foreach ($itens as $item) {
                $dados_ponto .= '<option value="' . $item['id'] . '">' . $item['item'] . '</option>';
            }

            $dados_ponto .= '         </select>
                <input type="hidden" name="maq_id" value="' . $row['id_maquina'] . '">
                                    </div>
                              


     
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <input type="submit" class="btn btn-primary" value="Adicionar Ponto">
      </div>
          </form>
    </div>

  </div>
</div>

';
            $ponto = $this->machine_model->get_ponto_by_machine($row['id_maquina']);




            if ($ponto) {
                $dados_ponto = $ponto->ponto;

                $dados_ponto .= '<br><a title="Delete" class="delete btn btn-sm btn-danger" href=' . base_url("admin/machines/delete_ponto/" . $row['id_maquina'] . "/" . $ponto->ponto_id) . ' title="Delete" onclick="return confirm(\'Deseja realmente apagar?\')"> <i class="fa fa-trash-o"></i></a>';
            }



// $dados_operador =  '<a href="'.base_url('admin/users/ver_maquinas/'.$operador->user_id.'').'">'.$operador->firstname.' '.$operador->lastname.'</a>';



            $status = ($row['is_active'] == 1) ? 'checked' : '';


            if (verifica_permissao($this->modulo_name, 'edit'))
                $edit = '<a title="Edit" class="update btn btn-sm btn-warning" href="' . base_url('admin/machines/edit/' . $row['id_maquina']) . '"> <i class="fa fa-pencil-square-o"></i></a>';

            if (verifica_permissao($this->modulo_name, 'delete'))
                $delete = '<a title="Delete" class="delete btn btn-sm btn-danger" href=' . base_url("admin/machines/delete/" . $row['id_maquina']) . ' title="Delete" onclick="return confirm(\'Deseja realmente apagar?\')"> <i class="fa fa-trash-o"></i></a>';

            if (verifica_permissao($this->modulo_name, 'view'))
                $view = '<a title="View" class="view btn btn-sm btn-info" href="' . base_url('admin/machines/view/' . $row['id_maquina']) . '"> <i class="fa fa-eye"></i></a>';

            if (verifica_permissao($this->modulo_name, 'change_status')) {
                $bnt_status = '<input class="tgl_checkbox tgl-ios" 
				data-id="' . $row['id_maquina'] . '" 
				id="cb_' . $row['id_maquina'] . '"
				type="checkbox"  
				' . $status . '><label for="cb_' . $row['id_maquina'] . '">
                                </label>';
            } else {
                if ($status)
                    $bnt_status = 'Ativo';
                else
                    $bnt_status = 'Desativado';
            }



            $data[] = array(
                $row['id_maquina'],
                inverteDataHora($row['created_at']),
                $row['nome_tipo'],
                $dados_ponto,
                $dados_operador,
                $row['observacoes_equip'],
                $row['serial'],
                $row['cont_inicial'],
                $row['cont_saida_inicial'],
                $row['valorvenda'],
                '<a title="View" class="view btn btn-sm btn-info" href="' . base_url('admin/machines/view_logs/' . $row['id_maquina']) . '"> <i class="fa fa-list"></i> (' . $qtde_estoque . ') </a>',
                $bnt_status,
                @$view . @$delete . @$edit
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

    public function add_ponto() {



        $ponto_id = $this->input->post('ponto_id');
        $user_id = $this->ponto_model->get_user_id_by_ponto($ponto_id);
        $maq_id = $this->input->post('maq_id');
        $item_id = $this->input->post('item_id');






        if ($this->input->post('ponto_id')) {

            $this->form_validation->set_rules('ponto_id', 'required');

            if ($this->form_validation->run() == TRUE) {

                $data = array(
                    'errors' => validation_errors()
                );

                $this->session->set_flashdata('errors', $data['errors']);

                redirect(base_url('admin/machines'), 'refresh');
            } else {


                $this->machine_model->update_item_machine(array('item_id' => $item_id), $maq_id);
                // $this->user_model->delete_user_machines($user_id, $pontodevenda);


                $get_machine_user = $this->ponto_model->get_count_machines_user($user_id, $maq_id);

     
                if (!$get_machine_user) {
                    $data_users_machines = array(
                        'ponto_id' => $ponto_id,
                        'user_id' => $user_id,
                        'maq_id' => $maq_id,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    );
                    $result = $this->user_model->add_user_machine($data_users_machines);
                } else {
        
                    $data_users_machines = array(
                        'ponto_id' => $ponto_id,
                        'user_id' => $user_id,
                        'maq_id' => $maq_id,
                        'updated_at' => date('Y-m-d H:i:s')
                    );
                    
                    $result = $this->user_model->update_user_machine($data_users_machines, $get_machine_user);
                }

                if ($result) {
                    $this->session->set_flashdata('success', 'maquina cadastrada com sucesso!');

                    redirect(base_url('admin/machines/'), 'refresh');
                }
            }
        }
    }

    public function add_operador() {



        $user_id = $this->input->post('user_id');
        $maq_id = $this->input->post('maq_id');
        $ponto_id = 0;



        if ($this->input->post('user_id')) {

            $this->form_validation->set_rules('user_id', 'required');
            $this->form_validation->set_rules('maq_id', 'required');

            if ($this->form_validation->run() == TRUE) {

                $data = array(
                    'errors' => validation_errors()
                );

                $this->session->set_flashdata('errors', $data['errors']);

                redirect(base_url('admin/machines'), 'refresh');
            } else {


                // $this->user_model->delete_user_machines($user_id, $pontodevenda);




                $data_users_machines = array(
                    'ponto_id' => $ponto_id,
                    'user_id' => $user_id,
                    'maq_id' => $maq_id,
                    '	created_at' => date('Y-m-d H:i:s'),
                    '	updated_at' => date('Y-m-d H:i:s')
                );
                if ($this->user_model->add_user_machine($data_users_machines)) {
                    $this->session->set_flashdata('success', 'Operador adicionado com sucesso!');

                    redirect(base_url('admin/machines/recibo/' . $maq_id), 'refresh');
                }
            }
        }
    }

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



            $serial = $this->input->post('serial');
            $tipomaquina = $this->input->post('tipomaquina');

            $consulta_serial = $this->machine_model->consulta_serial($serial, $tipomaquina);


            if ($consulta_serial->qtde > 0) {
                $data = array(
                    'errors' => 'Serial existente'
                );
                $this->session->set_flashdata('errors', $data['errors']);

                redirect(base_url('admin/machines/add'), 'refresh');
            } elseif ($this->form_validation->run() == TRUE) {

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
                    'valorvenda' => grava_money($this->input->post('valorvenda'), 2),
                    'valordoequipamento' => grava_money($this->input->post('valordoequipamento'), 2),
                    'serial' => $this->input->post('serial'),
                    'item_id' => $this->input->post('item'),
                    'noteiro' => (int) $this->input->post('noteiro'),
                    'ficheiro' => (int) $this->input->post('ficheiro'),
                    'observacoes_equip' => $this->input->post('observacoes_equip'),
                    'pontodevenda' => $this->input->post('pontodevenda'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
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



                        if ($this->ddoo_upload('file_cont_inicial', $result)) {

                            $upload_data = $this->upload->data();
                            $file_cont_inicial = $upload_data['file_name'];

                            $maqData = array(
                                'nome_imagem' => $file_cont_inicial
                            );
                            $this->machine_model->edit_machine($maqData, $result);
                        }




                        // --------------------------------------------------------
                        // FOTO DO CONTADOR ANALOGICO DA MAQUINA
                        // --------------------------------------------------------

                        if ($this->ddoo_upload('file_cont_analogico', $result)) {

                            $upload_data = $this->upload->data();
                            $file_cont_analogico = $upload_data['file_name'];

                            $maqData = array(
                                'nome_imagem_analogico' => $file_cont_analogico
                            );
                            $this->machine_model->edit_machine($maqData, $result);
                        }



                        $this->session->set_flashdata('success', 'Máquina gravada com sucesso');


                        //   $this->session->set_flashdata('errors', 'Falha no envio do arquivo, ' . $this->upload->display_errors());


                        redirect(base_url('admin/machines'));


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
                'is_active' => 1
            );
            $where_pontos = array(
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

                redirect(base_url('admin/machines/view_logs/' . $this->input->post('id_maquina')), 'refresh');
            } else {


                $qtde = $this->input->post('qtde');
                if ($this->input->post('tipo_operacao') == 'saida') {
                    $qtde = $qtde * -1;
                }

                $data = array(
                    'qtde' => $qtde,
                    'item_id' => $this->input->post('item'),
                    'maq_id' => $this->input->post('id_maquina'),
                    'tipo_operacao' => $this->input->post('tipo_operacao'),
                    'user_id' => $this->session->userdata('admin_id'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                );


                $data = $this->security->xss_clean($data);
                $result = $this->machine_model->add_log_machine($data);



                if ($result > 0) {
                    $this->session->set_flashdata('success', 'Estoque atualizado com sucesso!');



                    $qtde = $this->input->post('qtde');
                    if ($this->input->post('tipo_operacao') == 'entrada') {
                        $qtde = $qtde * -1;
                    }

             
                    
                         $data_log_item = array(
                    'qtde' => $qtde,
                    'item_id' => $this->input->post('item'),
                    'tipo_operacao' => $this->input->post('tipo_operacao'),
                      'user_id' => $this->session->userdata('admin_id'),
                                   'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                );


                $result = $this->item_model->add_log_item($data_log_item);
                    

                     //$this->item_model->edit_item(array('quantidade'=>$nova_qtde_item), $this->input->post('item'));

                    redirect(base_url('admin/machines/view_logs/' . $this->input->post('id_maquina')), 'refresh');
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

            $this->form_validation->set_rules('tipomaquina', 'Tipo de máquina', 'required');
            $this->form_validation->set_rules('cont_inicial', 'Contador inicial', 'trim');
            $this->form_validation->set_rules('cont_saida_inicial', 'Contador de saída', 'trim|required');
            $this->form_validation->set_rules('valorvenda', 'valor da venda', 'trim|required');
            $this->form_validation->set_rules('serial', 'Serial', 'trim|required');


            if ($this->form_validation->run() == false) {

                $data = array(
                    'errors' => validation_errors()
                );

                $this->session->set_flashdata('errors', $data['errors']);
                redirect(base_url('admin/machines/edit/' . $id), 'refresh');
            } else {



                $data = array(
                    //'id' => $id,

                    'tipomaquina' => $this->input->post('tipomaquina'),
                    'pontodevenda' => $this->input->post('pontodevenda'),
                    'serial' => $this->input->post('serial'),
                    'cont_inicial' => $this->input->post('cont_inicial'),
                    'cont_saida_inicial' => $this->input->post('cont_saida_inicial'),
                    'item_id' => $this->input->post('item'),
                    'valorvenda' => grava_money($this->input->post('valorvenda'), 2),
                    'valordoequipamento' => grava_money($this->input->post('valordoequipamento'), 2),
                    'nome_imagem' => $file_cont_inicial,
                    'noteiro' => (int) $this->input->post('noteiro'),
                    'ficheiro' => (int) $this->input->post('ficheiro'),
                    'observacoes_equip' => $this->input->post('observacoes_equip'),
                    'is_active' => $this->input->post('is_active'),
                    'updated_at' => date('Y-m-d H:m:s'),
                );
                $data = $this->security->xss_clean($data);


                $result = $this->machine_model->edit_machine($data, $id);
                if ($result) {

                    if (isset($_FILES)) {

                        $result = $id;

                        // --------------------------------------------------------
                        // FOTO DO CONTADOR INICIAL DA MAQUINA
                        // --------------------------------------------------------



                        if ($this->ddoo_upload('file_cont_inicial', $result)) {

                            $upload_data = $this->upload->data();
                            $file_cont_inicial = $upload_data['file_name'];

                            $maqData = array(
                                'nome_imagem' => $file_cont_inicial
                            );
                            $this->machine_model->edit_machine($maqData, $result);
                        }




                        // --------------------------------------------------------
                        // FOTO DO CONTADOR ANALOGICO DA MAQUINA
                        // --------------------------------------------------------

                        if ($this->ddoo_upload('file_cont_analogico', $result)) {

                            $upload_data = $this->upload->data();
                            $file_cont_analogico = $upload_data['file_name'];

                            $maqData = array(
                                'nome_imagem_analogico' => $file_cont_analogico
                            );
                            $this->machine_model->edit_machine($maqData, $result);
                        }



                        $this->session->set_flashdata('success', 'Máquina atualizada com sucesso');


                        //   $this->session->set_flashdata('errors', 'Falha no envio do arquivo, ' . $this->upload->display_errors());


                        redirect(base_url('admin/machines'));


                        // --------------------------------------------------------
                    }
                }
            }
        }

        $where_tipos = array('is_active' => 1);
        $where_pontos = array('is_active' => 1);
        if ($this->is_supper == "0") {
            $where_tipos = array(
                'is_active' => 1
            );
            $where_pontos = array(
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

    public function delete_operador($maq_id, $user_id) {

        $this->rbac->check_operation_access(); // check opration permission
        //verificar se existe ponto
        $get_machine_user = $this->ponto_model->get_count_pontos_user($user_id, $maq_id);




        if (!$get_machine_user) {
            $this->db->delete('ci_users_machines', array('maq_id' => $maq_id, 'user_id' => $user_id));
        } else {
            $this->db->where(array('maq_id' => $maq_id, 'user_id' => $user_id));

            $this->db->update('ci_users_machines', array('user_id' => 0));
        }



        $this->session->set_flashdata('success', 'máquina excluida com sucesso!');

        redirect(base_url('admin/machines'));
    }

    public function delete_ponto($maq_id, $ponto_id) {


        $this->db->where(array('maq_id' => $maq_id, 'ponto_id' => $ponto_id));
        $this->db->update('ci_users_machines', array('ponto_id' => 0));

        $this->session->set_flashdata('success', 'ponto excluida com sucesso!');

        redirect(base_url('admin/machines'));
    }

    //---------------------------------------------------------------

    public function view($id = 0) {

        $dados['title'] = 'Operar_template';
        $dados['operador'] = $this->machine_model->get_operador_by_machine($id);
        $dados['ponto'] = $this->machine_model->get_ponto_by_machine($id);
        $dados['qtde_estoque'] = $this->machine_model->get_estoque_machine($id);




        $dados['rs'] = array();
        $result = $this->machine_model->get_machine_by_id($id);
        if ($result) {
            $dados['rs'] = $result;
        }

        $dados['item'] = $this->item_model->get_itens_by_id($result['item_id']);

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

    function ddoo_upload($filename, $id) {


        $config['upload_path'] = $this->config->item('folder_images') . 'maquinas/';
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
