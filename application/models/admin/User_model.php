<?php

class User_model extends CI_Model {

    public function add_user($data) {
        $this->db->insert('ci_users', $data);
        return $this->db->insert_id();
    }

    // get all machines for server-side datatable processing (ajax based)
    public function get_user_machines($user_id) {
        $wh = array();

        $wh[] = " user_id =  '" . $user_id . "'";

        $SQL = 'SELECT 
                                um.id as id, um.maq_id, m.tipomaquina, m.pontodevenda, m.serial, m.cont_inicial, m.cont_saida_inicial, m.valorvenda,
				m.imagem,m.noteiro,m.ficheiro,m.observacoes_equip as nome_maquina,m.is_active, m.created_at,m.updated_at,
				t.tipo as nome_tipo, p.ponto as nome_ponto, t.id as id_tipo, p.id as id_ponto
                        FROM ci_users_machines as um
				INNER JOIN ci_machines as m ON m.id = um.maq_id 
				INNER JOIN ci_tipos as t ON t.id = m.tipomaquina 
				INNER JOIN ci_pontos as p ON p.id=m.pontodevenda';



        if (count($wh) > 0) {

            $WHERE = implode(' and ', $wh);

            return $this->datatable->LoadJson($SQL, $WHERE);
        } else {

            return $this->datatable->LoadJson($SQL);
        }
    }

    public function add_user_ponto($data) {
        $this->db->insert('ci_users_pontos', $data);
        return $this->db->insert_id();
    }

    public function add_user_machine($data) {
        $this->db->insert('ci_users_machines', $data);
        return $this->db->insert_id();
    }

    public function delete_user_ponto($user_id) {
        $this->db->where('user_id', $user_id);
        $this->db->delete('ci_users_pontos');
        return true;
    }

    public function delete_user_machines($user_id, $ponto_id) {
        $this->db->where('user_id', $user_id);
        $this->db->where('ponto_id', $ponto_id);
        $this->db->delete('ci_users_machines');
        return true;
    }

    //---------------------------------------------------
    // get all users for server-side datatable processing (ajax based)
    public function get_all_users() {
        $wh = array();
        $SQL = 'SELECT * FROM ci_users';
        $wh[] = " is_admin = 0";
        if (count($wh) > 0) {
            $WHERE = implode(' and ', $wh);
            return $this->datatable->LoadJson($SQL, $WHERE);
        } else {
            return $this->datatable->LoadJson($SQL);
        }
    }

    public function getPontosByUserId($user_id) {
        $query = $this->db->get_where('ci_users_pontos', array('user_id' => $user_id));
        return $result = $query->result_array();
    }

    public function getUserByPontobkp($ponto_id) {

        $this->db->select('distinct(up.id) as user_id, u.firstname,u.lastname');
        $this->db->where('up.ponto_id', $ponto_id);
        $this->db->from('ci_users u');
        $this->db->join('ci_users_machines up', 'up.user_id = u.id');
        $this->db->limit(1);
        $query = $this->db->get();
        return $result = $query->result_array();
    }

    public function getUserByPonto($user_id) {

        $this->db->where('id', $user_id);
        $this->db->from('ci_admin');
        $this->db->limit(1);
        $query = $this->db->get();
        return $result = $query->result_array();
    }

    public function get_maquinas_by_user_id($user_id) {

        $this->db->select('m.nome_imagem, m.observacoes_equip as nome_maquina');
        $this->db->select('t.tipo as nome_tipo, p.ponto, p.nomefan');
        $this->db->where('up.user_id', $user_id);
        $this->db->from('ci_users_pontos up');
        $this->db->join('ci_pontos p', 'p.id = up.ponto_id');
        $this->db->join('ci_machines m', 'm.pontodevenda = p.id');
        $this->db->join('ci_tipos t', 't.id = m.tipomaquina');

        $query = $this->db->get();

        echo '<pre>';
        var_dump($query->result_array());

        echo '</pre>';

        exit;
        return $result = $query->result_array();
    }

    function get_total_machines_user($user_id) {

        $this->db->select('count(id) as total');
        $this->db->where('user_id', $user_id);
        $this->db->from('ci_users_machines');
        $query = $this->db->get();

        return $query->row()->total;
    }

    //---------------------------------------------------
    // Get user detial by ID
    public function get_user_by_id($id) {
        $query = $this->db->get_where('ci_users', array('id' => $id));
        return $result = $query->row_array();
    }

    public function get_dados_usuario($id) {
        $this->db->from('ci_admin');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    //---------------------------------------------------
    // Edit user Record
    public function edit_user($data, $id) {
        $this->db->where('id', $id);
        $this->db->update('ci_users', $data);
        return true;
    }

    //---------------------------------------------------
    // Change user status
    //-----------------------------------------------------
    function change_status() {
        $this->db->set('is_active', $this->input->post('status'));
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('ci_users');
    }

    //---------------------------------------------------
    // get users for csv export
    public function get_users_for_export() {

        $this->db->where('is_admin', 0);
        $this->db->select('id, username, firstname, lastname, email, mobile_no, created_at');
        $this->db->from('ci_users');
        $query = $this->db->get();
        return $result = $query->result_array();
    }

    // get users for csv export
    public function getAllProfile() {


        $this->db->select('*');
        $this->db->from('ci_user_profile');
        $query = $this->db->get();
        return $result = $query->result_array();
    }

}

?>