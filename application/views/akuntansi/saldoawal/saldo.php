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
        <?= $this->session->flashdata('message'); ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col col-md-12">
                    <div class="card">
                        <div class="card-header bg-gradient-light">
                            <div>
                                <h4 class="card-title">
                                    <a href="<?= site_url('akuntansi/saldoawal') ?>" class="text-reset"><i class="far fa-list-alt" style="color: teal"></i> Tahun Pembukuan : <?= $idtahun; ?> </a>
                                </h4>
                            </div>
                            <div class="float-right">
                                <h4 class="card-title mr-4" disabled="disabled">
                                    <a href="<?= site_url('akuntansi/saldoawal/konfirmasi/') ?><?= $idtahun; ?>" class="text-reset">
                                        Konfirmasi <i class="fas fa-save" style="color: teal"> </i>
                                    </a>
                                </h4>

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
                                        <!-- <td class="col-1 text-center">Kode</td> -->
                                        <td colspan="7">Daftar Kode Perkiraan</td>
                                        <!-- <td>Posisi</td> -->
                                        <td class="text-center" width="15%">Saldo Awal ( Rp. )</td>
                                        <td class="text-center" width="10%" style="color: grey" width="8%"><i class="fas fa-cog"></i></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    //$no = 1;
                                    if ($kodeperkiraan) {
                                        foreach ($kodeperkiraan as $dataKode) :
                                            $idakun3 = $dataKode['id'];
                                    ?>
                                            <tr class="bg-light">
                                                <td class="text-center" width="8%">
                                                    <?= $idakun3; ?>.00.00.00
                                                </td>
                                                <td colspan="8" class="">
                                                    <?= $dataKode['level1']; ?> / <?= $dataKode['level2']; ?> / <?= $dataKode['level3']; ?>
                                                </td>
                                            </tr>
                                            <?php
                                            $level4 = $this->Kodeperkiraan_model->level4institusi($idakun3);
                                            if ($level4) {
                                                foreach ($level4 as $dataLevel4) :
                                                    $idakun4 = $dataLevel4['id'];
                                            ?>
                                                    <tr>
                                                        <td class="text-center">
                                                        </td>
                                                        <td class="text-center" width="8%"><?= $dataLevel4['id']; ?>.00.00</td>
                                                        <td colspan="7"><?= $dataLevel4['level4']; ?>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    $level5 = $this->Kodeperkiraan_model->level5institusi($idakun4);
                                                    if ($level5) {
                                                        foreach ($level5 as $dataLevel5) :
                                                            $idakun5 = $dataLevel5['id'];
                                                    ?>
                                                            <tr>
                                                                <td></td>
                                                                <td class="text-center">
                                                                </td>
                                                                <td class="text-center" width="8%"><?= $dataLevel5['id']; ?>.00</td>
                                                                <td colspan="6"><?= $dataLevel5['level5']; ?>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                            $level6 = $this->Kodeperkiraan_model->level6institusi($idakun5);
                                                            if ($level6) {
                                                                foreach ($level6 as $dataLevel6) :
                                                                    $idakun6 = $dataLevel6['id'];
                                                            ?>
                                                                    <tr>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td width="8%"><?= $dataLevel6['id']; ?></td>
                                                                        <td colspan="3"><?= $dataLevel6['level6']; ?></td>
                                                                        <td class="text-right"><?= ambilsaldo($idtahun, $idakun6) ?></td>
                                                                        <td class="text-center">
                                                                            <a href="" class="btn-edit-saldoawal" data-akunid="<?= $dataLevel6['id']; ?>" data-thbukuid="<?= $idtahun; ?>" data-info="<?= $dataLevel6['level6']; ?>" data-toggle="tooltip" data-placement="bottom" title="Edit"><i class="fas fa-edit" style="color: olive"></i></a> - <a href="" class="btn-hapus-saldoawal" data-akunid="<?= $dataLevel6['id']; ?>" data-thbukuid="<?= $idtahun; ?>" data-info="<?= $dataLevel6['level6']; ?>" data-toggle="tooltip" data-placement="bottom" title="Hapus Saldo"> <i class="far fa-trash-alt" style="color: maroon"></i></a>
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
        <?php $this->load->view('akuntansi/saldoawal/modal');
        ?>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->