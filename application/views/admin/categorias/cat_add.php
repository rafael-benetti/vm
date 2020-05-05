<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="card card-default">
            <div class="card-header">
                <div class="d-inline-block">
                    <h3 class="card-title"> <i class="fa fa-plus"></i>
                        Adicionar nova Categoria </h3>
                </div>
                <div class="d-inline-block float-right">
                    <a href="<?= base_url('admin/categorias'); ?>" class="btn btn-success"><i class="fa fa-list"></i>  Listar Categorias</a>
                </div>
            </div>
            <div class="card-body">

                <!-- For Messages -->
                <?php $this->load->view('admin/includes/_messages.php') ?>

                <?php echo form_open(base_url('admin/categorias/add'), 'class="form-horizontal"'); ?> 
                <?php "<br />"; ?>


                <div class="form-group">
                    <label for="categorias" class="col-md-6 control-label">Categoria</label>
                    <div class="col-md-12">
                        <input type="text" name="categorias" class="form-control" id="categorias" placeholder="">
                    </div>
                </div>
                
                <div class="form-group">

                    <div class="col-md-12">

                        <input type="submit" name="submit" value="Adicionar Categoria" class="btn btn-primary pull-right">

                    </div>

                </div>

                <?php echo form_close(); ?>

            </div>
            <!-- /.box-body -->
        </div>
    </section> 
</div>