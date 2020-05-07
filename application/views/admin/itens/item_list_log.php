<!-- DataTables -->




<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">

    <section class="content">

        <!-- For Messages -->

        <?php $this->load->view('admin/includes/_messages.php') ?>

        <div class="card">

            <div class="card-header">

                <div class="d-inline-block">

                    <h3 class="card-title"><i class="fa fa-list"></i>Estoque <b><?php echo strtoupper($item['item']); ?></b></h3>

                </div>

                <div class="d-inline-block float-right">

                    <div class="btn-group margin-bottom-20"> 
<!--
                        <a href="<?= base_url() ?>admin/machines/create_machines_pdf" class="btn btn-secondary">Export para PDF</a>

                        <a href="<?= base_url() ?>admin/machines/export_csv" class="btn btn-secondary">Export para CSV</a>
-->
                    </div>

                    <?php if ($this->rbac->Check_operation_permission('add')): ?>

                        <a href="#"  data-toggle="modal" data-target="#exampleModal" class="btn btn-success"><i class="fa fa-plus"></i> Adicionar Quantidade</a>

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
                            <th>Data</th>
                            <th>Tipo</th>
                            <th>Qtde</th>
                            <th>Usuario</th>

                        </tr>

                    </thead>

                </table>

            </div>

        </div>

    </section>  

</div>








<script>

    //---------------------------------------------------

    var table = $('#na_datatable').DataTable({

        "language": {
            "url": "<?= base_url() ?>assets/plugins/datatables/i18n/br.json"
        },

        "processing": true,

        "serverSide": true,

        "ajax": "<?= base_url('admin/itens/datatable_log_json/' . $item['id'] . '') ?>",

        "order": [[0, 'desc']],

        "columnDefs": [

            {"targets": 0, "name": "id", 'searchable': true, 'orderable': true},
            {"targets": 1, "name": "data", 'searchable': true, 'orderable': true},
            {"targets": 2, "name": "tipo_operacao", 'searchable': true, 'orderable': true},
            {"targets": 3, "name": "qtde", 'searchable': true, 'orderable': true},
            {"targets": 4, "name": "user_id", 'searchable': false, 'orderable': false},
           

        ]

    });

</script>





<script type="text/javascript">

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

</script>





<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <?php $this->load->view('admin/includes/_messages.php') ?>

        <?php echo form_open(base_url('admin/itens/add_log'), 'class="form-horizontal" '); ?> 

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Adicionar Quantidade</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <?php "<br />"; ?>


                <div class="card card-primary">

                    <div class="card-body">

                        <div class="input-group">
                            <label for="lastname" class="col-md-12 control-label">Tipo de operação</label>


                            <h3>Insumo: <?php echo $item['item']; ?> </h3>

                            <select name="tipo_operacao" style="width:100%" class="js-example-basic-single"id="item" >

                                <option value="entrada">Entrada</option>
                                <option value="saida">Saída</option>

                            </select>
                        </div>

                        <div class="input-group">
                            <label for="lastname" class="col-md-12 control-label">Quantidade</label>
                            <input type="hidden" name="item" class="form-control" id="item" value="<?php echo $item['id']; ?>" >
                            <input type="number" name="qtde" class="form-control" id="qtde" placeholder="Quantidade">
                        </div>
                    </div>


                </div><!-- /.fica dentro do body azul -->







            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <input type="submit" name="submit" value="Salvar" class="btn btn-primary pull-right">

            </div>
        </div>
    </div>

    <?php echo form_close(); ?>
</div>
</div>