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
                    <li class="breadcrumb-item active"><a href="<?= base_url('akademik/bop'); ?>" class="text-reset"><span style="color: teal">BOP</span></a></li>
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
                                    <a href="#" class="text-reset" id="btn-tambah-detailbop" data-aksi="tambah" data-toggle="tooltip" title="Tambah Detail BOP"><i class="fas fa-file-alt" style="color: teal"></i> Tambah data </a>
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
                            $idDetail = "";
                            $kode = "";
                            $keterangan = "";
                            if ($bop) {
                                $idDetail = $bop['id'];
                                $kode = $bop['kode'];
                                $keterangan = $bop['keterangan'];
                            }
                            $data['bop_id'] = $idDetail;
                            ?>
                            <div class="row">
                                <div class="col col-md-2">
                                    <span class="float-left">Kode Pembayaran</span>
                                    <span class="float-right">:</span>
                                </div>
                                <div class="col col-md-4">
                                    <span><?= $kode; ?></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col col-md-2">
                                    <span class="float-left">Keterangan</span>
                                    <span class="float-right">:</span>
                                </div>
                                <div class="col col-md-10">
                                    <span><?= $keterangan; ?></span>
                                </div>
                            </div>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col col-md-12">
                    <div class="card">
                        <div class="card-header bg-gradient-light">
                            <div>
                                <h4 class="card-title">
                                    <span>Detail BOP</span>
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
                            <?php
                            //var_dump($komponen);
                            ?>
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <td width="5%" class="text-center">No</td>
                                        <td colspan="2">Komponen BOP</td>
                                        <td width="20%" class="text-center">Jumlah (Rp)</td>
                                        <td width="10%" class="text-center" style="color: grey"><i class="fas fa-cog"></i></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    // $detail = "";
                                    //var_dump($detail);
                                    if ($detail) {
                                        foreach ($detail as $dataDetail) :
                                            $idDetail = $dataDetail['id'];
                                    ?>
                                            <tr>
                                                <td class="text-center">
                                                    <?= $no; ?>
                                                </td>
                                                <td width="10%"><?= $dataDetail['kode']; ?></td>
                                                <td><?= $dataDetail['kewajiban']; ?></td>
                                                <td class="text-right"><?= rupiah($dataDetail['jumlah']); ?></td>
                                                <td class="text-center">
                                                    <a href="" class="btn-edit-detailbop" data-id="<?= $idDetail; ?>" data-toggle="tooltip" data-placement="bottom" title="Edit"><i class="fas fa-edit" style="color: olive"></i></a> - <a href="" class="btn-hapus-detailbop" data-id="<?= $idDetail; ?>" data-info="<?= $dataDetail['kode']; ?>" data-toggle="tooltip" data-placement="bottom" title="Hapus"> <i class="far fa-trash-alt" style="color: maroon"></i></a></td>
                                            </tr>
                                        <?php
                                            $no++;
                                        endforeach;
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="5" class="text-center">
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
        <?php $this->load->view('akademik/bop/modaldetailbop', $data);
        ?>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->