<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes extends MY_Controller {



	public function __construct(){



		parent::__construct();

		auth_check(); // check login auth

		$this->rbac->check_module_access();



		$this->load->model('admin/cliente_model', 'cliente_model');

	}



	//-----------------------------------------------------------

	public function index(){



		$this->load->view('admin/includes/_header');

		$this->load->view('admin/clientes/cliente_list');

		$this->load->view('admin/includes/_footer');

	}

	

	public function datatable_json(){				   					   

		$records = $this->cliente_model->get_all_clientes();

		$data = array();



		$i=0;

		foreach ($records['data']  as $row) 

		{  

			$status = ($row['is_active'] == 1)? 'checked': '';

			$data[]= array(

				++$i,

				$row['clienteusername'],

				$row['email'],

				$row['fone'],

				date_time($row['created_at']),	

				'<input class="tgl_checkbox tgl-ios" 

				data-id="'.$row['id'].'" 

				id="cb_'.$row['id'].'"

				type="checkbox"  

				'.$status.'><label for="cb_'.$row['id'].'"></label>',		



				'<a title="View" class="view btn btn-sm btn-info" href="'.base_url('admin/clientes/edit/'.$row['id']).'"> <i class="fa fa-eye"></i></a>

				<a title="Edit" class="update btn btn-sm btn-warning" href="'.base_url('admin/clientes/edit/'.$row['id']).'"> <i class="fa fa-pencil-square-o"></i></a>

				<a title="Delete" class="delete btn btn-sm btn-danger" href='.base_url("admin/clientes/delete/".$row['id']).' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> <i class="fa fa-trash-o"></i></a>'

			);

		}

		$records['data']=$data;

		echo json_encode($records);						   

	}



	//-----------------------------------------------------------

	function change_status()

	{   

		$this->cliente_model->change_status();

	}



	//---------------------------------------------------------------

	public function add(){

		

		$this->rbac->check_operation_access(); // check opration permission



		if($this->input->post('submit')){

			$this->form_validation->set_rules('clienteusername', 'Username', 'trim|required');

			$this->form_validation->set_rules('clientename', 'Firstname', 'trim|required');

			$this->form_validation->set_rules('sobrenome', 'Lastname', 'trim|required');

			$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');

			$this->form_validation->set_rules('fone', 'Number', 'trim|required');

			$this->form_validation->set_rules('password', 'Password', 'trim|required');



			if ($this->form_validation->run() == FALSE) {

				$data = array(

					'errors' => validation_errors()

				);

				$this->session->set_flashdata('errors', $data['errors']);

				redirect(base_url('admin/clientes/add'),'refresh');

			}

			else{

				$data = array(

					'clienteusername' => $this->input->post('clienteusername'),

					'clientename' => $this->input->post('clientename'),

					'sobrenome' => $this->input->post('sobrenome'),

					'email' => $this->input->post('email'),

					'fone' => $this->input->post('fone'),

					'address' => $this->input->post('address'),

					'password' =>  password_hash($this->input->post('password'), PASSWORD_BCRYPT),

					'created_at' => date('Y-m-d : h:m:s'),

					'updated_at' => date('Y-m-d : h:m:s'),

				);

				$data = $this->security->xss_clean($data);

				$result = $this->cliente_model->add_cliente($data);

				if($result){

					$this->session->set_flashdata('success', 'Cliente has been added successfully!');

					redirect(base_url('admin/clientes'));

				}

			}

		}

		else{

			$this->load->view('admin/includes/_header');

			$this->load->view('admin/clientes/cliente_add');

			$this->load->view('admin/includes/_footer');

		}

		

	}



	//---------------------------------------------------------------

	public function edit($id = 0){



		$this->rbac->check_operation_access(); // check opration permission



		if($this->input->post('submit')){

			$this->form_validation->set_rules('clienteusername', 'Username', 'trim|required');

			$this->form_validation->set_rules('clientename', 'Username', 'trim|required');

			$this->form_validation->set_rules('sobrenome', 'Lastname', 'trim|required');

			$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');

			$this->form_validation->set_rules('fone', 'Number', 'trim|required');

			$this->form_validation->set_rules('status', 'Status', 'trim|required');

			if ($this->form_validation->run() == FALSE) {

					$data = array(

						'errors' => validation_errors()

					);

					$this->session->set_flashdata('errors', $data['errors']);

					redirect(base_url('admin/clientes/cliente_edit/'.$id),'refresh');

			}

			else{

				$data = array(

					'clienteusername' => $this->input->post('clienteusername'),

					'clientename' => $this->input->post('clientename'),

					'sobrenome' => $this->input->post('sobrenome'),

					'email' => $this->input->post('email'),

					'fone' => $this->input->post('fone'),

					'password' =>  password_hash($this->input->post('password'), PASSWORD_BCRYPT),

					'is_active' => $this->input->post('status'),

					'updated_at' => date('Y-m-d : h:m:s'),

				);

				$data = $this->security->xss_clean($data);

				$result = $this->cliente_model->edit_cliente($data, $id);

				if($result){

					$this->session->set_flashdata('success', 'Cliente has been updated successfully!');

					redirect(base_url('admin/clientes'));

				}

			}

		}

		else{

			$data['cliente'] = $this->cliente_model->get_cliente_by_id($id);

			

			$this->load->view('admin/includes/_header');

			$this->load->view('admin/clientes/cliente_edit', $data);

			$this->load->view('admin/includes/_footer');

		}

	}



	//---------------------------------------------------------------

	public function delete($id = 0)

	{

		$this->rbac->check_operation_access(); // check opration permission

		

		$this->db->delete('ci_clientes', array('id' => $id));

		$this->session->set_flashdata('success', 'Use has been deleted successfully!');

		redirect(base_url('admin/clientes'));

	}





	//---------------------------------------------------------------

	//  Export Users PDF 

	public function create_clientes_pdf(){



		$this->load->helper('pdf_helper'); // loaded pdf helper

		$data['all_clientes'] = $this->cliente_model->get_clientes_for_export();

		$this->load->view('admin/clientes/clientes_pdf', $data);

	}



	//---------------------------------------------------------------	

	// Export data in CSV format 

	public function export_csv(){ 



	   // file name 

		$filename = 'clientes_'.date('Y-m-d').'.csv'; 

		header("Content-Description: File Transfer"); 

		header("Content-Disposition: attachment; filename=$filename"); 

		header("Content-Type: application/csv; ");



	   // get data 

		$cliente_data = $this->cliente_model->get_clientes_for_export();



	   // file creation 

		$file = fopen('php://output', 'w');



		$header = array("ID", "Clienteusername", "Clientename", "sobrenome", "Email", "Fone", "Created Date"); 



		fputcsv($file, $header);

		foreach ($C_data as $key=>$line){ 

			fputcsv($file,$line); 

		}

		fclose($file); 

		exit; 

	}



}





?>