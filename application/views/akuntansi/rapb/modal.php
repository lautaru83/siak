<div class="modal fade" id="modal-rapb">
    <div class="vertical-alignment-helper">
        <div class="modal-dialog modal-lg modal-dialog-default">
            <!-- <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-default"> -->
            <div class="modal-content card">
                <div class="modal-header card-header bg-gradient-light">
                    <h5 class="modal-title card-title" id="judul-modal">Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-rapb" class="form-horizontal">
                    <div class="modal-body card-body">
                        <!-- isi formnya -->
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tahunanggaran" class="control-label">Nama Kegiatan</label>
                                        <div>
                                            <input type="hidden" id="idubah" name="idubah">
                                            <input type="hidden" id="idanggaran" name="idanggaran">
                                            <input type="hidden" id="tahunanggaran_id" name="tahunanggaran_id">
                                            <input type="text" name="rencana" class="form-control" id="rencana" autocomplete="off" placeholder="Nama Kegiatan" tabindex="1">
                                            <span id="rencana_error" class="text-danger"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="resaldo" class="control-label">
                                            Besar Anggaran
                                        </label>
                                        <div>
                                            <input type="text" name="resaldo" class="form-control" id="resaldo" data-inputmask="'alias': 'decimal', 'groupSeparator': '.', 'autoGroup': true, 'digits': 2, 'digitsOptional': false,'allowMinus':false, 'placeholder': '0', 'radixPoint': ',', 'rightAlign': false" tabindex="4">
                                            <span id="resaldo_error" class="text-danger"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="id" class="control-label">Jenis Anggaran</label>
                                        <div>
                                            <select id="rapb-kelompok-id" name="kelompok_id" class="form-control" tabindex="2">
                                                <option value="">- Pilih -</option>
                                                <?php
                                                if ($kelompok) {
                                                    foreach ($kelompok as $dataKelompok) :
                                                ?>
                                                        <option value="<?= $dataKelompok['id']; ?>"> <?= $dataKelompok['kelompok'] ?></option>
                                                <?php
                                                    endforeach;
                                                }
                                                ?>
                                            </select>
                                            <span id="kelompok_error" class="text-danger"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tereasisasi" class="control-label">
                                            Anggaran Terealisasi
                                        </label>
                                        <div>
                                            <input type="text" name="terealisasi" class="form-control" id="terealisasi" data-inputmask="'alias': 'decimal', 'groupSeparator': '.', 'autoGroup': true, 'digits': 2, 'digitsOptional': false,'allowMinus':false, 'placeholder': '0', 'radixPoint': ',', 'rightAlign': false" tabindex="5">
                                            <!-- <span id="terealisasi_error" class="text-danger"></span> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="id" class="control-label">Jenis Kegiatan</label>
                                        <div>
                                            <select id="rapb-anggaran-id" name="anggaran_id" class="form-control" tabindex="3">
                                                <option value="">- Pilih Kegiatan -</option>
                                            </select>
                                            <span id="anggaran_error" class="text-danger"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="noref" class="control-label">
                                            No. Referensi
                                        </label>
                                        <div>
                                            <input type="text" name="noref" class="form-control" id="noref" autocomplete="off" placeholder="Kosongkan jika tidak diisi" tabindex="6">
                                            <!-- <span id="jenis_transaksi_error" class="text-danger"></span> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer card-footer">
                        <div>
                            <button id="btn-ubah-rapb" type="submit" class="btn btn-primary"><i class="far fa-edit" tabindex="8"></i> Ubah</button>
                        </div>
                        <div>
                            <button id="btn-simpan-rapb" type="submit" class="btn btn-success"><i class="far fa-check-square" tabindex="7"></i> Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>