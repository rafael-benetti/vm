<!-- daterange picker -->
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/daterangepicker/daterangepicker-bs3.css">
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/iCheck/all.css">
<!-- Bootstrap Color Picker -->
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/colorpicker/bootstrap-colorpicker.min.css">
<!-- Bootstrap time Picker -->
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/timepicker/bootstrap-timepicker.min.css">
<!-- Select2 -->
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/select2/select2.min.css">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="card card-default">
            <div class="card-header">
                <div class="d-inline-block">
                    <h3 class="card-title"> <i class="fa fa-plus"></i>
                        Financeiro </h3>
                </div>
                <div class="d-inline-block float-right">
                    <a href="<?= base_url('admin/financeiro'); ?>" class="btn btn-success"><i class="fa fa-list"></i>  Relatório</a>
                </div>
            </div>
            <div class="card-body">

     <!-- DESPESA -->
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Inserir Despesa</h3>
                        </div>
                        <div class="card-body">
                            <?php $this->load->view('admin/includes/_messages.php') ?>

                <?php echo form_open(base_url('admin/financeiro/add_despesa'), 'class="form-horizontal"'); ?> 
                <?php "<br />"; ?>
                            <!-- Date range -->
                           <div class="form-group">
                                <div class="form-group">
                                    <label>Nome</label>
                                    <input type="text" name="nome" id="nome" class="form-control" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label>Nota</label>
                                    <textarea class="form-control" name="nota" id="nota" rows="3" placeholder=""></textarea>
                                </div>

                                <div class="form-group">
                                    <label>Data da despesa:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="data" id="data" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="valor" class="col-md-6 control-label">valor</label>
                                    <div class="col-md-12">

                                        <input type="number" name="valor" class="form-control" id="valor" pattern="[0-9]+([,\.][0-9]+)?" min="1" step="any">
                                    </div>
                                </div>
                                <div class="form-group">
                    <label>Categria</label>
                    <select class="form-control" name="categoria" id="categoria">
                      <option>agua</option>
                      <option>luz</option>
                    </select>
                  </div>
                                                        
                  <div class="form-group">
                <div class="col-md-12">
                        <input type="submit" name="submit" value="Gravar despesa" class="btn btn-primary pull-right">
                    </div></div>
                               
                           </div>
<?php echo form_close(); ?>
                        </div>

                    </div>

                </div>

       

        </div>
    </section>
</div>



<!-- Select2 -->
<script src="<?= base_url() ?>assets/plugins/select2/select2.full.min.js"></script>
<!-- InputMask -->
<script src="<?= base_url() ?>assets/plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?= base_url() ?>assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?= base_url() ?>assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="<?= base_url() ?>assets/plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="<?= base_url() ?>assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- Page script -->
<!-- iCheck 1.0.1 -->
<script src="<?= base_url() ?>assets/plugins/iCheck/icheck.min.js"></script>
<script>
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Datemask dd/mm/yyyy
        $('#datemask').inputmask('dd/mm/yyyy', {'placeholder': 'dd/mm/yyyy'})
        //Datemask2 mm/dd/yyyy
        $('#datemask2').inputmask('dd/mm/yyyy', {'placeholder': 'dd/mm/yyyy'})
        //Money Euro
        $('[data-mask]').inputmask()

        //Date range picker
        $('#reservation').daterangepicker()
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({
            timePicker: true,
            timePickerIncrement: 30,
            format: 'DD/MM/YYYY h:mm A'
        })
        //Date range as a button
        $('#daterange-btn').daterangepicker(
                {
                    ranges: {
                        'Today': [moment(), moment()],
                        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'This Month': [moment().startOf('month'), moment().endOf('month')],
                        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    },
                    startDate: moment().subtract(29, 'days'),
                    endDate: moment()
                },
                function (start, end) {
                    $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
                }
        )

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        })
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
            checkboxClass: 'icheckbox_minimal-red',
            radioClass: 'iradio_minimal-red'
        })
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green'
        })

        //Colorpicker
        $('.my-colorpicker1').colorpicker()
        //color picker with addon
        $('.my-colorpicker2').colorpicker()

        //Timepicker
        $('.timepicker').timepicker({
            showInputs: false
        })
    })
</script>

<script>
    $("#forms").addClass('active');
    $("#advanced").addClass('active');
</script>  
