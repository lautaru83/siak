        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Institusi Management
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
                    <li><a href="#">Master Data</a></li>
                    <li class="active">Institusi Management</li>
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
                            <div class="col-md-11">
                            </div>
                            <div class="col-md-1">
                                <div class="pull-right">
                                    <button type="button" id="btn-tambah-institusi" class="btn btn-success btn-sm ">
                                        Tambah Data
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="table1">
                                <thead>
                                    <tr>
                                        <th class="col-md-1">#</th>
                                        <th class="col-md-3">Nama Intitusi</th>
                                        <th class="col-md-6">Keterangan</th>
                                        <th class="col-md-2 text-center"><span class="glyphicon glyphicon-cog"></span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    ?>
                                    <?php foreach ($institusi as $dataInstitusi) :  ?>
                                        <tr>
                                            <th scope="row" class="align-middle"><?= $no; ?></th>
                                            <td class="align-middle"><?= $dataInstitusi['institusi']; ?></td>
                                            <td class="align-middle"><?= $dataInstitusi['keterangan']; ?></td>
                                            <td class="align-middle text-center">

                                                <div class="dropup">
                                                    <button class="btn btn-default  dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Action
                                                        <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">

                                                        <li><a href="<?= site_url(); ?>institusi/hapus/<?= $dataInstitusi['id']; ?>" class="btn hapus-institusi" data-id="<?= $dataInstitusi['id']; ?>" data-institusi="<?= $dataInstitusi['institusi']; ?>"><span class="glyphicon glyphicon-trash"></span>Hapus</a></li>

                                                        <li role=" separator" class="divider"></li>

                                                        <li><a class="btn ubah-institusi" data-id="<?= $dataInstitusi['id']; ?>"><span class="glyphicon glyphicon-edit"></span>Ubah</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php $no++; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php $this->load->view('institusi/modal'); ?>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->