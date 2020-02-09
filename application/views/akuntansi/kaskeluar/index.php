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
                                    <a class="text-reset" id="kas-keluar">Tahun Pembukuan <?= $pembukuan_id ?></a>
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
                                            <a href="" class="text-reset" id="btn-selesai-kaskeluar" data-id="<?= $tran_id; ?>" data-total="<?= rupiah($totaldebet); ?>" data-status="<?= $status; ?>" tabindex="9">Selesai <i class="far fa-check-square" style="color: teal"></i></a>
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
                                            <input type="hidden" id="tahun_pembukuan_id" name="tahun_pembukuan_id" value="<?= $pembukuan_id; ?>">
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
                                        <label class="font-weight-normal">No. Referensi</label>
                                        <div class="">
                                            <input type="text" name="noref" class="form-control" id="noref" value="<?= $noref; ?>" tabindex="3">
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
                            </div>
                            <div class="row">
                                <div class="col-sm-9">
                                    <div class="form-group">
                                        <label class="font-weight-normal">Uraian</label>
                                        <div class="">
                                            <input type="text" name="keterangan" class="form-control" id="keterangan" autocomplete="off" value="<?= $keterangan; ?>" tabindex="4">
                                            <span id="keterangan_error" class="text-danger"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label class="font-weight-normal">Unit Usaha</label>
                                        <div class="">
                                            <select id="unit_id" name="unit_id" class="form-control" tabindex="5">
                                                <?php
                                                if ($this->session->userdata['idInstitusi'] <> "01") {

                                                ?>
                                                    <option value="">- Pilih -</option>
                                                <?php
                                                }
                                                foreach ($unit as $dataUnit) :
                                                    $idunit = $dataUnit['id'];
                                                ?>
                                                    <option value="<?= $dataUnit['id']; ?>" <?php cek_combo($unit_id, $idunit); ?>><?= $dataUnit['unit']; ?></option>
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
                                    <a href="#" class="text-reset" id="btn-simpan-kaskeluar" data-aksi="tambah" data-status="<?= $status; ?>" tabindex="6"><i class="fas fa-save" style="color: teal"></i> Simpan Transaksi</a>
                                </h4>
                            </div>

                            <div class="float-right">
                                <h4 class="card-title" disabled="disabled">
                                    <a href="" class="text-reset" id="btn-tambah-rinciankaskeluar" data-status="<?= $status; ?>" tabindex="7">Tambah Rincian <i class="fas fa-file-alt" style="color: teal"></i></a>
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
                                                    <a href="" class="btn-edit-detailkaskeluar" data-id="<?= $idDetail; ?>" data-toggle="tooltip" data-placement="bottom" title="Edit"><i class="fas fa-edit" style="color: olive"></i></a> - <a href="" class="btn-hapus-detailkaskeluar" data-id="<?= $idDetail; ?>" data-info="<?= $dataDetail['level6']; ?>" data-toggle="tooltip" data-placement="bottom" title="Hapus"> <i class="far fa-trash-alt" style="color: maroon"></i></a>
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
            <div class="row">
                <div class="col col-lg-12">
                    <div class="card">
                        <div class="card-header bg-gradient-light">
                            <div>
                                <h4 class="card-title">
                                    Riwayat Transaksi
                                </h4>
                            </div>
                            <div class="float-right">
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <td width="5%" class="text-center">No</td>
                                        <td width="10%" class="text-center">Tanggal</td>
                                        <td width="10%" class="text-center">No. Bukti</td>
                                        <td class="text-center">Uraian</td>
                                        <td width="15%" class="text-center">Jumlah Transaksi (Rp.)</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $nor = 1;
                                    if ($riwayat) {
                                        foreach ($riwayat as $dataRiwayat) :
                                    ?>
                                            <tr>
                                                <td class="text-center"><?= $nor; ?></td>
                                                <td class="text-center"><?= tanggal_indo($dataRiwayat['tanggal_transaksi']); ?></td>
                                                <td><?= $dataRiwayat['nobukti']; ?></td>
                                                <td><?= $dataRiwayat['keterangan']; ?></td>
                                                <td width="15%" class="text-right"><?= rupiah($dataRiwayat['total_transaksi']); ?></td>
                                            </tr>
                                        <?php
                                            $nor++;
                                        endforeach;
                                    } else {
                                        ?>

                                        <tr>
                                            <td colspan="5" class="text-center">Data Tidak Ditemukan</td>
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
        <?php $this->load->view('akuntansi/kaskeluar/modal');
        ?>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->