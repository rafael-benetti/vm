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

          <?php if($this->rbac->Check_operation_permission('add')): ?>

            <a href="<?= base_url('admin/machines/add'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Adicionar máquina</a>

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

  //---------------------------------------------------

  var table = $('#na_datatable').DataTable( {
      
      "language": {
            "url": "<?= base_url() ?>assets/plugins/datatables/i18n/br.json"
        },

    "processing": true,

    "serverSide": true,

    "ajax": "<?=base_url('admin/machines/datatable_json')?>",

    "order": [[0,'desc']],

    "columnDefs": [

    { "targets": 0, "name": "id_maquina", 'searchable':false, 'orderable':true},
    { "targets": 1, "name": "tipo", 'searchable':true, 'orderable':true},
    { "targets": 2, "name": "ponto", 'searchable':true, 'orderable':true},
    { "targets": 3, "name": "operador", 'searchable':true, 'orderable':true},
    { "targets": 4, "name": "descricao", 'searchable':false, 'orderable':false},
    { "targets": 5, "name": "serial", 'searchable':false, 'orderable':false},
    { "targets": 6, "name": "cont_inicial", 'searchable':false, 'orderable':false},
    { "targets": 7, "name": "cont_saida_inicial", 'searchable':false, 'orderable':false},
    { "targets": 8, "name": "valorvenda", 'searchable':false, 'orderable':false},
    { "targets": 9, "name": "estoque", 'searchable':false, 'orderable':false},
    { "targets": 10, "name": "is_active", 'searchable':false, 'orderable':false},
    { "targets": 11, "name": "Ações", 'searchable':false, 'orderable':false,'width':'100px'}

    ]

  });

</script>





<script type="text/javascript">

  $("body").on("change",".tgl_checkbox",function(){

    console.log('checked');

    $.post('<?=base_url("admin/machines/change_status")?>',

    {

      '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',

      id : $(this).data('id'),

      status : $(this).is(':checked') == true?1:0

    },

    function(data){

      $.notify("Status Atualizado com sucesso", "success");

    });

  });

</script>





