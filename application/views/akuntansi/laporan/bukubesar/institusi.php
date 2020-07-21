<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-gradient-light">
                <div>
                    <h4 class="card-title">
                        Buku Besar
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
                //var_dump($bukubesar);
                ?>
                <?php
                if ($laporan) {
                ?>
                    <div class="row">
                        <div class="col-md-12">
                            <table id="tabel3" class="table table-borderless table-sm">
                                <?php

                                $akun = $this->Kodeperkiraan_model->ambil_akun6($a6level_id);
                                $id6 = $akun['id'];
                                if ($awalbuku == $tanggalawal) {
                                    $saldoawal = saldoawal($pembukuan_id, $a6level_id);
                                } else {
                                    $jumlah = -1;
                                    $format = "days";
                                    $awalperiode = manipulasiTanggal($tanggalawal, $jumlah, $format);
                                    $saldoawal = saldoawalberjalan($pembukuan_id, $a6level_id, $awalbuku, $awalperiode);
                                }
                                ?>
                                <tr>
                                    <td width="11%">Kode</td>
                                    <td width="3%">:</td>
                                    <td><?= $akun['id']; ?></td>
                                    <td width="10%">Awal Periode</td>
                                    <td width="3%">:</td>
                                    <td width="12%" class="text-right"><?= format_indo($awal_periode); ?></td>
                                </tr>
                                <tr>
                                    <td>Nama Akun</td>
                                    <td>:</td>
                                    <td><?= $akun['level6']; ?></td>
                                    <td>Akhir Periode</td>
                                    <td>:</td>
                                    <td class="text-right"><?= format_indo($akhir_periode); ?></td>
                                </tr>
                                <tr>
                                    <td>Saldo Awal</td>
                                    <td>:</td>
                                    <td>Rp. <?= rupiah_positif($saldoawal); ?></td>
                                    <td>Saldo Akhir</td>
                                    <td>:</td>
                                    <td class="text-right">Rp. <?= rupiah_positif(saldoakhir($pembukuan_id, $a6level_id, $awalbuku, $akhir_periode)); ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <?php
                        //var_dump($bukubesar);
                        ?>
                        <div class="col-md-12">
                            <table id="tabel3" class="table table-bordered table-hover table-sm">
                                <thead>
                                    <tr>
                                        <td width="5%" class="text-center">No</td>
                                        <td width="9%" class="text-center">Tanggal</td>
                                        <td width="9%" class="text-center">No.Bukti</td>
                                        <td class="text-center">Uraian</td>
                                        <td width="12%" class="text-center">Debet (Rp)</td>
                                        <td width="12%" class="text-center">Kredit (Rp)</td>
                                        <td width="12%" class="text-center">Saldo (Rp)</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $saldo = $saldoawal;
                                    $jmldebet = 0.00;
                                    $jmlkredit = 0.00;
                                    if ($bukubesar) {
                                        $no = 1;
                                        $debet = 0;
                                        $kredit = 0;
                                        foreach ($bukubesar as $dataBukubesar) :
                                            $id = $dataBukubesar['id'];
                                            $posisi = $dataBukubesar['posisi'];
                                            $debet = $dataBukubesar['debet'];
                                            $kredit = $dataBukubesar['kredit'];
                                            if ($posisi == "D") {
                                                $saldo = $saldo + $debet - $kredit;
                                            } else {
                                                $saldo = $saldo + $kredit - $debet;
                                            }
                                            $jmldebet = $jmldebet + $debet;
                                            $jmlkredit = $jmlkredit + $kredit;

                                    ?>
                                            <tr class="font-weight-normal">
                                                <td class="text-center"><?= $no; ?></td>
                                                <td class="text-center"><?= tanggal_indo($dataBukubesar['tanggal_transaksi']); ?></td>
                                                <td class="text-center"><?= $dataBukubesar['nobukti']; ?></td>
                                                <td>
                                                    <?= $dataBukubesar['keterangan']; ?>
                                                </td>
                                                <td class="text-right">
                                                    <?= rupiah_positif($dataBukubesar['debet']); ?>
                                                </td>
                                                <td class="text-right">
                                                    <?= rupiah_positif($dataBukubesar['kredit']); ?>
                                                </td>
                                                <td class="text-right">
                                                    <?= rupiah_positif($saldo); ?>
                                                </td>
                                            </tr>

                                        <?php
                                            $no++;
                                        endforeach;
                                    } else {
                                        ?>
                                        <tr class="text-center">
                                            <td colspan="7">Tidak ada data transaksi</td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                    <tr>
                                        <td></td>
                                        <td colspan="3">Total</td>
                                        <td class="text-right"><?= rupiah_positif($jmldebet); ?></td>
                                        <td class="text-right"><?= rupiah_positif($jmlkredit); ?></td>
                                        <td></td>
                                    </tr>
                                </tbody>

                            </table>
                        </div>
                    </div>
                    <!-- /.row -->
                <?php } ?>
                <div class="row invisible">
                    <div class="col-sm-12 text-center">
                        <form method="POST" action="<?= base_url('akuntansi/bukubesar/cetakdata'); ?>" target="_blank">
                            <input type="hidden" id="bukuawal" name="bukuawal" value="<?= $awalbuku; ?>">
                            <input type="hidden" id="tgl1" name="tgl1" value="<?= $awal_periode; ?>">
                            <input type="hidden" id="tgl2" name="tgl2" value="<?= $akhir_periode; ?>">
                            <input type="hidden" id="akun_id" name="akun_id" value="<?= $a6level_id; ?>">
                            <input type="hidden" id="pembukuan_id" name="pembukuan_id" value="<?= $pembukuan_id; ?>">
                            <button type="submit" id="btn-cetak-bukubesar" class="btn btn-link">Tampilkan</button>
                        </form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.card-body -->

        </div>
        <!-- /.card -->
    </div>
    <!-- /.col-md-12 -->
</div>
<!-- /.row -->