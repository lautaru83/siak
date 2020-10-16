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
            <!-- row tabs -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-info card-tabs">
                        <div class="card-header p-0 pt-1">
                            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="custom-tabs-one-kelas-tab" data-toggle="pill" href="#custom-tabs-one-kelas" role="tab" aria-controls="custom-tabs-one-kelas" aria-selected="true">Rekap Kelas</a>
                                </li>
                                <!-- <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-one-periode-tab" data-toggle="pill" href="#custom-tabs-one-periode" role="tab" aria-controls="custom-tabs-one-periode" aria-selected="false">Periode</a>
                                </li> -->
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-one-mahasiswa-tab" data-toggle="pill" href="#custom-tabs-one-mahasiswa" role="tab" aria-controls="custom-tabs-one-mahasiswa" aria-selected="false">Mahasiswa</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-one-tabContent">
                                <div class="tab-pane fade show active" id="custom-tabs-one-kelas" role="tabpanel" aria-labelledby="custom-tabs-one-kelas-tab">
                                    <form method="POST" action="<?= base_url('/pembayaran') ?>">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <input type="hidden" id="jenislap" name="awalbuku" value="<?= $buku_awal; ?>">
                                                <input type="hidden" id="awalbuku" name="awalbuku" value="<?= $buku_awal; ?>">
                                                <input type="hidden" id="akhirbuku" name="akhirbuku" value="<?= $buku_akhir; ?>">
                                                <label class="font-weight-normal">Periode Akademik</label>
                                                <select id="akd_pembukuan_id" name="akd_pembukuan_id" class="form-control">
                                                    <option value="">- Pilih -</option>
                                                    <?php
                                                    foreach ($perak as $dataPerak) :
                                                        $idPeriode = $dataPerak['id'];
                                                        //$keterangan = $dataPerak['tahunanggaran'];
                                                    ?>
                                                        <option value="<?= $dataPerak['id']; ?>"><?= $idPeriode; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <?= form_error('akd_pembukuan_id', '<small class="text-danger pl-3">', '</small>'); ?>
                                                <span id="perak_error" class="text-danger"></span>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="font-weight-normal">Kelas Aktif</label>
                                                <select id="kelas_id" name="kelas_id" class="form-control">
                                                    <option value="">- Pilih -</option>
                                                </select>
                                                <span id="kelas_error" class="text-danger"></span>
                                                <?= form_error('kelas_id', '<small class="text-danger pl-3">', '</small>'); ?>
                                            </div>
                                            <div class="col-md-1">
                                                <label class="font-weight-normal">&nbsp;</label>

                                                <button type="submit" id="btn-tampil-pembayaran" data-id="<?= $institusi_id; ?>" data-tgl1="<?= $buku_awal; ?>" data-tgl2="<?= $buku_akhir; ?>" data-laporan="calk" class="btn btn-primary">Tampilkan</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- <div class="tab-pane fade" id="custom-tabs-one-periode" role="tabpanel" aria-labelledby="custom-tabs-one-periode-tab">
                                    
                                </div> -->
                                <div class="tab-pane fade" id="custom-tabs-one-mahasiswa" role="tabpanel" aria-labelledby="custom-tabs-one-mahasiswa-tab">
                                    form pencarian
                                </div>
                            </div>
                            <?php
                            //$this->load->view('akuntansi/laporan/pembayaran/datakelasunit');
                            ?>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>



            <!-- data laporanya -->
            <!-- /. row tabs -->
            <!-- <div id="data">
            </div> -->
            <?php if ($lapkelas) {
                if ($institusi_id == "01") {
                    $this->load->view('akuntansi/laporan/pembayaran/datakelasinstitusi');
                } else {
                    $this->load->view('akuntansi/laporan/pembayaran/datakelasunit');
                }
            } ?>
            <!-- <div class="row">
                    <div class="col-md-12">
                        <table id="tabelLapbayar" class="table table-sm table-bordered table-hover">
                            <div id="data">
                            </div>
                        </table>
                    </div>
                </div> -->

            <!-- end data laporanya-->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->