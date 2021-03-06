
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">

        <div class="card card-default">
            <div class="card-header">
                <div class="d-inline-block">
                    <h3 class="card-title"> <i class="fa fa-plus"></i>
                        <a href="<?= base_url('admin') ?>" class="card-title">Dashboard</a> </h3>
                </div>
                <div class="d-inline-block float-right">
                    <a href="<?= base_url('admin/operar/operar_list'); ?>" class="btn btn-success"><i class="fa fa-list"></i> Listar operações</a>
                </div>
            </div>
            <div class="card-body">

                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Iniciar operação de ponto</h3>
                    </div>
                    <!-- /.card-header -->

					<?php $this->load->view('admin/includes/_messages.php') ?>

                    <!-- form start -->
					<?php echo form_open_multipart(current_url(), 'class="form-horizontal"'); ?> 
						<?php $operacao_id = (int)(isset($rs["id"]) ? $rs["id"] : ""); ?>
						<input type="hidden" name="operacao_id" id="operacao_id" value="<?php echo($operacao_id); ?>" />

                        <div class="card-body">

                            <div class="row">
								<div class="col-lg-6"  style='margin-top:10px'>
									<label for="pontodevenda" class="col-md-6 control-label">Selecione o ponto de venda</label>
									<div class="input-group">
                                                                            <select required name="pontodevenda" style="width:100%" class="select_operar" id="pontodevenda" >
											<option value="">- selecione -</option>
											<?php
												$pontodevenda = (int)(isset($rs["pontodevenda"]) ? $rs["pontodevenda"] : "");
												foreach ($pontos as $ponto) {
													$selected = (($pontodevenda == $ponto->id) ? " selected = 'true'" : "");
													echo '<option value="'. $ponto->id .'" '. $selected .'>' . $ponto->ponto . '</option>';
												}
											?>
										</select>
									</div>
								</div>
								<div class="col-lg-6"  style='margin-top:10px'>
									<label for="maq_id" class="col-md-6 control-label">Máquina</label>
									<div class="input-group"  id="result_tipodemaquina">
										<select required name="maq_id" style="width:100%" class="select_operar"  id="maq_id" >
                                                                                    
                                                                                    <?php 
                                                                                    	$tipomaquina= (int)(isset($rs["tipomaquina"]) ? $rs["tipomaquina"] : "");
											
                                                                                    if($tipomaquina>0){
                                                                                        
                                                                                        echo '<option >'.$rs['tipo'].'</option>';
                                                                                        
                                                                                    }else{ ?>
											<option >- Escolha o ponto para selecionar a maquina -</option>
                                                                                    <?php } ?>
										</select>
									</div>
								</div>
                                <!-- /.col-lg-6 -->
                            </div>

                            <div class="row">
								<div class="col-lg-6"  style='margin-top:20px'>

									<div class="card card-primary" style='margin-top:20px'>
										<div class="card-header" style="background-color: #31866b;">
											<h3 class="card-title">Contador de Entrada</h3>
										</div>
										<div class="card-body">

											<div class="row" style='margin-top:10px'>
												<!--
                                                                                                 <div class="col-12">
													<?php $cont_anterior = (int)(isset($rs["cont_anterior"]) ? $rs["cont_anterior"] : ""); ?>
													<label for="cont_anterior" class="col-md-12 control-label">Cont. Anterior</label>
													<input type="number" name="cont_anterior" id="cont_anterior" value="<?php echo($cont_anterior); ?>" class="form-control" placeholder="" readOnly>
												</div>
                                                                                                  -->
                                                                                                       	<input type="hidden" name="cont_anterior" id="cont_anterior" value="<?php echo($cont_anterior); ?>" class="form-control" placeholder="" readOnly>
												
												<div class="col-12">
													<?php $cont_atual = (int)(isset($rs["cont_atual"]) ? $rs["cont_atual"] : ""); ?>
													<label for="cont_atual" class="col-md-12 control-label">Cont. Atual</label>
													<input type="number" name="cont_atual" id="cont_atual" value="<?php echo($cont_atual); ?>" class="form-control" placeholder="">
												</div>
											</div>

											<div class="row justify-content-md-center" style='margin-top:10px'>
												<div class="col-6">

													<?php $imagem = (isset($rs["imagem"]) ? $rs["imagem"] : ""); ?>
													<div class="form-group row">
														<div class="col-md-12 text-center">
															<input type="hidden" name="file_operacao_old" id="file_operacao_old" value="<?php echo($imagem); ?>" />

															<div class="wrapper-image-preview text-center">
																<div class="box" style="margin: 0 auto;">
																	<?php
																		$label_upload = "Foto do contador de entrada atual";
																		$placeholder = base_url("assets/dist/img/placeholder-image.jpg");
																		$image_path = $this->config->item('folder_images') .'/operacao/'. $imagem;
																		if( file_exists($image_path) and is_file($image_path) ){ $placeholder = base_url($image_path); }
																	?>
																	<div class="js--image-preview" style="background-image: url(<?php echo($placeholder); ?>); background-color: #F5F5F5;"></div>
																	<div class="upload-options">
																		<label for="file_operacao" class="btn btn-white-sp"> <i class="mdi mdi-camera"></i> <?php echo $label_upload; ?> </label>
																		<input style="visibility:hidden;" type="file" class="image-upload" name="file_operacao" id="file_operacao" accept="image/*">
																	</div>
																</div>
															</div>
														</div>
													</div>

												</div>
											</div>
											
										</div>
									</div>
									
								</div>
								<div class="col-lg-6"  style='margin-top:20px'>

									<div class="card card-primary" style='margin-top:20px'>
										
										<div class="card-header" style="background-color: #31866b;">
											<h3 class="card-title">Contador de Saída</h3>
										</div>
										
										<div class="card-body">

											<div class="row" style='margin-top:10px'>
                                                                                            <!--
												<div class="col-12">
													<?php $cont_saida_anterior = (int)(isset($rs["cont_saida_anterior"]) ? $rs["cont_saida_anterior"] : ""); ?>
													<label for="cont_saida_anterior" class="col-md-12 control-label">Cont. de Saída Anterior</label>
													<input type="number" name="cont_saida_anterior" id="cont_saida_anterior" value="<?php echo($cont_saida_anterior); ?>" class="form-control" placeholder="" readOnly>
												</div>
                                                                                            -->
                                                                                            	<input type="hidden" name="cont_saida_anterior" id="cont_saida_anterior" value="<?php echo($cont_saida_anterior); ?>" class="form-control" placeholder="" readOnly>
											
                                                                                            
												<div class="col-12">
													<?php $cont_saida_atual = (int)(isset($rs["cont_saida_atual"]) ? $rs["cont_saida_atual"] : ""); ?>
													<label for="cont_atual" class="col-md-12 control-label">Cont. de Saída Atual</label>
													<input type="number" name="cont_saida_atual" id="cont_saida_atual" value="<?php echo($cont_saida_atual); ?>" class="form-control" placeholder="">
												</div>
											</div>

											<div class="row justify-content-md-center" style='margin-top:10px'>
												<div class="col-6">
													<?php $file_img_saida = (isset($rs["imagem_cont_saida"]) ? $rs["imagem_cont_saida"] : ""); ?>
													<div class="form-group row">
														<div class="col-md-12 text-center">
															<input type="hidden" name="file_img_saida_old" id="file_img_saida_old" value="<?php echo($file_img_saida); ?>" />

															<div class="wrapper-image-preview text-center">
																<div class="box" style="margin: 0 auto;">
																	<?php
																		$label_upload = "Foto do contador de saída atual";
																		$placeholder = base_url("assets/dist/img/placeholder-image.jpg");
																		$image_path = $this->config->item('folder_images') .'/operacao/'. $file_img_saida;
																		if( file_exists($image_path) and is_file($image_path) ){ $placeholder = base_url($image_path); }
																	?>
																	<div class="js--image-preview" style="background-image: url(<?php echo($placeholder); ?>); background-color: #F5F5F5;"></div>
																	<div class="upload-options">
																		<label for="file_img_saida" class="btn btn-white-sp"> <i class="mdi mdi-camera"></i> <?php echo $label_upload; ?> </label>
																		<input type="file" style="visibility:hidden;" class="image-upload" name="file_img_saida" id="file_img_saida" accept="image/*">
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											
										</div>
									</div>

								</div>
							</div>

                            <div class="card card-primary" style='margin-top:20px'>
                                
								<div class="card-header">
                                    <h3 class="card-title">Anotações gerais</h3>
                                </div>
                                
                                <div class="card-body">
									<div class="row">
										<div class="col-md-12">
											
											<div class="form-group">
												<?php $observacoes_equip = (isset($rs["observacoes_equip"]) ? $rs["observacoes_equip"] : ""); ?>
												<label for="observacoes_equip" class="col-md-12 control-label">Observações do dia</label>
												<div class="col-md-12">
													<textarea class="form-control" name="observacoes_equip" id="observacoes_equip" rows="3" placeholder="Escrever..."><?php echo($observacoes_equip); ?></textarea>
												</div>
											</div>
										</div>
									</div>

                                </div><!-- /.card-body -->

                            </div><!-- /.card -->

                        </div><!-- /.fica dentro do body azul -->

                        <div class="card-footer">
							<input type="submit" name="submit" value="Gravar Operação" class="btn btn-primary pull-right">
                            <!-- <button type="submit" class="btn btn-primary">Gravar Operação</button> -->
                        </div>

					<?php echo form_close(); ?>
                </div>
            </div>
            <!-- /.box-body -->

        </div>

    </section> 

