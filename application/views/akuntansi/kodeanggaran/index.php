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
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr class="">
                                        <td colspan="8">Kode Anggaran</td>
                                        <td width="10%">Posisi</td>
                                        <td width="10%">Institusi</td>
                                        <td class="text-center" style="color: grey" width="10%"><i class="fas fa-cog"></i></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($kelompokanggaran) {
                                        foreach ($kelompokanggaran as $dataKelompok) :
                                            $idKelompok = $dataKelompok['id'];
                                            ?>
                                            <tr class="bg-light">
                                                <td class="text-center" width="5%">
                                                    <a href="" class="btn-tambah-unitanggaran" data-idkelompok="<?= $dataKelompok['id'] ?>" data-info="<?= $dataKelompok['kelompok_anggaran'] ?>" data-toggle="tooltip" data-placement="bottom" title="Subakun baru"><i class="fas fa-file-alt" style="color: teal"></i></a>
                                                </td>
                                                <td class="text-center" width="5%">
                                                    <?= $dataKelompok['id']; ?>.00.00
                                                </td>
                                                <td colspan="9" class="">
                                                    <?= $dataKelompok['kelompok_anggaran']; ?>
                                                </td>
                                            </tr>
                                            <?php
                                                    $subanggaran = $this->Kodeanggaran_model->subanggaran($idKelompok);
                                                    if ($subanggaran) {
                                                        foreach ($subanggaran as $dataSubanggaran) :
                                                            $idSubanggaran = $dataSubanggaran['id'];
                                                            ?>
                                                    <tr>
                                                        <td></td>
                                                        <td class="text-center">
                                                            <a href="" class="btn-tambah-subanggaran" data-idunit="<?= $dataSubanggaran['id']; ?>" data-info="<?= $dataSubanggaran['subanggaran']; ?>" data-toggle="tooltip" data-placement="bottom" title="Subakun baru"><i class="fas fa-file-alt" style="color: teal"></i></a>
                                                        </td>
                                                        <td class="text-center" width="5%"><?= $dataSubanggaran['id']; ?>.00.00</td>
                                                        <td colspan="7"><?= $dataSubanggaran['subanggaran']; ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <a href="" class="btn-edit-subanggaran" data-id="<?= $dataSubanggaran['id']; ?>" data-idkelompok="<?= $dataSubanggaran['kelompokanggaran_id']; ?>" data-toggle="tooltip" data-placement="bottom" title="Edit"><i class="fas fa-edit" style="color: olive"></i></a> - <a href="" class="btn-hapus-subanggaran" data-id="<?= $dataSubanggaran['id']; ?>" data-info="<?= $dataSubanggaran['subanggaran']; ?>" data-toggle="tooltip" data-placement="bottom" title="Hapus"> <i class="far fa-trash-alt" style="color: maroon"></i></a>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                                    $unit = $this->Kodeanggaran_model->unitanggaran($idSubanggaran);
                                                                    if ($unit) {
                                                                        foreach ($unit as $dataUnit) :
                                                                            $idUnit = $dataUnit['id'];
                                                                            ?>
                                                            <tr>
                                                                <td></td>
                                                                <td></td>
                                                                <td class="text-center">
                                                                    <a href="" class="btn-tambah-anggaran" data-idunit="<?= $dataUnit['id']; ?>" data-info="<?= $dataUnit['unit_anggaran']; ?>" data-toggle="tooltip" data-placement="bottom" title="Subakun baru"><i class="fas fa-file-alt" style="color: teal"></i></a>
                                                                </td>
                                                                <td class="text-center" width="5%"><?= $dataUnit['id']; ?>.00</td>
                                                                <td colspan="6"><?= $dataUnit['unit_anggaran']; ?>
                                                                </td>
                                                                <td class="text-center">
                                                                    <a href="" class="btn-edit-unitanggaran" data-id="<?= $dataUnit['id']; ?>" data-idsub="<?= $dataUnit['subanggaran_id']; ?>" data-toggle="tooltip" data-placement="bottom" title="Edit"><i class="fas fa-edit" style="color: olive"></i></a> - <a href="" class="btn-hapus-unitanggaran" data-id="<?= $dataUnit['id']; ?>" data-info="<?= $dataUnit['unit_anggaran']; ?>" data-toggle="tooltip" data-placement="bottom" title="Hapus"> <i class="far fa-trash-alt" style="color: maroon"></i></a>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                                                    $anggaran = $this->Kodeanggaran_model->anggaran($idUnit);
                                                                                    if ($anggaran) {
                                                                                        foreach ($anggaran as $dataAnggaran) :
                                                                                            $idunit = $dataAnggaran['id'];
                                                                                            ?>
                                                                    <tr>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td class="text-center" width="5%">
                                                                            <?= $dataAnggaran['id']; ?>
                                                                        </td>
                                                                        <td colspan="3">
                                                                            <?= $dataAnggaran['nama_anggaran']; ?>
                                                                        </td>
                                                                        <td>
                                                                            <?= posisi_akun($dataAnggaran['posisi']); ?>
                                                                        </td>
                                                                        <td>
                                                                            <?= $dataAnggaran['institusi']; ?>
                                                                        </td>
                                                                        <td class="text-center">
                                                                            <a href="" class="btn-edit-anggaran" data-id="<?= $dataAnggaran['id']; ?>" data-idunit="<?= $dataAnggaran['unitanggaran_id']; ?>" data-toggle="tooltip" data-placement="bottom" title="Edit"><i class="fas fa-edit" style="color: olive"></i></a> - <a href="" class="btn-hapus-anggaran" data-id="<?= $dataAnggaran['id']; ?>" data-info="<?= $dataAnggaran['nama_anggaran']; ?>" data-toggle="tooltip" data-placement="bottom" title="Hapus"> <i class="far fa-trash-alt" style="color: maroon"></i></a>

                                                                        </td>
                                                                    </tr>

                                                            <?php
                                                                                        endforeach;
                                                                                    }
                                                                                    ?>

                                                    <?php
                                                                        endforeach;
                                                                    }
                                                                    ?>

                                            <?php
                                                        endforeach;
                                                    }
                                                    ?>

                                    <?php
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
        $this->load->view('akuntansi/kodeanggaran/modal');
        ?>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->