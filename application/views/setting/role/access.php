<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <!-- <div class="container-fluid"> -->
        <div class="row">
            <div class="col-sm-6">
                <h3 class="ml-3">Hak Akses User</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right mr-4">
                    <li class="breadcrumb-item"><a><?= $kontenmenu; ?></a></li>
                    <li class="breadcrumb-item active"><a href="<?= site_url('role'); ?>"><?= $kontensubmenu; ?></a></li>
                    <li class="breadcrumb-item active">Hak Akses User</li>
                </ol>
            </div>
        </div>
        <!-- </div> -->
        <!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col col-md-12">
                    <div class="card">
                        <div class="card-header bg-gradient-light">
                            <div>
                                <h4 class="card-title">
                                    <a class="text-reset"><i class="far fa-list-alt" style="color: teal"></i> Role : <?= $role['role']; ?> </a>
                                </h4>
                            </div>
                            <div class="float-right">
                                <!-- <h4 class="card-title" disabled="disabled">
                                    Cetak <i class="fas fa-print" style="color: teal"></i>
                                </h4> -->
                            </div>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" id="tabel-data">
                            <table class="table table-bordered table-hover table-sm">
                                <thead>
                                    <tr>
                                        <td class="text-center" width="10%">Icon</td>
                                        <td colspan="2" class="text-center">Menu / Submenu</td>
                                        <td class="text-center" width="12%" style="color: grey"><i class="fas fa-cog"></i></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    //$no = 1;
                                    if ($menu) {
                                        foreach ($menu as $dataMenu) :
                                            $idMenu = $dataMenu['id'];
                                    ?>

                                            <tr class="bg-light">
                                                <td class="text-center">
                                                    <i class="nav-icon <?= $dataMenu['icon']; ?>"></i>
                                                </td>
                                                <td colspan="3"><?= $dataMenu['menu']; ?></td>
                                            </tr>
                                            <?php
                                            $sqlSubmenu = "select * from submenus where menu_id=$idMenu ";
                                            $subMenu = $this->db->query($sqlSubmenu)->result_array();
                                            if ($subMenu) {
                                                foreach ($subMenu as $dataSubmenu) :
                                                    $idSubmenu = $dataSubmenu['id'];
                                            ?>
                                                    <tr>
                                                        <td class="text-center">
                                                            <i class="nav-icon <?= $dataSubmenu['icon']; ?>"></i>
                                                        </td>
                                                        <td colspan="2"><?= $dataSubmenu['submenu']; ?></td>
                                                        <td class="text-center">
                                                            <div class="form-check">
                                                                <input class="form-check-input frm-cek-access" type="checkbox" <?= cek_access($role_id, $idSubmenu); ?> data-role="<?= $role_id; ?>" data-submenu="<?= $idSubmenu; ?>">
                                                            </div>
                                                        </td>
                                                    </tr>
                                            <?php
                                                endforeach;
                                            }
                                            ?>
                                    <?php
                                        //$no++;
                                        endforeach;
                                    }
                                    ?>

                                </tbody>
                            </table>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->