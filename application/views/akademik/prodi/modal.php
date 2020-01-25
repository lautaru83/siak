<div class="modal fade" id="modal-prodi" tabindex="-1">
    <div class="vertical-alignment-helper">
        <div class="modal-dialog modal-dialog-default">
            <div class="modal-content card">
                <div class="modal-header card-header bg-gradient-light">
                    <h5 class="modal-title card-title" id="judul-modal">Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-prodi" class="form-horizontal">
                    <div class="modal-body card-body">
                        <div class="form-group">
                            <label for="id" class="control-label">Kode</label>
                            <div>
                                <input type="hidden" id="idubah" name="idubah">
                                <input type="text" name="id" class="form-control" id="id" autocomplete="off" placeholder="Kode Prodi">
                                <span id="kode_error" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="prodi" class="control-label">
                                Program Pendidikan
                            </label>
                            <div>
                                <input type="text" name="prodi" class="form-control" id="prodi" autocomplete="off" placeholder="Nama prodi">
                                <span id="prodi_error" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="jenjang_id" class="control-label">Jenjang</label>
                            <div>
                                <select id="jenjang_id" name="jenjang_id" class="form-control">
                                    <option value="">- Pilih -</option>
                                    <?php
                                    foreach ($jenjang as $dataJenjang) :
                                    ?>
                                        <option value="<?= $dataJenjang['id']; ?>"><?= $dataJenjang['jenjang']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <span id="jenjang_error" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="jurusan_id" class="control-label">Jurusan</label>
                            <div>
                                <select id="jurusan_id" name="jurusan_id" class="form-control">
                                    <option value="">- Pilih -</option>
                                    <?php
                                    foreach ($jurusan as $dataJurusan) :
                                    ?>
                                        <option value="<?= $dataJurusan['id']; ?>"><?= $dataJurusan['jurusan']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <span id="jurusan_error" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="jalur_id" class="control-label">Jalur</label>
                            <div>
                                <select id="jalur_id" name="jalur_id" class="form-control">
                                    <option value="">- Pilih -</option>
                                    <?php
                                    foreach ($jalur as $dataJalur) :
                                    ?>
                                        <option value="<?= $dataJalur['id']; ?>"><?= $dataJalur['jalur']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <span id="jalur_error" class="text-danger"></span>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer card-footer">
                        <div>
                            <button id="btn-ubah-prodi" type="submit" class="btn btn-primary"><i class="far fa-edit"></i> Ubah</button>
                        </div>
                        <div>
                            <button id="btn-simpan-prodi" type="submit" class="btn btn-success"><i class="far fa-check-square"></i> Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>