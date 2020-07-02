<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <!-- <div class="container-fluid"> -->
        <div class="row">
            <div class="col-sm-6">
                <h3 class="ml-3"><?= $kontensubmenu; ?> Mahasiswa</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right mr-4">
                    <li class="breadcrumb-item"><a><?= $kontenmenu; ?></a></li>
                    <li class="breadcrumb-item active"><a href="<?= base_url('/mahasiswa'); ?>">Mahasiswa</a></li>
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
                                    Data Kelas
                                </h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php
                            if ($detailkelas) {
                                //$idKelas = $detailkelas['id'];
                            ?>
                                <table class="table table-borderless">
                                    <tr>
                                        <td width="4%">Kelas</td>
                                        <td width="1%">:</td>
                                        <td width="10%"><?= $detailkelas['id']; ?></td>
                                        <td width="4%">Prodi</td>
                                        <td width="1%">:</td>
                                        <td width="25%"><?= $detailkelas['prodi']; ?></td>
                                        <td width="4%">Angkatan</td>
                                        <td width="1%">:</td>
                                        <td width="10%"><?= $detailkelas['angkatan']; ?></td>
                                        <td></td>
                                    </tr>
                                </table>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col col-md-12">
                    <div class="card">
                        <div class="card-header bg-gradient-light">
                            <div>
                                <h4 class="card-title">
                                    <a href="#" class="text-reset" id="btn-tambah-mahasiswa" data-aksi="tambah"><i class="fas fa-file-alt" style="color: teal"></i> Tambah data </a>
                                </h4>
                            </div>
                            <div class="float-right">
                                <h4 class="card-title" disabled="disabled">
                                    <a href="<?= site_url('akademik/mahasiswa/cetak/' . $kelas_id); ?>" target="_blank" class="text-reset">Cetak <i class="fas fa-print" style="color: teal"></i></a>
                                </h4>
                            </div>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" id="tabel-data">
                            <table class="table table-bordered table-striped table-sm">
                                <thead>
                                    <tr>
                                        <td width="5%" class="text-center">No</td>
                                        <td width="12%">NIM</td>
                                        <td>Nama</td>
                                        <td width="10%">Status</td>
                                        <td width="12%" class="text-center" style="color: grey"><i class="fas fa-cog"></i></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    if ($mahasiswa) {
                                        foreach ($mahasiswa as $dataMahasiswa) :
                                            $idMahasiswa = $dataMahasiswa['id'];
                                    ?>

                                            <tr>
                                                <td class="text-center"><?= $no; ?></td>
                                                <td><?= $dataMahasiswa['nim']; ?></td>
                                                <td><?= $dataMahasiswa['nama']; ?></td>
                                                <td><?= txt_status($dataMahasiswa['is_active']); ?></td>
                                                <td class="text-center"><a href="" class="btn-edit-mahasiswa" data-id="<?= $idMahasiswa; ?>" data-toggle="tooltip" data-placement="bottom" title="Edit"><i class="fas fa-edit" style="color: olive"></i></a> - <a href="" class="btn-hapus-mahasiswa" data-id="<?= $idMahasiswa; ?>" data-info="<?= $dataMahasiswa['nama']; ?>" data-toggle="tooltip" data-placement="bottom" title="Hapus"> <i class="far fa-trash-alt" style="color: maroon"></i></a></td>
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
        <?php $this->load->view('akademik/mahasiswa/modal');
        ?>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->