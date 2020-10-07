<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-gradient-light d-print-none">
                <div>
                    <h4 class="card-title">
                        Realisasi Anggaran
                    </h4>
                </div>
                <div class="float-right">
                </div>
            </div>
            <div class="card-body">
                <?php
                if ($realisasi) {
                ?>
                    <div class="row">
                        <!-- <div class="col-sm-1"></div> -->
                        <div class="col-sm-12">
                            <div class="mt-2 mx-5">
                                <div class="row">
                                    <div class="col-md-12 text-md text-center">
                                        <span class="font-weight-bolder">ANGGARAN PENDAPATAN DAN BELANJA</span>
                                    </div>
                                    <div class="col-md-12 text-md text-center">
                                        <span class="text-uppercase font-weight-bolder"><?php if ($institusi) {
                                                                                            echo $institusi['keterangan'];
                                                                                        } ?></span>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        TAHUN ANGGARAN <?= $this->session->userdata('tahun_anggaran'); ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <hr>
                                    </div>
                                </div>
                                <div class="row">
                                    <table id="tabel3" class="table table-sm table-borderless table-hover">
                                        <thead>
                                            <tr>
                                                <td class="text-center"></td>
                                                <td class="text-center" width="90%" colspan="4">
                                                </td>
                                                <td class="text-center"></td>
                                            </tr>
                                            <!-- <tr>
                                <td class="text-center"></td>
                                <td class="text-center" colspan="4"></td>
                                <td class="text-center"></td>
                            </tr> -->
                                            <tr>
                                                <td class="text-center"></td>
                                                <td class="text-center" colspan="2"></td>
                                                <td width="15%" class="text-center font-weight-normal">
                                                    <!-- <span class="font-weight-normal my-auto">Catatan</span>
                                    <div class="border-top my-1"></div> -->
                                                </td>
                                                <td width="18%" class="text-center">
                                                    <span class="font-weight-normal my-auto"><?= format_indo($tanggal); ?><div class="border-top my-1"></div>
                                                        <div class="my-1"></div>
                                                    </span>
                                                </td>
                                                <td class="text-center"></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="row my-1"></div>
                                                </td>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <div class="row">
                                    <table class="table table-sm table-bordered table-hover">
                                        <thead>
                                            <tr class="">
                                                <td class="text-center" width="5%">No</td>
                                                <td colspan="2">Kegiatan Anggaran</td>
                                                <td width="15%" class="text-center">Anggaran</td>
                                                <td width="15%" class="text-center">Realisasi</td>
                                                <td width="15%" class="text-center">Saldo</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $kelDebet = 0.00;
                                            $kelKredit = 0.00;
                                            $reDebet = 0.00;
                                            $reKredit = 0.00;
                                            $sisaDebet = 0.00;
                                            $sisaKredit = 0.00;
                                            if ($kelompok) {
                                                $no = 1;
                                                $jmlrealisasiKel = 0.00;
                                                $saldoKel = 0.00;

                                                foreach ($kelompok as $dataKelompok) :
                                                    $idKelompok = $dataKelompok['kelompok_id'];
                                                    $resaldoKel = $dataKelompok['resaldo'];
                                                    $posisiKel = $dataKelompok['posisi'];
                                                    $terealisasiKel = $dataKelompok['terealisasi'];
                                                    $jmlrealisasiKel = realisasiKel($awalbuku, $tanggal, $tahunanggaran_id, $idKelompok);
                                                    $jmlKel = $terealisasiKel + $jmlrealisasiKel;
                                                    $saldoKel = $resaldoKel - $jmlKel;
                                                    if ($posisiKel == "D") {
                                                        $kelDebet = $kelDebet + $resaldoKel;
                                                        $reDebet = $reDebet + $jmlKel;
                                                        $sisaDebet = $sisaDebet + $saldoKel;
                                                    } else {
                                                        $kelKredit = $kelKredit + $resaldoKel;
                                                        $reKredit = $reKredit + $jmlKel;
                                                        $sisaKredit = $sisaKredit + $saldoKel;
                                                    }

                                            ?>
                                                    <tr class="bg-light">
                                                        <td class="text-center" width="5%"><?= txt_roman($no); ?></td>
                                                        <td colspan="2" class="text-uppercase"><?= $dataKelompok['kelompok'] ?></td>
                                                        <td class="text-right"><?= rupiah_positif($resaldoKel); ?></td>
                                                        <td class="text-right"><?= rupiah_positif($jmlKel); ?></td>
                                                        <td class="text-right"><?= rupiah_positif($saldoKel); ?></td>
                                                    </tr>
                                                    <?php
                                                    $noA = 1;
                                                    $jmlrealisasiAng = 0.00;
                                                    $saldoAng = 0.00;
                                                    $daftar = $this->Laporan_model->daftarAnggaran($idKelompok, $tahunanggaran_id);
                                                    if ($daftar) {
                                                        foreach ($daftar as $dataDaftar) :
                                                            $resaldo = $dataDaftar['resaldo'];
                                                            $terealisasi = $dataDaftar['terealisasi'];
                                                            $idAng = $dataDaftar['rencana_id'];
                                                            $jmlrealisasiAng = realisasiAng($awalbuku, $tanggal, $tahunanggaran_id, $idAng);
                                                            $jmlAng = $terealisasi + $jmlrealisasiAng;
                                                            $saldoAng = $resaldo - $jmlAng;
                                                    ?>
                                                            <tr class="">
                                                                <td class="text-center" width="5%"></td>
                                                                <td class="text-center" width="5%"><?= $noA; ?></td>
                                                                <td><?= $dataDaftar['rencana'] ?></td>
                                                                <td class="text-right"><?= rupiah_positif($resaldo); ?></td>
                                                                <td class="text-right"><?= rupiah_positif($jmlAng); ?></td>
                                                                <td class="text-right"><?= rupiah_positif($saldoAng); ?></td>
                                                            </tr>
                                                    <?php
                                                            $noA++;
                                                        endforeach;
                                                    }

                                                    ?>

                                            <?php
                                                    $no++;
                                                endforeach;
                                            }
                                            $saldoanggaran = 0.00;
                                            $saldorealisasi = 0.00;
                                            $saldosurplus = 0.00;
                                            $saldoanggaran = $kelKredit - $kelDebet;
                                            $saldorealisasi = $reKredit - $reDebet;
                                            $saldosurplus = $sisaKredit - $sisaDebet;
                                            ?>
                                            <tr class="bg-light">
                                                <td class="text-center" width="5%"></td>
                                                <td colspan="2">SALDO</td>
                                                <td class="text-right"><?= rupiah_positif($saldoanggaran); ?></td>
                                                <td class="text-right"><?= rupiah_positif($saldorealisasi); ?></td>
                                                <td class="text-right"><?= rupiah_positif($saldosurplus); ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-sm-1"></div> -->
                    </div>
                <?php } ?>
                <?php
                //var_dump($daftar);
                ?>
            </div>
            <!-- /.card-body -->

        </div>
        <!-- /.card -->
    </div>
    <!-- /.col-md-12 -->
</div>
<!-- /.row -->