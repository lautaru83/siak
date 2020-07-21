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
            <?php //$this->session->flashdata('message'); 
            ?>
            <div class="row">
                <div class="col col-lg-12">
                    <div class="card">
                        <div class="card-header bg-gradient-light">
                            <div>
                                <h4 class="card-title">
                                    <a class="text-reset" id="kas-keluar">Tahun Pembukuan <?= $this->session->userdata('tahun_buku'); ?></a>
                                </h4>
                            </div>
                            <div class="float-right">
                                <h4 class="card-title" disabled="disabled">
                                    <a href="" class="text-reset" id="link-cetak-neracasaldo">Cetak <i class="fas fa-print" style="color: teal"></i></a>
                                </h4>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label class="font-weight-normal">Pembukuan</label>
                                        <select id="ns_pembukuan_id" name="ns_pembukuan_id" class="form-control">
                                            <?php
                                            foreach ($pembukuan as $dataPembukuan) :
                                                $idBuku = $dataPembukuan['id'];
                                            ?>
                                                <option value="<?= $dataPembukuan['id']; ?>" <?php cek_combo($pembukuan_id, $idBuku); ?>><?= $idBuku; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="font-weight-normal">Akhir Periode </label>
                                        <input type="text" name="akhir_periode" id="akhir_periode" class="form-control" autocomplete="off">
                                        <span id="akhir_error" class="text-danger"></span>
                                    </div>
                                    <!-- <button type="submit" id="btn_tampl_neracasaldo" class="btn btn-primary mb-2">Terapkan</button> -->
                                    <div class="col-md-2">
                                        <label class="font-weight-normal">&nbsp;</label><br>
                                        <input type="hidden" id="awalbuku" name="awalbuku" value="<?= $awalbuku; ?>">
                                        <input type="hidden" id="akhirbuku" name="akhirbuku" value="<?= $akhirbuku; ?>">
                                        <button type="submit" id="btn-tampil-neracasaldo" class="btn btn-primary">Tampilkan</button>
                                    </div>
                                </div>
                                <!-- /.row -->
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