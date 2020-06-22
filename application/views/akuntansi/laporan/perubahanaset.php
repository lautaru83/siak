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
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-gradient-light">
                            <div>
                                <h4 class="card-title">
                                    Tahun Pembukuan <?= $this->session->userdata('tahun_buku'); ?>
                                </h4>
                            </div>
                            <div class="float-right">
                                <!-- <h4 class="card-title" disabled="disabled">
                                    Cetak <i class="fas fa-print" style="color: teal"></i>
                                </h4> -->
                            </div>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <!--------------- isi content ---------------------------- -->
                            <form class="form-inline">
                                <div class="form-group my-2 mr-sm-3">
                                    <label class="font-weight-normal my-2 mr-2">Akhir Periode :</label>
                                    <input type="text" name="akhir_periode" id="akhir_periode" class="form-control" autocomplete="off">
                                </div>
                                <div class="form-check form-check-inline my-2 mx-sm-3">
                                    <input class="form-check-input font-weight-normal" type="checkbox" id="ckkomparatif">
                                    <label class="form-check-label" for="ckkomparatif">Komparatif</label>
                                </div>
                                <?php
                                if ($institusi_id == "01") {
                                ?>
                                    <div class="form-check form-check-inline my-2 mx-sm-3">
                                        <input class="form-check-input font-weight-normal" type="checkbox" id="ckkonsolidasi">
                                        <label class="form-check-label" for="ckkonsolidasi">Konsolidasi</label>
                                    </div>
                                <?php
                                }
                                ?>

                                <button type="submit" id="btn-tampil-perubahanaset" data-id="<?= $institusi_id; ?>" data-tgl1="<?= $buku_awal; ?>" data-tgl2="<?= $buku_akhir; ?>" data-laporan="activitas" class="btn btn-primary my-1 mx-sm-2">Tampilkan</button>

                            </form>
                            <!-- /.form inline -->

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col-md-12 -->
            </div>
            <!-- /.row -->
            <!-- data laporanya -->
            <div id="data">

            </div>
            <!-- end data laporanya-->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->