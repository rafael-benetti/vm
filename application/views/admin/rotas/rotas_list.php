<div class="content-wrapper">
    <section class="content">
        <!-- For Messages -->
        <?php $this->load->view('admin/includes/_messages.php') ;
                
           
                
                ?>
        
        <div class="card">
            <div class="card-header">
                <div class="d-inline-block">
                    <h3 class="card-title"><i class="fa fa-list"></i> Cadastro de Rotas<b> </b></h3>
                </div>            
                <div class="d-inline-block float-right">
                        <?php if ($this->rbac->Check_operation_permission('add')): ?>
                            <a href="#"  data-toggle="modal" data-target="#exampleModal" class="btn btn-success"><i class="fa fa-plus"></i> Adicionar uma Rota</a>
                        <?php endif; ?>                     
                </div>
            </div>
        </div>

        
        <div class="card">
            <div class="card-body table-responsive">
                <table id="na_dattable" class="table table-bordered table-striped" width="100%">
                   
                        <tr>
                            <th>#ID</th>
                            <th>Nome da Rota</th>
                            <th>Pontos</th>
                           <!-- <th>Quantidade de Máquinas</th>
                            <th>Ações</th>-->
                        </tr>
                        <?php foreach ($rotas as $rota) {?>
                <tr>
                    <td><?= $rota['rota']->id; ?></td>
                    <td><?= $rota['rota']->nome; ?></td>  
                    <td>
                        <?php foreach($rota['pontos'] as $ponto){
                            echo $ponto['ponto'].'<br>';
                            
                        } ?>
                    
                    </td>  
                   <!-- <td><?= $rotas->nome; ?></td>  
                    <td><?= $rotas->nome; ?></td>  -->
                </tr>
                        <?php }?>
                </table>
            </div>
        </div>
    </section>  
</div>



    
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <?php $this->load->view('admin/includes/_messages.php') ?>
 <?php echo form_open(base_url('admin/rotas/add_rotas'), 'class="form-horizontal" '); ?> 
    <div class="modal-content">

            <div class="modal-body">
                <div class="card-header">
                <h3 class="card-title">Criar uma Rota</h3>
              </div>
                
                
                 
                    <div class="card-body">
                        
                            <div class="col-lg-12"  style='margin-top:10px'>
                                <label for="ponto_id" class="col-md-12 control-label">Selecione os Pontos de venda de sua Rota</label>
                                
                               <div class="input-group">
                            <select name="ponto_id[]" required  multiple class="form-control" >
                            <?php 
                            foreach ($pontos as $ponto) {
                                echo '<option  value="' . $ponto->id . '">' . $ponto->ponto . '   ' . $pontos_selecionados[$ponto->id] . '</option>';
                            }
                            ?>
                            </select>
                               </div>
                            </div>
                       
                    </div>
                 
            </div>
        
                    <div class="col-md-11" style='padding-left:45px'>
                        <label for="rota" class="col-md-12 control-label">Nome da Rota</label>
                        <input type="text" name="rota" class="form-control" id="rota" placeholder="Nome">
                    </div>
        
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <input type="submit" name="submit" value="Salvar" class="btn btn-primary pull-right">
        </div>
    </div>
        
    
    <?php echo form_close(); ?>
    </div>

</div>


