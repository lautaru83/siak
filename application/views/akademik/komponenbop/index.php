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
                                    <a href="#" class="text-reset" id="btn-tambah-komponenbop" data-aksi="tambah" data-toggle="tooltip" title="Tambah Komponen"><i class="fas fa-file-alt" style="color: teal"></i> Tambah data </a>
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
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <td width="5%" class="text-center" style="color: grey"><i class="fas fa-cog"></i></td>
                                        <td colspan="2">Komponen BOP</td>
                                        <td width="20%">Jenis</td>
                                        <td width="10%" class="text-center" style="color: grey"><i class="fas fa-cog"></i></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    //$kewajiban = "";
                                    //var_dump($kewajiban);
                                    if ($kewajiban) {
                                        foreach ($kewajiban as $dataKewajiban) :
                                            $idKewajiban = $dataKewajiban['id'];
                                    ?>

                                            <tr class="bg-light">
                                                <td class="text-center">
                                                    <a href="" class="btn-tambah-akunbop" data-idkewajiban="<?= $idKewajiban; ?>" data-info="<?= $dataKewajiban['kewajiban']; ?>" data-toggle="tooltip" data-placement="bottom" title="Tambah Akun BOP"><i class="fas fa-file-alt" style="color: teal"></i></a>
                                                </td>
                                                <td width="10%"><?= $no; ?>. <?= $dataKewajiban['kode']; ?></td>
                                                <td><?= $dataKewajiban['kewajiban']; ?></td>
                                                <td><?= txt_komponen($dataKewajiban['jenis']); ?></td>
                                                <td class="text-center">
                                                    <a href="" class="btn-edit-komponenbop" data-id="<?= $idKewajiban; ?>" data-toggle="tooltip" data-placement="bottom" title="Edit"><i class="fas fa-edit" style="color: olive"></i></a> - <a href="" class="btn-hapus-komponenbop" data-id="<?= $idKewajiban; ?>" data-info="<?= $dataKewajiban['kewajiban']; ?>" data-toggle="tooltip" data-placement="bottom" title="Hapus"> <i class="far fa-trash-alt" style="color: maroon"></i></a></td>
                                            </tr>
                                            <?php
                                            $akunbop = $this->Komponenbop_model->daftarakun($idKewajiban);
                                            if ($akunbop) {
                                                foreach ($akunbop as $dataAkunbop) :
                                                    $idAkunbop = $dataAkunbop['id'];
                                            ?>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td colspan="2">
                                                            <div class="pl-3">
                                                                <?= $dataAkunbop['a6level_id']; ?> - <?= $dataAkunbop['level6']; ?>
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            <a href="" class="btn-hapus-akunbop" data-id="<?= $idAkunbop; ?>" data-info="<?= $dataAkunbop['level6']; ?>" data-toggle="tooltip" data-placement="bottom" title="Hapus Akun"> <i class="far fa-trash-alt" style="color: maroon"></i></a>
                                                        </td>
                                                    </tr>
                                            <?php
                                                endforeach;
                                            }
                                            ?>
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
        <?php $this->load->view('akademik/komponenbop/modal');
        ?>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->