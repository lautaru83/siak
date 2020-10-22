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
            <div class="card-body" id="tabel-data">
                <?php
                //var_dump($rekap);
                ?>
                <div class="row">
                    <div class="col-md-12 mt-2 text-center">
                        <span class="text-uppercase font-weight-bolder"><?php if ($institusi) {
                                                                            echo $institusi['keterangan'];
                                                                        } ?></span>
                    </div>
                    <div class="col-md-12 text-md text-center">
                        <span class="font-weight-bolder">LAPORAN PEMBAYARAN MAHASISWA PER KELAS</span>
                    </div>
                    <div class="col-md-12 text-md text-center">
                        <span class="text-uppercase font-weight-normal"><?= $periode['keterangan']; ?></span>
                    </div>
                    <div class="col-md-12 text-md text-center">
                        <span class="font-weight-normal">( dinyatakan dalam ribuan )</span>
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
                        <!-- <div class="table-responsive text-nowrap"> -->
                        <table id="tabelLapbayar" class="table table-bordered table-sm text-nowrap">
                            <!-- <table class="tabel table-bordered table-striped"> -->
                            <thead>
                                <tr>
                                    <td class="text-center" width="5%">No</td>
                                    <td class="text-center" width="8%">Nim</td>
                                    <td class="text-center" width="30%">Nama</td>
                                    <td class="text-center" width="10%">SPP</td>
                                    <td class="text-center" width="10%">PER</td>
                                    <td class="text-center" width="10%">PRA</td>
                                    <td class="text-center" width="10%">MPP</td>
                                    <td class="text-center" width="10%">CAP</td>
                                    <td class="text-center" width="10%">LKK</td>
                                    <td class="text-center" width="10%">LBK</td>
                                    <td class="text-center" width="10%">PERP</td>
                                    <td class="text-center" width="10%">WIS</td>
                                    <td class="text-center" width="10%">Subtotal</td>
                                    <td class="text-center" width="10%">DPP</td>
                                    <td class="text-center" width="10%">INF</td>
                                    <td class="text-center" width="10%">Total</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $debet1 = 0.00;
                                $kredit1 = 0.00;
                                $jumlah1 = 0.00;
                                $debet2 = 0.00;
                                $kredit2 = 0.00;
                                $jumlah2 = 0.00;
                                $debet3 = 0.00;
                                $kredit3 = 0.00;
                                $jumlah3 = 0.00;
                                $debet4 = 0.00;
                                $kredit4 = 0.00;
                                $jumlah4 = 0.00;
                                $debet5 = 0.00;
                                $kredit5 = 0.00;
                                $jumlah5 = 0.00;
                                $debet6 = 0.00;
                                $kredit6 = 0.00;
                                $jumlah6 = 0.00;
                                $debet7 = 0.00;
                                $kredit7 = 0.00;
                                $jumlah7 = 0.00;
                                $debet8 = 0.00;
                                $kredit8 = 0.00;
                                $jumlah8 = 0.00;
                                $debet9 = 0.00;
                                $kredit9 = 0.00;
                                $jumlah9 = 0.00;
                                $debet10 = 0.00;
                                $kredit10 = 0.00;
                                $jumlah10 = 0.00;
                                $debet11 = 0.00;
                                $kredit11 = 0.00;
                                $jumlah11 = 0.00;
                                $subtotal = 0.00;
                                $total = 0.00;
                                $sumsubtotal = 0.00;
                                $sumtotal = 0.00;
                                $total1 = 0.00;
                                $total2 = 0.00;
                                $total3 = 0.00;
                                $total4 = 0.00;
                                $total5 = 0.00;
                                $total6 = 0.00;
                                $total7 = 0.00;
                                $total8 = 0.00;
                                $total9 = 0.00;
                                $total10 = 0.00;
                                $total11 = 0.00;
                                if ($rekap) {
                                    foreach ($rekap as $dataRekap) :
                                        $debet1 = $dataRekap['debetSPP'];
                                        $kredit1 = $dataRekap['kreditSPP'];
                                        $jumlah1 = $kredit1 - $debet1;
                                        $debet2 = $dataRekap['debetPER'];
                                        $kredit2 = $dataRekap['kreditPER'];
                                        $jumlah2 = $kredit2 - $debet2;
                                        $debet3 = $dataRekap['debetPRA'];
                                        $kredit3 = $dataRekap['kreditPRA'];
                                        $jumlah3 = $kredit3 - $debet3;
                                        $debet4 = $dataRekap['debetPKM'];
                                        $kredit4 = $dataRekap['kreditPKM'];
                                        $jumlah4 = $kredit4 - $debet4;
                                        $debet5 = $dataRekap['debetLBK'];
                                        $kredit5 = $dataRekap['kreditLBK'];
                                        $jumlah5 = $kredit5 - $debet5;
                                        $debet6 = $dataRekap['debetLAB'];
                                        $kredit6 = $dataRekap['kreditLAB'];
                                        $jumlah6 = $kredit6 - $debet6;
                                        $debet7 = $dataRekap['debetULB'];
                                        $kredit7 = $dataRekap['kreditULB'];
                                        $jumlah7 = $kredit7 - $debet7;
                                        $debet8 = $dataRekap['debetUAP'];
                                        $kredit8 = $dataRekap['kreditUAP'];
                                        $jumlah8 = $kredit8 - $debet8;
                                        $debet9 = $dataRekap['debetWIS'];
                                        $kredit9 = $dataRekap['kreditWIS'];
                                        $jumlah9 = $kredit9 - $debet9;
                                        $debet10 = $dataRekap['debetDPP'];
                                        $kredit10 = $dataRekap['kreditDPP'];
                                        $jumlah10 = $kredit10 - $debet10;
                                        $debet11 = $dataRekap['debetINF'];
                                        $kredit11 = $dataRekap['kreditINF'];
                                        $jumlah11 = $kredit11 - $debet11;
                                        $total1 = $total1 + $jumlah1;
                                        $total2 = $total2 + $jumlah2;
                                        $total3 = $total3 + $jumlah3;
                                        $total4 = $total4 + $jumlah4;
                                        $total5 = $total5 + $jumlah5;
                                        $total6 = $total6 + $jumlah6;
                                        $total7 = $total7 + $jumlah7;
                                        $total8 = $total8 + $jumlah8;
                                        $total9 = $total9 + $jumlah9;
                                        $total10 = $total10 + $jumlah10;
                                        $total11 = $total11 + $jumlah11;
                                        $subtotal = $jumlah1 + $jumlah2 + $jumlah3 + $jumlah4 + $jumlah5 + $jumlah6 + $jumlah7 + $jumlah8 + $jumlah9;
                                        $total = $subtotal + $jumlah10 + $jumlah11;
                                        $sumsubtotal = $sumsubtotal + $subtotal;
                                        $sumtotal = $sumtotal + $total;
                                ?>
                                        <tr>
                                            <td class="text-center"><?= $no++; ?></td>
                                            <td class="text-left"><?= $dataRekap['nim']; ?></td>
                                            <td class="text-left"><?= $dataRekap['nama']; ?></td>
                                            <td class="text-right"><?= ribuan_positif($jumlah1) ?></td>
                                            <td class="text-right"><?= ribuan_positif($jumlah2) ?></td>
                                            <td class="text-right"><?= ribuan_positif($jumlah3) ?></td>
                                            <td class="text-right"><?= ribuan_positif($jumlah4) ?></td>
                                            <td class="text-right"><?= ribuan_positif($jumlah5) ?></td>
                                            <td class="text-right"><?= ribuan_positif($jumlah6) ?></td>
                                            <td class="text-right"><?= ribuan_positif($jumlah7) ?></td>
                                            <td class="text-right"><?= ribuan_positif($jumlah8) ?></td>
                                            <td class="text-right"><?= ribuan_positif($jumlah9) ?></td>
                                            <td class="text-right"><?= ribuan_positif($subtotal) ?></td>
                                            <td class="text-right"><?= ribuan_positif($jumlah10) ?></td>
                                            <td class="text-right"><?= ribuan_positif($jumlah11) ?></td>
                                            <td class="text-right"><?= ribuan_positif($total) ?></td>
                                        </tr>

                                    <?php
                                        $no++;
                                    endforeach;
                                    ?>

                                <?php
                                } else { ?>
                                    <tr>
                                        <td class="text-center" colspan="16">Data tidak ditemukan...</td>
                                    </tr>
                                <?php } ?>
                                <tr>
                                    <td class="text-center"></td>
                                    <td class="text-left" colspan="2">Total</td>
                                    <td class="text-right"><?= ribuan_positif($total1) ?></td>
                                    <td class="text-right"><?= ribuan_positif($total2) ?></td>
                                    <td class="text-right"><?= ribuan_positif($total3) ?></td>
                                    <td class="text-right"><?= ribuan_positif($total4) ?></td>
                                    <td class="text-right"><?= ribuan_positif($total5) ?></td>
                                    <td class="text-right"><?= ribuan_positif($total6) ?></td>
                                    <td class="text-right"><?= ribuan_positif($total7) ?></td>
                                    <td class="text-right"><?= ribuan_positif($total8) ?></td>
                                    <td class="text-right"><?= ribuan_positif($total9) ?></td>
                                    <td class="text-right"><?= ribuan_positif($sumsubtotal) ?></td>
                                    <td class="text-right"><?= ribuan_positif($total10) ?></td>
                                    <td class="text-right"><?= ribuan_positif($total11) ?></td>
                                    <td class="text-right"><?= ribuan_positif($sumtotal) ?></td>
                                </tr>

                            </tbody>
                        </table>
                        <!-- </div> -->
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