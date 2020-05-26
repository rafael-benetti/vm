<?php
	class Rotas_model extends CI_Model{

		public function add_rota($data){
			$this->db->insert('ci_rotas', $data);
			return $this->db->insert_id();
		}
                
                public function add_rota_ponto($data){
			$this->db->insert('ci_rotas_pontos', $data);
			return $this->db->insert_id();
		}
                       
                public function get_all_rotas(){
			$wh =array();
			$SQL ='SELECT  u.id as user_id,r.operador, u.firstname, u.lastname,r.is_active as is_active, r.nome, r.id, r.pontos FROM ci_rotas r join ci_admin u ON u.id = r.user_id';
			//$wh[] = " is_admin = 0";
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
                
                
       
                
                public function get_rotas_pontos($id){
			$wh = array();
			
				$wh[] = " id =  '".$id."'";
			
			$SQL ='SELECT 
                                um.id as id, um.maq_id, m.tipomaquina, m.pontodevenda, m.serial, m.cont_inicial, m.cont_saida_inicial, m.valorvenda,
				m.imagem,m.noteiro,m.ficheiro,m.observacoes_equip as nome_maquina,m.is_active, m.created_at,m.updated_at,
				t.tipo as nome_tipo, p.ponto as nome_ponto, t.id as id_tipo, p.id as id_ponto
                                
                        FROM ci_rotas as um
				INNER JOIN ci_rotas as m ON m.id = um.id 
				INNER JOIN ci_tipos as t ON t.id = m.tipomaquina 
				INNER JOIN ci_pontos as p ON p.id=m.pontodevenda';
                        
     
        			
			if(count($wh)>0) {

				$WHERE = implode(' and ',$wh);

				return $this->datatable->LoadJson($SQL,$WHERE);

			} else {

				return $this->datatable->LoadJson($SQL);

			}

		}
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                                
                  public function delete_rotaosontas($user_id, $ponto_id){
			$this->db->where('user_id', $user_id);
			$this->db->where('ponto_id', $ponto_id);
			$this->db->delete('ci_users_machines');
			return true;
		}
                
                public function add_user_ponto($data){
			$this->db->insert('ci_users_pontos', $data);
			return $this->db->insert_id();
		}
                public function add_user_machine($data){
			$this->db->insert('ci_users_machines', $data);
			return $this->db->insert_id();
		}
                public function delete_user_ponto($user_id){
			$this->db->where('user_id', $user_id);
			$this->db->delete('ci_users_pontos');
			return true;
		}
                
               

		//---------------------------------------------------
		// get all users for server-side datatable processing (ajax based)
		
                
                
                
                
                
                
                
                
                
                
		public function getPontosByUserId($user_id){
			$query = $this->db->get_where('ci_users_pontos', array('user_id' => $user_id));
			return $result = $query->result_array();
		}
                
                
                public function get_pontos_by_rota_id($rota_id){
                    
			$this->db->where('rp.rota_id', $rota_id);
			$this->db->from('ci_pontos p');     
                        $this->db->join('ci_rotas_pontos rp', 'rp.ponto_id = p.id');
                   	$query = $this->db->get();
                        return $query->result_array();
		}

                       function get_total_machines_user($user_id){
                    
                        $this->db->select('count(id) as total');
                        $this->db->where('user_id', $user_id);
                        $this->db->from('ci_users_machines');
                        $query = $this->db->get();
                              
                        return $query->row()->total;
                    
                }
                
                
                
                
                

		//---------------------------------------------------
		// Get user detial by ID
		public function get_user_by_id($id){
			$query = $this->db->get_where('ci_users', array('id' => $id));
			return $result = $query->row_array();
		}

		//---------------------------------------------------
		// Edit user Record
		public function edit_user($data, $id){
			$this->db->where('id', $id);
			$this->db->update('ci_users', $data);
			return true;
		}

		//---------------------------------------------------
		// Change user status
		//-----------------------------------------------------
		function change_status()
		{		
			$this->db->set('is_active', $this->input->post('status'));
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('ci_users');
		} 

		//---------------------------------------------------
		// get users for csv export
		public function get_users_for_export(){
			
			$this->db->where('is_admin', 0);
			$this->db->select('id, username, firstname, lastname, email, mobile_no, created_at');
			$this->db->from('ci_users');
			$query = $this->db->get();
			return $result = $query->result_array();
		}
		// get users for csv export
		public function getAllProfile(){
			
		
			$this->db->select('*');
			$this->db->from('ci_user_profile');
			$query = $this->db->get();
			return $result = $query->result_array();
		}

	}

?>