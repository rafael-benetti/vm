
<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">

    <section class="content">

        <!-- For Messages -->

        <?php $this->load->view('admin/includes/_messages.php') ?>

        <div class="card">

            <div class="card-header">

                <div class="d-inline-block">

                    <h3 class="card-title"><i class="fa fa-list"></i>&nbsp; Lista de Pontos</h3>

                </div>

                <div class="d-inline-block float-right">

                    <div class="btn-group margin-bottom-20"> 
                        <?php if (verifica_permissao('ponto', 'view')): ?>
                            <!--
                                        <a href="<?= base_url() ?>admin/pontos/create_pontos_pdf" class="btn btn-secondary">Exportar para PDF</a>
                            
                                        <a href="<?= base_url() ?>admin/pontos/export_csv" class="btn btn-secondary">Exportar para CSV</a>
                            -->
                        <?php endif; ?>
                    </div>

                    <?php if (verifica_permissao('ponto', 'add')): ?>

                        <a href="<?= base_url('admin/pontos/add'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Adicionar novo ponto</a>

                    <?php endif; ?>

                </div>

            </div>

        </div>

        <div class="card-body">
            <?php echo form_open("/", 'class="filterdata"') ?>    



            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <select name="type" style="width: 100%" class="select_operar" id="operadores" >
                            <option value="">Filtrar por Operador</option>
                            <?php foreach ($operadores as $operador): ?>
                                <option value="<?= $operador['id'] ?>"><?= $operador['firstname'] . ' ' . $operador['firstname'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>


            </div>
            <?php echo form_close(); ?> 
        </div> 

        <div class="card">

            <div class="card-body table-responsive">

                <table id="na_datatable" class="table table-bordered table-striped" width="100%">

                    <thead>

                        <tr>

                            <th>#ID</th>

                            <th>Ponto</th>
                            <th>Operador</th>

                            <th>Email</th>

                            <th>Telefone</th>

                            <th>Data de Cadastro</th>

                            <th>Status</th>

                            <th width="100" class="text-right">Ação</th>

                        </tr>

                    </thead>

                </table>

            </div>

        </div>

    </section>  

</div>






<script>
    var table = $('#myTable').DataTable();

    $("body").on("change", "#operadores", function () {

        var user_id = $("#operadores").val();

        table.destroy();

        $('#na_datatable').empty(); // empty in case the columns change

        table = $('#na_datatable').DataTable({
            "language": {
                "url": "<?= base_url() ?>assets/plugins/datatables/i18n/br.json"
            },

            "processing": true,

            "serverSide": true,

            "ajax": "<?= base_url('admin/pontos/datatable_json/') ?>" + user_id,

            "order": [[0, 'desc']],

            "columnDefs": [

                {"targets": 0, "name": "id", "title": "ID", 'searchable': true, 'orderable': true},

                {"targets": 1, "name": "ponto", "title": "Ponto", 'searchable': true, 'orderable': true},

                {"targets": 2, "name": "ponto", "title": "Operador", 'searchable': true, 'orderable': true},

                {"targets": 3, "name": "email", "title": "Email", 'searchable': true, 'orderable': true},

                {"targets": 4, "name": "telefone", "title": "Telefone", 'searchable': true, 'orderable': true},

                {"targets": 5, "name": "created_at", "title": "Data de Cadastro", 'searchable': true, 'orderable': false},

                {"targets": 6, "name": "is_active", "title": "Status", 'searchable': false, 'orderable': false},

                {"targets": 7, "name": "Action", "title": "Ação", 'searchable': false, 'orderable': false, 'width': '100px'}

            ]

        });

    });
    table = $('#na_datatable').DataTable({
        "language": {
            "url": "<?= base_url() ?>assets/plugins/datatables/i18n/br.json"
        },

        "processing": true,

        "serverSide": true,

        "ajax": "<?= base_url('admin/pontos/datatable_json') ?>",

        "order": [[0, 'desc']],

        "columnDefs": [

            {"targets": 0, "name": "id", 'searchable': true, 'orderable': true},

            {"targets": 1, "name": "ponto", 'searchable': true, 'orderable': true},

            {"targets": 2, "name": "ponto", 'searchable': true, 'orderable': true},

            {"targets": 3, "name": "email", 'searchable': true, 'orderable': true},

            {"targets": 4, "name": "telefone", 'searchable': true, 'orderable': true},

            {"targets": 5, "name": "created_at", 'searchable': true, 'orderable': false},

            {"targets": 6, "name": "is_active", 'searchable': false, 'orderable': false},

            {"targets": 7, "name": "Action", 'searchable': false, 'orderable': false, 'width': '100px'}

        ]

    });



</script>





<script type="text/javascript">

    $("body").on("change", ".tgl_checkbox", function () {



        console.log('checked');

        $.post('<?= base_url("admin/pontos/change_status") ?>',
                {

                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',

                    id: $(this).data('id'),

                    status: $(this).is(':checked') == true ? 1 : 0

                },
                function (data) {

                    $.notify("Status atualizado com sucesso", "success");

                });

    });

</script>





