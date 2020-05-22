<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <!-- <div class="container-fluid"> -->
        <div class="row">
            <div class="col-sm-6">
                <h3 class="ml-3"><?= $kontensubmenu; ?></h3>
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
                                    <a class="text-reset" id="kas-masuk">Tahun Akademik <?= $pembukuan_id ?> </a>
                                </h4>
                            </div>
                            <div class="float-right">
                                <?php
                                $totaltransaksi = "";
                                if ($totaltransaksi) {
                                    $totaldebet = $totaltransaksi['debet'];
                                    $totalkredit = $totaltransaksi['kredit'];
                                    if ($totaldebet == $totalkredit) {
                                ?>
                                        <h4 class="card-title" disabled="disabled">
                                            <a href="" class="text-reset" id="btn-selesai-opm" data-id="<?= $tran_id; ?>" data-total="<?= rupiah($totaldebet); ?>" data-status="<?= $status; ?>" tabindex="9">Selesai <i class="far fa-check-square" style="color: teal"></i></a>
                                        </h4>
                                <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label class="font-weight-normal">Nim</label>
                                        <div class="">
                                            <input type="text" name="nim_opm" class="form-control" id="nim_opm" tabindex="1">
                                            <span id="nim_error" class="text-danger"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="font-weight-normal">Nama</label>
                                        <div class="">
                                            <input type="text" name="nama" class="form-control" id="nama" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="font-weight-normal">Kelas</label>
                                        <div class="">
                                            <input type="text" name="kelas" class="form-control" id="kelas" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /row -->
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card-->
                </div>
                <!-- /.col col-lg-12-->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col col-lg-12">
                    <div class="card">
                        <div class="card-header bg-gradient-light">
                            <div>
                                <h4 class="card-title">
                                    <a class="text-reset" id="kas-masuk">Simpan Transaksi
                                </h4>
                            </div>
                            <div class="float-right">
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label class="font-weight-normal">Nim</label>
                                        <div class="">
                                            <input type="text" name="nim_opm" class="form-control" id="nim_opm" tabindex="1">
                                            <span id="nim_error" class="text-danger"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="font-weight-normal">Nama</label>
                                        <div class="">
                                            <input type="text" name="nama" class="form-control" id="nama" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="font-weight-normal">Kelas</label>
                                        <div class="">
                                            <input type="text" name="kelas" class="form-control" id="kelas" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /row -->
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card-->
                </div>
                <!-- /.col col-lg-12-->
            </div>
            <!-- /.row -->



        </div>
        <!-- /.container-fluid -->
        <?php //$this->load->view('akuntansi/kasmasuk/modal');
        ?>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->