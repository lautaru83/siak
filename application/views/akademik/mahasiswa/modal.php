<div class="modal fade" id="modal-mahasiswa" tabindex="-1">
    <div class="vertical-alignment-helper">
        <div class="modal-dialog modal-dialog-default">
            <div class="modal-content card">
                <div class="modal-header card-header bg-gradient-light">
                    <h5 class="modal-title card-title" id="judul-modal">Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-mahasiswa" class="form-horizontal">
                    <div class="modal-body card-body">
                        <div class="form-group">
                            <label for="nim" class="control-label">
                                NIM
                            </label>
                            <div>
                                <input type="hidden" id="idubah" name="idubah">
                                <input type="hidden" id="kelas_id" name="kelas_id" value="<?= $kelas_id; ?>">
                                <input type="text" name="nim" class="form-control" id="nim" autocomplete="off" placeholder="NIM Mahasiswa">
                                <span id="nim_error" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nama" class="control-label">
                                Nama
                            </label>
                            <div>
                                <input type="text" name="nama" class="form-control" id="nama" autocomplete="off" placeholder="Nama Mahasiswa">
                                <span id="nama_error" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="is_active" class="control-label">Status</label>
                            <div>
                                <select id="is_active" name="is_active" class="form-control">
                                    <option value="">- Pilih -</option>
                                    <option value="1">Aktif</option>
                                    <option value="0">Non Aktif</option>
                                </select>
                                <span id="status_error" class="text-danger"></span>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer card-footer">
                        <div>
                            <button id="btn-ubah-mahasiswa" type="submit" class="btn btn-primary"><i class="far fa-edit"></i> Ubah</button>
                        </div>
                        <div>
                            <button id="btn-simpan-mahasiswa" type="submit" class="btn btn-success"><i class="far fa-check-square"></i> Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>