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
    <div class="judul-laporan">
        <strong>
            <?php if ($institusi) {
                echo strtoupper($institusi['keterangan']);
            } ?>
        </strong>
        <br>
        <strong>NERACA KONSOLIDASI</strong>
        <br>
        <span>
            Untuk Tahun Yang Berakhir <?= format_indo($akhirbuku); ?><br>
            (Dinyatakan dalam Rupiah, kecuali dinyatakan lain)
            <?php
            //var_dump($bersihTidakTerikat);
            ?>
        </span>
        <hr>
    </div>
    <table class="tabel-laporan">
        <tr>
            <td></td>
            <td width="12%" align="center" style="border-bottom:solid 1px;">
                <br>
                Catatan
            </td>
            <td width="18%" align="center" style="border-bottom:solid 1px;">
                1 Januari S/d<br>
                <?= format_indo($akhir_periode); ?>
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td align="center">( Rp. )</td>
        </tr>
    </table>
    <br>
    <table class="tabel-laporan">
        <tr>
            <td colspan="3"><strong>ASET</strong></td>
        </tr>
        <tr>
            <td colspan="3"><strong>Aset Lancar</strong></td>
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
                    <td class="text-subakun">
                        <?= $dataAsetLancar['level3']; ?>
                    </td>
                    <td width="12%" align="center"><?= $dataAsetLancar['catatan_id']; ?></td>
                    <td width="18%" align="right"><?= rupiah_positif($jumlahAsetLancar); ?></td>
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
                <?= rupiah_positif($totalAsetLancar); ?>
            </td>
        </tr>
        <tr>
            <td><strong>Aset Tidak Lancar</strong></td>
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
                    <td class="text-subakun">
                        <?= $dataAsetTidakLancar['level3']; ?>
                    </td>
                    <td align="center"><?= $dataAsetTidakLancar['catatan_id']; ?></td>
                    <td align="right"><?= rupiah_positif($jumlahAsetTidakLancar); ?></td>
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
                <?= rupiah_positif($totalAsetTidakLancar); ?>
            </td>
        </tr>
        <tr>
            <td><strong>JUMLAH ASET</strong></td>
            <td></td>
            <td align="right" style="border-bottom:solid 0.65mm;">
                <strong>
                    <?php
                    $jumlahAset = $totalAsetLancar + $totalAsetTidakLancar;
                    echo rupiah_positif($jumlahAset);
                    ?>
                </strong>
            </td>
        </tr>
        <tr>
            <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td><strong>KEWAJIBAN DAN ASET BERSIH</strong></td>
        </tr>
        <tr>
            <td><strong>KEWAJIBAN</strong></td>
        </tr>
        <tr>
            <td><strong>Kewajiban Jangka Pendek</strong></td>
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
                    <td class="text-subakun">
                        <?= $dataKewajiban['level3']; ?>
                    </td>
                    <td align="center"><?= $dataKewajiban['catatan_id']; ?></td>
                    <td align="right"><?= rupiah_positif($jumlahKewajiban); ?></td>
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
                <?= rupiah_positif($totalKewajiban); ?>
            </td>
        </tr>
        <tr>
            <td class="text-subakun">
                Jumlah Kewajiban
            </td>
            <td></td>
            <td align="right" style="border-bottom:solid 0.65mm;">
                <?= rupiah_positif($totalKewajiban); ?>
            </td>
        </tr>
        <tr>
            <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="3"><strong>ASET BERSIH</strong></td>
        </tr>
        <tr>
            <td><strong>Aset Bersih Tidak Terikat</strong></td>
            <td align="center">310</td>
            <td></td>
        </tr>
        <?php
        $jumlahAbtt = 0;
        $jumlahBersihTidakTerikat = 0;
        $totalBersihTidakTerikat = 0;
        $jumlahDebet = 0;
        $jumlahKredit = 0;
        if ($bersihTidakTerikat) {
            $jumlahAbtt = asetbersihTbKonsolidasi($awalbuku, $tanggal, $pembukuan_id);
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
                    <td class="text-subakun">
                        <?= $dataBersihTidakTerikat['level3']; ?>
                    </td>
                    <td align="center"><?php //$dataBersihTidakTerikat['catatan_id']; 
                                        ?></td>
                    <td align="right"><?= rupiah_positif($jumlahBersihTidakTerikat); ?></td>
                </tr>
        <?php
            endforeach;
        }
        ?>
        <tr>
            <td class=" text-subakun">
                Jumlah Aset Bersih Tidak Terikat
            </td>
            <td></td>
            <td align="right" style="border-bottom:solid 1px;border-top:solid 1px;"><?= rupiah_positif($totalBersihTidakTerikat); ?></td>
        </tr>
        <tr>
            <td><strong>Aset Bersih Terikat</strong></td>
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
                    <td class="text-subakun">
                        <?= $dataBersihTerikat['level3']; ?>
                    </td>
                    <td align="center"><?= $dataBersihTerikat['catatan_id']; ?></td>
                    <td align="right"><?= rupiah_positif($jumlahBersihTerikat); ?></td>
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
            <td align="right" style="border-bottom:solid 1px;border-top:solid 1px;">
                <?= rupiah_positif($totalBersihTerikat); ?>
            </td>
        </tr>
        <tr>
            <td class="text-subakun">
                <strong>Jumlah Aset Bersih</strong>
            </td>
            <td></td>
            <td align="right" style="border-bottom:solid 0.65mm;">
                <?php
                $totalasetbersih = 0.00;
                $totalasetbersih = $totalBersihTidakTerikat + $totalBersihTerikat;
                ?>
                <strong><?= rupiah_positif($totalasetbersih); ?></strong>
            </td>
        </tr>
        <tr>
            <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td><strong>JUMLAH KEWAJIBAN DAN ASET BERSIH</strong></td>
            <td></td>
            <td align="right" style="border-bottom:solid 0.65mm;border-top:solid 1px;">
                <strong>
                    <?php
                    $jumlahKewajibanBersih = $totalKewajiban + $totalBersihTidakTerikat + $totalBersihTerikat;
                    echo rupiah_positif($jumlahKewajibanBersih);
                    ?>
                </strong>
            </td>
        </tr>
    </table>
</body>

</html>