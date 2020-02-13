<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <!-- <div class="container-fluid"> -->
        <div class="row">
            <div class="col-sm-6">
                <h3 class="ml-3">Pengaturan <?= $kontensubmenu; ?></h3>
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
                                    <a class="text-reset">Tahun Pembukuan <?= $idtahun ?></a>
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
                            <table class="table table-bordered table-striped table-hover table-sm">
                                <thead>
                                    <tr class="">
                                        <td width="3%" class="text-center">No</td>
                                        <td colspan="3" class="text-center"><span>Kode Perkiraan</span></td>
                                        <td class="text-center" width="8%">Posisi</td>
                                        <td class="text-center" width="13%">Saldo Awal (Rp)</td>
                                        <td class="text-center" width="10%" style="color: grey" width="5%"><i class="fas fa-cog"></i></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $level11 = $this->Kodeperkiraan_model->asetsaldo();
                                    if ($level11) {
                                        foreach ($level11 as $dataLevel11) :
                                            $idLevel11 = $dataLevel11['id'];
                                    ?>
                                            <tr>
                                                <td width="5%" class="text-center">1</td>
                                                <td colspan="6" class="text-uppercase text-md"><?= $dataLevel11['level1']; ?></td>
                                            </tr>
                                            <?php
                                            $akunaset6 = $this->Kodeperkiraan_model->akunlevel6saldo($idLevel11);
                                            if ($akunaset6) {
                                                $saldoaset = 0;
                                                $jumlahaset = 0;
                                                $totalaset = 0;
                                                foreach ($akunaset6 as $dataAkunaset6) :
                                                    $idAkunaset6 = $dataAkunaset6['a6level_id'];
                                                    $posisiAset = $dataAkunaset6['posisi'];
                                                    $jumlahaset = ambilsaldoawal($idtahun, $idAkunaset6, $posisiAset);
                                                    $totalaset = $totalaset + $jumlahaset;

                                            ?>
                                                    <tr>
                                                        <td class="text-center"></td>
                                                        <td width="10%"><?= $dataAkunaset6['a6level_id']; ?></td>
                                                        <td colspan="2" class="text-md"><?= $dataAkunaset6['level6']; ?></td>
                                                        <td class="text-center"><?= posisi_akun($dataAkunaset6['posisi']); ?></td>
                                                        <td class="text-right">
                                                            <?= rupiah_positif($jumlahaset); ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <a href="" class="btn-edit-saldoawal" data-akunid="<?= $dataAkunaset6['a6level_id']; ?>" data-thbukuid="<?= $idtahun; ?>" data-posisi="<?= $posisiAset; ?>" data-info="<?= $dataAkunaset6['level6']; ?>" data-toggle="tooltip" data-placement="bottom" title="Edit"><i class="fas fa-edit" style="color: olive"></i></a> - <a href="" class="btn-hapus-saldoawal" data-akunid="<?= $dataAkunaset6['a6level_id']; ?>" data-thbukuid="<?= $idtahun; ?>" data-info="<?= $dataAkunaset6['level6']; ?>" data-toggle="tooltip" data-placement="bottom" title="Hapus Saldo"> <i class="far fa-trash-alt" style="color: maroon"></i></a>
                                                        </td>
                                                    </tr>
                                            <?php
                                                endforeach;
                                            }
                                            ?>
                                        <?php
                                        endforeach;
                                        ?>
                                        <tr>
                                            <td colspan="5" class="text-uppercase text-md font-weight-bolder">Jumlah Aset</td>
                                            <td class="text-right font-weight-bolder text-md"><?= rupiah_positif($totalaset); ?></td>
                                            <td></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                    <?php
                                    $level12 = $this->Kodeperkiraan_model->kewajibansaldo();
                                    if ($level12) {
                                        foreach ($level12 as $dataLevel12) :
                                            $idLevel12 = $dataLevel12['id'];
                                    ?>
                                            <tr>
                                                <td class="text-center">2</td>
                                                <td colspan="6" class="text-uppercase text-md"><?= $dataLevel12['level1']; ?></td>
                                            </tr>
                                            <?php
                                            $akunkewajiban6 = $this->Kodeperkiraan_model->akunlevel6saldo($idLevel12);
                                            if ($akunkewajiban6) {
                                                $saldokewajiban = 0;
                                                $jumlahkewajiban = 0;
                                                $totalkewajiban = 0;
                                                foreach ($akunkewajiban6 as $dataAkunkewajiban6) :
                                                    $idAkunkewajiban = $dataAkunkewajiban6['a6level_id'];
                                                    $posisiKewajiban = $dataAkunkewajiban6['posisi'];
                                                    $jumlahkewajiban = ambilsaldoawal($idtahun, $idAkunkewajiban, $posisiKewajiban);
                                                    $totalkewajiban = $totalkewajiban + $jumlahkewajiban;
                                            ?>
                                                    <tr>
                                                        <td class="text-center"></td>
                                                        <td width="10%"><?= $dataAkunkewajiban6['a6level_id']; ?></td>
                                                        <td colspan="2" class="text-md"><?= $dataAkunkewajiban6['level6']; ?></td>
                                                        <td class="text-center"><?= posisi_akun($dataAkunkewajiban6['posisi']); ?></td>
                                                        <td class="text-right">
                                                            <?= rupiah_positif($jumlahkewajiban); ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <a href="" class="btn-edit-saldoawal" data-akunid="<?= $dataAkunkewajiban6['a6level_id']; ?>" data-thbukuid="<?= $idtahun; ?>" data-posisi="<?= $posisiKewajiban; ?>" data-info="<?= $dataAkunkewajiban6['level6']; ?>" data-toggle="tooltip" data-placement="bottom" title="Edit"><i class="fas fa-edit" style="color: olive"></i></a> - <a href="" class="btn-hapus-saldoawal" data-akunid="<?= $dataAkunkewajiban6['a6level_id']; ?>" data-thbukuid="<?= $idtahun; ?>" data-info="<?= $dataAkunkewajiban6['level6']; ?>" data-toggle="tooltip" data-placement="bottom" title="Hapus Saldo"> <i class="far fa-trash-alt" style="color: maroon"></i></a>
                                                        </td>
                                                    </tr>
                                            <?php
                                                endforeach;
                                            }
                                            ?>
                                        <?php
                                        endforeach;
                                        ?>
                                        <tr>
                                            <td class="text-center"></td>
                                            <td colspan="4" class="text-md">SUB JUMLAH</td>
                                            <td class="text-right"><?= rupiah_positif($totalkewajiban) ?></td>
                                            <td></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                    <?php
                                    $level13 = $this->Kodeperkiraan_model->asetbersihsaldo();
                                    if ($level13) {
                                        foreach ($level13 as $dataLevel13) :
                                            $idLevel13 = $dataLevel13['id'];
                                    ?>
                                            <tr>
                                                <td class="text-center">3</td>
                                                <td colspan="6" class="text-uppercase text-md"><?= $dataLevel13['level1']; ?></td>
                                            </tr>
                                            <?php
                                            $dataAkunbersih6 = $this->Kodeperkiraan_model->akunlevel6saldo($idLevel13);
                                            if ($dataAkunbersih6) {
                                                $saldobersih = 0;
                                                $jumlahbersih = 0;
                                                $totalbersih = 0;
                                                foreach ($dataAkunbersih6 as $dataAkunbersih6) :
                                                    $idAkunbersih = $dataAkunbersih6['a6level_id'];
                                                    $posisiBersih = $dataAkunbersih6['posisi'];
                                                    $jumlahbersih = ambilsaldoawal($idtahun, $idAkunbersih, $posisiBersih);
                                                    $totalbersih = $totalbersih + $jumlahbersih;
                                            ?>
                                                    <tr>
                                                        <td class="text-center"></td>
                                                        <td width="10%"><?= $dataAkunbersih6['a6level_id']; ?></td>
                                                        <td colspan="2" class="text-md"><?= $dataAkunbersih6['level6']; ?></td>
                                                        <td class="text-center"><?= posisi_akun($dataAkunbersih6['posisi']); ?></td>
                                                        <td class="text-right">
                                                            <?= rupiah_positif($jumlahbersih); ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <a href="" class="btn-edit-saldoawal" data-akunid="<?= $dataAkunbersih6['a6level_id']; ?>" data-thbukuid="<?= $idtahun; ?>" data-posisi="<?= $posisiBersih; ?>" data-info="<?= $dataAkunbersih6['level6']; ?>" data-toggle="tooltip" data-placement="bottom" title="Edit"><i class="fas fa-edit" style="color: olive"></i></a> - <a href="" class="btn-hapus-saldoawal" data-akunid="<?= $dataAkunbersih6['a6level_id']; ?>" data-thbukuid="<?= $idtahun; ?>" data-info="<?= $dataAkunbersih6['level6']; ?>" data-toggle="tooltip" data-placement="bottom" title="Hapus Saldo"> <i class="far fa-trash-alt" style="color: maroon"></i></a>
                                                        </td>
                                                    </tr>
                                            <?php
                                                endforeach;
                                            }
                                            ?>
                                        <?php
                                        endforeach;
                                        ?>
                                        <tr>
                                            <td class="text-center"></td>
                                            <td colspan="4" class="text-md">SUB JUMLAH</td>
                                            <td class="text-right text-md"><?= rupiah_positif($totalbersih); ?></td>
                                            <td></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                    <tr>
                                        <td colspan="5" class="text-uppercase font-weight-bolder text-md">Jumlah Kewajiban dan Aset Bersih</td>
                                        <td class="text-right font-weight-bolder">
                                            <?php
                                            $totalABkewajiban = $totalkewajiban + $totalbersih;
                                            echo rupiah_positif($totalABkewajiban);
                                            ?>
                                        </td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                            <?php
                            $totalA = input_uang($totalaset);
                            $totalAB = input_uang($totalABkewajiban);
                            if ($totalA <> 0 && $totalAB <> 0) {
                                if ($totalA == $totalAB) {
                            ?>
                                    <div class="row my-3">
                                        <div class="col-md-12">
                                            <div class="mx-auto" style="width: 200px;">
                                                <a href="<?= site_url('akuntansi/saldoawal/konfirmasi/') ?><?= $idtahun; ?>" class="btn btn-md btn-primary text-white"> Konfirmasi</a>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                }
                            }
                            ?>
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
        <?php $this->load->view('akuntansi/saldoawal/modal');
        ?>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->