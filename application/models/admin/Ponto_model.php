<?php

	class Ponto_model extends CI_Model{



		public function add_ponto($data){

			$this->db->insert('ci_pontos', $data);

			return true;

		}
                
                  public function getTodosPontos($condicao = array()){

		       $this->db->where($condicao);
                       $this->db->from('ci_pontos');
                       return $this->db->get()->result();

		}
                
                 public function getTodosPontosOperador($condicao = array()){

                       $this->db->select('distinct(p.id) as id, p.ponto');
		       $this->db->where($condicao);
                       $this->db->from('ci_pontos p');
                       $this->db->join('ci_users_pontos up', 'up.ponto_id = p.id');

                       return $this->db->get()->result();

		}



		//---------------------------------------------------

		// get all pontos for server-side datatable processing (ajax based)

		public function get_all_pontos(){

			$wh =array();

			$SQL ='SELECT * FROM ci_pontos';

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

		// Get ponto detial by ID

		public function get_ponto_by_id($id){

			$query = $this->db->get_where('ci_pontos', array('id' => $id));

			return $result = $query->row_array();

		}



		//---------------------------------------------------

		// Edit ponto Record

		public function edit_ponto($data, $id){

			$this->db->where('id', $id);

			$this->db->update('ci_pontos', $data);

			return true;

		}



		//---------------------------------------------------

		// Change ponto status

		//-----------------------------------------------------

		function change_status()

		{		

			$this->db->set('is_active', $this->input->post('status'));

			$this->db->where('id', $this->input->post('id'));

			$this->db->update('ci_pontos');

		} 



		//---------------------------------------------------

		// get pontos for csv export

		public function get_pontos_for_export(){

			

			$this->db->where('is_admin', 0);

			$this->db->select('id, ponto, nomefan, email, telefone, created_at');

			$this->db->from('ci_pontos');

			$query = $this->db->get();

			return $result = $query->result_array();

		}



	}



?>