  <!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper">

    <!-- Main content -->

    <section class="content">

      <div class="card card-default">

        <div class="card-header">

          <div class="d-inline-block">

              <h3 class="card-title"> <i class="fa fa-pencil"></i>

              &nbsp; Editar item </h3>

          </div>

          <div class="d-inline-block float-right">

            <a href="<?= base_url('admin/itens'); ?>" class="btn btn-success"><i class="fa fa-list"></i> Lista de itens</a>

            <a href="<?= base_url('admin/itens/add_item'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Adicionar item</a>

          </div>

        </div>

        <div class="card-body">

           <!-- For Messages -->
            <?php $this->load->view('admin/includes/_messages.php') ?>
         

            <?php echo form_open(base_url('admin/itens/edit/'.$item['id']), 'class="form-horizontal"' )?> 
            
           <div class="form-group">

                <div class="col-md-12">
                    <label for="item" class="col-md-6 control-label">Item</label>
                  <input type="text" name="item" value="<?= $item['item']; ?>" class="form-control" id="item" placeholder="">
                  <label for="quantidade" class="col-md-6 control-label">Quantidade</label>
                  <input type="text" readonly="true" min="01" name="quantidade" value="<?= $item['quantidade']; ?>" class="form-control" id="quantidade" placeholder="">
                  <label for="valor" class="col-md-6 control-label">Valor</label>
                  <input type="number" name="valor" value="<?= $item['valor']; ?>" class="form-control" id="valor" pattern="[0-9]+([,\.][0-9]+)?" min="0.1" step="any">
                </div>
              </div>
            

              <div class="form-group">

                <label for="role" class="col-md-2 control-label">Status</label>

                <div class="col-md-12">

                  <select name="status" class="form-control">

                    <option value="">Escolha o Status</option>

                    <option value="1" <?= ($item['is_active'] == 1)?'selected': '' ?> >Ativar</option>

                    <option value="0" <?= ($item['is_active'] == 0)?'selected': '' ?>>Desativar</option>

                  </select>

                </div>

              </div>

              <div class="form-group">

                <div class="col-md-12">

                  <input type="submit" name="submit" value="Atualizar Item" class="btn btn-primary pull-right">

                </div>

              </div>

            <?php echo form_close(); ?>

        </div>

          <!-- /.box-body -->

      </div>  

    </section> 

  </div>