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
        <?= $this->session->flashdata('message'); ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col col-lg-12">
                    <div class="card">
                        <div class="card-header bg-gradient-light">
                            <div>
                                <h4 class="card-title">
                                    <a class="text-reset" id="kas-masuk">Tahun Pembukuan <?= $pembukuan_id ?></a>
                                </h4>
                            </div>
                            <?php
                            $totaldebet = 0.00;
                            $totalkredit = 0.00;
                            if ($idTransaksi) {
                                $total = $this->Opm_model->cektotaltransaksi($idTransaksi);
                                if ($total) {
                                    $totaldebet = $total['debet'];
                                    $totalkredit = $total['kredit'];
                                    if ($totaldebet == $totalkredit) {
                            ?>
                                        <div class="float-right">
                                            <h4 class="card-title" disabled="disabled">
                                                <a href="" class="text-reset" id="btn-selesai-opmtransaksi" data-id="<?= $idTransaksi; ?>" data-total="<?= $totaldebet; ?>" data-notran="<?= $rnotran; ?>">
                                                    Selesai<i class="far fa-check-square" style="color: teal"></i>
                                                </a>
                                            </h4>
                                        </div>
                            <?php
                                    }
                                }
                            }
                            ?>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <?php
                            // if ($idTransaksi) {
                            //     var_dump($total);
                            //     echo input_uang($total['debet']);
                            // }
                            ?>
                            <div class="row">
                                <?php
                                $nama = "";
                                $idKelas = "";
                                $kelas = "";
                                $saldo = 0;
                                $piutang = 0;
                                if ($mhs) {
                                    // foreach ($mhs as $dataMhs) :
                                    $idMahasiswa = $mhs['id'];
                                    $nama = $mhs['nama'];
                                    $nim = $mhs['nim'];
                                    $idKelas = $mhs['kelas_id'];
                                    $kelas = $mhs['keterangan'];
                                    $saldo = $mhs['kredit'];
                                    $piutang = $mhs['debet'];
                                    $rket = "Operasional mahasiswa $nim a/n $nama";
                                    if ($institusi_id == "01") {
                                        $idUnit = "01";
                                    } else {
                                        $idUnit = $mhs['unit_id'];
                                    }
                                    if ($status == 1) {
                                        $rketerangan = $keterangan;
                                    } else {
                                        $rketerangan = $rket;
                                    }
                                }
                                //$akunbayar = $this->Opm_model->daftarakunopm($idKelas, $perak_id);
                                //var_dump($akunbayar);
                                ?>
                                <div class="col col-sm-6">
                                    <table class="table table-borderless table-sm">
                                        <tr>
                                            <td width="20%">Nim/Nama</td>
                                            <td width="5%">:</td>
                                            <td width="75%"><?= $nim; ?> / <?= $nama; ?> <a href="" class="text-reset" id="btn-edit-nimopm"><i class="fas fa-pen-square" style="color: olive"></i></a></td>
                                        </tr>
                                        <tr>
                                            <td>Kelas</td>
                                            <td>:</td>
                                            <td><?= $kelas; ?></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col col-sm-6">
                                    <table class="table table-borderless table-sm">
                                        <?php
                                        $danasurplus = rupiah($this->Opm_model->trandanasurplus($idMahasiswa));
                                        ?>
                                        <tr>
                                            <td width="20%">Saldo</td>
                                            <td width="5%">:</td>
                                            <td width="75%">
                                                <?= rupiah($this->Opm_model->danasurplus($idMahasiswa)); ?>
                                                <?php
                                                if ($danasurplus <> 0) {
                                                    if ($danasurplus > 0) {
                                                        echo "<span class='text-success'> $danasurplus</span>";
                                                    } else {
                                                        echo "<span class='text-danger'>$danasurplus</span>";
                                                    }
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                        <?php
                                        $piutang = rupiah($this->Opm_model->tranpiutang($idMahasiswa));
                                        ?>
                                        <tr>
                                            <td>Piutang</td>
                                            <td>:</td>
                                            <td>
                                                <?= rupiah($this->Opm_model->piutang($idMahasiswa)); ?>
                                                <?php
                                                if ($piutang <> 0) {
                                                    if ($piutang > 0) {
                                                        echo "<span class='text-success'> $piutang</span>";
                                                    } else {
                                                        echo "<span class='text-danger'>$piutang</span>";
                                                    }
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <!-- <div class="row">-->

                            <!-- /row -->
                            <div class="row">
                                <div class="col col-lg-12">
                                    <div class="card card-info card-tabs">
                                        <div class="card-header p-0 pt-1">
                                            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Transaksi</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Status Pembayaran</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">Piutang</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="custom-tabs-one-settings-tab" data-toggle="pill" href="#custom-tabs-one-settings" role="tab" aria-controls="custom-tabs-one-settings" aria-selected="false">Riwayat Pembayaran</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="card-body">
                                            <div class="tab-content" id="custom-tabs-one-tabContent">
                                                <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label class="font-weight-normal">Tanggal</label>
                                                                <div class="">
                                                                    <input type="hidden" id="mahasiswa_id" name="mahasiswa_id" value="<?= $idMahasiswa; ?>">
                                                                    <input type="hidden" id="idUbah" name="idUbah" value="<?= $idTransaksi; ?>">
                                                                    <input type="hidden" id="nim" name="nim" value="<?= $nim; ?>">
                                                                    <input type="text" name="tanggal_transaksi" id="tanggal_transaksi" class="form-control" autocomplete="off" tabindex="1" value="<?= $tanggal_transaksi; ?>">
                                                                    <span id="tanggal_error" class="text-danger"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label class="font-weight-normal">No. Bukti</label>
                                                                <div class="">
                                                                    <input type="text" name="nobukti" class="form-control" tabindex="2" id="nobukti" value="<?= $nobukti; ?>">
                                                                    <span id="nobukti_error" class="text-danger"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label class="font-weight-normal">No. Referensi</label>
                                                                <div class="">
                                                                    <input type="text" name="noref" class="form-control" tabindex="3" id="noref" value="<?= $noref; ?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label class="font-weight-normal">No. Transaksi</label>
                                                                <div class="">
                                                                    <input type="text" name="notran" class="form-control" id="notran" value="<?= $rnotran; ?>" disabled>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label class="font-weight-normal">Jenis Transaksi</label>
                                                                <!-- <div class=""> -->
                                                                <select id="jenis" name="jenis" class="form-control" tabindex="4" <?= opjenis_status($jml_transaksi); ?>>
                                                                    <?php
                                                                    foreach ($txtjenis as $datajenis) :
                                                                        $idJenis = $datajenis['id'];
                                                                    ?>
                                                                        <option value="<?= $idJenis; ?>" <?= cek_combo($idJenis, $jenis); ?>><?= $datajenis['jenis']; ?></option>
                                                                    <?php
                                                                    endforeach;
                                                                    ?>
                                                                </select>
                                                                <span id="jenis_error" class="text-danger"></span>
                                                                <!-- </div> -->
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label class="font-weight-normal">Keterangan</label>
                                                                <div class="">
                                                                    <input type="text" name="keterangan" class="form-control" id="keterangan" tabindex="5" value="<?= $rketerangan; ?>">
                                                                    <span id="keterangan_error" class="text-danger"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label class="font-weight-normal">Unit Usaha</label>
                                                                <div class="">
                                                                    <input type="hidden" id="unit_id" name="unit_id" value="<?= $idUnit; ?>">
                                                                    <input type="hidden" id="status" name="status" value="<?= $status; ?>">
                                                                    <input type="hidden" id="jurnal" name="jurnal" value="<?= $jurnal; ?>">
                                                                    <input type="text" name="unit" class="form-control" id="unit" value="<?= ambil_namaunit($idUnit); ?>" disabled>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="float-left">
                                                                <?php
                                                                if ($status == 0) {
                                                                    $txt_simpan = "Simpan Transaksi";
                                                                } else {
                                                                    $txt_simpan = "Ubah Transaksi";
                                                                }
                                                                ?>
                                                                <h4 class="card-title">
                                                                    <a href="#" class="text-reset" id="btn-simpan-opm" data-aksi="tambah" data-status="" tabindex="6"><i class="fas fa-save" style="color: teal"></i> <?= $txt_simpan; ?></a>
                                                                </h4>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="float-right">
                                                                <h4 class="card-title" disabled="disabled">
                                                                    <a href="" class="text-reset" id="btn-tambah-rincianopm" data-status="" tabindex="7">Tambah Rincian <i class="fas fa-file-alt" style="color: teal"></i></a>
                                                                </h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <table id="tabel3" class="table table-bordered table-striped table-sm">
                                                                <thead>
                                                                    <tr>
                                                                        <td width="5%" class="text-center">No</td>
                                                                        <td width="47%" class="text-center">Kode Perkiraan</td>
                                                                        <td width="12%" class="text-center">Debet</td>
                                                                        <td width="12%" class="text-center">Kredit</td>
                                                                        <td width="10%" class="text-center">Anggaran</td>
                                                                        <td width="10%" class="text-center" style="color: grey"><i class="fas fa-cog"></i></td>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    $no = 1;

                                                                    if ($detail) {
                                                                        foreach ($detail as $dataDetail) :
                                                                            $idDetail = $dataDetail['id'];
                                                                            $posisi = $dataDetail['posisi_akun'];
                                                                    ?>

                                                                            <tr>
                                                                                <td class="text-center"><?= $no; ?></td>
                                                                                <td <?php padding_akun($posisi); ?>><?= $dataDetail['a6level_id']; ?> - <?= $dataDetail['level6'] ?> </td>
                                                                                <td class="text-right"><?= rupiah($dataDetail['debet']); ?></td>
                                                                                <td class="text-right"><?= rupiah($dataDetail['kredit']); ?></td>
                                                                                <td class="text-center"><?= $dataDetail['is_anggaran']; ?></td>
                                                                                <td class="text-center">
                                                                                    <a href="" class="btn-edit-rincianopm" data-id="<?= $idDetail; ?>" data-toggle="tooltip" data-placement="bottom" title="Edit"><i class="fas fa-edit" style="color: olive"></i></a> - <a href="" class="btn-hapus-rincianopm" data-id="<?= $idDetail; ?>" data-id6="<?= $dataDetail['a6level_id']; ?>" data-info="<?= $dataDetail['level6']; ?>" data-toggle="tooltip" data-placement="bottom" title="Hapus"> <i class="far fa-trash-alt" style="color: maroon"></i></a>
                                                                                </td>

                                                                            </tr>
                                                                        <?php
                                                                            $no++;
                                                                        endforeach;
                                                                        ?>
                                                                        <tr>
                                                                            <td></td>
                                                                            <td class="text-left">Total Transaksi</td>
                                                                            <td class="text-right"><?= rupiah($totaldebet); ?></td>
                                                                            <td class="text-right"><?= rupiah($totalkredit); ?></td>
                                                                            <td colspan="2" class="text-center"></td>
                                                                        </tr>
                                                                    <?php
                                                                    } else {
                                                                    ?>
                                                                        <tr>
                                                                            <td colspan="6" class="text-center">Data tidak ditemukan</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td></td>
                                                                            <td class="text-left">Total Transaksi</td>
                                                                            <td class="text-right"><?= rupiah($totaldebet); ?></td>
                                                                            <td class="text-right"><?= rupiah($totalkredit); ?></td>
                                                                            <td colspan="2" class="text-center"></td>
                                                                        </tr>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                    <?php
                                                                    if ($idTransaksi) {
                                                                    ?>
                                                                        <tr>
                                                                            <td colspan="6" class="text-center"><a href="" class="text-reset" id="btn-batal-opmtransaksi" data-id="<?= $idTransaksi; ?>" data-notran="<?= $rnotran; ?>" data-info="<?= $nama; ?>" tabindex="8">Hapus Transaksi <i class="fas fa-window-close" style="color: maroon"></i></a></td>
                                                                        </tr>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                                                    <!-- Status Pembayaran -->
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <table id="tabel3" class="table table-bordered table-striped table-sm">
                                                                <thead>
                                                                    <tr>
                                                                        <td width="4%" class="text-center">No</td>
                                                                        <td width="8%" class="text-center">Kode</td>
                                                                        <td width="46%" class="text-center">Nama Kewajiban</td>
                                                                        <td width="14%" class="text-center">Jumlah</td>
                                                                        <td width="14%" class="text-center">Terbayar</td>
                                                                        <td width="14%" class="text-center">Kekurangan</td>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    $no = 1;
                                                                    $statusbayar = $this->Opm_model->statuspembayaran($idMahasiswa);
                                                                    if ($statusbayar) {
                                                                        $debet = 0.00;
                                                                        $kredit = 0.00;
                                                                        $jmlkewajiban = 0.00;
                                                                        $totalkewajiban = 0.00;
                                                                        $jmlbayar = 0.00;
                                                                        $totalbayar = 0.00;
                                                                        $sisa = 0.00;
                                                                        $totalsisa = 0.00;
                                                                        foreach ($statusbayar as $dataStatusbayar) :
                                                                            $posisi = $dataStatusbayar['posisi'];
                                                                            $debet = $dataStatusbayar['debet'];
                                                                            $kredit = $dataStatusbayar['kredit'];
                                                                            $jmlkewajiban = $dataStatusbayar['jumlah_kewajiban'];
                                                                            $totalkewajiban = $totalkewajiban + $jmlkewajiban;
                                                                            $jmlbayar = $kredit - $debet;
                                                                            $totalbayar = $totalbayar + $jmlbayar;
                                                                            $sisa = $jmlkewajiban - $jmlbayar;
                                                                            $totalsisa = $totalsisa + $sisa;
                                                                            // $idDetail = $dataDetail['id'];
                                                                            // $posisi = $dataDetail['posisi_akun'];
                                                                    ?>

                                                                            <tr>
                                                                                <td class="text-center"><?= $no; ?></td>
                                                                                <td class="text-center"><?= $dataStatusbayar['kode']; ?></td>
                                                                                <td class="text-left"><?= $dataStatusbayar['nama_kewajiban']; ?></td>
                                                                                <td class="text-right"><?= rupiah_positif($jmlkewajiban); ?></td>
                                                                                <td class="text-right"><?= rupiah_positif($jmlbayar); ?></td>
                                                                                <td class="text-right"><?= rupiah_positif($sisa); ?>
                                                                                </td>
                                                                            </tr>
                                                                        <?php
                                                                            $no++;
                                                                        endforeach;
                                                                        ?>
                                                                        <tr>
                                                                            <td></td>
                                                                            <td class="text-left" colspan="2">Total</td>
                                                                            <td class="text-right"><?= rupiah_positif($totalkewajiban); ?></td>
                                                                            <td class="text-right"><?= rupiah_positif($totalbayar); ?></td>
                                                                            <td class="text-right"><?= rupiah_positif($totalsisa); ?></td>
                                                                        </tr>
                                                                    <?php
                                                                    } else {
                                                                    ?>
                                                                        <tr>
                                                                            <td colspan="6" class="text-center">Data tidak ditemukan</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td></td>
                                                                            <td class="text-left"></td>
                                                                            <td class="text-right"></td>
                                                                            <td class="text-right"></td>
                                                                            <td colspan="2" class="text-center"></td>
                                                                        </tr>
                                                                    <?php
                                                                    }
                                                                    ?>

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="custom-tabs-one-messages" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
                                                    tab messege
                                                </div>
                                                <div class="tab-pane fade" id="custom-tabs-one-settings" role="tabpanel" aria-labelledby="custom-tabs-one-settings-tab">
                                                    <!-- Riwayat Transaksi -->
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <table id="tabel3" class="table table-bordered table-striped table-sm">
                                                                <thead>
                                                                    <tr>
                                                                        <td width="4%" class="text-center">No</td>
                                                                        <td width="15%" class="text-center">Tanggal Transaksi</td>
                                                                        <td width="10%" class="text-center">No Bukti</td>
                                                                        <td width="10%" class="text-center">No Transaksi</td>
                                                                        <td width="40%" class="text-center">Keterangan</td>
                                                                        <td width="16%" class="text-center">Jumlah</td>
                                                                        <td width="5%" class="text-center" style="color: grey"><i class="fas fa-cog"></i></td>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    $no = 1;
                                                                    $riwayatbayar = $this->Opm_model->riwayatpembayaran($idMahasiswa);
                                                                    if ($riwayatbayar) {
                                                                        // $debet = 0.00;
                                                                        // $kredit = 0.00;
                                                                        // $jmlkewajiban = 0.00;
                                                                        // $totalkewajiban = 0.00;
                                                                        // $jmlbayar = 0.00;
                                                                        // $totalbayar = 0.00;
                                                                        // $sisa = 0.00;
                                                                        // $totalsisa = 0.00;
                                                                        foreach ($riwayatbayar as $dataRiwayatbayar) :
                                                                            // $posisi = $dataStatusbayar['posisi'];
                                                                            // $debet = $dataStatusbayar['debet'];
                                                                            // $kredit = $dataStatusbayar['kredit'];
                                                                            // $jmlkewajiban = $dataStatusbayar['jumlah_kewajiban'];
                                                                            // $totalkewajiban = $totalkewajiban + $jmlkewajiban;
                                                                            // $jmlbayar = $kredit - $debet;
                                                                            // $totalbayar = $totalbayar + $jmlbayar;
                                                                            // $sisa = $jmlkewajiban - $jmlbayar;
                                                                            // $totalsisa = $totalsisa + $sisa;
                                                                            // $idDetail = $dataDetail['id'];
                                                                            // $posisi = $dataDetail['posisi_akun'];
                                                                    ?>

                                                                            <tr>
                                                                                <td class="text-center"><?= $no; ?></td>
                                                                                <td class="text-center"><?= $dataRiwayatbayar['tanggal_transaksi']; ?></td>
                                                                                <td class="text-center"><?= $dataRiwayatbayar['nobukti']; ?></td>
                                                                                <td class="text-center"><?= $dataRiwayatbayar['notran']; ?></td>
                                                                                <td class="text-left"><?= $dataRiwayatbayar['keterangan']; ?></td>
                                                                                <td class="text-right"><?= rupiah_positif($dataRiwayatbayar['total_transaksi']); ?></td>
                                                                                <td class="text-right"></td>
                                                                            </tr>
                                                                        <?php
                                                                            $no++;
                                                                        endforeach;
                                                                        ?>
                                                                        <tr>
                                                                            <td></td>
                                                                            <td class="text-left" colspan="4">Total</td>
                                                                            <td class="text-right"></td>
                                                                            <!-- <td class="text-right"></td>
                                                                            <td class="text-right"></td> -->
                                                                            <td class="text-right"></td>
                                                                        </tr>
                                                                    <?php
                                                                    } else {
                                                                    ?>
                                                                        <tr>
                                                                            <td colspan="7" class="text-center">Data tidak ditemukan</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td></td>
                                                                            <td class="text-left"></td>
                                                                            <td class="text-right"></td>
                                                                            <td class="text-right"></td>
                                                                            <td colspan="4" class="text-center"></td>
                                                                        </tr>
                                                                    <?php
                                                                    }
                                                                    ?>

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.card -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card-->
                </div>
                <!-- /.col col-lg-12-->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
        <?php $this->load->view('akademik/opm/modal');
        ?>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper