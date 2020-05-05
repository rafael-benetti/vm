  <!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper">

    <!-- Main content -->

    <section class="content">

      <div class="card card-default">

        <div class="card-header">

          <div class="d-inline-block">

              <h3 class="card-title"> <i class="fa fa-pencil"></i>

              &nbsp; Editar Cliente </h3>

          </div>

          <div class="d-inline-block float-right">

            <a href="<?= base_url('admin/clientes'); ?>" class="btn btn-success"><i class="fa fa-list"></i> Cliente List</a>

            <a href="<?= base_url('admin/clientes/add'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Add New clienrte</a>

          </div>

        </div>

        <div class="card-body">

   

           <!-- For Messages -->

            <?php $this->load->view('admin/includes/_messages.php') ?>

           

            <?php echo form_open(base_url('admin/clientes/edit/'.$cliente['id']), 'class="form-horizontal"' )?> 

              <div class="form-group">

                <label for="clienteusername" class="col-md-2 control-label">User Name</label>



                <div class="col-md-12">

                  <input type="text" name="clienteusername" value="<?= $cliente['clienteusername']; ?>" class="form-control" id="clienteusername" placeholder="">

                </div>

              </div>

              <div class="form-group">

                <label for="firstname" class="col-md-2 control-label">First Name</label>



                <div class="col-md-12">

                  <input type="text" name="clientename" value="<?= $cliente['clientename']; ?>" class="form-control" id="clientename" placeholder="">

                </div>

              </div>



              <div class="form-group">

                <label for="sobrenome" class="col-md-2 control-label">Last Name</label>



                <div class="col-md-12">

                  <input type="text" name="sobrenome" value="<?= $cliente['sobrenome']; ?>" class="form-control" id="sobrenome" placeholder="">

                </div>

              </div>



              <div class="form-group">

                <label for="email" class="col-md-2 control-label">Email</label>



                <div class="col-md-12">

                  <input type="email" name="email" value="<?= $cliente['email']; ?>" class="form-control" id="email" placeholder="">

                </div>

              </div>

              <div class="form-group">

                <label for="mobile_no" class="col-md-2 control-label">Mobile No</label>



                <div class="col-md-12">

                  <input type="number" name="fone" value="<?= $cliente['fone']; ?>" class="form-control" id="fone" placeholder="">

                </div>

              </div>

              <div class="form-group">

                <label for="role" class="col-md-2 control-label">Select Status</label>



                <div class="col-md-12">

                  <select name="status" class="form-control">

                    <option value="">Select Status</option>

                    <option value="1" <?= ($cliente['is_active'] == 1)?'selected': '' ?> >Active</option>

                    <option value="0" <?= ($cliente['is_active'] == 0)?'selected': '' ?>>Deactive</option>

                  </select>

                </div>

              </div>

              <div class="form-group">

                <div class="col-md-12">

                  <input type="submit" name="submit" value="Update cliente" class="btn btn-primary pull-right">

                </div>

              </div>

            <?php echo form_close(); ?>

        </div>

          <!-- /.box-body -->

      </div>  

    </section> 

  </div>