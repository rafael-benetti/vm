  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="card card-default">
        <div class="card-header">
          <div class="d-inline-block">
              <h3 class="card-title"> <i class="fa fa-pencil"></i>
              Edit Module </h3>
          </div>
          <div class="d-inline-block float-right">
            <a href="<?= base_url('admin/admin_roles/modules'); ?>" class="btn btn-success"><i class="fa fa-list"></i>  Module List</a>
          </div>
        </div>
        <div class="card-body">
   
           <!-- For Messages -->
            <?php $this->load->view('admin/includes/_messages.php') ?>

            <?php echo form_open(base_url('admin/admin_roles/module_edit/'.$module['module_id']), 'class="form-horizontal"');  ?> 
              <div class="form-group">
                <label for="module_name" class="col-md-2 control-label">Module Name</label>

                <div class="col-md-12">
                  <input type="text" name="module_name" value="<?= $module['module_name']; ?>" class="form-control" id="module_name" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="controller_name" class="col-md-2 control-label">Controller Name</label>

                <div class="col-md-12">
                  <input type="text" name="controller_name" value="<?= $module['controller_name']; ?>" class="form-control" id="controller_name" placeholder="">
                </div>
              </div>
              
              <div class="form-group">
                <label for="fa_icon" class="col-md-2 control-label">Fontawesome Icon</label>

                <div class="col-md-12">
                  <input type="text" name="fa_icon" value="<?= $module['fa_icon']; ?>" class="form-control" id="fa_icon" placeholder="">
                </div>
              </div>

              <div class="form-group">
                <label for="operation" class="col-md-2 control-label">Operations</label>

                <div class="col-md-12">
                  <input type="text" name="operation" value="<?= $module['operation']; ?>" class="form-control" id="operation" placeholder="eg. add|edit|delete">
                </div>
              </div>
              <div class="form-group">
                <label for="sort_order" class="col-md-2 control-label">Sort Order</label>

                <div class="col-md-12">
                  <input type="number" name="sort_order" value="<?= $module['sort_order']; ?>" class="form-control" id="sort_order" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-12">
                  <input type="submit" name="submit" value="Update Module" class="btn btn-primary pull-right">
                </div>
              </div>
            <?php echo form_close( ); ?>
        </div>
          <!-- /.box-body -->
      </div>
    </section> 
  </div>