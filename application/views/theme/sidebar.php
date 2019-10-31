<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <?php
            $queryMenu = "select * from menus";
            $menu = $this->db->query($queryMenu)->result_array();
            foreach ($menu as $m) :  ?>

                <?php
                    if ($m['id'] == 1) {
                        ?>
                    <li class="treeview">
                        <a href="#">
                            <i class="<?= $m['icon']; ?>"></i> <span><?= $m['menu']; ?></span>
                        </a>
                    </li>
                <?php } else { ?>
                    <li class="treeview">
                        <a href="#">
                            <i class="<?= $m['icon']; ?>"></i> <span><?= $m['menu']; ?></span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <?php
                                    $menuId = $m['id'];
                                    $querySubMenu = "select * from submenus where menu_id=$menuId ";
                                    $subMenu = $this->db->query($querySubMenu)->result_array();
                                    ?>
                            <?php foreach ($subMenu as $sm) : ?>
                                <li><a href="<?= $sm['url']; ?>"><i class="<?= $sm['icon']; ?>"></i> <?= $sm['submenu']; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </li>

                <?php }  ?>

            <?php endforeach; ?>
        </ul>
    </section>
</aside>