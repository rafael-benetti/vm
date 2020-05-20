<div class="datalist">
    <table id="example1" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th width="50">ID</th>
                <th>Usuário</th>
                <th>Nome</th>
                <th>E-mail</th>
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
                        <a href="<?= base_url("admin/admin/delete/" . $row['id']); ?>" onclick="return confirm('are you sure to delete?')" class="btn btn-danger btn-xs"><i class="fa fa-remove"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

