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
                                    Parameter Laporan
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
                            <form class="form-inline" method="POST" action="<?= base_url('akuntansi/jurnal/data'); ?>">

                                <div class="form-group my-2 mr-sm-3">
                                    <label class="font-weight-normal my-2 mr-3">Awal Periode :</label>
                                    <input type="text" name="awal_periode" id="awal_periode" class="form-control" autocomplete="off">
                                    <span id="awal_error" class="text-danger"></span>
                                </div>
                                <div class="form-group my-2 mr-sm-3">
                                    <label class="font-weight-normal my-2 mr-3">Akhir Periode :</label>
                                    <input type="text" name="akhir_periode" id="akhir_periode" class="form-control" autocomplete="off" value="">
                                    <span id="akhir_error" class="text-danger"></span>
                                </div>
                                <div class="form-group my-2 mr-sm-3">
                                    <select id="jurnal" name="jurnal" class="form-control" tabindex="4">
                                        <option value="">- Semua Jurnal -</option>
                                        <option value="KM">- Jurnal Kas Masuk -</option>
                                        <option value="KK">- Jurnal Kas Keluar -</option>
                                        <option value="BM">- Jurnal Bank Masuk -</option>
                                        <option value="BK">- Jurnal Bank Masuk -</option>
                                        <option value="NN">- Jurnal Non Kas -</option>
                                    </select>
                                    <span id="unit_error" class="text-danger"></span>
                                </div>

                                <button type="submit" class="btn btn-primary my-1">Tampilkan</button>
                            </form>
                            <!-- /.form inline -->

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