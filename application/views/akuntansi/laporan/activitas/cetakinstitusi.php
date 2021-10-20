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
        <strong>LAPORAN AKTIVITAS</strong>
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
            <td width="10%" align="center" style="border-bottom:solid 1px;">
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
            <td colspan="3"><strong>Pendapatan Tidak Terikat Bersih</strong></td>
        </tr>
        <?php
        $jumlahPttb = 0;
        $totalPttb = 0;
        $jumlahDebet = 0;
        $jumlahKredit = 0;
        if ($pttb) {
            foreach ($pttb as $dataPttb) :
                $posisi = $dataPttb['posisi'];
                $jumlahDebet = $dataPttb['debet'];
                $jumlahKredit = $dataPttb['kredit'];
                $jumlahPttb = $jumlahKredit - $jumlahDebet;
                $totalPttb = $totalPttb + $jumlahPttb;
        ?>
                <tr>
                    <td class="text-subakun">
                        <?= $dataPttb['level3']; ?>
                    </td>
                    <td width="10%" align="center"><?= $dataPttb['catatan_id']; ?></td>
                    <td width="18%" align="right"><?= rupiah_positif($jumlahPttb); ?></td>
                </tr>
        <?php
            endforeach;
        }
        ?>
        <tr>
            <td>
                Jumlah
            </td>
            <td></td>
            <td align="right" style="border-bottom:solid 0.65mm;border-top:solid 1px;">
                <?= rupiah_positif($totalPttb); ?>
            </td>
        </tr>
        <tr>
            <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="3"><strong>Beban dan Kerugian</strong></td>
        </tr>
        <tr>
            <td><strong>Beban Administrasi dan Umum</strong></td>
            <td align="center">511</td>
            <td></td>
        </tr>
        <?php
        $jumlahBadu = 0;
        $totalBadu = 0;
        $jumlahDebet = 0;
        $jumlahKredit = 0;
        if ($badu) {
            foreach ($badu as $dataBadu) :
                $posisi = $dataBadu['posisi'];
                $jumlahDebet = $dataBadu['debet'];
                $jumlahKredit = $dataBadu['kredit'];
                $jumlahBadu = $jumlahDebet - $jumlahKredit;
                $totalBadu = $totalBadu + $jumlahBadu;
        ?>
                <tr>
                    <td class="text-subakun">
                        <?= $dataBadu['level4']; ?>
                    </td>
                    <td align="center"></td>
                    <td align="right"><?= rupiah_positif($jumlahBadu); ?></td>
                </tr>
        <?php
            endforeach;
        }
        ?>
        <tr>
            <td class="text-subakun">
                Sub Jumlah
            </td>
            <td></td>
            <td align="right" style="border-bottom:solid 1px;border-top:solid 1px;">
                <?= rupiah_positif($totalBadu); ?>
            </td>
        </tr>
        <tr>
            <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td><strong>Beban Pemasaran dan Promosi</strong></td>
            <?php
            $jumlahBpdp = 0;
            $totalBpdp = 0;
            $jumlahDebet = 0;
            $jumlahKredit = 0;
            $catatan_id = "";
            if ($bpdp) {
                foreach ($bpdp as $dataBpdp) :
                    $posisi = $dataBpdp['posisi'];
                    $catatan_id = $dataBpdp['catatan_id'];
                    $jumlahDebet = $dataBpdp['debet'];
                    $jumlahKredit = $dataBpdp['kredit'];
                    $jumlahBpdp = $jumlahDebet - $jumlahKredit;
                    $totalBpdp = $jumlahBpdp;
                endforeach;
            }
            ?>
            <td align="center"><?= $catatan_id; ?></td>
            <td align="right"><?= rupiah_positif($totalBpdp); ?></td>
        </tr>
        <tr>
            <td><strong>Beban Penyusutan dan Amortisasi</strong></td>
            <?php
            $jumlahBpda = 0;
            $totalBpda = 0;
            $jumlahDebet = 0;
            $jumlahKredit = 0;
            $catatan_id = "";
            if ($bpda) {
                foreach ($bpda as $dataBpda) :
                    $posisi = $dataBpda['posisi'];
                    $catatan_id = $dataBpda['catatan_id'];
                    $jumlahDebet = $dataBpda['debet'];
                    $jumlahKredit = $dataBpda['kredit'];
                    $jumlahBpda = $jumlahDebet - $jumlahKredit;
                    $totalBpda = $jumlahBpda;
                endforeach;
            }
            ?>
            <td align="center"><?= $catatan_id; ?></td>
            <td align="right"><?= rupiah_positif($totalBpda); ?></td>
        </tr>
        <tr>
            <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td>
                Jumlah
            </td>
            <td></td>
            <td align="right" style="border-bottom:solid 0.65mm;border-top:solid 1px;">
                <?php
                $jumlahBebanKerugian = 0;
                $jumlahBebanKerugian = $totalBadu + $totalBpdp + $totalBpda;
                echo rupiah_positif($jumlahBebanKerugian);
                ?>
            </td>
        </tr>
        <tr>
            <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="3"><strong>Pendapatan/(Beban) Non Operasional</strong></td>
        </tr>
        <?php
        $jumlahPbll = 0;
        $totalPbll = 0;
        $jumlahDebet = 0;
        $jumlahKredit = 0;
        if ($pbll) {
            foreach ($pbll as $dataPbll) :
                $posisi = $dataPbll['posisi'];
                $jumlahDebet = $dataPbll['debet'];
                $jumlahKredit = $dataPbll['kredit'];
                $jumlahPbll = $jumlahKredit - $jumlahDebet;
                $totalPbll = $totalPbll + $jumlahPbll;
        ?>
                <tr>
                    <td class="text-subakun">
                        <?= $dataPbll['level3']; ?>
                    </td>
                    <td width="10%" align="center"><?= $dataPbll['catatan_id']; ?></td>
                    <td width="18%" align="right"><?= rupiah_positif($jumlahPbll); ?></td>
                </tr>
        <?php
            endforeach;
        }
        ?>
        <tr>
            <td>
                Jumlah
            </td>
            <td></td>
            <td align="right" style="border-bottom:solid 1px;border-top:solid 1px;">
                <?= rupiah_positif($totalPbll); ?>
            </td>
        </tr>
        <tr>
            <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td><strong>Jumlah Beban dan Kerugian</strong></td>
            <td></td>
            <td align="right" style="border-bottom:solid 0.65mm;border-top:solid 1px;">
                <strong>
                    <?php
                    $totalBebanKerugian = 0;
                    $totalBebanKerugian = $jumlahBebanKerugian - $totalPbll;
                    echo rupiah_positif($totalBebanKerugian);
                    ?>
                </strong>
            </td>
        </tr>
        <tr>
            <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td>HASIL USAHA SEBELUM PAJAK</td>
            <td></td>
            <td align="right" style="border-bottom:solid 1px;border-top:solid 1px;">
                <strong>
                    <?php
                    $hasilSebelumPajak = 0;
                    $hasilSebelumPajak = $totalPttb - $totalBebanKerugian;
                    echo rupiah_positif($hasilSebelumPajak);
                    ?>
                </strong>
            </td>
        </tr>
        <tr>
            <td>PAJAK PENGHASILAN</td>
            <td></td>
            <td align="right" style="border-bottom:solid 1px;">
                <strong>
                    <?php
                    $jumlahPajakPenghasilan = 0;
                    echo rupiah_positif($jumlahPajakPenghasilan);
                    ?>
                </strong>
            </td>
        </tr>
        <tr>
            <td><strong>HASIL USAHA SETELAH PAJAK</strong></td>
            <td></td>
            <td align="right" style="border-bottom:solid 0.65mm;">
                <strong>
                    <?php
                    $hasilSetelahPajak = 0;
                    $hasilSetelahPajak = $hasilSebelumPajak - $jumlahPajakPenghasilan;
                    echo rupiah_positif($hasilSetelahPajak);
                    ?>
                </strong>
            </td>
        </tr>
        <tr>
            <td>KENAIKAN/(PENURUNAN) ASET BERSIH</td>
            <td></td>
            <td align="right" style="border-bottom:solid 1px;">
                <?php
                $akun = "313";
                $saldoabttAk = 0;
                $saldoabttAk = saldoAkun6Laporan($akhirbuku, $akun);
                echo rupiah_positif($saldoabttAk);
                // $jumlahPajakPenghasilan = 0;
                // echo rupiah_positif($jumlahPajakPenghasilan);
                ?>
            </td>
        </tr>
        <tr>
            <td><strong>KENAIKAN/(PENURUNAN)ASET BERSIH TAHUN BERJALAN</strong></td>
            <td></td>
            <td align="right" style="border-bottom:solid 0.65mm;">
                <strong>
                    <?php
                    $hasilAbttTahunBerjalan = 0;
                    $hasilAbttTahunBerjalan = $hasilSetelahPajak + $saldoabttAk;
                    echo rupiah_positif($hasilAbttTahunBerjalan);
                    ?>
                </strong>
            </td>
        </tr>
    </table>
</body>

</html>