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
                    <li class="breadcrumb-item active"><a href="<?= base_url('kelasaktif'); ?>" class="text-reset"><span style="color: teal">Kelas Aktif</span></a></li>
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
                                <?php
                                $kelas_id = "";
                                $perak_id = "";
                                $periodeAkad = "";
                                $kelas = "";
                                if ($detailkelas) {
                                    $kelas_id = $detailkelas['kelas_id'];
                                    $perak_id = $detailkelas['perak_id'];
                                    $periodeAkad = $detailkelas['periodeakademik'];
                                    $kelas = $detailkelas['kelas'];
                                }
                                $data['kelas_id'] = $kelas_id;
                                ?>
                                <h4 class="card-title">
                                    <a href="#" class="text-reset" id="btn-tambah-mahasiswaaktif" data-aksi="tambah"><i class="fas fa-file-alt" style="color: teal"></i> Tambah data </a>
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
                            //var_dump($detailkelas);
                            ?>
                            <div class="row">
                                <div class="col col-md-2">
                                    <span class="float-left">Periode Akademik</span>
                                    <span class="float-right">:</span>
                                </div>
                                <div class="col col-md-4">
                                    <span><?= $periodeAkad; ?></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col col-md-2">
                                    <span class="float-left">Kelas</span>
                                    <span class="float-right">:</span>
                                </div>
                                <div class="col col-md-4">
                                    <span><?= $kelas; ?></span>
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
                            <h4 class="card-title">
                                <span>Data Mahasiswa Aktif</span>
                            </h4>
                        </div>
                        <!-- /.card header-->
                        <div class="card-body" id="tabel-data">
                            <table class="table table-bordered table-striped table-sm">
                                <thead>
                                    <tr>
                                        <td width="5%" class="text-center">No</td>
                                        <td width="10%">NIM</td>
                                        <td width="">Nama</td>
                                        <td width="8%" class="text-center" style="color: grey"><i class="fas fa-cog"></i></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    //var_dump($mahasiswaaktif);
                                    $no = 1;
                                    if ($mahasiswaaktif) {
                                        foreach ($mahasiswaaktif as $dataMahasiswaaktif) :
                                            $idActive = $dataMahasiswaaktif['id'];
                                    ?>
                                            <tr>
                                                <td class="text-center"><?= $no; ?></td>
                                                <td><?= $dataMahasiswaaktif['nim']; ?></td>
                                                <td><?= $dataMahasiswaaktif['nama']; ?></td>
                                                <td class="text-center">
                                                    <a href="" class="btn-hapus-mahasiswaaktif" data-id="<?= $idActive; ?>" data-info="<?= $dataMahasiswaaktif['nama']; ?>" data-toggle="tooltip" data-placement="bottom" title="Hapus"> <i class="far fa-trash-alt" style="color: maroon"></i></a>
                                                </td>
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
                        <!-- /.card body-->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
        <?php $this->load->view('akademik/kelasaktif/modalmahasiswa', $data);
        ?>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->