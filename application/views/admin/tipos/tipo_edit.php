  <!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper">

    <!-- Main content -->

    <section class="content">

      <div class="card card-default">

        <div class="card-header">

          <div class="d-inline-block">

              <h3 class="card-title"> <i class="fa fa-pencil"></i>

              &nbsp; Editar tipo </h3>

          </div>

          <div class="d-inline-block float-right">

            <a href="<?= base_url('admin/tipos'); ?>" class="btn btn-success"><i class="fa fa-list"></i> Lista de tipos</a>

            <a href="<?= base_url('admin/tipos/add'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Adicionar Novo TIpo</a>

          </div>

        </div>

        <div class="card-body">

   

           <!-- For Messages -->

            <?php $this->load->view('admin/includes/_messages.php') ?>

           

            <?php echo form_open(base_url('admin/tipos/edit/'.$tipo['id']), 'class="form-horizontal"' )?> 

              <div class="form-group">

                <label for="tipo" class="col-md-2 control-label">tipo</label>



                <div class="col-md-12">

                  <input type="text" name="tipo" value="<?= $tipo['tipo']; ?>" class="form-control" id="tipo" placeholder="">

                </div>

              </div>
           
             <div class="col-6">
                    <label for="firstname" class="col-md-12 control-label">Envie uma foto de sua máquina</label>                        <div class="col-12">
                        
                        <?php $file_img_tipos = (isset($rs["bosta"]) ? $rs["bosta"] : ""); ?>
                        <div class="form-group row">
                            <div class="col-md-12 text-center">
                                <input type="hidden" name="file_img_tipos" id="file_img_tipos" value="<?php echo($file_img_tipos); ?>" />
                                
                                <div class="wrapper-image-preview text-center">
                                    
                                    
                                    <div class="box" style="margin: 0 auto;">
                                        <?php
                                        $label_upload = "Enviar foto da máquina";
                                        $placeholder = base_url("assets/dist/img/placeholder-image.jpg");
                                        $image_path = $this->config->item('folder_images') . '/tipos/' . $file_img_tipos;
                                        if (file_exists($image_path) and is_file($image_path)) {
                                            $placeholder = base_url($image_path);
                                        }
                                        ?>
                                        <div class="js--image-preview" style="background-image: url(<?php echo($placeholder); ?>); background-color: #F5F5F5;"></div>
                                        <div class="upload-options">
                                            <label for="file_img_tipos" class="btn btn-white-sp"> <i class="mdi mdi-camera"></i> <?php echo $label_upload; ?> </label>
                                            <input type="file" style="visibility:hidden;" class="image-upload" name="file_img_tipos" id="file_img_tipos" accept="image/*">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

           
           
           
           
           
           
           
           
           
           
           
           
           
           
           

              <div class="form-group">

                <label for="role" class="col-md-2 control-label">Status</label>



                <div class="col-md-12">

                  <select name="status" class="form-control">

                    <option value="">Escolha o Status</option>

                    <option value="1" <?= ($tipo['is_active'] == 1)?'selected': '' ?> >Ativar</option>

                    <option value="0" <?= ($tipo['is_active'] == 0)?'selected': '' ?>>Desativar</option>

                  </select>

                </div>

              </div>

              <div class="form-group">

                <div class="col-md-12">

                  <input type="submit" name="submit" value="Atualizar Tipo" class="btn btn-primary pull-right">

                </div>

              </div>

            <?php echo form_close(); ?>

        </div>

          <!-- /.box-body -->

      </div>  

    </section> 

  </div>