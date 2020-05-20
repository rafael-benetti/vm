<?php

// fct_print_debug($rs);
$id = (isset($rs["id"]) ? $rs["id"] : "");
$created_at = (isset($rs["created_at"]) ? $rs["created_at"] : "");
$tipomaquina = (isset($rs["nome_tipo"]) ? $rs["nome_tipo"] : "");
$pontodevenda = (isset($ponto->ponto) ? $ponto->ponto : "");
$serial = (isset($rs["serial"]) ? $rs["serial"] : "");
$cont_inicial = (int) (isset($rs["cont_inicial"]) ? $rs["cont_inicial"] : "");
$cont_saida_inicial = (int) (isset($rs["cont_saida_inicial"]) ? $rs["cont_saida_inicial"] : "");
$valorvenda = (isset($rs["valorvenda"]) ? $rs["valorvenda"] : "");
$valordoequipamento= (isset($rs["valordoequipamento"]) ? $rs["valordoequipamento"] : "");
$tipoinsumo = (isset($item['item']) ? $item['item'] : "Não vinculado");
$quant_insumo = (isset($qtde_estoque) ? $qtde_estoque : "Não tem item");
$noteiro = ($rs["noteiro"]==1 ? "Sim" : "Não");
$ficheiro = ($rs["ficheiro"]==1 ? "Sim" : "Não");
$observacoes_equip = (isset($rs["observacoes_equip"]) ? $rs["observacoes_equip"] : "");
$data_cadastro = (isset($rs["data_cadastro"]) ? $rs["data_cadastro"] : "");
?> 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">User Profile</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="card">

        <div class="card-header">
            <div class="d-inline-block">
                <h5><i class="fa fa-info"></i>Detalhes sobre o Equipamento </h5>
            </div>
            <div class="d-inline-block float-right">
                <?php if ($this->rbac->Check_operation_permission('add')): ?>
                    <a href="<?= base_url('admin/machines/'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Listar máquinas</a>
                <?php endif; ?>
            </div>
        </div>

    </div>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class="row">

                <div class="col-md-3">


                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">

                            <h3 class="profile-username text-center"><?php echo($tipomaquina); ?></h3>

                            <p class="text-muted text-center">Nsº <?php echo($serial); ?></p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Data do cadastro: </b> <a class="float-right"><?php echo(inverteDataHora($data_cadastro)); ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Ponto Vinculado: </b> <a class="float-right"><?php echo($pontodevenda); ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Contador Inicial: </b> <a class="float-right"><?php echo($cont_saida_inicial); ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Cont. de Saida Inicial: </b> <a class="float-right"><?php echo($cont_saida_inicial); ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Valor de Venda: </b> <a class="float-right"><?php echo(formatar_moeda($valorvenda)); ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Possui Noteiro: </b> <a class="float-right"><?php echo($noteiro); ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Possui Ficheiro: </b> <a class="float-right"><?php echo($ficheiro); ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Tipo de Insumo: </b> <a class="float-right"><?php echo($tipoinsumo); ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Quantidade abastecida: </b> <a class="float-right"><?php echo($quant_insumo); ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b> Valor do equipamento: </b> <a class="float-right"> <?php echo formatar_moeda($valordoequipamento); ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b> Observações: </b> <a class="float-right"><?php echo($observacoes_equip); ?></a>
                                </li>
                           
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card">

                        <div class="card-body">
                            <div class="tab-content">

                                <div class="active tab-pane" id="activity">
                                    <div class="post">
                                        <b>Tipo de Máquina</b><br>
                                        <?php
                                        $imagem = (isset($rs["tipo_nome_imagem"]) ? $rs["tipo_nome_imagem"] : "");
                                        $placeholder = '';
                                        $image_path = $this->config->item('folder_images') . 'tipos/' . $imagem;
                                        if (file_exists($image_path) and is_file($image_path)) {
                                            ?>
                                            <div class="box-img"><a href="<?php echo( base_url($image_path) ); ?>" target="blank">
                                                    <img src="<?php echo( base_url($image_path) ); ?>" alt="contador de entrada" style="width: 100%;" /></a>
                                            </div>
                                            <?php
                                        }
                                        ?> 
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">

                        <div class="card-body">
                            <div class="tab-content">

                                <div class="active tab-pane" id="activity">
                                    <div class="post">
                                        <b>Imagem contador analogico inicial</b><br>
                                        <?php
                                        $imagem = (isset($rs["nome_imagem"]) ? $rs["nome_imagem"] : "");
                                        $placeholder = '';
                                        $image_path = $this->config->item('folder_images') . '/maquinas/' . $imagem;
                                        if (file_exists($image_path) and is_file($image_path)) {
                                            ?>
                                            <div class="box-img"><a href="<?php echo( base_url($image_path) ); ?>" target="blank">
                                                    <img src="<?php echo( base_url($image_path) ); ?>" alt="contador de entrada" style="width: 100%;" /></a>
                                            </div>
                                            <?php
                                        }
                                        ?> 
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">

                        <div class="card-body">
                            <div class="tab-content">

                                <div class="active tab-pane" id="activity">
                                    <div class="post">
                                        <b>Imagem contador analogico saida</b><br>
                                        <?php
                                        $imagem = (isset($rs["nome_imagem_analogico"]) ? $rs["nome_imagem_analogico"] : "");
                                        $placeholder = '';
                                        $image_path = $this->config->item('folder_images') . '/maquinas/' . $imagem;
                                        if (file_exists($image_path) and is_file($image_path)) {
                                            ?>
                                            <div class="box-img"><a href="<?php echo( base_url($image_path) ); ?>" target="blank">
                                                    <img src="<?php echo( base_url($image_path) ); ?>" alt="contador de entrada" style="width: 100%;" /></a>
                                            </div>
                                            <?php
                                        }
                                        ?> 
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>
</div>
