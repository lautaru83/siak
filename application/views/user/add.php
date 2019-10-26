        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    User Management
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
                    <li><a href="#">Master Data</a></li>
                    <li class="active">User Management</li>
                    <li class="active">Tambah User</li>
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
                            <div class="col-md-1">

                            </div>
                            <div class="col-md-10">
                            </div>
                            <div class="col-md-1">
                                <a href="<?= base_url('user') ?>" class="btn btn-warning btn-sm active" role="button">Batal</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-6">

                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->

        </div>
        <!-- /.content-wrapper -->