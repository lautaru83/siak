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
                                    <a href="#" class="text-reset" id="btn-tambah-tahunajaran" data-aksi="tambah"><i class="fas fa-file-alt" style="color: teal"></i> Tambah data </a>
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
                            <table id="tabel1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <td width="8%" class="text-center">No</td>
                                        <td width="10%">Tahun Ajaran</td>
                                        <td width="10%">Semester</td>
                                        <td width="10%">Awal Periode</td>
                                        <td width="10%">Akhir Periode</td>
                                        <td>Keterangan</td>
                                        <td width="10%">status</td>
                                        <td width="10%" class="text-center" style="color: grey"><i class="fas fa-cog"></i></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    if ($tahunajaran) {
                                        foreach ($tahunajaran as $dataTahunajaran) :
                                            $idTahunajaran = $dataTahunajaran['id'];
                                    ?>

                                            <tr>
                                                <td class="text-center"><?= $no; ?></td>
                                                <td><?= $dataTahunajaran['tahun_ajaran']; ?></td>
                                                <td><?= $dataTahunajaran['awal_tahun']; ?></td>
                                                <td><?= $dataTahunajaran['akhir_tahun']; ?></td>
                                                <td><?= $dataTahunajaran['is_active']; ?></td>
                                                <td><?= $dataTahunajaran['is_active']; ?></td>
                                                <td><?= $dataTahunajaran['is_active']; ?></td>
                                                <td class="text-center"><a href="" class="btn-edit-tahunajaran" data-id="<?= $idTahunajaran; ?>" data-toggle="tooltip" data-placement="bottom" title="Edit"><i class="fas fa-edit" style="color: olive"></i></a> - <a href="" class="btn-hapus-tahunajaran" data-id="<?= $idTahunajaran; ?>" data-info="<?= $dataTahunajaran['tahun_ajaran']; ?>" data-toggle="tooltip" data-placement="bottom" title="Hapus"> <i class="far fa-trash-alt" style="color: maroon"></i></a></td>
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
        <?php //$this->load->view('akuntansi/jenistransaksi/modal');
        ?>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->