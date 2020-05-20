  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="card card-default">
        <div class="card-header">
          <div class="d-inline-block">
              <h3 class="card-title"> <i class="fa fa-plus"></i>
              Adicionar novo ponto </h3>
          </div>
          <div class="d-inline-block float-right">
            <a href="<?= base_url('admin/pontos'); ?>" class="btn btn-success"><i class="fa fa-list"></i>  Lista de Pontos</a>
          </div>
        </div>
        <div class="card-body">

           <!-- For Messages -->

            <?php $this->load->view('admin/includes/_messages.php') ?>

            <?php echo form_open(base_url('admin/pontos/add'), 'class="form-horizontal"');  ?> 
            <?php "<br />"; ?>
			
              <div class="form-group">
                <label for="ponto" class="col-md-6 control-label">Nome do Ponto</label>
                <div class="col-md-12">
                  <input type="text" name="ponto" class="form-control" id="ponto" placeholder="">
                </div>
              </div>
           
            <?php
           
           if($this->session->userdata('is_supper')==1){
           ?>
                       <div class="form-group">
                                <div class="col-lg-12"  style='margin-top:10px'>
                                    <label for="user_id" class="col-md-6 control-label">Selecione Operador</label>
                                    <div class="input-group">
                                        <select name="user_id" style="width:100%" class="select-operar" id="user_id" >
                                            <option value="-1">Nenhum operador</option>
                                            <?php
                                            foreach ($operadores as $operador) {
                                                echo '<option value="' . $operador['id'] . '">' . $operador['firstname'] .  ' ' . $operador['lastname'] .  '</option>';
                                            }
                                            ?> 
                                        </select>
                                    </div>
                                </div>
                            </div>
              <?php }else{
               
               echo '<input name="user_id" value="'.$this->session->userdata('admin_id').'" type="hidden">';
           } ?>

           
                     

              
			
						<div class="form-group">
                <label for="email" class="col-md-6 control-label">Email</label>
                <div class="col-md-12">
                  <input type="email" name="email" class="form-control" id="email" placeholder="">
                </div>
              </div>	
           <div class="form-group">
                <label for="comissao" class="col-md-6 control-label">Comissão do Ponto</label>
                
                <div class="col-md-6">
                  <input type="number" name="comissao" class="form-control" id="comissao" placeholder="">
                </div>
                
                 <div class="col-md-6">
                
                    <!-- <input type="radio"  name="tipo_comissao" value="valor"> Aluguel -->
                     <input type="radio" checked="true" name="tipo_comissao" value="percentual"> Em Percentual
                     
                </div>
              </div>
     
			     <div class="card-body">
                <div class="row">
                  <div class="col-6">
					<label for="responsavel" class="col-md-6 control-label">Responsável</label>
                    <input type="text" name="responsavel" class="form-control" id="responsavel" placeholder="">
                  </div>
					
                  <div class="col-6">
					  <label for="telefone" class="col-md-6 control-label">Telefone</label>
                    <input type="text" name="telefone" class="cellphone_with_ddd form-control" id="telefone" placeholder="">
                  </div>
                </div>
              </div>

      		        <div class="card-body">
                <div class="row">
                  <div class="col-6">
					<label for="endereco" class="col-md-6 control-label">Cep</label>
                    <input type="text" name="cep" id="cep" onblur="pesquisacep(this.value)" class="cep form-control" id="endereco" placeholder="">
                  </div>
                    <div class="col-6">
					<label for="endereco" class="col-md-6 control-label">Endereço</label>
                    <input type="text" name="endereco" id="endereco" class="form-control" id="endereco" placeholder="">
                  </div>
                </div>
                               <div class="row">
                  
					
                  <div class="col-6">
					  <label for="numero" class="col-md-6 control-label">Número</label>
                    <input type="text" name="numero" class="form-control" id="numero" placeholder="">
                  </div>
					
                  <div class="col-6">
					  <label for="numero" class="col-md-6 control-label">Bairro</label>
                                          <input type="text" name="bairro" id="bairro" class="form-control" id="numero" placeholder="">
                  </div>
                </div>
              </div>
			   
              <div class="card-body">
                <div class="row">
                  <div class="col-6">
					<label for="cidade" class="col-md-6 control-label">Cidade</label>
                    <input type="text" name="cidade" id="cidade" class="form-control" id="cidade" placeholder="">
                  </div>
					
                  <div class="col-6">
					  <label for="estado" class="col-md-6 control-label">Estado</label>
                    <input type="text" name="estado" id="estado" class="form-control" id="estado" placeholder="">
                  </div>
                </div>
              </div>
                         

	     <div class="row" style='margin-top:25px'>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputFile">Status</label>
                                    <div class="input-group">
                                        <select name="is_active" class="form-control">
                                            <option value="1"  >Ativado</option>
                                            <option value="0">Desativado</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

              <div class="form-group">

                <div class="col-md-12">

                  <input type="submit" name="submit" value="Adicionar Ponto" class="btn btn-primary pull-right">

                </div>

              </div>

            <?php echo form_close( ); ?>

        </div>
          <!-- /.box-body -->
      </div>
    </section> 
  </div>