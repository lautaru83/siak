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
                                    <a class="text-reset" id="kas-keluar">Tahun Pembukuan <?= $idtahun ?></a>
                                </h4>
                            </div>
                            <div class="float-right">
                                <h4 class="card-title" disabled="disabled">
                                    <a id="btn-tes-modal">
                                        Cetak <i class="fas fa-print" style="color: teal"></i>
                                    </a>
                                </h4>
                            </div>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" id="tabel-data">
                            <table class="table table-bordered table-hover table-sm">
                                <thead>
                                    <tr class="">
                                        <!-- <td width="3%" class="text-center"></td> -->
                                        <td colspan="6" class="text-center"><span>KODE PERKIRAAN</span></td>
                                        <td width="15%" class="text-center"><span>SALDO AWAL</span></td>
                                        <!-- <td width="3%" class="text-center"></td> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $level1 = $this->Kodeperkiraan_model->level1saldo();
                                    foreach ($level1 as $dataLevel1) :
                                        $idLevel1 = $dataLevel1['id'];
                                    ?>
                                        <tr>
                                            <!-- <td width="3%" class="text-center"></td> -->
                                            <td width="12%" class="font-weight-bolder text-center"><?= $dataLevel1['id']; ?>-00-00-00</td>
                                            <td colspan="6" class="font-weight-bolder text-uppercase text-md"><?= $dataLevel1['level1']; ?></td>
                                            <!-- <td width="10%" class="text-center">Posisi</td> -->
                                            <!-- <td width="3%" class="text-center"></td> -->
                                        </tr>
                                        <?php
                                        $level2 = $this->Kodeperkiraan_model->data_level2($idLevel1);
                                        foreach ($level2 as $dataLevel2) :
                                            $idLevel2 = $dataLevel2['id'];
                                        ?>
                                            <tr>
                                                <!-- <td width="3%" class="text-center"></td> -->
                                                <td width="10%" class="font-weight-normal text-center"><?= $dataLevel2['id']; ?>-00-00-00</td>
                                                <td colspan="6" class="font-weight-normal text-uppercase text-md"><?= $dataLevel2['level2']; ?></td>
                                                <!-- <td width="10%" class="text-center">Posisi</td> -->
                                                <!-- <td width="3%" class="text-center"></td> -->
                                            </tr>
                                            <?php
                                            $level3 = $this->Kodeperkiraan_model->data_level3($idLevel2);
                                            foreach ($level3 as $dataLevel3) :
                                                $idLevel3 = $dataLevel3['id'];
                                            ?>
                                                <tr>
                                                    <!-- <td width="3%" class="text-center"></td> -->
                                                    <td width="10%" class="font-weight-normal text-center"><?= $dataLevel3['id']; ?>-00-00-00</td>
                                                    <td colspan="6" class="font-weight-normal text-md"><?= $dataLevel3['level3']; ?></td>
                                                    <!-- <td width="10%" class="text-center">Posisi</td> -->
                                                    <!-- <td width="3%" class="text-center"></td> -->
                                                </tr>
                                                <?php
                                                $level4 = $this->Kodeperkiraan_model->level4institusi($idLevel3);
                                                foreach ($level4 as $dataLevel4) :
                                                    $idLevel4 = $dataLevel4['id'];
                                                ?>
                                                    <tr>
                                                        <!-- <td width="3%" class="text-center"></td> -->
                                                        <td></td>
                                                        <td width="10%" class="text-center"><?= $dataLevel4['id']; ?>-00-00</td>
                                                        <td colspan="5" class="text-md"><?= $dataLevel4['level4']; ?></td>
                                                        <!-- <td width="10%" class="text-center">Posisi</td> -->
                                                        <!-- <td width="3%" class="text-center"></td> -->
                                                    </tr>
                                                    <?php
                                                    $level5 = $this->Kodeperkiraan_model->level5institusi($idLevel4);
                                                    foreach ($level5 as $dataLevel5) :
                                                        $idLevel5 = $dataLevel5['id'];
                                                    ?>
                                                        <tr>
                                                            <!-- <td width="3%" class="text-center"></td> -->
                                                            <td></td>
                                                            <td></td>
                                                            <td width="10%" class="text-center"><?= $dataLevel5['id']; ?>-00</td>
                                                            <td colspan="4" class="text-md"><?= $dataLevel5['level5']; ?></td>
                                                            <!-- <td width="10%" class="text-center">Posisi</td> -->
                                                            <!-- <td width="3%" class="text-center"></td> -->
                                                        </tr>
                                                        <?php
                                                        $level6 = $this->Kodeperkiraan_model->level6institusi($idLevel5);
                                                        foreach ($level6 as $dataLevel6) :
                                                            $idLevel6 = $dataLevel6['id'];
                                                        ?>
                                                            <tr>
                                                                <!-- <td width="3%" class="text-center"></td> -->
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td width="10%" class="text-center"><?= $dataLevel6['id']; ?></td>
                                                                <td colspan="2" class="text-md"><?= $dataLevel6['level6']; ?></td>
                                                                <td class="text-center"><?= ambilsaldo($idtahun, $idLevel6) ?></td>
                                                                <!-- <td width="3%" class="text-center"></td> -->
                                                            </tr>

                                                        <?php
                                                        endforeach;
                                                        ?>
                                                    <?php
                                                    endforeach;
                                                    ?>

                                                <?php
                                                endforeach;
                                                ?>

                                            <?php
                                            endforeach;
                                            ?>

                                        <?php
                                        endforeach;
                                        ?>

                                    <?php
                                    endforeach;
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
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->