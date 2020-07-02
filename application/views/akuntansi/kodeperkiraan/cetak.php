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
            <strong>DATA KODE PERKIRAAN</strong>
        </div>
        <br>
        <table class="tabledata" width="100%">
            <tr>
                <th colspan="5">Kode Perkiraan</th>
                <th width="12%">Institusi</th>
                <th width="12%">Posisi</th>
            </tr>
            <?php
            $no = 1;
            if ($kodeperkiraan) {
                foreach ($kodeperkiraan as $dataKode) :
                    $idakun3 = $dataKode['id'];
            ?>
                    <tr>
                        <td width="9%" align="center">
                            <?= $idakun3; ?>.00.00.00
                        </td>
                        <td colspan="6">
                            <?= $dataKode['level1']; ?> / <?= $dataKode['level2']; ?> / <?= $dataKode['level3']; ?>
                        </td>
                    </tr>
                    <?php
                    $level4 = $this->Kodeperkiraan_model->level4($idakun3);
                    if ($level4) {
                        foreach ($level4 as $dataLevel4) :
                            $idakun4 = $dataLevel4['id'];
                    ?>
                            <tr>
                                <td>
                                </td>
                                <td width="9%" align="center"><?= $dataLevel4['id']; ?>.00.00</td>
                                <td colspan="5"><?= $dataLevel4['level4']; ?>
                                </td>
                            </tr>
                            <?php
                            $level5 = $this->Kodeperkiraan_model->level5($idakun4);
                            if ($level5) {
                                foreach ($level5 as $dataLevel5) :
                                    $idakun5 = $dataLevel5['id'];
                            ?>
                                    <tr>
                                        <td></td>
                                        <td>
                                        </td>
                                        <td align="center" width="9%"><?= $dataLevel5['id']; ?>.00</td>
                                        <td colspan="4"><?= $dataLevel5['level5']; ?>
                                        </td>
                                    </tr>
                                    <?php
                                    $level6 = $this->Kodeperkiraan_model->level6($idakun5);
                                    if ($level6) {
                                        foreach ($level6 as $dataLevel6) :
                                            $idakun6 = $dataLevel6['id'];
                                    ?>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td width="9%" align="center"><?= $dataLevel6['id']; ?></td>
                                                <td><?= $dataLevel6['level6']; ?></td>
                                                <td align="center"><?= $dataLevel6['institusi']; ?></td>
                                                <td align="center"><?= posisi_akun($dataLevel6['posisi']); ?></td>
                                            </tr>
                                    <?php
                                        endforeach;
                                    }
                                    ?>
                            <?php
                                endforeach;
                            }
                            ?>
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
                    <td colspan="7">Data tidak ditemukan</td>
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