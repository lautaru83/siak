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
                                <?php
                                if ($totaltransaksi) {
                                    $totaldebet = $totaltransaksi['debet'];
                                    $totalkredit = $totaltransaksi['kredit'];
                                    if ($totaldebet == $totalkredit) {
                                ?>
                                        <h4 class="card-title" disabled="disabled">
                                            <a href="" class="text-reset" id="btn-selesai-transaksi" data-id="<?= $tran_id; ?>" data-status="<?= $status; ?>" tabindex="9">Selesai <i class="far fa-check-square" style="color: teal"></i></a>
                                        </h4>
                                <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label class="font-weight-normal">Tanggal</label>
                                        <div class="">
                                            <input type="hidden" id="jurnal" name="jurnal" value="<?= $jurnal; ?>">
                                            <input type="hidden" id="status" name="status" value="<?= $status; ?>">
                                            <input type="hidden" id="tran_id" name="tran_id" value="<?= $tran_id; ?>">
                                            <input type="text" name="tanggal_transaksi" id="tanggal_transaksi" class="form-control" autocomplete="off" tabindex="1" value="<?= $tanggal_transaksi; ?>">
                                            <span id="tanggal_error" class="text-danger"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label class="font-weight-normal">No. Bukti</label>
                                        <div class="">
                                            <input type="text" name="nobukti" class="form-control" id="nobukti" tabindex="2" value="<?= $nobukti; ?>">
                                            <span id="nobukti_error" class="text-danger"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label class="font-weight-normal">No. Transaksi</label>
                                        <div class="">
                                            <input type="text" name="notran" class="form-control" id="notran" value="<?= $notran; ?>" disabled="disabled">
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
                                            <input type="text" name="keterangan" class="form-control" id="keterangan" value="<?= $keterangan; ?>" tabindex="3">
                                            <span id="keterangan_error" class="text-danger"></span>
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
                                            <span id="unit_error" class="text-danger"></span>
                                        </div>
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
            <div class="row">
                <div class="col col-lg-12">
                    <div class="card">
                        <div class="card-header bg-gradient-light">
                            <div>
                                <h4 class="card-title">
                                    <a href="#" class="text-reset" id="btn-simpan-transaksi" data-aksi="tambah" tabindex="5"><i class="fas fa-save" style="color: teal"></i> Simpan Transaksi</a>
                                </h4>
                            </div>

                            <div class="float-right">
                                <h4 class="card-title" disabled="disabled">
                                    <a href="" class="text-reset" id="btn-tambah-rincian" data-status="<?= $status; ?>" tabindex="6">Tambah Rincian <i class="fas fa-file-alt" style="color: teal"></i></a>
                                </h4>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <td width="5%" class="text-center">No</td>
                                        <td class="text-center">Kode Perkiraan</td>
                                        <td class="text-center" width="15%">Debet (Rp.)</td>
                                        <td class="text-center" width="15%">Kredit (Rp.)</td>
                                        <td class="text-center" style="color: grey" width="10%"><i class="fas fa-cog"></i></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $jumlahDebet = 0;
                                    $jumlahKredit = 0;
                                    if ($detail) {
                                        foreach ($detail as $dataDetail) :
                                            $idDetail = $dataDetail['id'];
                                            $posisi = $dataDetail['posisi'];
                                            $jumlahDebet = $jumlahDebet + $dataDetail['debet'];
                                            $jumlahKredit = $jumlahKredit + $dataDetail['kredit'];
                                    ?>
                                            <tr>
                                                <td class="text-center"><?= $no; ?></td>
                                                <td <?php padding_akun($posisi); ?>><?= $dataDetail['a6level_id']; ?> - <?= $dataDetail['level6']; ?></td>
                                                <td class="text-right"><?= rupiah($dataDetail['debet']); ?></td>
                                                <td class="text-right"><?= rupiah($dataDetail['kredit']); ?></td>
                                                <td class="text-center">
                                                    <a href="" class="btn-edit-detailtransaksi" data-id="<?= $idDetail; ?>" data-toggle="tooltip" data-placement="bottom" title="Edit"><i class="fas fa-edit" style="color: olive"></i></a> - <a href="" class="btn-hapus-detailtransaksi" data-id="<?= $idDetail; ?>" data-info="<?= $dataDetail['level6']; ?>" data-toggle="tooltip" data-placement="bottom" title="Hapus"> <i class="far fa-trash-alt" style="color: maroon"></i></a>
                                                </td>
                                            </tr>

                                        <?php
                                            $no++;
                                        //$jumlahDebet++;
                                        endforeach;
                                        ?>
                                        <tr>
                                            <td colspan="2" class="font-weight-normal">Total Transaksi</td>
                                            <td class="text-right font-weight-bolder"><span id="jmldebet" data-jmldebet="<?= $jumlahDebet; ?>"><?= rupiah($jumlahDebet); ?></span></td>
                                            <td class="text-right font-weight-bolder"><span id="jmldebet" data-jmldebet="<?= $jumlahDebet; ?>"><?= rupiah($jumlahKredit); ?></span></td>
                                            <td class="text-center" style="color: grey"><i class="fas fa-cog"></i></td>
                                        </tr>
                                    <?php } else { ?>
                                        <tr>
                                            <td colspan="6" class="text-center">Data Tidak Ditemukan</td>
                                        </tr>

                                    <?php
                                    }
                                    ?>
                                </tbody>
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
        <?php $this->load->view('akuntansi/kasmasuk/modal');
        ?>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->