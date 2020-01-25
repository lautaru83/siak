<div class="modal fade" id="modal-jurusan" tabindex="-1">
    <div class="vertical-alignment-helper">
        <div class="modal-dialog modal-dialog-default">
            <div class="modal-content card">
                <div class="modal-header card-header bg-gradient-light">
                    <h5 class="modal-title card-title" id="judul-modal">Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-jurusan" class="form-horizontal">
                    <div class="modal-body card-body">
                        <div class="form-group">
                            <label for="id" class="control-label">Kode</label>
                            <div>
                                <input type="hidden" id="idubah" name="idubah">
                                <input type="text" name="id" class="form-control" id="id" autocomplete="off" placeholder="Kode Jurusan">
                                <span id="kode_error" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="jurusan" class="control-label">
                                Jurusan
                            </label>
                            <div>
                                <input type="text" name="jurusan" class="form-control" id="jurusan" autocomplete="off" placeholder="Nama Jurusan">
                                <span id="jurusan_error" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="unit_id" class="control-label">Unit Usaha</label>
                            <div>
                                <select id="unit_id" name="unit_id" class="form-control">
                                    <option value="">- Pilih -</option>
                                    <?php
                                    foreach ($unit as $dataUnit) :
                                    ?>
                                        <option value="<?= $dataUnit['id']; ?>"><?= $dataUnit['unit']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <span id="unit_error" class="text-danger"></span>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer card-footer">
                        <div>
                            <button id="btn-ubah-jurusan" type="submit" class="btn btn-primary"><i class="far fa-edit"></i> Ubah</button>
                        </div>
                        <div>
                            <button id="btn-simpan-jurusan" type="submit" class="btn btn-success"><i class="far fa-check-square"></i> Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>