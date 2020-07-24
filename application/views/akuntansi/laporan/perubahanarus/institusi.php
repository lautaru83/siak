<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-gradient-light">
                <div>
                    <h4 class="card-title">
                        Perubahan Arus Kas Institusi
                    </h4>
                </div>
                <div class="float-right">
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div style="height: 25px;">
                    </div>
                </div>
                <?php
                //var_dump($pbll);
                //echo saldoAkun6($tanggal);
                ?>
                <?php
                if ($arus) {
                ?>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <span class="text-uppercase font-weight-bolder"><?php if ($institusi) {
                                                                                echo $institusi['keterangan'];
                                                                            } ?></span>
                        </div>
                        <div class="col-md-12 text-center">
                            <span class="font-weight-bolder">LAPORAN PERUBAHAN ARUS KAS</span>
                        </div>
                    </div>
                    <table id="tabel3" class="table table-sm table-borderless table-hover">
                        <thead>
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-center" colspan="4">
                                    Untuk Tahun Yang Berakhir <?= format_indo($this->session->userdata('buku_akhir')); ?><br>
                                    (Dinyatakan dalam Rupiah, kecuali dinyatakan lain)

                                </td>
                                <td class="text-center"></td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-center border-bottom" colspan="4"></td>
                                <td class="text-center"></td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-center border-top" colspan="4"></td>
                                <td class="text-center"></td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-center" colspan="3"></td>
                                <td width="15%" class="text-center">
                                    <span class="font-weight-normal my-auto">
                                        1 Januari S/d<br>
                                        <?= format_indo($tanggal); ?><div class="border-top my-1"></div>
                                        <div class="my-1">(Rp)</div>
                                    </span>
                                </td>
                                <td class="text-center"></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center"></td>
                                <td colspan="4">
                                    <span class="font-weight-normal text-md">ARUS KAS AKTIVITAS OPERASIONAL</span>
                                </td>
                                <td class="text-right"></td>
                            </tr>
                            <?php
                            $jumlahKenaikanAB = 0;
                            $jumlahAbtt = asetbersihTb($awalbuku, $tanggal, $pembukuan_id);
                            $jumlahKenaikanAB = $jumlahKenaikanAB + $jumlahAbtt;
                            ?>
                            <tr>
                                <td class="text-center"></td>
                                <td colspan="3">
                                    <span class="font-weight-normal text-md">kenaikan (Penurunan) Aset Bersih</span>
                                </td>
                                <td class="text-right">
                                    <?= rupiah_positif($jumlahKenaikanAB); ?>
                                </td>
                                <td class="text-right"></td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="row my-0"></div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td colspan="3">
                                    <span class="font-weight-normal text-md pl-4">Laba (Rugi) Bersih Sebelum Modal Kerja</span>
                                </td>
                                <?php
                                $jumlahSebelumModal = 0;
                                $jumlahSebelumModal = $jumlahSebelumModal + $jumlahKenaikanAB;
                                ?>
                                <td class="text-right border-top border-bottom"><?= rupiah_positif($jumlahSebelumModal); ?></td>
                                <td class="text-right"></td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="row my-1"></div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td colspan="4">
                                    <span class="font-weight-normal text-md">ARUS KAS DARI AKTIVITAS OPERASIONAL</span>
                                </td>
                                <td class="text-right"></td>
                            </tr>
                            <?php
                            $totalKasOp = 0;
                            if ($kasOp) {
                                foreach ($kasOp as $dataKasOp) :
                                    $posisi = $dataKasOp['posisi'];
                                    $debet = $dataKasOp['debet'];
                                    $kredit = $dataKasOp['kredit'];
                                    if ($posisi = "D") {
                                        $jumlahKasOp = $kredit - $debet;
                                    } else {
                                        $jumlahKasOp = $debet - $kredit;
                                    }
                                    $totalKasOp = $totalKasOp + $jumlahKasOp;
                            ?>
                                    <tr>
                                        <td class="text-center"></td>
                                        <td colspan="3">
                                            <span class="font-weight-normal text-md pl-4"><?= $dataKasOp['level3']; ?></span>
                                        </td>
                                        <td class="text-right"><?= rupiah_positif($jumlahKasOp); ?></td>
                                        <td class="text-right"></td>
                                    </tr>
                            <?php
                                endforeach;
                            }
                            ?>
                            <tr>
                                <td>
                                    <div class="row my-0"></div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td colspan="3">
                                    <span class="font-weight-normal text-md pl-4">Jumlah</span>
                                <td class="text-right border-top border-bottom"><?= rupiah_positif($totalKasOp); ?></td>
                                <td class="text-right"></td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="row my-1"></div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td colspan="4">
                                    <span class="font-weight-normal text-md">ARUS KAS DARI AKTIVITAS INVESTASI</span>
                                </td>
                                <td class="text-right"></td>
                            </tr>
                            <?php
                            $totalKasInves = 0;
                            if ($kasInves) {
                                foreach ($kasInves as $dataKasInves) :
                                    $posisi = $dataKasInves['posisi'];
                                    $debet = $dataKasInves['debet'];
                                    $kredit = $dataKasInves['kredit'];
                                    $jumlahKasInves = $kredit - $debet;
                                    $totalKasInves = $totalKasInves + $jumlahKasInves;
                            ?>
                                    <tr>
                                        <td class="text-center"></td>
                                        <td colspan="3">
                                            <span class="font-weight-normal text-md pl-4"><?= $dataKasInves['level3'] ?></span>
                                        </td>
                                        <td class="text-right"><?= rupiah_positif($jumlahKasInves); ?></td>
                                        <td class="text-right"></td>
                                    </tr>
                            <?php
                                endforeach;
                            }
                            ?>
                            <tr>
                                <td>
                                    <div class="row my-0"></div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td colspan="3">
                                    <span class="font-weight-normal text-md pl-4">Jumlah</span>
                                <td class="text-right border-top border-bottom"><?= rupiah_positif($totalKasInves); ?></td>
                                <td class="text-right"></td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="row my-1"></div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td colspan="3">
                                    <span class="font-weight-bolder text-md ">KENAIKAN/(PENURUNAN) KAS BERSIH </span>
                                </td>
                                <?php
                                $jumlahKenaikanKas = 0;
                                $jumlahKenaikanKas = $jumlahSebelumModal + $totalKasOp + $totalKasInves;
                                ?>
                                <td class="text-right border-top border-bottom">
                                    <span class="font-weight-bolder text-md">
                                        <?= rupiah_positif($jumlahKenaikanKas); ?>
                                    </span>
                                </td>
                                <td class="text-right"></td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="row my-1"></div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td colspan="3">
                                    <span class="font-weight-bolder text-md">KAS AWAL PERIODE</span>
                                </td>
                                <?php
                                $kasAwalPeriode = 0;
                                $akun = '111';
                                $kasAwalPeriode = saldoAwalKasInstitusi($akun, $pembukuan_id);
                                ?>
                                <td class="text-right border-top border-bottom">
                                    <span class="font-weight-bolder text-md">
                                        <?= rupiah_positif($kasAwalPeriode); ?>
                                    </span>
                                </td>
                                <td class="text-right"></td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="row my-1"></div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center"></td>
                                <td colspan="3">
                                    <span class="font-weight-bolder text-md">KAS AKHIR PERIODE</span>
                                </td>
                                <?php
                                //$saldoKasAkhir = 0;
                                $kasAkhirPeriode = $kasAwalPeriode + $jumlahKenaikanKas;
                                ?>
                                <td class="text-right border-top border-bottom">
                                    <span class="font-weight-bolder text-md"><?= rupiah_positif($kasAkhirPeriode); ?></span></td>
                                <td class="text-right"></td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="row my-1"></div>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                <?php } ?>
                <div class="row invisible">
                    <div class="col-sm-12 text-center">
                        <form method="POST" action="<?= base_url('akuntansi/perubahanarus/cetakdata'); ?>" target="_blank">
                            <input type="hidden" id="laporan" name="laporan" value="<?= $jenislap; ?>">
                            <input type="hidden" id="bukuawal" name="bukuawal" value="<?= $awalbuku; ?>">
                            <input type="hidden" id="bukuakhir" name="bukuakhir" value="<?= $akhirbuku; ?>">
                            <input type="hidden" id="tgl1" name="tgl1" value="<?= $awalbuku; ?>">
                            <input type="hidden" id="tgl2" name="tgl2" value="<?= $tanggal; ?>">
                            <input type="hidden" id="pembukuan_id" name="pembukuan_id" value="<?= $pembukuan_id; ?>">
                            <button type="submit" id="btn-cetak-perubahanarus" class="btn btn-link">Tampilkan</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->

        </div>
        <!-- /.card -->
    </div>
    <!-- /.col-md-12 -->
</div>
<!-- /.row -->