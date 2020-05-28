<!-- DataTables -->




<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">

    <section class="content">

        <!-- For Messages -->

        <?php $this->load->view('admin/includes/_messages.php') ?>

        <div class="card">

            <div class="card-header">

                <div class="d-inline-block">

                    <h3 class="card-title"><i class="fa fa-list"></i>&nbsp; Lista de Maquinas</h3>

                </div>

                <div class="d-inline-block float-right">

                    <div class="btn-group margin-bottom-20"> 
                        <!--
                                    <a href="<?= base_url() ?>admin/machines/create_machines_pdf" class="btn btn-secondary">Export para PDF</a>
                        
                                    <a href="<?= base_url() ?>admin/machines/export_csv" class="btn btn-secondary">Export para CSV</a>
                        -->
                    </div>

                    <?php if ($this->rbac->Check_operation_permission('add')): ?>

                        <a href="<?= base_url('admin/machines/add'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Adicionar máquina</a>

                    <?php endif; ?>

                </div>

            </div>

        </div>

        <div class="card-body">
            <?php echo form_open("/", 'class="filterdata"') ?>    



            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <select name="operador" style="width: 100%" class="select_operar" id="operadores" >
                            <option value="">Filtrar por Operador</option>
                            <?php foreach ($operadores as $operador): ?>
                                <option value="<?= $operador['id'] ?>"><?= $operador['firstname'] . ' ' . $operador['firstname'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <select name="ponto" style="width: 100%" class="select_operar" id="ponto" >
                            <option value="">Filtrar por Ponto</option>
                            <?php foreach ($pontos as $ponto): ?>
                                <option value="<?= $ponto->id ?>"><?= $ponto->ponto ?></option>
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

                            <th>ID</th>
                            <th>Data de Cadastro</th>
                            <th>Máquina</th>
                            <th>Ponto</th>
                            <th>Operador</th>
                            <th>Descrição</th>
                            <th>Serial</th>
                            <th>Cont. Inicial</th>
                            <th>Cont. Saída</th>
                            <th>Valor Vendas</th>
                            <th>Estoque</th>
                            <th>Status</th>
                            <th width="100" class="text-right">Ações</th>
                        </tr>

                    </thead>

                </table>

            </div>

        </div>

    </section>  

</div>








<script>


    var table = $('#myTable').DataTable();

    $("body").on("change", "#operadores, #ponto", function () {

        var user_id = $("#operadores").val();
        var ponto_id = $("#ponto").val();
        if (!ponto_id) {
            ponto_id = 0;
        }
        if (!user_id) {
            user_id = 0;
        }


        table.destroy();

        $('#na_datatable').empty(); // empty in case the columns change

        table = $('#na_datatable').DataTable({

            "language": {
                "url": "<?= base_url() ?>assets/plugins/datatables/i18n/br.json"
            },

            "processing": true,

            "serverSide": true,

            "ajax": "<?= base_url('admin/machines/datatable_json/') ?>" + user_id + "/" + ponto_id,

            "order": [[0, 'desc']],
            "columnDefs": [

                {"targets": 0, "title": "ID", "name": "id_maquina", 'searchable': false, 'orderable': true},
                {"targets": 1, "title": "Data do cadastro", "name": "created-at", 'searchable': true, 'orderable': true},
                {"targets": 2, "title": "Máquina", "name": "nome_tipo", 'searchable': false, 'orderable': true},
                {"targets": 3, "title": "Ponto", "name": "ponto", 'searchable': false, 'orderable': false},
                {"targets": 4, "title": "Operador", "name": "operador", 'searchable': false, 'orderable': false},
                {"targets": 5, "title": "Descrição", "name": "descricao", 'searchable': true, 'orderable': true},
                {"targets": 6, "title": "Serial", "name": "serial", 'searchable': true, 'orderable': true},
                {"targets": 7, "title": "Cont. Inicial", "name": "cont_inicial", 'searchable': false, 'orderable': false},
                {"targets": 8, "title": "Cont Saída", "name": "cont_saida_inicial", 'searchable': false, 'orderable': false},
                {"targets": 9, "title": "Cont. Saída", "name": "valorvenda", 'searchable': false, 'orderable': false},
                {"targets": 10, "title": "Estoque", "name": "estoque", 'searchable': false, 'orderable': false},
                {"targets": 11, "title": "Status", "name": "is_active", 'searchable': false, 'orderable': false},
                {"targets": 12, "title": "Ações", "name": "Ações", 'searchable': false, 'orderable': false, 'width': '100px'}

            ]

        });

    });

    table = $('#na_datatable').DataTable({

        "language": {
            "url": "<?= base_url() ?>assets/plugins/datatables/i18n/br.json"
        },

        "processing": true,

        "serverSide": true,

        "ajax": "<?= base_url('admin/machines/datatable_json') ?>",

        "order": [[0, 'desc']],

        "columnDefs": [

            {"targets": 0, "name": "id_maquina", 'searchable': false, 'orderable': true},
            {"targets": 1, "name": "tipo", 'searchable': true, 'orderable': true},
            {"targets": 2, "name": "ponto", 'searchable': false, 'orderable': false},
            {"targets": 3, "name": "operador", 'searchable': false, 'orderable': false},
            {"targets": 4, "name": "descricao", 'searchable': false, 'orderable': false},
            {"targets": 5, "name": "serial", 'searchable': false, 'orderable': false},
            {"targets": 6, "name": "cont_inicial", 'searchable': false, 'orderable': false},
            {"targets": 7, "name": "cont_saida_inicial", 'searchable': false, 'orderable': false},
            {"targets": 8, "name": "valorvenda", 'searchable': false, 'orderable': false},
            {"targets": 9, "name": "estoque", 'searchable': false, 'orderable': false},
            {"targets": 10, "name": "is_active", 'searchable': false, 'orderable': false},
            {"targets": 11, "name": "Ações", 'searchable': false, 'orderable': false, 'width': '100px'}

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





