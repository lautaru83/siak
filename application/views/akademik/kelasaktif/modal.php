<div class="modal fade" id="modal-kelasaktif" tabindex="-1">
    <div class="vertical-alignment-helper">
        <div class="modal-dialog modal-dialog-default">
            <div class="modal-content card">
                <div class="modal-header card-header bg-gradient-light">
                    <h5 class="modal-title card-title" id="judul-modal">Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-kelasaktif" class="form-horizontal">
                    <div class="modal-body card-body">
                        <div class="form-group">
                            <label for="id" class="control-label">
                                Kode Kelas
                            </label>
                            <div>
                                <input type="hidden" id="idubah" name="idubah">
                                <input type="text" name="id" class="form-control" id="id" autocomplete="off" placeholder="Kode kelas">
                                <span id="kode_error" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="prodi_id" class="control-label">Program Pendidikan</label>
                            <div>
                                <select id="prodi_id" name="prodi_id" class="form-control">
                                    <option value="">- Pilih -</option>
                                    <?php
                                    foreach ($prodi as $dataProdi) :
                                    ?>
                                        <option value="<?= $dataProdi['id']; ?>"><?= $dataProdi['id']; ?> - <?= $dataProdi['prodi']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <span id="prodi_error" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="angkatan_id" class="control-label">Angkatan</label>
                            <div>
                                <select id="angkatan_id" name="angkatan_id" class="form-control">
                                    <option value="">- Pilih -</option>
                                    <?php
                                    foreach ($angkatan as $dataAngkatan) :
                                    ?>
                                        <option value="<?= $dataAngkatan['id']; ?>"><?= $dataAngkatan['angkatan']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <span id="angkatan_error" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="keterangan" class="control-label">
                                Keterangan
                            </label>
                            <div>
                                <input type="text" name="keterangan" class="form-control" id="keterangan" autocomplete="off" placeholder="Keterangan">
                                <span id="keterangan_error" class="text-danger"></span>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer card-footer">
                        <div>
                            <button id="btn-ubah-kelasaktif" type="submit" class="btn btn-primary"><i class="far fa-edit"></i> Ubah</button>
                        </div>
                        <div>
                            <button id="btn-simpan-kelasaktif" type="submit" class="btn btn-success"><i class="far fa-check-square"></i> Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>