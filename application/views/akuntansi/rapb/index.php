<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <!-- <div class="container-fluid"> -->
        <div class="row">
            <div class="col-sm-6">
                <h4 class="ml-3">Pengaturan <?= $kontensubmenu; ?></h4>
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
                                    <i class="fas fa-list-alt" style="color: teal"></i> Pilih Tahun Anggaran
                                </h4>
                            </div>
                            <div class="float-right">
                                <!-- <h4 class="card-title" disabled="disabled">
                                    Cetak <i class="fas fa-print" style="color: teal"></i>
                                </h4> -->
                            </div>

                        </div>
                        <!-- /.card-header -->
                        <!-- <div class="card-body" id="tabel-data"> -->
                        <div class="card-body" id="tabel-data">
                            <table class="table table-bordered table-striped table-sm">
                                <thead>
                                    <tr>
                                        <td width="5%" class="text-center">No</td>
                                        <td class="text-center">Tahun Anggaran</td>
                                        <td class="text-center">Keterangan</td>
                                        <td class="text-center">Status</td>
                                        <td class="text-center" width="12%" style="color: grey"><i class="fas fa-cog"></i></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    if ($tahunanggaran) {
                                        foreach ($tahunanggaran as $dataTahunanggaran) :
                                            $idTahun = $dataTahunanggaran['id'];
                                    ?>

                                            <tr>
                                                <td class="text-center"><?= $no; ?></td>
                                                <td><?= $dataTahunanggaran['tahunanggaran']; ?></td>
                                                <td><?= $dataTahunanggaran['keterangan']; ?></td>
                                                <td class="text-center"><?= txt_status($dataTahunanggaran['is_active']); ?>
                                                </td>
                                                <td class="text-center">
                                                    <a href="
                                                <?= site_url('akuntansi/rapb/data/' . $idTahun); ?>" data-toggle="tooltip" data-placement="bottom" title="Rapb <?= $dataTahunanggaran['tahunanggaran']; ?>"><i class="far fa-list-alt" style="color: teal"></i>
                                                    </a>
                                                </td>

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
        <?php $this->load->view('akuntansi/tahunanggaran/modal');
        ?>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->