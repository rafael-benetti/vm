

<!-- DataTables -->

<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">

  <section class="content">

    <!-- For Messages -->

    <?php $this->load->view('admin/includes/_messages.php') ?>

    <div class="card">

      <div class="card-header">

        <div class="d-inline-block">

          <h3 class="card-title"><i class="fa fa-list"></i>&nbsp; Todas as oprações</h3>

        </div>

        <div class="d-inline-block float-right">

          <div class="btn-group margin-bottom-20"> 

            <!-- <a href="<?= base_url() ?>admin/machines/create_machines_pdf" class="btn btn-secondary">Export para PDF</a> -->

            <!-- <a href="<?= base_url() ?>admin/machines/export_csv" class="btn btn-secondary">Export para CSV</a> -->


			<?php //if($this->rbac->Check_operation_permission('add')): ?>
			<a href="<?= base_url('admin/operar/operar'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Iniciar Operação</a>
			<?php //endif; ?>
          </div>

        </div>

      </div>

    </div>

    <div class="card">

      <div class="card-body table-responsive">

		<div class="row" style="margin-bottom: 15px;">
			<div class="col-12 col-md-4">

				<div class="form-group">
					<label>Filtrar por Data:</label>
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text">
								<i class="fa fa-calendar"></i>
							</span>
						</div>
						<input type="text" class="form-control float-right" name="dte_filtro" id="dte_filtro">
					</div>
				</div>

			</div>
			<div class="col-12 col-md-5">
				<div class="form-group">
					<label>&nbsp;</label>
					<div>
					<a href="javascript:;" class="btn btn-info cmdFiltroDataTable"><i class="fa fa-list"></i> Filtrar Pesquisa</a>
					</div>
				</div>
			</div>
			<div class="col-12 col-md-3">
				
			</div>
		</div>




        <table id="na_datatable" class="table table-bordered table-striped" width="100%">
          <thead>
            <tr>
              <th>#ID</th>
              <th>Ponto de<br>venda</th>
              <th>Maquina</th>
              <th>Serial</th>
              <th>Cont.<br>Anterior</th>
              <th>Cont.<br>Atual</th>
              <th>Qtde<br>Jogadas</th>
              <th>Valor<br>Arrecadado</th>
              <th>Saldo de<br>Entrada</th>
              <th>Ativo</th>
              <th width="100" class="text-right">Ações</th>
            </tr>

          </thead>

        </table>

      </div>

    </div>

  </section>  

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/daterangepicker/daterangepicker.js"></script>
<script>

	var $url_json = "<?php echo(base_url('admin/operar/datatable_json')); ?>";

	//---------------------------------------------------
	var table = $('#na_datatable').DataTable({
		"language": {
			"url": "<?php echo(base_url()); ?>assets/plugins/datatables/i18n/br.json"
		},
		"paging": true,
		"searching": true,
		"processing": true,
		"serverSide": true,
		"destroy": true,
		"ajax": $url_json,
		"order": [[0,'desc']],
		"columnDefs": [
			{ "targets": 0, "name": "id", 'searchable':true, 'orderable':true},
			{ "targets": 1, "name": "ponto", 'searchable':true, 'orderable':true},
			{ "targets": 2, "name": "tipo", 'searchable':true, 'orderable':true},
			{ "targets": 3, "name": "serial", 'searchable':true, 'orderable':false},
                        { "targets": 4, "name": "cont_anterior", 'searchable':true, 'orderable':false},
			{ "targets": 5, "name": "cont_atual", 'searchable':true, 'orderable':false},
			{ "targets": 6, "name": "vendas", 'searchable':false, 'orderable':false},
			{ "targets": 7, "name": "qtde_jogadas", 'searchable':false, 'orderable':false},
			{ "targets": 8, "name": "saldo", 'searchable':false, 'orderable':false},
			{ "targets": 9, "name": "Ações", 'searchable':false, 'orderable':false,'width':'100px'}
		]
	});

	$(function () {
		$.ajaxSetup({cache: false});

		$("body").on("change",".tgl_checkbox",function(){
			$.post('<?=base_url("admin/operar/change_status")?>',
			{
				'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
				id : $(this).data('id'),
				status : ($(this).is(':checked') == true ? 1 : 0)
			},
			function(data){
				$.notify("Status Atualizado com sucesso", "success");
			});
		});

		//$('#dte_filtro').daterangepicker();
		$('#dte_filtro').daterangepicker({
			"format" : "DD/MM/YYYY",
			"locale": {
				"format": "DD/MM/YYYY",
				"separator": " - ",
				"applyLabel": "Aplicar",
				"cancelLabel": "Cancelar",
				"daysOfWeek": [
				"Dom",
				"Seg",
				"Ter",
				"Qua",
				"Qui",
				"Sex",
				"Sab"
			],
			"monthNames": [
				"Janeiro",	
				"Fevereiro",
				"Março",
				"Abril",
				"Maio",
				"Junho",
				"Julho",
				"Agosto",
				"Setembro",
				"Outubro",
				"Novembro",
				"Dezembro"
			],
			"firstDay": 1
			}
		});
		
		//Date range picker with time picker
		//$('#reservationtime').daterangepicker({
			//timePicker : true,
			//timePickerIncrement: 30,
			//format : 'MM/DD/YYYY h:mm A'
		//});

		$(document).on('click', '.cmdFiltroDataTable', function (e) {
			var $this = $(this);

			//---------------------------------------------------
			var table = $('#na_datatable').DataTable({
				"language": {
					"url": "<?php echo(base_url()); ?>assets/plugins/datatables/i18n/br.json"
				},
				"paging": true,
				"searching": true,
				"processing": true,
				"serverSide": true,
				"destroy": true,
				"ajax": {
					"url": $url_json,
					"data": function ( d ) {
						d.dte_filtro = $('#dte_filtro').val();
						// d.custom = $('#myInput').val();
					}
				},
				"order": [[0,'desc']],
       
                
				"columnDefs": [
					{ "targets": 0, "name": "id", 'searchable':true, 'orderable':true},
					{ "targets": 1, "name": "ponto", 'searchable':true, 'orderable':true},
					{ "targets": 2, "name": "tipo", 'searchable':true, 'orderable':true},
					{ "targets": 3, "name": "serial", 'searchable':true, 'orderable':true},
                                        { "targets": 4, "name": "cont_anterior", 'searchable':true, 'orderable':true},
					{ "targets": 5, "name": "cont_atual", 'searchable':true, 'orderable':true},
					{ "targets": 6, "name": "qtde_jogadas", 'searchable':false, 'orderable':false},
					{ "targets": 7, "name": "valor_arrecadado", 'searchable':false, 'orderable':false},
					{ "targets": 8, "name": "saldo", 'searchable':false, 'orderable':false},
					{ "targets": 9, "name": "is_active", 'searchable':false, 'orderable':false},
					{ "targets": 10, "name": "Ações", 'searchable':false, 'orderable':false,'width':'100px'}
				]
			});
			//---------------------------------------------------

			e.preventDefault();
		});

	});
</script>