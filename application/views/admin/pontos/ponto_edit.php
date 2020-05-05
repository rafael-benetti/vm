  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="card card-default">
        <div class="card-header">
          <div class="d-inline-block">
              <h3 class="card-title"> <i class="fa fa-plus"></i>
              Editar  ponto </h3>
          </div>
          <div class="d-inline-block float-right">
            <a href="<?= base_url('admin/pontos'); ?>" class="btn btn-success"><i class="fa fa-list"></i>  Lista de Pontos</a>
          </div>
        </div>
        <div class="card-body">

           <!-- For Messages -->

            <?php $this->load->view('admin/includes/_messages.php') ?>

            <?php echo form_open(base_url('admin/pontos/edit/'.$ponto['id']), 'class="form-horizontal"');  ?> 
            <?php "<br />"; ?>
			
              <div class="form-group">
                <label for="ponto" class="col-md-6 control-label">Nome do Ponto</label>
                <div class="col-md-12">
                  <input type="text" name="ponto" value="<?php echo $ponto['ponto']; ?>" class="form-control" id="ponto" placeholder="">
                </div>
              </div>

              <div class="form-group">
                <label for="nomefan" class="col-md-6 control-label">Nome Fantasia</label>
                <div class="col-md-12">
                  <input type="text" name="nomefan" value="<?php echo $ponto['nomefan']; ?>" class="form-control" id="nomefan" placeholder="">
                </div>
              </div>
			
						<div class="form-group">
                <label for="email" class="col-md-6 control-label">Email</label>
                <div class="col-md-12">
                  <input type="email" name="email"  value="<?php echo $ponto['email']; ?>"  class="form-control" id="email" placeholder="">
                </div>
              </div>	
           <div class="form-group">
                <label for="comissao" class="col-md-6 control-label">Comissão do Ponto</label>
                <div class="col-md-12">
                  <input type="number" name="comissao"  value="<?php echo $ponto['comissao']; ?>"  class="form-control" id="comissao" placeholder="">
                </div>
              </div>
     
			     <div class="card-body">
                <div class="row">
                  <div class="col-6">
					<label for="responsavel" class="col-md-6 control-label">Responsável</label>
                    <input type="text" name="responsavel"  value="<?php echo $ponto['responsavel']; ?>"  class="form-control" id="responsavel" placeholder="">
                  </div>
					
                  <div class="col-6">
					  <label for="telefone" class="col-md-6 control-label">Telefone</label>
                    <input type="text" name="telefone"  value="<?php echo $ponto['telefone']; ?>"  class="cellphone_with_ddd form-control" id="telefone" placeholder="">
                  </div>
                </div>
              </div>

      		        <div class="card-body">
                <div class="row">
                  <div class="col-6">
					<label for="endereco" class="col-md-6 control-label">Cep</label>
                    <input type="text" name="cep" id="cep"  value="<?php echo $ponto['cep']; ?>"  onblur="pesquisacep(this.value)" class="cep form-control" id="endereco" placeholder="">
                  </div>
                    <div class="col-6">
					<label for="endereco" class="col-md-6 control-label">Endereço</label>
                    <input type="text" name="endereco"  value="<?php echo $ponto['endereco']; ?>"  id="endereco" class="form-control" id="endereco" placeholder="">
                  </div>
                </div>
                               <div class="row">
                  
					
                  <div class="col-6">
					  <label for="numero" class="col-md-6 control-label">Número</label>
                    <input type="text" name="numero"  value="<?php echo $ponto['numero']; ?>"  class="form-control" id="numero" placeholder="">
                  </div>
					
                  <div class="col-6">
					  <label for="numero" class="col-md-6 control-label">Bairro</label>
                                          <input type="text" name="bairro"  value="<?php echo $ponto['bairro']; ?>"  id="bairro" class="form-control" id="numero" placeholder="">
                  </div>
                </div>
              </div>
			   
              <div class="card-body">
                <div class="row">
                  <div class="col-6">
					<label for="cidade" class="col-md-6 control-label">Cidade</label>
                    <input type="text" name="cidade"  value="<?php echo $ponto['cidade']; ?>"  id="cidade" class="form-control" id="cidade" placeholder="">
                  </div>
					
                  <div class="col-6">
					  <label for="estado" class="col-md-6 control-label">Estado</label>
                    <input type="text" name="estado" id="estado"  value="<?php echo $ponto['estado']; ?>"  class="form-control" id="estado" placeholder="">
                  </div>
                </div>
              </div>
           
                <div class="row" style='margin-top:25px'>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputFile">Status</label>
                                    <div class="input-group">
                                        <select name="is_active" class="form-control">
                                            <option value="1" <?= ($ponto['is_active'] == 1) ? 'selected' : '' ?> >Ativado</option>
                                            <option value="0" <?= ($ponto['is_active'] == 0) ? 'selected' : '' ?>>Desativado</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                         

	

              <div class="form-group">

                <div class="col-md-12">

                  <input type="submit" name="submit" value="Atualizar Ponto" class="btn btn-primary pull-right">

                </div>

              </div>

            <?php echo form_close( ); ?>

        </div>
          <!-- /.box-body -->
      </div>
    </section> 
  </div>