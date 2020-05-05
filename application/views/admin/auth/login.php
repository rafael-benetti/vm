<div class="form-background"> 
    <div class="login-box">
        <center><img src="<?= base_url('assets/img/logo-min.png'); ?>" style="width: 25%" /></center>
        <br>
        <!-- /.login-logo -->  
        <div class="card">     
            <div class="card-body login-card-body">   
                <p class="login-box-msg">Gestão de Vending Machines - Faça login</p>
                <?php $this->load->view('admin/includes/_messages.php') ?> 
                <?php echo form_open(base_url('admin/auth/login'), 'class="login-form" '); ?>      
                <div class="form-group has-feedback">     
                    <input type="text" name="username" id="name" class="form-control" placeholder="Usuário" >     
                </div> 
                <div class="form-group has-feedback">   
                    <input type="password" name="password" id="password" class="form-control" placeholder="Senha" >   
                </div>         
                <div class="row">      
                    <div class="col-8">    
                        <div class="checkbox icheck">      
                            <label>               
                                <input type="checkbox"> Lembrar senha           
                            </label>    
                        </div>            </div>            <!-- /.col -->           
                    <div class="col-4">             
                        <input type="submit" name="submit" id="submit" class="btn btn-primary btn-block btn-flat" value="Entrar">      
                    </div>            <!-- /.col -->          </div>        <?php echo form_close(); ?>      
                <p class="mb-1">          <a href="<?= base_url('admin/auth/forgot_password'); ?>">Esqueci a minha senha</a>   
                </p>
                <p class="mb-0"> 
                    <a href="<?= base_url('admin/auth/register'); ?>" class="text-center">Registrar</a>    
                </p> 
            </div> 
            <!-- /.login-card-body -->    </div>  
    </div>  <!-- /.login-box -->
</div>          