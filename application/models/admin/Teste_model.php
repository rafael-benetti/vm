<?php

	class Teste_model extends CI_Model{
            
            public Function inserir(){
                $dados = array("msg" => $thir->msg);
                return $this->db->insert ('post',$dados);
                
                
        }
     }
             
