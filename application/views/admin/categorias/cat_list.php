<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.css"> 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <section class="content">
    <!-- For Messages -->
    <?php $this->load->view('admin/includes/_messages.php') ?>
    <div class="card">
      <div class="card-header">
        <div class="d-inline-block">
          <h3 class="card-title"><i class="fa fa-list"></i>&nbsp; Lista de Categorias</h3>
        </div>
        <div class="d-inline-block float-right">
          <?php if($this->rbac->Check_operation_permission('add')): ?>
            <a href="<?= base_url('admin/categorias/add'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Adicionar Categorias</a>
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

              <th>Categoria</th>
              
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
  
    var table = $('#na_datatable').DataTable( {
      
       "language": {
            "url": "<?= base_url() ?>assets/plugins/datatables/i18n/br.json"
        },

    "processing": true,

    "serverSide": true,

    "ajax": "<?=base_url('admin/categorias/datatable_json')?>",

    "order": [[0,'desc']],

    "columnDefs": [

    { "targets": 0, "name": "id", 'searchable':true, 'orderable':true},

    { "targets": 1, "name": "categorias", 'searchable':true, 'orderable':true},

    { "targets": 2, "name": "is_active", 'searchable':false, 'orderable':true},

    { "targets": 3, "name": "Ações", 'searchable':false, 'orderable':false,'width':'100px'}

    ]

  });

</script>



<script type="text/javascript">
  $("body").on("change",".tgl_checkbox",function(){
        $.post('<?=base_url("admin/categorias/change_status")?>',
    {
      '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
      id : $(this).data('id'),
      status : $(this).is(':checked') == true?1:0
    },
    function(data){
      $.notify("Status alterado com sucesso", "success");
    });
  });
</script>





