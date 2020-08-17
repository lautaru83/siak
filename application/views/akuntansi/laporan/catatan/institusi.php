<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-gradient-light">
                <div>
                    <h4 class="card-title">
                        CALK Institusi
                    </h4>
                </div>
                <div class="float-right">
                </div>
            </div>
            <div class="card-body">
                <?php
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
                                        <span class="font-weight-normal">CATATAN ATAS LAPORAN KEUANGAN</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        Untuk Tahun Yang Berakhir <?= format_indo($this->session->userdata('buku_akhir')); ?><br>
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
                                        <thead>
                                            <tr>
                                                <td class="text-center"></td>
                                                <td class="text-center" width="90%" colspan="4">
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
                                                <td class="text-center" colspan="2"></td>
                                                <td width="15%" class="text-center font-weight-normal">
                                                    <!-- <span class="font-weight-normal my-auto">Catatan</span>
                                    <div class="border-top my-1"></div> -->
                                                </td>
                                                <td width="15%" class="text-center">
                                                    <span class="font-weight-normal my-auto">1 Januari S/d<br><?= format_indo($tanggal); ?><div class="border-top my-1"></div>
                                                        <div class="my-1">(Rp)</div>
                                                    </span>
                                                </td>
                                                <td class="text-center"></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="row my-1"></div>
                                                </td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $jumlah = 0;
                                            $debet = 0;
                                            $kredit = 0;
                                            if ($calkAkun3) {
                                                foreach ($calkAkun3 as $dataCalk3) :
                                                    $idCatatan = $dataCalk3['catatan_id']; //level3 id
                                                    $akun1 = $dataCalk3['a1level_id'];
                                                    $debet = $dataCalk3['debet'];
                                                    $kredit = $dataCalk3['kredit'];
                                                    if ($akun1 == "100") {
                                                        $jumlah = $debet - $kredit;
                                                    } elseif ($akun1 == "200") {
                                                        $jumlah = $kredit - $debet;
                                                    } else {
                                                        $jumlah = $kredit - $debet;
                                                    }

                                            ?>
                                                    <tr>
                                                        <td class="text-center"></td>
                                                        <td class="text-left" width="4%">
                                                            <span class="font-weight-bolder text-md">
                                                                <?= $idCatatan; ?>
                                                            </span>
                                                        </td>
                                                        <td colspan="2">
                                                            <span class="font-weight-bolder text-md">
                                                                <?= $dataCalk3['level3']; ?>
                                                            </span>
                                                        </td>
                                                        <td class="text-right  border-bottom">
                                                            <span class="font-weight-bolder text-md">
                                                                <?= rupiah_positif($jumlah); ?>
                                                            </span>
                                                        </td>
                                                        <td class="text-right"></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center"></td>
                                                        <td class="text-center"></td>
                                                        <td colspan="2">
                                                            <span class="font-weight-normal text-md pl-5">
                                                                Rincian :
                                                            </span>
                                                        </td>
                                                        <td class="text-right">
                                                            <span class="font-weight-bolder">
                                                            </span>
                                                        </td>
                                                        <td class="text-right"></td>
                                                    </tr>
                                                    <?php
                                                    $akun6 = $this->Laporan_model->calkAkun6Institusi($idCatatan);
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
                                                                <td class="text-center"></td>
                                                                <td class="text-center"></td>
                                                                <td colspan="2">
                                                                    <span class="font-weight-normal text-md pl-5">
                                                                        - <?= $dataAkun6['level6']; ?>
                                                                    </span>
                                                                </td>
                                                                <td class="text-right">
                                                                    <span class="font-weight-normal">
                                                                        <?= rupiah_positif($jumlah6); ?>
                                                                    </span>
                                                                </td>
                                                                <td class="text-right"></td>
                                                            </tr>
                                                    <?php
                                                        endforeach;
                                                    }
                                                    ?>
                                                    <tr>
                                                        <td class="text-center"></td>
                                                        <td class="text-center"></td>
                                                        <td colspan="2">
                                                            <span class="font-weight-normal text-md pl-5">
                                                                Sub Jumlah
                                                            </span>
                                                        </td>
                                                        <td class="text-right border-top border-bottom">
                                                            <span class="font-weight-normal">
                                                                <?= rupiah_positif($total6); ?>
                                                            </span>
                                                        </td>
                                                        <td class="text-right"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="row my-1"></div>
                                                        </td>
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
                                                    $a3level_id = $dataCalkAb['a3level_id']; //level2 id
                                                    $posisiAb = $dataCalkAb['posisi'];
                                                    $debetAb = $dataCalkAb['debet'];
                                                    $kreditAb = $dataCalkAb['kredit'];
                                                    $jumlahAb = $kreditAb + $jumlahAbtt - $debetAb;
                                                    //     if ($idCatatanAb == "310") {
                                                    // } else {
                                                    //     $jumlahAb = $kreditAb - $debetAb;
                                                    // }
                                                    $totalAb = $totalAb + $jumlahAb;
                                            ?>
                                                    <tr>
                                                        <td class="text-center"></td>
                                                        <td class="text-left" width="4%">
                                                            <span class="font-weight-bolder text-md">
                                                                <?= $idCatatanAb ?>
                                                            </span>
                                                        </td>
                                                        <td colspan="2">
                                                            <span class="font-weight-bolder text-md">
                                                                <?= $dataCalkAb['level2']; ?>
                                                            </span>
                                                        </td>
                                                        <td class="text-right  border-bottom">
                                                            <span class="font-weight-bolder text-md">
                                                                <?= rupiah_positif($jumlahAb); ?>
                                                            </span>
                                                        </td>
                                                        <td class="text-right"></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center"></td>
                                                        <td class="text-center"></td>
                                                        <td colspan="2">
                                                            <span class="font-weight-normal text-md pl-5">
                                                                Rincian :
                                                            </span>
                                                        </td>
                                                        <td class="text-right">
                                                            <span class="font-weight-bolder">
                                                            </span>
                                                        </td>
                                                        <td class="text-right"></td>
                                                    </tr>
                                                    <?php
                                                    $akun6Ab = $this->Laporan_model->calkAkun6AbInstitusi($idCatatanAb);
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
                                                                <td class="text-center"></td>
                                                                <td class="text-center"></td>
                                                                <td colspan="2">
                                                                    <span class="font-weight-normal text-md pl-5">
                                                                        - <?= $dataAkun6Ab['level6']; ?>
                                                                    </span>
                                                                </td>
                                                                <td class="text-right">
                                                                    <span class="font-weight-normal">
                                                                        <?= rupiah_positif($jumlah); ?>
                                                                    </span>
                                                                </td>
                                                                <td class="text-right"></td>
                                                            </tr>
                                                    <?php
                                                        endforeach;
                                                    }
                                                    ?>
                                                    <tr>
                                                        <td class="text-center"></td>
                                                        <td class="text-center"></td>
                                                        <td colspan="2">
                                                            <span class="font-weight-normal text-md pl-5">
                                                                Sub Jumlah
                                                            </span>
                                                        </td>
                                                        <td class="text-right border-top border-bottom">
                                                            <span class="font-weight-normal">
                                                                <?= rupiah_positif($total6Ab); ?>
                                                            </span>
                                                        </td>
                                                        <td class="text-right"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="row my-1"></div>
                                                        </td>
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
                                                    if ($akun1 == "300") {
                                                        $jumlahPd = $kreditPd - $debetPd;
                                                        // $jumlahPd = $debet - $kredit;
                                                    } elseif ($akun1 == "400") {
                                                        $jumlahPd = $kreditPd - $debetPd;
                                                    } elseif ($akun1 == "600") {
                                                        $jumlahPd = $kreditPd - $debetPd;
                                                    } else {
                                                        $jumlahPd = $debetPd - $kreditPd;
                                                    }
                                                    $totalPd = $totalPd + $jumlahPd;

                                            ?>
                                                    <tr>
                                                        <td class="text-center"></td>
                                                        <td class="text-left" width="4%">
                                                            <span class="font-weight-bolder text-md">
                                                                <?= $idCatatanPd ?>
                                                            </span>
                                                        </td>
                                                        <td colspan="2">
                                                            <span class="font-weight-bolder text-md">
                                                                <?= $dataCalkPd['level3']; ?>
                                                            </span>
                                                        </td>
                                                        <td class="text-right  border-bottom">
                                                            <span class="font-weight-bolder text-md">
                                                                <?= rupiah_positif($jumlahPd); ?>
                                                            </span>
                                                        </td>
                                                        <td class="text-right"></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center"></td>
                                                        <td class="text-center"></td>
                                                        <td colspan="2">
                                                            <span class="font-weight-normal text-md pl-5">
                                                                Rincian :
                                                            </span>
                                                        </td>
                                                        <td class="text-right">
                                                            <span class="font-weight-bolder">
                                                            </span>
                                                        </td>
                                                        <td class="text-right"></td>
                                                    </tr>
                                                    <?php
                                                    $akun6 = $this->Laporan_model->calkAkun6Institusi($idCatatanPd);
                                                    $debet6 = 0;
                                                    $kredit6 = 0;
                                                    $jumlah6 = 0;
                                                    $total6Pd = 0;
                                                    if ($akun6) {
                                                        foreach ($akun6 as $dataAkun6) :
                                                            $posisi6 = $dataAkun6['posisi'];
                                                            $debet6 = $dataAkun6['debet'];
                                                            $kredit6 = $dataAkun6['kredit'];
                                                            if ($posisi6 == "D") {
                                                                $jumlah6 = $debet6 - $kredit6;
                                                            } else {
                                                                $jumlah6 = $kredit6 - $debet6;
                                                            }
                                                            $total6Pd = $total6Pd + $jumlah6;
                                                    ?>
                                                            <tr>
                                                                <td class="text-center"></td>
                                                                <td class="text-center"></td>
                                                                <td colspan="2">
                                                                    <span class="font-weight-normal text-md pl-5">
                                                                        - <?= $dataAkun6['level6']; ?>
                                                                    </span>
                                                                </td>
                                                                <td class="text-right">
                                                                    <span class="font-weight-normal">
                                                                        <?= rupiah_positif($jumlah6); ?>
                                                                    </span>
                                                                </td>
                                                                <td class="text-right"></td>
                                                            </tr>

                                                    <?php
                                                        endforeach;
                                                    }
                                                    ?>
                                                    <tr>
                                                        <td class="text-center"></td>
                                                        <td class="text-center"></td>
                                                        <td colspan="2">
                                                            <span class="font-weight-normal text-md pl-5">
                                                                Sub Jumlah
                                                            </span>
                                                        </td>
                                                        <td class="text-right border-top border-bottom">
                                                            <span class="font-weight-normal">
                                                                <?= rupiah_positif($total6Pd); ?>
                                                            </span>
                                                        </td>
                                                        <td class="text-right"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="row my-1"></div>
                                                        </td>
                                                    </tr>
                                            <?php
                                                endforeach;
                                            }
                                            ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-sm-1"></div> -->
                    </div>
                <?php } ?>
                <div class="row visible">
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