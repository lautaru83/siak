<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $judul; ?></title>
</head>
<style type="text/css">
    @page {
        margin: 0.75cm;
    }

    .pagenum:before {
        content: counter(page);
    }

    .header,
    .footer {
        position: absolute;
    }

    .footer {
        font: small;
        bottom: 0;
        height: 20px;
    }

    .header {
        top: 0;
        height: 40px;
    }

    .content {
        margin-top: 50px;
        margin-bottom: 45px;
    }

    .tabledata {
        font-family: sans-serif;
        font-size: 11px;
        table-layout: auto;
        color: #444;
        border-collapse: collapse;
        width: 100%;
        /* border: 1px solid #f2f5f7; */
    }

    .tabledata tr th {
        padding: 3px;
        background: #f2f2f2;
        border: 1px solid white;
        color: #000;
        font: x-small;
        font-weight: normal;
        text-align: center;
    }

    .tabledata tr td {
        padding: 3px;
        font: x-small;
        font-weight: normal;
        border: none;
    }

    /* .tabledata tr:nth-child(even) {
        background-color: #f2f2f2;
    } */
</style>

<body>
    <div class="header">
        <table width="100%">
            <tr>
                <td align="left">SIAK PAGUWASMAS 2.0 </td>
                <td width="25%" align="right"><?php echo (date("d-m-Y")); ?></td>
            </tr>
            <tr>
                <td colspan="2">Sistem Informasi Akuntansi Keuangan</td>
            </tr>
        </table>
    </div>
    <div class="content">
        <br>
        <div style="text-align: center">
            <strong>BUKU BESAR</strong>
        </div>
        <br>
        <table width="100%" class="tabledata">
            <?php
            //$pembukuan_id = $pembukuan;
            $akun = $this->Kodeperkiraan_model->ambil_akun6($a6level_id);
            $id6 = $akun['id'];
            if ($awalbuku == $tanggalawal) {
                $saldoawal = saldoawal($pembukuan_id, $a6level_id);
            } else {
                $jumlah = -1;
                $format = "days";
                $awalperiode = manipulasiTanggal($tanggalawal, $jumlah, $format);
                $saldoawal = saldoawalberjalan($pembukuan_id, $a6level_id, $awalbuku, $awal_periode);
            }
            ?>
            <tr>
                <td width="13%">Kode</td>
                <td width="3%">:</td>
                <td><?= $akun['id']; ?></td>
                <td width="15%">Awal Periode</td>
                <td width="3%">:</td>
                <td width="18%" align="right"><?= $awal_periode; ?></td>
            </tr>
            <tr>
                <td>Nama Akun</td>
                <td>:</td>
                <td><?= $akun['level6']; ?></td>
                <td>Akhir Periode</td>
                <td>:</td>
                <td align="right"><?= $akhir_periode; ?></td>
            </tr>
            <tr>
                <td>Saldo Awal</td>
                <td>:</td>
                <td>Rp. <?= rupiah_positif($saldoawal); ?></td>
                <td>Saldo Akhir</td>
                <td>:</td>
                <td align="right">Rp. <?= rupiah_positif(saldoakhir($pembukuan_id, $a6level_id, $awalbuku, $akhir_periode)); ?></td>
            </tr>
        </table>
        </br>
        <table class="tabledata" width="100%">
            <tr>
                <th width="4%">No</th>
                <th width="11%">Tanggal</th>
                <th width="9%">No.Bukti</th>
                <th>Uraian</th>
                <th width="15%">Debet (Rp)</th>
                <th width="15%">Kredit (Rp)</th>
                <th width="15%">Saldo (Rp)</th>
            </tr>
            <?php
            $saldo = $saldoawal;
            $jmldebet = 0.00;
            $jmlkredit = 0.00;
            if ($bukubesar) {
                $no = 1;
                $debet = 0;
                $kredit = 0;
                foreach ($bukubesar as $dataBukubesar) :
                    $id = $dataBukubesar['id'];
                    $posisi = $dataBukubesar['posisi'];
                    $debet = $dataBukubesar['debet'];
                    $kredit = $dataBukubesar['kredit'];
                    if ($posisi == "D") {
                        $saldo = $saldo + $debet - $kredit;
                    } else {
                        $saldo = $saldo + $kredit - $debet;
                    }
                    $jmldebet = $jmldebet + $debet;
                    $jmlkredit = $jmlkredit + $kredit;

            ?>
                    <tr>
                        <td align="center"><?= $no; ?></td>
                        <td align="center"><?= tanggal_indo($dataBukubesar['tanggal_transaksi']); ?></td>
                        <td align="center"><?= $dataBukubesar['nobukti']; ?></td>
                        <td>
                            <?= $dataBukubesar['keterangan']; ?>
                        </td>
                        <td align="right">
                            <?= rupiah_positif($dataBukubesar['debet']); ?>
                        </td>
                        <td align="right">
                            <?= rupiah_positif($dataBukubesar['kredit']); ?>
                        </td>
                        <td align="right">
                            <?= rupiah_positif($saldo); ?>
                        </td>
                    </tr>

                <?php
                    $no++;
                endforeach;
            } else {
                ?>
                <tr>
                    <td colspan="7" align="center">Tidak ada data transaksi</td>
                </tr>
            <?php
            }
            ?>
            <tr>
                <td></td>
                <td colspan="3">Total</td>
                <td align="right"><?= rupiah_positif($jmldebet); ?></td>
                <td align="right"><?= rupiah_positif($jmlkredit); ?></td>
                <td></td>
            </tr>
        </table>

    </div>
    <div class="footer">
        <table width="100%">
            <!-- <tr>
                <td>Copyright &copy; 2020 <strong>YAYASAN PAGUWARMAS</strong> Maos-Cilacap. All rights reserved.</td>
                <td width="10" align="right"><span class="pagenum"></span></td>
            </tr> -->
        </table>
    </div>
</body>

</html>