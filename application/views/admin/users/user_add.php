<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="card card-default">
            <div class="card-header">
                <div class="d-inline-block">
                    <h3 class="card-title"> <i class="fa fa-plus"></i>
                        Adicionar Operador </h3>
                </div>
                <div class="d-inline-block float-right">
                    <a href="<?= base_url('admin/users'); ?>" class="btn btn-success"><i class="fa fa-list"></i>  Listar Operadores</a>
                </div>
            </div>
            <div class="card-body">



                <!-- For Messages -->

                <?php $this->load->view('admin/includes/_messages.php') ?>



                <?php echo form_open(base_url('admin/users/add'), 'class="form-horizontal"'); ?> 

                <div class="form-group">

                


                    <div class="form-group">
                        <label for="firstname" class="col-md-2 control-label">Usuário</label>
                        <div class="col-md-12">

                            <input type="text" name="username" class="form-control" id="username" placeholder="">

                        </div>

                    </div>

                    <div class="form-group">

                        <label for="firstname" class="col-md-2 control-label">Nome</label>



                        <div class="col-md-12">

                            <input type="text" name="firstname" class="form-control" id="firstname" placeholder="">

                        </div>

                    </div>



                    <div class="form-group">

                        <label for="lastname" class="col-md-2 control-label">Sobrenome</label>



                        <div class="col-md-12">

                            <input type="text" name="lastname" class="form-control" id="lastname" placeholder="">

                        </div>

                    </div>



                    <div class="form-group">

                        <label for="email" class="col-md-2 control-label">E-mail</label>



                        <div class="col-md-12">

                            <input type="email" name="email" class="form-control" id="email" placeholder="">

                        </div>

                    </div>

                    <div class="form-group">

                        <label for="mobile_no" class="col-md-2 control-label">Telefone</label>



                        <div class="col-md-12">

                            <input type="text" name="mobile_no" class="cellphone_with_ddd form-control" id="mobile_no" placeholder="">

                        </div>

                    </div>

                    <div class="form-group">

                        <label for="password" class="col-md-2 control-label">Senha</label>



                        <div class="col-md-12">

                            <input type="password" name="password" class="form-control" id="password" placeholder="">

                        </div>

                    </div>
                    <!--
                    <div class="row">
                               <div class="col-lg-6"  style='margin-top:10px'>
                                <label for="pontodevenda" class="col-md-6 control-label">Selecione o ponto de venda</label>
                                <div class="input-group">
                                    <select name="users_pontos[]" onclick="getMaquinas(this.value)" multiple class="form-control" id="users_pontos" >
                                        <?php
                                        
                                           
                                    
                                        foreach ($pontos as $ponto) {

                                        
                                            echo '<option  value="' . $ponto->id . '">' . $ponto->ponto .  '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                    
                     <div class="col-lg-6"  style='margin-top:10px'>
                                <label for="pontodevenda" class="col-md-6 control-label">Selecione as maquinas</label>
                                <div class="input-group">
                                    
                                    <select name="machines[]"  multiple class="form-control" id="result_tipodemaquina" >
                                        <?php
                                        
                                     
                                    
                                        foreach ($perfis as $perfil) {

                                            
                                            echo '<option  value="' . $perfil[id] . '">' . $perfil[nome] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                </div>
                    -->
                               <div class="col-lg-6"  style='margin-top:10px'>
                                <label for="pontodevenda" class="col-md-6 control-label">Selecione o perfil</label>
                                <div class="input-group">
                                    
                                    <select name="profile_id"  class="form-control" id="users_pontos" >
                                        <?php
                                        
                                     
                                    
                                        foreach ($perfis as $perfil) {

                                            
                                            echo '<option  value="' . $perfil[id] . '">' . $perfil[nome] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                    
                      

         

                    <div class="form-group">

                        <div class="col-md-12">

                            <input type="submit" name="submit" value="Adicionar Operador" class="btn btn-primary pull-right">

                        </div>

                    </div>

                    <?php echo form_close(); ?>

                </div>

                <!-- /.box-body -->

            </div>

    </section> 

</div>
        
        