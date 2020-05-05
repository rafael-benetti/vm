<?php

	class Cliente_model extends CI_Model{
		
		

		public function add_cliente($data){

			$this->db->insert('ci_clientes', $data);

			return true;

		}



		//---------------------------------------------------

		// get all clientes for server-side datatable processing (ajax based)

		public function get_all_clientes(){

			$wh =array();

			$SQL ='SELECT * FROM ci_clientes';

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





		//---------------------------------------------------

		// Get cliente detial by ID

		public function get_cliente_by_id($id){

			$query = $this->db->get_where('ci_clientes', array('id' => $id));

			return $result = $query->row_array();

		}



		//---------------------------------------------------

		// Edit cliente Record

		public function edit_cliente($data, $id){

			$this->db->where('id', $id);

			$this->db->update('ci_clientes', $data);

			return true;

		}



		//---------------------------------------------------

		// Change cliente status

		//-----------------------------------------------------

		function change_status()

		{		

			$this->db->set('is_active', $this->input->post('status'));

			$this->db->where('id', $this->input->post('id'));

			$this->db->update('ci_clientes');

		} 



		//---------------------------------------------------

		// get users for csv export

		public function get_clientes_for_export(){

			

			$this->db->where('is_admin', 0);

			$this->db->select('id, clienteusername, clientename, sobrenome, email, fone, created_at');

			$this->db->from('ci_clientes');

			$query = $this->db->get();

			return $result = $query->result_array();

		}



	}



?>