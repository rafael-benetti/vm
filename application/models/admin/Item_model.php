<?php

class Item_model extends CI_Model {

    public function add_item($data) {

        $this->db->insert('ci_itens', $data);
        
        return $this->db->insert_id();

    }
    
     function get_itens_by_user($user_id) {

        $this->db->select('eo.item_id, eo.id as id, eo.qtde as qtde_operador, i.item, i.valor');
        $this->db->where('user_id', $user_id);
        $this->db->from('ci_itens i');        
        $this->db->join('ci_estoque_operador eo', 'eo.item_id = i.id');
        $this->db->group_by('eo.item_id');
        $query = $this->db->get();

         return $query->result_array();
    }
    
    public function add_log_item($data) {

        $this->db->insert('ci_estoque_operador', $data);
        return $this->db->insert_id();
    }
    
    function get_iten_by_user($user_id, $item_id) {

        /*
        $this->db->select('eo.created_at as data_log, eo.tipo_operacao, eo.item_id, eo.id as id, eo.qtde as qtde_operador, i.item, i.valor');
        $this->db->where('user_id', $user_id);
        $this->db->where('item_id', $item_id);
        $this->db->from('ci_itens i');        
        $this->db->join('ci_estoque_operador eo', 'eo.item_id = i.id');
        $query = $this->db->get();
         * 
         */
        
        
			$wh =array();

			$SQL ='SELECT eo.user_id, eo.created_at as data_log, eo.tipo_operacao, eo.item_id, eo.id as id, eo.qtde as qtde_operador, i.item, i.valor 
                            FROM ci_itens i join ci_estoque_operador eo ON  eo.item_id = i.id
                           
                            ';
                       
			$wh[] = " eo.user_id = ".$user_id." AND item_id = ".$item_id." ";

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
    
    public function get_iten_by_id($id){

			$query = $this->db->get_where('ci_itens', array('id' => $id));

			return $result = $query->row();

		}
    
    
    
       function get_total_estoque_machines($user_id, $item_id) {

        $this->db->select('sum(qtde) as total');
        $this->db->where('user_id', $user_id);
        $this->db->where('item_id', $item_id);
        $this->db->from('ci_estoque_operador');
        $query = $this->db->get();

        return $query->row()->total;
    }

// obter todos os itens para processamento de dados no servidor (ajax based)
		public function get_all_itens(){

			$wh =array();

			$SQL ='SELECT * FROM ci_itens';
                       
			$wh[] = " is_admin = 0 ";

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
                
                
                             
                public function getTodosItens($condicao = array()){
		       $this->db->where($condicao);
                       $this->db->from('ci_itens');
                       return $this->db->get()->result_array();

		}
                
    // pegar detalhes pelo ID
		public function get_itens_by_id($id){

			$query = $this->db->get_where('ci_itens', array('id' => $id));

			return $result = $query->row_array();

		}
    
    function change_status()

		{		
			$this->db->set('is_active', $this->input->post('status'));

			$this->db->where('id', $this->input->post('id'));

			$this->db->update('ci_itens');
		} 

    // Edit item Record

		public function edit_item($data, $id){

			$this->db->where('id', $id);

			$this->db->update('ci_itens', $data);

			return true;

		}
                
                
                    	// get all machines for server-side datatable processing (ajax based)
		public function get_estoque_itens($id_item){
			$wh = array();

                        $wh[] = " item_id =  '".$id_item."'";
			
			$SQL ='SELECT e.id as id, e.tipo_operacao,e.user_id,  e.qtde, e.item_id, e.created_at as data_log,
                                i.item, i.quantidade, i.valor, i.is_active as item_ativo
			FROM ci_estoque_itens as e
				INNER JOIN ci_itens as i ON i.id = e.item_id';
                        
                        
                        
                        
                        
                        
                
                        

        			
			if(count($wh)>0) {

				$WHERE = implode(' and ',$wh);

				return $this->datatable->LoadJson($SQL,$WHERE);

			} else {

				return $this->datatable->LoadJson($SQL);

			}

		}
                
                  function get_total_estoque_itens($id_item){
                    
                        $this->db->select('sum(qtde) as total');
                        $this->db->where('item_id', $id_item);
                        $this->db->from('ci_estoque_itens');
                        $query = $this->db->get();
                              
                        return $query->row()->total;
                    
                }
                public function add_log_itens($data){

			$this->db->insert('ci_estoque_itens', $data);
			return $this->db->insert_id();

		}
    
    
    
    
}

?>