<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Operar extends MY_Controller {

    public function __construct() {

        parent::__construct();
        //   auth_check(); 
        //$this->rbac->check_module_access();
        $this->load->model('admin/operar_model', 'operar_model');
        $this->load->model('admin/machine_model', 'machine_model');
        $this->load->model('admin/item_model', 'item_model');
        $this->load->model('admin/tipo_model', 'tipo_model');
        $this->load->model('admin/ponto_model', 'ponto_model');
        $this->load->model('admin/user_model', 'user_model');
    }

    //----------------------------------------------------------------
    public function index() {

        redirect(base_url('admin/operar/operar_list'));
    }

    //----------------------------------------------------------------
    public function operar() {
        

        $dados['title'] = 'operar';



        if ($this->input->post('submit')) {

            self::save("insert");
        } else {

            $this->load->view('admin/includes/_header');
            //$dados['tipos'] = $this->tipo_model->getTodosTipos(array('is_active'=>1));
        //    $dados['tipos'] = $this->operar_model->get_maquias_e_tipos();

            if ($this->session->userdata('user_id')) {

                $where = array('p.is_active' => 1, 'up.user_id' => $this->session->userdata('user_id'));
                $dados['pontos'] = $this->ponto_model->getTodosPontosOperador($where);
            } else {
                $where = array('is_active' => 1);
                $dados['pontos'] = $this->ponto_model->getTodosPontos($where);
            }


            $this->load->view('admin/operar/operar_form', $dados);
            $this->load->view('admin/includes/_footer');
        }
    }

    //----------------------------------------------------------------
    public function save($action = "insert") {

        $this->form_validation->set_rules('pontodevenda', 'required');
        //$this->form_validation->set_rules('tipodemaquina', 'required');
        $this->form_validation->set_rules('maq_id', 'required');
        $this->form_validation->set_rules('cont_anterior', 'trim|required');
        $this->form_validation->set_rules('cont_atual', 'trim|required');

        $this->form_validation->set_rules('cont_saida_anterior', 'trim|required');
        $this->form_validation->set_rules('cont_saida_atual', 'trim|required');

        //$this->form_validation->set_rules('vendas', 'trim|required');
        //$this->form_validation->set_rules('teste', 'trim');
        //$this->form_validation->set_rules('saldo', 'trim');
        $this->form_validation->set_rules('status_op', 'trim|required');
        $this->form_validation->set_rules('observacoes_equip', 'trim');
        $errors = array();
        
        
        if($this->input->post('cont_atual') < $this->input->post('cont_anterior')){
            
           $errors[] = "O Contador atual não pode ser menor que o contador anterior <b>(".$this->input->post('cont_anterior').")</b>";
        }
        
        if($this->input->post('cont_saida_atual') < $this->input->post('cont_saida_anterior')){
            
           $errors[] = "O Contador de saída atual não pode ser menor que o contador de saida anterior <b>(".$this->input->post('cont_saida_anterior').")</b>";
        }
        
        if($_FILES['file_operacao']['name'] == ''){
            
            $errors[] = 'A Foto do contador de entrada atual é obrigatório';
        }
        
         if($_FILES['file_img_saida']['name'] == ''){
            
             $errors[] = 'A Foto do contador de saida atual é obrigatório';
        }
        
        
        if(count($errors)>0){
            
            $message_erro = implode("<br>", $errors);
            
            $this->session->set_flashdata('errors', $message_erro);
              redirect(base_url('admin/operar/operar'), 'refresh');
        }
        
        elseif ($this->form_validation->run() == TRUE) {
            $data = array(
                'errors' => validation_errors()
            );
            $this->session->set_flashdata('errors', $data['errors']);

            redirect(base_url('admin/operar/operar'), 'refresh');
        } else {
            /**
             * --------------------------------------------------------
             * upload de imagem
             * --------------------------------------------------------
             * */
            // CONTADOR DE ENTRADA
            // --------------------------------------------------------
            $file_operacao_old = $this->input->post('file_operacao_old');
            $file_operacao_old = $this->security->xss_clean($file_operacao_old);

            $file_operacao = $file_operacao_old;

            $config['upload_path'] = $this->config->item('folder_images') . '/operacao/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('file_operacao')) {
                $upload_data = $this->upload->data();
                $file_operacao = $upload_data['file_name'];
                //$data['image'] = $upload_data['file_name'];
            }
            // --------------------------------------------------------
            // CONTADOR DE SA�DA
            // --------------------------------------------------------
            $file_img_saida_old = $this->input->post('file_img_saida_old');
            $file_img_saida_old = $this->security->xss_clean($file_img_saida_old);
            $file_img_saida = $file_img_saida_old;

            $config['upload_path'] = $this->config->item('folder_images') . '/operacao/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $this->load->library('upload', $config);


            if ($this->upload->do_upload('file_img_saida')) {
                $upload_data = $this->upload->data();
                $file_img_saida = $upload_data['file_name'];
            }

            $dados_maquina = $this->machine_model->get_machine_by_id($this->input->post('maq_id'));

            //$nova_qtde_item_maquina =  $dados_maquina['qtde_insumos'] - $this->input->post('cont_saida_atual');

            $dados_itens = $this->item_model->get_itens_by_id($dados_maquina['item_id']);
            //   $nova_qtde_item =  $dados_itens['quantidade'] - $this->input->post('cont_saida_atual');







            $valor_jogada = $dados_maquina['valorvenda'];
            $valor_insumo = $dados_itens['valor'];
            $qtde_vendas = $this->input->post('cont_atual') - $this->input->post('cont_anterior');
          
            
            
            $valor_total_jogadas = (float) ($qtde_vendas * $valor_jogada);
            $qtde_saida = $this->input->post('cont_saida_atual')-$this->input->post('cont_saida_anterior');
            $saldo = $valor_total_jogadas - ($qtde_saida * $valor_insumo);

          //  $valorcomissao = ((($valorpremio) * $comissao) / 100);
            // --------------------------------------------------------

            
            $data = array(
                'ponto' => (int) $this->input->post('pontodevenda'),
                //'tipodemaquina' => (int)$this->input->post('tipodemaquina'),		
                'maq_id' => (int) $this->input->post('maq_id'),
                'cont_anterior' => (int) $this->input->post('cont_anterior'),
                'cont_atual' => (int) $this->input->post('cont_atual'),
                'cont_saida_anterior' => (int) $this->input->post('cont_saida_anterior') ,
                'cont_saida_atual' => (int) $this->input->post('cont_saida_atual'),
                'vendas' => $valor_total_jogadas,
                'saidas' => $qtde_saida * $valor_insumo,
                'qnt_vendas' => $qtde_vendas,
                'qtde_saida' => $qtde_saida,
                'valor_insumo' => $valor_insumo,
                'saldo' => $saldo,
                'status_op' => (int) $this->input->post('status_op'),
                'observacoes_equip' => $this->input->post('observacoes_equip'),
                'imagem' => $file_operacao,
                'imagem_cont_saida' => $file_img_saida,
                'is_active' => 1,
                'user_id' => $this->session->userdata('admin_id') == null ? $this->session->userdata('user_id') : $this->session->userdata('admin_id'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            );
            $data = $this->security->xss_clean($data);

            if ($action == "insert") {
                $result = $this->operar_model->add_operacao($data);
            } else {
                $id = (int) $this->input->post('operacao_id');
                $id = $this->security->xss_clean($id);
                $result = $this->operar_model->edit_operacao($data, $id);
            }
            if ($result) {

                // $this->machine_model->edit_machine(array('qtde_insumos'=>$nova_qtde_item_maquina), $dados_maquina['id']);


                $data_log = array(
                    'qtde' => $this->input->post('cont_saida_atual') * -1,
                    'item_id' => $dados_maquina['item_id'],
                    'maq_id' => $dados_maquina['id_maquina'],
                    'tipo_operacao' => 'saida',
                    'user_id' => $this->session->userdata('admin_id') == null ? $this->session->userdata('user_id') : $this->session->userdata('admin_id'),
                    'created_at' => date('Y-m-d : h:i:s'),
                    'updated_at' => date('Y-m-d : h:i:s'),
                    'id_operacao' => $result,
                );


                $this->machine_model->add_log_machine($data_log);





                $this->session->set_flashdata('success', utf8_encode('Operacao registrada com sucesso!'));
                redirect(base_url('admin/operar/operar_list'));
            }
        }
    }

    //----------------------------------------------------------------
    public function operar_list_teste() {

        $dados['title'] = 'operar';

        $this->load->view('admin/includes/_header');
        $this->load->view('admin/operar/operar_list-old', $dados);
        $this->load->view('admin/includes/_footer');
    }

    //------------------------------------------------------------------
    public function datatable_json() {





        $dte_filtro = $this->input->get('dte_filtro');
        //fct_print_debug( $dte_filtro );

        $dte = preg_split('/[-]+/', $dte_filtro);
        if (is_array($dte) && count($dte)) {
            $dteINI = (isset($dte[0]) ? trim($dte[0]) : "");
            $dteFIM = (isset($dte[1]) ? trim($dte[1]) : "");

            if (!empty($dteINI)) {
                $where[] = "created_at >= '" . fct_date2bd($dteINI) . "'";
            }
            if (!empty($dteFIM)) {
                $where[] = "created_at <= '" . fct_date2bd($dteFIM) . "'";
            }
        }


        if ($this->session->userdata('user_id')) {
            $where = array('OP.user_id = ' . $this->session->userdata('user_id'));
        }else{
            $where = array();
        }



        $records = $this->operar_model->get_all_operacao($where);



        $data = array();
        $i = 0;

        foreach ($records['data'] as $row) {
            $status = ($row['is_active'] == 1) ? 'checked' : '';

            $id = $row['id'];
            
            $ponto = $row['ponto'];
            $tipo = $row['tipo'];
            $serial = $row['serial'];

            $cont_anterior = (int) $row['cont_anterior'];
            $cont_atual = (int) $row['cont_atual'];
            $cont_saida_anterior = (int) $row['cont_saida_anterior'];
            $cont_saida_atual = (int) $row['cont_saida_atual'];
            $qtde_jogadas = $row['qnt_vendas'];
            $valor_arrecadado = $row['vendas'];
            $saldo = $row['saldo'];
            $comissao = $row['comissao'];

            if ($this->session->userdata('admin_id')) {
                $acoes = '<!--<a title="View" class="view btn btn-sm btn-info" href="' . base_url('admin/operar/edit/' . $row['id']) . '"> <i class="fa fa-eye"></i></a>-->
				<a title="Edit" class="update btn btn-sm btn-warning" href="' . base_url('admin/operar/edit/' . $row['id']) . '"> <i class="fa fa-pencil-square-o"></i></a>
				<a title="Delete" class="delete btn btn-sm btn-danger" href=' . base_url("admin/operar/delete/" . $row['id']) . ' title="Delete" onclick="return confirm(\'Deseja realmente apagar?\')"> <i class="fa fa-trash-o"></i></a>
				<a title="Visualizar" class="delete btn btn-sm btn-info" href=' . base_url("admin/operar/visualizar/" . $row['id']) . ' title="Visualizar"><i class="fa fa-eye"></i></a>';
            } else {
                $acoes = '<a title="Visualizar" class="delete btn btn-sm btn-info" href=' . base_url("admin/operar/visualizar/" . $row['id']) . ' title="Visualizar"><i class="fa fa-eye"></i></a>';
            }

            $data[] = array(
                $id,
                $ponto,
                $tipo,
                $serial,
                $cont_anterior,
                $cont_atual,
                $qtde_jogadas,
                formatar_moeda($valor_arrecadado),
                formatar_moeda($saldo),
                '<input type="checkbox" class="tgl_checkbox tgl-ios" data-id="' . $row['id'] . '" id="cb_' . $row['id'] . '" ' . $status . '><label for="cb_' . $row['id'] . '"></label>',
                $acoes
            );
        }
        $records['data'] = $data;
        echo json_encode($records);
    }

    //-----------------------------------------------------------
    function change_status() {

        $this->operar_model->change_status();
    }

    //-----------------------------------------------------------
    public function delete($id = 0) {

        $this->rbac->check_operation_access(); // check opration permission
        $this->operar_model->delete_operacao($id);
        $this->session->set_flashdata('success', 'Registro deletado com sucesso!');
        redirect(base_url('admin/operar/operar_list/'));
    }

    //------------------------------------------------------------------
    public function operar_list() {


        $data['title'] = 'Operar_list';

        $this->load->view('admin/includes/_header');

        $this->load->view('admin/operar/operar_list', $data);

        $this->load->view('admin/includes/_footer');
    }

    //----------------------------------------------------------------
    public function visualizar($id = 0) {
        $dados['title'] = 'Operar_template';


        $dados['rs'] = array();
        $result = $this->operar_model->get_operacao_inner_by_id($id);
        if ($result) {
            $dados['rs'] = $result;
        }

        $this->load->view('admin/includes/_header');
        $this->load->view('admin/operar/operar_template', $dados);
        $this->load->view('admin/includes/_footer');
    }

    //----------------------------------------------------------------
    public function edit($id = 0) {
        $dados = array();

        if ($this->input->post('submit')) {

            self::save("update");
        } else {

            $dados['rs'] = array();
            $dados['tipos'] = array();
            $result = $this->operar_model->get_operacao_by_id($id);
            if ($result) {
                $dados['rs'] = $result;
                $where = array(
                    'MQ.is_active' => 1,
                    'MQ.pontodevenda' => (int) $dados['rs']["pontodevenda"]
                );
                $dados['tipos'] = $this->operar_model->get_maquias_e_tipos($where);
            }

            $this->load->view('admin/includes/_header');
            //$dados['tipos'] = $this->tipo_model->getTodosTipos(array('is_active'=>1));
            $dados['pontos'] = $this->ponto_model->getTodosPontos(array('is_active' => 1));
            $this->load->view('admin/operar/operar_form', $dados);
            $this->load->view('admin/includes/_footer');
        }
    }

    //----------------------------------------------------------------
    public function operar_template() {

        $data['title'] = 'Operar_template';
        $this->load->view('admin/includes/_header');
        $this->load->view('admin/operar/operar_template', $data);
        $this->load->view('admin/includes/_footer');
    }

    //-----------------------------------------------------------
    function json($action = "") {
        $data = array();
        $return = '';

        switch ($action) {
            case "CONTAGEM-ATUAL" :

                $contador_inicial = "";
                $contador_anterior = "";
                $contador_atual = "";

                $contador_saida_inicial = "";
                $contador_saida_anterior = "";
                $contador_saida_atual = "";

                $pontodevenda = (int) $this->input->post('pontodevenda');
                //$tipodemaquina = (int)$this->input->post('tipodemaquina');
                $maq_id = (int) $this->input->post('maq_id');

                $pontodevenda = $this->security->xss_clean($pontodevenda);
                //$tipodemaquina = $this->security->xss_clean($tipodemaquina);
                $maq_id = $this->security->xss_clean($maq_id);

                // -----------------------------------------------------
                // contador inicial da maquina
                // -----------------------------------------------------
                //$where = array(
                //'pontodevenda' => $pontodevenda,
                //'tipomaquina' => $tipodemaquina
                //);
                $where = array(
                    'id' => $maq_id
                );
                $rs_maq = $this->operar_model->get_cont_machines($where);
                //fct_print_debug( $this->db->last_query() );
                if (count($rs_maq) >= 1) {
                    $contador_inicial = $rs_maq['cont_inicial'];
                    $contador_saida_inicial = $rs_maq['cont_saida_inicial'];
                }

                // -----------------------------------------------------
                // contador atual da maquina
                // -----------------------------------------------------
                //$where = array(
                //'pontodevenda' => $pontodevenda,
                //'tipodemaquina' => $tipodemaquina
                //);
                $where = array(
                    'maq_id' => $maq_id,
                    'is_active' => '1'
                );
                $rs_maq_curent = $this->operar_model->get_cont_machines_atual($where);
                //fct_print_debug( $this->db->last_query() );
                //fct_print_debug( $rs_maq_curent );
                if (count($rs_maq_curent) >= 1) {
                    $contador_anterior = $rs_maq_curent['cont_anterior'];
                    $contador_atual = $rs_maq_curent['cont_atual'];

                    $contador_saida_anterior = $rs_maq_curent['cont_saida_anterior'];
                    $contador_saida_atual = $rs_maq_curent['cont_saida_atual'];
                }

                $contador_inicial = (int) $contador_inicial;
                $contador_anterior = (((int) $contador_anterior == 0) ? $contador_inicial : $contador_anterior);
                $contador_atual = (((int) $contador_atual == 0) ? $contador_inicial : $contador_atual);

                //(int)$contador_atual;
                $contador_saida_inicial = (int) $contador_saida_inicial;
                $contador_saida_anterior = (((int) $contador_saida_anterior == 0) ? $contador_saida_inicial : $contador_saida_anterior);
                $contador_saida_atual = (((int) $contador_saida_atual == 0) ? $contador_saida_inicial : $contador_saida_atual);

                $return = array(
                    'contador_inicial' => $contador_inicial,
                    'contador_anterior' => $contador_anterior,
                    'contador_atual' => $contador_atual,
                    'contador_saida_inicial' => $contador_saida_inicial,
                    'contador_saida_anterior' => $contador_saida_anterior,
                    'contador_saida_atual' => $contador_saida_atual,
                );

                echo json_encode($return);
                exit();
                break;
            case "TIPO-DE-MAQUINAS-E-SERIAL" :

                $pontodevenda = (int) $this->input->post('pontodevenda');
                $pontodevenda = $this->security->xss_clean($pontodevenda);
                //$pontodevenda = 31;

                $where = array(
                    'MQ.is_active' => '1',
                    'MQ.pontodevenda' => $pontodevenda
                );
                $rs_tipos = $this->operar_model->get_maquias_e_tipos($where);
                
            
																					
                

                $html_cbo = '';
                if (count($rs_tipos) >= 1) {
                    $html_cbo = '
				<select required name="maq_id" style="width:100%"  class="select_operar" id="maq_id" >
					<option >- selecione -</option>';
                    foreach ($rs_tipos as $rs_item) {
                    $qtde_estoque = $this->machine_model->get_estoque_machine($rs_item['id']);

                    if($qtde_estoque>0)
                      {
                        $html_cbo .= '<option value="' . $rs_item["id"] . '">' . $rs_item["tipo"] . ' | ' . $rs_item["serial"] . ' ('.$qtde_estoque.')</option>';
                      }else{
                          $html_cbo .= '<option>Não tem máquina com estoque para esse ponto</option>';
                      }
                    }
                    $html_cbo .= '</select>  <script> $(\'.select_operar\').select2(); </script>';
                } else {
                    $html_cbo = '
				<select required name="maq_id" class="form-control" id="maq_id" >
					<option >- SELECIONE UMA MAQUINA -</option>';
                    $html_cbo .= '</select> <script> $(\'.select_operar\').select2(); </script>';
                }

                echo($html_cbo);
                exit();
                break;
        }
    }

}

?>
