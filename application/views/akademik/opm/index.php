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
                                <h5 class="card-title">
                                    <a class="text-reset" id="kas-masuk">Tahun Pembukuan <?= $pembukuan_id ?></a>
                                </h5>
                            </div>
                            <div class="float-right">
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col col-sm-12">
                                    <form class="form-inline">
                                        <div class="form-group">
                                            <label class="font-weight-normal my-2 mr-5">Nim :</label>
                                            <input type="text" name="nim_opm" id="nim_opm" class="form-control form-control-md" autocomplete="off">
                                        </div>
                                        <button type="submit" id="btn-cari-opm" class="btn btn-primary btn-md my-1 mx-2">Cari</button>
                                    </form>
                                    <!-- /.form inline -->
                                </div>
                            </div>
                            <!-- <div class="row">
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label class="font-weight-normal">NIM</label>
                                        <div class="">
                                            <input type="text" name="nim_opm" class="form-control" id="nim_opm" tabindex="1">
                                            <span id="nim_error" class="text-danger"></span>
                                        </div>
                                    </div>
                                </div>

                            </div> -->
                            <!-- /row -->
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card-->
                </div>
                <!-- /.col col-lg-12-->
            </div>
            <!-- /.row -->
            <!-- /.row -->
            <div class="row">
                <div class="col col-lg-12">
                    <div class="card">
                        <div class="card-header bg-gradient-light">
                            <div>
                                <h4 class="card-title">
                                    Riwayat Transaksi
                                </h4>
                            </div>
                            <div class="float-right">
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-hover table-striped table-sm">
                                <thead>
                                    <tr>
                                        <td width="5%" class="text-center">No</td>
                                        <td width="10%" class="text-center">Tanggal</td>
                                        <td width="10%" class="text-center">No. Bukti</td>
                                        <td class="text-center">Uraian</td>
                                        <td width="15%" class="text-center">Jumlah Transaksi (Rp.)</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $nor = 1;
                                    if ($riwayat) {
                                        foreach ($riwayat as $dataRiwayat) :
                                    ?>
                                            <tr>
                                                <td class="text-center"><?= $nor; ?></td>
                                                <td class="text-center"><?= tanggal_indo($dataRiwayat['tanggal_transaksi']); ?></td>
                                                <td class="text-center"><?= $dataRiwayat['nobukti']; ?></td>
                                                <td><?= $dataRiwayat['keterangan']; ?></td>
                                                <td width="15%" class="text-right"><?= rupiah($dataRiwayat['total_transaksi']); ?></td>
                                            </tr>
                                        <?php
                                            $nor++;
                                        endforeach;
                                    } else {
                                        ?>

                                        <tr>
                                            <td colspan="5" class="text-center">Data Tidak Ditemukan</td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
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
<!-- /.content-wrapper