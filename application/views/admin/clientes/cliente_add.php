  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="card card-default">
        <div class="card-header">
          <div class="d-inline-block">
              <h3 class="card-title"> <i class="fa fa-plus"></i>
              Adicionar Clientes </h3>
          </div>
          <div class="d-inline-block float-right">
            <a href="<?= base_url('admin/clientes'); ?>" class="btn btn-success"><i class="fa fa-list"></i>  Listar Clientes</a>
          </div>
        </div>
        <div class="card-body">

   

           <!-- For Messages -->

            <?php $this->load->view('admin/includes/_messages.php') ?>



            <?php echo form_open(base_url('admin/clientes/add'), 'class="form-horizontal"');  ?> 
                             <div class="form-group">

                <label for="clienteusername" class="col-md-2 control-label"> <php echo $title_container?> </label>

                



                <div class="col-md-12">

                  <input type="text" name="clienteusername" class="form-control" id="clienteusername" placeholder="">

                </div>

              </div>
               

               <div class="form-group">

                <label for="clientename" class="col-md-2 control-label">Nome Completo</label>



                <div class="col-md-12">

                  <input type="text" name="clientename" class="form-control" id="clientename" placeholder="">

                </div>

              </div>
              
                   <div class="form-group">

                <label for="sobrenome" class="col-md-2 control-label">Last Name</label>



                <div class="col-md-12">

                  <input type="text" name="sobrenome" class="form-control" id="sobrenome" placeholder="">

                </div>

              </div>

              

              <div class="form-group">

                <label for="cpf" class="col-md-2 control-label">CPF</label>



                <div class="col-md-12">

                  <input type="text" name="cpf" class="form-control" id="cpf" placeholder="">

                </div>

              </div>



              <div class="form-group">

                <label for="email" class="col-md-2 control-label">E-mail</label>



                <div class="col-md-12">

                  <input type="email" name="email" class="form-control" id="email" placeholder="">

                </div>

              </div>

              <div class="form-group">

                <label for="fone" class="col-md-2 control-label">Telefone</label>



                <div class="col-md-12">

                  <input type="number" name="fone" class="form-control" id="fone" placeholder="">

                </div>

              </div>
                           

              <div class="form-group">

                <label for="password" class="col-md-2 control-label">Senha</label>



                <div class="col-md-12">

                  <input type="password" name="password" class="form-control" id="password" placeholder="">

                </div>

              </div>
              
              <div class="form-group">
                    <label>Status</label>
                    <select class="form-control">
                      <option>Ativo</option>
                      <option>Desativado</option>
                    </select>
                  </div>
                  

              <div class="form-group">

                <div class="col-md-12">

                  <input type="submit" name="submit" value="Adicionar Cliente" class="btn btn-primary pull-right">

                </div>

              </div>

            <?php echo form_close( ); ?>

        </div>

          <!-- /.box-body -->

      </div>

    </section> 

  </div>