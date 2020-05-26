<?php

class Machine_model extends CI_Model {

    function __construct() {
        $this->is_supper = $this->session->userdata('is_supper');
        $this->admin_id = (int) $this->session->userdata('admin_id');
    }

    public function add_machine($data) {

        $this->db->insert('ci_machines', $data);
        return $this->db->insert_id();
    }

    public function get_machines_by_user($user_id) {

        $this->db->select('um.id as id_user_machine');
        $this->db->from('ci_users_machines um');
        $this->db->join('ci_machines m', 'm.id = um.maq_id');
        $this->db->where('um.user_id', $user_id);
        return $this->db->get()->result_array();
    }

    public function add_log_machine($data) {

        $this->db->insert('ci_estoque_machine', $data);
        return $this->db->insert_id();
    }

    // get all machines for server-side datatable processing (ajax based)
    public function get_estoque_machines($id_maquina) {
        $wh = array();


        $wh[] = " maq_id =  '" . $id_maquina . "'";

        $SQL = 'SELECT e.id as id, e.tipo_operacao,e.user_id,  e.qtde, e.item_id, e.created_at as data_log,
                                m.id as id_maquina, m.tipomaquina, m.pontodevenda, m.serial, m.cont_inicial, m.cont_saida_inicial, m.valorvenda,
				m.imagem,m.noteiro,m.ficheiro,m.observacoes_equip,m.is_active, m.created_at,m.updated_at,
				t.tipo as nome_tipo, t.id as id_tipo, i.item, i.quantidade, i.valor, i.is_active as item_ativo
			FROM ci_estoque_machine as e
				INNER JOIN ci_machines as m ON m.id = e.maq_id 
				INNER JOIN ci_itens as i ON i.id = e.item_id 
				INNER JOIN ci_tipos as t ON t.id = m.tipomaquina';

        if (count($wh) > 0) {

            $WHERE = implode(' and ', $wh);

            return $this->datatable->LoadJson($SQL, $WHERE);
        } else {

            return $this->datatable->LoadJson($SQL);
        }
    }

    //---------------------------------------------------
    // get all machines for server-side datatable processing (ajax based)
    public function get_all_machines($user_id = 0, $ponto_id = 0) {
        $wh = array();



        if ($user_id > 0 || $ponto_id > 0) {

            if ($user_id > 0 AND $ponto_id > 0) {
                $wh[] = " um.user_id =  '" . $user_id . "'";
                $wh[] = " um.ponto_id =  '" . $ponto_id . "'";
            } elseif ($user_id > 0) {
                $wh[] = " um.user_id =  '" . $user_id . "'";
            } elseif ($ponto_id > 0) {
                $wh[] = " um.ponto_id =  '" . $ponto_id . "'";
            }

            $SQL = 'SELECT m.id as id_maquina,m.item_id,  m.tipomaquina, m.pontodevenda, m.serial, m.cont_inicial, m.cont_saida_inicial, m.valorvenda,
				m.imagem,m.noteiro,m.ficheiro,m.observacoes_equip,m.is_active, m.created_at,m.updated_at,
				t.tipo as nome_tipo, t.id as id_tipo
			FROM ci_machines as m 
				INNER JOIN ci_tipos as t ON t.id = m.tipomaquina 
				INNER JOIN ci_users_machines as um ON um.maq_id = m.id 
				INNER JOIN ci_admin as a ON um.user_id = a.id ';
        } else {

            $SQL = 'SELECT m.id as id_maquina,m.item_id,  m.tipomaquina, m.pontodevenda, m.serial, m.cont_inicial, m.cont_saida_inicial, m.valorvenda,
				m.imagem,m.noteiro,m.ficheiro,m.observacoes_equip,m.is_active, m.created_at,m.updated_at,
				t.tipo as nome_tipo, t.id as id_tipo
			FROM ci_machines as m 
				INNER JOIN ci_tipos as t ON t.id = m.tipomaquina';
        }

        if (count($wh) > 0) {

            $WHERE = implode(' and ', $wh);

            return $this->datatable->LoadJson($SQL, $WHERE);
        } else {

            return $this->datatable->LoadJson($SQL);
        }
    }

    public function update_item_machine($data, $id) {
        $this->db->where('id', $id);
        return $this->db->update('ci_machines', $data);
    }

    function get_total_estoque_machines($maq_id) {

        $this->db->select('sum(qtde) as total');
        $this->db->where('maq_id', $maq_id);
        $this->db->from('ci_estoque_machine');
        $query = $this->db->get();

        return $query->row()->total;
    }

    //---------------------------------------------------
    // Get machine detial by ID

