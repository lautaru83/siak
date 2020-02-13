<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-gradient-light">
                <div>
                    <h4 class="card-title">
                        Laporan Konsolidasi
                    </h4>
                </div>
                <div class="float-right">
                </div>
            </div>
            <div class="card-body bg-gradient-light">
                <div class="row bg-gradient-light">
                    <div style="height: 25px;">
                    </div>
                </div>
                <?php
                //var_dump($calk);
                ?>
                <?php
                if ($calk) {
                ?>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <span class="text-uppercase font-weight-bolder"><?php if ($institusi) {
                                                                                echo $institusi['keterangan'];
                                                                            } ?></span>
                        </div>
                        <div class="col-md-12 text-center">
                            <span class="font-weight-normal">CATATAN ATAS LAPORAN KEUANGAN KONSOLIDASI</span>
                        </div>
                    </div>
                    <table id="tabel3" class="table table-sm table-borderless table-hover">
                        <thead>
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-center" colspan="4">
                                    Untuk Tahun Yang Berakhir <?= format_indo($this->session->userdata('buku_akhir')); ?><br>
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
                                <td class="text-center" colspan="2"></td>
                                <td width="15%" class="text-center font-weight-normal">
                                    <!-- <span class="font-weight-normal my-auto">Catatan</span>
                                    <div class="border-top my-1"></div> -->
                                </td>
                                <td width="15%" class="text-center">
                                    <span class="font-weight-normal my-auto"><?= format_indo($tanggal); ?><div class="border-top my-1"></div>
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
                                    } elseif ($akun1 == "300") {
                                        $jumlah = $kredit - $debet;
                                    } elseif ($akun1 == "400") {
                                        $jumlah = $kredit - $debet;
                                    } elseif ($akun1 == "500") {
                                        $jumlah = $debet - $kredit;
                                    } elseif ($akun1 == "600") {
                                        $jumlah = $kredit - $debet;
                                    } else {
                                        $jumlah = $debet - $kredit;
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
                                            <span class="font-weight-normal text-md pl-3">
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
                                    $akun4 = $this->Laporan_model->calkAkun4Konsolidasi($idCatatan);
                                    if ($akun4) {
                                        $debet4 = 0;
                                        $kredit4 = 0;
                                        $jumlah4 = 0;
                                        $total4 = 0;
                                        foreach ($akun4 as $dataAkun4) :
                                            $idAkun4 = $dataAkun4['a4level_id'];
                                            $posisi4 = $dataAkun4['posisi'];
                                            $debet4 = $dataAkun4['debet'];
                                            $kredit4 = $dataAkun4['kredit'];
                                            if ($posisi4 == "D") {
                                                $jumlah4 = $debet4 - $kredit4;
                                            } else {
                                                $jumlah4 = $kredit4 - $debet4;
                                            }
                                            $total4 = $total4 + $jumlah4;
                                    ?>
                                            <tr>
                                                <td class="text-center"></td>
                                                <td class="text-center"></td>
                                                <td colspan="2">
                                                    <span class="font-weight-normal text-md pl-3">
                                                        - <?= $dataAkun4['level4']; ?>
                                                    </span>
                                                </td>
                                                <td class="text-right">
                                                    <span class="font-weight-normal">
                                                        <?php //rupiah_positif($jumlah4); 
                                                        ?>
                                                    </span>
                                                </td>
                                                <td class="text-right"></td>
                                            </tr>
                                            <?php
                                            $akun5 = $this->Laporan_model->calkAkun5Konsolidasi($idAkun4);
                                            if ($akun5) {
                                                $debet5 = 0;
                                                $kredit5 = 0;
                                                $jumlah5 = 0;
                                                $total5 = 0;
                                                foreach ($akun5 as $dataAkun5) :
                                                    //$idAkun4 = $dataAkun4['a4level_id'];
                                                    $posisi5 = $dataAkun5['posisi'];
                                                    $debet5 = $dataAkun5['debet'];
                                                    $kredit5 = $dataAkun5['kredit'];
                                                    if ($posisi5 == "D") {
                                                        $jumlah5 = $debet5 - $kredit5;
                                                    } else {
                                                        $jumlah5 = $kredit5 - $debet5;
                                                    }
                                                    $total5 = $total5 + $jumlah5;

                                            ?>

                                                    <tr>
                                                        <td class="text-center"></td>
                                                        <td class="text-center"></td>
                                                        <td colspan="2">
                                                            <span class="font-weight-normal text-md pl-5">
                                                                - <?= $dataAkun5['level5'];
                                                                    ?>
                                                            </span>
                                                        </td>
                                                        <td class="text-right">
                                                            <span class="font-weight-normal">
                                                                <?= rupiah_positif($jumlah5); ?>
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
                                                        <?= rupiah_positif($total5); ?>
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
                                    <tr>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td colspan="2">
                                            <span class="font-weight-bolder text-md pl-3">
                                                Jumlah
                                            </span>
                                        </td>
                                        <td class="text-right border-top border-bottom">
                                            <span class="font-weight-bolder">
                                                <?= rupiah_positif($total4); ?>
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
                <?php } ?>
                <div class="row bg-gradient-light">
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