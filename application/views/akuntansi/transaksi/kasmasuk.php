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
            <?php //$this->session->flashdata('message'); 
            ?>
            <div class="row">
                <div class="col col-lg-12">
                    <div class="card">
                        <div class="card-header bg-gradient-light">
                            <div>
                                <h4 class="card-title">
                                    <a class="text-reset" id="kas-masuk">Form Transaksi</a>
                                </h4>
                            </div>
                            <div class="float-right">
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label class="font-weight-normal">Tanggal</label>
                                        <div class="">
                                            <input type="text" name="tanggal_transaksi" id="tanggal_transaksi" class="form-control" id="notran" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label class="font-weight-normal">No. Bukti</label>
                                        <div class="">
                                            <input type="text" name="notran" class="form-control" id="notran" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label class="font-weight-normal">No. Transaksi</label>
                                        <div class="">
                                            <input type="text" name="notran" class="form-control" id="notran" autocomplete="off" disabled="disabled">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label class="font-weight-normal">Th. Pembukuan</label>
                                        <div class="">
                                            <input type="text" name="notran" class="form-control" id="notran" autocomplete="off" disabled="disabled">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-9">
                                    <div class="form-group">
                                        <label class="font-weight-normal">Uraian</label>
                                        <div class="">
                                            <input type="text" name="notran" class="form-control" id="notran" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label class="font-weight-normal">Unit Usaha</label>
                                        <div class="">
                                            <select id="unit_id" name="unit_id" class="form-control">
                                                <?php
                                                        if ($this->session->userdata['idInstitusi'] <> "01") {

                                                ?>
                                                    <option value="">- Pilih -</option>
                                                <?php
                                                        }
                                                        foreach ($unit as $dataUnit) :
                                                ?>
                                                    <option value="<?= $dataUnit['id']; ?>"><?= $dataUnit['unit']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <td width="5%">No</td>
                                                <td width="8%">Kode</td>
                                                <td width="47%">Nama Akun</td>
                                                <td width="15%">Debet</td>
                                                <td width="15%">Kredit</td>
                                                <td class="text-center" style="color: grey" width="10%"><i class="fas fa-cog"></i></td>
                                            </tr>
                                        </thead>
                                    </table>

                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card-->
                </div>
                <!-- /.col col-lg-12-->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col col-lg-12">
                    <div class="card">
                        <div class="card-header bg-gradient-light">
                            <div>
                                <h4 class="card-title">
                                    <a class="text-reset" id="kas-masuk">Riwayat Transaksi</a>
                                </h4>
                            </div>
                            <div class="float-right">
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <td width="5%">No</td>
                                        <td width="10%">Tanggal</td>
                                        <td width="10%">No.Bukti</td>
                                        <td width="50%">Uraian</td>
                                        <td width="15%">Nominal</td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <!-- /.col col-lg-12-->
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->
        <?php //$this->load->view('akuntansi/tahunbuku/modal');
        ?>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->