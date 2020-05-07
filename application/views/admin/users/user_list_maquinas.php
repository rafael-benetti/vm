<!-- DataTables -->




<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">

    <section class="content">

        <!-- For Messages -->

        <?php $this->load->view('admin/includes/_messages.php') ?>

        <div class="card">

            <div class="card-header">

                <div class="d-inline-block">

                    <h3 class="card-title"><i class="fa fa-list"></i>Máquinas de <b> <?php echo strtoupper($user['firstname']) . ' ' . strtoupper($user['lastname']); ?></b></h3>

                </div>

                <div class="d-inline-block float-right">
                    <!--
                                        <div class="btn-group margin-bottom-20"> 
                    
                                            <a href="<?= base_url() ?>admin/machines/create_machines_pdf" class="btn btn-secondary">Export para PDF</a>
                    
                                            <a href="<?= base_url() ?>admin/machines/export_csv" class="btn btn-secondary">Export para CSV</a>
                    
                                        </div>
                    -->

                    <?php if ($this->rbac->Check_operation_permission('add')): ?>
                        <?php if ($this->rbac->Check_operation_permission('add')): ?>

                            <a href="#"  data-toggle="modal" data-target="#exampleModal" class="btn btn-success"><i class="fa fa-plus"></i> Adicionar Máquina(s)</a>

                        <?php endif; ?>

                        <a href="<?php echo base_url('admin/users'); ?>"  class="btn btn-success"><i class="fa fa-plus"></i> Listar usuarios</a>

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
                            <th>Ponto</th>
                            <th>Maquina</th>
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

        <?php echo form_open(base_url('admin/users/add_machines/'.$user_id), 'class="form-horizontal" '); ?> 

        <div class="modal-content">

            <div class="modal-body">


                <div class="col-lg-12"  style='margin-top:10px'>
                    <label for="pontodevenda" class="col-md-6 control-label">Selecione o ponto de venda</label>
                    <div class="input-group">




                        <select name="pontodevenda" onchange="getMaquinas(this.value)" class="form-control" id="users_pontos" >
                            <option value="0" >Escolha um ponto</option>
                            <?php
                            foreach ($pontos as $ponto) {



                                echo '<option  value="' . $ponto->id . '">' . $ponto->ponto . '  ' . $pontos_selecionados[$ponto->id] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>


                <div class="col-lg-12"  style='margin-top:10px'>

                    <div class="card-body">

                        <div class="input-group">
                            <label for="lastname" class="col-md-12 control-label">Maquinas</label>


                            <div class="col-lg-12"  style='margin-top:10px'>
                                <label for="pontodevenda" class="col-md-6 control-label">Selecione as maquinas</label>
                                <div class="input-group">

                                    <select name="machines[]" required  multiple class="form-control" id="result_tipodemaquina" >

                                    </select>
                                </div>
                            </div>
                        </div>


                    </div>

                </div>


            </div><!-- /.fica dentro do body azul -->



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

        "columnDefs": [

            {"targets": 0, "name": "id", 'searchable': true, 'orderable': true},
            {"targets": 1, "name": "ponto", 'searchable': true, 'orderable': true},
            {"targets": 2, "name": "maquina", 'searchable': true, 'orderable': true},
            {"targets": 3, "name": "acoes", 'searchable': false, 'orderable': false},
        ]

    });
    
</script>