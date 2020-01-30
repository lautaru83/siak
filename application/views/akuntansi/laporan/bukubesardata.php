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
                                    Parameter Laporan
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
                            <form method="POST" action="<?= base_url('akuntansi/bukubesar/data'); ?>">
                                <div class="row">
                                    <div class="col-md-2">
                                        <label class="font-weight-normal">Awal Periode </label>
                                        <input type="text" name="awal_periode" id="awal_periode" class="form-control" autocomplete="off" value="<?= $awal_periode; ?>">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="font-weight-normal">Akhir Periode </label>
                                        <input type="text" name="akhir_periode" id="akhir_periode" class="form-control" autocomplete="off" value="<?= $akhir_periode; ?>">
                                    </div>
                                    <div class="col-md-5">
                                        <label class="font-weight-normal">Kode Perkiraan </label>
                                        <select id="a6level_id" name="a6level_id" class="form-control" tabindex="4">
                                            <option value="">- PILIH -</option>
                                            <?php
                                            if ($akunbuku) {
                                                foreach ($akunbuku as $dataAkunbuku) :
                                                    $akun_id = $dataAkunbuku['id'];
                                            ?>
                                                    <option value="<?= $dataAkunbuku['id']; ?>" <?= cek_combo($akun_id,$a6level_id); ?>><?= $dataAkunbuku['id']; ?> - <?= $dataAkunbuku['level6']; ?></option>
                                            <?php
                                                endforeach;
                                            }
                                            ?>
                                        </select>

                                        <span id="akun_error" class="text-danger"></span>
                                    </div>
                                    <div class="col-md-2 mt-auto">
                                        <button type="submit" class="btn btn-primary">Tampilkan</button>
                                    </div>


                                </div>
                            </form>
                            <!-- /.form inline -->
                            <!--------------- isi content ---------------------------- -->

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col-md-12 -->
            </div>
            <!-- /.row -->
            <?php
            if ($bukubesar) {
            ?>
                <!-- isi laporan -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header bg-gradient-light">
                                <div>
                                    <h4 class="card-title">
                                        Data Transaksi
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
                                        <table id="tabel3" class="table table-bordered table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <td width="5%" class="text-center">No</td>
                                                    <td width="9%" class="text-center">Tanggal</td>
                                                    <td width="9%" class="text-center">No.Bukti</td>
                                                    <td class="text-center">Uraian</td>
                                                    <td width="12%" class="text-center">Debet (Rp)</td>
                                                    <td width="12%" class="text-center">Kredit (Rp)</td>
                                                    <td width="12%" class="text-center">Saldo (Rp)</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                $saldo = 0;
                                                $debet = 0;
                                                $kredit = 0;
                                                foreach ($bukubesar as $dataBukubesar) :
                                                    $id = $dataBukubesar['id'];
                                                    $posisi = $dataBukubesar['posisi'];
                                                    $debet = $dataBukubesar['debet'];
                                                    $kredit = $dataBukubesar['kredit'];
                                                    if ($posisi == "D") {
                                                        $saldo = $saldo + $debet - $kredit;
                                                    } else {
                                                        $saldo = $saldo + $kredit - $debet;
                                                    }
                                                ?>
                                                    <tr class="font-weight-normal">
                                                        <td class="text-center"><?= $no; ?></td>
                                                        <td><?= tanggal_indo($dataBukubesar['tanggal_transaksi']); ?></td>
                                                        <td><?= $dataBukubesar['nobukti']; ?></td>
                                                        <td>
                                                            <?= $dataBukubesar['keterangan']; ?>
                                                        </td>
                                                        <td class="text-right">
                                                            <?= rupiah($dataBukubesar['debet']); ?>
                                                        </td>
                                                        <td class="text-right">
                                                            <?= rupiah($dataBukubesar['kredit']); ?>
                                                        </td>
                                                        <td class="text-right">
                                                            <?= rupiah_positif($saldo); ?>
                                                        </td>
                                                    </tr>
                                                <?php
                                                    $no++;
                                                endforeach;
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