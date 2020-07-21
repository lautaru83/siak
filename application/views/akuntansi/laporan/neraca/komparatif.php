<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-gradient-light">
                <div>
                    <h4 class="card-title">
                        Neraca Komparatif
                    </h4>
                </div>
                <div class="float-right">
                </div>
            </div>
            <div class="card-body">
                <?php

                //var_dump($kewajiban);
                ?>
                <?php
                $pembukuan = $pembukuan_id;
                $format = "years";
                $jml = -1;
                $buku_awalA = $awalbuku;
                $buku_awalB = manipulasiTanggal($buku_awalA, $jml, $format);
                $tanggallalu = manipulasiTanggal($tanggal, $jml, $format);
                $tahunlalu = manipulasiTahun($tanggal, $jml, $format);
                if ($neraca) {
                ?>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <span class="text-uppercase font-weight-bolder"><?php if ($institusi) {
                                                                                echo $institusi['keterangan'];
                                                                            } ?></span>
                        </div>
                        <div class="col-md-12 text-center">
                            <span class="font-weight-bolder">NERACA</span>
                        </div>
                    </div>
                    <table id="tabel3" class="table table-sm table-borderless table-hover">
                        <thead>
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-center" colspan="4">
                                    Untuk Tahun Yang Berakhir <?= format_indo($akhirbuku); ?> dan <?= $tahunlalu; ?><br>
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
                                <td class="text-center"></td>
                                <td class="text-center">
                                    <span>Catatan</span>
                                </td>
                                <td width="15%" class="text-center font-weight-normal">
                                    <span class="font-weight-normal my-auto">
                                        <?= format_indo($tanggal); ?>
                                    </span>
                                    <div class="border-top my-1">(Rp)</div>
                                </td>
                                <td width="15%" class="text-center">
                                    <span class="font-weight-normal my-auto">
                                        <?= format_indo($tanggallalu); ?>
                                        <div class="border-top my-1"></div>
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
                            $jumlahAsetLancarA = 0;
                            $totalAsetLancarA = 0;
                            $jumlahDebetA = 0;
                            $jumlahKreditA = 0;
                            $jumlahAsetLancarB = 0;
                            $totalAsetLancarB = 0;
                            $jumlahDebetB = 0;
                            $jumlahKreditB = 0;
                            if ($asetLancar) {
                                foreach ($asetLancar as $dataAsetLancar) :
                                    $posisi = $dataAsetLancar['posisi'];
                                    //2020
                                    $jumlahDebetA = $dataAsetLancar['debetA'];
                                    $jumlahKreditA = $dataAsetLancar['kreditA'];
                                    $jumlahAsetLancarA = $jumlahDebetA - $jumlahKreditA;
                                    $totalAsetLancarA = $totalAsetLancarA + $jumlahAsetLancarA;
                                    //2019
                                    $jumlahDebetB = $dataAsetLancar['debetB'];
                                    $jumlahKreditB = $dataAsetLancar['kreditB'];
                                    $jumlahAsetLancarB = $jumlahDebetB - $jumlahKreditB;
                                    $totalAsetLancarB = $totalAsetLancarB + $jumlahAsetLancarB;
                            ?>
                                    <tr>
                                        <td class="text-center"></td>
                                        <td>
                                            <div class="font-weight-normal my-auto pl-4"><?= $dataAsetLancar['level3']; ?></div>
                                        </td>
                                        <td class="text-center"><?= $dataAsetLancar['catatan_id']; ?></td>
                                        <td class="text-right"><?= rupiah_positif($jumlahAsetLancarA); ?></td>
                                        <td class="text-right"><?= rupiah_positif($jumlahAsetLancarB); ?></td>
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
                                <td class="border-top border-bottom text-right">
                                    <?= rupiah_positif($totalAsetLancarA); ?>
                                </td>
                                <td class="border-top border-bottom text-right">
                                    <?= rupiah_positif($totalAsetLancarB); ?>
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
                            $jumlahAsetTidakLancarA = 0;
                            $totalAsetTidakLancarA = 0;
                            $jumlahDebetA = 0;
                            $jumlahKreditA = 0;
                            $jumlahAsetTidakLancarB = 0;
                            $totalAsetTidakLancarB = 0;
                            $jumlahDebetB = 0;
                            $jumlahKreditB = 0;
                            if ($asetTidakLancar) {
                                foreach ($asetTidakLancar as $dataAsetTidakLancar) :
                                    $posisi = $dataAsetTidakLancar['posisi'];
                                    //2020
                                    $jumlahDebetA = $dataAsetTidakLancar['debetA'];
                                    $jumlahKreditA = $dataAsetTidakLancar['kreditA'];
                                    $jumlahAsetTidakLancarA = $jumlahDebetA - $jumlahKreditA;
                                    $totalAsetTidakLancarA = $totalAsetTidakLancarA + $jumlahAsetTidakLancarA;
                                    //2019
                                    $jumlahDebetB = $dataAsetTidakLancar['debetB'];
                                    $jumlahKreditB = $dataAsetTidakLancar['kreditB'];
                                    $jumlahAsetTidakLancarB = $jumlahDebetB - $jumlahKreditB;
                                    $totalAsetTidakLancarB = $totalAsetTidakLancarB + $jumlahAsetTidakLancarB;
                            ?>
                                    <tr>
                                        <td class="text-center"></td>
                                        <td>
                                            <div class="font-weight-normal my-auto pl-4"><?= $dataAsetTidakLancar['level3']; ?></div>
                                        </td>
                                        <td class="text-center"><?= $dataAsetTidakLancar['catatan_id']; ?></td>
                                        <td class="text-right"><?= rupiah_positif($jumlahAsetTidakLancarA); ?></td>
                                        <td class="text-right"><?= rupiah_positif($jumlahAsetTidakLancarB); ?></td>
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
                                <td class="border-top border-top  text-right">
                                    <?= rupiah_positif($totalAsetTidakLancarA); ?>
                                </td>
                                <td class="border-top border-top  text-right">
                                    <?= rupiah_positif($totalAsetTidakLancarB); ?>
                                </td>
                                <td class="text-right"></td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td colspan="2">
                                    <span class="font-weight-bolder text-md">JUMLAH ASET</span>
                                </td>
                                <td class="border-top border-bottom  text-right">
                                    <span class="font-weight-bolder">
                                        <?php
                                        $jumlahAsetA = $totalAsetLancarA + $totalAsetTidakLancarA;
                                        echo rupiah_positif($jumlahAsetA);
                                        ?>
                                    </span>
                                </td>
                                <td class="border-top border-bottom  text-right">
                                    <span class="font-weight-bolder">
                                        <?php
                                        $jumlahAsetB = $totalAsetLancarB + $totalAsetTidakLancarB;
                                        echo rupiah_positif($jumlahAsetB);
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
                            $jumlahKewajibanA = 0;
                            $totalKewajibanA = 0;
                            $jumlahDebetA = 0;
                            $jumlahKreditA = 0;
                            $jumlahKewajibanB = 0;
                            $totalKewajibanB = 0;
                            $jumlahDebetB = 0;
                            $jumlahKreditB = 0;
                            if ($kewajiban) {
                                foreach ($kewajiban as $dataKewajiban) :
                                    $posisi = $dataKewajiban['posisi'];
                                    //2020
                                    $jumlahDebetA = $dataKewajiban['debetA'];
                                    $jumlahKreditA = $dataKewajiban['kreditA'];
                                    $jumlahKewajibanA = $jumlahKreditA - $jumlahDebetA;
                                    $totalKewajibanA = $totalKewajibanA + $jumlahKewajibanA;
                                    //2019
                                    $jumlahDebetB = $dataKewajiban['debetB'];
                                    $jumlahKreditB = $dataKewajiban['kreditB'];
                                    $jumlahKewajibanB = $jumlahKreditB - $jumlahDebetB;
                                    $totalKewajibanB = $totalKewajibanB + $jumlahKewajibanB;
                            ?>
                                    <tr>
                                        <td class="text-center"></td>
                                        <td>
                                            <div class="font-weight-normal my-auto pl-4"><?= $dataKewajiban['level3']; ?></div>
                                        </td>
                                        <td class="text-center"><?= $dataKewajiban['catatan_id']; ?></td>
                                        <td class="text-right"><?= rupiah_positif($jumlahKewajibanA); ?></td>
                                        <td class="text-right"><?= rupiah_positif($jumlahKewajibanB); ?></td>
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
                                <td class="text-right border-top border-bottom">
                                    <?= rupiah_positif($totalKewajibanA); ?>
                                </td>
                                <td class="text-right border-top border-bottom">
                                    <?= rupiah_positif($totalKewajibanB); ?>
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
                            $jumlahAbttA = 0;
                            $jumlahBersihTidakTerikatA = 0;
                            $totalBersihTidakTerikatA = 0;
                            $jumlahDebetA = 0;
                            $jumlahKreditA = 0;
                            $jumlahAbttB = 0;
                            $jumlahBersihTidakTerikatB = 0;
                            $totalBersihTidakTerikatB = 0;
                            $jumlahDebetB = 0;
                            $jumlahKreditB = 0;
                            if ($bersihTidakTerikat) {
                                $jumlahAbttA = asetbersihTbKom($buku_awalA, $tanggal, $pembukuan);
                                $jumlahAbttB = asetbersihTbKom($buku_awalB, $tanggallalu, $tahunlalu);
                                foreach ($bersihTidakTerikat as $dataBersihTidakTerikat) :
                                    $posisi = $dataBersihTidakTerikat['posisi'];
                                    $jumlahDebetA = $dataBersihTidakTerikat['debetA'];
                                    $jumlahKreditA = $dataBersihTidakTerikat['kreditA'];
                                    $jumlahDebetB = $dataBersihTidakTerikat['debetB'];
                                    $jumlahKreditB = $dataBersihTidakTerikat['kreditB'];
                                    if ($posisi == "S") {
                                        $jumlahBersihTidakTerikatA = $jumlahKreditA + $jumlahAbttA - $jumlahDebetA;
                                        $jumlahBersihTidakTerikatB = $jumlahKreditB + $jumlahAbttB - $jumlahDebetB;
                                    } else {
                                        $jumlahBersihTidakTerikatA = $jumlahKreditA - $jumlahDebetA;
                                        $jumlahBersihTidakTerikatB = $jumlahKreditB - $jumlahDebetB;
                                    }
                                    $totalBersihTidakTerikatA = $totalBersihTidakTerikatA + $jumlahBersihTidakTerikatA;
                                    $totalBersihTidakTerikatB = $totalBersihTidakTerikatB + $jumlahBersihTidakTerikatB;
                            ?>
                                    <tr>
                                        <td class="text-center"></td>
                                        <td>
                                            <div class="font-weight-normal my-auto pl-4"><?= $dataBersihTidakTerikat['level3']; ?></div>
                                        </td>
                                        <td class="text-center"><?= $dataBersihTidakTerikat['catatan_id']; ?></td>
                                        <td class="text-right"><?= rupiah_positif($jumlahBersihTidakTerikatA); ?></td>
                                        <td class="text-right"><?= rupiah_positif($jumlahBersihTidakTerikatB); ?></td>
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
                                <td class="text-right border-top border-bottom"><?= rupiah_positif($totalBersihTidakTerikatA); ?></td>
                                <td class="text-right border-top border-bottom"><?= rupiah_positif($totalBersihTidakTerikatB); ?></td>
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
                            $jumlahBersihTerikatA = 0;
                            $totalBersihTerikatA = 0;
                            $jumlahDebetA = 0;
                            $jumlahKreditA = 0;
                            $jumlahBersihTerikatB = 0;
                            $totalBersihTerikatB = 0;
                            $jumlahDebetB = 0;
                            $jumlahKreditB = 0;
                            if ($bersihTerikat) {
                                foreach ($bersihTerikat as $dataBersihTerikat) :
                                    $posisi = $dataBersihTerikat['posisi'];
                                    //Tahun sekarang
                                    $jumlahDebetA = $dataBersihTerikat['debetA'];
                                    $jumlahKreditA = $dataBersihTerikat['kreditA'];
                                    $jumlahBersihTerikatA = $jumlahKreditA - $jumlahDebetA;
                                    $totalBersihTerikatA = $totalBersihTerikatA + $jumlahBersihTerikatA;
                                    //tahunlalu
                                    $jumlahDebetB = $dataBersihTerikat['debetB'];
                                    $jumlahKreditB = $dataBersihTerikat['kreditB'];
                                    $jumlahBersihTerikatB = $jumlahKreditB - $jumlahDebetB;
                                    $totalBersihTerikatB = $totalBersihTerikatB + $jumlahBersihTerikatB;
                            ?>
                                    <tr>
                                        <td class="text-center"></td>
                                        <td>
                                            <div class="font-weight-normal my-auto pl-4"><?= $dataBersihTerikat['level3']; ?></div>
                                        </td>
                                        <td class="text-center"><?= $dataBersihTerikat['catatan_id']; ?></td>
                                        <td class="text-right"><?= rupiah_positif($jumlahBersihTerikatA); ?></td>
                                        <td class="text-right"><?= rupiah_positif($jumlahBersihTerikatB); ?></td>
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

                                <td class="text-right border-top border-bottom">
                                    <?= rupiah_positif($totalBersihTerikatA); ?>
                                </td>
                                <td class="text-right border-top border-bottom">
                                    <?= rupiah_positif($totalBersihTerikatB); ?>
                                </td>
                                <td class="text-right"></td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td colspan="2">
                                    <span class="font-weight-bolder text-md">JUMLAH KEWAJIBAN DAN ASET BERSIH</span>
                                </td>
                                <td class="text-right border-top border-bottom">
                                    <span class="font-weight-bolder">
                                        <?php
                                        $jumlahKewajibanBersihA = $totalKewajibanA + $totalBersihTidakTerikatA + $totalBersihTerikatA;
                                        echo rupiah_positif($jumlahKewajibanBersihA);
                                        ?>
                                    </span>
                                </td>
                                <td class="text-right border-top border-bottom">
                                    <span class="font-weight-bolder">
                                        <?php
                                        $jumlahKewajibanBersihB = $totalKewajibanB + $totalBersihTidakTerikatB + $totalBersihTerikatB;
                                        echo rupiah_positif($jumlahKewajibanBersihB);
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