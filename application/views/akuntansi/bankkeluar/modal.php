<div class="modal fade" id="modal-bankkeluar" tabindex="-1">
    <div class="vertical-alignment-helper">
        <div class="modal-dialog modal-dialog-default">
            <div class="modal-content card">
                <div class="modal-header card-header bg-gradient-light">
                    <h5 class="modal-title card-title" id="judul-modal">Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-bankkeluar" class="form-horizontal">
                    <div class="modal-body card-body">
                        <div class="form-group">
                            <label for="a6level_id" class="control-label">Kode Perkiran</label>
                            <div>
                                <input type="hidden" id="idubah" name="idubah">
                                <input type="hidden" id="idakun" name="idakun">
                                <input type="hidden" id="idjt" name="idjt" value="<?= $jurnal ?>">
                                <input type="hidden" id="tgl2" name="tgl2" value="<?= $tanggal_transaksi; ?>">
                                <input type="hidden" id="transaksi_id" name="transaksi_id" value="<?= $tran_id; ?>">
                                <select id="a6level_id" name="a6level_id" class="form-control">
                                    <option value="">- Pilih -</option>
                                    <?php
                                    foreach ($akun as $dataAkun) :
                                    ?>
                                        <option value="<?= $dataAkun['id']; ?>"><span class="font-weight-normal text-md"><?= $dataAkun['id']; ?> - <?= $dataAkun['level6']; ?></span></option>
                                    <?php endforeach; ?>
                                </select>
                                <span id="akun_error" class="text-danger"></span>
                            </div>
                        </div>
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
                            <button id="btn-ubah-detailbankkeluar" type="submit" class="btn btn-primary"><i class="far fa-edit"></i> Ubah</button>
                        </div>
                        <div>
                            <button id="btn-simpan-detailbankkeluar" type="submit" class="btn btn-success"><i class="far fa-check-square"></i> Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>