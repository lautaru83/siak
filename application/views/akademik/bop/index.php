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
                                    <a href="#" class="text-reset" id="btn-tambah-bop" data-aksi="tambah" data-toggle="tooltip" title="Tambah BOP"><i class="fas fa-file-alt" style="color: teal"></i> Tambah data </a>
                                </h4>
                            </div>
                            <div class="float-right">
                                <h4 class="card-title" disabled="disabled">
                                    <a href="<?= site_url('akademik/bop/cetak/'); ?>" target="_blank" class="text-reset">Cetak <i class="fas fa-print" style="color: teal"></i></a>
                                </h4>
                            </div>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" id="tabel-data">
                            <table class="table table-bordered table-hover table-sm">
                                <thead>
                                    <tr>
                                        <td width="5%" class="text-center">No</td>
                                        <td width="20%">Kode Pembayaran</td>
                                        <td>Kelas Aktif</td>
                                        <td width="10%" class="text-center" style="color: grey"><i class="fas fa-cog"></i></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    if ($bop2) {
                                        foreach ($bop2 as $dataBop) :
                                            $idBop = $dataBop['id'];
                                            $kdbop = $dataBop['kode'];
                                    ?>
                                            <tr class="bg-light">
                                                <td class="text-center">
                                                    <?= $no; ?>
                                                </td>
                                                <td><?= $dataBop['kode']; ?></td>
                                                <td><?= $dataBop['keterangan']; ?></td>
                                                <td class="text-center">
                                                    <a href="<?= site_url('akademik/bop/data/' . $idBop . '/' . $kdbop); ?>" class="btn-detail-bop" data-toggle="tooltip" data-placement="bottom" title="Detail BOP <?= $dataBop['kode']; ?>"><i class="far fa-list-alt" style="color: teal"></i></a> - <a href="" class="btn-edit-bop" data-id="<?= $idBop; ?>" data-toggle="tooltip" data-placement="bottom" title="Edit"><i class="fas fa-edit" style="color: olive"></i></a> - <a href="" class="btn-hapus-bop" data-id="<?= $idBop; ?>" data-info="<?= $dataBop['kode']; ?>" data-toggle="tooltip" data-placement="bottom" title="Hapus"> <i class="far fa-trash-alt" style="color: maroon"></i></a></td>
                                            </tr>
                                        <?php
                                            $no++;
                                        endforeach;
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="4" class="text-center">
                                                Data tidak ditemukan
                                            </td>
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
        <?php $this->load->view('akademik/bop/modal');
        ?>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->