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
            <?= $this->session->flashdata('message'); ?>
            <div class="row">
                <div class="col col-md-12">
                    <div class="card">
                        <div class="card-header bg-gradient-light">
                            <div>
                                <h4 class="card-title">
                                    <a href="#" class="text-reset" id="btn-tambah-kelas" data-aksi="tambah"><i class="fas fa-file-alt" style="color: teal"></i> Tambah data </a>
                                </h4>
                            </div>
                            <div class="float-right">
                                <h4 class="card-title" disabled="disabled">
                                    <a href="<?= site_url('akademik/kelas/cetak') ?>" target="_blank" class="text-reset">Cetak <i class="fas fa-print" style="color: teal"></i></a>
                                </h4>
                            </div>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" id="tabel-data">
                            <?php
                            //var_dump($kelas);
                            ?>
                            <table class="table table-bordered table-striped table-sm">
                                <thead>
                                    <tr>
                                        <td width="5%" class="text-center">No</td>
                                        <td width="8%" class="text-center">Kode</td>
                                        <td width="20%" class="text-center">Prodi</td>
                                        <td width="8%" class="text-center">Angkatan</td>
                                        <td class="text-center">Keterangan</td>
                                        <td width="10%" class="text-center" style="color: grey"><i class="fas fa-cog"></i></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    if ($kelas) {
                                        foreach ($kelas as $dataKelas) :
                                            $idKelas = $dataKelas['id'];
                                    ?>

                                            <tr>
                                                <td class="text-center"><?= $no; ?></td>
                                                <td class="text-center"><?= $dataKelas['id']; ?></td>
                                                <td><?= $dataKelas['prodi']; ?></td>
                                                <td class="text-center"><?= $dataKelas['angkatan']; ?></td>
                                                <td><?= $dataKelas['keterangan']; ?></td>
                                                <td class="text-center"><a href="" class="btn-edit-kelas" data-id="<?= $idKelas; ?>" data-toggle="tooltip" data-placement="bottom" title="Edit"><i class="fas fa-edit" style="color: olive"></i></a> - <a href="" class="btn-hapus-kelas" data-id="<?= $idKelas; ?>" data-info="<?= $dataKelas['keterangan']; ?>" data-toggle="tooltip" data-placement="bottom" title="Hapus"> <i class="far fa-trash-alt" style="color: maroon"></i></a></td>
                                            </tr>
                                    <?php
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
        <?php $this->load->view('akademik/kelas/modal');
        ?>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->