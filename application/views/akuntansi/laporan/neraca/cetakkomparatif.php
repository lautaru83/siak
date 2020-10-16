<!DOCTYPE html>
<html>

<head>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta charset="utf-8">
    <title><?= $judul; ?></title>
    <link href="<?= $_SERVER['DOCUMENT_ROOT'] ?>/siak/dist/css/googleapis/fontsgoogleapiscom.css" type="text/css" rel="stylesheet" />
    <link href="<?= $_SERVER['DOCUMENT_ROOT'] ?>/siak/assets/dist/css/cetak.css" type="text/css" rel="stylesheet" />
</head>

<body>
    <header>
        <table class="tabel-header" width="100%" border="0">
            <tr>
                <td>
                    <strong>SIAK PAGUWARMAS 2.0</strong><br>
                    Sistem Informasi Akuntansi Keuangan
                </td>
                <td width="20%" align="right">
                    <?php echo (date("d-m-Y")); ?>
                </td>
            </tr>
        </table>

    </header>
    <br>
    <?php
    $pembukuan = $pembukuan_id;
    $tanggal = $akhir_periode;
    $format = "years";
    $jml = -1;
    $buku_awalA = $awal_periode;
    $buku_awalB = manipulasiTanggal($buku_awalA, $jml, $format);
    $tanggallalu = manipulasiTanggal($tanggal, $jml, $format);
    $tahunlalu = manipulasiTahun($tanggal, $jml, $format);
    ?>
    <div class="judul-laporan">
        <strong>
            <?php if ($institusi) {
                echo strtoupper($institusi['keterangan']);
            } ?>
        </strong>
        <br>
        <strong>NERACA</strong>
        <br>
        <span>
            Untuk Tahun Yang Berakhir <?= format_indo($akhirbuku); ?> dan <?= $tahunlalu; ?><br>
            (Dinyatakan dalam Rupiah, kecuali dinyatakan lain)
            <?php
            //var_dump($bersihTidakTerikat2);
            //$jumlahAbttA = asetbersihTbKom($buku_awalA, $tanggal, $pembukuan);
            // echo "<br>";
            // echo $jumlahAbttA;
            ?>
        </span>
        <hr>
        <!-- <div style="display: block;border-bottom: 1px;"></div> -->
    </div>
    <table class="tabel-laporan">
        <tr>
            <td></td>
            <td width="10%" align="center" style="border-bottom:solid 1px;">
                <br>
                Catatan
            </td>
            <td width="18%" align="center" style="border-bottom:solid 1px;">
                1 Januari S/d<br>
                <?= format_indo($tanggal); ?>
            </td>
            <td width="18%" align="center" style="border-bottom:solid 1px;">
                1 Januari S/d<br>
                <?= format_indo($tanggallalu); ?>
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td align="center">( Rp. )</td>
            <td align="center">( Rp. )</td>
        </tr>
    </table>
    <br>
    <table class="tabel-laporan">
        <tr>
            <td colspan="4"><strong>ASET</strong></td>
        </tr>
        <tr>
            <td colspan="4"><strong>Aset Lancar</strong></td>
        </tr>
        <?php
        $jumlahAsetLancarA = 0.00;
        $totalAsetLancarA = 0.00;
        $jumlahDebetA = 0.00;
        $jumlahKreditA = 0.00;
        $jumlahAsetLancarB = 0.00;
        $totalAsetLancarB = 0.00;
        $jumlahDebetB = 0.00;
        $jumlahKreditB = 0.00;
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
                    <td class="text-subakun">
                        <?= $dataAsetLancar['level3']; ?>
                    </td>
                    <td width="10%" align="center"><?= $dataAsetLancar['catatan_id']; ?></td>
                    <td width="18%" align="right"><?= rupiah_positif($jumlahAsetLancarA); ?></td>
                    <td width="18%" align="right"><?= rupiah_positif($jumlahAsetLancarB); ?></td>
                </tr>
        <?php
            endforeach;
        }
        ?>
        <tr>
            <td class="text-subakun">
                Jumlah Aset Lancar
            </td>
            <td></td>
            <td align="right" style="border-bottom:solid 1px;border-top:solid 1px;">
                <?= rupiah_positif($totalAsetLancarA); ?>
            </td>
            <td align="right" style="border-bottom:solid 1px;border-top:solid 1px;">
                <?= rupiah_positif($totalAsetLancarB); ?>
            </td>
        </tr>
        <tr>
            <td colspan="4"><strong>Aset Tidak Lancar</strong></td>
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
                    <td class="text-subakun">
                        <?= $dataAsetTidakLancar['level3']; ?>
                    </td>
                    <td width="10%" align="center"><?= $dataAsetTidakLancar['catatan_id']; ?></td>
                    <td width="18%" align="right"><?= rupiah_positif($jumlahAsetTidakLancarA); ?></td>
                    <td width="18%" align="right"><?= rupiah_positif($jumlahAsetTidakLancarB); ?></td>
                </tr>
        <?php
            endforeach;
        }
        ?>
        <tr>
            <td class="text-subakun">
                Jumlah Aset Tidak Lancar
            </td>
            <td></td>
            <td align="right" style="border-bottom:solid 1px;border-top:solid 1px;">
                <?= rupiah_positif($totalAsetTidakLancarA); ?>
            </td>
            <td align="right" style="border-bottom:solid 1px;border-top:solid 1px;">
                <?= rupiah_positif($totalAsetTidakLancarB); ?>
            </td>
        </tr>
        <tr>
            <td><strong>JUMLAH ASET</strong></td>
            <td></td>
            <td align="right" style="border-bottom:solid 0.65mm;">
                <strong>
                    <?php
                    $jumlahAsetA = $totalAsetLancarA + $totalAsetTidakLancarA;
                    echo rupiah_positif($jumlahAsetA);
                    ?>
                </strong>
            </td>
            <td align="right" style="border-bottom:solid 0.65mm;">
                <strong>
                    <?php
                    $jumlahAsetB = $totalAsetLancarB + $totalAsetTidakLancarB;
                    echo rupiah_positif($jumlahAsetB);
                    ?>
                </strong>
            </td>
        </tr>
        <tr>
            <td colspan="4">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="4"><strong>KEWAJIBAN DAN ASET BERSIH</strong></td>
        </tr>
        <tr>
            <td colspan="4"><strong>KEWAJIBAN</strong></td>
        </tr>
        <tr>
            <td colspan="4"><strong>Kewajiban Jangka Pendek</strong></td>
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
                    <td class="text-subakun">
                        <?= $dataKewajiban['level3']; ?>
                    </td>
                    <td align="center"><?= $dataKewajiban['catatan_id']; ?></td>
                    <td align="right"><?= rupiah_positif($jumlahKewajibanA); ?></td>
                    <td align="right"><?= rupiah_positif($jumlahKewajibanB); ?></td>
                </tr>
        <?php
            endforeach;
        }
        ?>
        <tr>
            <td class="text-subakun">
                Jumlah Kewajiban Jangka Pendek
            </td>
            <td></td>
            <td align="right" style="border-bottom:solid 1px;border-top:solid 1px;">
                <?= rupiah_positif($totalKewajibanA); ?>
            </td>
            <td align="right" style="border-bottom:solid 1px;border-top:solid 1px;">
                <?= rupiah_positif($totalKewajibanB); ?>
            </td>
        </tr>
        <tr>
            <td class="text-subakun">
                Jumlah Kewajiban
            </td>
            <td></td>
            <td align="right" style="border-bottom:solid 0.65mm;">
                <?= rupiah_positif($totalKewajibanA); ?>
            </td>
            <td align="right" style="border-bottom:solid 0.65mm;">
                <?= rupiah_positif($totalKewajibanB); ?>
            </td>
        </tr>
        <tr>
            <td colspan="4">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="4"><strong>ASET BERSIH</strong></td>
        </tr>
        <tr>
            <td><strong>Aset Bersih Tidak Terikat</strong></td>
            <td align="center">310</td>
            <td></td>
            <td></td>
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
                    <td class="text-subakun">
                        <?= $dataBersihTidakTerikat['level3']; ?>
                    </td>
                    <td align="center"></td>
                    <td align="right"><?= rupiah_positif($jumlahBersihTidakTerikatA); ?></td>
                    <td align="right"><?= rupiah_positif($jumlahBersihTidakTerikatB); ?></td>
                </tr>

        <?php
            endforeach;
        }
        ?>
        <tr>
            <td class="text-subakun">
                Jumlah Aset Bersih Tidak Terikat
            </td>
            <td></td>
            <td align="right" style="border-bottom:solid 1px;border-top:solid 1px;"><?= rupiah_positif($totalBersihTidakTerikatA); ?></td>
            <td align="right" style="border-bottom:solid 1px;border-top:solid 1px;"><?= rupiah_positif($totalBersihTidakTerikatB); ?></td>
        </tr>
        <tr>
            <td><strong>Aset Bersih Terikat</strong></td>
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
                    <td class="text-subakun">
                        <?= $dataBersihTerikat['level3']; ?>
                    </td>
                    <td align="center"><?= $dataBersihTerikat['catatan_id']; ?></td>
                    <td align="right"><?= rupiah_positif($jumlahBersihTerikatA); ?></td>
                    <td align="right"><?= rupiah_positif($jumlahBersihTerikatB); ?></td>
                </tr>
        <?php
            endforeach;
        }
        ?>
        <tr>
            <td class="text-subakun">
                Jumlah Aset Bersih Terikat
            </td>
            <td></td>
            <td align="right" style="border-bottom:solid 1px;border-top:solid 1px;"><?= rupiah_positif($totalBersihTerikatA); ?></td>
            <td align="right" style="border-bottom:solid 1px;border-top:solid 1px;"><?= rupiah_positif($totalBersihTerikatB); ?></td>
        </tr>
        <tr>
            <td class="text-subakun">
                Jumlah Aset Bersih
            </td>
            <td></td>
            <td align="right" style="border-bottom:solid 0.65mm;">
                <?php
                $jumlahAsetBersihA = $totalBersihTidakTerikatA + $totalBersihTerikatA;
                echo rupiah_positif($jumlahAsetBersihA);
                ?>
            </td>
            <td align="right" style="border-bottom:solid 0.65mm;">
                <?php
                $jumlahAsetBersihB = $totalBersihTidakTerikatB + $totalBersihTerikatB;
                echo rupiah_positif($jumlahAsetBersihB);
                ?>
            </td>
        </tr>
        <tr>
            <td colspan="4">&nbsp;</td>
        </tr>
        <tr>
            <td><strong>JUMLAH KEWAJIBAN DAN ASET BERSIH</strong></td>
            <td></td>
            <td align="right" style="border-bottom:solid 0.65mm;border-top:solid 1px;">
                <strong>
                    <?php
                    $jumlahKewajibanBersihA = $totalKewajibanA + $totalBersihTidakTerikatA + $totalBersihTerikatA;
                    echo rupiah_positif($jumlahKewajibanBersihA);
                    ?>
                </strong>
            </td>
            <td align="right" style="border-bottom:solid 0.65mm;border-top:solid 1px;">
                <strong>
                    <?php
                    $jumlahKewajibanBersihB = $totalKewajibanB + $totalBersihTidakTerikatB + $totalBersihTerikatB;
                    echo rupiah_positif($jumlahKewajibanBersihB);
                    ?>
                </strong>
            </td>
        </tr>
    </table>
</body>

</html>