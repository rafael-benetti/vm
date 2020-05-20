<?php
$cur_tab = $this->uri->segment(2) == '' ? 'dashboard' : $this->uri->segment(2);
?>  

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url('admin'); ?>" class="brand-link">
        <img src="<?= base_url($this->general_settings['favicon']); ?>" alt="Logo" class="brand-image ">
        <span class="font-weight-normal" style="font-size: 26px; color:#ffffff; "><?= $this->general_settings['application_name']; ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">

            <div class="image">

                <img src="<?= base_url() ?>assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">

            </div>

            <div class="info">

                <a href="#" class="d-block"><?= ucwords($this->session->userdata('username')); ?></a>

            </div>

        </div>


        <!-- Sidebar Menu -->
        <nav class="mt-2">

            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <!-- Add icons to the links using the .nav-icon class
              with font-awesome or any other icon font library -->
                <?php if ($this->rbac->check_module_permission('admin')): ?> 
                    <li id="dashboard" class="nav-item has-treeview">

                        <a href="<?= base_url('admin/dashboard'); ?>" class="nav-link">

                            <i class="nav-icon fa fa-dashboard"></i>

                            <p>
                                Dashboard
                            </p>

                        </a>

                    </li>
                <?php endif; ?> 

                <?php if ($this->rbac->check_module_permission('admin')): ?> 

                    <li id="admin" class="nav-item has-treeview">

                        <a href="#" class="nav-link">

                            <i class="nav-icon fa fa-user"></i>

                            <p>

                                Cadastro de Admin

                                <i class="right fa fa-angle-left"></i>

                            </p>

                        </a>

                        <ul class="nav nav-treeview">
                            <li class="nav-item">

                                <a href="<?= base_url('admin/admin'); ?>" class="nav-link">

                                    <i class="fa fa-circle-o nav-icon"></i>

                                    <p>Listar Admin</p>

                                </a>

                            </li>
                            <li class="nav-item">

                                <a href="<?= base_url('admin/admin/add'); ?>" class="nav-link">

                                    <i class="fa fa-circle-o nav-icon"></i>

                                    <p>Add Admin</p>

                                </a>

                            </li>




                            <li class="nav-item">

                                <a href="<?= base_url('admin/profile'); ?>" class="nav-link">

                                    <i class="fa fa-circle-o nav-icon"></i>

                                    <p>Perfil Super Admin</p>

                                </a>

                            </li>

                        </ul>

                    </li>

                <?php endif; ?> 

                <?php if ($this->rbac->check_module_permission('users')): ?>

                    <li id="usuarios" class="nav-item has-treeview">

                        <a href="#" class="nav-link">

                            <i class="nav-icon fa fa-users"></i>

                            <p>

                                Operadores

                                <i class="right fa fa-angle-left"></i>

                            </p>

                        </a>

                        <ul class="nav nav-treeview">



                            <li class="nav-item">

                                <a href="<?= base_url('admin/users'); ?>" class="nav-link">

                                    <i class="fa fa-circle-o nav-icon"></i>

                                    <p>Listar Operador</p>

                                </a>

                            </li>
                            
                            <li class="nav-item">

                                <a href="<?= base_url('admin/admin/add/2'); ?>" class="nav-link">

                                    <i class="fa fa-circle-o nav-icon"></i>

                                    <p>Add Operador</p>

                                </a>

                            </li>

                        </ul>

                    </li>

                <?php endif; ?>

                <?php if ($this->rbac->check_module_permission('ponto')): ?>

                    <li id="pontos" class="nav-item has-treeview">

                        <a href="#" class="nav-link">

                            <i class="nav-icon fa fa-edit"></i>

                            <p>

                                Pontos de Venda

                                <i class="right fa fa-angle-left"></i>

                            </p>

                        </a>

                        <ul class="nav nav-treeview">

                            <li class="nav-item">

                                <a href="<?= base_url('admin/pontos'); ?>" class="nav-link">

                                    <i class="fa fa-circle-o nav-icon"></i>

                                    <p>Listar Pontos</p>

                                </a>

                            </li>

                            <li class="nav-item">

                                <a href="<?= base_url('admin/pontos/add'); ?>" class="nav-link">

                                    <i class="fa fa-circle-o nav-icon"></i>

                                    <p>Add Pontos</p>

                                </a>

                            </li>

                        </ul>

                    </li><?php endif; ?>
                <?php if ($this->rbac->check_module_permission('users')): ?>
                    <li id="operacoes" class="nav-item has-treeview">

                        <a href="<?= base_url('admin/rotas'); ?>" class="nav-link">

                            <i class="nav-icon fa fa-bars"></i>

                            <p>
                                Rotas
                            </p>

                        </a>

                    </li>
                <?php endif; ?>
                <?php if (verifica_permissao('itens', 'view')): ?>

                    <li id="estoque" class="nav-item has-treeview">

                        <a href="#" class="nav-link">

                            <i class="nav-icon fa fa-pie-chart"></i>

                            <p>

                                Estoque

                                <i class="right fa fa-angle-left"></i>

                            </p>

                        </a>

                        <ul class="nav nav-treeview">

                            <li class="nav-item">

                                <a href="<?= base_url('admin/itens'); ?>" class="nav-link">

                                    <i class="fa fa-circle-o nav-icon"></i>

                                    <p>Listar Estoque</p>

                                </a>

                            </li>

                               <?php if (verifica_permissao('itens', 'add')): ?>
                            <li class="nav-item">

                                <a href="<?= base_url('admin/itens/add_item'); ?>" class="nav-link">

                                    <i class="fa fa-circle-o nav-icon"></i>

                                    <p>Add Itens</p>

                                </a>

                            </li>
                                <?php endif; ?>

                        </ul>

                    </li>

                <?php endif; ?>
                <?php if ($this->rbac->check_module_permission('users')): ?>

                    <li id="tipos" class="nav-item has-treeview">

                        <a href="#" class="nav-link">

                            <i class="nav-icon fa fa-cog"></i>

                            <p>

                                Tipos de Máquinas

                                <i class="right fa fa-angle-left"></i>

                            </p>

                        </a>

                        <ul class="nav nav-treeview">
                            <li class="nav-item">

                                <a href="<?= base_url('admin/tipos'); ?>" class="nav-link">

                                    <i class="fa fa-circle-o nav-icon"></i>

                                    <p>Listar Tipo de máquinas</p>

                                </a>

                            </li>
                            <li class="nav-item">

                                <a href="<?= base_url('admin/tipos/add'); ?>" class="nav-link">

                                    <i class="fa fa-circle-o nav-icon"></i>

                                    <p>Add Tipo de máquina</p>

                                </a>

                            </li>



                        </ul>

                    </li>

                <?php endif; ?>

                <?php if (verifica_permissao('machines','view')): ?>

                    <li id="machines" class="nav-item has-treeview">

                        <a href="#" class="nav-link">

                            <i class="nav-icon fa fa-cog"></i>

                            <p>

                                Minhas Máquinas

                                <i class="right fa fa-angle-left"></i>

                            </p>

                        </a>

                        <ul class="nav nav-treeview">
                            <li class="nav-item">

                                <a href="<?= base_url('admin/machines'); ?>" class="nav-link">

                                    <i class="fa fa-circle-o nav-icon"></i>

                                    <p>Listar Máquinas</p>

                                </a>

                            </li>

                              <?php if (verifica_permissao('machines','add')): ?>
                            <li class="nav-item">

                                <a href="<?= base_url('admin/machines/add'); ?>" class="nav-link">

                                    <i class="fa fa-circle-o nav-icon"></i>

                                    <p>Add Máquinas</p>

                                </a>

                            </li>
                               <?php endif; ?>

                        </ul>

                    </li>

                <?php endif; ?>




                <li id="operacoes" class="nav-item has-treeview">

                    <a href="<?= base_url('admin/operar/operar_list'); ?>" class="nav-link">

                        <i class="nav-icon fa fa-bars"></i>

                        <p>
                            Operações
                        </p>

                    </a>

                </li>
                <?php if ($this->rbac->check_module_permission('admin_roles')): ?>

                    <li id="relatorios" class="nav-item has-treeview">

                        <a href="#" class="nav-link">

                            <i class="nav-icon fa fa-file"></i>

                            <p>

                                Relatórios

                                <i class="right fa fa-angle-left"></i>

                            </p>

                        </a>

                        <ul class="nav nav-treeview">
                            <li class="nav-item">

                                <a href="<?= base_url('admin/relatorios/fat_diario'); ?>" class="nav-link">

                                    <i class="fa fa-dollar nav-icon"></i>

                                    <p>Faturamentos</p>

                                </a>

                            </li>
                            <!--
                            <li class="nav-item">

                                <a href="<?= base_url('admin/relatorios/fat_semanal'); ?>" class="nav-link">

                                    <i class="fa fa-dollar nav-icon"></i>

                                    <p>Faturamento Semanal</p>

                                </a>

                            </li>
                            <li class="nav-item">

                                <a href="<?= base_url('admin/relatorios/fat_mensal'); ?>" class="nav-link">

                                    <i class="fa fa-dollar nav-icon"></i>

                                    <p>Faturamento Mensal</p>

                                </a>

                            </li>

                            <li class="nav-item">

                                <a href="<?= base_url('admin/relatorios/fat_equipamento'); ?>" class="nav-link">

                                    <i class="fa fa-dollar nav-icon"></i>

                                    <p>Faturamento Equipamento</p>

                                </a>

                            </li>

                            <li class="nav-item">

                                <a href="<?= base_url('admin/relatorios/fat_ponto'); ?>" class="nav-link">

                                    <i class="fa fa-dollar nav-icon"></i>

                                    <p>Faturamento Ponto de Venda</p>

                                </a>

                            </li>

                            <li class="nav-item">

                                <a href="<?= base_url('admin/relatorios/fat_rotas'); ?>" class="nav-link">

                                    <i class="fa fa-dollar nav-icon"></i>

                                    <p>Faturamento Rotas</p>

                                </a>

                            </li>
                            -->


                        </ul>

                    </li>


                <?php endif; ?>

                <?php if ($this->rbac->check_module_permission('tarefas_settings')): ?> 

                    <li id="tarefas_settings" class="nav-item">

                        <a href="<?= base_url('admin/calendar'); ?>" class="nav-link">

                            <i class="nav-icon fa fa-calendar"></i>

                            <p>

                                Tarefas

                            </p>

                        </a>

                    </li>

                <?php endif; ?>
                <?php if ($this->rbac->check_module_permission('admin_roles')): ?> 

                    <li id="admin_roles" class="nav-item has-treeview">

                        <a href="#" class="nav-link">

                            <i class="nav-icon fa fa-eye"></i>

                            <p>

                                Permissões

                                <i class="right fa fa-angle-left"></i>

                            </p>

                        </a>

                        <ul class="nav nav-treeview">

                            <li class="nav-item">

                                <a href="<?= base_url('admin/admin_roles/module'); ?>" class="nav-link">

                                    <i class="fa fa-circle-o nav-icon"></i>

                                    <p>Add Permissões</p>

                                </a>

                            </li>

                            <li class="nav-item">

                                <a href="<?= base_url('admin/admin_roles'); ?>" class="nav-link">

                                    <i class="fa fa-circle-o nav-icon"></i>

                                    <p>Tipo de Permissão</p>

                                </a>

                            </li>

                        </ul>

                    </li>

                <?php endif; ?>

                <?php if ($this->rbac->check_module_permission('general_settings')): ?> 

                    <li id="export" class="nav-item has-treeview">

                        <a href="#" class="nav-link">

                            <i class="nav-icon fa fa-database"></i>

                            <p>

                                Backup & Export

                                <i class="right fa fa-angle-left"></i>

                            </p>

                        </a>

                        <ul class="nav nav-treeview">

                            <li class="nav-item">

                                <a href="<?= base_url('admin/export'); ?>" class="nav-link">

                                    <i class="fa fa-circle-o nav-icon"></i>

                                    <p>Backup Banco</p>

                                </a>

                            </li>

                        </ul>

                    </li>

                <?php endif; ?>

                <?php if ($this->rbac->check_module_permission('general_settings')): ?> 

                    <li id="general_settings" class="nav-item">

                        <a href="<?= base_url('admin/general_settings'); ?>" class="nav-link">

                            <i class="nav-icon fa fa-cogs"></i>

                            <p>

                                Config Sistem

                            </p>

                        </a>

                    </li>

                <?php endif; ?></ul>
    </div>


</aside>


<script>
    $("#<?= $cur_tab ?>").addClass('menu-open');

    $("#<?= $cur_tab ?> > a").addClass('active');
</script>



