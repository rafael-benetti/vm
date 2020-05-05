  <!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper">

    <!-- Main content -->

    <section class="content">

      <div class="card card-default">

        <div class="card-header">

          <div class="d-inline-block">

              <h3 class="card-title"> <i class="fa fa-pencil"></i>

              &nbsp; Editar Categoria </h3>

          </div>

          <div class="d-inline-block float-right">

            <a href="<?= base_url('admin/categoria'); ?>" class="btn btn-success"><i class="fa fa-list"></i> Listar de Categoria</a>

            <a href="<?= base_url('admin/categoria/add'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Adicionar Nova Categoria</a>

          </div>

        </div>

        <div class="card-body">

   

           <!-- For Messages -->

            <?php $this->load->view('admin/includes/_messages.php') ?>

           

            <?php echo form_open(base_url('admin/categoria/edit/'.$tipo['id']), 'class="form-horizontal"' )?> 

              <div class="form-group">

                <label for="categoria" class="col-md-2 control-label">Categoria</label>



                <div class="col-md-12">

                  <input type="text" name="categoria" value="<?= $categoria['categoria']; ?>" class="form-control" id="categoria" placeholder="">

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