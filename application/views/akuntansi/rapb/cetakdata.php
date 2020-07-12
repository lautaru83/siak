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
            <strong>DATA RAPB <?= $tahunanggaran; ?></strong>
        </div>
        <br>
        <table class="tabledata" width="100%">
            <tr class="">
                <th width="4%">#</th>
                <th colspan="2">Kegiatan Anggaran</th>
                <th width="18%">Anggaran (Rp)</th>
                <th width="18%">Terealisasi (Rp)</th>
                <th width="8%">No.Ref</th>
            </tr>
            <?php
            $no = 1;
            if ($kelompok) {
                foreach ($kelompok as $dataKelompok) :
                    $idKelompok = $dataKelompok['id'];
            ?>
                    <tr>
                        <td align="center">
                            <?= txt_roman($no); ?>
                        </td>
                        <td colspan="5"><?= $dataKelompok['kelompok'] ?></td>
                    </tr>
                    <?php
                    $nor = 1;
                    $rencana = $this->Rapb_model->rapbdata_kelompok_id($idKelompok, $idTahun);
                    if ($rencana) {
                        foreach ($rencana as $dataRencana) :
                            $idRencana = $dataRencana['id'];
                            $idAnggaran = $dataRencana['anggaran_id'];
                    ?>
                            <tr>
                                <td></td>
                                <td width="4%" align="center"><?= $nor; ?></td>
                                <td><?= $dataRencana['rencana']; ?></td>
                                <td align="right"><?= rupiah($dataRencana['resaldo']); ?></td>
                                <td align="right"><?= rupiah($dataRencana['terealisasi']); ?></td>
                                <td align="center"><?= $dataRencana['noref']; ?></td>
                            </tr>
                <?php
                            $nor++;
                        endforeach;
                    }
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