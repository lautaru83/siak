<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-gradient-light">
                <div>
                    <h4 class="card-title">
                        Neraca Institusi
                    </h4>
                </div>
                <div class="float-right">
                </div>
            </div>
            <div class="card-body bg-gradient-light">
                <div class="row bg-gradient-light">
                    <div style="height: 25px;">
                    </div>
                </div>
                <?php
                //var_dump($asetTidakLancar);
                ?>
                <?php
                if ($neraca) {
                ?>
                    <table id="tabel3" class="table table-sm table-borderless table-hover">
                        <thead>
                            <tr>
                                <td width="5%" class="text-center"></td>
                                <td class="text-center" colspan="4">
                                    <h4> LAPORAN NERACA</h4>
                                </td>
                                <td width="5%" class="text-center"></td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-center" colspan="4">Untuk Tahun Yang Berakhir <?= format_indo($this->session->userdata('buku_akhir')); ?></td>
                                <td class="text-center"></td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-center" colspan="4">(Dinyatakan dalam Rupiah, kecuali dinyatakan lain)</td>
                                <td class="text-center"></td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-center border-bottom" colspan="4"></td>
                                <td class="text-center"></td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-center border-top" colspan="4"></td>
                                <td class="text-center"></td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-center" colspan="2"></td>
                                <td width="15%" class="text-center font-weight-normal my-1">
                                    Catatan<div class="border-top"></div>
                                    <div class="my-2"></div>
                                </td>
                                <td width="15%" class="text-center">
                                    <h6 class="font-weight-normal my-auto">Per <?= format_indo($tanggal); ?><div class="border-top my-1"></div>
                                        <div class="my-1">(Rp.)</div>
                                    </h6>
                                </td>
                                <td class="text-center"></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center"></td>
                                <td colspan="4">
                                    <h6 class="font-weight-bolder my-auto">ASET</h6>
                                </td>
                                <td class="text-right"></td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td colspan="4">
                                    <h6 class="font-weight-bolder my-auto">Aset Lancar</h6>
                                </td>
                                <td class="text-right"></td>
                            </tr>
                            <?php
                            $jumlahAsetLancar = 0;
                            $totalAsetLancar = 0;
                            $jumlahDebet = 0;
                            $jumlahKredit = 0;
                            if ($asetLancar) {
                                foreach ($asetLancar as $dataAsetLancar) :
                                    $posisi = $dataAsetLancar['posisi'];
                                    $jumlahDebet = $dataAsetLancar['debet'];
                                    $jumlahKredit = $dataAsetLancar['kredit'];
                                    $jumlahAsetLancar = $jumlahDebet - $jumlahKredit;
                                    $totalAsetLancar = $totalAsetLancar + $jumlahAsetLancar;
                            ?>
                                    <tr>
                                        <td class="text-center"></td>
                                        <td colspan="2">
                                            <div class="font-weight-normal my-auto pl-4"><?= $dataAsetLancar['level3']; ?></div>
                                        </td>
                                        <td class="text-center"><?= $dataAsetLancar['catatan_id']; ?></td>
                                        <td class="text-right"><?= rupiah_positif($jumlahAsetLancar); ?></td>
                                        <td class="text-right"></td>
                                    </tr>
                            <?php
                                endforeach;
                            }
                            ?>
                            <tr>
                                <td class="text-center"></td>
                                <td colspan="2">
                                    <h6 class="font-weight-normal my-auto pl-4">Jumlah Aset Lancar</h6>
                                </td>
                                <td></td>
                                <td class="border-top border-bottom text-right">
                                    <?= rupiah_positif($totalAsetLancar); ?>
                                </td>
                                <td class="text-right"></td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td colspan="4">
                                    <h6 class="font-weight-bolder my-auto">Aset Tidak Lancar</h6>
                                </td>
                                <td class="text-right"></td>
                            </tr>
                            <?php
                            $jumlahAsetTidakLancar = 0;
                            $totalAsetTidakLancar = 0;
                            $jumlahDebet = 0;
                            $jumlahKredit = 0;
                            if ($asetTidakLancar) {
                                foreach ($asetTidakLancar as $dataAsetTidakLancar) :
                                    $posisi = $dataAsetTidakLancar['posisi'];
                                    $jumlahDebet = $dataAsetTidakLancar['debet'];
                                    $jumlahKredit = $dataAsetTidakLancar['kredit'];
                                    $jumlahAsetTidakLancar = $jumlahDebet - $jumlahKredit;
                                    $totalAsetTidakLancar = $totalAsetTidakLancar + $jumlahAsetTidakLancar;
                            ?>
                                    <tr>
                                        <td class="text-center"></td>
                                        <td colspan="2">
                                            <div class="font-weight-normal my-auto pl-4"><?= $dataAsetTidakLancar['level3']; ?></div>
                                        </td>
                                        <td class="text-center"><?= $dataAsetTidakLancar['catatan_id']; ?></td>
                                        <td class="text-right"><?= rupiah_positif($jumlahAsetTidakLancar); ?></td>
                                        <td class="text-right"></td>
                                    </tr>
                            <?php
                                endforeach;
                            }
                            ?>
                            <tr>
                                <td class="text-center"></td>
                                <td colspan="2">
                                    <h6 class="font-weight-normal my-auto pl-4 ">Jumlah Aset Tidak Lancar</h6>
                                </td>
                                <td></td>
                                <td class="border-top border-top  text-right">
                                    <?= rupiah_positif($totalAsetTidakLancar); ?>
                                </td>
                                <td class="text-right"></td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td colspan="3">
                                    <h6 class="font-weight-bolder my-auto">JUMLAH ASET</h6>
                                </td>
                                <td class="border-top border-bottom font-weight-bolder text-right">
                                    <?php
                                    $jumlahAset = $totalAsetLancar + $totalAsetTidakLancar;
                                    echo rupiah_positif($jumlahAset);
                                    ?>
                                </td>
                                <td class="text-right"></td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td colspan="4">
                                    <h6 class="font-weight-bolder my-auto">KEWAJIBAN DAN ASET BERSIH</h6>
                                </td>
                                <td class="text-right"></td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td colspan="4">
                                    <h6 class="font-weight-bolder my-auto">KEWAJIBAN</h6>
                                </td>
                                <td class="text-right"></td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td colspan="4">
                                    <h6 class="font-weight-bolder my-auto">Kewajiban Jangka Pendek</h6>
                                </td>
                                <td class="text-right"></td>
                            </tr>
                            <?php
                            $jumlahKewajiban = 0;
                            $totalKewajiban = 0;
                            $jumlahDebet = 0;
                            $jumlahKredit = 0;
                            if ($kewajiban) {
                                foreach ($kewajiban as $dataKewajiban) :
                                    $posisi = $dataKewajiban['posisi'];
                                    $jumlahDebet = $dataKewajiban['debet'];
                                    $jumlahKredit = $dataKewajiban['kredit'];
                                    $jumlahKewajiban = $jumlahKredit - $jumlahDebet;
                                    $totalKewajiban = $totalKewajiban + $jumlahKewajiban;
                            ?>
                                    <tr>
                                        <td class="text-center"></td>
                                        <td colspan="2">
                                            <div class="font-weight-normal my-auto pl-4"><?= $dataKewajiban['level3']; ?></div>
                                        </td>
                                        <td class="text-center"><?= $dataKewajiban['catatan_id']; ?></td>
                                        <td class="text-right "><?= rupiah_positif($jumlahKewajiban); ?></td>
                                        <td class="text-right"></td>
                                    </tr>
                            <?php
                                endforeach;
                            }
                            ?>
                            <tr>
                                <td class="text-center"></td>
                                <td colspan="2">
                                    <h6 class="font-weight-normal my-auto pl-4">Jumlah Kewajiban</h6>
                                </td>
                                <td></td>
                                <td class="text-right border-top border-bottom">
                                    <?= rupiah_positif($totalKewajiban); ?>
                                </td>
                                <td class="text-right"></td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td colspan="4">
                                    <h6 class="font-weight-bolder my-auto">ASET BERSIH</h6>
                                </td>
                                <td class="text-right"></td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td colspan="4">
                                    <h6 class="font-weight-bolder my-auto">Aset Bersih Tidak Terikat</h6>
                                </td>
                                <td class="text-right"></td>
                            </tr>
                            <?php

                            $jumlahBersihTidakTerikat = 0;
                            $totalBersihTidakTerikat = 0;
                            $jumlahDebet = 0;
                            $jumlahKredit = 0;
                            if ($bersihTidakTerikat) {
                                foreach ($bersihTidakTerikat as $dataBersihTidakTerikat) :
                                    $posisi = $dataBersihTidakTerikat['posisi'];
                                    $jumlahDebet = $dataBersihTidakTerikat['debet'];
                                    $jumlahKredit = $dataBersihTidakTerikat['kredit'];
                                    $jumlahBersihTidakTerikat = $jumlahKredit - $jumlahDebet;
                                    $totalBersihTidakTerikat = $totalBersihTidakTerikat + $jumlahBersihTidakTerikat;
                            ?>
                                    <tr>
                                        <td class="text-center"></td>
                                        <td colspan="2">
                                            <div class="font-weight-normal my-auto pl-4"><?= $dataBersihTidakTerikat['level3']; ?></div>
                                        </td>
                                        <td class="text-center"><?php //$dataBersihTidakTerikat['catatan_id']; 
                                                                ?></td>
                                        <td class="text-right"><?= rupiah_positif($jumlahBersihTidakTerikat); ?></td>
                                        <td class="text-right"></td>
                                    </tr>
                            <?php
                                endforeach;
                            }
                            ?>
                            <tr>
                                <td class="text-center"></td>
                                <td colspan="2">
                                    <h6 class="font-weight-normal my-auto pl-4">Jumlah Aset Bersih Tidak Terikat</h6>
                                </td>
                                <td></td>
                                <td class="text-right border-top border-bottom"><?= rupiah_positif($totalBersihTidakTerikat); ?></td>
                                <td class="text-right"></td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td colspan="4">
                                    <h6 class="font-weight-bolder my-auto">Aset Bersih Terikat</h6>
                                </td>
                                <td class="text-right"></td>
                            </tr>
                            <?php
                            $jumlahBersihTerikat = 0;
                            $totalBersihTerikat = 0;
                            $jumlahDebet = 0;
                            $jumlahKredit = 0;
                            if ($bersihTerikat) {
                                foreach ($bersihTerikat as $dataBersihTerikat) :
                                    $posisi = $dataBersihTerikat['posisi'];
                                    $jumlahDebet = $dataBersihTerikat['debet'];
                                    $jumlahKredit = $dataBersihTerikat['kredit'];
                                    $jumlahBersihTerikat = $jumlahKredit - $jumlahDebet;
                                    $totalBersihTerikat = $totalBersihTerikat + $jumlahBersihTerikat;

                            ?>
                                    <tr>
                                        <td class="text-center"></td>
                                        <td colspan="2">
                                            <div class="font-weight-normal my-auto pl-4"><?= $dataBersihTerikat['level3']; ?></div>
                                        </td>
                                        <td class="text-center"><?php //$dataBersihTerikat['catatan_id']; 
                                                                ?></td>
                                        <td class="text-right"><?= rupiah_positif($jumlahBersihTerikat); ?></td>
                                        <td class="text-right"></td>
                                    </tr>
                            <?php
                                endforeach;
                            }
                            ?>
                            <tr>
                                <td class="text-center"></td>
                                <td colspan="2">
                                    <h6 class="font-weight-normal my-auto pl-4">Jumlah Aset Bersih Terikat</h6>
                                </td>
                                <td></td>
                                <td class="text-right border-top border-bottom">
                                    <?= rupiah_positif($totalBersihTerikat); ?>
                                </td>
                                <td class="text-right"></td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td colspan="3">
                                    <h6 class="font-weight-bolder my-auto">JUMLAH KEWAJIBAN DAN ASET BERSIH</h6>
                                </td>
                                <td class="font-weight-bolder text-right border-top border-bottom">
                                    <?php
                                    $jumlahKewajibanBersih = $totalKewajiban + $totalBersihTidakTerikat + $totalBersihTerikat;
                                    echo rupiah_positif($jumlahKewajibanBersih);
                                    ?>
                                </td>
                                <td class="text-right"></td>
                            </tr>
                        </tbody>
                    </table>
                <?php } ?>
                <div class="row bg-gradient-light">
                    <div style="height: 25px;">
                    </div>
                </div>
            </div>
            <!-- /.card-body -->

        </div>
        <!-- /.card -->
    </div>
    <!-- /.col-md-12 -->
</div>
<!-- /.row -->