<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="card card-default">
            <div class="card-header">
                <div class="d-inline-block">
                    <h3 class="card-title"> <i class="fa fa-plus"></i>
                        <a href="<?= base_url('admin') ?>" class="card-title">Painel</a> </h3>
                </div>
                <div class="d-inline-block float-right">
                    <a href="<?= base_url('admin/machines'); ?>" class="btn btn-success"><i class="fa fa-list"></i> Listar Máquinas</a>
                </div>
            </div>
            <div class="card-body">

                <!-- For Messages -->

                <?php $this->load->view('admin/includes/_messages.php') ?>



                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Cadastro de Vending Machines</h3>
                    </div>
                    <!-- /.card-header -->

                    <!-- form start -->
                    <?php echo form_open_multipart(base_url('admin/machines/edit/' . $machine['id_maquina']), 'class="form-horizontal"'); ?>  

                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6"  style='margin-top:10px'>
                                <label for="pontodevenda" class="col-md-6 control-label">Selecione o ponto de venda</label>
                                <div class="input-group">

                                    <select name="pontodevenda" class="form-control" id="pontodevenda">
                                        <?php
                                        $cheked_ponto = false;
                                        foreach ($pontos as $ponto) {

                                            if ($machine['pontodevenda'] == $ponto->id) {
                                                $cheked_ponto = true;
                                            }
                                            echo '<option selected="' . $cheked . '" value="' . $ponto->id . '">' . $ponto->ponto . '</option>';
                                        }
                                        ?>
                                    </select>

                                </div>
                            </div>
                            <div class="col-lg-6"  style='margin-top:10px'>
                                <label for="lastname" class="col-md-6 control-label">Tipo de Máquina</label>

                                <div class="input-group">
                                    <select name="tipomaquina" class="form-control" id="tipomaquina" >
                                        <?php
                                        $cheked_tipo = '';
                                        foreach ($tipos as $tipo) {

                                            if ($machine['tipomaquina'] == $tipo->id) {
                                                $cheked_tipo = 'selected="true"';
                                            } else {
                                                $cheked_tipo = '';
                                            }
                                            echo '<option ' . $cheked_tipo . '  value="' . $tipo->id . '">' . $tipo->tipo . ' </option>';
                                        }
                                        ?>
                                    </select>

                                </div>
                            </div>







                        </div>



                        <div class="row" style='margin-top:10px'>
                            <div class="col-4">
                                <label for="valordoequipamento" class="col-md-6 control-label ">Valor do Equipamento</label>
                                <?php if ($this->is_supper == 1) { ?>
                                    <input type="text" name="valordoequipamento" value="<?php echo $machine['valordoequipamento']; ?>" class="form-control money" id="valordoequipamento" >
                                <?php
                                } else {
                                    echo '<input type="hidden" name="valordoequipamento" value="' . $machine['valordoequipamento'] . '">';
                                    echo formatar_moeda($machine['valordoequipamento']);
                                }
                                ?>

                            </div>

                            <div class="col-4">
                                <label for="firstname" class="col-md-3 control-label">Nº Série</label>
                                <?php if ($this->is_supper == 1) { ?>
                                    <input type="number" name="serial" class="form-control" id="serial" value="<?= $machine['serial']; ?>">
                                <?php
                                } else {

                                    echo '<input type="hidden" name="serial" value="' . $machine['serial'] . '">';
                                    echo $machine['serial'];
                                }
                                ?>
                            </div>
                            <div class="col-4">
                                <label for="firstname" class="col-md-3 control-label">Cont. Inicial</label>
                                <?php if ($this->is_supper == 1) { ?>
                                    <input type="number" name="cont_inicial" class="form-control" id="cont_inicial" value="<?= $machine['cont_inicial']; ?>" disabled="true"> 
                                <?php
                                } else {
                                    echo '<input type="hidden" name="cont_inicial" value="' . $machine['cont_inicial'] . '">';

                                    echo formatar_moeda($machine['cont_inicial']);
                                }
                                ?>
                            </div>



                        </div>

                        <div class="row" style='margin-top:10px'>
                            <div class="col-6">
                                <label for="valorvenda" class="col-md-3 control-label">Valor de venda</label>                                  
                                <input type="text" name="valorvenda" class="form-control money" id="valorvenda" value="<?= $machine['valorvenda']; ?>">
                            </div>
                            <div class="col-6">
                                <label for="cont_saida_inicial" class="col-md-6 control-label">Cont. de saída Ini.</label>
                                <input type="number" name="cont_saida_inicial" class="form-control" id="cont_saida_inicial" value="<?= $machine['cont_saida_inicial']; ?>">
                            </div>
                        </div>




                        <div class="row" style='margin-top:25px'>
                            <div class="col-lg-6 col-sm-12  col-md-12">
                                <label for="firstname" class="col-md-12 control-label">Foto do contador analógico inicial</label>
                                <div class="col-12">
