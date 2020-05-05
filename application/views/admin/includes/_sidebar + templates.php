<?php 
$cur_tab = $this->uri->segment(2)==''?'dashboard': $this->uri->segment(2);  
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

        <img src="<?= base_url()?>assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">

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

        <li id="dashboard" class="nav-item has-treeview">

          <a href="<?= base_url('admin/dashboard'); ?>" class="nav-link">

            <i class="nav-icon fa fa-dashboard"></i>

            <p>

              Dashboard

              

            </p>

          </a>



        </li>



        <?php if($this->rbac->check_module_permission('admin')): ?> 

        <li id="admin" class="nav-item has-treeview">

          <a href="#" class="nav-link">

            <i class="nav-icon fa fa-pie-chart"></i>

            <p>

              Admin Cadastro

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

     

      <?php if($this->rbac->check_module_permission('users')): ?>

        <li id="usuarios" class="nav-item has-treeview">

          <a href="#" class="nav-link">

            <i class="nav-icon fa fa-user"></i>

            <p>

              Usuários

              <i class="right fa fa-angle-left"></i>

            </p>

          </a>

          <ul class="nav nav-treeview">

                       <li class="nav-item">

              <a href="<?= base_url('admin/users/add'); ?>" class="nav-link">

                <i class="fa fa-circle-o nav-icon"></i>

                <p>Add Usuários</p>

              </a>

            </li>

            <li class="nav-item">

              <a href="<?= base_url('admin/users'); ?>" class="nav-link">

                <i class="fa fa-circle-o nav-icon"></i>

                <p>Listar Usuários</p>

              </a>

            </li>



          </ul>

        </li>

      <?php endif; ?>
     <?php if($this->rbac->check_module_permission('users')): ?>

        <li id="tipos" class="nav-item has-treeview">

          <a href="#" class="nav-link">

            <i class="nav-icon fa fa-cogs"></i>

            <p>

              Tipos de máquinas

              <i class="right fa fa-angle-left"></i>

            </p>

          </a>

          <ul class="nav nav-treeview">

            <li class="nav-item">

              <a href="<?= base_url('admin/tipos'); ?>" class="nav-link">

                <i class="fa fa-circle-o nav-icon"></i>

                <p>Listar Tipos</p>

              </a>

            </li>

            <li class="nav-item">

              <a href="<?= base_url('admin/tipos/add'); ?>" class="nav-link">

                <i class="fa fa-circle-o nav-icon"></i>

                <p>Add Tipo</p>

              </a>

            </li>

          </ul>

        </li>

      <?php endif; ?>
       

            <?php if($this->rbac->check_module_permission('users')): ?>

        <li id="machines" class="nav-item has-treeview">

          <a href="#" class="nav-link">

            <i class="nav-icon fa fa-cogs"></i>

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

            <li class="nav-item">

              <a href="<?= base_url('admin/machines/add'); ?>" class="nav-link">

                <i class="fa fa-circle-o nav-icon"></i>

                <p>Add Máquinas</p>

              </a>

            </li>

          </ul>

        </li>

      <?php endif; ?>

      

      

                  <?php if($this->rbac->check_module_permission('machines')): ?>

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

        </li>

      <?php endif; ?>

      

      

      <?php if($this->rbac->check_module_permission('users')): ?>

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

            <li class="nav-item">

              <a href="<?= base_url('admin/itens/add_item'); ?>" class="nav-link">

                <i class="fa fa-circle-o nav-icon"></i>

                <p>Add Itens</p>

              </a>

            </li>

           </ul>

        </li>

      <?php endif; ?>

      

      

      

                  <?php if($this->rbac->check_module_permission('users')): ?>

        <li id="relatorios" class="nav-item has-treeview">

          <a href="#" class="nav-link">

            <i class="nav-icon fa fa-inbox"></i>

            <p>

              Relatórios

              <i class="right fa fa-angle-left"></i>

            </p>

          </a>

          <ul class="nav nav-treeview">

            <li class="nav-item">

              <a href="<?= base_url('admin/#'); ?>" class="nav-link">

                <i class="fa fa-circle-o nav-icon"></i>

                <p>Por ponto de venda</p>

              </a>

            </li>

            <li class="nav-item">

              <a href="<?= base_url('admin/#/add'); ?>" class="nav-link">

                <i class="fa fa-circle-o nav-icon"></i>

                <p>Por equipamento</p>

              </a>

            </li>

          </ul>

        </li>

      <?php endif; ?>

      

      

            <?php if($this->rbac->check_module_permission('users')): ?>

        <li id="financeiro" class="nav-item has-treeview">

          <a href="#" class="nav-link">

            <i class="nav-icon fa fa-inbox"></i>

            <p>

              Financeiro

              <i class="right fa fa-angle-left"></i>

            </p>

          </a>

          <ul class="nav nav-treeview">
              
              <li class="nav-item">

              <a href="<?= base_url('admin/#'); ?>" class="nav-link">

                <i class="fa fa-circle-o nav-icon"></i>

                <p>Categorias</p>

              </a>

            </li>

            <li class="nav-item">

              <a href="<?= base_url('admin/#'); ?>" class="nav-link">

                <i class="fa fa-circle-o nav-icon"></i>

                <p>Contas a Pagar</p>

              </a>

            </li>

            <li class="nav-item">

              <a href="<?= base_url('admin/#/add'); ?>" class="nav-link">

                <i class="fa fa-circle-o nav-icon"></i>

                <p>Contas a receber</p>

              </a>

            </li>

          </ul>

        </li>

      <?php endif; ?>

      


         

          <?php if($this->rbac->check_module_permission('general_settings')): ?> 

         <li id="admin_roles" class="nav-item has-treeview">

          <a href="#" class="nav-link">

            <i class="nav-icon fa fa-dashboard"></i>

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

      

      <?php if($this->rbac->check_module_permission('general_settings')): ?> 

        <li id="export" class="nav-item has-treeview">

          <a href="#" class="nav-link">

            <i class="nav-icon fa fa-user"></i>

            <p>

              Backup & Export

              <i class="right fa fa-angle-left"></i>

            </p>

          </a>

          <ul class="nav nav-treeview">

            <li class="nav-item">

              <a href="<?= base_url('admin/export'); ?>" class="nav-link">

                <i class="fa fa-circle-o nav-icon"></i>

                <p>Database Backup</p>

              </a>

            </li>

          </ul>

        </li>

        <?php endif; ?>

        

                <?php if($this->rbac->check_module_permission('general_settings')): ?> 

        <li id="general_settings" class="nav-item">

          <a href="<?= base_url('admin/general_settings'); ?>" class="nav-link">

            <i class="nav-icon fa fa-cogs"></i>

            <p>

              Config Sistem

            </p>

          </a>

        </li>

        <?php endif; ?>
        
        
        
        
        
        
        
        
        
        
        
        

    
          
            
              
                
                   



        <li class="nav-header">SCRIPT MODELOS</li>

        <li id="calender" class="nav-item">

          <a href="<?= base_url('admin/calendar'); ?>" class="nav-link">

            <i class="nav-icon fa fa-calendar"></i>

            <p>

              Calendar

              <span class="badge badge-info right">2</span>

            </p>

          </a>

        </li>

 <li id="widgets" class="nav-item">

          <a href="<?= base_url('admin/widgets'); ?>" class="nav-link">

            <i class="nav-icon fa fa-th"></i>

            <p>

              Widgets

              <span class="right badge badge-danger">New</span>

            </p>

          </a>

        </li>



        <li id="charts" class="nav-item has-treeview">

          <a href="#" class="nav-link">

            <i class="nav-icon fa fa-pie-chart"></i>

            <p>

              Charts

              <i class="right fa fa-angle-left"></i>

            </p>

          </a>

          <ul class="nav nav-treeview">

            <li class="nav-item">

              <a href="<?= base_url('admin/charts/chartjs'); ?>" class="nav-link">

                <i class="fa fa-circle-o nav-icon"></i>

                <p>ChartJS</p>

              </a>

            </li>

            <li class="nav-item">

              <a href="<?= base_url('admin/charts/flot'); ?>" class="nav-link">

                <i class="fa fa-circle-o nav-icon"></i>

                <p>Flot</p>

              </a>

            </li>

            <li class="nav-item">

              <a href="<?= base_url('admin/charts/inline'); ?>" class="nav-link">

                <i class="fa fa-circle-o nav-icon"></i>

                <p>Inline</p>

              </a>

            </li>

          </ul>

        </li>



        <li id="ui" class="nav-item has-treeview">

          <a href="#" class="nav-link">

            <i class="nav-icon fa fa-tree"></i>

            <p>

              UI Elements

              <i class="fa fa-angle-left right"></i>

            </p>

          </a>

          <ul class="nav nav-treeview">

            <li class="nav-item">

              <a href="<?= base_url('admin/ui/general'); ?>" class="nav-link">

                <i class="fa fa-circle-o nav-icon"></i>

                <p>General</p>

              </a>

            </li>

            <li class="nav-item">

              <a href="<?= base_url('admin/ui/icons'); ?>" class="nav-link">

                <i class="fa fa-circle-o nav-icon"></i>

                <p>Icons</p>

              </a>

            </li>

            <li class="nav-item">

              <a href="<?= base_url('admin/ui/buttons'); ?>" class="nav-link">

                <i class="fa fa-circle-o nav-icon"></i>

                <p>Buttons</p>

              </a>

            </li>

          </ul>

        </li>



        <li id="forms" class="nav-item has-treeview">

          <a href="#" class="nav-link">

            <i class="nav-icon fa fa-edit"></i>

            <p>

              Forms

              <i class="fa fa-angle-left right"></i>

            </p>

          </a>

          <ul class="nav nav-treeview">

            <li class="nav-item">

              <a href="<?= base_url('admin/forms/general'); ?>" class="nav-link">

                <i class="fa fa-circle-o nav-icon"></i>

                <p>General Elements</p>

              </a>

            </li>

            <li class="nav-item">

              <a href="<?= base_url('admin/forms/advanced'); ?>" class="nav-link">

                <i class="fa fa-circle-o nav-icon"></i>

                <p>Advanced Elements</p>

              </a>

            </li>

            <li class="nav-item">

              <a href="<?= base_url('admin/forms/editors'); ?>" class="nav-link">

                <i class="fa fa-circle-o nav-icon"></i>

                <p>Editors</p>

              </a>

            </li>

          </ul>

        </li>



        <li id="tables" class="nav-item has-treeview">

            <a href="#" class="nav-link">

              <i class="nav-icon fa fa-table"></i>

              <p>

                Tables

                <i class="fa fa-angle-left right"></i>

              </p>

            </a>

            <ul class="nav nav-treeview">

              <li class="nav-item">

                <a href="<?= base_url('admin/tables/simple'); ?>" class="nav-link">

                  <i class="fa fa-circle-o nav-icon"></i>

                  <p>Simple Tables</p>

                </a>

              </li>

              <li class="nav-item">

                <a href="<?= base_url('admin/tables/data'); ?>" class="nav-link">

                  <i class="fa fa-circle-o nav-icon"></i>

                  <p>Data Tables</p>

                </a>

              </li>

            </ul>

        </li>



        <li id="mailbox" class="nav-item has-treeview">

          <a href="#" class="nav-link">

            <i class="nav-icon fa fa-envelope-o"></i>

            <p>

              Mailbox

              <i class="fa fa-angle-left right"></i>

            </p>

          </a>

          <ul class="nav nav-treeview">

            <li class="nav-item">

              <a href="<?= base_url('admin/mailbox/inbox'); ?>" class="nav-link">

                <i class="fa fa-circle-o nav-icon"></i>

                <p>Inbox</p>

              </a>

            </li>

            <li class="nav-item">

              <a href="<?= base_url('admin/mailbox/compose'); ?>" class="nav-link">

                <i class="fa fa-circle-o nav-icon"></i>

                <p>Compose</p>

              </a>

            </li>

            <li class="nav-item">

              <a href="<?= base_url('admin/mailbox/read_mail'); ?>" class="nav-link">

                <i class="fa fa-circle-o nav-icon"></i>

                <p>Read</p>

              </a>

            </li>

          </ul>

        </li>



        <li id="pages" class="nav-item has-treeview">

          <a href="#" class="nav-link">

            <i class="nav-icon fa fa-book"></i>

            <p>

              Pages

              <i class="fa fa-angle-left right"></i>

            </p>

          </a>

          <ul class="nav nav-treeview">

            <li class="nav-item">

              <a href="<?= base_url('admin/pages/invoice'); ?>" class="nav-link">

                <i class="fa fa-circle-o nav-icon"></i>

                <p>Invoice</p>

              </a>

            </li>

            <li class="nav-item">

              <a href="<?= base_url('admin/pages/profile'); ?>" class="nav-link">

                <i class="fa fa-circle-o nav-icon"></i>

                <p>Profile</p>

              </a>

            </li>

            <li class="nav-item">

              <a href="<?= base_url('admin/pages/login'); ?>" class="nav-link">

                <i class="fa fa-circle-o nav-icon"></i>

                <p>Login</p>

              </a>

            </li>

            <li class="nav-item">

              <a href="<?= base_url('admin/pages/register'); ?>" class="nav-link">

                <i class="fa fa-circle-o nav-icon"></i>

                <p>Register</p>

              </a>

            </li>

            <li class="nav-item">

              <a href="<?= base_url('admin/pages/lockscreen'); ?>" class="nav-link">

                <i class="fa fa-circle-o nav-icon"></i>

                <p>Lockscreen</p>

              </a>

            </li>

          </ul>

        </li>



        <li id="extras" class="nav-item has-treeview">

          <a href="#" class="nav-link">

            <i class="nav-icon fa fa-plus-square-o"></i>

            <p>

              Extras

              <i class="fa fa-angle-left right"></i>

            </p>

          </a>

          <ul class="nav nav-treeview">

            <li class="nav-item">

              <a href="<?= base_url('admin/extras/error404'); ?>" class="nav-link">

                <i class="fa fa-circle-o nav-icon"></i>

                <p>Error 404</p>

              </a>

            </li>

            <li class="nav-item">

              <a href="<?= base_url('admin/extras/errro500'); ?>" class="nav-link">

                <i class="fa fa-circle-o nav-icon"></i>

                <p>Error 500</p>

              </a>

            </li>

            <li class="nav-item">

              <a href="<?= base_url('admin/extras/blank'); ?>" class="nav-link">

                <i class="fa fa-circle-o nav-icon"></i>

                <p>Blank Page</p>

              </a>

            </li>

            <li class="nav-item">

              <a href="<?= base_url('admin/extras/starter'); ?>" class="nav-link">

                <i class="fa fa-circle-o nav-icon"></i>

                <p>Starter Page</p>

              </a>

            </li>

          </ul>

        </li>



      

        <li class="nav-item">

          <a href="https://adminlte.io/docs" class="nav-link">

            <i class="nav-icon fa fa-file"></i>

            <p>Documentation</p>

          </a>

        </li>

      

        <li class="nav-item">

          <a href="#" class="nav-link">

            <i class="nav-icon fa fa-circle-o text-danger"></i>

            <p class="text">Important</p>

          </a>

        </li>

        <li class="nav-item">

          <a href="#" class="nav-link">

            <i class="nav-icon fa fa-circle-o text-warning"></i>

            <p>Warning</p>

          </a>

        </li>

        <li class="nav-item">

          <a href="#" class="nav-link">

            <i class="nav-icon fa fa-circle-o text-info"></i>

            <p>Informational</p>

          </a>

        </li>

      </ul>

    </nav>

    <!-- /.sidebar-menu -->

  </div>

  <!-- /.sidebar -->

</aside>



<script>

  $("#<?= $cur_tab ?>").addClass('menu-open');

  $("#<?= $cur_tab ?> > a").addClass('active');

</script>