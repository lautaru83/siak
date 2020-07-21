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
        <strong>NERACA SALDO</strong>
        <br>
        <span>
            <?php
            // var_dump($neracasaldo);
            ?>
            Tanggal <?= format_indo($akhir_periode); ?><br>
            Untuk Tahun Yang Berakhir <?= format_indo($akhirbuku); ?><br>
            (Dinyatakan dalam Rupiah, kecuali dinyatakan lain)
        </span>
    </div>
    <br>
    <table class="tabel-data" width="100%">
        <thead>
            <tr>
                <th width="5%">#</th>
                <th colspan="2">Kode Perkiraan</th>
                <th width="18%">Debet (Rp.)</th>
                <th width="18%">Kredit (Rp.)</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($neracasaldo) {
                $no = 1;
                $saldodebet = 0.00;
                $saldokredit = 0.00;
                foreach ($neracasaldo as $datasaldo) :
                    $posisi = $datasaldo['posisi'];
                    $debet = $datasaldo['debet'];
                    $kredit = $datasaldo['kredit'];
                    if ($posisi == "D") {
                        $saldodebet = $debet - $kredit;
                        $saldokredit = 0;
                    } else {
                        $saldodebet = 0;
                        $saldokredit = $kredit - $debet;
                    }
            ?>
                    <tr>
                        <td class="nomor-tabel"><?= $no; ?></td>
                        <td class="nomor-tabel" width="12%"><?= $datasaldo['id']; ?></td>
                        <td class="text-tabel"><?= $datasaldo['level6']; ?></td>
                        <td class="nominal-tabel"><?php rupiah_positif($saldodebet); ?></td>
                        <td class="nominal-tabel"><?php rupiah_positif($saldokredit); ?></td>
                    </tr>
                <?php
                    $no++;
                endforeach;
            } else {
                ?>
                <tr>
                    <td class="nomor-tabel" colspan="5">Data tidak ditemukan</td>
                </tr>
            <?php
            }
            ?>

        <tbody>
    </table>
</body>

</html>