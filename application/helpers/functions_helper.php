<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
    
    // -----------------------------------------------------------------------------
    //check auth
    if (!function_exists('auth_check')) {
        function auth_check()
        {
            // Get a reference to the controller object
            $ci =& get_instance();
            if(!$ci->session->has_userdata('is_admin_login'))
            {
                redirect('admin/auth/login', 'refresh');
            }
        }
    }
    
     //check auth
    if (!function_exists('get_nome_mes')) {
        function get_nome_mes($id)
        {
           
           switch ($id) {
        case 1:    $mes = 'Jan';     break;
        case 2:    $mes = 'Fev';   break;
        case 3:    $mes = 'Mar';       break;
        case 4:    $mes = 'Abr';       break;
        case 5:    $mes = 'Mai';        break;
        case 6:    $mes = 'Jun';       break;
        case 7:    $mes = 'Jul';       break;
        case 8:    $mes = 'Ago';      break;
        case 9:    $mes = 'Set';    break;
        case 10:    $mes ='Out';     break;
        case 11:    $mes = 'Nov';    break;
        case 12:    $mes = 'Dez';    break; 
 }
 return $mes;
            
        }
    }
    
     //check auth
    if (!function_exists('verifica_permissao')) {
        function verifica_permissao($modulo, $operacao)
        {
            // Get a reference to the controller object
            $ci =& get_instance();
            $acessos = $ci->session->userdata('module_access');
            
           
            if($ci->session->userdata('is_supper'))
			return 1;		
                elseif(isset($acessos[$modulo][$operacao])) 
			return 1;
		
		else 
		 	return 0;
            
            
        }
    }
    
    
if (!function_exists('dateEmMysql')) {

    function dateEmMysql($dateSql) {
        $ano = substr($dateSql, 6);
        $mes = substr($dateSql, 3, -5);
        $dia = substr($dateSql, 0, -8);
        return $ano . "-" . $mes . "-" . $dia;
    }

}

if (!function_exists('inverteData')) {

    function inverteData($data) {
        if (count(explode("/", $data)) > 1) {
            return implode("-", array_reverse(explode("/", $data)));
        } elseif (count(explode("-", $data)) > 1) {
            return implode("/", array_reverse(explode("-", $data)));
        }
    }

}
if (!function_exists('dataBrasileira')) {

    function dataBrasileira($data) {
       $data_ = explode("-", $data);
     
            $nova_data = $data__[0]."/".$data_[1]."/".$data_[3];
            
            return $nova_data;
    }


}
    


    // -----------------------------------------------------------------------------
    // Get General Setting
    if (!function_exists('get_general_settings')) {
        function get_general_settings()
        {
            $ci =& get_instance();
            $ci->load->model('admin/setting_model');
            return $ci->setting_model->get_general_settings();
        }
    }

    // -----------------------------------------------------------------------------
    //get recaptcha
    if (!function_exists('generate_recaptcha')) {
        function generate_recaptcha()
        {
            $ci =& get_instance();
            if ($ci->recaptcha_status) {
                $ci->load->library('recaptcha');
                echo '<div class="form-group mt-2">';
                echo $ci->recaptcha->getWidget();
                echo $ci->recaptcha->getScriptTag();
                echo ' </div>';
            }
        }
    }

    // ----------------------------------------------------------------------------
    //print old form data
    if (!function_exists('old')) {
        function old($field)
        {
            $ci =& get_instance();
            return html_escape($ci->session->flashdata('form_data')[$field]);
        }
    }

    // --------------------------------------------------------------------------------
    if (!function_exists('date_time')) {
        function date_time($datetime) 
        {
           return date('F j, Y',strtotime($datetime));
        }
    }

    // --------------------------------------------------------------------------------
    // limit the no of characters
    if (!function_exists('text_limit')) {
        function text_limit($x, $length)
        {
          if(strlen($x)<=$length)
          {
            echo $x;
          }
          else
          {
            $y=substr($x,0,$length) . '...';
            echo $y;
          }
        }
    }

	/**
	 * --------------------------------------------------------------------------------
	 * fct_print_debug :
	 * --------------------------------------------------------------------------------
	**/
	if ( ! function_exists('fct_print_debug')){
		function fct_print_debug($value) {
			print '<pre style="margin:5px;">'; print_r($value); print '</pre>';
			//print '<pre style="margin:5px;">'; var_dump($value); print '</pre>';
			//print '<pre style="margin:5px;">'; print_r(get_class_methods( $this->fMDemail) ); print '</pre>';
		}
	}


	/**
	 * --------------------------------------------------------------------------------
	 * fct_date2bd: formata data
	 * --------------------------------------------------------------------------------
	 */
	if ( ! function_exists('fct_date2bd')){
		function fct_date2bd($pDate="", $format="Y-m-d") {
			if(empty($pDate)) return "";
			list($sDia, $sMes, $sAno) = preg_split('/[\/.-]+/', $pDate);
			$dteReturn = date($format, strtotime($sAno ."-".$sMes ."-".$sDia));
			return $dteReturn;
		}
	};

?>