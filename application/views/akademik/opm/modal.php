<!-- OPM Reguler -->
<div class="modal fade" id="modal-opm" tabindex="-1">
    <div class="vertical-alignment-helper">
        <div class="modal-dialog modal-dialog-default">
            <div class="modal-content card">
                <div class="modal-header card-header bg-gradient-light">
                    <h5 class="modal-title card-title" id="judul-modal">Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-opm" class="form-horizontal">
                    <div class="modal-body card-body">
                        <?php
                        if ($mhs) {
                            $idKelas = $mhs['kelas_id'];
                        }
                        //echo " / " . $jenis;
                        ?>
                        <div class="form-group">
                            <label for="a6level_id" class="control-label">Kode Perkiran</label>
                            <div>
                                <input type="hidden" id="iddopm" name="iddopm">
                                <input type="hidden" id="akun_lama" name="akun_lama">
                                <input type="hidden" id="dbopid_lama" name="dbopid_lama">
                                <!-- <input type="hidden" id="jenis_opm" name="jenis_opm" > -->
                                <input type="hidden" id="jenis_opm" name="jenis_opm" value="<?= $jenis; ?>">
                                <input type="hidden" id="operasional_id" name="operasional_id" value="<?= $idTransaksi; ?>">
                                <!-- <input type="hidden" id="transaksi_id" name="transaksi_id" value=""> -->
                                <select id="akun_id" name="akun_id" class="form-control">
                                    <option value="">- Pilih -</option>
                                    <?php
                                    $akunbayar = $this->Opm_model->daftarakunopm($idKelas, $perak_id, $jenis);
                                    if ($akunbayar) {
                                        foreach ($akunbayar as $dataakun) :
                                    ?>
                                            <option value="<?= $dataakun['idpembayaran']; ?>/<?= $dataakun['a6level_id']; ?>"><?= $dataakun['a6level_id']; ?> - <?= $dataakun['level6']; ?></option>
                                    <?php
                                        endforeach;
                                    }
                                    ?>
                                </select>
                                <span id="akun_error" class="text-danger"></span>
                            </div>
                        </div>
                        <?php
                        // var_dump($akunbayar);
                        ?>
                        <div class="form-group">
                            <label for="posisi_akun" class="control-label">Posisi</label>
                            <div>
                                <select id="posisi_akun" name="posisi_akun" class="form-control">
                                    <option value="">- Pilih -</option>
                                    <option value="D">Debet</option>
                                    <option value="K">Kredit</option>

                                </select>
                                <span id="posisi_error" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="jumlah" class="control-label">
                                Jumlah Transaksi (Rp)
                            </label>
                            <div>
                                <input type="text" name="jumlah" class="form-control" id="jumlah" data-inputmask="'alias': 'decimal', 'groupSeparator': '.', 'autoGroup': true, 'digits': 2, 'digitsOptional': false,'allowMinus':false, 'placeholder': '0', 'radixPoint': ',', 'rightAlign': false">
                                <span id="jumlah_error" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="is_anggaran" value="" id="is_anggaran">
                                <label class="form-check-label" for="is_anggaran">
                                    Anggaran
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer card-footer">
                        <div>
                            <button id="btn-tes-detailopm" type="submit" class="btn btn-primary"><i class="far fa-edit"></i> Tes</button>
                        </div>
                        <div>
                            <button id="btn-ubah-detailopm" type="submit" class="btn btn-primary"><i class="far fa-edit"></i> Ubah</button>
                        </div>
                        <div>
                            <button id="btn-simpan-detailopm" type="submit" class="btn btn-success"><i class="far fa-check-square"></i> Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>
<!-- END OPM Reguler -->
<!-- OPM Ubah NIM -->
<div class="modal fade" id="modal-opm-ubahnim" tabindex="-1">
    <div class="vertical-alignment-helper">
        <div class="modal-dialog modal-dialog-default">
            <div class="modal-content card">
                <div class="modal-header card-header bg-gradient-light">
                    <h5 class="modal-title card-title" id="judul-modalubah">Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-opm" class="form-horizontal">
                    <div class="modal-body card-body">
                        <div class="form-group">
                            <label class="font-weight-normal my-2 mr-5">Nim :</label>
                            <input type="text" name="nim_opm" id="nim_opm" class="form-control form-control-md" autocomplete="off">
                        </div>
                    </div>
                    <div class="modal-footer card-footer">
                        <div>
                            <button id="btn-ubah-nimopm" type="submit" class="btn btn-primary"><i class="far fa-edit"></i> Ubah</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>
<!-- END OPM Ubah Nim -->