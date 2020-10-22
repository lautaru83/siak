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
                                    <a href="#" class="text-reset">Data User</a>
                                </h4>
                            </div>
                            <div class="float-right">
                                <h4 class="card-title" disabled="disabled">

                                </h4>
                            </div>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" id="tabel-data">
                            <?php
                            //var_dump($user);
                            $nama = "";
                            $email = "";
                            $jabatan = "";
                            if ($user) {
                                $nama = $user['nama'];
                                $email = $user['email'];
                                $jabatan = $user['role'];
                            }
                            ?>
                            <form>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="font-weight-normal">Nama</label>
                                            <div class="">
                                                <input type="text" name="nama" class="form-control" id="nama" value="<?= $nama; ?>" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="font-weight-normal">Email</label>
                                            <div class="">
                                                <input type="text" name="email" class="form-control" id="email" value="<?= $email; ?>" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="font-weight-normal">Jabatan</label>
                                            <div class="">
                                                <input type="text" name="jabatan" class="form-control" id="jabatan" value="<?= $jabatan; ?>" disabled>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="font-weight-normal">Password Lama</label>
                                            <div class="">
                                                <input type="hidden" id="ids" name="ids" value="<?= $this->session->userdata('xyz'); ?>">
                                                <input type="password" name="sandi" id="sandi" class="form-control" placeholder="Masukkan Password Lama">
                                                <span id="sandi_error" class="text-danger"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="font-weight-normal">Password Baru</label>
                                            <div class="">
                                                <input type="password" name="pass1" id="pass1" class="form-control" placeholder="Masukkan Password Baru">
                                                <span id="pass1_error" class="text-danger"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="font-weight-normal">Ulangi Password Baru</label>
                                            <div class="">
                                                <input type="password" name="pass2" id="pass2" class="form-control" placeholder="Ulangi Password Baru">
                                                <span id="pass2_error" class="text-danger"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row"></div>
                                <div class="row">
                                    <div class="col-sm-4">
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="text-center">
                                            <button id="btn-ubah-profil" type="submit" class="btn btn-success"><i class="far fa-check-square"></i> Simpan</button>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                    </div>
                                </div>

                            </form>
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
        <?php //$this->load->view('setting/unit/modal'); 
        ?>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->