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
                                    <a class="text-reset" id="kas-masuk">Tahun Akademik <?= $pembukuan_id ?> </a>
                                </h4>
                            </div>
                            <div class="float-right">
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-1">
                                    <div class="form-group">
                                        <label class="font-weight-normal">Nim</label>
                                        <div class="">
                                            <input type="text" name="nim_opm" class="form-control" id="nim_opm" tabindex="1">
                                            <span id="nim_error" class="text-danger"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label class="font-weight-normal">Nama</label>
                                        <div class="">
                                            <input type="text" name="nama" class="form-control" id="nama" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="font-weight-normal">Kelas</label>
                                        <div class="">
                                            <input type="text" name="kelas" class="form-control" id="kelas" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label class="font-weight-normal">Piutang</label>
                                        <div class="">
                                            <input type="text" name="piutang" class="form-control" id="piutang" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label class="font-weight-normal">Saldo</label>
                                        <div class="">
                                            <input type="text" name="saldo" class="form-control" id="saldo" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /row -->
                            <div class="row">
                                <div class="col col-lg-12">
                                    <div class="card card-default card-tabs">
                                        <div class="card-header p-0 pt-1">
                                            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Reguler</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Dana Surplus</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">Piutang</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="custom-tabs-one-settings-tab" data-toggle="pill" href="#custom-tabs-one-settings" role="tab" aria-controls="custom-tabs-one-settings" aria-selected="false">Riwayat Pembayaran</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="card-body">
                                            <div class="tab-content" id="custom-tabs-one-tabContent">
                                                <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label class="font-weight-normal">Tanggal</label>
                                                                <div class="">
                                                                    <input type="text" name="rtanggal" id="rtanggal" class="form-control" autocomplete="off" tabindex="11">
                                                                    <span id="rtanggal_error" class="text-danger"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label class="font-weight-normal">No. Bukti</label>
                                                                <div class="">
                                                                    <input type="text" name="nobukti" class="form-control" id="nobukti">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label class="font-weight-normal">No. Referensi</label>
                                                                <div class="">
                                                                    <input type="text" name="noref" class="form-control" id="noref">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label class="font-weight-normal">No. Transaksi</label>
                                                                <div class="">
                                                                    <input type="text" name="notran" class="form-control" id="notran" disabled>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="float-left">
                                                                <h4 class="card-title">
                                                                    <a href="#" class="text-reset" id="btn-simpan-rbop" data-aksi="tambah" data-status="" tabindex="6"><i class="fas fa-save" style="color: teal"></i> Simpan Transaksi</a>
                                                                </h4>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="float-right">
                                                                <h4 class="card-title" disabled="disabled">
                                                                    <a href="" class="text-reset" id="btn-tambah-rincianrbop" data-status="" tabindex="7">Tambah Rincian <i class="fas fa-file-alt" style="color: teal"></i></a>
                                                                </h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <table id="tabel3" class="table table-bordered table-striped table-sm">
                                                                <thead>
                                                                    <tr>
                                                                        <td width="8%" class="text-center">No</td>
                                                                        <td class="text-center">Nama Kewajiban</td>
                                                                        <td class="text-center">Debet</td>
                                                                        <td class="text-center">Kredit</td>
                                                                        <td width="10%" class="text-center">Anggaran</td>
                                                                        <td width="10%" class="text-center" style="color: grey"><i class="fas fa-cog"></i></td>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    // $no = 1;
                                                                    // if ($angkatan) {
                                                                    //     foreach ($angkatan as $dataAngkatan) :
                                                                    //         $idAngkatan = $dataAngkatan['id'];
                                                                    ?>

                                                                    <tr>
                                                                        <td class="text-center">1</td>
                                                                        <td class="text-left">Nama Kewajiban</td>
                                                                        <td class="text-right">5000</td>
                                                                        <td class="text-right">5000</td>
                                                                        <td class="text-center">Ya</td>
                                                                        <td class="text-center">
                                                                            <a href="" class="btn-edit-rbop" data-id="" data-toggle="tooltip" data-placement="bottom" title="Edit"><i class="fas fa-edit" style="color: olive"></i></a> - <a href="" class="btn-hapus-rbop" data-id="" data-info="" data-toggle="tooltip" data-placement="bottom" title="Hapus"> <i class="far fa-trash-alt" style="color: maroon"></i></a>
                                                                        </td>

                                                                    </tr>
                                                                    <?php
                                                                    //$no++;
                                                                    //endforeach;
                                                                    //}
                                                                    ?>

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                                                    tab profile
                                                </div>
                                                <div class="tab-pane fade" id="custom-tabs-one-messages" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
                                                    tab messege
                                                </div>
                                                <div class="tab-pane fade" id="custom-tabs-one-settings" role="tabpanel" aria-labelledby="custom-tabs-one-settings-tab">
                                                    tab setting
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.card -->
                                    </div>
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
        </div>
        <!-- /.container-fluid -->
        <?php //$this->load->view('akuntansi/kasmasuk/modal');
        ?>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper