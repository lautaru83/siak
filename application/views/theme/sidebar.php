 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-secondary elevation-2 sidebar-no-expand">
   <!-- Brand Logo -->
   <a href="#" class="brand-link">
     <img src="<?= base_url('assets/') ?>dist/img/Windows.png" alt="AdminLTE Logo" class="brand-image elevation-1" style="opacity: .8">
     <span class="brand-text">SIAK APP</span>
   </a>

   <!-- Sidebar -->
   <div class="sidebar" id="sidebar-menu">

     <!-- Sidebar Menu -->
     <nav class="mt-2">
       <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
         <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
         <li class="nav-item" data-toggle="tooltip" data-placement="bottom" title="Beranda">
           <a href="<?= site_url('/dashboard') ?>" class="nav-link">
             <i class="nav-icon fas fa-home"></i>
             <p>
               Beranda
             </p>
           </a>
         </li>

         <!-- menu db -->
         <?php
          $jabatan = $this->session->userdata('role_id');
          if ($jabatan == 1) {
            $queryMenu = "select * from menus";
          } else {
            $queryMenu = "select distinct a.id as id,a.menu as menu,a.icon as icon from menus a join submenus b on a.id=b.menu_id join accesses c on b.id=c.submenu_id where c.role_id=$jabatan ";
          }
          $menu = $this->db->query($queryMenu)->result_array();
          foreach ($menu as $m) :
            if ($menu) {
              ?>
             <li class="nav-item has-treeview" data-toggle="tooltip" data-placement="bottom" title="<?= $m['menu']; ?>">
               <a href="#" class="nav-link">
                 <i class="nav-icon <?= $m['icon']; ?>"></i>
                 <p>
                   <?= $m['menu']; ?>
                   <i class="right fas fa-angle-left"></i>
                 </p>
               </a>
               <?php
                    $menuId = $m['id'];
                    //$jabatan = $this->session->userdata('role_id');;
                    if ($jabatan == 1) {
                      $querySubMenu = "select * from submenus where menu_id=$menuId and is_active=1";
                    } else {
                      $querySubMenu = "select distinct a.submenu as submenu,a.url as url,a.icon as icon
                     from submenus a join accesses b on a.id=b.submenu_id where a.menu_id=$menuId and b.role_id=$jabatan and a.is_active=1";
                    }
                    $subMenu = $this->db->query($querySubMenu)->result_array();
                    ?>
               <?php
                    if ($subMenu) {
                      ?>
                 <ul class="nav nav-treeview">
                   <?php
                          foreach ($subMenu as $sm) :
                            $url = $sm['url'];

                            ?>
                     <li class="nav-item" data-toggle="tooltip" data-placement="bottom" title="<?= $sm['submenu']; ?>">
                       <a href="<?= site_url($url); ?>" class="nav-link" id="load-page">
                         <i class="<?= $sm['icon']; ?> nav-icon"></i>
                         <p><?= $sm['submenu']; ?></p>
                       </a>
                     </li>
                   <?php
                          endforeach;
                          ?>
                 </ul>

               <?php
                    }
                    ?>
             </li>

         <?php
            }
          endforeach;
          ?>
         <!-- <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Active Page</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Inactive Page</p>
                </a>
              </li>
            </ul> -->


         <!-- end menu db -->
         <!-- <li class="nav-item">
           <a href="" class="nav-link" id="tes-halaman">
             <i class="nav-icon fas fa-th"></i>
             <p>
               Tes Halaman
             </p>
           </a>
         </li> -->
         <!-- <li class="nav-item">
            <a href="#" class="nav-link" id="tes-halaman2">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Tes Halaman 2
              </p>
            </a>
          </li> -->
       </ul>
     </nav>
     <!-- /.sidebar-menu -->
   </div>
   <!-- /.sidebar -->
 </aside>