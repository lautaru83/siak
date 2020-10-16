<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-gradient-light d-print-none">
                <div>
                    <h4 class="card-title">
                        Data Pembayaran
                    </h4>
                </div>
                <div class="float-right">
                </div>
            </div>
            <div class="card-body">
                <?php
                if ($pembayaran) {
                    //var_dump($periode);

                ?>
                    <div class="row">
                        <!-- <div class="col-sm-1"></div> -->
                        <div class="col-sm-12">
                            <div class="mt-2 mx-3">
                                <div class="row">
                                    <div class="col-md-12 mt-2 text-center">
                                        <span class="text-uppercase font-weight-bolder"><?php if ($institusi) {
                                                                                            echo $institusi['keterangan'];
                                                                                        } ?></span>
                                    </div>
                                    <div class="col-md-12 text-md text-center">
                                        <span class="font-weight-bolder">LAPORAN PEMBAYARAN MAHASISWA PER KELAS UNIT</span>
                                    </div>
                                    <div class="col-md-12 text-md text-center">
                                        <span class="text-uppercase font-weight-normal"><?= $periode['keterangan']; ?></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <hr>
                                    </div>
                                </div>
                                <div class="row">
                                    <table id="tabel3" class="table table-sm table-borderless">
                                        <tr>
                                            <td class="text-left pl-3" width="8%">Kode</td>
                                            <td class="text-center" width="2%">:</td>
                                            <td class="text-left"><?= $detail['id']; ?></td>
                                            <td class="text-center"></td>
                                            <td class="text-center" width="17%"></td>
                                        </tr>
                                        <tr>
                                            <td class="text-left pl-3">Kelas</td>
                                            <td class="text-center">:</td>
                                            <td class="text-left"><?= $detail['keterangan']; ?></td>
                                            <td class="text-center"></td>
                                            <td class="text-center"></td>
                                        </tr>

                                        <!-- <tr>
                                                <td>
                                                    <div class="row my-1"></div>
                                                </td>
                                            </tr> -->

                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <table id="tabel3" class="table table-sm table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <td class="text-center" width="5%">No</td>
                                                    <td class="text-center" width="10%">Nim</td>
                                                    <td class="text-center">Nama</td>
                                                    <td class="text-center" width="15%">DPP</td>
                                                    <td class="text-center" width="15%">INF</td>
                                                    <td class="text-center" width="15%">Subtotal</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                $debetA = 0.00;
                                                $kreditA = 0.00;
                                                $debetB = 0.00;
                                                $kreditB = 0.00;
                                                $jumlahA = 0.00;
                                                $totalA = 0.00;
                                                $jumlahB = 0.00;
                                                $totalB = 0.00;
                                                $subtotal = 0.00;
                                                $total = 0.00;
                                                if ($rekap) {
                                                    foreach ($rekap as $dataRekap) :
                                                        $debetA = $dataRekap['debetDPP'];
                                                        $kreditA = $dataRekap['kreditDPP'];
                                                        $debetB = $dataRekap['debetINF'];
                                                        $kreditB = $dataRekap['kreditINF'];
                                                        $jumlahA = $kreditA - $debetA;
                                                        $jumlahB = $kreditB - $debetB;
                                                        $subtotal = $jumlahA + $jumlahB;
                                                        $totalA = $totalA + $jumlahA;
                                                        $totalB = $totalB + $jumlahB;
                                                ?>
                                                        <tr>
                                                            <td class="text-center"><?= $no; ?></td>
                                                            <td class="text-left"><?= $dataRekap['nim']; ?></td>
                                                            <td class="text-left"><?= $dataRekap['nama']; ?></td>
                                                            <td class="text-right"><?= rupiah_positif($jumlahA) ?></td>
                                                            <td class="text-right"><?= rupiah_positif($jumlahB) ?></td>
                                                            <td class="text-right"><?= rupiah_positif($subtotal) ?></td>
                                                        </tr>
                                                    <?php
                                                        $no++;
                                                    endforeach;
                                                } else {
                                                    ?>
                                                    <tr>
                                                        <td class="text-center" colspan="6">Data tidak ditemukan..</td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                                <tr>
                                                    <td class="text-center" width="5%"></td>
                                                    <td class="text-left" colspan="2">Total</td>
                                                    <td class="text-right" width="15%"><?= rupiah_positif($totalA); ?></td>
                                                    <td class="text-right" width="15%"><?= rupiah_positif($totalB); ?></td>
                                                    <td class="text-right" width="15%">
                                                        <?php
                                                        $total = $totalA + $totalB;
                                                        echo rupiah_positif($total);
                                                        ?>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-sm-1"></div> -->
                    </div>
                <?php } ?>
            </div>
            <!-- /.card-body -->

        </div>
        <!-- /.card -->
    </div>
    <!-- /.col-md-12 -->
</div>
<!-- /.row -->