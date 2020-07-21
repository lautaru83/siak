<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-gradient-light">
                <div>
                    <h4 class="card-title">
                        Neraca Saldo
                    </h4>
                </div>
                <div class="float-right">

                </div>
            </div>
            <div class="card-body">
                <!-- <div class="row">
                    <div style="height: 25px;">
                    </div>
                </div> -->
                <?php
                //var_dump($neracasaldo);
                ?>
                <?php
                if ($laporan) {
                ?>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <span class="text-uppercase font-weight-bolder"><?php if ($institusi) {
                                                                                echo $institusi['keterangan'];
                                                                            } ?></span>
                        </div>
                        <div class="col-md-12 text-center">
                            <span class="font-weight-bolder">NERACA SALDO</span>
                        </div>
                        <table id="tabel3" class="table table-sm table-borderless table-hover">
                            <thead>
                                <tr>
                                    <td class="text-center"></td>
                                    <td class="text-center" colspan="4">
                                        Tanggal <?= format_indo($akhir_periode); ?><br>
                                        Untuk Tahun Yang Berakhir <?= format_indo($akhirbuku); ?><br>
                                        (Dinyatakan dalam Rupiah, kecuali dinyatakan lain)
                                    </td>
                                    <td class="text-center"></td>
                                </tr>
                            </thead>
                            <!-- <tbody>
                                <tr>
                                    <td class="text-center border-bottom" colspan="6"></td>
                                </tr>
                            </tbody> -->
                        </table>
                    </div>
                    <div class="row">
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table id="tabel3" class="table table-bordered table-striped table-hover table-sm">
                                <thead>
                                    <tr>
                                        <td width="5%" class="text-center">No</td>
                                        <td colspan="2" class="text-center">Kode Perkiraan</td>
                                        <td width="15%" class="text-center">Debet (Rp)</td>
                                        <td width="15%" class="text-center">Kredit (Rp)</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($neracasaldo) {
                                        $no = 1;
                                        $saldodebet = 0.00;
                                        $saldokredit = 0.00;
                                        foreach ($neracasaldo as $dataNeracasaldo) :
                                            $posisi = $dataNeracasaldo['posisi'];
                                            $debet = $dataNeracasaldo['debet'];
                                            $kredit = $dataNeracasaldo['kredit'];
                                            if ($posisi == "D") {
                                                $saldodebet = $debet - $kredit;
                                                $saldokredit = 0;
                                            } else {
                                                $saldodebet = 0;
                                                $saldokredit = $kredit - $debet;
                                            }
                                    ?>
                                            <tr class="font-weight-normal">
                                                <td width="5%" class="text-center"><?= $no; ?></td>
                                                <td width="10%" class="text-center"><?= $dataNeracasaldo['id']; ?></td>
                                                <td><?= $dataNeracasaldo['level6']; ?></td>
                                                <td class="text-right">
                                                    <?php rupiah_positif($saldodebet); ?>
                                                </td>
                                                <td class="text-right">
                                                    <?php rupiah_positif($saldokredit); ?>
                                                </td>
                                            </tr>
                                        <?php
                                            $no++;
                                        endforeach;
                                    } else {
                                        ?>
                                        <tr class="font-weight-normal">
                                            <td class="text-center" colspan="5">Data tidak ditemukan</td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php } ?>
                <div class="row invisible">
                    <div class="col-sm-12 text-center">
                        <form method="POST" action="<?= base_url('akuntansi/neracasaldo/cetakdata'); ?>" target="_blank">
                            <input type="hidden" id="bukuawal" name="bukuawal" value="<?= $awalbuku; ?>">
                            <input type="hidden" id="bukuakhir" name="bukuakhir" value="<?= $akhirbuku; ?>">
                            <input type="hidden" id="tgl1" name="tgl1" value="<?= $awalbuku; ?>">
                            <input type="hidden" id="tgl2" name="tgl2" value="<?= $akhir_periode; ?>">
                            <input type="hidden" id="pembukuan_id" name="pembukuan_id" value="<?= $pembukuan_id; ?>">
                            <button type="submit" id="btn-cetak-neracasaldo" class="btn btn-link">Tampilkan</button>
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