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
                                    <a class="text-reset" id="" data-aksi="tambah">Pilih Kelas Mahasiswa </a>
                                </h4>
                            </div>
                            <!-- <div class="float-right">
                                <h4 class="card-title" disabled="disabled">
                                    Cetak <i class="fas fa-print" style="color: teal"></i>
                                </h4>
                            </div> -->

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" id="tabel-data">
                            <table id="tabel1" class="table table-bordered table-striped table-sm">
                                <thead>
                                    <tr>
                                        <td width="8%" class="text-center">Kode</td>
                                        <td class="text-center">Angkatan</td>
                                        <td width="12%" class="text-center" style="color: grey"><i class="fas fa-cog"></i></td>
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
                                                <td class="text-center"><?= $dataKelas['id']; ?></td>
                                                <td><?= $dataKelas['keterangan']; ?></td>
                                                <td class="text-center"><a href="<?= site_url('akademik/mahasiswa/data/'); ?><?= $idKelas; ?>" class="btn-pilih-angkatan" data-id="<?= $idKelas; ?>" data-toggle="tooltip" data-placement="bottom" title="Pilih Kelas <?= $dataKelas['keterangan']; ?>"><i class="far fa-list-alt" style="color: teal"></i></a></td>
                                            </tr>
                                    <?php
                                        //$no++;
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
        <?php //$this->load->view('akuntansi/jenistransaksi/modal');
        ?>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->