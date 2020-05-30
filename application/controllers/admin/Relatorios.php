<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Relatorios extends MY_Controller {

    public function __construct() {
        parent::__construct();
        auth_check(); // check login auth

        $this->load->model('admin/operar_model', 'operar_model');
        $this->load->model('admin/user_model', 'user_model');
        $this->load->model('admin/ponto_model', 'ponto_model');
        $this->load->model('admin/machine_model', 'machine_model');
    }

    //----------------------------------------------------------------

    public function fat_diario() {

        $data['title'] = '';
        $data['url'] = site_url('admin/relatorios/fat_diario');
        $data['relatorios'] = array();
        $data['sem_dados'] = array();
        $data['paginas'] = array();
        $data['pontos'] = $this->ponto_model->getTodosPontos(array('is_active' => 1));

        $totalItens = $this->operar_model->getTotal();


        $totalPaginas = ceil($totalItens / LINHAS_PESQUISA_DASHBOARD);

        $indicePg = 1;
        $pagina = $this->input->get('pagina');
        $pontodevenda = $this->input->get('pontodevenda');
        $maq_id = $this->input->get('maq_id');
        $user_id = $this->input->get('user_id');
        $data_inicial = $this->input->get('data_inicial');
        $data_final = $this->input->get('data_final');
        if (!$pagina) {
            $pagina = 1;
        }
        $pagina = ($pagina == 0) ? 1 : $pagina;

        if ($totalPaginas > $pagina) {
            $data['hab_prox'] = null;
            $data['url_prox'] = site_url('admin/produto?pagina=' . ($pagina + 1));
        } else {
            $data['hab_prox'] = 'disabled';
            $data['url_proximo'] = '#';
        }

        if ($pagina <= 1) {
            $data['hab_anterior'] = 'disabled';
            $data['url_anterior'] = '#';
        } else {
            $data['hab_anterior'] = null;
            $data['url_anterior'] = site_url('admin/relatorios/fat_diario?pagina=' . ($pagina - 1));
        }

        while ($indicePg <= $totalPaginas) {
            $data['paginas'][] = array(
                "link" => ($indicePg == $pagina) ? 'active' : null,
                "indice" => $indicePg,
                "url_link" => site_url('admin/relatorios/fat_diario?pagina=' . $indicePg)
            );

            $indicePg++;
        }




        $pesquisa = array();


 $data['tipos'] = $this->operar_model->get_maquias_e_tipos(array('MQ.is_active' => 1));
        if ($pontodevenda) {
            if ($pontodevenda > 0) {
                $pesquisa['o.ponto'] = $pontodevenda;
                $data['tipos'] = $this->operar_model->get_maquias_e_tipos(array('MQ.pontodevenda'=> $pontodevenda));
                $data['pontodevenda'] = $pontodevenda;
            }
        }
        if ($maq_id) {
            if ($maq_id > 0) {
                $pesquisa['m.id'] = $maq_id;
                $data['maq_id'] = $maq_id;
            }
        }
        if ($user_id) {
            if ($user_id > 0) {
                $pesquisa['o.user_id'] = $user_id;
                $data['user_id'] = $user_id;
            }
        }



        if ($data_inicial && $data_final) {


            $data['data_inicial'] = $data_inicial;
            $data['data_final'] = $data_final;


            $pesquisa['data_inicial'] = inverteDataBanco($data_inicial) . ' 00:00:01';
            $pesquisa['data_final'] = inverteDataBanco($data_final) . ' 23:59:59';
        } else {

                $data_final = date('d-m-Y');
                $data_inicial = date('d-m-Y', strtotime("-1 week"));

                
                $data['data_inicial'] = $data_inicial;
                $data['data_final'] = $data_final;

                $pesquisa['data_inicial'] = inverteDataBanco($data_inicial) . ' 00:00:01';
                $pesquisa['data_final'] = inverteDataBanco($data_final) . ' 23:59:59';
            
        }
  



        $relatorios = $this->operar_model->get($pesquisa, FALSE, $pagina);


        $total_saida = $this->operar_model->getTotalVendas($pesquisa, 'saida');
        $total_entrada = $this->operar_model->getTotalVendas($pesquisa);
        $total_vendas = $total_entrada - $total_saida;

       
        $data['operadores'] = $this->user_model->getAllOperadores();


        $data['total_entrada'] = formatar_moeda($total_entrada);
        $data['total_saida'] = formatar_moeda($total_saida);
        $data['total_vendas'] = formatar_moeda($total_vendas);
        $data['relatorios'] = $relatorios;
        $this->load->view('admin/includes/_header');
        $this->load->view('admin/relatorios/fat_diario', $data);
        $this->load->view('admin/includes/_footer');
    }
    public function fat_sangria() {

        $data['title'] = '';
        $data['url'] = site_url('admin/relatorios/fat_sangria');
        $data['relatorios'] = array();
        $data['sem_dados'] = array();
        $data['paginas'] = array();
        $data['pontos'] = $this->ponto_model->getTodosPontos(array('is_active' => 1));

        $totalItens = $this->operar_model->getTotal();


        $totalPaginas = ceil($totalItens / LINHAS_PESQUISA_DASHBOARD);

        $indicePg = 1;
        $pagina = $this->input->get('pagina');
        $pontodevenda = $this->input->get('pontodevenda');
        $maq_id = $this->input->get('maq_id');
        $user_id = $this->input->get('user_id');
        $data_inicial = $this->input->get('data_inicial');
        $data_final = $this->input->get('data_final');
        if (!$pagina) {
            $pagina = 1;
        }
        $pagina = ($pagina == 0) ? 1 : $pagina;

        if ($totalPaginas > $pagina) {
            $data['hab_prox'] = null;
            $data['url_prox'] = site_url('admin/produto?pagina=' . ($pagina + 1));
        } else {
            $data['hab_prox'] = 'disabled';
            $data['url_proximo'] = '#';
        }

        if ($pagina <= 1) {
            $data['hab_anterior'] = 'disabled';
            $data['url_anterior'] = '#';
        } else {
            $data['hab_anterior'] = null;
            $data['url_anterior'] = site_url('admin/relatorios/fat_diario?pagina=' . ($pagina - 1));
        }

        while ($indicePg <= $totalPaginas) {
            $data['paginas'][] = array(
                "link" => ($indicePg == $pagina) ? 'active' : null,
                "indice" => $indicePg,
                "url_link" => site_url('admin/relatorios/fat_diario?pagina=' . $indicePg)
            );

            $indicePg++;
        }




        $pesquisa = array();


        $data['tipos'] = $this->operar_model->get_maquias_e_tipos(array('MQ.is_active' => 1));
        if ($pontodevenda) {
            if ($pontodevenda > 0) {
                $pesquisa['o.ponto'] = $pontodevenda;
                $data['tipos'] = $this->operar_model->get_maquias_e_tipos(array('MQ.pontodevenda' => $pontodevenda));
                $data['pontodevenda'] = $pontodevenda;
            }
        }
        if ($maq_id) {
            if ($maq_id > 0) {
                $pesquisa['m.id'] = $maq_id;
                $data['maq_id'] = $maq_id;
            }
        }
        if ($user_id) {
            if ($user_id > 0) {
                $pesquisa['o.user_id'] = $user_id;
                $data['user_id'] = $user_id;
            }
        }



        if ($data_inicial && $data_final) {


            $data['data_inicial'] = $data_inicial;
            $data['data_final'] = $data_final;


            $pesquisa['data_inicial'] = inverteDataBanco($data_inicial) . ' 00:00:01';
            $pesquisa['data_final'] = inverteDataBanco($data_final) . ' 23:59:59';
        } else {

            $data_final = date('d-m-Y');
            $data_inicial = date('d-m-Y', strtotime("-1 week"));


            $data['data_inicial'] = $data_inicial;
            $data['data_final'] = $data_final;

            $pesquisa['data_inicial'] = inverteDataBanco($data_inicial) . ' 00:00:01';
            $pesquisa['data_final'] = inverteDataBanco($data_final) . ' 23:59:59';
        }




        $relatorios = $this->operar_model->get($pesquisa, FALSE, $pagina);


        $total_saida = $this->operar_model->getTotalVendas($pesquisa, 'saida');
        $total_entrada = $this->operar_model->getTotalVendas($pesquisa);
        $total_vendas = $total_entrada - $total_saida;


        $data['operadores'] = $this->user_model->getAllOperadores();


        $data['total_entrada'] = formatar_moeda($total_entrada);
        $data['total_saida'] = formatar_moeda($total_saida);
        $data['total_vendas'] = formatar_moeda($total_vendas);
        $data['relatorios'] = $relatorios;
        $this->load->view('admin/includes/_header');
        $this->load->view('admin/relatorios/fat_sangria', $data);
        $this->load->view('admin/includes/_footer');
    }

    public function fat_equipamento() {
        $data['title'] = '';
        $this->load->view('admin/includes/_header');
        $this->load->view('admin/relatorios/fat_equipamento', $data);
        $this->load->view('admin/includes/_footer');
    }

    public function fat_mensal() {
        $data['title'] = '';
        $this->load->view('admin/includes/_header');
        $this->load->view('admin/relatorios/fat_mensal', $data);
        $this->load->view('admin/includes/_footer');
    }

    public function fat_ponto() {
        $data['title'] = '';
        $this->load->view('admin/includes/_header');
        $this->load->view('admin/relatorios/fat_ponto', $data);
        $this->load->view('admin/includes/_footer');
    }

    public function fat_rotas() {
        $data['title'] = '';
        $this->load->view('admin/includes/_header');
        $this->load->view('admin/relatorios/fat_rotas', $data);
        $this->load->view('admin/includes/_footer');
    }

    public function fat_semanal() {
        $data['title'] = '';
        $this->load->view('admin/includes/_header');
        $this->load->view('admin/relatorios/fat_semanal', $data);
        $this->load->view('admin/includes/_footer');
    }

    // pdf export
    public function create_fat_pdf() {

        $this->load->helper('pdf_helper'); // loaded pdf helper
        $data['all_fats'] = $this->relatorios_model->get_fat_for_export();
        $this->load->view('admin/relatorios/fat_pdf', $data);
    }

}
