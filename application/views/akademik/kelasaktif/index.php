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
            <?= $this->session->flashdata('message'); ?>
            <div class="row">
                <div class="col col-md-12">
                    <div class="card">
                        <div class="card-header bg-gradient-light">
                            <div>
                                <h4 class="card-title">
                                    <a href="#" class="text-reset" id="btn-tambah-kelasaktif" data-aksi="tambah"><i class="fas fa-file-alt" style="color: teal"></i> Tambah data </a>
                                </h4>
                            </div>
                            <div class="float-right">
                                <h4 class="card-title" disabled="disabled">
                                    Cetak <i class="fas fa-print" style="color: teal"></i>
                                </h4>
                            </div>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" id="tabel-data">
                            <?php
                            // var_dump($periode);
                            // echo "<br>";
                            // echo $periode['id'];
                            ?>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <td width="5%" class="text-center">No</td>
                                        <td width="30%">Periode Akademik</td>
                                        <td width="">Kelas</td>
                                        <td width="10%" class="text-center">Mahasiswa</td>
                                        <td width="12%" class="text-center" style="color: grey"><i class="fas fa-cog"></i></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    if ($kelasaktif) {
                                        foreach ($kelasaktif as $dataKelasaktif) :
                                            $idKelasaktif = $dataKelasaktif['id'];
                                    ?>
                                            <tr>
                                                <td class="text-center"><?= $no; ?></td>
                                                <td><?= $dataKelasaktif['periodeakademik']; ?></td>
                                                <td><?= $dataKelasaktif['kelas']; ?></td>
                                                <td class="text-center"></td>
                                                <td class="text-center"><a href="<?= base_url('akademik/kelasaktif/mahasiswa/' . $idKelasaktif); ?>" class="btn-mahasiswa-aktif" data-id="<?= $idKelasaktif; ?>" data-toggle="tooltip" data-placement="bottom" title="Mahasiswa Aktif"><i class="fas fa-list-alt" style="color: olive"></i></a> - <a href="" class="btn-hapus-kelasaktif" data-id="<?= $idKelasaktif; ?>" data-info="<?= $dataKelasaktif['kelas']; ?>" data-toggle="tooltip" data-placement="bottom" title="Hapus"> <i class="far fa-trash-alt" style="color: maroon"></i></a></td>
                                            </tr>
                                        <?php
                                            $no++;
                                        endforeach;
                                    } else {
                                        ?>

                                        <tr>
                                            <td colspan="4" class="text-center">Data tidak ditemukan</td>
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
        <?php $this->load->view('akademik/kelasaktif/modal');
        ?>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->