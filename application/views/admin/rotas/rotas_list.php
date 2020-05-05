<div class="content-wrapper">
    <section class="content">
        <!-- For Messages -->
        <?php $this->load->view('admin/includes/_messages.php') ?>
        
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
                <table id="na_datatable" class="table table-bordered table-striped" width="100%">
                    <thead>
                        <tr>
                            <th>#ID</th>
                            <th>Nome da Rota</th>
                            <th>Pontos</th>
                            <th>Máquinas</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </section>  
</div>





    
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <?php $this->load->view('admin/includes/_messages.php') ?>

    <div class="modal-content">

            <div class="modal-body">
                <div class="card-header">
                <h3 class="card-title">Criar uma Rota</h3>
              </div>
                
                
                 
                    <div class="card-body">
                        
                            <div class="col-lg-12"  style='margin-top:10px'>
                                <label for="pontodevenda" class="col-md-12 control-label">Selecione os Pontos de venda de sua Rota</label>
                                
                               <div class="input-group">
                            <select name="#" required  multiple class="form-control" id="#" ></select>
                            <?php /*
                            foreach ($pontos as $ponto) {
                                echo '<option  value="' . $ponto->id . '">' . $ponto->ponto . ' | ' . $ponto->nomefan . ' ' . $pontos_selecionados[$ponto->id] . '</option>';
                            }*/
                            ?>
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





<script>

    function getMaquinas(ponto_id) {
        $(function () {
            $.ajaxSetup({cache: false});


            var $url = '<?= base_url("admin/users/get_machines/") ?>'
            var $formData = {
                '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                pontodevenda: ponto_id,
            };
            $.ajax({
                url: $url,
                type: 'POST',
                data: $formData,
                beforeSend: function (response) { },
                complete: function (response) { },
                success: function (response) {
                    //console.log( response );
                    $('#result_tipodemaquina').html(response);
                }
            });

            e.preventDefault();


        });
    }
    
    
     $("body").on("change", ".tgl_checkbox", function () {

        console.log('checked');

        $.post('<?= base_url("admin/machines/change_status") ?>',
                {

                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',

                    id: $(this).data('id'),

                    status: $(this).is(':checked') == true ? 1 : 0

                },
                function (data) {

                    $.notify("Status Atualizado com sucesso", "success");

                });

    });
    
    
    //---------------------------------------------------

    var table = $('#na_datatable').DataTable({

        "language": {
            "url": "<?= base_url() ?>assets/plugins/datatables/i18n/br.json"
        },

        "processing": true,

        "serverSide": true,

        "ajax": "<?= base_url('admin/users/datatable_user_maquinas_json/' . $user_id . '') ?>",

        "order": [[0, 'desc']],

        "columnDefs": [<th>#ID</th>
                            <th>Nome da Rota</th>
                            <th>Pontos</th>
                            <th>Máquinas</th>
                            <th>Ações</th>

            {"targets": 0, "name": "id_rota", 'searchable': true, 'orderable': true},
            {"targets": 1, "name": "nome_rota", 'searchable': true, 'orderable': true},
            {"targets": 2, "name": "pontos_rota", 'searchable': true, 'orderable': true},
            {"targets": 3, "name": "maquinas_rota", 'searchable': false, 'orderable': false},
            {"targets": 3, "name": "acoes", 'searchable': false, 'orderable': false},
        ]

    });
    
</script>