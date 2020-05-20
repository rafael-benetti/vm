<?php

class Operar_model extends CI_Model {

    public function add_operacao($data) {
        $this->db->insert('ci_operacoes', $data);
            return $this->db->insert_id();
    }
    
    
     public function get_machines_by_user($user_id, $ponto_id) {

    
         
        $this->db->select('m.id as id_maquina, m.nome_imagem, m.item_id, m.tipomaquina, m.pontodevenda, m.serial, m.cont_inicial, m.cont_saida_inicial, m.valorvenda,
				m.imagem,m.noteiro,m.ficheiro,m.observacoes_equip,m.is_active, m.created_at,m.updated_at,
				t.tipo as nome_tipo, t.id as id_tipo');
        $this->db->from('ci_users_machines um');
        $this->db->where('um.user_id', $user_id);
        $this->db->where('um.ponto_id', $ponto_id);
        $this->db->join('ci_machines m', 'um.maq_id = m.id');
        $this->db->join('ci_tipos t', 't.id = m.tipomaquina');

        return $this->db->get()->result_array();
    }

    public function get($condicao = array(), $primeiraLinha = FALSE, $pagina = 0, $limite = LINHAS_PESQUISA_DASHBOARD) {
      
        $this->db->select('o.created_at as data, o.id as id_operacao, o.cont_anterior, o.cont_atual, o.cont_saida_anterior, o.cont_saida_atual, o.saldo, o.vendas, o.qtde_saida, o.valor_insumo');
        $this->db->select('m.id as id_maquina, m.observacoes_equip');
        $this->db->select('p.id as id_ponto, p.ponto');
        
        if(isset($condicao['data_final'])){
            
          // $this->db->where("o.created_at BETWEEN '{$condicao['data_inicial']}' AND '{$condicao['data_final']}'"); 
           
          
            $this->db->where('DATE(o.created_at) >=', date('Y-m-d',strtotime($condicao['data_inicial'])));
            $this->db->where('DATE(o.created_at) <=', date('Y-m-d',strtotime($condicao['data_final'])));

            unset($condicao['data_inicial']);
             unset($condicao['data_final']);
        }
        
        $this->db->where($condicao);
        $this->db->from('ci_operacoes o');
        $this->db->join('ci_machines m', 'm.id = o.maq_id', 'JOIN');
        $this->db->join('ci_pontos p', 'm.pontodevenda = p.id', 'JOIN');
        $this->db->order_by("o.id", "asc");


        if ($primeiraLinha) {
            return $this->db->get()->first_row();
        } else {

            if ($pagina == 1)
                $this->db->limit(LINHAS_PESQUISA_DASHBOARD);
            else
                $this->db->limit(LINHAS_PESQUISA_DASHBOARD, $pagina - 1);
            return $this->db->get()->result();
        }
    }
    
    public function getTotalVendas($condicao = array(), $tipo = 'entrada') {
        if($tipo == 'saida')        
        $this->db->select('sum(o.saidas) as total');    
        else
        $this->db->select('sum(o.vendas) as total');      
        
        
        if(isset($condicao['data_final'])){
            
       //     $this->db->where("o.created_at BETWEEN '{$condicao['data_inicial']}' AND '{$condicao['data_final']}"); 
           
            $this->db->where('DATE(o.created_at) >=', date('Y-m-d',strtotime($condicao['data_inicial'])));
            $this->db->where('DATE(o.created_at) <=', date('Y-m-d',strtotime($condicao['data_final'])));
       unset($condicao['data_inicial']);
             unset($condicao['data_final']);
        }
        
        $this->db->where($condicao);
         $this->db->from('ci_operacoes o');
        $this->db->join('ci_machines m', 'm.id = o.maq_id', 'JOIN');
        $this->db->join('ci_pontos p', 'm.pontodevenda = p.id', 'JOIN');
        $this->db->order_by("o.id", "asc");
         $by_name = $this->db->get();
         return $by_name->row()->total;
        
    }

    public function getTotal($condicao = array()) {
        
           if(isset($condicao['data_final'])){
            
       //  $this->db->where("o.created_at BETWEEN '{$condicao['data_inicial']}' AND '{$condicao['data_final']}"); 
           
            $this->db->where('DATE(o.created_at) >=', date('Y-m-d',strtotime($condicao['data_inicial'])));
            $this->db->where('DATE(o.created_at) <=', date('Y-m-d',strtotime($condicao['data_final'])));
          unset($condicao['data_inicial']);
             unset($condicao['data_final']);
        }
        $this->db->where($condicao);
        $this->db->from('ci_operacoes o');
        $this->db->join('ci_machines m', 'm.id = o.maq_id', 'JOIN');
        $this->db->join('ci_pontos p', 'm.pontodevenda = p.id', 'JOIN');
        return $this->db->count_all_results();
    }

    // -----------------------------------------------------
    // get all machines for server-side datatable processing (ajax based)
    // -----------------------------------------------------
    public function get_all_operacao($wh = array()) {
        //$SQL = 'SELECT * FROM ci_operacoes';

        $SQL = 'SELECT OP.*, 
				`MQ`.`serial`, 
				`MQ`.`valorvenda`,				
				`TP`.`tipo`
			FROM `ci_operacoes` OP
			INNER JOIN `ci_machines` `MQ` ON `MQ`.`id` = OP.`maq_id`
			INNER JOIN `ci_tipos` `TP` ON `TP`.`id` = MQ.`tipomaquina`  ';

        if (count($wh) > 0) {
            $WHERE = implode(' and ', $wh);
            $json = $this->datatable->LoadJson($SQL, $WHERE);
            //fct_print_debug( $json );
            return $json;
        } else {
            $json = $this->datatable->LoadJson($SQL);
            //fct_print_debug( $json );
            return $json;
        }
    }

    // -----------------------------------------------------
    // Change machine status
    // -----------------------------------------------------
    function change_status() {
        $this->db->set('is_active', $this->input->post('status'));
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('ci_operacoes');
    }

    // -----------------------------------------------------
    // Get machine detial by ID
    // -----------------------------------------------------
    public function get_operacao_by_id($id) {

        //$query = $this->db->get_where('ci_operacoes', array('id' => $id));

        $this->db->select(" OP.* ") // ,
                ->select(" MQ.serial, MQ.valorvenda, MQ.tipomaquina, MQ.pontodevenda ")
                ->select(" PT.ponto, PT.comissao ")
                ->select(" TP.tipo ")
                ->from('ci_operacoes OP')
                ->join('ci_machines MQ', 'MQ.id = OP.maq_id', 'INNER')
                ->join('ci_pontos PT', 'PT.id = MQ.pontodevenda', 'INNER')
                ->join('ci_tipos TP', 'TP.id = MQ.tipomaquina', 'INNER')
        ;
        $this->db->where(array('OP.id' => $id));
        $query = $this->db->get();

        return $result = $query->row_array();
    }

    // -----------------------------------------------------
    //
		// -----------------------------------------------------
    public function get_operacao_inner_by_id($id) {

        $this->db->select(" OP.* ")
                ->select(" MQ.serial, MQ.valorvenda ")
                ->select(" TP.tipo ")
                ->from('ci_operacoes OP')
                ->join('ci_machines MQ', 'MQ.id = OP.maq_id', 'INNER')
                ->join('ci_tipos TP', 'TP.id = MQ.tipomaquina', 'INNER')
        ;
        $this->db->where(array('OP.id' => $id));
        $query = $this->db->get();
        //fct_print_debug( $this->db->last_query() );
        //$query = $this->db->get_where('ci_operacoes', array('id' => $id));

        return $result = $query->row_array();
    }

    // -----------------------------------------------------
    //
		// -----------------------------------------------------
    public function get_maquias_e_tipos($wh = array()) {

        /*
          SELECT Distinct MQ.id, MQ.pontodevenda , MQ.serial,  TP.tipo
          FROM ci_machines MQ
          INNER JOIN  ci_tipos TP ON TP.id = MQ.tipomaquina
         */

        $this->db->distinct()
                ->select(" MQ.id, MQ.pontodevenda , MQ.serial ")
                ->select(" TP.tipo ")
                ->from('ci_machines MQ')
                ->join('ci_tipos TP', 'TP.id = MQ.tipomaquina', 'JOIN');
        if (count($wh) > 0) {
            $this->db->where($wh);
        }
        $query = $this->db->get();
      //  fct_print_debug( $this->db->last_query() ); exit;

        return $result = $query->result_array();
    }

    // -----------------------------------------------------
    // Delete
    // -----------------------------------------------------
    public function delete_operacao($id) {

        $this->db->delete('ci_operacoes', array('id' => $id));
    }

    // -----------------------------------------------------
    // 
    // -----------------------------------------------------
    public function get_cont_machines($where) {

        $query = $this->db->select("cont_inicial, cont_saida_inicial")
                ->order_by('id', 'DESC')
                ->get_where('ci_machines', $where);
        return $result = $query->row_array();
    }

    // -----------------------------------------------------
    // 
    // -----------------------------------------------------
    public function get_cont_machines_atual($where) {

        $query = $this->db->select(" cont_anterior, cont_atual, cont_saida_anterior, cont_saida_atual ")
                        ->order_by('id', 'DESC')->get_where('ci_operacoes', $where);
        return $result = $query->row_array();
    }

    //---------------------------------------------------
    // Edit machine Record

    public function edit_operacao($data, $id) {

        $this->db->where('id', $id);

        $this->db->update('ci_operacoes', $data);

        return true;
    }

    //---------------------------------------------------
    // get machines for csv export

    public function get_operacao_for_export() {



        $this->db->where('is_admin', 0);

        $this->db->select('id, machine, nomefan, email, telefone, created_at');

        $this->db->from('ci_operacoes');

        $query = $this->db->get();

        return $result = $query->result_array();
    }

}

?>