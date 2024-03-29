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
    <?php
    $pembukuan = $pembukuan_id;
    $tanggal = $akhir_periode;
    $format = "years";
    $jml = -1;
    $buku_awalA = $awal_periode;
    $buku_awalB = manipulasiTanggal($buku_awalA, $jml, $format);
    $tanggallalu = manipulasiTanggal($tanggal, $jml, $format);
    $tahunlalu = manipulasiTahun($tanggal, $jml, $format);
    ?>
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
            Untuk Tahun Yang Berakhir <?= format_indo($akhirbuku); ?> dan <?= $tahunlalu ?><br>
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
                <?= format_indo($tanggal); ?>
            </td>
            <td width="18%" align="center" style="border-bottom:solid 1px;">
                1 Januari S/d<br>
                <?= format_indo($tanggallalu); ?>
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td align="center">( Rp. )</td>
            <td align="center">( Rp. )</td>
        </tr>
    </table>
    <br>
    <table class="tabel-laporan">
        <tr>
            <td colspan="4"><strong>Pendapatan Tidak Terikat Bersih</strong></td>
        </tr>
        <?php
        $jumlahPttbA = 0;
        $totalPttbA = 0;
        $jumlahDebetA = 0;
        $jumlahKreditA = 0;
        $jumlahPttbB = 0;
        $totalPttbB = 0;
        $jumlahDebetB = 0;
        $jumlahKreditB = 0;
        if ($pttb) {
            foreach ($pttb as $dataPttb) :
                $posisi = $dataPttb['posisi'];
                //2020
                $jumlahDebetA = $dataPttb['debetA'];
                $jumlahKreditA = $dataPttb['kreditA'];
                $jumlahPttbA = $jumlahKreditA - $jumlahDebetA;
                $totalPttbA = $totalPttbA + $jumlahPttbA;
                //2019
                $jumlahDebetB = $dataPttb['debetB'];
                $jumlahKreditB = $dataPttb['kreditB'];
                $jumlahPttbB = $jumlahKreditB - $jumlahDebetB;
                $totalPttbB = $totalPttbB + $jumlahPttbB;
        ?>
                <tr>
                    <td class="text-subakun">
                        <?= $dataPttb['level3']; ?>
                    </td>
                    <td align="center" width="10%"><?= $dataPttb['catatan_id']; ?></td>
                    <td align="right" width="18%"><?= rupiah_positif($jumlahPttbA); ?></td>
                    <td align="right" width="18%"><?= rupiah_positif($jumlahPttbB); ?></td>
                </tr>
        <?php
            endforeach;
        }
        ?>
        <tr>
            <td>Jumlah</td>
            <td align="center" width="10%"></td>
            <td align="right" width="18%" style="border-bottom:solid 0.65mm;border-top:solid 1px;"><?= rupiah_positif($totalPttbA); ?></td>
            <td align="right" width="18%" style="border-bottom:solid 0.65mm;border-top:solid 1px;"><?= rupiah_positif($totalPttbB); ?></td>
        </tr>
        <tr>
            <td colspan="4">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="4"><strong>Beban dan Kerugian</strong></td>
        </tr>
        <tr>
            <td><strong>Beban Administrasi dan Umum</strong></td>
            <td align="center">511</td>
            <td></td>
            <td></td>
        </tr>
        <?php
        $jumlahBaduA = 0;
        $totalBaduA = 0;
        $jumlahDebetA = 0;
        $jumlahKreditA = 0;
        $jumlahBaduB = 0;
        $totalBaduB = 0;
        $jumlahDebetB = 0;
        $jumlahKreditB = 0;
        if ($badu) {
            foreach ($badu as $dataBadu) :
                $posisi = $dataBadu['posisi'];
                //2020
                $jumlahDebetA = $dataBadu['debetA'];
                $jumlahKreditA = $dataBadu['kreditA'];
                $jumlahBaduA = $jumlahDebetA - $jumlahKreditA;
                $totalBaduA = $totalBaduA + $jumlahBaduA;
                //2019
                $jumlahDebetB = $dataBadu['debetB'];
                $jumlahKreditB = $dataBadu['kreditB'];
                $jumlahBaduB = $jumlahDebetB - $jumlahKreditB;
                $totalBaduB = $totalBaduB + $jumlahBaduB;
        ?>
                <tr>
                    <td class="text-subakun">
                        <?= $dataBadu['level4']; ?>
                    </td>
                    <td align="center"></td>
                    <td align="right"><?= rupiah_positif($jumlahBaduA); ?></td>
                    <td align="right"><?= rupiah_positif($jumlahBaduB); ?></td>
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
                <?= rupiah_positif($totalBaduA); ?>
            </td>
            <td align="right" style="border-bottom:solid 1px;border-top:solid 1px;">
                <?= rupiah_positif($totalBaduB); ?>
            </td>
        </tr>
        <tr>
            <td colspan="4">&nbsp;</td>
        </tr>
        <tr>
            <td><strong>Beban Pemasaran dan Promosi</strong></td>
            <?php
            $jumlahBpdpA = 0;
            $totalBpdpA = 0;
            $jumlahDebetA = 0;
            $jumlahKreditA = 0;
            $jumlahBpdpB = 0;
            $totalBpdpB = 0;
            $jumlahDebetB = 0;
            $jumlahKreditB = 0;
            $catatanbpdp = "531";
            if ($bpdp) {
                foreach ($bpdp as $dataBpdp) :
                    $posisi = $dataBpdp['posisi'];
                    //2020
                    $jumlahDebetA = $dataBpdp['debetA'];
                    $jumlahKreditA = $dataBpdp['kreditA'];
                    $jumlahBpdpA = $jumlahKreditA - $jumlahDebetA;
                    $totalBpdpA = $totalBpdpA + $jumlahBpdpA;
                    //2019
                    $jumlahDebetB = $dataBpdp['debetB'];
                    $jumlahKreditB = $dataBpdp['kreditB'];
                    $jumlahBpdpB = $jumlahKreditB - $jumlahDebetB;
                    $totalBpdpB = $totalBpdpB + $jumlahBpdpB;
                endforeach;
            }
            if ($jumlahBpdpA != 0 || $jumlahBpdpB != 0) {
                $catatanbpdp = "531";
            } else {
                $catatanbpdp = "";
            }
            ?>
            <td align="center"><?= $catatanbpdp; ?></td>
            <td align="right"><?= rupiah_positif($totalBpdpA); ?></td>
            <td align="right"><?= rupiah_positif($totalBpdpB); ?></td>
        </tr>
        <tr>
            <td><strong>Beban Penyusutan dan Amortisasi</strong></td>
            <?php
            $jumlahBpdaA = 0;
            $totalBpdaA = 0;
            $jumlahDebetA = 0;
            $jumlahKreditA = 0;
            $jumlahBpdaB = 0;
            $totalBpdaB = 0;
            $jumlahDebetB = 0;
            $jumlahKreditB = 0;
            $catatanBpda = "541";
            if ($bpda) {
                foreach ($bpda as $dataBpda) :
                    $posisi = $dataBpda['posisi'];
                    //2020
                    $jumlahDebetA = $dataBpda['debetA'];
                    $jumlahKreditA = $dataBpda['kreditA'];
                    $jumlahBpdaA = $jumlahKreditA - $jumlahDebetA;
                    $totalBpdaA = $totalBpdaA + $jumlahBpdaA;
                    //2019
                    $jumlahDebetB = $dataBpda['debetB'];
                    $jumlahKreditB = $dataBpda['kreditB'];
                    $jumlahBpdaB = $jumlahKreditB - $jumlahDebetB;
                    $totalBpdaB = $totalBpdaB + $jumlahBpdaB;
                endforeach;
            }
            if ($jumlahBpdaA != 0 || $jumlahBpdaB != 0) {
                $catatanBpda = "541";
            } else {
                $catatanBpda = "";
            }
            ?>
            <td align="center"><?= $catatanBpda; ?></td>
            <td align="right"><?= rupiah_positif($totalBpdaA); ?></td>
            <td align="right"><?= rupiah_positif($totalBpdaB); ?></td>
        </tr>
        <tr>
            <td colspan="4">&nbsp;</td>
        </tr>
        <tr>
            <td>Jumlah</td>
            <td align="center" width="10%"></td>
            <td align="right" width="18%" style="border-bottom:solid 0.65mm;border-top:solid 1px;">
                <?php
                $jumlahBebanKerugianA = 0;
                $jumlahBebanKerugianA = $totalBaduA + $totalBpdpA + $totalBpdaA;
                echo rupiah_positif($jumlahBebanKerugianA);
                ?>
            </td>
            <td align="right" width="18%" style="border-bottom:solid 0.65mm;border-top:solid 1px;">
                <?php
                $jumlahBebanKerugianB = 0;
                $jumlahBebanKerugianB = $totalBaduB + $totalBpdpB + $totalBpdaB;
                echo rupiah_positif($jumlahBebanKerugianB);
                ?>
            </td>
        </tr>
        <tr>
            <td colspan="4">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="4"><strong>Pendapatan/(Beban) Non Operasional</strong></td>
        </tr>
        <?php
        $jumlahPbllA = 0;
        $totalPbllA = 0;
        $jumlahDebetA = 0;
        $jumlahKreditA = 0;
        $jumlahPbllB = 0;
        $totalPbllB = 0;
        $jumlahDebetB = 0;
        $jumlahKreditB = 0;
        if ($pbll) {
            foreach ($pbll as $dataPbll) :
                $posisi = $dataPbll['posisi'];
                //2020
                $jumlahDebetA = $dataPbll['debetA'];
                $jumlahKreditA = $dataPbll['kreditA'];
                $jumlahPbllA = $jumlahKreditA - $jumlahDebetA;
                $totalPbllA = $totalPbllA + $jumlahPbllA;
                //2019
                $jumlahDebetB = $dataPbll['debetB'];
                $jumlahKreditB = $dataPbll['kreditB'];
                $jumlahPbllB = $jumlahKreditB - $jumlahDebetB;
                $totalPbllB = $totalPbllB + $jumlahPbllB;
        ?>
                <tr>
                    <td class="text-subakun">
                        <?= $dataPbll['level3']; ?>
                    </td>
                    <td align="center" width="10%"><?= $dataPbll['catatan_id']; ?></td>
                    <td align="right" width="18%"><?= rupiah_positif($jumlahPbllA); ?></td>
                    <td align="right" width="18%"><?= rupiah_positif($jumlahPbllB); ?></td>
                </tr>
        <?php
            endforeach;
        }
        ?>
        <tr>
            <td>Jumlah</td>
            <td align="center" width="10%"></td>
            <td align="right" width="18%" style="border-bottom:solid 1px;border-top:solid 1px;"><?= rupiah_positif($totalPbllA); ?></td>
            <td align="right" width="18%" style="border-bottom:solid 1px;border-top:solid 1px;"><?= rupiah_positif($totalPbllB); ?></td>
        </tr>
        <tr>
            <td colspan="4">&nbsp;</td>
        </tr>
        <tr>
            <td><strong>Jumlah Beban dan Kerugian</strong></td>
            <td></td>
            <td align="right" style="border-bottom:solid 0.65mm;border-top:solid 1px;">
                <strong>
                    <?php
                    $totalBebanKerugianA = 0;
                    $totalBebanKerugianA = $jumlahBebanKerugianA - $totalPbllA;
                    echo rupiah_positif($totalBebanKerugianA);
                    ?>
                </strong>
            </td>
            <td align="right" style="border-bottom:solid 0.65mm;border-top:solid 1px;">
                <strong>
                    <?php
                    $totalBebanKerugianB = 0;
                    $totalBebanKerugianB = $jumlahBebanKerugianB - $totalPbllB;
                    echo rupiah_positif($totalBebanKerugianB);
                    ?>
                </strong>
            </td>
        </tr>
        <tr>
            <td colspan="4">&nbsp;</td>
        </tr>
        <tr>
            <td>HASIL USAHA SEBELUM PAJAK</td>
            <td></td>
            <td align="right" style="border-bottom:solid 1px;border-top:solid 1px;">
                <strong>
                    <?php
                    $hasilSebelumPajakA = 0;
                    $hasilSebelumPajakA = $totalPttbA - $totalBebanKerugianA;
                    echo rupiah_positif($hasilSebelumPajakA);
                    ?>
                </strong>
            </td>
            <td align="right" style="border-bottom:solid 1px;border-top:solid 1px;">
                <strong>
                    <?php
                    $hasilSebelumPajakB = 0;
                    $hasilSebelumPajakB = $totalPttbB - $totalBebanKerugianB;
                    echo rupiah_positif($hasilSebelumPajakB);
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
                    $jumlahPajakPenghasilanA = 0;
                    echo rupiah_positif($jumlahPajakPenghasilanA);
                    ?>
                </strong>
            </td>
            <td align="right" style="border-bottom:solid 1px;">
                <strong>
                    <?php
                    $jumlahPajakPenghasilanB = 0;
                    echo rupiah_positif($jumlahPajakPenghasilanB);
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
                    $hasilSetelahPajakA = 0;
                    $hasilSetelahPajakA = $hasilSebelumPajakA - $jumlahPajakPenghasilanA;
                    echo rupiah_positif($hasilSetelahPajakA);
                    ?>
                </strong>
            </td>
            <td align="right" style="border-bottom:solid 0.65mm;">
                <strong>
                    <?php
                    $hasilSetelahPajakB = 0;
                    $hasilSetelahPajakB = $hasilSebelumPajakB - $jumlahPajakPenghasilanB;
                    echo rupiah_positif($hasilSetelahPajakB);
                    ?>
                </strong>
            </td>
        </tr>
        <tr>
            <td>KENAIKAN/(PENURUNAN) ASET BERSIH</td>
            <td></td>
            <td align="right" style="border-bottom:solid 1px;">
                <strong>
                    <?php
                    $akunA = "313";
                    $saldoabttAkA = 0;
                    $saldoabttAkA = saldoAkun6Laporan($tanggal, $akunA);
                    echo rupiah_positif($saldoabttAkA);
                    ?>
                </strong>
            </td>
            <td align="right" style="border-bottom:solid 1px;">
                <strong>
                    <?php
                    $akunB = "313";
                    $saldoabttAkB = 0;
                    $saldoabttAkB = saldoAkun6Laporan($tanggallalu, $akunB);
                    echo rupiah_positif($saldoabttAkB);
                    ?>
                </strong>
            </td>
        </tr>
        <tr>
            <td><strong>KENAIKAN/(PENURUNAN)ASET BERSIH TAHUN BERJALAN</strong></td>
            <td></td>
            <td align="right" style="border-bottom:solid 0.65mm;">
                <strong>
                    <?php
                    $hasilAbttTahunBerjalanA = 0;
                    $hasilAbttTahunBerjalanA = $hasilSetelahPajakA + $saldoabttAkA;
                    echo rupiah_positif($hasilAbttTahunBerjalanA);
                    ?>
                </strong>
            </td>
            <td align="right" style="border-bottom:solid 0.65mm;">
                <strong>
                    <?php
                    $hasilAbttTahunBerjalanB = 0;
                    $hasilAbttTahunBerjalanB = $hasilSetelahPajakB + $saldoabttAkB;
                    echo rupiah_positif($hasilAbttTahunBerjalanB);
                    ?>
                </strong>
            </td>
        </tr>
    </table>
</body>

</html>