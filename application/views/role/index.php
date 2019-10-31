        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Role Management
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
                    <li><a href="#">Master Data</a></li>
                    <li class="active">Role Management</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <?= $this->session->flashdata('message'); ?>
                <!-- Default box -->
                <div class="panel panel-default">
                    <!-- Default panel contents -->
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-10">
                                <button type="button" class="btn btn-info" onclick="Swal.fire('Hello World!!','Latihan SweetAlert','success')">Info</button>
                            </div>
                            <div class="col-md-2 ">
                                <div class="pull-right">
                                    <button type="button" class="btn btn-success btn-sm " data-toggle="modal" data-target="#modal-tambah">
                                        Tambah Data
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered table-striped" id="table1">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Keterangan</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                ?>
                                <?php foreach ($role as $dataRole) :  ?>
                                    <tr>
                                        <th scope="row"><?= $no; ?></th>
                                        <td><?= $dataRole['role']; ?></td>
                                        <td><?= $dataRole['keterangan']; ?></td>
                                        <td class="align-middle text-center">
                                            <a href="javascript:void();" data-id="<?= $dataRole['id']; ?>" data-role="<?= $dataRole['role']; ?>" data-keterangan="<?= $dataRole['keterangan']; ?>" data-toggle="modal" data-target="#modal-ubah" class="btn btn-default btn-form-ubah btn=xs" title="Ubah Data">
                                                <span class="glyphicon glyphicon-pencil"></span>
                                            </a>
                                            <!-- <a href="#" data-id="" data-toggle="modal" data-target="#form-modal" class="btn btn-default btn-form-ubah btn=xs"><span class="glyphicon glyphicon-pencil"></span></a> -->

                                            <a href="javascript:void();" data-id="<?= $dataRole['id']; ?>" data-role="<?= $dataRole['role']; ?>" data-toggle="modal" data-target="#modal-hapus" class="btn btn-danger btn-alert-hapus" title="Hapus Data"><span class="glyphicon glyphicon-erase"></span></a>


                                        </td>
                                    </tr>
                                    <?php $no++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php $this->load->view('role/modal'); ?>
            </section>
            <!-- /.content -->

        </div>
        <!-- /.content-wrapper -->