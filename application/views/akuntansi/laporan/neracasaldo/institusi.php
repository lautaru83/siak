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
                        <div class="col-md-12">
                            <table id="tabel3" class="table table-borderless table-sm">
                                <tr>
                                    <td width="10%">Pembukuan</td>
                                    <td width="3%">:</td>
                                    <td><?= $pembukuan_id; ?></td>
                                    <td width="10%">Tanggal</td>
                                    <td width="3%">:</td>
                                    <td width="13%" class="text-right"><?= format_indo($akhir_periode); ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table id="tabel3" class="table table-bordered table-striped table-hover table-sm">
                                <thead>
                                    <tr>
                                        <td width="5%" class="text-center">No</td>
                                        <td colspan="2" class="text-center">Kode Perkiraan</td>
                                        <td width="15%" class="text-center">Saldo Debet (Rp)</td>
                                        <td width="15%" class="text-center">Saldo Kredit (Rp)</td>
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