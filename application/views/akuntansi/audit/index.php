<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <!-- <div class="container-fluid"> -->
        <div class="row">
            <div class="col-sm-6">
                <h3 class="ml-3"><?= $kontensubmenu; ?></h3>
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
                            <?php
                            //var_dump($pembukuan);
                            ?>
                            <!--------------- isi content ---------------------------- -->
                            <form method="POST" action="<?= base_url('akuntansi/audit/data'); ?>">
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
                                        <input type="text" name="akhir_periode" id="akhir_periode" class="form-control" autocomplete="off">
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

        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->