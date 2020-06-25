<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <!-- <div class="container-fluid"> -->
        <div class="row">
            <div class="col-sm-6">
                <h3 class="ml-3">Laporan <?= $kontensubmenu; ?></h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right mr-4">
                    <li class="breadcrumb-item"><a><?= $kontenmenu; ?></a></li>
                    <li class="breadcrumb-item active"><?= $kontensubmenu; ?></li>
                </ol>
            </div>
        </div>
        <!-- </div> -->
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-gradient-light">
                            <div>
                                <h4 class="card-title">
                                    Tahun Pembukuan <?= $this->session->userdata('tahun_buku'); ?>
                                </h4>
                            </div>
                            <div class="float-right">
                                <!-- <h4 class="card-title" disabled="disabled">
                                    Cetak <i class="fas fa-print" style="color: teal"></i>
                                </h4> -->
                            </div>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <!--------------- isi content ---------------------------- -->
                            <form method="POST" action="<?= base_url('akuntansi/jurnal/data'); ?>">
                                <div class="row">
                                    <div class="col-md-2">
                                        <label class="font-weight-normal">Pembukuan</label>
                                        <select id="jt_pembukuan_id" name="jt_pembukuan_id" class="form-control">
                                            <?php
                                            foreach ($pembukuan as $dataPembukuan) :
                                                $idBuku = $dataPembukuan['id'];
                                            ?>
                                                <option value="<?= $dataPembukuan['id']; ?>" <?php cek_combo($pembukuan_id, $idBuku); ?>><?= $idBuku; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="font-weight-normal">Awal Periode </label>
                                        <input type="text" name="awal_periode" id="awal_periode" class="form-control" autocomplete="off" value="<?= $awal_periode; ?>">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="font-weight-normal">Akhir Periode </label>
                                        <input type="text" name="akhir_periode" id="akhir_periode" class="form-control" autocomplete="off" value="<?= $akhir_periode; ?>">
                                    </div>
                                    <div class="col-md-2">
                                        <!-- <div class="form-group"> -->
                                        <label class="font-weight-normal">Jurnal</label>
                                        <select id="jurnal" name="jurnal" class="form-control" tabindex="4">
                                            <option value="">- Semua -</option>
                                            <?php
                                            foreach ($cmbjurnal as $dataCmbjurnal) :
                                                $idJurnal = $dataCmbjurnal['id'];
                                            ?>
                                                <option value="<?= $dataCmbjurnal['id']; ?>" <?php cek_combo($jurnal_id, $idJurnal); ?>><?= $idJurnal; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <!-- </div> -->
                                    </div>
                                    <div class="col-md-2 mt-auto">
                                        <button type="submit" class="btn btn-primary">Tampilkan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col-md-12 -->
            </div>
            <!-- /.row -->
            <?php
            if ($jurnal) {
            ?>
                <!-- isi laporan -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header bg-gradient-light">
                                <div>
                                    <h4 class="card-title">
                                        Data Transaksi
                                    </h4>
                                </div>
                                <div class="float-right">
                                    <h4 class="card-title" disabled="disabled">
                                        Cetak <i class="fas fa-print" style="color: teal"></i>
                                    </h4>
                                </div>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table id="tabel3" class="table table-bordered table-hover table-sm">
                                            <thead>
                                                <tr>
                                                    <td width="5%" class="text-center">No</td>
                                                    <td width="9%" class="text-center">Tanggal</td>
                                                    <td width="9%" class="text-center">No.Bukti</td>
                                                    <td class="text-center">Uraian</td>
                                                    <td width="13%" class="text-center">Debet (Rp)</td>
                                                    <td width="13%" class="text-center">Kredit (Rp)</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                foreach ($jurnal as $dataJurnal) :
                                                    $id = $dataJurnal['id'];
                                                ?>
                                                    <tr class="font-weight-normal bg-light">
                                                        <td class="text-center"><?= $no; ?></td>
                                                        <td class="text-center"><?= tanggal_indo($dataJurnal['tanggal']); ?></td>
                                                        <td class="text-center"><?= $dataJurnal['nobukti']; ?></td>
                                                        <td colspan="3">
                                                            <?= $dataJurnal['keterangan']; ?>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    $detailjurnal = $this->Transaksi_model->detailtransaksi($id);
                                                    if ($detailjurnal) {
                                                        foreach ($detailjurnal as $dataDetailjurnal) :
                                                            $posisi = $dataDetailjurnal['posisi'];
                                                    ?>

                                                            <tr>
                                                                <td class="table-borderless"></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td>
                                                                    <div <?php padding_akun($posisi); ?>><?= $dataDetailjurnal['a6level_id']; ?>&nbsp;&nbsp;&nbsp;&nbsp;<?= $dataDetailjurnal['level6']; ?></div>
                                                                </td>
                                                                <td class="text-right">
                                                                    <?= rupiah($dataDetailjurnal['debet']); ?>
                                                                </td>
                                                                <td class="text-right">
                                                                    <?= rupiah($dataDetailjurnal['kredit']); ?>
                                                                </td>
                                                            </tr>
                                                    <?php
                                                        endforeach;
                                                    }
                                                    ?>


                                                <?php
                                                    $no++;
                                                endforeach;
                                                ?>
                                            </tbody>
                                        </table>



                                        <!--------------- isi content ---------------------------- -->
                                    </div>
                                    <!-- /.col-md-12 -->
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
                <!-- isi laporan -->
            <?php
            }
            ?>

        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->