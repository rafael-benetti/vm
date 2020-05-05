<?php

class Categorias_model extends CI_Model {

    public function add_categorias($data) {

        $this->db->insert('ci_catfin', $data);

        return true;
    }

    //---------------------------------------------------
    // get all tipos for server-side datatable processing (ajax based)

    public function get_all_categorias() {

        $wh = array();

        $SQL = 'SELECT * FROM ci_catfin';


        $wh[] = " is_admin = 0";

        if (count($wh) > 0) {

            $WHERE = implode(' and ', $wh);

            return $this->datatable->LoadJson($SQL, $WHERE);
        } else {

            return $this->datatable->LoadJson($SQL);
        }
    }

    public function getTodosCategorias($condicao = array()) {

        $this->db->where($condicao);
        $this->db->from('ci_catfin');
        return $this->db->get()->result();
    }

    //---------------------------------------------------
    // Get tipo detial by ID

    public function get_categorias_by_id($id) {

        $query = $this->db->get_where('ci_catfin', array('id' => $id));

        return $result = $query->row_array();
    }

    //---------------------------------------------------
    // Edit tipo Record

    public function edit_categorias($data, $id) {

        $this->db->where('id', $id);

        $this->db->update('ci_catfin', $data);

        return true;
    }

    //---------------------------------------------------
    // Change tipo status
    //-----------------------------------------------------

    function change_status()
		{		
			$this->db->set('is_active', $this->input->post('status'));
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('ci_catfin');
		} 

    //---------------------------------------------------
    // get tipos for csv export

    public function get_tipos_for_export() {



        $this->db->where('is_admin', 0);

        $this->db->select('id, categorias, created_at');
        $this->db->from('ci_catfin');

        $query = $this->db->get();

        return $result = $query->result_array();
    }

}

?>