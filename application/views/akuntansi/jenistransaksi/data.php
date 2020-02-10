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
            <div class="row">
                <div class="col col-md-12">
                    <div class="card">
                        <div class="card-header bg-gradient-light">
                            <div>
                                <h4 class="card-title">
                                    <a class="text-reset" id="kas-keluar">Tahun Pembukuan <?= $this->session->userdata('tahun_buku'); ?></a>
                                </h4>
                            </div>
                            <div class="float-right">
                                <h4 class="card-title" disabled="disabled">
                                    <a id="btn-tes-modal">
                                        Cetak <i class="fas fa-print" style="color: teal"></i>
                                    </a>
                                </h4>
                            </div>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" id="tabel-data">
                            <table class="table table-bordered table-hover table-sm">
                                <thead>
                                    <tr class="">
                                        <td width="3%" class="text-center">No</td>
                                        <td width="3%" class="text-center">Kode</td>
                                        <td colspan="3" class="text-center"><span>Jenis Transaksi / Kode Perkiraan</span></td>
                                        <!-- <td width="15%" class="text-center"><span>a</span></td> -->
                                        <!-- <td width="3%" class="text-center"></td> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    if ($jenistransaksi) {
                                        foreach ($jenistransaksi as $dataJenistransaksi) :
                                            $idJenisTransaksi = $dataJenistransaksi['id'];
                                    ?>
                                            <tr>
                                                <td width="7%" class="text-center"><?= $no; ?></td>
                                                <td width="7%" class="font-weight-bolder text-center"><?= $idJenisTransaksi; ?></td>
                                                <td colspan="2" class="font-weight-bolder text-uppercase text-md"><?= $dataJenistransaksi['jenis_transaksi']; ?></td>
                                            </tr>
                                            <?php
                                            $akun = $this->Kodeperkiraan_model->akunjurnal($idJenisTransaksi);
                                            if ($akun) {
                                                foreach ($akun as $dataAkun) :
                                            ?>
                                                    <tr>
                                                        <td class="text-center"></td>
                                                        <td class="text-center"></td>
                                                        <td class="text-center" width="10%"><?= $dataAkun['id']; ?></td>
                                                        <td colspan="2" class="text-md"><?= $dataAkun['level6']; ?></td>
                                                    </tr>

                                            <?php
                                                endforeach;
                                            }
                                            ?>


                                    <?php
                                            $no++;
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