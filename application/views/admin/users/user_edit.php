  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="card card-default">
        <div class="card-header">
          <div class="d-inline-block">
              <h3 class="card-title"> <i class="fa fa-pencil"></i>
              &nbsp; Edit User </h3>
          </div>
          <div class="d-inline-block float-right">
            <a href="<?= base_url('admin/users'); ?>" class="btn btn-success"><i class="fa fa-list"></i> Lista de usuarios</a>
            <a href="<?= base_url('admin/users/add'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Adicionar novo</a>
          </div>
        </div>
        <div class="card-body">
   
           <!-- For Messages -->
            <?php $this->load->view('admin/includes/_messages.php') ?>
           
            <?php echo form_open(base_url('admin/users/edit/'.$user['id']), 'class="form-horizontal"' )?> 
              <div class="form-group">
                <label for="username" class="col-md-2 control-label">Login</label>

                <div class="col-md-12">
                  <input type="text" name="username" value="<?= $user['username']; ?>" class="form-control" id="username" placeholder="">
                </div>
              </div>
           
             <div class="form-group">

                        <label for="password" class="col-md-2 control-label">Senha</label>
                        <div class="col-md-12">
                            <input type="password" name="password" class="form-control" id="password" placeholder="">
                        </div>

                    </div>
              <div class="form-group">
                <label for="firstname" class="col-md-2 control-label">Nome</label>

                <div class="col-md-12">
                  <input type="text" name="firstname" value="<?= $user['firstname']; ?>" class="form-control" id="firstname" placeholder="">
                </div>
              </div>

              <div class="form-group">
                <label for="lastname" class="col-md-2 control-label">Sobrenome</label>

                <div class="col-md-12">
                  <input type="text" name="lastname" value="<?= $user['lastname']; ?>" class="form-control" id="lastname" placeholder="">
                </div>
              </div>

              <div class="form-group">
                <label for="email" class="col-md-2 control-label">E-mail</label>

                <div class="col-md-12">
                  <input type="email" name="email" value="<?= $user['email']; ?>" class="form-control" id="email" placeholder="">
                </div>
              </div>
           
           
           
              <div class="form-group">
                <label for="mobile_no" class="col-md-2 control-label">Celular</label>

                <div class="col-md-12">
                  <input type="number" name="mobile_no" value="<?= $user['mobile_no']; ?>" class="form-control" id="mobile_no" placeholder="">
                </div>
              </div>
           
           
              <!-- 
              <div class="col-lg-6"  style='margin-top:10px'>
                                <label for="pontodevenda" class="col-md-6 control-label">Selecione o ponto de venda</label>
                                <div class="input-group">
                                    
                                    <?php
                                    $pontos_selecionados = array();
                                    
                                      foreach($users_pontos as $key=>$pontos_usuario){
                                        
                                             $pontos_selecionados[$pontos_usuario['ponto_id']] = $pontos_usuario['ponto_id'];
                                                
                                           }
                                       
                                           ?>
                                    
                                    
                                    <select name="users_pontos[]" multiple class="form-control" id="users_pontos" >
                                        <?php
                                        
                                      
                                           
                                        
                                        
                                        $cheked_ponto = '';
                                        foreach ($pontos as $ponto) {

                                            if($ponto->id == $pontos_selecionados[$ponto->id]){
                                                 $cheked_ponto = 'selected="selected"';  
                                            }else{
                                                    $cheked_ponto = '';
                                            }
                                            
                                            echo '<option '.$cheked_ponto.' value="' . $ponto->id . '">' . $ponto->ponto . ' | ' . $ponto->nomefan . ' '.$pontos_selecionados[$ponto->id].'</option>';
                                        
                                            
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
              -->
           
              <div class="col-lg-6"  style='margin-top:10px'>
                                <label for="pontodevenda" class="col-md-6 control-label">Selecione o perfil</label>
                                <div class="input-group">
                                    
                                    <select name="profile_id"  class="form-control" id="users_pontos" >
                                        <?php
                                        $cheked_ponto = '';
                                        foreach ($perfis as $perfil) {

                                            if($perfil[id] == $user['profile_id']){
                                              $cheked_perfil = 'selected="selected"';  
                                            }
                                            
                                            echo '<option '.$cheked_perfil.'  value="' . $perfil[id] . '">' . $perfil[nome] . '</option>';
                                          
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
           
              <div class="form-group">
                <label for="role" class="col-md-2 control-label">Escolha o status</label>

                <div class="col-md-12">
                  <select name="status" class="form-control">
                    <option value="">Select Status</option>
                    <option value="1" <?= ($user['is_active'] == 1)?'selected': '' ?> >Ativar</option>
                    <option value="0" <?= ($user['is_active'] == 0)?'selected': '' ?>>Desativar</option>
                  </select>
                </div>
              </div>
           
           
           
           
              <div class="form-group">
                <div class="col-md-12">
                  <input type="submit" name="submit" value="Atualizar cliente" class="btn btn-primary pull-right">
                </div>
              </div>
            <?php echo form_close(); ?>
        </div>
          <!-- /.box-body -->
      </div>  
    </section> 
  </div>