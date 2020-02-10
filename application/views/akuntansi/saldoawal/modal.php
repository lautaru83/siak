<div class="modal fade" id="modal-saldoawal" tabindex="-1">
    <div class="vertical-alignment-helper">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content card">
                <div class="modal-header card-header bg-gradient-light">
                    <h5 class="modal-title card-title" id="judul-modal">Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-saldoawal" class="form-horizontal">
                    <div class="modal-body card-body">
                        <div class="form-group">
                            <label class="control-label">Nama Akun</label>
                            <div>
                                <input type="hidden" id="idubah" name="idubah">
                                <input type="hidden" id="tahun_pembukuan_id" name="tahun_pembukuan_id">
                                <input type="hidden" id="a6level_id" name="a6level_id">
                                <input type="text" name="level6" class="form-control" id="level6" disabled="disabled">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="posisi_saldo" class="control-label">Posisi</label>
                            <div>
                                <select id="posisi_saldo" name="posisi_saldo" class="form-control">
                                    <option value="">- Pilih -</option>
                                    <option value="D">Debet</option>
                                    <option value="K">Kredit</option>
                                </select>
                                <span id="posisi_error" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="saldoawal" class="control-label">
                                Saldo Awal
                            </label>
                            <div>
                                <!-- <input type="text" name="saldoawal" class="form-control matauang" id="saldoawal" autocomplete="off" placeholder="Saldoawal"> -->
                                <input type="text" name="saldoawal" class="form-control" id="saldoawal" data-inputmask="'alias': 'decimal', 'groupSeparator': '.', 'autoGroup': true, 'digits': 2, 'digitsOptional': false,'allowMinus':false, 'placeholder': '0', 'radixPoint': ',', 'rightAlign': false">
                                <span id="saldoawal_error" class="text-danger"></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer card-footer">
                        <div>
                            <button id="btn-ubah-saldoawal" type="submit" class="btn btn-primary"><i class="far fa-edit"></i> Ubah</button>
                        </div>
                        <div>
                            <button id="btn-simpan-saldoawal" type="submit" class="btn btn-success"><i class="far fa-check-square"></i> Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>