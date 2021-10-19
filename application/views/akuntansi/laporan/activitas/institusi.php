<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-gradient-light">
                <div>
                    <h4 class="card-title">
                        Aktivitas Institusi
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
                if ($activitas) {
                ?>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <span class="text-uppercase font-weight-bolder"><?php if ($institusi) {
                                                                                echo $institusi['keterangan'];
                                                                            } ?></span>
                        </div>
                        <div class="col-md-12 text-center">
                            <span class="font-weight-bolder">LAPORAN AKTIVITAS</span>
                        </div>
                    </div>
                    <table id="tabel3" class="table table-sm table-borderless table-hover">
                        <thead>
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-center" colspan="4">
                                    Untuk Tahun Yang Berakhir <?= format_indo($akhirbuku); ?><br>
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
                                <td class="text-center" colspan="2"></td>
                                <td width="15%" class="text-center font-weight-normal">
                                    <span class="font-weight-normal my-auto">
                                        <br>
                                        Catatan
                                    </span>
                                    <div class="border-top my-1"></div>
                                </td>
                                <td width="15%" class="text-center">
                                    <span class="font-weight-normal my-auto">
                                        1 Januari S/d<br>
                                        <?= format_indo($tanggal); ?>
                                        <div class="border-top my-1"></div>
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
                                        <td class="text-center"></td>
                                        <td colspan="2">
                                            <div class="font-weight-normal my-auto pl-4"><?= $dataPttb['level3']; ?></div>
                                        </td>
                                        <td class="text-center"><?= $dataPttb['catatan_id']; ?></td>
                                        <td class="text-right"><?= rupiah_positif($jumlahPttb); ?></td>
                                        <td class="text-right"></td>
                                    </tr>
                            <?php
                                endforeach;
                            }
                            ?>
                            <tr>
                                <td>
                                    <div class="row my-0"></div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td colspan="2">
                                    <span class="font-weight-normal">Jumlah</span>
                                </td>
                                <td></td>
                                <td class="border-top border-bottom text-right">
                                    <span class="font-weight-normal"><?= rupiah_positif($totalPttb); ?></span>
                                </td>
                                <td class="text-right"></td>
                            </tr>
                            <tr>
                                <td>
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
                                <td colspan="2">
                                    <span class="font-weight-bolder text-md">Beban Administrasi dan Umum</span>
                                </td>
                                <td class="text-center">521</td>
                                <td></td>
                                <td class="text-right"></td>
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
                                        <td class="text-center"></td>
                                        <td colspan="2">
                                            <div class="font-weight-normal my-auto pl-4"><?= $dataBadu['level4']; ?></div>
                                        </td>
                                        <td class="text-center"></td>
                                        <td class="text-right"><?= rupiah_positif($jumlahBadu); ?></td>
                                        <td class="text-right"></td>
                                    </tr>
                            <?php
                                endforeach;
                            }
                            ?>
                            <tr>
                                <td>
                                    <div class="row my-0"></div>
                                </td>
                            </tr>

                            <tr>
                                <td class="text-center"></td>
                                <td colspan="2">
                                    <span class="font-weight-normal my-auto pl-4 ">Sub Jumlah</span>
                                </td>
                                <td></td>
                                <td class="border-top border-bottom  text-right">
                                    <?= rupiah_positif($totalBadu); ?>
                                </td>
                                <td class="text-right"></td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="row my-0"></div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td colspan="2">
                                    <span class="font-weight-bolder text-md">Beban Promosi dan Pemasaran</span>
                                </td>
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
                                <td class="text-center"><?= $catatan_id; ?></td>
                                <td class="text-right"><?= rupiah_positif($totalBpdp); ?></td>
                                <td class="text-right"></td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td colspan="2">
                                    <span class="font-weight-bolder text-md">Beban Penyusutan dan Amortisasi</span>
                                </td>
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
                                <td class="text-center"><?= $catatan_id; ?></td>
                                <td class="text-right"><?= rupiah_positif($totalBpda); ?></td>
                                <td class="text-right"></td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="row my-0"></div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td colspan="2">
                                    <span class="font-weight-normal">Jumlah</span>
                                </td>
                                <td></td>
                                <td class="border-top border-bottom text-right">
                                    <?php
                                    $jumlahBebanKerugian = 0;
                                    $jumlahBebanKerugian = $totalBadu + $totalBpdp + $totalBpda;
                                    echo rupiah_positif($jumlahBebanKerugian);
                                    ?>
                                </td>
                                <td class="text-right"></td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="row my-0"></div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td colspan="4">
                                    <span class="font-weight-normal text-md">
                                        Pendapatan/(Beban) Non Operasional
                                    </span>
                                </td>
                                <td class="text-right"></td>
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
                                        <td class="text-center"></td>
                                        <td colspan="2">
                                            <div class="font-weight-normal my-auto pl-4"><?= $dataPbll['level3']; ?></div>
                                        </td>
                                        <td class="text-center"><?= $dataPbll['catatan_id']; ?></td>
                                        <td class="text-right"><?= rupiah_positif($jumlahPbll); ?></td>
                                        <td class="text-right"></td>
                                    </tr>
                            <?php
                                endforeach;
                            }
                            ?>
                            <tr>
                                <td>
                                    <div class="row my-0"></div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td colspan="2">
                                    <span class="font-weight-normal">Jumlah</span>
                                </td>
                                <td></td>
                                <td class="border-top border-bottom text-right">
                                    <span class="text-dark"><?= rupiah_positif($totalPbll); ?></span>
                                </td>
                                <td class="text-right"></td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="row my-1"></div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td colspan="2">
                                    <span class="font-weight-bolder">Jumlah Beban dan Kerugian </span>
                                </td>
                                <td></td>
                                <td class="border-top border-top  text-right">
                                    <span class="font-weight-bolder">
                                        <?php
                                        $totalBebanKerugian = 0;
                                        $totalBebanKerugian = $jumlahBebanKerugian - $totalPbll;
                                        echo rupiah_positif($totalBebanKerugian);
                                        ?>
                                    </span>
                                </td>
                                <td class="text-right"></td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td colspan="2">
                                    <span class="font-weight-normal">HASIL USAHA SEBELUM PAJAK</span>
                                </td>
                                <td></td>
                                <td class="border-top border-top  text-right">
                                    <span class="font-weight-normal">
                                        <?php
                                        $hasilSebelumPajak = 0;
                                        $hasilSebelumPajak = $totalPttb - $totalBebanKerugian;
                                        echo rupiah_positif($hasilSebelumPajak);
                                        ?>
                                    </span>
                                </td>
                                <td class="text-right"></td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td colspan="2">
                                    <span class="font-weight-normal">PAJAK PENGHASILAN</span>
                                </td>
                                <td></td>
                                <td class="border-top border-top  text-right">
                                    <span class="font-weight-normal">
                                        <?php
                                        $jumlahPajakPenghasilan = 0;
                                        echo rupiah_positif($jumlahPajakPenghasilan);
                                        ?>
                                    </span>
                                </td>
                                <td class="text-right"></td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td colspan="2">
                                    <span class="font-weight-bolder">HASIL USAHA SETELAH PAJAK</span>
                                </td>
                                <td></td>
                                <td class="border-top border-bottom text-right">
                                    <span class="font-weight-bolder">
                                        <?php
                                        $hasilSetelahPajak = 0;
                                        $hasilSetelahPajak = $hasilSebelumPajak - $jumlahPajakPenghasilan;
                                        echo rupiah_positif($hasilSetelahPajak);
                                        ?>
                                    </span>
                                </td>
                                <td class="text-right"></td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td colspan="2">
                                    <span class="font-weight-normal">KENAIKAN/(PENURUNAN) ASET BERSIH</span>
                                </td>
                                <td></td>
                                <td class="border-top border-bottom text-right">
                                    <span class="font-weight-normal">
                                        <?php
                                        $akun = "313";
                                        $saldoabttAk = 0;
                                        $saldoabttAk = saldoAkun6Laporan($tanggal, $akun);
                                        echo rupiah_positif($saldoabttAk);
                                        // $hasilSetelahPajak = 0;
                                        // $hasilSetelahPajak = $hasilSebelumPajak - $jumlahPajakPenghasilan;
                                        // echo rupiah_positif($hasilSetelahPajak);
                                        ?>
                                    </span>
                                </td>
                                <td class="text-right"></td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td colspan="2">
                                    <span class="font-weight-bolder">KENAIKAN/(PENURUNAN)ASET BERSIH TAHUN BERJALAN</span>
                                </td>
                                <td></td>
                                <td class="border-top border-bottom text-right">
                                    <span class="font-weight-bolder">
                                        <?php
                                        $hasilAbttTahunBerjalan = 0;
                                        $hasilAbttTahunBerjalan = $hasilSetelahPajak + $saldoabttAk;
                                        echo rupiah_positif($hasilAbttTahunBerjalan);
                                        ?>
                                    </span>
                                </td>
                                <td class="text-right"></td>
                            </tr>
                        </tbody>
                    </table>
                <?php } ?>
                <div class="row invisible">
                    <div class="col-sm-12 text-center">
                        <form method="POST" action="<?= base_url('akuntansi/activitas/cetakdata'); ?>" target="_blank">
                            <input type="hidden" id="laporan" name="laporan" value="<?= $jenislap; ?>">
                            <input type="hidden" id="bukuawal" name="bukuawal" value="<?= $awalbuku; ?>">
                            <input type="hidden" id="bukuakhir" name="bukuakhir" value="<?= $akhirbuku; ?>">
                            <input type="hidden" id="tgl1" name="tgl1" value="<?= $awalbuku; ?>">
                            <input type="hidden" id="tgl2" name="tgl2" value="<?= $tanggal; ?>">
                            <input type="hidden" id="pembukuan_id" name="pembukuan_id" value="<?= $pembukuan_id; ?>">
                            <button type="submit" id="btn-cetak-activitas" class="btn btn-link">Tampilkan</button>
                        </form>
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