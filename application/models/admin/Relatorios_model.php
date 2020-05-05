<?php

class Relatorios_model extends CI_Model {

    public function add_item($data) {

        $this->db->insert('ci_itens', $data);

        return true;
}





// pdf export

                
                



    }