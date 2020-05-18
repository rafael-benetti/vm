<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
    <head>
        <link rel='icon' href='<?= base_url() ?>/assets/img/favicon.png' type='image/x-icon' />
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?= isset($title) ? $title . ' - ' : 'Title -' ?> <?= $this->general_settings['application_name']; ?></title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/font-awesome/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?= base_url() ?>assets/dist/css/adminlte.css">
        <!-- Custom style -->
        <link rel="stylesheet" href="<?= base_url() ?>assets/dist/css/custom.css">
        <!-- iCheck -->
        <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/iCheck/flat/blue.css">
        <!-- Morris chart -->
        <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/morris/morris.css">
        <!-- jvectormap -->
        <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
        <!-- Date Picker -->
        <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datepicker/datepicker3.css">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/daterangepicker/daterangepicker-bs3.css">
        <!-- bootstrap wysihtml5 - text editor -->
        <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
        <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/select2/select2.min.css"> 
        <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.css"> 
        <!-- jQuery -->
        <script src="<?= base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
        <!-- DataTables -->

        <script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>

        <script src="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.js"></script>
        <script src="<?= base_url() ?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>
        <script src="<?= base_url() ?>assets/plugins/input-mask/jquery.inputmask.js"></script>
        <script src="<?= base_url() ?>assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
        <script src="<?= base_url() ?>assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>

        <script src="<?= base_url() ?>assets/plugins/jquery.mask.js"></script>
        <script src="<?= base_url() ?>assets/plugins/select2/select2.min.js"></script>
        <script src="<?= base_url() ?>assets/js/jquery.validate.min.js"></script>
        <script>
            jQuery.extend(jQuery.validator.messages, {
                required: "Este campo &eacute; obrigatório.",
                remote: "Por favor, corrija este campo.",
                email: "Por favor, forne&ccedil;a um endere&ccedil;o eletr&ocirc;nico v&aacute;lido.",
                url: "Por favor, forne&ccedil;a uma URL v&aacute;lida.",
                date: "Por favor, forne&ccedil;a uma data v&aacute;lida.",
                dateISO: "Por favor, forne&ccedil;a uma data v&aacute;lida (ISO).",
                number: "Por favor, forne&ccedil;a um n&uacute;mero v&aacute;lido.",
                digits: "Por favor, forne&ccedil;a somente d&iacute;gitos.",
                creditcard: "Por favor, forne&ccedil;a um cart&atilde;o de cr&eacute;dito v&aacute;lido.",
                equalTo: "Por favor, forne&ccedil;a o mesmo valor novamente.",
                accept: "Por favor, forne&ccedil;a um valor com uma extens&atilde;o v&aacute;lida.",
                maxlength: jQuery.validator.format("Por favor, forne&ccedil;a n&atilde;o mais que {0} caracteres."),
                minlength: jQuery.validator.format("Por favor, forne&ccedil;a ao menos {0} caracteres."),
                rangelength: jQuery.validator.format("Por favor, forne&ccedil;a um valor entre {0} e {1} caracteres de comprimento."),
                range: jQuery.validator.format("Por favor, forne&ccedil;a um valor entre {0} e {1}."),
                max: jQuery.validator.format("Por favor, forne&ccedil;a um valor menor ou igual a {0}."),
                min: jQuery.validator.format("Por favor, forne&ccedil;a um valor maior ou igual a {0}.")
            });


            $(function () {

                $('.select_operar').select2();
            });

        </script>

    </head>

    <body class="hold-transition sidebar-mini">

        <!-- Main Wrapper Start -->
        <div class="wrapper">

            <!-- Navbar -->

            <?php if (!isset($navbar)): ?>

                <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
                    <!-- Left navbar links -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
                        </li>
                        <li class="nav-item d-none d-sm-inline-block">
                            <a href="<?= base_url('admin') ?>" class="nav-link">Home</a>
                        </li>
                        <li class="nav-item d-none d-sm-inline-block">
                            <a href="<?= base_url('admin/pages/contato') ?>" class="nav-link">Contato</a>
                        </li>
                        <li class="nav-item d-none d-sm-inline-block">
                            <a href="<?= base_url('admin/auth/logout') ?>" class="nav-link">Logout</a>
                        </li>
                    </ul>

                    <!-- SEARCH FORM 
                    <form class="form-inline ml-3">
                      <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Pesquisar" aria-label="Search">
                        <div class="input-group-append">
                          <button class="btn btn-navbar" type="submit">
                            <i class="fa fa-search"></i>
                          </button>
                        </div>
                      </div>
                    </form>s
                
                    <!-- Right navbar links -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link" data-toggle="dropdown" href="#">
                                <i class="fa fa-bell-o"></i>
                                <span class="badge badge-warning navbar-badge">1</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                <span class="dropdown-item dropdown-header">Novas notificações</span>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item">
                                    <i class="fa fa-users mr-2"></i> Você tem 8 novos clientes
                                    <span class="float-right text-muted text-sm">últimas 24 horas</span>
                                </a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link"  href="<?= base_url('admin/auth/logout') ?>">
                                <i class="fa fa-sign-out"></i>
                            </a>

                        </li>
                    </ul>
                </nav>

            <?php endif; ?>

            <!-- /.navbar -->


            <!-- Sideabr -->

            <?php if (!isset($sidebar)): ?>

                <?php $this->load->view('admin/includes/_sidebar'); ?>

            <?php endif; ?>

            <!-- / .Sideabr -->
