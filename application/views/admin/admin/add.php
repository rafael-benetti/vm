<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="card card-default color-palette-bo">
            <div class="card-header">
                <div class="d-inline-block">
                    <h3 class="card-title"> <i class="fa fa-plus"></i>
                        Add Novo Administrador </h3>
                </div>
                <div class="d-inline-block float-right">
                    <a href="<?= base_url('admin/admin'); ?>" class="btn btn-success"><i class="fa fa-list"></i> Listar administradores</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box">
                            <!-- form start -->
                            <div class="box-body">

                                <!-- For Messages -->
                                <?php $this->load->view('admin/includes/_messages.php') ?>

                                <?php echo form_open(base_url('admin/admin/add'), 'class="form-horizontal"'); ?> 
                                <div class="form-group">
                                    <label for="username" class="col-md-12 control-label">Nome de usuário</label>
                                    <div class="col-md-12">
                                        <input type="text" name="username" class="form-control" id="username" placeholder="">
                                    </div>
                                </div>                 



                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="input-group">


                                            <label for="firstname" class="col-md-12 control-label">Nome</label>

                                            <div class="col-md-12">
                                                <input type="text" name="firstname" class="form-control" id="firstname" placeholder="">
                                            </div>


                                        </div>
                                    </div>
                                    <div class="col-lg-6">

                                        <div class="form-group">
                                            <label for="lastname" class="col-md-12 control-label">Sobrenome</label>

                                            <div class="col-md-12">
                                                <input type="text" name="lastname" class="form-control" id="lastname" placeholder="">
                                            </div>
                                        </div>

                                    </div>
                                </div>






                                <div class="form-group">
                                    <label for="email" class="col-md-12 control-label">E-mail</label>

                                    <div class="col-md-12">
                                        <input type="email" name="email" class="form-control" id="email" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="mobile_no" class="col-md-12 control-label">Telefone Whats</label>

                                    <div class="col-md-12">
                                        <input type="text" name="mobile_no" class="cellphone_with_ddd form-control" id="mobile_no" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="col-md-12 control-label">Senha</label>

                                    <div class="col-md-12">
                                        <input type="password" name="password" class="form-control" id="password" placeholder="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="role" class="col-md-12 control-label">Selecione a permissão*</label>

                                    <div class="col-md-12">
                                        <select name="role" class="form-control">
                                            <option value="">Tipo de permissão</option>
                                            <?php foreach ($admin_roles as $role): ?>
                                            
                                            <?php
                                            if($tipo == $role['admin_role_id']){ ?>
                                                      <option selected="selectd" value="<?= $role['admin_role_id']; ?>"><?= $role['admin_role_title']; ?></option>
                                          
                                          <?php  }else{ ?>
                                                <option value="<?= $role['admin_role_id']; ?>"><?= $role['admin_role_title']; ?></option>
                                            <?php } ?>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <input type="submit" name="submit" value="Adicionar Admin" class="btn btn-primary pull-right">

                                </div>
                                <?php echo form_close(); ?>
                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                </div>  
            </div>
        </div>
    </section> 
</div>
