  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="card card-default">
        <div class="card-header">
          <div class="d-inline-block">
              <h3 class="card-title"> <i class="fa fa-plus"></i>
              Add New User </h3>
          </div>
          <div class="d-inline-block float-right">
            <a href="<?= base_url('admin/users'); ?>" class="btn btn-success"><i class="fa fa-list"></i>  Users List</a>
          </div>
        </div>
        <div class="card-body">

   

           <!-- For Messages -->

            <?php $this->load->view('admin/includes/_messages.php') ?>



            <?php echo form_open(base_url('admin/users/add'), 'class="form-horizontal"');  ?> 

              <div class="form-group">

                <label for="username" class="col-md-2 control-label"> <php echo $title_container?> </label>

                



                <div class="col-md-12">

                  <input type="text" name="username" class="form-control" id="username" placeholder="">

                </div>

              </div>

              <div class="form-group">

                <label for="firstname" class="col-md-2 control-label">First Name</label>



                <div class="col-md-12">

                  <input type="text" name="firstname" class="form-control" id="firstname" placeholder="">

                </div>

              </div>

              

              <div class="form-group">

                <label for="lastname" class="col-md-2 control-label">Last Name</label>



                <div class="col-md-12">

                  <input type="text" name="lastname" class="form-control" id="lastname" placeholder="">

                </div>

              </div>



              <div class="form-group">

                <label for="email" class="col-md-2 control-label">Email</label>



                <div class="col-md-12">

                  <input type="email" name="email" class="form-control" id="email" placeholder="">

                </div>

              </div>

              <div class="form-group">

                <label for="mobile_no" class="col-md-2 control-label">Mobile No</label>



                <div class="col-md-12">

                  <input type="number" name="mobile_no" class="form-control" id="mobile_no" placeholder="">

                </div>

              </div>

              <div class="form-group">

                <label for="password" class="col-md-2 control-label">Password</label>



                <div class="col-md-12">

                  <input type="password" name="password" class="form-control" id="password" placeholder="">

                </div>

              </div>

              <div class="form-group">

                <label for="address" class="col-md-2 control-label">Address</label>



                <div class="col-md-12">

                  <input type="text" name="address" class="form-control" id="address" placeholder="">

                </div>

              </div>

              <div class="form-group">

                <div class="col-md-12">

                  <input type="submit" name="submit" value="Add User" class="btn btn-primary pull-right">

                </div>

              </div>

            <?php echo form_close( ); ?>

        </div>

          <!-- /.box-body -->

      </div>

    </section> 

  </div>