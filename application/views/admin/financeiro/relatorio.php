<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content">
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"> <i class="fa fa-plus"></i>
                            Relatório Financeiro </h3>
                        <div class="d-inline-block float-right">
                            <a href="<?= base_url('admin/financeiro/receita'); ?>" class="btn btn-success"><i class="fa fa-list"></i>  Receita</a>
                            <a href="<?= base_url('admin/financeiro/despesa'); ?>" class="btn btn-success"><i class="fa fa-list"></i>  Despesa</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        

                        <table id="nadatatable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Data</th>
                                    <th>Nome</th>
                                    <th>Categoria</th>
                                    <th>Nota</th>
                                    <th>Valor</th>
                                    <th>Tipo</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                
                    <?php foreach($financeiro -> result() as $fin): ?>            
                <tr>
                 <td><?php echo $fin->data?></td>
                 <td><?php echo $fin->nome?></td>
                 <td><?php echo $fin->categoria?></td>
                 <td><?php echo $fin->nota?></td>
                 <td><?php echo $fin->valor?></td>
                 <td><?php echo $fin->tipo_entrada?></td>
                </tr>
                        <?php endforeach; ?>
                
                           </tbody>
                
                <tfoot>
                <tr>
                <th></th>
                <th></th>
                <th></th>
                <th>Total</th>
                <th>R$</th>
                <th></th>
                </tr>
                </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>











<!-- DataTables -->
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.js"></script>

<script>
    $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
    });
</script>