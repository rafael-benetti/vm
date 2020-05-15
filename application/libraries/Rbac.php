<?php
class RBAC 
{	
	private $module_access;
	function __construct()
	{
		$this->obj =& get_instance();
		$this->obj->module_access = $this->obj->session->userdata('module_access');
		$this->obj->is_supper = $this->obj->session->userdata('is_supper');
	}

	//----------------------------------------------------------------
	function set_access_in_session()
	{
		$this->obj->db->from('module_access');
		$this->obj->db->where('admin_role_id',$this->obj->session->userdata('admin_role_id'));
		$query=$this->obj->db->get();
		$data=array();
		foreach($query->result_array() as $v)
		{
			$data[$v['module']][$v['operation']] = '';
		}
	
		$this->obj->session->set_userdata('module_access',$data);

	}

	
	//--------------------------------------------------------------	
	function check_module_access()
	{
            $error = true;

		if($this->obj->is_supper){
			return 1;
		}             
                elseif($this->check_module_permission($this->obj->uri->segment(1),$this->obj->uri->segment(2))) //sending controller name
		{
			 $error = false;
		}
		elseif($this->check_module_permission($this->obj->uri->segment(2), $this->obj->uri->segment(3))) //sending controller name
		{
                    echo 2; exit;
			
                         $error = false;
		
		}
               
                elseif($this->check_module_permission($this->obj->uri->segment(3),$this->obj->uri->segment(4))) //sending controller name
		{
			 $error = false;
		}
		elseif(!$this->check_module_permission($this->obj->uri->segment(4), $this->obj->uri->segment(5))) //sending controller name
		{
			
                         $error = false;
		
		}

       
                       $back_to = $_SERVER['REQUEST_URI'];
			$back_to = $this->obj->functions->encode($back_to);
                if($error){
                   redirect('access_denied/index/'.$back_to); 
                }
                
	}

	//--------------------------------------------------------------	
	function check_module_permission($module, $tipo_acesso='') // $module is controller name
	{
		$access = false;
                
     
		
		if($this->obj->is_supper)
			return true;
       
                
		elseif(isset($this->obj->module_access[$module])){
             
			foreach($this->obj->module_access[$module] as $key => $value)
			{
			  if($key == 'access'){
			  	$access = true;
			  }
                          if($tipo_acesso == $key){
			  	$access = true;
			  }
			}

			if($access)
				return 1;
			else 
			 	return 0;
		}
	}

	//--------------------------------------------------------------	
	function check_operation_access()
	{
		if($this->obj->is_supper){
			return 1;
		}
		elseif(!$this->check_operation_permission($this->obj->uri->segment(3)))
		{
			$back_to =$_SERVER['REQUEST_URI'];
			$back_to = $this->obj->functions->encode($back_to);
			redirect('access_denied/index/'.$back_to);
		}
	}

	//--------------------------------------------------------------	
	function Check_operation_permission($operation)
	{
		if($this->obj->is_supper){
			return 1;
		}
		elseif(isset($this->obj->module_access[$this->obj->uri->segment(2)][$operation])) 
			return 1;
		else 
		 	return 0;
	}


}
?>