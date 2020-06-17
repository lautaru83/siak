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
        <?= $this->session->flashdata('message'); ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col col-lg-12">
                    <div class="card">
                        <div class="card-header bg-gradient-light">
                            <div>
                                <h4 class="card-title">
                                    <a class="text-reset" id="kas-masuk">Tahun Pembukuan <?php //$pembukuan_id 
                                                                                            ?></a>
                                </h4>
                            </div>

                            <!-- <div class="float-right">
                                            <h4 class="card-title" disabled="disabled">
                                                <a href="" class="text-reset" id="btn-selesai-opmtransaksi" data-id="" data-total="" data-notran="">
                                                    Selesai<i class="far fa-check-square" style="color: teal"></i>
                                                </a>
                                            </h4>
                                        </div> -->

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <?php
                            //var_dump($periodeakademik);
                            // $tglab = tanggal_indo($awalbuku);
                            //echo $periodeakad_id;
                            // $jarak  = date_diff(strtotime($awalbuku), strtotime($awalanggaran));
                            // $tgl1 = date_create($awalbuku);
                            // $tgl2 = date_create($awalanggaran);
                            // $diff = date_diff($tgl2, $tgl1);
                            // echo $diff->format("%R%a days");
                            ?>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="font-weight-normal">Periode Akuntansi</label>
                                        <!-- <div class=""> -->
                                        <input type="hidden" id="idbuku" name="idbuku">
                                        <select id="pa_pembukuan_id" name="pa_pembukuan_id" class="form-control" tabindex="4">
                                            <?php
                                            if ($tahunbuku)
                                                foreach ($tahunbuku as $dataTahunbuku) :
                                                    $idBuku = $dataTahunbuku['id'];
                                            ?>
                                                <option value="<?= $idBuku; ?>" <?php cek_combo($idBuku, $pembukuan_id); ?>><?= $dataTahunbuku['keterangan']; ?></option>
                                            <?php
                                                endforeach;
                                            ?>
                                        </select>
                                        <span id="buku_error" class="text-danger"></span>
                                        <!-- </div> -->
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="font-weight-normal">Awal Pembukuan</label>
                                        <div class="">
                                            <input type="text" name="awalbuku" class="form-control" id="awalbuku" value="<?= tanggal_indo($awalbuku); ?>" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="font-weight-normal">Akhir Pembukuan</label>
                                        <div class="">
                                            <input type="text" name="akhirbuku" class="form-control" id="akhirbuku" value="<?= tanggal_indo($akhirbuku); ?>" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="font-weight-normal">Periode Anggaran</label>
                                        <!-- <div class=""> -->
                                        <select id="pa_anggaran_id" name="pa_anggaran_id" class="form-control" tabindex="4">
                                            <?php
                                            if ($tahunanggaran)
                                                foreach ($tahunanggaran as $dataTahunanggaran) :
                                                    $idAnggaran = $dataTahunanggaran['id'];
                                            ?>
                                                <option value="<?= $idAnggaran; ?>" <?php cek_combo($idAnggaran, $anggaran_id); ?>><?= $dataTahunanggaran['keterangan']; ?></option>
                                            <?php
                                                endforeach;
                                            ?>
                                        </select>
                                        <span id="anggaran_error" class="text-danger"></span>
                                        <!-- </div> -->
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="font-weight-normal">Awal Anggaran</label>
                                        <div class="">
                                            <input type="text" name="awalanggaran" class="form-control" id="awalanggaran" value="<?= tanggal_indo($awalanggaran); ?>" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="font-weight-normal">Akhir Anggaran</label>
                                        <div class="">
                                            <input type="text" name="akhiranggaran" class="form-control" id="akhiranggaran" value="<?= tanggal_indo($akhiranggaran); ?>" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="font-weight-normal">Periode Akademik</label>
                                        <!-- <div class=""> -->
                                        <select id="pa_perak_id" name="pa_perak_id" class="form-control" tabindex="4">
                                            <?php
                                            if ($periodeakademik)
                                                foreach ($periodeakademik as $dataPeriodeakademik) :
                                                    $idPerak = $dataPeriodeakademik['id'];
                                            ?>
                                                <option value="<?= $idPerak; ?>" <?php cek_combo($idPerak, $perak_id); ?>><?= $dataPeriodeakademik['keterangan']; ?></option>
                                            <?php
                                                endforeach;
                                            ?>
                                        </select>
                                        <span id="akademik_error" class="text-danger"></span>
                                        <!-- </div> -->
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="font-weight-normal">Awal Semester</label>
                                        <div class="">
                                            <input type="hidden" id="idakademik" name="idakademik" value="<?= $akademik_id; ?>">
                                            <input type="text" name="awalsemester" class="form-control" id="awalsemester" value="<?= tanggal_indo($awalsemester); ?>" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="font-weight-normal">Akhir Semester</label>
                                        <div class="">
                                            <input type="text" name="akhirsemester" class="form-control" id="akhirsemester" value="<?= tanggal_indo($akhirsemester); ?>" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="row">-->
                        <!-- /row -->
                        <div class="row">
                            <div class="col-sm-12 mb-3">
                                <div class="d-flex justify-content-center">
                                    <button id="btn-simpan-pembukuanaktif" type="submit" class="btn btn-success"><i class="far fa-check-square"></i> Simpan</button>
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
<?php //$this->load->view('akademik/opm/modal');
?>
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper