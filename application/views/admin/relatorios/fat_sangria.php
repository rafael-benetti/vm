<style>
    .card-header > .card-tools {
        position: relative;
        right: 0;
        padding: 25px;
        top: .5rem;
    }
    .input-group {
        position: relative;
        display: flex;
        flex-wrap: wrap;
        align-items: stretch;
        width: 100%;
    }
</style>



<!-- DataTables -->

<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">

    <section class="content">

        <!-- For Messages -->

        <?php $this->load->view('admin/includes/_messages.php') ?>

        <div class="card">

            <div class="card-header">

                <div class="d-inline-block">

                    <h3 class="card-title"><i class="fa fa-list"></i>&nbsp; Faturamento</h3>

                </div>

            </div>

        </div>
        <form id="form_relatorio" action="<?php echo base_url('admin/relatorios/fat_sangria'); ?>" method="get" >
            <div class="card">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <!-- <h3 class="card-title">Filtros</h3> -->

                                <div class="card-tools">

                                    <div class="row" style="margin-bottom: 30px;"> 
                                         <div class="col-lg-3 col-sm-6  col-md-6">

                                             <div class="input-group input-group-sm" >
                                            <label for="maq_id" class="col-md-6 control-label">Data Inicial</label>
                                           
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                               

                                                <?php
                                                $data_inicial = (isset($data_inicial) ? $data_inicial : "");
                                                ?>
                                                <input type="text" value="<?php echo $data_inicial; ?>" class="date2" id="data_inicial" name="data_inicial" class="form-control" > 
                                            <!--      <input type="text" name="data_inicial" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask> -->
                                            </div>
                                        </div>
                                             </div>
                                        <div class="col-lg-3 col-sm-6  col-md-6">

                                            <div class="input-group input-group-sm" >
                                                 <label for="maq_id" class="col-md-6 control-label">Data Final</label>
                                           
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                <?php
                                                $data_final = (isset($data_final) ? $data_final : "");
                                                ?>
                                                <input type="text" value="<?php echo $data_final; ?>" id="data_final" class="date2" name="data_final"  class="form-control"  >
                                            </div>
                                            </div>


                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-sm-12  col-md-12">
                                            <label for="pontodevenda" class="col-md-12 control-label">Ponto de venda</label>
                                            <div class="input-group">
                                                <select style="width:100%;" onchange="this.form.submit();" name="pontodevenda" class="select2" id="pontodevenda" >
                                                    <option value="">- Todos pontos -</option>
                                                    <?php
                                                    $pontodevenda = (int) (isset($pontodevenda) ? $pontodevenda : "");
                                                    foreach ($pontos as $ponto) {
                                                        $selected = (($pontodevenda == $ponto->id) ? " selected " : "");

                                                        echo '<option value="' . $ponto->id . '" ' . $selected . '>' . $ponto->ponto . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-sm-12  col-md-12">
                                            <div class="input-group input-group-sm" >
                                                <label for="maq_id" class="col-md-12 control-label">Tipo de Máquina</label>
                                                <div class="input-group" id="result_tipodemaquina">
                                                    <select style="width:100%;" onchange="this.form.submit();"  name="maq_id" class="select2" id="maq_id" >
                                                        <option value="">- Todas máquinas -</option>
                                                        <?php
                                                        if (count($tipos) > 0) {
                                                            $maq_id = (int) (isset($maq_id) ? $maq_id : "");
                                                            foreach ($tipos as $tipo) {
                                                                $selected = (($maq_id == $tipo["id"]) ? " selected " : "");
                                                                echo '<option value="' . $tipo["id"] . '" ' . $selected . '>' . $tipo["tipo"] . ' | ' . $tipo["serial"] . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-sm-12  col-md-12">
                                            <div class="input-group input-group-sm" >
                                                <label for="user_id" class="col-md-12 control-label">Operador</label>
                                                <div class="input-group" id="result_user_id">
                                                    <select style="width:100%;" onchange="this.form.submit();"  name="user_id" class="select2" id="user_id" >
                                                        <option value="">- Todos Operadores -</option>
                                                        <?php
                                                        if (count($operadores) > 0) {
                                                            $user_id = (int) (isset($user_id) ? $user_id : "");
                                                            foreach ($operadores as $operador) {
                                                                $selected = (($user_id == $operador["id"]) ? " selected " : "");
                                                                echo '<option value="' . $operador["id"] . '" ' . $selected . '>' . $operador["firstname"] . '  ' . $operador["lastname"] . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                       
                                    </div>


                                </div>
                            </div>
                        </div>

                        <div class="card-body table-responsive">

                            <table id="na_datatable" class="table table-bordered table-striped" width="100%">
                                      <!-- <th>Data</th> -->
                                      <!-- <th>Ponto de Venda</th> -->
                                      <!-- <th>Máquina</th> -->
                                      <!-- <th>Contador atual</th> -->
                                      <!-- <th>Vendas</th> -->
                                      <!-- <th>Saldo</th> -->
                                <thead>

                                    <tr>

                                        <th>Id</th>
                                        <th>Data</th>
                                        <th>Operador</th>
                                        <th>Ponto</th>
                                        <th>Máquina</th>
                                        <th>Sangria</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    
                                    $total_vendas = 0;
                                    foreach ($relatorios as $relatorio) {
                                        $ponto = $this->ponto_model->get_ponto($relatorio->ponto_id);
                                        $maquina = $this->machine_model->get_machine_by_id($relatorio->maq_id);
                                        $total_vendas += $relatorio->sangria;
                                        ?>
                                        <tr>

                                            <th><?php echo $relatorio->id_operacao; ?></th>
                                            <th><?php echo inverteDataHora($relatorio->data); ?></th>
                                            <th><?php echo $relatorio->firstname.' '.$relatorio->lastname; ?></th>
                                            <th><?php echo $ponto->ponto; ?></th>
                                            <th><?php echo $maquina['nome_tipo']; ?> - <?php echo $maquina['serial']; ?></th>
                                            <th><?php echo formatar_moeda($relatorio->sangria); ?></th>
                                        </tr>
                                        <?php
                                    }
                                    ?>

                                </tbody> 
                                <tfoot>
                                    <tr>
                                        <td colspan="6"><span style="float:right">Total Sangria:<b>  <?php echo formatar_moeda($total_vendas); ?></b></span></td>
                                    </tr>
                                </tfoot>

                            </table>

                            <!--Paginação inicio-->


                            <div class="card-footer clearfix">
                                <ul class='pagination'>
                                    <li class='page-item <?php echo $hab_anterior; ?>'>
                                        <a class="page-link" href='<?php echo $url_anterior; ?>'>
                                            &laquo;
                                        </a>
                                    </li>
                                    <?php foreach ($paginas as $pag) { ?>
                                        <li class='page-item <?php echo $pag['link']; ?>'>
                                            <a class="page-link" href='<?php echo $pag['url_link']; ?>'>
                                                <?php echo $pag['indice']; ?>
                                            </a>
                                        </li>
                                    <?php } ?>

                                    <li class="page-item <?php echo $hab_anterior; ?>"><a class="page-link" href="<?php echo @$url_proximo; ?>">&raquo;</a></li>
                                </ul>
                            </div>


                        </div>

                    </div>
                </div>
            </div>
            </div>
            </div>
        </form>

    </section>  

</div>

<script src="<?= base_url() ?>assets/plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?= base_url() ?>assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?= base_url() ?>assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<!-- date-range-picker -->
<script>
    
     $( function() {
    var dateFormat = "dd-mm-yy",
      from = $( "#data_inicial" )
        .datepicker({
   dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
   dayNamesMin: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab', 'Dom'],
   dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
   monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
   monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
   nextText: 'Proximo',
   prevText: 'Anterior',
  dateFormat:dateFormat,
          changeMonth: true,
          changeYear: true,
          numberOfMonths: 1
        })
        .on( "change", function() {
          to.datepicker( "option", "minDate", getDate( this ) );
    var data_inicial = $('#data_inicial').val();

        
        }),
      to = $( "#data_final" ).datepicker({
   dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
   dayNamesMin: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab', 'Dom'],
   dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
   monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
   monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
   nextText: 'Proximo',
   prevText: 'Anterior',

        changeMonth: true,
                  changeYear: true,

        dateFormat:dateFormat,
        numberOfMonths: 1
      })
      .on( "change", function() {
        from.datepicker( "option", "maxDate", getDate( this ) );
         var data_final = $('#data_final').val();
                                                                if (data_final.length == 10) {
                                                                    $('#form_relatorio').submit();
                                                                }
      });
 
    function getDate( element ) {
      var date;
      try {
        date = $.datepicker.parseDate( dateFormat, element.value );
      } catch( error ) {
        date = null;
      }
 
      return date;
    }
  } );
    
    
                                                        $(function () {

                                                            $('#data_inicial').keyup(function () {

                                                                var data_inicial = $('#data_inicial').val();

                                                                if (data_inicial.length == 10) {
                                                                    $('#data_final').focus();
                                                                }

                                                            });

                                                            $('#data_final').keyup(function () {

                                                                var data_final = $('#data_final').val();
                                                                if (data_final.length == 10) {
                                                                    $('#form_relatorio').submit();
                                                                }

                                                            });


                                                            //Initialize Select2 Elements
                                                            $('.select2').select2()

                                                            //Datemask dd/mm/yyyy
                                                            $('#datemask').inputmask('dd/mm/yyyy', {'placeholder': 'dd/mm/yyyy'})
                                                            //Datemask2 mm/dd/yyyy
                                                            $('#datemask2').inputmask('mm/dd/yyyy', {'placeholder': 'mm/dd/yyyy'})
                                                            //Money Euro
                                                            $('[data-mask]').inputmask()
                                                        })
</script>

