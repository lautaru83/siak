<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-gradient-light">
                <div>
                    <h4 class="card-title">
                        CALK Konsolidasi Komparatif
                    </h4>
                </div>
                <div class="float-right">
                </div>
            </div>
            <div class="card-body">
                <?php
                $pembukuan = $pembukuan_id;
                $format = "years";
                $jml = -1;
                $buku_awalA = $awalbuku;
                $buku_awalB = manipulasiTanggal($buku_awalA, $jml, $format);
                $tanggallalu = manipulasiTanggal($tanggal, $jml, $format);
                $tahunlalu = manipulasiTahun($tanggal, $jml, $format);
                if ($calk) {
                ?>
                    <div class="row">
                        <!-- <div class="col-sm-1"></div> -->
                        <div class="col-sm-12">
                            <div class="mt-2 mx-5">
                                <div class="row">
                                    <div class="col-md-12 mt-2 text-center">
                                        <span class="text-uppercase font-weight-bolder"><?php if ($institusi) {
                                                                                            echo $institusi['keterangan'];
                                                                                        } ?></span>
                                    </div>
                                    <div class="col-md-12 text-md text-center">
                                        <span class="font-weight-normal">CATATAN ATAS LAPORAN KEUANGAN KONSOLIDASI</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        Untuk Tahun Yang Berakhir <?= format_indo($akhirbuku); ?> dan <?= $tahunlalu; ?><br>
                                        (Dinyatakan dalam Rupiah, kecuali dinyatakan lain)
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <hr>
                                    </div>
                                </div>
                                <div class="row">
                                    <table id="tabel3" class="table table-sm table-borderless table-hover">
                                        <tr>
                                            <td class="text-center" width="1%"></td>
                                            <td class="text-center" colspan="2"></td>
                                            </td>
                                            <td width="18%" class="text-center">
                                                <span class="font-weight-normal my-auto">1 Januari S/d<br><?= format_indo($tanggal); ?><div class="border-top my-1"></div>
                                                    <div class="my-1">(Rp)</div>
                                                </span>
                                            </td>
                                            <td width="18%" class="text-center">
                                                <span class="font-weight-normal my-auto">1 Januari S/d<br><?= format_indo($tanggallalu); ?><div class="border-top my-1"></div>
                                                    <div class="my-1">(Rp)</div>
                                                </span>
                                            </td>
                                            <td class="text-center" width="1%"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="6">&nbsp;</td>
                                        </tr>
                                        <?php
                                        $jumlahAkunA = 0;
                                        $jumlahDebetA = 0;
                                        $jumlahKreditA = 0;
                                        $jumlahAkunB = 0;
                                        $jumlahDebetB = 0;
                                        $jumlahKreditB = 0;
                                        if ($calkAkun3) {
                                            foreach ($calkAkun3 as $dataAkun) :
                                                $akunId = $dataAkun['a1level_id'];
                                                $idCatatan = $dataAkun['catatan_id']; //level3
                                                //2020
                                                $jumlahDebetA = $dataAkun['debetA'];
                                                $jumlahKreditA = $dataAkun['kreditA'];
                                                //2019
                                                $jumlahDebetB = $dataAkun['debetB'];
                                                $jumlahKreditB = $dataAkun['kreditB'];
                                                if ($akunId == "100") {
                                                    $jumlahAkunA = $jumlahDebetA - $jumlahKreditA;
                                                    $jumlahAkunB = $jumlahDebetB - $jumlahKreditB;
                                                } else {
                                                    $jumlahAkunA = $jumlahKreditA - $jumlahDebetA;
                                                    $jumlahAkunB = $jumlahKreditB - $jumlahDebetB;
                                                }
                                        ?>
                                                <tr>
                                                    <td></td>
                                                    <td class="text-left" width="3%">
                                                        <span class="font-weight-bolder">
                                                            <?= $idCatatan; ?>
                                                        </span>
                                                    </td>
                                                    <td class="font-weight-bolder"><?= $dataAkun['level3']; ?></td>
                                                    <td class="text-right border-bottom">
                                                        <span class="font-weight-bolder pr-3">
                                                            <?= rupiah_positif($jumlahAkunA); ?></span>
                                                    </td>
                                                    <td class="text-right border-bottom">
                                                        <span class="font-weight-bolder pr-3">
                                                            <?= rupiah_positif($jumlahAkunB); ?></span>
                                                    </td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td>
                                                        <span class="font-weight-normal text-md pl-5">
                                                            Rincian :
                                                        </span>
                                                    </td>
                                                    <td class="text-right">
                                                        <span class="font-weight-bolder">
                                                        </span>
                                                    </td>
                                                    <td class="text-right">
                                                        <span class="font-weight-bolder">
                                                        </span>
                                                    </td>
                                                    <td></td>
                                                </tr>
                                                <?php
                                                $debet6A = 0;
                                                $kredit6A = 0;
                                                $jumlah6A = 0;
                                                $total6A = 0;
                                                $debet6B = 0;
                                                $kredit6B = 0;
                                                $jumlah6B = 0;
                                                $total6B = 0;
                                                $akun6 = $this->Laporan_model->calkAkun6KomKonsolidasi($idCatatan);
                                                if ($akun6) {
                                                    foreach ($akun6 as $dataAkun6) :
                                                        $posisi = $dataAkun6['posisi'];
                                                        $debet6A = $dataAkun6['debetA'];
                                                        $kredit6A = $dataAkun6['kreditA'];
                                                        $debet6B = $dataAkun6['debetB'];
                                                        $kredit6B = $dataAkun6['kreditB'];
                                                        if ($posisi == "D") { //2020
                                                            $jumlah6A = $debet6A - $kredit6A;
                                                            $jumlah6B = $debet6B - $kredit6B;
                                                        } else { //2019
                                                            $jumlah6A = $kredit6A - $debet6A;
                                                            $jumlah6B = $kredit6B - $debet6B;
                                                        }
                                                        $total6A = $total6A + $jumlah6A;
                                                        $total6B = $total6B + $jumlah6B;
                                                ?>
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td class="font-weight-normal text-md pl-5">- &nbsp;<?= $dataAkun6['level5']; ?></td>
                                                            <td class="text-right pr-3"><?= rupiah_positif($jumlah6A); ?></td>
                                                            <td class="text-right pr-3"><?= rupiah_positif($jumlah6B); ?></td>
                                                            <td></td>
                                                        </tr>
                                                <?php
                                                    endforeach;
                                                }
                                                ?>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td>
                                                        <span class="font-weight-normal text-md pl-5">
                                                            Sub Jumlah
                                                        </span>
                                                    </td>
                                                    <td class="text-right pr-3"><?= rupiah_positif($total6A); ?></td>
                                                    <td class="text-right pr-3"><?= rupiah_positif($total6B); ?></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="6">&nbsp;</td>
                                                </tr>

                                        <?php
                                            endforeach;
                                        }
                                        ?>
                                        <tr>
                                            <td colspan="6"><?php //var_dump($tes); 
                                                            ?></td>
                                        </tr>

                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-sm-1"></div> -->
                    </div>
                <?php } ?>
                <div class="row invisible">
                    <div class="col-sm-12 text-center">
                        <form method="POST" action="<?= base_url('akuntansi/catatan/cetakdata'); ?>" target="_blank">
                            <input type="hidden" id="laporan" name="laporan" value="<?= $jenislap; ?>">
                            <input type="hidden" id="bukuawal" name="bukuawal" value="<?= $awalbuku; ?>">
                            <input type="hidden" id="bukuakhir" name="bukuakhir" value="<?= $akhirbuku; ?>">
                            <input type="hidden" id="tgl1" name="tgl1" value="<?= $awalbuku; ?>">
                            <input type="hidden" id="tgl2" name="tgl2" value="<?= $tanggal; ?>">
                            <input type="hidden" id="pembukuan_id" name="pembukuan_id" value="<?= $pembukuan_id; ?>">
                            <button type="submit" id="btn-cetak-catatan" class="btn btn-link">Tampilkan</button>
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