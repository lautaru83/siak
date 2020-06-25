<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <!-- <div class="container-fluid"> -->
        <div class="row">
            <div class="col-sm-6">
                <h3 class="ml-3">Laporan <?= $kontensubmenu; ?></h3>
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
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-gradient-light">
                            <div>
                                <h4 class="card-title">
                                    Tahun Pembukuan <?= $this->session->userdata('tahun_buku'); ?>
                                </h4>
                            </div>
                            <div class="float-right">
                                <!-- <h4 class="card-title" disabled="disabled">
                                    Cetak <i class="fas fa-print" style="color: teal"></i>
                                </h4> -->
                            </div>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <!--------------- isi content ---------------------------- -->
                            <form method="POST" action="<?= base_url('akuntansi/neracasaldo/data'); ?>">
                                <div class="row">
                                    <div class="col-md-2">
                                        <label class="font-weight-normal">Pembukuan</label>
                                        <select id="ns_pembukuan_id" name="ns_pembukuan_id" class="form-control">
                                            <?php
                                            foreach ($pembukuan as $dataPembukuan) :
                                                $idBuku = $dataPembukuan['id'];
                                            ?>
                                                <option value="<?= $dataPembukuan['id']; ?>" <?php cek_combo($pembukuan_id, $idBuku); ?>><?= $idBuku; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="font-weight-normal">Akhir Periode </label>
                                        <input type="hidden" id="awalperiode" name="awalperiode" value="<?= $awal_periode; ?>">
                                        <input type="text" name="akhir_periode" id="akhir_periode" class="form-control" autocomplete="off" value="<?= $akhir_periode; ?>">
                                    </div>
                                    <!-- <button type="submit" id="btn_tampl_neracasaldo" class="btn btn-primary mb-2">Terapkan</button> -->
                                    <div class="col-md-2 mt-auto">
                                        <button type="submit" class="btn btn-primary">Tampilkan</button>
                                    </div>

                                </div>
                                <!-- /.row -->
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col-md-12 -->
            </div>
            <!-- /.row -->
            <?php
            //var_dump($neracasaldo);
            if ($neracasaldo) {
            ?>
                <!-- isi laporan -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header bg-gradient-light">
                                <div>
                                    <h4 class="card-title">
                                        Data Laporan
                                    </h4>
                                </div>
                                <div class="float-right">
                                    <h4 class="card-title" disabled="disabled">
                                        Cetak <i class="fas fa-print" style="color: teal"></i>
                                    </h4>
                                </div>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table id="tabel3" class="table table-bordered table-striped table-hover table-sm">
                                            <thead>
                                                <tr>
                                                    <td width="5%" class="text-center">No</td>
                                                    <td colspan="2" class="text-center">Kode Perkiraan</td>
                                                    <td width="15%" class="text-center">Saldo Debet (Rp)</td>
                                                    <td width="15%" class="text-center">Saldo Kredit (Rp)</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                $saldodebet = 0;
                                                $saldokredit = 0;
                                                if ($neracasaldo) {
                                                    foreach ($neracasaldo as $dataNeracasaldo) :
                                                        $posisi = $dataNeracasaldo['posisi'];
                                                        $debet = $dataNeracasaldo['debet'];
                                                        $kredit = $dataNeracasaldo['kredit'];
                                                        if ($posisi == "D") {
                                                            $saldodebet = $debet - $kredit;
                                                            $saldokredit = 0;
                                                        } else {
                                                            $saldodebet = 0;
                                                            $saldokredit = $kredit - $debet;
                                                        }


                                                        //$id = $dataNeracasaldo['id'];
                                                ?>
                                                        <tr class="font-weight-normal">
                                                            <td width="5%" class="text-center"><?= $no; ?></td>
                                                            <td width="10%" class="text-center"><?= $dataNeracasaldo['id']; ?></td>
                                                            <td><?= $dataNeracasaldo['level6']; ?></td>
                                                            <td class="text-right">
                                                                <?php rupiah_positif($saldodebet); ?>
                                                            </td>
                                                            <td class="text-right">
                                                                <?php rupiah_positif($saldokredit); ?>
                                                            </td>
                                                        </tr>
                                                <?php
                                                        $no++;
                                                    endforeach;
                                                }
                                                ?>
                                            </tbody>
                                        </table>



                                        <!--------------- isi content ---------------------------- -->
                                    </div>
                                    <!-- /.col-md-12 -->
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col-md-12 -->
                </div>
                <!-- /.row -->
                <!-- isi laporan -->
            <?php
            }
            ?>

        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->