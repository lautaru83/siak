<div class="modal fade" id="modal-tahunanggaran" tabindex="-1">
    <div class="vertical-alignment-helper">
        <div class="modal-dialog modal-dialog-default">
            <div class="modal-content card">
                <div class="modal-header card-header bg-gradient-light">
                    <h5 class="modal-title card-title" id="judul-modal">Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-tahunanggaran" class="form-horizontal">
                    <div class="modal-body card-body">
                        <div class="form-group">
                            <label for="tahunanggaran" class="control-label">Tahun Anggaran</label>
                            <div>
                                <input type="hidden" id="idubah" name="idubah">
                                <input type="text" name="tahunanggaran" class="form-control" id="tahunanggaran" autocomplete="off" placeholder="Nama tahun anggaran">
                                <span id="tahunanggaran_error" class="text-danger"></span>
                            </div>
                        </div>
                        <!-- Date awal periode -->
                        <div class="form-group">
                            <label>Awal Periode</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="far fa-calendar-alt"></i>
                                    </span>
                                </div>
                                <input type="text" name="awal_periode" class="form-control float-right" id="awal_periode" placeholder="Tanggal awal periode anggaran">
                                <span id="awal_periode_error" class="text-danger"></span>
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->
                        <!-- /awal periode -->
                        <!-- Date akhir periode -->
                        <div class="form-group">
                            <label>Akhir Periode</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="far fa-calendar-alt"></i>
                                    </span>
                                </div>
                                <input type="text" name="akhir_periode" class="form-control float-right" id="akhir_periode" placeholder="Tanggal akhir periode anggaran">
                                <span id="akhir_periode_error" class="text-danger"></span>
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->
                        <!-- /akhir periode -->
                        <div class="form-group">
                            <label for="keterangan" class="control-label">
                                Keterangan
                            </label>
                            <div>
                                <input type="text" name="keterangan" class="form-control" id="keterangan" autocomplete="off" placeholder="Keterangan">
                                <span id="keterangan_error" class="text-danger"></span>
                            </div>
                        </div>
                        <!-- <div class="form-group">
                            <label for="is_active" class="control-label">Status</label>
                            <div>
                                <select id="is_active" name="is_active" class="form-control">
                                    <option value="">- Pilih -</option>
                                    <option value="0">Non Aktif</option>
                                    <option value="1">Aktif</option>

                                </select>
                                <span id="status_error" class="text-danger"></span>
                            </div>
                        </div> -->
                    </div>
                    <div class="modal-footer card-footer">
                        <div>
                            <button id="btn-ubah-tahunanggaran" type="submit" class="btn btn-primary"><i class="far fa-edit"></i> Ubah</button>
                        </div>
                        <div>
                            <button id="btn-simpan-tahunanggaran" type="submit" class="btn btn-success"><i class="far fa-check-square"></i> Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>