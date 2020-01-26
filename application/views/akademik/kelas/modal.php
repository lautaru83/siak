<div class="modal fade" id="modal-kelas" tabindex="-1">
    <div class="vertical-alignment-helper">
        <div class="modal-dialog modal-dialog-default">
            <div class="modal-content card">
                <div class="modal-header card-header bg-gradient-light">
                    <h5 class="modal-title card-title" id="judul-modal">Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-kelas" class="form-horizontal">
                    <div class="modal-body card-body">
                        <div class="form-group">
                            <label for="kelas" class="control-label">
                                Kelas
                            </label>
                            <div>
                                <input type="hidden" id="idubah" name="idubah">
                                <input type="text" name="kelas" class="form-control" id="kelas" autocomplete="off" placeholder="Kode kelas">
                                <span id="kelas_error" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="akademik_id" class="control-label">Tahun Ajaran</label>
                            <div>
                                <select id="akademik_id" name="akademik_id" class="form-control">
                                    <option value="">- Pilih -</option>
                                    <?php
                                    foreach ($akademik as $dataAkademik) :
                                    ?>
                                        <option value="<?= $dataAkademik['id']; ?>"><?= $dataAkademik['keterangan']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <span id="akademik_error" class="text-danger"></span>
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
                                        <option value="<?= $dataProdi['id']; ?>"><?= $dataProdi['prodi']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <span id="prodi_error" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tingkat_id" class="control-label">Tingkat</label>
                            <div>
                                <select id="tingkat_id" name="tingkat_id" class="form-control">
                                    <option value="">- Pilih -</option>
                                    <?php
                                    foreach ($tingkat as $dataTingkat) :
                                    ?>
                                        <option value="<?= $dataTingkat['id']; ?>"><?= $dataTingkat['tingkat']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <span id="tingkat_error" class="text-danger"></span>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer card-footer">
                        <div>
                            <button id="btn-ubah-kelas" type="submit" class="btn btn-primary"><i class="far fa-edit"></i> Ubah</button>
                        </div>
                        <div>
                            <button id="btn-simpan-kelas" type="submit" class="btn btn-success"><i class="far fa-check-square"></i> Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>