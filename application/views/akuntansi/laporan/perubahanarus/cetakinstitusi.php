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
        <strong>LAPORAN PERUBAHAN ARUS KAS</strong>
        <br>
        <span>
            Untuk Tahun Yang Berakhir <?= format_indo($akhirbuku); ?><br>
            (Dinyatakan dalam Rupiah, kecuali dinyatakan lain)
            <?php
            //echo "<br>";
            //var_dump($pptb);
            ?>
        </span>
        <hr>
    </div>
    <table class="tabel-laporan">
        <tr>
            <td></td>
            <td width="10%" align="center">

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
            <td colspan="3"><strong>ARUS KAS AKTIVITAS OPERASIONAL</strong></td>
        </tr>
        <tr>
            <td><strong>Kenaikan(Penurunan) Aset Bersih</strong></td>
            <td></td>
            <?php
            $jumlahKenaikanAB = 0;
            $jumlahAbtt = asetbersihTb($awalbuku, $akhir_periode, $pembukuan_id);
            $jumlahKenaikanAB = $jumlahKenaikanAB + $jumlahAbtt;
            ?>
            <td align="right"><?= rupiah_positif($jumlahKenaikanAB); ?></td>
        </tr>
        <tr>
            <td class="text-subakun"><strong>Laba (Rugi) Bersih Sebelum Modal Kerja</strong></td>
            <td width="10%"></td>
            <?php
            $jumlahSebelumModal = 0;
            $jumlahSebelumModal = $jumlahSebelumModal + $jumlahKenaikanAB;
            ?>
            <td width="18%" align="right" style="border-bottom:solid 1px;border-top:solid 1px;"><?= rupiah_positif($jumlahSebelumModal); ?></td>
        </tr>
        <tr>
            <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="3"><strong>ARUS KAS DARI AKTIVITAS OPERASIONAL</strong></td>
        </tr>

        <?php
        $totalKasOp = 0;
        if ($kasOp) {
            foreach ($kasOp as $dataKasOp) :
                $posisi = $dataKasOp['posisi'];
                $debet = $dataKasOp['debet'];
                $kredit = $dataKasOp['kredit'];
                if ($posisi = "D") {
                    $jumlahKasOp = $kredit - $debet;
                } else {
                    $jumlahKasOp = $debet - $kredit;
                }
                $totalKasOp = $totalKasOp + $jumlahKasOp;
        ?>
                <tr>
                    <td class="text-subakun"><?= $dataKasOp['level3']; ?></td>
                    <td></td>
                    <td align="right"><?= rupiah_positif($jumlahKasOp); ?></td>
                </tr>
        <?php
            endforeach;
        }
        ?>
        <tr>
            <td class="text-subakun"><strong>Jumlah</strong></td>
            <td width="10%"></td>
            <td width="18%" align="right" style="border-bottom:solid 1px;border-top:solid 1px;"><?= rupiah_positif($totalKasOp); ?></td>
        </tr>
        <tr>
            <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="3"><strong>ARUS KAS DARI AKTIVITAS INVESTASI</strong></td>
        </tr>
        <?php
        $totalKasInves = 0;
        if ($kasInves) {
            foreach ($kasInves as $dataKasInves) :
                $posisi = $dataKasInves['posisi'];
                $debet = $dataKasInves['debet'];
                $kredit = $dataKasInves['kredit'];
                $jumlahKasInves = $kredit - $debet;
                $totalKasInves = $totalKasInves + $jumlahKasInves;
        ?>
                <tr>
                    <td class="text-subakun"><?= $dataKasInves['level3'] ?></td>
                    <td></td>
                    <td><?= rupiah_positif($jumlahKasInves); ?></td>
                </tr>
        <?php
            endforeach;
        }
        ?>
        <tr>
            <td class="text-subakun"><strong>Jumlah</strong></td>
            <td width="10%"></td>
            <td width="18%" align="right" style="border-bottom:solid 1px;border-top:solid 1px;"><?= rupiah_positif($totalKasInves); ?></td>
        </tr>
        <tr>
            <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td><strong>KENAIKAN(PENURUNAN) KAS BERSIH</strong></td>
            <td></td>
            <?php
            $jumlahKenaikanKas = 0;
            $jumlahKenaikanKas = $jumlahSebelumModal + $totalKasOp + $totalKasInves;
            ?>
            <td width="18%" align="right" style="border-bottom:solid 0.65mm;border-top:solid 1px;"><strong><?= rupiah_positif($jumlahKenaikanKas); ?></strong></td>
        </tr>
        <tr>
            <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td><strong>KAS PADA AWAL PERIODE</strong></td>
            <td></td>
            <?php
            $kasAwalPeriode = 0;
            $akun = '111';
            $kasAwalPeriode = saldoAwalKasInstitusi($akun, $pembukuan_id);
            ?>
            <td width="18%" align="right" style="border-bottom:solid 0.65mm;border-top:solid 1px;"><strong><?= rupiah_positif($kasAwalPeriode); ?></strong></td>
        </tr>
        <tr>
            <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td><strong>KAS PADA AKHIR PERIODE</strong></td>
            <td></td>
            <?php
            //$saldoKasAkhir = 0;
            $kasAkhirPeriode = $kasAwalPeriode + $jumlahKenaikanKas;
            ?>
            <td width="18%" align="right" style="border-bottom:solid 0.65mm;border-top:solid 1px;"><strong><?= rupiah_positif($kasAkhirPeriode); ?></strong></td>
        </tr>
    </table>
</body>

</html>