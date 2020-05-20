<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="card card-default">
            <div class="card-header">
                <div class="d-inline-block">
                    <h3 class="card-title"> <i class="fa fa-plus"></i>
                        <a href="<?= base_url('admin') ?>" class="card-title">Dashboard</a> </h3>
                </div>
                <div class="d-inline-block float-right">
                    <a href="<?= base_url('admin/machines'); ?>" class="btn btn-success"><i class="fa fa-list"></i> Listar Máquinas</a>
                </div>
            </div>
            <div class="card-body">

                <!-- For Messages -->

                <?php $this->load->view('admin/includes/_messages.php') ?>

                <?php echo form_open(base_url('admin/machines/add'), 'class="form-horizontal" enctype="multipart/form-data" '); ?> 
                <?php "<br />"; ?>


                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Cadastro de Vending Machines</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6"  style='margin-top:10px'>
                                    <label for="pontodevenda" class="col-md-6 control-label">Selecione o ponto de venda</label>
                                    <div class="input-group">
                                        <select name="pontodevenda" style="width:100%" class="js-example-basic-single" id="pontodevenda" >
                                            <option value="0">Nenhum ponto</option>
                                            <?php
                                            foreach ($pontos as $ponto) {
                                                echo '<option value="' . $ponto->id . '">' . $ponto->ponto . '</option>';
                                            }
                                            ?> 
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6"  style='margin-top:10px'>
                                    <label for="lastname" class="col-md-6 control-label">Tipo de Máquina</label>
                                    <div class="input-group">
                                        <select name="tipomaquina" style="width:100%" class="js-example-basic-single"id="tipomaquina" >
                                            <?php
                                            foreach ($tipos as $tipo) {

                                                echo '<option value="' . $tipo->id . '">' . $tipo->tipo . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>  
                                <!-- /.col-lg-6 -->





                            </div>
                      


                            <div class="row" style='margin-top:10px'>
                                <div class="col-12">
                                    <label for="firstname" class="col-md-3 control-label">Nº Série</label>
                                    <input type="number" name="serial" class="form-control" id="serial" placeholder="">
                                </div>
                                <div class="col-12">
                                    <label for="valorvenda" class="col-md-6 control-label ">Valor de venda</label>
                                    <input type="text" name="valorvenda" class="form-control money" id="valorvenda" >
                                </div>


                                <div class="col-12">
                                    <label for="firstname" class="col-md-3 control-label">Cont. Inicial</label>
                                    <input type="number" name="cont_inicial" class="form-control" id="cont_inicial" placeholder="">
                                </div>
                                <div class="col-12">
                                    <label for="cont_saida_inicial" class="col-md-6 control-label">Cont-Ini. de saída</label>
                                    <input type="number" name="cont_saida_inicial" class="form-control" id="cont_saida_inicial" >
                                </div>
                                <div class="col-12">
                                    <label for="valordoequipamento" class="col-md-6 control-label ">Valor do Equipamento</label>
                                    <input type="text" name="valordoequipamento" class="form-control money" id="valordoequipamento">
                                </div>


                            </div>


                            <div class="row" style='margin-top:25px'>
                                <div class="col-lg-5 col-sm-12  col-md-12">
                                    <label for="firstname" class="col-md-12 control-label">Foto do contador analógico inicial</label>
                                    <div class="col-12">
                                        <?php $file_cont_inicial = (isset($rs["imagem"]) ? $rs["imagem"] : ""); ?>
                                        <div class="form-group row">
                                            <div class="col-md-12 text-center">
                                                    <!-- <input type="hidden" name="file_img_saida_old" id="file_img_saida_old" value="<?php //echo($file_cont_inicial);    ?>" /> -->

                                                <div class="wrapper-image-preview text-center">
                                                    <div class="box" style="margin: 0 auto;">
                                                        <?php
                                                        $label_upload = "Enviar foto do contador Inicial";
                                                        $placeholder = base_url("assets/dist/img/placeholder-image.jpg");
                                                        $image_path = $this->config->item('folder_images') . '/maquinas/' . $file_cont_inicial;
                                                        if (file_exists($image_path) and is_file($image_path)) {
                                                            $placeholder = base_url($image_path);
                                                        }
                                                        ?>
                                                        <div class="js--image-preview" style="background-image: url(<?php echo($placeholder); ?>); background-color: #F5F5F5;"></div>
                                                        <div class="upload-options">
                                                            <label for="file_cont_inicial" class="btn btn-white-sp"> <i class="mdi mdi-camera"></i> <?php echo $label_upload; ?> </label>
                                                            <input type="file" style="visibility:hidden;" class="image-upload" name="file_cont_inicial" id="file_cont_inicial" accept="image/*">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-sm-12 col-md-12">
                                    <label for="firstname" class="col-md-12 control-label">Foto do contador analógico de saida</label>
                                    <div class="col-12">
                                        <?php $file_cont_analogico = (isset($rs["imagem_analogico"]) ? $rs["imagem_analogico"] : ""); ?>
                                        <div class="form-group row">
                                            <div class="col-md-12 text-center">
                                                    <!-- <input type="hidden" name="file_img_saida_old" id="file_img_saida_old" value="<?php //echo($file_cont_inicial);    ?>" /> -->

                                                <div class="wrapper-image-preview text-center">
                                                    <div class="box" style="margin: 0 auto;">
                                                        <?php
                                                        $label_upload = "Enviar foto do contador Analogico";
                                                        $placeholder = base_url("assets/dist/img/placeholder-image.jpg");
                                                        $image_path = $this->config->item('folder_images') . '/maquinas/' . $file_cont_analogico;
                                                        if (file_exists($image_path) and is_file($image_path)) {
                                                            $placeholder = base_url($image_path);
                                                        }
                                                        ?>
                                                        <div class="js--image-preview" style="background-image: url(<?php echo($placeholder); ?>); background-color: #F5F5F5;"></div>
                                                        <div class="upload-options">
                                                            <label for="file_cont_analogico" class="btn btn-white-sp"> <i class="mdi mdi-camera"></i> <?php echo $label_upload; ?> </label>
                                                            <input type="file" style="visibility:hidden;" class="image-upload" name="file_cont_analogico" id="file_cont_analogico" accept="image/*">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-sm-12  col-md-12" >
                                
             
                                <label for="firstname" class="col-md-12 control-label">Acessórios</label>
                                <label for="noteiro" class="col-md-12 control-label"> Noteiro 
                                    <input type="checkbox" value="1" name="noteiro" id="noteiro" class="minimal">
                                </label><br>
                                <label for="ficheiro" class="col-md-12 control-label"> Ficheiro
                                    <input type="checkbox" value="1" name="ficheiro" id="ficheiro" class="minimal">
                                </label>

                            </div>
                                

                            </div>
                            

                            <div class="row" style='margin-top:25px'>
                                <div class="col-12" >
                                    <div class="card card-primary" style='margin-bottom:0 !important;'>
                                        <div class="card-header">
                                            <h3 class="card-title">Anotações gerais</h3>
                                        </div>
                                        <div class="card-body">

                                            <div class="form-group">
                                                <label for="address" class="col-md-12 control-label">Observações do equipamento</label>
                                                <div class="col-md-12">
                                                    <textarea name="observacoes_equip"  class="form-control" id="observacoes_equip" rows="5" style="resize: none;"></textarea>
                                                </div>
                                            </div>

                                        </div><!-- /.card-body -->
                                    </div>
                                </div>
                            </div>

                        </div><!-- /.fica dentro do body azul -->

                        <div class="card-footer">
                            <input type="submit" name="submit" value="Adicionar Maquina" class="btn btn-primary pull-right">
                        </div>
                    </form>
                </div>

                <?php echo form_close(); ?>

            </div>

            <!-- /.box-body -->

        </div>

    </section> 

</div>

<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/iCheck/all.css">
<script src="<?= base_url() ?>assets/plugins/iCheck/icheck.min.js"></script>
<script>
    $(function () {


        $('.js-example-basic-single').select2();

        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green'
        })

    })

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
        radioClass: 'iradio_minimal-blue'
    })
</script>


<script src="assets/plugins/jquery/jquery.min.js" type="text/javascript"></script>
<script src="assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        bsCustomFileInput.init();
    });
</script>
