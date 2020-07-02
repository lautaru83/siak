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
        font-size: 8px;
        color: #444;
        border-collapse: collapse;
        width: 100%;
        /* border: 1px solid #f2f5f7; */
    }

    .tabledata tr th {
        padding: 3px;
        background: #f2f2f2;
        border: 1px solid grey;
        color: #000;
        font: small;
        font-weight: normal;
        text-align: center;
    }

    .tabledata tr td {
        padding: 3px;
        font: small;
        font-weight: normal;
        border: 1px solid grey;
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
            <strong>DATA SALDO AWAL <?= $idtahun; ?></strong>
        </div>
        <br>
        <table class="tabledata" width="100%">
            <tr class="">
                <!-- <th width="3%">No</th> -->
                <th colspan="3"><span>Kode Perkiraan</span></th>
                <th width="10%">Posisi</th>
                <th width="20%">Saldo Awal (Rp)</th>
            </tr>
            <?php
            $level11 = $this->Kodeperkiraan_model->asetsaldo();
            if ($level11) {
                foreach ($level11 as $dataLevel11) :
                    $idLevel11 = $dataLevel11['id'];
            ?>
                    <tr>
                        <!-- <td width="5%" align="center">1</td> -->
                        <td colspan="5"><strong><?= strtoupper($dataLevel11['level1']); ?></strong></td>
                    </tr>
                    <?php
                    $saldoaset = 0;
                    $jumlahaset = 0;
                    $totalaset = 0;
                    $akunaset6 = $this->Kodeperkiraan_model->akunlevel6saldo($idLevel11);
                    if ($akunaset6) {
                        foreach ($akunaset6 as $dataAkunaset6) :
                            $idAkunaset6 = $dataAkunaset6['a6level_id'];
                            $posisiAset = $dataAkunaset6['posisi'];
                            $jumlahaset = ambilsaldoawal($idtahun, $idAkunaset6, $posisiAset);
                            $totalaset = $totalaset + $jumlahaset;

                    ?>
                            <tr>
                                <!-- <td align="center"></td> -->
                                <td width="13%" align="center"><?= $dataAkunaset6['a6level_id']; ?></td>
                                <td colspan="2"><?= $dataAkunaset6['level6']; ?></td>
                                <td align="center"><?= posisi_akun($dataAkunaset6['posisi']); ?></td>
                                <td align="right">
                                    <?= rupiah_positif($jumlahaset); ?>
                                </td>
                            </tr>
                    <?php
                        endforeach;
                    }
                    ?>
                    <tr>
                        <td colspan="4"><strong>JUMLAH ASET</strong></td>
                        <td align="right"><strong><?= rupiah_positif($totalaset); ?></strong></td>
                    </tr>
            <?php
                endforeach;
            }
            ?>
            <?php
            $level12 = $this->Kodeperkiraan_model->kewajibansaldo();
            if ($level12) {
                foreach ($level12 as $dataLevel12) :
                    $idLevel12 = $dataLevel12['id'];
            ?>
                    <tr>
                        <!-- <td width="5%" align="center">1</td> -->
                        <td colspan="5"><strong><?= strtoupper($dataLevel12['level1']); ?></strong></td>
                    </tr>
                    <?php
                    $saldokewajiban = 0;
                    $jumlahkewajiban = 0;
                    $totalkewajiban = 0;
                    $akunkewajiban6 = $this->Kodeperkiraan_model->akunlevel6saldo($idLevel12);
                    if ($akunkewajiban6) {
                        foreach ($akunkewajiban6 as $dataAkunkewajiban6) :
                            $idAkunkewajiban = $dataAkunkewajiban6['a6level_id'];
                            $posisiKewajiban = $dataAkunkewajiban6['posisi'];
                            $jumlahkewajiban = ambilsaldoawal($idtahun, $idAkunkewajiban, $posisiKewajiban);
                            $totalkewajiban = $totalkewajiban + $jumlahkewajiban;
                    ?>
                            <tr>
                                <!-- <td align="center"></td> -->
                                <td width="13%" align="center"><?= $dataAkunkewajiban6['a6level_id']; ?></td>
                                <td colspan="2"><?= $dataAkunkewajiban6['level6']; ?></td>
                                <td align="center"><?= posisi_akun($dataAkunkewajiban6['posisi']); ?></td>
                                <td align="right">
                                    <?= rupiah_positif($jumlahkewajiban); ?>
                                </td>
                            </tr>
                    <?php
                        endforeach;
                    }
                    ?>
                    <tr>
                        <td></td>
                        <td colspan="3">SUB JUMLAH</td>
                        <td align="right"><?= rupiah_positif($totalkewajiban); ?></td>
                    </tr>

            <?php
                endforeach;
            }
            ?>
            <?php
            $level13 = $this->Kodeperkiraan_model->asetbersihsaldo();
            if ($level13) {
                foreach ($level13 as $dataLevel13) :
                    $idLevel13 = $dataLevel13['id'];
            ?>
                    <tr>
                        <!-- <td width="5%" align="center">1</td> -->
                        <td colspan="5"><strong><?= strtoupper($dataLevel13['level1']); ?></strong></td>
                    </tr>
                    <?php
                    $saldobersih = 0;
                    $jumlahbersih = 0;
                    $totalbersih = 0;
                    $dataAkunbersih6 = $this->Kodeperkiraan_model->akunlevel6saldo($idLevel13);
                    if ($dataAkunbersih6) {
                        foreach ($dataAkunbersih6 as $dataAkunbersih6) :
                            $idAkunbersih = $dataAkunbersih6['a6level_id'];
                            $posisiBersih = $dataAkunbersih6['posisi'];
                            $jumlahbersih = ambilsaldoawal($idtahun, $idAkunbersih, $posisiBersih);
                            $totalbersih = $totalbersih + $jumlahbersih;
                    ?>
                            <tr>
                                <!-- <td align="center"></td> -->
                                <td width="13%" align="center"><?= $dataAkunbersih6['a6level_id']; ?></td>
                                <td colspan="2"><?= $dataAkunbersih6['level6']; ?></td>
                                <td align="center"><?= posisi_akun($dataAkunbersih6['posisi']); ?></td>
                                <td align="right">
                                    <?= rupiah_positif($jumlahbersih); ?>
                                </td>
                            </tr>
                    <?php
                        endforeach;
                    }
                    ?>
                    <tr>
                        <td></td>
                        <td colspan="3">SUB JUMLAH</td>
                        <td align="right"><?= rupiah_positif($totalbersih); ?></td>
                    </tr>
            <?php
                endforeach;
            }
            ?>
            <tr>
                <td colspan="4"><strong>JUMLAH KEWAJIBAN DAN ASET BERSIH</strong></td>
                <td align="right">
                    <strong>
                        <?php
                        $totalABkewajiban = $totalkewajiban + $totalbersih;
                        echo rupiah_positif($totalABkewajiban);
                        ?>
                    </strong>
                </td>
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