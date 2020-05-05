<?php

class Financeiro_model extends CI_Model {

    public function add_despesa($data) {
        $this->db->insert('ci_financeiro', $data);
        return true;
    }

    
    public function get($id = null){
        if ($id) {
            $this->db->where('id',$id);
        }
        return $this->db->get('ci_financeiro');
		}
    
// obter todos os itens para processamento de dados no servidor (ajax based)
		public function get_all_financeiro(){
			$wh =array();
			$SQL ='SELECT * FROM ci_financeiro';
                       	$wh[] = " is_admin = 0";
			if(count($wh)>0)
			{
				$WHERE = implode(' and ',$wh);
				return $this->datatable->LoadJson($SQL,$WHERE);
			}
			else
			{
				return $this->datatable->LoadJson($SQL);
			}
		}
                
                
                
    // pegar detalhes pelo ID
		public function get_financeiro_by_id($id){
			$query = $this->db->get_where('ci_financeiro', array('id' => $id));
			return $result = $query->row_array();
		}
    


                
    // Edit item Record
		public function edit_item($data, $id){
			$this->db->where('id', $id);
			$this->db->update('ci_itens', $data);
			return true;
		}
    
    
                
                
                
    //CATEGORIAS ---------------------------------------------------------------------
                
        public function add_cat($data) {
        $this->db->insert('ci_catfin', $data);
        return true;
    }
    
    
}?>