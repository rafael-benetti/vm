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
				t.tipo as nome_tipo, p.ponto as nome_ponto, t.id as id_tipo, p.id as id_ponto,
                                i.item, i.quantidade, i.valor, i.is_active as item_ativo
			FROM ci_estoque_machine as e
				INNER JOIN ci_machines as m ON m.id = e.maq_id 
				INNER JOIN ci_itens as i ON i.id = e.item_id 
				INNER JOIN ci_tipos as t ON t.id = m.tipomaquina 
				INNER JOIN ci_pontos as p ON p.id=m.pontodevenda';



        if (count($wh) > 0) {

            $WHERE = implode(' and ', $wh);

            return $this->datatable->LoadJson($SQL, $WHERE);
        } else {

            return $this->datatable->LoadJson($SQL);
        }
    }

    //---------------------------------------------------
    // get all machines for server-side datatable processing (ajax based)
    public function get_all_machines() {
        $wh = array();

        if ($this->is_supper == "0") {
            $wh[] = " m.admin_id = '" . $this->admin_id . "' ";
        }

        $SQL = 'SELECT m.id as id_maquina,m.item_id,  m.tipomaquina, m.pontodevenda, m.serial, m.cont_inicial, m.cont_saida_inicial, m.valorvenda,
				m.imagem,m.noteiro,m.ficheiro,m.observacoes_equip,m.is_active, m.created_at,m.updated_at,
				t.tipo as nome_tipo, p.ponto as nome_ponto, p.nomefan as nomefan, t.id as id_tipo, p.id as id_ponto 
			FROM ci_machines as m 
				INNER JOIN ci_tipos as t ON t.id = m.tipomaquina 
				INNER JOIN ci_pontos as p ON p.id=m.pontodevenda ';

        if (count($wh) > 0) {

            $WHERE = implode(' and ', $wh);

            return $this->datatable->LoadJson($SQL, $WHERE);
        } else {

            return $this->datatable->LoadJson($SQL);
        }
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



        $this->db->select('m.id as id_maquina, m.nome_imagem, m.item_id, m.tipomaquina, m.pontodevenda, m.serial, m.cont_inicial, m.cont_saida_inicial, m.valorvenda,
				m.imagem,m.noteiro,m.ficheiro,m.observacoes_equip,m.is_active, m.created_at,m.updated_at,
				t.tipo as nome_tipo, p.ponto as nome_ponto, p.nomefan as nomefan, t.id as id_tipo, p.id as id_ponto');
        $this->db->from('ci_machines m');
        $this->db->where('m.id', $id);
        $this->db->join('ci_tipos t', 't.id = m.tipomaquina');
        $this->db->join('ci_pontos p', 'p.id = m.pontodevenda');

        return $this->db->get()->row_array();
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
    
    
                    function get_estoque_machine($maq_id){
            
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

}

?>