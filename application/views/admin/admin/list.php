<div class="datalist">
    <table id="example1" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th width="50">ID</th>
                <th>Usuário</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Estoque</th>
                <th>Permissão</th>
                <th width="100">Status</th>
                <th width="120">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($info as $row): ?>
            <tr>
                <td>
                    <?= $row['id'] ?>


                </td>
                <td>
                    <h4 class="m0 mb5"><?= $row['firstname'] ?> <?= $row['lastname'] ?></h4>
                    <small class="text-muted"><?= $row['admin_role_title'] ?></small>
                </td>
                <td>
                    <?= $row['username'] ?>
                </td> 
                <td>
                    <?= $row['email'] ?>
                </td>
                <td>

                    <a href="#"  data-toggle="modal" data-target="#exampleModal" class="btn btn-success"><i class="fa fa-plus"></i> Adicionar Insumo</a>


                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <?php $this->load->view('admin/includes/_messages.php') ?>

                            <?php echo form_open(base_url('admin/admin/add_log'), 'class="form-horizontal" '); ?> 

                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Adicionar Quantidade</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <?php "<br />"; ?>


                                    <div class="card card-primary">

                                        <div class="card-body">

                                            <div class="input-group">

                                                <label for="lastname" class="col-md-12 control-label">Insumo</label>


                                                <select name="item_id" style="width:100%" class="js-example-basic-single"id="item" >
                                                    <?php
                                                    foreach($itens as $item){


                                                    echo '<option value="'.$item['id'].'">'.$item['item'].'</option>';
                                                    }
                                                    ?>
                                                </select>

                                            </div>
                                            <div class="input-group">
                                                <label for="lastname" class="col-md-12 control-label">Tipo de operação</label>


                                                <select name="tipo_operacao" style="width:100%" class="js-example-basic-single"id="item" >

                                                    <option value="entrada">Entrada</option>
                                                    <option value="saida">Saída</option>

                                                </select>
                                            </div>


                                            <div class="input-group">
                                                <label for="lastname" class="col-md-12 control-label">Quantidade</label>

                                                <input type="hidden" name="user_id" class="form-control" id="item" value="<?php echo $row['id']; ?>" >
                                                <input type="number" name="qtde" class="form-control" id="qtde" placeholder="Quantidade">
                                            </div>
                                        </div>
                                    </div>



                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                        <input type="submit" name="submit" value="Salvar" class="btn btn-primary pull-right">

                                    </div>
                                </div>

                            </div>

                            <?php echo form_close(); ?>
                        </div>
                    </div>





                    <?php
                    $itens = $this->item_model->get_itens_by_user($row['id']);

                    $qtde_estoque = 0;

                    foreach ($itens as $item) {

                    $qtde_estoque = $this->item_model->get_total_estoque_machines($row['id'], $item['item_id']);

                    echo '<a title="View" class="view btn btn-sm btn-info" href="' . base_url('admin/admin/view_estoque/' . $row['id'] . '/' . $item['item_id']) . '"> <i class="fa fa-list"></i> ' . $item['item'] . ' (' . $qtde_estoque . ') </a>';
                    }
                    ?>
                </td>
                <td>
                    <button class="btn btn-xs btn-success"><?= $row['admin_role_title'] ?></button>
                </td> 
                <td><input class='tgl tgl-ios tgl_checkbox' 
                           data-id="<?= $row['id'] ?>" 
                           id='cb_<?= $row['id'] ?>' 
                           type='checkbox' <?php echo ($row['is_active'] == 1) ? "checked" : ""; ?> />
                    <label class='tgl-btn' for='cb_<?= $row['id'] ?>'></label>
                </td>
                <td>
                    <a href="<?= base_url("admin/admin/edit/" . $row['id']); ?>" class="btn btn-warning btn-xs mr5" >
                        <i class="fa fa-edit"></i>
                    </a>
                    <a href="<?= base_url("admin/admin/view/" . $row['id']); ?>" class="btn btn-warning btn-xs mr5" >
                        <i class="fa fa-eye"></i>
                    </a>
                    <a href="<?= base_url("admin/admin/delete/" . $row['id']); ?>" onclick="return confirm('Deseja realmente apagar?')" class="btn btn-danger btn-xs"><i class="fa fa-remove"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

