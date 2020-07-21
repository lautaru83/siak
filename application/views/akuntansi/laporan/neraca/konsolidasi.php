<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-gradient-light">
                <div>
                    <h4 class="card-title">
                        Neraca Konsolidasi
                    </h4>
                </div>
                <div class="float-right">
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div style="height: 25px;">
                    </div>
                </div>
                <?php
                //var_dump($asetTidakLancar);
                ?>
                <?php
                if ($neraca) {
                ?>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <span class="text-uppercase font-weight-bolder"><?php if ($institusi) {
                                                                                echo $institusi['keterangan'];
                                                                            } ?></span>
                        </div>
                        <div class="col-md-12 text-center">
                            <span class="font-weight-bolder">NERACA KONSOLIDASI</span>
                        </div>
                    </div>
                    <table id="tabel3" class="table table-sm table-borderless table-hover">
                        <thead>
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-center" colspan="4">
                                    Untuk Tahun Yang Berakhir <?= format_indo($akhirbuku); ?><br>
                                    (Dinyatakan dalam Rupiah, kecuali dinyatakan lain)

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
                                <td width="15%" class="text-center font-weight-normal">
                                    <span class="font-weight-normal my-auto">Catatan</span>
                                    <div class="border-top my-1"></div>
                                </td>
                                <td width="15%" class="text-center">
                                    <span class="font-weight-normal my-auto"><?= format_indo($tanggal); ?><div class="border-top my-1"></div>
                                        <div class="my-1">(Rp)</div>
                                    </span>
                                </td>
                                <td class="text-center"></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center"></td>
                                <td colspan="4">
                                    <span class="font-weight-bolder text-md">ASET</span>
                                </td>
                                <td class="text-right"></td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td colspan="4">
                                    <span class="font-weight-bolder text-md">Aset Lancar</span>
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
                                    <span class="font-weight-normal pl-4">Jumlah Aset Lancar</span>
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
                                    <span class="font-weight-bolder text-md">Aset Tidak Lancar</span>
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
                                    <span class="font-weight-normal my-auto pl-4 ">Jumlah Aset Tidak Lancar</span>
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
                                    <span class="font-weight-bolder text-md">JUMLAH ASET</span>
                                </td>
                                <td class="border-top border-bottom  text-right">
                                    <span class="font-weight-bolder">
                                        <?php
                                        $jumlahAset = $totalAsetLancar + $totalAsetTidakLancar;
                                        echo rupiah_positif($jumlahAset);
                                        ?>
                                    </span>
                                </td>
                                <td class="text-right"></td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td colspan="4">
                                    <span class="font-weight-bolder text-md">KEWAJIBAN DAN ASET BERSIH</span>
                                </td>
                                <td class="text-right"></td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td colspan="4">
                                    <span class="font-weight-bolder text-md">KEWAJIBAN</span>
                                </td>
                                <td class="text-right"></td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td colspan="4">
                                    <span class="font-weight-bolder text-md">Kewajiban Jangka Pendek</span>
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
                                    <span class="font-weight-normal my-auto pl-4">Jumlah Kewajiban</span>
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
                                    <span class="font-weight-bolder text-md">ASET BERSIH</span>
                                </td>
                                <td class="text-right"></td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td colspan="4">
                                    <span class="font-weight-bolder text-md">Aset Bersih Tidak Terikat</span>
                                </td>
                                <td class="text-right"></td>
                            </tr>
                            <?php
                            $jumlahAbtt = 0;
                            $jumlahBersihTidakTerikat = 0;
                            $totalBersihTidakTerikat = 0;
                            $jumlahDebet = 0;
                            $jumlahKredit = 0;
                            if ($bersihTidakTerikat) {
                                $jumlahAbtt = asetbersihTbKonsolidasi($tanggal);
                                foreach ($bersihTidakTerikat as $dataBersihTidakTerikat) :
                                    $posisi = $dataBersihTidakTerikat['posisi'];
                                    $jumlahDebet = $dataBersihTidakTerikat['debet'];
                                    $jumlahKredit = $dataBersihTidakTerikat['kredit'];
                                    if ($posisi == "S") {
                                        $jumlahBersihTidakTerikat = $jumlahKredit + $jumlahAbtt - $jumlahDebet;
                                    } else {
                                        $jumlahBersihTidakTerikat = $jumlahKredit - $jumlahDebet;
                                    }
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
                                    <span class="font-weight-bolder text-md">Aset Bersih Terikat</span>
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
                                    <h6 class="my-auto pl-4">Jumlah Aset Bersih Terikat</h6>
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
                                    <span class="font-weight-bolder text-md">JUMLAH KEWAJIBAN DAN ASET BERSIH</span>
                                </td>
                                <td class="text-right border-top border-bottom">
                                    <span class="font-weight-bolder">
                                        <?php
                                        $jumlahKewajibanBersih = $totalKewajiban + $totalBersihTidakTerikat + $totalBersihTerikat;
                                        echo rupiah_positif($jumlahKewajibanBersih);
                                        ?>
                                    </span>
                                </td>
                                <td class="text-right"></td>
                            </tr>
                        </tbody>
                    </table>
                <?php } ?>
                <div class="row invisible">
                    <div class="col-sm-12 text-center">
                        <form method="POST" action="<?= base_url('akuntansi/neraca/cetakdata'); ?>" target="_blank">
                            <input type="hidden" id="laporan" name="laporan" value="<?= $jenislap; ?>">
                            <input type="hidden" id="bukuawal" name="bukuawal" value="<?= $awalbuku; ?>">
                            <input type="hidden" id="bukuakhir" name="bukuakhir" value="<?= $akhirbuku; ?>">
                            <input type="hidden" id="tgl1" name="tgl1" value="<?= $awalbuku; ?>">
                            <input type="hidden" id="tgl2" name="tgl2" value="<?= $tanggal; ?>">
                            <input type="hidden" id="pembukuan_id" name="pembukuan_id" value="<?= $pembukuan_id; ?>">
                            <button type="submit" id="btn-cetak-neraca" class="btn btn-link">Tampilkan</button>
                        </form>
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