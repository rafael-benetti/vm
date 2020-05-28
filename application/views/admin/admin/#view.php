<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Perfil</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="card">

        <div class="card-header">
            <div class="d-inline-block">
                <h5><i class="fa fa-info"></i> Detalhes sobre o admin </h5>
            </div>
            <div class="d-inline-block float-right">
                <?php if ($this->rbac->Check_operation_permission('add')): ?>
                    <a href="<?= base_url('admin/admin/'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Listar Admins</a>
                <?php endif; ?>
            </div>
        </div>

    </div>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class="row">

                <div class="col-lg-4 col-sm-12  col-md-12">
                    <h4>Detalhes</h4>
                    

                </div>
                <div class="col-lg-4 col-sm-12  col-md-12">
                      <h4>Máquinas</h4>

                </div>
                <div class="col-lg-4 col-sm-12  col-md-12">
                    <h4>Pontos</h4>

                </div>

            </div>
            <div class="row">

                <div class="col-lg-12 col-sm-12  col-md-12">
                    <h4>Operações</h4>

                </div>

            </div>
        </div>
    </section>
</div>
