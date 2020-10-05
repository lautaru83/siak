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
        <strong>CATATAN ATAS LAPORAN KEUANGAN</strong>
        <br>
        <span>
            Untuk Tahun Yang Berakhir <?= format_indo($akhirbuku); ?><br>
            (Dinyatakan dalam Rupiah, kecuali dinyatakan lain)
        </span>
        <hr>
    </div>
    <table class="tabel-laporan">
        <tr>
            <td colspan="2"></td>
            <td width="10%" align="center">
            </td>
            <td width="16%" align="center" style="border-bottom:solid 1px;">
                1 Januari S/d<br>
                <?= format_indo($akhir_periode); ?>
            </td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td></td>
            <td align="center">( Rp. )</td>
        </tr>
        <tr>
            <td colspan="4">&nbsp;</td>
        </tr>

        <?php
        $jumlahAK = 0;
        $debetAK = 0;
        $kreditAK = 0;
        if ($calkAkun3) {
            foreach ($calkAkun3 as $dataCalk3) :
                $idCatatanAK = $dataCalk3['catatan_id']; //level3 id
                $akun1AK = $dataCalk3['a1level_id'];
                $debetAK = $dataCalk3['debet'];
                $kreditAK = $dataCalk3['kredit'];
                if ($akun1AK == "100") {
                    $jumlahAK = $debetAK - $kreditAK;
                } else {
                    $jumlahAK = $kreditAK - $debetAK;
                }

        ?>
                <tr>
                    <td width="5%" align="center"><strong><?= $idCatatanAK; ?></strong></td>
                    <td><strong><?= $dataCalk3['level3']; ?></strong></td>
                    <td></td>
                    <td align="right" style="border-bottom:solid 1px;"><strong><?= rupiah_positif($jumlahAK); ?></strong></td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="3" class="text-subakun">Rincian :</td>
                </tr>
                <?php
                $akun6 = $this->Laporan_model->calkAkun6InstitusiCetak($idCatatanAK);
                if ($akun6) {
                    $debet6 = 0;
                    $kredit6 = 0;
                    $jumlah6 = 0;
                    $total6 = 0;
                    foreach ($akun6 as $dataAkun6) :
                        $posisi6 = $dataAkun6['posisi'];
                        $debet6 = $dataAkun6['debet'];
                        $kredit6 = $dataAkun6['kredit'];
                        if ($posisi6 == "D") {
                            $jumlah6 = $debet6 - $kredit6;
                        } else {
                            $jumlah6 = $kredit6 - $debet6;
                        }
                        $total6 = $total6 + $jumlah6;
                ?>
                        <tr>
                            <td></td>
                            <td class="text-subakun">- <span style="margin-left: 2px;"><?= $dataAkun6['level6']; ?></span></td>
                            <td></td>
                            <td align="right"><?= rupiah_positif($jumlah6); ?></td>
                        </tr>
                <?php
                    endforeach;
                }
                ?>
                <tr>
                    <td></td>
                    <td class="text-subakun"><span style="margin-left: 2px;">Sub Jumlah</span></td>
                    <td></td>
                    <td align="right" style="border-bottom:solid 1px;border-top:solid 1px;"><?= rupiah_positif($total6); ?></td>
                </tr>
                <tr>
                    <td colspan="4">&nbsp;</td>
                </tr>

        <?php
            endforeach;
        }
        ?>
        <?php
        $jumlahAb = 0;
        $debetAb = 0;
        $kreditAb = 0;
        $totalAb = 0;
        if ($calkAb) {
            $jumlahAbtt = asetbersihTb($awalbuku, $tanggal, $pembukuan_id);
            foreach ($calkAb as $dataCalkAb) :
                $idCatatanAb = $dataCalkAb['catatan_id']; //level2 id
                $posisiAb = $dataCalkAb['posisi'];
                $debetAb = $dataCalkAb['debet'];
                $kreditAb = $dataCalkAb['kredit'];
                if ($idCatatanAb == "310") {
                    $jumlahAb = $kreditAb + $jumlahAbtt - $debetAb;
                } else {
                    $jumlahAb = $kreditAb - $debetAb;
                }
                $totalAb = $totalAb + $jumlahAb;
        ?>
                <tr>
                    <td width="5%" align="center"><strong><?= $idCatatanAb; ?></strong></td>
                    <td><strong><?= $dataCalkAb['level2']; ?></strong></td>
                    <td></td>
                    <td align="right" style="border-bottom:solid 1px;"><strong><?= rupiah_positif($jumlahAb); ?></strong></td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="3" class="text-subakun">Rincian :</td>
                </tr>

                <?php
                $akun6Ab = $this->Laporan_model->calkAkun6AbInstitusiCetak($idCatatanAb);
                $debet = 0;
                $kredit = 0;
                $jumlah = 0;
                $total6Ab = 0;
                if ($akun6Ab) {
                    foreach ($akun6Ab as $dataAkun6Ab) :
                        $posisi = $dataAkun6Ab['posisi'];
                        $debet = $dataAkun6Ab['debet'];
                        $kredit = $dataAkun6Ab['kredit'];
                        if ($posisi == "S") {
                            $jumlah = $kredit + $jumlahAbtt - $debet;
                        } else {
                            $jumlah = $kredit - $debet;
                        }
                        $total6Ab = $total6Ab + $jumlah;
                ?>
                        <tr>
                            <td></td>
                            <td class="text-subakun">- <span style="margin-left: 2px;"><?= $dataAkun6Ab['level6']; ?></span></td>
                            <td></td>
                            <td align="right"><?= rupiah_positif($jumlah); ?></td>
                        </tr>
                <?php
                    endforeach;
                }
                ?>
                <tr>
                    <td></td>
                    <td class="text-subakun"><span style="margin-left: 2px;">Sub Jumlah</span></td>
                    <td></td>
                    <td align="right" style="border-bottom:solid 1px;border-top:solid 1px;"><?= rupiah_positif($total6Ab); ?></td>
                </tr>
                <tr>
                    <td colspan="4">&nbsp;</td>
                </tr>
        <?php
            endforeach;
        }
        ?>
        <?php
        $jumlahPd = 0;
        $debetPd = 0;
        $kreditPd = 0;
        $totalPd = 0;
        if ($calkPd) {
            foreach ($calkPd as $dataCalkPd) :
                $idCatatanPd = $dataCalkPd['catatan_id']; //level3 id
                $akun1 = $dataCalkPd['a1level_id'];
                $debetPd = $dataCalkPd['debet'];
                $kreditPd = $dataCalkPd['kredit'];
                // $jumlahPd = $kreditPd - $debetPd;
                if ($akun1 == "400") {
                    $jumlahPd = $kreditPd - $debetPd;
                    // $jumlahPd = $debet - $kredit;
                } elseif ($akun1 == "600") {
                    $jumlahPd = $kreditPd - $debetPd;
                } else {
                    $jumlahPd = $debetPd - $kreditPd;
                }
                $totalPd = $totalPd + $jumlahPd;

        ?>
                <tr>
                    <td width="5%" align="center"><strong><?= $idCatatanPd; ?></strong></td>
                    <td><strong><?= $dataCalkPd['level3']; ?></strong></td>
                    <td></td>
                    <td align="right" style="border-bottom:solid 1px;"><strong><?= rupiah_positif($jumlahPd); ?></strong></td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="3" class="text-subakun">Rincian :</td>
                </tr>
                <?php
                $akun6 = $this->Laporan_model->calkAkun6InstitusiCetak($idCatatanPd);
                if ($akun6) {
                    $debet6 = 0;
                    $kredit6 = 0;
                    $jumlah6 = 0;
                    $total6 = 0;
                    foreach ($akun6 as $dataAkun6) :
                        $posisi6 = $dataAkun6['posisi'];
                        $debet6 = $dataAkun6['debet'];
                        $kredit6 = $dataAkun6['kredit'];
                        if ($posisi6 == "D") {
                            $jumlah6 = $debet6 - $kredit6;
                        } else {
                            $jumlah6 = $kredit6 - $debet6;
                        }
                        $total6 = $total6 + $jumlah6;
                ?>
                        <tr>
                            <td></td>
                            <td class="text-subakun">- <span style="margin-left: 2px;"><?= $dataAkun6['level6']; ?></span></td>
                            <td></td>
                            <td align="right"><?= rupiah_positif($jumlah6); ?></td>
                        </tr>
                <?php
                    endforeach;
                }
                ?>
                <tr>
                    <td></td>
                    <td class="text-subakun"><span style="margin-left: 2px;">Sub Jumlah</span></td>
                    <td></td>
                    <td align="right" style="border-bottom:solid 1px;border-top:solid 1px;"><?= rupiah_positif($total6); ?></td>
                </tr>
                <tr>
                    <td colspan="4">&nbsp;</td>
                </tr>
        <?php
            endforeach;
        }
        ?>
    </table>
</body>

</html>