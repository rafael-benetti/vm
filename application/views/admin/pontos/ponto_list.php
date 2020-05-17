
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
                 <?php if(verifica_permissao('ponto','view')): ?>
<!--
            <a href="<?= base_url() ?>admin/pontos/create_pontos_pdf" class="btn btn-secondary">Exportar para PDF</a>

            <a href="<?= base_url() ?>admin/pontos/export_csv" class="btn btn-secondary">Exportar para CSV</a>
-->
            <?php endif; ?>
          </div>

          <?php if(verifica_permissao('ponto','add')): ?>

            <a href="<?= base_url('admin/pontos/add'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Adicionar novo ponto</a>

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

              <th>Nome do Ponto</th>
              <th>Operador</th>

              <th>Email</th>

              <th>Telefone</th>

              <th>Data de Cadastro</th>

              <th>Status</th>

              <th width="100" class="text-right">Action</th>

            </tr>

          </thead>

        </table>

      </div>

    </div>

  </section>  

</div>





<!-- DataTables -->

<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>

<script src="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.js"></script>



<script>

  //---------------------------------------------------

  var table = $('#na_datatable').DataTable( {
       "language": {
            "url": "<?= base_url() ?>assets/plugins/datatables/i18n/br.json"
        },

    "processing": true,

    "serverSide": true,

    "ajax": "<?=base_url('admin/pontos/datatable_json')?>",

    "order": [[4,'desc']],

    "columnDefs": [

    { "targets": 0, "name": "id", 'searchable':true, 'orderable':true},

    { "targets": 1, "name": "ponto", 'searchable':true, 'orderable':true},

    { "targets": 2, "name": "email", 'searchable':true, 'orderable':true},

    { "targets": 3, "name": "telefone", 'searchable':true, 'orderable':true},

    { "targets": 4, "name": "created_at", 'searchable':false, 'orderable':false},

    { "targets": 5, "name": "is_active", 'searchable':true, 'orderable':true},

    { "targets": 6, "name": "Action", 'searchable':false, 'orderable':false,'width':'100px'}

    ]

  });

</script>





<script type="text/javascript">

  $("body").on("change",".tgl_checkbox",function(){
      
      

    console.log('checked');

    $.post('<?=base_url("admin/pontos/change_status")?>',

    {

      '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',

      id : $(this).data('id'),

      status : $(this).is(':checked') == true?1:0

    },

    function(data){

      $.notify("Status atualizado com sucesso", "success");

    });

  });

</script>





