        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Unit Management
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
                    <li><a href="#">Master Data</a></li>
                    <li class="active">Unit Management</li>
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
                            </div>
                            <div class="col-md-2">
                                <div class="pull-right">
                                    <button type="button" id="btn-tambah-unit" class="btn btn-success btn-sm">
                                        Tambah Data
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover" id="table1">
                                <thead>
                                    <tr>
                                        <th class="col-md-1">Kode</th>
                                        <th class="col-md-4">Unit Usaha</th>
                                        <th class="col-md-5">Institusi</th>
                                        <th class="col-md-2 text-center"><span class="glyphicon glyphicon-cog"></span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    //$no = 1;
                                    ?>
                                    <?php foreach ($unit as $dataUnit) :  ?>
                                        <tr>
                                            <th scope="row" class="align-middle"><?= $dataUnit['id']; ?></th>
                                            <td class="align-middle"><?= $dataUnit['unit']; ?></td>
                                            <td class="align-middle"><?= $dataUnit['institusi']; ?></td>
                                            <td class="align-middle text-center">
                                                <div class="dropup">
                                                    <button class="btn btn-default  dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Action
                                                        <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">

                                                        <li><a href="<?= site_url(); ?>unit/hapus/<?= $dataUnit['id']; ?>" class="btn hapus-unit" data-id="<?= $dataUnit['id']; ?>" data-unit="<?= $dataUnit['unit']; ?>"><span class="glyphicon glyphicon-trash"></span>Hapus</a></li>

                                                        <li role=" separator" class="divider"></li>

                                                        <li><a class="btn ubah-unit" data-id="<?= $dataUnit['id']; ?>"><span class="glyphicon glyphicon-edit"></span>Ubah</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php //$no++; 
                                            ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php $this->load->view('unit/modal'); ?>
            </section>
            <!-- /.content -->

        </div>
        <!-- /.content-wrapper -->