    public function get_machine_by_id($id) {



        $this->db->select('m.id as id_maquina,m.created_at as data_cadastro, m.valordoequipamento,m.nome_imagem_analogico, m.nome_imagem, m.item_id, m.tipomaquina, m.pontodevenda, m.serial, m.cont_inicial, m.cont_saida_inicial, m.valorvenda,
				m.imagem,m.noteiro,m.ficheiro,m.observacoes_equip,m.is_active, m.created_at,m.updated_at,
				t.tipo as nome_tipo, t.nome_imagem as tipo_nome_imagem, t.id as id_tipo');
        $this->db->from('ci_machines m');
        $this->db->where('m.id', $id);
        $this->db->join('ci_tipos t', 't.id = m.tipomaquina');

        return $this->db->get()->row_array();
    }

    public function get_estoque_by_machine($id) {

        $this->db->select('m.id as id_maquina, m.nome_imagem, m.item_id, m.tipomaquina, m.pontodevenda, m.serial, m.cont_inicial, m.cont_saida_inicial, m.valorvenda,
				m.imagem,m.noteiro,m.ficheiro,m.observacoes_equip,m.is_active, m.created_at,m.updated_at,
				t.tipo as nome_tipo, p.ponto as nome_ponto, p.nomefan as nomefan, t.id as id_tipo, p.id as id_ponto');
        $this->db->from('ci_machines m');
        $this->db->where('m.id', $id);
        $this->db->join('ci_tipos t', 't.id = m.tipomaquina');
        $this->db->join('ci_pontos p', 'p.id = m.pontodevenda');

        return $this->db->get()->row_array();
    }

    public function get_operador_by_machine($id) {



        $this->db->select('u.id as user_id, u.firstname, u.lastname, u.id as user_id, u.email, u.mobile_no, um.id as id_user_machine');
        $this->db->from('ci_admin u');
        $this->db->where('um.maq_id', $id);
        $this->db->join('ci_users_machines um', 'um.user_id = u.id');
        $query = $this->db->get();
        return $query->row();
    }

    public function get_ponto_by_machine($id) {

        $this->db->select('p.id as ponto_id, p.ponto');
        $this->db->from('ci_pontos p');
        $this->db->where('um.maq_id', $id);
        $this->db->join('ci_users_machines um', 'um.ponto_id = p.id');
        $query = $this->db->get();
        return $query->row();
    }

    public function get_machine_by_ponto($ponto_id) {



        $this->db->select('m.id as id_maquina, m.nome_imagem, m.item_id, m.tipomaquina, m.pontodevenda, m.serial, m.cont_inicial, m.cont_saida_inicial, m.valorvenda,
				m.imagem,m.noteiro,m.ficheiro,m.observacoes_equip,m.is_active, m.created_at,m.updated_at,
				t.tipo as nome_tipo, p.ponto as nome_ponto, p.nomefan as nomefan, t.id as id_tipo, p.id as id_ponto');
        $this->db->from('ci_machines m');
        $this->db->where('m.pontodevenda', $ponto_id);
        $this->db->join('ci_tipos t', 't.id = m.tipomaquina');
        $this->db->join('ci_pontos p', 'p.id = m.pontodevenda');
        $query = $this->db->get();
        return $result = $query->result_array();
    }

    function get_estoque_machine($maq_id) {

        $this->db->select('sum(qtde) as total');
        $this->db->where('maq_id', $maq_id);
        $this->db->from('ci_estoque_machine');
        $query = $this->db->get();

        return $query->row()->total;
    }

    //---------------------------------------------------
    // Edit machine Record

    public function edit_machine($data, $id) {
        //fct_print_debug( $id );
        //fct_print_debug( $data );
        //exit();
        $this->db->where('id', $id);

        $this->db->update('ci_machines', $data);

        return true;
    }

    function getNextId() {
        //   $this->db->table('ci_machines');
        return $this->db->insert_id();
    }

    //---------------------------------------------------
    // Change machine status
    //-----------------------------------------------------

    function change_status() {

        $this->db->set('is_active', $this->input->post('status'));

        $this->db->where('id', $this->input->post('id'));

        $this->db->update('ci_machines');
    }

    //---------------------------------------------------
    // get machines for csv export

    public function get_machines_for_export() {



        $this->db->where('is_admin', 0);

        $this->db->select('id, machine, nomefan, email, telefone, created_at');

        $this->db->from('ci_machines');

        $query = $this->db->get();

        return $result = $query->result_array();
    }

    public function consulta_serial($serial, $tipomaquina) {




        $this->db->select('count(id) as qtde');

        $this->db->from('ci_machines');
        $this->db->where('serial', $serial);
        $this->db->where('tipomaquina', $tipomaquina);
        $query = $this->db->get();

        return $result = $query->row();
    }

}

?>