<?php $file_cont_inicial = (isset($machine["nome_imagem"]) ? $machine["nome_imagem"] : ""); ?>
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
                            <div class="col-lg-6 col-sm-12 col-md-12">
                                <label for="firstname" class="col-md-12 control-label">Foto do contador analógico de saida</label>
                                <div class="col-12">
<?php $file_cont_analogico = (isset($machine["nome_imagem_analogico"]) ? $machine["nome_imagem_analogico"] : ""); ?> <div class="form-group row">
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

                        </div>

                        <?php
                        $check_noteiro = "";
                        $check_ficheiro = "";
                        if ($machine["noteiro"] == '1') {
                            $check_noteiro = ' checked="true"';
                        }
                        if ($machine["ficheiro"] == '1') {
                            $check_ficheiro = ' checked="true"';
                        }
                        ?>

                        <div class="row" style='margin-top:25px'>

                            <div class="col-lg-6 col-sm-12  col-md-12" >
                                  <?php if ($this->is_supper == 1) { ?>

                                <label for="noteiro" class="col-md-3 control-label"> Noteiro 
                                    <input type="checkbox" value="1" name="noteiro" id="noteiro" class="minimal" <?php echo($check_noteiro); ?> >
                                </label>
                                <label for="ficheiro" class="col-md-3 control-label"> Ficheiro
                                    <input type="checkbox" value="1" name="ficheiro" id="ficheiro" class="minimal" <?php echo($check_ficheiro); ?> >
                                </label>
                                
                                 <?php
                                } else { ?>
                                
                                  <label for="noteiro" class="col-md-3 control-label"> Noteiro:
                                      <input type="hidden" name="noteiro" value="<?php echo $machine['noteiro']; ?>">
                                   <?php echo $check_noteiro==1?"Sim":"Não"; ?> 
                                </label>
                                <label for="ficheiro" class="col-md-3 control-label"> Ficheiro:
                                     <input type="hidden" name="ficheiro" value="<?php echo $machine['noteiro']; ?>">
                                       <?php echo $check_ficheiro==1?"Sim":"Não"; ?> 
                                </label>
                                  
                             <?php   }
                                ?>

                            </div>

                            <div class="col-lg-6 col-sm-12  col-md-12" >

                                <label for="lastname" class="col-md-12 control-label">Selecione o Tipo de Insumo e a quantidade abastecida</label>
                                <div class="input-group">
                                    <select name="item" style="width:100%" class="js-example-basic-single"id="item" >
                                        <?php
                                        $checked = '';
                                        foreach ($item as $item) {

                                            if ($item->id == $machine["item_id"]) {
                                                $checked = 'selected = "true"';
                                            } else {
                                                $checked = '';
                                            }
                                            echo '<option ' . $checked . ' value="' . $item->id . '">' . $item->item . '</option>';
                                        }
                                        ?>
                                    </select>

                                </div>

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
                                                <textarea name="observacoes_equip"  class="form-control" id="observacoes_equip" rows="5" style="resize: none;"><?php echo(trim($machine['observacoes_equip'])); ?></textarea>
                                            </div>
                                        </div>

                                    </div><!-- /.card-body -->
                                </div>
                            </div>
                        </div>

                        <div class="row" style='margin-top:25px'>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputFile">Status</label>
                                    <div class="input-group">
                                        <select name="is_active" class="form-control">
                                            <option value="1" <?= ($machine['is_active'] == 1) ? 'selected' : '' ?> >Ativado</option>
                                            <option value="0" <?= ($machine['is_active'] == 0) ? 'selected' : '' ?>>Desativado</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div><!-- /.fica dentro do body azul -->



                    <div class="card-footer">
                        <input type="submit" name="submit" value="Atualizar" class="btn btn-primary pull-right">
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
