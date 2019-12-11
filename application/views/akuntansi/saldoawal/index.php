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
                                    <a class="text-reset" id="" data-aksi="tambah">Pilih Tahun Pembukuan </a>
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
                            <table id="tabel1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <td width="8%">Kode</td>
                                        <td width="15%">Awal Periode</td>
                                        <td width="15%">Akhir Periode</td>
                                        <td width="42%">Keterangan</td>
                                        <td width="10%">Status</td>
                                        <td width="10%" class="text-center" style="color: grey"><i class="fas fa-cog"></i></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    //$no = 1;
                                    if ($tahunbuku) {
                                        foreach ($tahunbuku as $dataTahunbuku) :
                                            $idtahun = $dataTahunbuku['id'];
                                            ?>

                                            <tr>
                                                <td><?= $dataTahunbuku['id']; ?></td>
                                                <td><?= tanggal_indo($dataTahunbuku['awal_periode']); ?></td>
                                                <td><?= tanggal_indo($dataTahunbuku['akhir_periode']); ?></td>
                                                <td><?= $dataTahunbuku['keterangan']; ?></td>
                                                <td><?= txt_status($dataTahunbuku['is_active']); ?></td>
                                                <td class="text-center"><a href="<?= site_url('akuntansi/saldoawal/saldo/'); ?><?= $idtahun; ?>" class="btn-pilih-tahunbuku" data-id="<?= $dataTahunbuku['id']; ?>" data-toggle="tooltip" data-placement="bottom" title="Daftar Saldo"><i class="far fa-list-alt" style="color: teal"></i></a></td>
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
        <?php //$this->load->view('akuntansi/tahunbuku/modal');
        ?>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->