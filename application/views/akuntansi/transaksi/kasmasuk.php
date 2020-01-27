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
                                    <a class="text-reset" id="kas-masuk">Form Transaksi <?php //$this->session->userdata('anggaran_akhir'); 
                                                                                        ?></a>
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
                                            <input type="text" name="tanggal_transaksi" id="tanggal_transaksi" class="form-control" id="notran" autocomplete="off" tabindex="1">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label class="font-weight-normal">No. Bukti</label>
                                        <div class="">
                                            <input type="text" name="nobukti" class="form-control" id="nobukti" tabindex="2">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label class="font-weight-normal">No. Transaksi</label>
                                        <div class="">
                                            <input type="text" name="notran" class="form-control" id="notran" value="<?= notransaksi(); ?>" autocomplete="off" disabled="disabled">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label class="font-weight-normal">Th. Pembukuan</label>
                                        <div class="">
                                            <input type="text" name="tahun_pembukuan_id" class="form-control" id="tahun_pembukuan_id" value="<?= $pembukuan_id; ?>" disabled="disabled">
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-sm-9">
                                    <div class="form-group">
                                        <label class="font-weight-normal">Uraian</label>
                                        <div class="">
                                            <input type="text" name="notran" class="form-control" id="notran" autocomplete="off" tabindex="3">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label class="font-weight-normal">Unit Usaha</label>
                                        <div class="">
                                            <select id="unit_id" name="unit_id" class="form-control" tabindex="4">
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
                                <!-- tombol -->
                                <!-- <div class="col-sm-3">
                                    <div class="form-group">
                                        <label class="font-weight-normal"> </label>
                                        <div class="">
                                            <button id="btn-simpan-kasmasuk" type="submit" class="btn btn-success btn-sm"><i class="far fa-check-square"></i> Simpan</button>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <!-- <div class="modal-footer card-footer">
                            <div class="pull-right">
                                <button id="btn-simpan-kasmasuk" type="submit" class="btn btn-success btn-sm"><i class="far fa-check-square"></i> Simpan</button>
                            </div>
                        </div> -->
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
                                    <a href="#" class="text-reset" id="btn-tambah-rincian" data-aksi="tambah" tabindex="5"><i class="fas fa-file-alt" style="color: teal"></i> Tambah Rincian</a>
                                </h4>
                            </div>
                            <div class="float-right">
                                <h4 class="card-title" disabled="disabled">
                                    <a href="" class="text-reset" id="kas-masuk">Tambah Rincian <i class="fas fa-file-alt" style="color: teal"></i></a>
                                </h4>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
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