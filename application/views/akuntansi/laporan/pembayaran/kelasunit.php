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
                                    <?php
                                    $this->load->view('akuntansi/laporan/pembayaran/datakelasunit');
                                    ?>
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