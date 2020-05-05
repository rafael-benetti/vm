<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="card card-default">
            <div class="card-header">
                <div class="d-inline-block">
                    <h3 class="card-title"> <i class="fa fa-plus"></i>
                        Adicionar novo tipo </h3>
                </div>
                <div class="d-inline-block float-right">
                    <a href="<?= base_url('admin/itens'); ?>" class="btn btn-success"><i class="fa fa-list"></i>  Listar todo itens</a>
                </div>
            </div>
            <div class="card-body">

                <!-- For Messages -->
                <?php $this->load->view('admin/includes/_messages.php') ?>

                <?php echo form_open(base_url('admin/itens/add'), 'class="form-horizontal"'); ?> 
                <?php "<br />"; ?>


                <div class="form-group">
                    <label for="item" class="col-md-6 control-label">Item</label>
                    <div class="col-md-12">
                        <input type="text" name="item" class="form-control" id="item" placeholder="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="quantidade" class="col-md-6 control-label">Quantidade</label>
                    <div class="col-md-12">
                        <input type="number" name="quantidade" min="01" class="form-control" id="quantidade" placeholder="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="valor" class="col-md-6 control-label">Valorde custo</label>
                    <div class="col-md-12">
                   
                   <input type="number" name="valor" class="form-control" id="valor" pattern="[0-9]+([,\.][0-9]+)?" min="0.1" step="any">
                    </div>
                </div>

                <div class="form-group">

                    <div class="col-md-12">

                        <input type="submit" name="submit" value="Adicionar Item" class="btn btn-primary pull-right">

                    </div>

                </div>

                <?php echo form_close(); ?>

            </div>
            <!-- /.box-body -->
        </div>
    </section> 
</div>