</div>

<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/iCheck/all.css">
<script src="<?= base_url() ?>assets/plugins/iCheck/icheck.min.js"></script>
<script>
    $(function () {
		$.ajaxSetup({cache: false});
                
                
                  $('.select_operar').select2();

        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green'
        });

		$(document).on('change', '#pontodevenda', function (e) {
			var $this = $(this);
			var $url = '<?=base_url("admin/operar/json/TIPO-DE-MAQUINAS-E-SERIAL")?>'
			var $formData = { 
				'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
				pontodevenda: $("#pontodevenda").val(),
			};
			$.ajax({
				url: $url,
				type: 'POST',
				data: $formData,
				beforeSend: function(response)	{ },
				complete: function(response)	{ },
				success: function(response){ 
					//console.log( response );
					$('#result_tipodemaquina').html(response); 
				}
			});

			e.preventDefault();
		});

		$(document).on('change', '#maq_id', function (e) {
			var $this = $(this);
			//console.log( $this.val() );

			var $url = '<?=base_url("admin/operar/json/CONTAGEM-ATUAL")?>'
			var $formData = { 
				'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
				pontodevenda: $("#pontodevenda").val(),
				maq_id: $this.val()
			};
			//console.log( $formData );
			$.ajax({
				url: $url,
				type: 'POST',
				data: $formData,
				beforeSend: function(response)	{ },
				complete: function(response)	{ },
				success: function(response){ 
					//console.log( response );
					var json = JSON.parse(response);
					//console.log( 'inicial: '+ parseInt( json.contador_inicial) );
					//console.log( 'anterior: '+  parseInt( json.contador_anterior) );
					//console.log( 'atual: '+  parseInt( json.contador_atual) );

					$('#cont_anterior').val( parseInt( json.contador_atual) ); 
					$('#cont_atual').val( '0' ); 

					$('#cont_saida_anterior').val( parseInt( json.contador_saida_atual) ); 
					$('#cont_saida_atual').val( '0' ); 
				}
			});

			e.preventDefault();
		});

    })
</script>
