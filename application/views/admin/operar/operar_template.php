  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

	<?php
		// fct_print_debug($rs);
		$observacoes_equip = (isset($rs["observacoes_equip"]) ? $rs["observacoes_equip"] : "");
		$created_at = (isset($rs["created_at"]) ? $rs["created_at"] : "");

		$ponto = (isset($rs["ponto"]) ? $rs["ponto"] : "");
		$tipo = (isset($rs["tipo"]) ? $rs["tipo"] : "");
		$serial = (isset($rs["serial"]) ? $rs["serial"] : "");

		$cont_anterior = (int)(isset($rs["cont_anterior"]) ? $rs["cont_anterior"] : "");
		$cont_atual = (int)(isset($rs["cont_atual"]) ? $rs["cont_atual"] : "");

		$cont_saida_anterior = (int)(isset($rs["cont_anterior"]) ? $rs["cont_saida_anterior"] : "");
		$cont_saida_atual = (int)(isset($rs["cont_saida_atual"]) ? $rs["cont_saida_atual"] : "");

		$valorvenda = (isset($rs["valorvenda"]) ? $rs["valorvenda"] : "");
		$comissao = (isset($rs["comissao"]) ? $rs["comissao"] : "");

		$vendas = (int)($cont_saida_atual - $cont_saida_anterior);
		$valorpremio =  (float)(($cont_atual - $cont_anterior) * $valorvenda);
                $totalcontador =  (float)($cont_atual - $cont_anterior);	
		$valorpremio = (float)$valorpremio;
		$valorcomissao = ((($valorpremio) * $comissao) / 100);

		$valorcomissao = number_format($valorcomissao, 2, ',', '.');
		$valorpremio = number_format($valorpremio, 2, ',', '.');
	?> 

    <section class="content">
      <div class="container-fluid">
        <div class="row">

          <div class="col-12">
            <div class="callout callout-info">
              <h5><i class="fa fa-info"></i> Observação: <?php echo($observacoes_equip); ?></h5>
            </div>

            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fa fa-globe"></i> Operação.
                    <small class="float-right">Data: <?php echo($created_at); ?></small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>

				<!-- info row -->
				<div class="row invoice-info">
					<!-- /.col -->
					<div class="col-sm-3 invoice-col">
						<div>
							<address>
								<strong>Ponto de Venda:</strong><br>
								<?php echo($ponto); ?><br>
							</address>
						</div>
						<div>
							<address>
								<strong>Tipo de Máquina:</strong><br>
								<?php echo($tipo); ?><br>
							</address>
						</div>
						<div>
							<address>
								<strong>Serial:</strong><br>
								<?php echo($serial); ?><br>
							</address>
						</div>
						<div>
							<address>
								<b>Percentual de ponto:</b> <br>
								<?php echo($comissao); ?>% &nbsp; - &nbsp; R$ <?php echo($valorcomissao); ?><br>
							</address>
						</div>
					</div><!-- /.col -->
					<div class="col-sm-9 invoice-col">
						<div class="row">
							<div class="col-sm-6">
								<b>Foto do contador de entrada</b><br>
								<?php 
									$imagem = (isset($rs["imagem"]) ? $rs["imagem"] : "");
									$placeholder = '';
									$image_path = $this->config->item('folder_images') .'/operacao/'. $imagem;
									if( file_exists($image_path) and is_file($image_path) ){
								?>
									<div class="box-img"><a href="<?php echo( base_url($image_path) ); ?>" target="blank"><img src="<?php echo( base_url($image_path) ); ?>" alt="contador de entrada" style="width: 100%;" /></a></div>
								<?php
									}
								?>
							</div>
							<div class="col-sm-6">
								<b>Foto do contador de saída</b><br>
								<?php 
									$imagem_cont_saida = (isset($rs["imagem_cont_saida"]) ? $rs["imagem_cont_saida"] : "");
									$placeholder = '';
									$image_path = $this->config->item('folder_images') .'/operacao/'. $imagem_cont_saida;
									if( file_exists($image_path) and is_file($image_path) ){
								?>
									<div class="box-img"><a href="<?php echo( base_url($image_path) ); ?>" target="blank"><img src="<?php echo( base_url($image_path) ); ?>" alt="contador de saída" style="width: 100%;" /></a></div>
								<?php
									}
								?>
							</div>
						</div>
					</div><!-- /.col -->
				</div>
				<!-- /.row -->

              <!-- Table row -->
              <div class="row" style="margin: 15px 0">
                <div class="col-12 table-responsive">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>Cont. Entrada<br>Anterior</th>
								<th>Cont. Entrada<br>Atual</th>
								<th>Cont. Saída<br>Anterior</th>
								<th>Cont. Saída<br>Atual</th>
                                                                <th>Total Cont.<br>Saída</th>
								<th>Saída de <br>Prêmios</th>
								<th>Saldo</th>
								
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="text-center"><?php echo($cont_anterior); ?></td>
								<td class="text-center"><?php echo(isset($rs["cont_atual"]) ? $rs["cont_atual"] : ""); ?></td>
								<td class="text-center"><?php echo(isset($rs["cont_saida_anterior"]) ? $rs["cont_saida_anterior"] : ""); ?></td>
								<td class="text-center"><?php echo(isset($rs["cont_saida_atual"]) ? $rs["cont_saida_atual"] : ""); ?></td>
                                                                <td class="text-center"><?php echo($totalcontador); ?></td>
								<td class="text-center"><?php echo($vendas); ?></td>
								<td>R$ <?php echo($valorpremio); ?></td>
								
							</tr>
						</tbody>
					</table>
                </div>
                <!-- /.col -->
              </div><!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                  <a href="<?= base_url('admin/operar/operar_list'); ?>" class="btn btn-primary float-right" style="margin-right: 5px;">Listar Operações</a>
                </div>
              </div>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->