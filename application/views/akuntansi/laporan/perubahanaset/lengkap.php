<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-gradient-light">
                <div>
                    <h4 class="card-title">
                        Perubahan Aset Bersih Konsolidasi
                    </h4>
                </div>
                <div class="float-right">
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div style="height: 25px;">
                    </div>
                </div>
                <?php
                //var_dump($pbll);
                ?>
                <?php
                $pembukuan = $tahunbuku;
                $format = "years";
                $jml = -1;
                $buku_awalA = $awalbuku;
                $buku_awalB = manipulasiTanggal($buku_awalA, $jml, $format);
                $tanggallalu = manipulasiTanggal($tanggal, $jml, $format);
                $tahunlalu = manipulasiTahun($tanggal, $jml, $format);
                if ($activitas) {
                ?>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <span class="text-uppercase font-weight-bolder"><?php if ($institusi) {
                                                                                echo $institusi['keterangan'];
                                                                            } ?></span>
                        </div>
                        <div class="col-md-12 text-center">
                            <span class="font-weight-bolder">LAPORAN PERUBAHAN ASET BERSIH KONSOLIDASI</span>
                        </div>
                    </div>
                    <table id="tabel3" class="table table-sm table-borderless table-hover">
                        <thead>
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-center" colspan="4">
                                    Untuk Tahun Yang Berakhir <?= format_indo($this->session->userdata('buku_akhir')); ?> dan <?= $tahunlalu ?><br>
                                    (Dinyatakan dalam Rupiah, kecuali dinyatakan lain)

                                </td>
                                <td class="text-center"></td>
                            </tr>
                            <!-- <tr>
                                <td class="text-center"></td>
                                <td class="text-center" colspan="4"></td>
                                <td class="text-center"></td>
                            </tr> -->
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-center border-bottom" colspan="4"></td>
                                <td class="text-center"></td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-center border-top" colspan="4"></td>
                                <td class="text-center"></td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td width="12%" class="text-center font-weight-normal">
                                    <span class="font-weight-normal my-auto">Catatan</span>
                                    <div class="border-top my-1"></div>
                                </td>
                                <td width="12%" class="text-center">
                                    <span class="font-weight-normal my-auto"><?= format_indo($tanggal); ?><div class="border-top my-1"></div>
                                        <div class="my-1">(Rp)</div>
                                    </span>
                                </td>
                                <td width="12%" class="text-center">
                                    <span class="font-weight-normal my-auto"><?= format_indo($tanggallalu); ?><div class="border-top my-1"></div>
                                        <div class="my-1">(Rp)</div>
                                    </span>
                                </td>
                                <td class="text-center"></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center"></td>
                                <td colspan="4">
                                    <span class="font-weight-bolder text-md">Pendapatan Tidak Terikat Bersih</span>
                                </td>
                                <td class="text-right"></td>
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
                                        <td class="text-center"></td>
                                        <td>
                                            <div class="font-weight-normal my-auto pl-4"><?= $dataPttb['level3']; ?></div>
                                        </td>
                                        <td class="text-center"><?= $dataPttb['catatan_id']; ?></td>
                                        <td class="text-right"><?= rupiah_positif($jumlahPttbA); ?></td>
                                        <td class="text-right"><?= rupiah_positif($jumlahPttbB); ?></td>
                                        <td class="text-right"></td>
                                    </tr>
                            <?php
                                endforeach;
                            }
                            ?>
                            <!-- <tr>
                                <td>
                                    <div class="row my-0"></div>
                                </td>
                            </tr> -->
                            <tr>
                                <td class="text-center"></td>
                                <td colspan="2">
                                    <span class="font-weight-bolder">Jumlah</span>
                                </td>
                                <td class="border-top border-bottom text-right">
                                    <span class="font-weight-bolder"><?= rupiah_positif($totalPttbA); ?></span>
                                </td>
                                <td class="border-top border-bottom text-right">
                                    <span class="font-weight-bolder"><?= rupiah_positif($totalPttbB); ?></span>
                                </td>
                                <td class="text-right"></td>
                            </tr>
                            <tr>
                                <td colspan="6">
                                    <div class="row my-0"></div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td colspan="4">
                                    <span class="font-weight-bolder text-md">Beban dan Kerugian</span>
                                </td>
                                <td class="text-right"></td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td>
                                    <span class="font-weight-bolder text-md">Beban Administrasi dan Umum</span>
                                </td>
                                <td class="text-center">521</td>
                                <td></td>
                                <td></td>
                                <td class="text-right"></td>
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
                                        <td class="text-center"></td>
                                        <td>
                                            <div class="font-weight-normal my-auto pl-4"><?= $dataBadu['level4']; ?></div>
                                        </td>
                                        <td class="text-center"></td>
                                        <td class="text-right"><?= rupiah_positif($jumlahBaduA); ?></td>
                                        <td class="text-right"><?= rupiah_positif($jumlahBaduB); ?></td>
                                        <td class="text-right"></td>
                                    </tr>
                            <?php
                                endforeach;
                            }
                            ?>
                            <tr>
                                <td class="text-center"></td>
                                <td colspan="2">
                                    <span class="font-weight-normal my-auto pl-4 ">Sub Jumlah</span>
                                </td>
                                <td class="border-top border-bottom  text-right">
                                    <?= rupiah_positif($totalBaduA); ?>
                                </td>
                                <td class="border-top border-bottom  text-right">
                                    <?= rupiah_positif($totalBaduB); ?>
                                </td>
                                <td class="text-right"></td>
                            </tr>
                            <tr>
                                <td colspan="6">
                                    <div class="row my-0"></div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td>
                                    <div class="font-weight-bolder">Beban Promosi dan Pemasaran</div>
                                </td>
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
                                ?>


                                <?php
                                    endforeach;
                                }
                                ?>
                                <td class="text-center"><?= $catatanbpdp; ?></td>
                                <td class="text-right"><?= rupiah_positif($jumlahBpdpA); ?></td>
                                <td class="text-right"><?= rupiah_positif($jumlahBpdpB); ?></td>
                                <td class="text-right"></td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td>
                                    <div class="font-weight-bolder">Beban Penyusutan dan Amortisasi</div>
                                </td>
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
                                ?>
                                <?php
                                    endforeach;
                                }
                                ?>
                                <td class="text-center"><?= $catatanBpda; ?></td>
                                <td class="text-right"><?= rupiah_positif($jumlahBpdaA); ?></td>
                                <td class="text-right"><?= rupiah_positif($jumlahBpdaB); ?></td>
                                <td class="text-right"></td>
                            </tr>
                            <tr>
                                <td colspan="6">
                                    <div class="row my-0"></div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td colspan="2">
                                    <span class="font-weight-normal">Jumlah</span>
                                </td>
                                <td class="border-top border-bottom text-right">
                                    <?php
                                    $jumlahBebanKerugianA = 0;
                                    $jumlahBebanKerugianA = $totalBaduA + $totalBpdpA + $totalBpdaA;
                                    echo rupiah_positif($jumlahBebanKerugianA);
                                    ?>
                                </td>
                                <td class="border-top border-bottom text-right">
                                    <?php
                                    $jumlahBebanKerugianB = 0;
                                    $jumlahBebanKerugianB = $totalBaduB + $totalBpdpB + $totalBpdaB;
                                    echo rupiah_positif($jumlahBebanKerugianB);
                                    ?>
                                </td>
                                <td class="text-right"></td>
                            </tr>
                            <tr>
                                <td colspan="6">
                                    <div class="row my-0"></div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td colspan="4">
                                    <span class="font-weight-bolder text-md">
                                        Pendapatan/(Beban) Non Operasional
                                    </span>
                                </td>
                                <td class="text-right"></td>
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
                                    $jumlahDebetB = $dataPbll['debetB'];
                                    $jumlahKreditB = $dataPbll['kreditB'];
                                    $jumlahDebetA = $dataPbll['debetA'];
                                    $jumlahKreditA = $dataPbll['kreditA'];
                                    //2020
                                    $jumlahPbllA = $jumlahKreditA - $jumlahDebetA;
                                    $totalPbllA = $totalPbllA + $jumlahPbllA;
                                    //2019
                                    $jumlahPbllB = $jumlahKreditB - $jumlahDebetB;
                                    $totalPbllB = $totalPbllB + $jumlahPbllB;
                            ?>
                                    <tr>
                                        <td class="text-center"></td>
                                        <td>
                                            <div class="font-weight-normal my-auto pl-4"><?= $dataPbll['level3']; ?></div>
                                        </td>
                                        <td class="text-center"><?= $dataPbll['catatan_id']; ?></td>
                                        <td class="text-right"><?= rupiah_positif($jumlahPbllA); ?></td>
                                        <td class="text-right"><?= rupiah_positif($jumlahPbllB); ?></td>
                                        <td class="text-right"></td>
                                    </tr>
                            <?php
                                endforeach;
                            }
                            ?>
                            <tr>
                                <td class="text-center"></td>
                                <td colspan="2">
                                    <span class="font-weight-normal">Jumlah</span>
                                </td>
                                <td class="border-top border-bottom text-right">
                                    <?php
                                    // $jumlahBebanKerugianA = 0;
                                    // $jumlahBebanKerugianA = $totalBaduA + $totalBpdpA + $totalBpdaA;
                                    echo rupiah_positif($totalPbllA);
                                    ?>
                                </td>
                                <td class="border-top border-bottom text-right">
                                    <?php
                                    // $jumlahBebanKerugianB = 0;
                                    // $jumlahBebanKerugianB = $totalBaduB + $totalBpdpB + $totalBpdaB;
                                    echo rupiah_positif($totalPbllB);
                                    ?>
                                </td>
                                <td class="text-right"></td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td colspan="2">
                                    <span class="font-weight-bolder">Jumlah Beban dan Kerugian </span>
                                </td>
                                <td class="border-top border-top  text-right">
                                    <span class="font-weight-bolder">
                                        <?php
                                        $totalBebanKerugianA = 0;
                                        $totalBebanKerugianA = $jumlahBebanKerugianA - $totalPbllA;
                                        echo rupiah_positif($totalBebanKerugianA);
                                        ?>
                                    </span>
                                </td>
                                <td class="border-top border-top  text-right">
                                    <span class="font-weight-bolder">
                                        <?php
                                        $totalBebanKerugianB = 0;
                                        $totalBebanKerugianB = $jumlahBebanKerugianB - $totalPbllB;
                                        echo rupiah_positif($totalBebanKerugianB);
                                        ?>
                                    </span>
                                </td>
                                <td class="text-right"></td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td colspan="2">
                                    <span class="font-weight-normal text-md">Kenaikan (Penurunan) Aset Bersih tidak terikat</span>
                                </td>
                                <td class="border-top border-top  text-right">
                                    <span class="font-weight-normal">
                                        <?php
                                        $hasilSebelumPajakA = 0;
                                        $hasilSebelumPajakA = $totalPttbA - $totalBebanKerugianA;
                                        echo rupiah_positif($hasilSebelumPajakA);
                                        ?>
                                    </span>
                                </td>
                                <td class="border-top border-top text-right">
                                    <span class="font-weight-normal">
                                        <?php
                                        $hasilSebelumPajakB = 0;
                                        $hasilSebelumPajakB = $totalPttbB - $totalBebanKerugianB;
                                        echo rupiah_positif($hasilSebelumPajakB);
                                        ?>
                                    </span>
                                </td>
                                <td class="text-right"></td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td colspan="2">
                                    <span class="font-weight-normal text-md">Pajak penghasilan Atas Kenaikan Aset Bersih Tidak Terikat</span>
                                </td>
                                <td class="border-top border-top text-right">
                                    <span class="font-weight-normal">
                                        <?php
                                        $jumlahPajakPenghasilanA = 0;
                                        echo rupiah_positif($jumlahPajakPenghasilanA);
                                        ?>
                                    </span>
                                </td>
                                <td class="border-top border-top text-right">
                                    <span class="font-weight-normal">
                                        <?php
                                        $jumlahPajakPenghasilanB = 0;
                                        echo rupiah_positif($jumlahPajakPenghasilanB);
                                        ?>
                                    </span>
                                </td>
                                <td class="text-right"></td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td colspan="2">
                                    <span class="font-weight-normal">
                                        Kenaikan (Penurunan) Aset Bersih Tidak Terikat
                                    </span>
                                </td>
                                <td class="text-right">
                                    <span class="font-weight-normal">
                                        <?php
                                        $idakun3 = "313";
                                        $saldoAsetMutasiA = saldoAkun6KomInstitusi($buku_awalA, $tanggal, $idakun3, $pembukuan);
                                        echo rupiah_positif($saldoAsetMutasiA);
                                        ?>
                                    </span>
                                </td>
                                <td class="text-right">
                                    <span class="font-weight-normal">
                                        <?php
                                        $idakun3 = "313";
                                        $saldoAsetMutasiB = saldoAkun6KomInstitusi($buku_awalB, $tanggallalu, $idakun3, $tahunlalu);
                                        echo rupiah_positif($saldoAsetMutasiB);
                                        ?>
                                    </span>
                                </td>
                                <td class="text-right"></td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td colspan="2">
                                    <span class="font-weight-bolder">Kenaikan (Penurunan) Aset Bersih Tidak Terikat Setelah Pajak</span>
                                </td>
                                <td class="border-top border-bottom text-right">
                                    <span class="font-weight-bolder">
                                        <?php
                                        $hasilSetelahPajakA = 0;
                                        $hasilSetelahPajakA = $hasilSebelumPajakA + $saldoAsetMutasiA - $jumlahPajakPenghasilanA;
                                        echo rupiah_positif($hasilSetelahPajakA);
                                        ?>
                                    </span>
                                </td>
                                <td class="border-top border-bottom text-right">
                                    <span class="font-weight-bolder">
                                        <?php
                                        $hasilSetelahPajakB = 0;
                                        $hasilSetelahPajakB = $hasilSebelumPajakB + $saldoAsetMutasiB - $jumlahPajakPenghasilanB;
                                        echo rupiah_positif($hasilSetelahPajakB);
                                        ?>
                                    </span>
                                </td>
                                <td class="text-right"></td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td colspan="2">
                                    <span class="font-weight-normal">Jumlah Kenaikan Aset Bersih</span>
                                </td>
                                <td class="text-right">
                                    <span class="font-weight-normal">
                                        <?php
                                        echo rupiah_positif($hasilSetelahPajakA);
                                        ?>
                                    </span>
                                </td>
                                <td class="text-right">
                                    <span class="font-weight-normal">
                                        <?php
                                        echo rupiah_positif($hasilSetelahPajakB);
                                        ?>
                                    </span>
                                </td>
                                <td class="text-right"></td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td colspan="2">
                                    <span class="font-weight-normal">Aset Bersih Awal tahun</span>
                                </td>
                                <td class="text-right">
                                    <span class="font-weight-normal">
                                        <?php
                                        $idakun2 = "310";
                                        $saldoAsetAwalTahunA = saldoAwalAbttKomInstitusi($idakun2, $pembukuan);
                                        echo rupiah_positif($saldoAsetAwalTahunA);
                                        ?>
                                    </span>
                                </td>
                                <td class="text-right">
                                    <span class="font-weight-normal">
                                        <?php
                                        $idakun2 = "310";
                                        $saldoAsetAwalTahunB = saldoAwalAbttKomInstitusi($idakun2, $tahunlalu);
                                        echo rupiah_positif($saldoAsetAwalTahunB);
                                        ?>
                                    </span>
                                </td>
                                <td class="text-right"></td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td colspan="2">
                                    <span class="font-weight-bolder">Aset Bersih Akhir tahun</span>
                                </td>
                                <td class="text-right border-top border-bottom">
                                    <span class="font-weight-bolder">
                                        <?php
                                        $saldoAsetAkhirTahunA = 0;
                                        $saldoAsetAkhirTahunA = $saldoAsetAwalTahunA + $hasilSetelahPajakA;
                                        echo rupiah_positif($saldoAsetAkhirTahunA);
                                        ?>
                                    </span>
                                </td>
                                <td class="text-right border-top border-bottom">
                                    <span class="font-weight-bolder">
                                        <?php
                                        $saldoAsetAkhirTahunB = 0;
                                        $saldoAsetAkhirTahunB = $saldoAsetAwalTahunB + $hasilSetelahPajakB;
                                        echo rupiah_positif($saldoAsetAkhirTahunB);
                                        ?>
                                    </span>
                                </td>
                                <td class="text-right"></td>
                            </tr>
                        </tbody>
                    </table>
                <?php } ?>
                <div class="row">
                    <div style="height: 25px;">
                    </div>
                </div>
            </div>
            <!-- /.card-body -->

        </div>
        <!-- /.card -->
    </div>
    <!-- /.col-md-12 -->
</div>
<!-- /.row -->