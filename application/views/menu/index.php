        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Menu Management
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
                    <li><a href="#">Master Data</a></li>
                    <li class="active">Menu Management</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <?= $this->session->flashdata('message'); ?>
                <!-- Default box -->
                <div class="panel panel-default">
                    <!-- Default panel contents -->
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-11">
                            </div>
                            <div class="col-md-1">
                                <button type="button" class="btn btn-success btn-sm">Tambah</button>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered table-striped" id="table1">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Menu</th>
                                    <th scope="col">Icon</th>
                                    <th scope="col">Keterangan</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                ?>
                                <?php foreach ($menu as $dataMenu) :  ?>
                                    <tr>
                                        <th scope="row"><?= $no; ?></th>
                                        <td><?= $dataMenu['menu']; ?></td>
                                        <td><?= $dataMenu['icon']; ?></td>
                                        <td><?= $dataMenu['keterangan']; ?></td>
                                        <td></td>
                                    </tr>
                                    <?php $no++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
            <!-- /.content -->

        </div>
        <!-- /.content-wrapper -->