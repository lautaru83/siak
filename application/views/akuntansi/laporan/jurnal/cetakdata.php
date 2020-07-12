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
        font-size: 10px;
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
        font: small;
        font-weight: normal;
        text-align: center;
    }

    .tabledata tr td {
        padding: 3px;
        font: small;
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
        <?php
        if ($jurnal_id) {
            if ($jurnal_id == "KM") {
                $juduljurnal = "KAS MASUK";
            } elseif ($jurnal_id == "KK") {
                $juduljurnal = "KAS KELUAR";
            } elseif ($jurnal_id == "BM") {
                $juduljurnal = "BANK MASUK";
            } elseif ($jurnal_id == "BK") {
                $juduljurnal = "BANK KELUAR";
            } elseif ($jurnal_id == "NN") {
                $juduljurnal = "NON KAS";
            } else {
                $juduljurnal = "PEMBAYARAN MAHASISWA";
            }
        } else {
            $juduljurnal = "TRANSAKSI";
        }
        ?>
        <br>
        <div style="text-align: center">
            <strong>DATA JURNAL <?= $juduljurnal; ?></strong>
        </div>
        <br>
        <table width="100%">
            <tr>
                <td width="15%">Institusi</td>
                <td width="3%">:</td>
                <td>Nama Institusi</td>
                <td width="12%">Awal Periode</td>
                <td width="3%">:</td>
                <td width="10%" align="right"><?= $awalperiode; ?></td>
            </tr>
            <tr>
                <td>Pembukuan</td>
                <td>:</td>
                <td><?= $pembukuan; ?></td>
                <td>Akhir Periode</td>
                <td>:</td>
                <td align="right"><?= $akhirperiode; ?></td>
            </tr>
        </table>
        <br>
        <table class="tabledata" width="100%">
            <tr>
                <th width="4%">No</th>
                <th width="11%">Tanggal</th>
                <th width="9%">No.Bukti</th>
                <th>Uraian</th>
                <th width="15%">Debet (Rp)</th>
                <th width="15%">Kredit (Rp)</th>
            </tr>
            <?php
            $no = 1;
            if ($jurnal) {
                foreach ($jurnal as $dataJurnal) :
                    $id = $dataJurnal['id'];
            ?>
                    <tr>
                        <td align="center"><?= $no; ?></td>
                        <td align="center"><?= tanggal_indo($dataJurnal['tanggal']); ?></td>
                        <td align="center"><?= $dataJurnal['nobukti']; ?></td>
                        <td colspan="3">
                            <?= $dataJurnal['keterangan']; ?>
                        </td>
                    </tr>
                    <?php
                    $detailjurnal = $this->Transaksi_model->detailtransaksi($id);
                    if ($detailjurnal) {
                        foreach ($detailjurnal as $dataDetailjurnal) :
                            $posisi = $dataDetailjurnal['posisi'];
                    ?>

                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <div <?php padding_akunlap($posisi); ?>><?= $dataDetailjurnal['a6level_id']; ?>&nbsp;&nbsp;&nbsp;&nbsp;<?= $dataDetailjurnal['level6']; ?></div>
                                </td>
                                <td align="right">
                                    <?= rupiah($dataDetailjurnal['debet']); ?>
                                </td>
                                <td align="right">
                                    <?= rupiah($dataDetailjurnal['kredit']); ?>
                                </td>
                            </tr>
                    <?php
                        endforeach;
                    }
                    ?>
                <?php
                    $no++;
                endforeach;
            } else {
                ?>
                <tr>
                    <td colspan="6" align="center">Data tidak ditemukan</td>
                </tr>
            <?php
            }
            ?>
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