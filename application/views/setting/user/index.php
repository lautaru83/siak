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
            <div class="row">
                <div class="col col-md-12">
                    <div class="card">
                        <div class="card-header bg-gradient-light">
                            <div>
                                <h4 class="card-title">
                                    <a href="#" class="text-reset" id="btn-tambah-user"><i class="fas fa-file-alt" style="color: teal"></i> Tambah data </a>
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
                                        <td class="w-1">No</td>
                                        <td class="w-20">Nama</td>
                                        <td class="w-15">Role</td>
                                        <td class="w-10">Institusi</td>
                                        <td class="w-20">Email</td>
                                        <td class="w-5">Status</td>
                                        <td class="w-29 text-center" style="color: grey"><i class="fas fa-cog"></i></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                                        $no = 1;
                                                        if ($user) {
                                                            foreach ($user as $dataUser) :
                                    ?>

                                            <tr>
                                                <td><?= $no; ?></td>
                                                <td><?= $dataUser['nama']; ?></td>
                                                <td><?= $dataUser['role']; ?></td>
                                                <td><?= $dataUser['institusi']; ?></td>
                                                <td><?= $dataUser['email']; ?></td>
                                                <td><?= $dataUser['is_active']; ?></td>
                                                <td class="text-center"><a href="" class="btn-edit-user" data-id="<?= $dataUser['id']; ?>" data-toggle="tooltip" data-placement="bottom" title="Edit"><i class="fas fa-edit" style="color: olive"></i></a> - <a href="" class="btn-hapus-user" data-id="<?= $dataUser['id']; ?>" data-info="<?= $dataUser['nama']; ?>" data-toggle="tooltip" data-placement="bottom" title="Hapus"> <i class="far fa-trash-alt" style="color: maroon"></i></a></td>
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
        <?php $this->load->view('setting/user/modal'); ?>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->