<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <!-- <div class="container-fluid"> -->
        <div class="row">
            <div class="col-sm-6">
                <h3 class="ml-3">Pengaturan <?= $kontensubmenu; ?></h3>
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
                <div class="col col-md-12">
                    <div class="card">
                        <div class="card-header bg-gradient-light">
                            <div>
                                <?php if ($tahunanggaran) {
                                    $th = $tahunanggaran['tahunanggaran'];
                                    $idTahun = $tahunanggaran['id'];
                                } else {
                                    $th = "";
                                    $idTahun = "";
                                } ?>
                                <h4 class="card-title">
                                    <a href="#" class="text-reset" id="btn-tambah-rapb" data-th="<?= $th; ?>" data-id="<?= $idTahun; ?>" data-aksi="tambah"><i class="fas fa-file-alt" style="color: teal"></i> Tambah data </a>
                                </h4>
                            </div>
                            <div class="float-right">
                                <h4 class="card-title" disabled="disabled">
                                    <a id="btn-tes-modal">
                                        Cetak <i class="fas fa-print" style="color: teal"></i>
                                    </a>
                                </h4>
                            </div>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" id="tabel-data">
                            <table class="table table-bordered table-hover table-sm">
                                <thead>
                                    <tr class="">
                                        <td class="text-center" style="color: grey" width="5%"><i class="fas fa-cog"></i></td>
                                        <td colspan="2">Kegiatan Anggaran</td>
                                        <td width="13%" class="text-center">Anggaran (Rp)</td>
                                        <td width="13%" class="text-center">Terealisasi (Rp)</td>
                                        <td width="8%" class="text-center">No.Ref</td>
                                        <td class="text-center" style="color: grey" width="10%"><i class="fas fa-cog"></i></td>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    if ($kelompok) {
                                        $no = 1;
                                        foreach ($kelompok as $dataKelompok) :
                                            $idKelompok = $dataKelompok['id'];
                                    ?>

                                            <tr class="bg-light">
                                                <td class="text-center" width="5%">
                                                    <?= txt_roman($no); ?>
                                                </td>
                                                <td colspan="6" class="text-uppercase font-weight-normal"><?= $dataKelompok['kelompok'] ?></td>

                                            </tr>
                                            <?php
                                            $nor = 1;
                                            $rencana = $this->Rapb_model->rapbdata_kelompok_id($idKelompok, $idTahun);
                                            if ($rencana) {
                                                foreach ($rencana as $dataRencana) :
                                                    $idRencana = $dataRencana['id'];
                                                    $idAnggaran = $dataRencana['anggaran_id'];
                                            ?>
                                                    <tr>
                                                        <td></td>
                                                        <td width="5%" class="text-center"><?= $nor; ?></td>
                                                        <td><?= $dataRencana['rencana']; ?></td>
                                                        <td class="text-right"><?= rupiah($dataRencana['resaldo']); ?></td>
                                                        <td class="text-right"><?= rupiah($dataRencana['terealisasi']); ?></td>
                                                        <td class="text-center"><?= $dataRencana['noref']; ?></td>
                                                        <td class="text-center">
                                                            <a href="" class="btn-edit-rapb" data-id="<?= $idRencana; ?>" data-idanggaran="<?= $idAnggaran; ?>" data-idkel="<?= $dataRencana['kelompok_id']; ?>" data-toggle="tooltip" data-placement="bottom" title="Edit"><i class="fas fa-edit" style="color: olive"></i></a> - <a href="" class="btn-hapus-rapb" data-id="<?= $idRencana; ?>" data-info="<?= $dataRencana['rencana']; ?>" data-toggle="tooltip" data-placement="bottom" title="Hapus"> <i class="far fa-trash-alt" style="color: maroon"></i></a>
                                                        </td>
                                                    </tr>

                                    <?php
                                                    $nor++;
                                                endforeach;
                                            }
                                            $no++;
                                        endforeach;
                                    }
                                    ?>

                                </tbody>
                            </table>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
        <?php
        $this->load->view('akuntansi/rapb/modal');
        // $this->load->view('akuntansi/rapb/modal2');
        ?>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->