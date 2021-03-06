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
            <strong>DATA MAHASISWA AKTIF</strong>
        </div>
        <br>
        <table width="100%">
            <?php
            $kelas_id = "";
            $perak_id = "";
            $periodeAkad = "";
            $kelas = "";
            if ($detailkelas) {
                $kelas_id = $detailkelas['kelas_id'];
                $perak_id = $detailkelas['perak_id'];
                $periodeAkad = $detailkelas['periodeakademik'];
                $kelas = $detailkelas['kelas'];
            }
            $data['kelas_id'] = $kelas_id;
            ?>
            <tr>
                <td width="15%">Periode</td>
                <td width="3%">:</td>
                <td><?= $periodeAkad; ?></td>
            </tr>
            <tr>
                <td>Kelas</td>
                <td>:</td>
                <td><?= $kelas_id; ?> - <?= $kelas; ?></td>
            </tr>
        </table>
        <br>
        <table class="tabledata" width="100%">
            <tr>
                <th width="5%">No</th>
                <th width="12%">NIM</th>
                <th>Nama</th>
            </tr>
            <?php
            $no = 1;
            if ($mahasiswaaktif) {
                foreach ($mahasiswaaktif as $dataMahasiswaaktif) :
                    $idActive = $dataMahasiswaaktif['id'];
            ?>
                    <tr>
                        <td align="center"><?= $no; ?></td>
                        <td align="center"><?= $dataMahasiswaaktif['nim']; ?></td>
                        <td><?= $dataMahasiswaaktif['nama']; ?></td>
                    </tr>
                <?php
                    $no++;
                endforeach;
            } else {
                ?>
                <tr>
                    <td colspan="3" align="center">Data tidak ditemukan</td>
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