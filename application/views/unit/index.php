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
                                    <button type="button" class="btn btn-success btn-sm " data-toggle="modal" data-target="#modal-tambah-unit">
                                        Tambah Data
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered table-striped table-hover" id="table1">
                            <thead>
                                <tr>
                                    <th scope="col">Kode</th>
                                    <th scope="col">Unit Usaha</th>
                                    <th scope="col">Institusi</th>
                                    <th scope="col" class="text-center"><span class="glyphicon glyphicon-cog"></span></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                //$no = 1;
                                ?>
                                <?php foreach ($unit as $dataUnit) :  ?>
                                    <tr>
                                        <th scope="row"><?= $dataUnit['id']; ?></th>
                                        <td><?= $dataUnit['unit']; ?></td>
                                        <td><?= $dataUnit['institusi']; ?></td>
                                        <td class="text-center">

                                            <div class="dropdown">
                                                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Action
                                                    <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                                    <li><a class="edit-unit" data-id="<?= $dataUnit['id']; ?>">Ubah</a></li>

                                                    <li><a class="hapus_unit" data-id="<?= $dataUnit['id']; ?>" data-unit="<?= $dataUnit['unit']; ?>" data-toggle="modal" data-target="#modal-hapus-unit">Hapus</a></li>

                                                    <!-- <li role="separator" class="divider"></li>
                                                    <li><a data-unit="" onclick="hapus_unit('id')">Hapus</a></li> -->
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
                <?php $this->load->view('unit/modal2'); ?>
            </section>
            <!-- /.content -->

        </div>
        <!-- /.content-wrapper -->