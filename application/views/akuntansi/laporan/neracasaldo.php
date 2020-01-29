<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <!-- <div class="container-fluid"> -->
        <div class="row">
            <div class="col-sm-6">
                <h3 class="ml-3">Laporan <?= $kontensubmenu; ?></h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right mr-4">
                    <li class="breadcrumb-item"><a><?= $kontenmenu; ?></a></li>
                    <li class="breadcrumb-item active"><?= $kontensubmenu; ?></li>
                </ol>
            </div>
        </div>
        <!-- </div> -->
        <!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <?php //$this->session->flashdata('message'); 
            ?>
            <div class="row">
                <div class="col col-lg-12">
                    <div class="card">
                        <div class="card-header bg-gradient-light">
                            <div>
                                <h4 class="card-title">
                                    <a class="text-reset" id="kas-keluar">Parameter Laporan </a>
                                </h4>
                            </div>
                            <div class="float-right">
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="col">
                                <form class="form-inline" method="POST" action="<?= base_url('akuntansi/neracasaldo/data'); ?>">
                                    <div class="form-group mb-2">
                                        <label class="font-weight-normal">Akhir Periode : </label>
                                    </div>
                                    <!-- <div class="form-group mx-sm-2 mb-2">
                                        <input type="text" name="awal_periode" id="awal_periode" class="form-control" autocomplete="off" value="<?php //$awal_periode; 
                                                                                                                                                ?>">
                                        <span id="tanggal_error" class="text-danger"></span>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label class="font-weight-normal">Akhir Periode : </label>
                                    </div> -->
                                    <div class="form-group mx-sm-2 mb-2">
                                        <input type="text" name="akhir_periode" id="akhir_periode" class="form-control" autocomplete="off" value="<?= $akhir_periode; ?>">
                                        <span id="tanggal_error" class="text-danger"></span>
                                    </div>
                                    <button type="submit" id="btn_tampl_neracasaldo" class="btn btn-primary mb-2">Terapkan</button>
                                </form>
                                <!-- /.row -->

                            </div>
                            <!-- /.container-fluid -->
                            <?php //$this->load->view('akuntansi/nonkasbank/modal');
                            ?>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->