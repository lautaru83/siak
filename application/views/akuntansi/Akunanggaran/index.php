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
            <div class="row">
                <div class="col col-md-12">
                    <div class="card">
                        <div class="card-header bg-gradient-light">
                            <div>
                                <!-- <h4 class="card-title">
                                    <a class="text-reset"><i class="far fa-list-alt" style="color: teal"></i> </a>
                                </h4> -->
                            </div>
                            <div class="float-right">
                                <h4 class="card-title" disabled="disabled">
                                    Cetak <i class="fas fa-print" style="color: teal"></i>
                                </h4>
                            </div>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" id="tabel-data">
                            <table class="table table-bordered table-hover table-sm">
                                <thead>
                                    <tr class="">
                                        <td class="text-center" style="color: grey" width="5%"><i class="fas fa-cog"></i></td>
                                        <td colspan="3">Kegiatan Anggaran</td>
                                        <td width="10%" class="text-center">Posisi</td>
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
                                                    <a href="" class="btn-tambah-anggaran" data-idkelompok="<?= $dataKelompok['id'] ?>" data-info="<?= $dataKelompok['kelompok'] ?>" data-toggle="tooltip" data-placement="bottom" title="Anggaran baru"><i class="fas fa-file-alt" style="color: teal"></i></a>
                                                </td>
                                                <td colspan="5"><?= $dataKelompok['kelompok'] ?></td>
                                            </tr>
                                            <?php
                                            $subakun = $this->Akunanggaran_model->subakun($idKelompok);
                                            if ($subakun) {
                                                foreach ($subakun as $dataSubakun) :
                                                    $idSubakun = $dataSubakun['id'];
                                            ?>
                                                    <tr>
                                                        <td></td>
                                                        <td width="5%" class="text-center">
                                                            <a href="" class="btn-tambah-akunanggaran" data-id="<?= $dataSubakun['id']; ?>" data-info="<?= $dataSubakun['anggaran']; ?>" data-toggle="tooltip" data-placement="bottom" title="Tambah Kodeperkiraan"><i class="fas fa-file-alt" style="color: teal"></i></a>
                                                        </td>
                                                        <td colspan="2"><?= $dataSubakun['anggaran']; ?></td>
                                                        <td class="text-center"><?= posisi_akun($dataSubakun['posisi']); ?></td>
                                                        <td class="text-center">
                                                            <a href="" class="btn-edit-anggaran" data-id="<?= $dataSubakun['id']; ?>" data-toggle="tooltip" data-placement="bottom" title="Edit"><i class="fas fa-edit" style="color: olive"></i></a> - <a href="" class="btn-hapus-anggaran" data-id="<?= $dataSubakun['id']; ?>" data-info="<?= $dataSubakun['anggaran']; ?>" data-toggle="tooltip" data-placement="bottom" title="Hapus"> <i class="far fa-trash-alt" style="color: maroon"></i></a>

                                                        </td>
                                                    </tr>
                                                    <?php
                                                    $daftar = $this->Akunanggaran_model->daftarAkun($idSubakun);
                                                    if ($daftar) {
                                                        foreach ($daftar as $dataDaftar) :

                                                    ?>
                                                            <tr>
                                                                <td></td>
                                                                <td></td>
                                                                <td colspan="3"><?= $dataDaftar['a6level_id']; ?> - <?= $dataDaftar['level6']; ?></td>
                                                                <td class="text-center">
                                                                    <a href="" class="btn-hapus-akunanggaran" data-id="<?= $dataDaftar['id']; ?>" data-info="<?= $dataDaftar['level6']; ?>" data-toggle="tooltip" data-placement="bottom" title="Hapus"> <i class="far fa-trash-alt" style="color: maroon"></i></a>
                                                                </td>
                                                            </tr>
                                            <?php
                                                        endforeach;
                                                    }
                                                endforeach;
                                            }
                                            ?>

                                        <?php
                                        //$no++;
                                        endforeach;
                                    } else {
                                        ?>
                                        <tr class="">
                                            <td colspan="7">Data Tidak Ditemukan</td>

                                        </tr>

                                    <?php
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
        $this->load->view('akuntansi/akunanggaran/modal');
        ?>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->