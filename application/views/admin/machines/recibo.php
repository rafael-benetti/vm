<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="card card-default">
            <div class="card-header">
                <div class="d-inline-block">
                    <h3 class="card-title"> <i class="fa fa-plus"></i>
                        <a href="<?= base_url('admin') ?>" class="card-title">Painel</a> </h3>
                </div>
                <div class="d-inline-block float-right">

                    <div class="btn-group margin-bottom-20"> 
                        <a href="<?= base_url('admin/machines/'); ?>" class="btn btn-success"><i class="fa fa-list"></i> Listar máquinas</a>


                    </div>
                </div>
            </div>






            <div class="card-body">





                <!-- For Messages -->

                <?php $this->load->view('admin/includes/_messages.php') ?>


                <div class="card card-primary" id='DivIdToPrint' >

                    <div class="container">
                        <div class="row d-flex justify-content-center">
                            <div class="well col-xs-10 col-sm-10 col-md-6 col-xs-offset-1 col-sm-offset-1 col-md-offset-3">
                                <div class="text-center">
                                    <h1>Recibo</h1>
                                    <h1>Recibi de <?php echo $proprietario['proprietario']; ?></h1>
                                </div>
                                <div class="row">

                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <address>
                                            <strong>Operador</strong>
                                            <br>
                                            <?php echo $user->firstname . ' ' . $user->lastname; ?>
                                            <br>
                                            <?php echo $user->email; ?>
                                            <abbr title="Phone">Contato:</abbr>  <?php echo $user->mobile_no; ?>
                                        </address>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                                        <p>
                                            <em>Data: <?php echo date('d/m/Y H:i'); ?></em>
                                        </p>
                                        <p>
                                            <em>Canhoto #: <?php echo $user->user_id . $machine['id_maquina'] . $user->id_user_machine; ?></em>
                                        </p>
                                        <p>

                                            _______________________<br>
                                            <em>Assinatura</em>
                                        </p>
                                    </div>
                                </div>
                                <div class="row">


                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Tipo</th>
                                                <th>Serial</th>
                                                <th class="text-center">Valor</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="col-md-5"><em><?php echo $machine['nome_tipo']; ?> </em></td>
                                                <td class="col-md-5"><em><?php echo $machine['serial']; ?></em></td>
                                                <td class="col-md-2" style="text-align: center"><?php echo formatar_moeda($machine['valorvenda']); ?></td>

                                            </tr>

                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <button onclick='printDiv();' type="button" class="btn btn-success btn-lg btn-block">
                    Imprimir   <span class="glyphicon glyphicon-chevron-right"></span>
                </button>



            </div>

            <!-- /.box-body -->

        </div>

    </section> 

</div>

<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/iCheck/all.css">
<script src="<?= base_url() ?>assets/plugins/iCheck/icheck.min.js"></script>
<script>

                    function printDiv()
                    {

                        var divToPrint = document.getElementById('DivIdToPrint');

                        var newWin = window.open('', 'Print-Window');

                        newWin.document.open();

                        newWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</body></html>');

                        newWin.document.close();

                        setTimeout(function () {
                            newWin.close();
                        }, 10);

                    }

                    $(function () {


                        $('.js-example-basic-single').select2();

                        //Flat red color scheme for iCheck
                        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                            checkboxClass: 'icheckbox_flat-green',
                            radioClass: 'iradio_flat-green'
                        })

                    })

                    //iCheck for checkbox and radio inputs
                    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                        checkboxClass: 'icheckbox_minimal-blue',
                        radioClass: 'iradio_minimal-blue'
                    })
</script>


<script src="assets/plugins/jquery/jquery.min.js" type="text/javascript"></script>
<script src="assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js" type="text/javascript"></script>
<script type="text/javascript">
                    $(document).ready(function () {
                        bsCustomFileInput.init();
                    });
</script>
