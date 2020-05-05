<?php

	class Tipo_model extends CI_Model{



		public function add_tipo($data){

			$this->db->insert('ci_tipos', $data);
                        
                           return $this->db->insert_id();

			

		}



		//---------------------------------------------------

		// get all tipos for server-side datatable processing (ajax based)

		public function get_all_tipos(){

			$wh =array();

			$SQL ='SELECT * FROM ci_tipos';

                       
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

                
                public function getTodosTipos($condicao = array()){

		       $this->db->where($condicao);
                       $this->db->from('ci_tipos');
                       return $this->db->get()->result();

		}




		//---------------------------------------------------

		// Get tipo detial by ID

		public function get_tipo_by_id($id){

			$query = $this->db->get_where('ci_tipos', array('id' => $id));

			return $result = $query->row_array();

		}



		//---------------------------------------------------

		// Edit tipo Record

		public function edit_tipo($data, $id){

			$this->db->where('id', $id);

			$this->db->update('ci_tipos', $data);

			return true;

		}



		//---------------------------------------------------

		// Change tipo status

		//-----------------------------------------------------

		function change_status()

		{		

			$this->db->set('is_active', $this->input->post('status'));

			$this->db->where('id', $this->input->post('id'));

			$this->db->update('ci_tipos');

		} 



		//---------------------------------------------------

		// get tipos for csv export

		public function get_tipos_for_export(){

			

			$this->db->where('is_admin', 0);

			$this->db->select('id, tipo, created_at');
			$this->db->from('ci_tipos');

			$query = $this->db->get();

			return $result = $query->result_array();

		}



	}



?>