<?php

class Dashboard_model extends CI_Model {

    public function get_all_users() {

        return $this->db->count_all('ci_users');
    }

    public function get_active_users() {

        $this->db->where('is_active', 1);

        return $this->db->count_all_results('ci_users');
    }

    public function get_deactive_users() {

        $this->db->where('is_active', 0);

        return $this->db->count_all_results('ci_users');
    }

    public function get_all_clientes() {

        return $this->db->count_all('ci_clientes');
    }

    public function get_all_admin() {

        return $this->db->count_all('ci_admin');
    }

    public function get_all_machines() {

        
        $this->db->select('count(id) as total');
        $this->db->from('ci_machines');
        $this->db->where('is_active', '1');
        $query = $this->db->get();

        return $query->row()->total;
    }

    public function get_active_clientes() {

        $this->db->where('is_active', 1);

        return $this->db->count_all_results('ci_clientes');
    }

    public function get_all_pontos() {

       

        $this->db->select('count(id) as total');
        $this->db->from('ci_pontos');
        $this->db->where('is_active', 1);
        $query = $this->db->get();

        return $query->row()->total;
    }

    public function get_deactive_clientes() {

        $this->db->where('is_active', 0);

        return $this->db->count_all_results('ci_clientes');
    }

    public function __construct() {
        $this->load->database();
    }

    public function get_list() {

        $query = $this->db->get('ci_pontos');
        return $query->result();
    }

}
?>

