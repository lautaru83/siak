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
            <div class="row d-print-none">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-gradient-light">
                            <div>
                                <h4 class="card-title">
                                    Tahun Anggaran <?= $this->session->userdata('tahun_anggaran'); ?>
                                </h4>
                            </div>
                            <div class="float-right invisible">
                                <h4 class="card-title" disabled="disabled">
                                    <a href="" class="text-reset" id="link-cetak-realisasi">Cetak <i class="fas fa-print" style="color: teal"></i></a>
                                </h4>
                            </div>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <!--------------- isi content ---------------------------- -->
                            <form>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label class="font-weight-normal">Pembukuan</label>
                                        <select id="rab_pembukuan_id" name="rab_pembukuan_id" class="form-control">
                                            <?php
                                            foreach ($tahunanggaran as $dataTahunanggaran) :
                                                $idBuku = $dataTahunanggaran['id'];
                                                $keterangan = $dataTahunanggaran['tahunanggaran'];
                                            ?>
                                                <option value="<?= $dataTahunanggaran['id']; ?>" <?php cek_combo($tahunanggaran_id, $idBuku); ?>><?= $keterangan; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="font-weight-normal">Akhir Periode </label>
                                        <input type="text" name="akhir_periode" id="akhir_periode" class="form-control" autocomplete="off">
                                    </div>
                                    <div class="col-md-2 mt-auto">
                                        <input type="hidden" id="awalbuku" name="awalbuku" value="<?= $buku_awal; ?>">
                                        <input type="hidden" id="akhirbuku" name="akhirbuku" value="<?= $buku_akhir; ?>">
                                        <button type="submit" id="btn-tampil-realisasi" data-id="<?= $institusi_id; ?>" data-tgl1="<?= $buku_awal; ?>" data-tgl2="<?= $buku_akhir; ?>" data-laporan="calk" class="btn btn-primary">Tampilkan</button>
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