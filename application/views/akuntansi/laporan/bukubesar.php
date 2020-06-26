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
                            <form>
                                <div class="row">
                                    <div class="col-md-1">
                                        <label class="font-weight-normal">Pembukuan</label>
                                        <select id="bb_pembukuan_id" name="bb_pembukuan_id" class="form-control">
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
                                        <span id="awal_error" class="text-danger"></span>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="font-weight-normal">Akhir Periode </label>
                                        <input type="text" name="akhir_periode" id="akhir_periode" class="form-control" autocomplete="off">
                                        <span id="akhir_error" class="text-danger"></span>
                                    </div>
                                    <div class="col-md-5">
                                        <label class="font-weight-normal">Kode Perkiraan </label>
                                        <select id="a6level_id" name="a6level_id" class="form-control" tabindex="4">
                                            <option value="">- PILIH -</option>
                                            <?php
                                            if ($akunbuku) {
                                                foreach ($akunbuku as $dataAkunbuku) :
                                            ?>
                                                    <option value="<?= $dataAkunbuku['id']; ?>"><?= $dataAkunbuku['id']; ?> - <?= $dataAkunbuku['level6']; ?></option>
                                            <?php
                                                endforeach;
                                            }
                                            ?>
                                        </select>
                                        <span id="akun_error" class="text-danger"></span>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="font-weight-normal">&nbsp;</label><br>
                                        <input type="hidden" id="awalbuku" name="awalbuku" value="<?= $awalbuku; ?>">
                                        <input type="hidden" id="akhirbuku" name="akhirbuku" value="<?= $akhirbuku; ?>">
                                        <button type="submit" id="btn-tampil-bukubesar" class="btn btn-primary">Tampilkan</button>
                                    </div>
                                </div>
                            </form>
                            <!--------------- isi content ---------------------------- -->
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col-md-12 -->
            </div>
            <!-- /.row -->
            <!-- data laporanya -->
            <div id="data">
            </div>
            <!-- end data laporanya-->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->