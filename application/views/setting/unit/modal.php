<div class="modal fade" id="modal-unit" tabindex="-1">
    <div class="vertical-alignment-helper">
        <div class="modal-dialog modal-dialog-default">
            <div class="modal-content card">
                <div class="modal-header card-header bg-gradient-light">
                    <h5 class="modal-title card-title" id="judul-modal">Form Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-unit" class="form-horizontal">
                    <div class="modal-body card-body">
                        <div class="form-group">
                            <label for="id" class="control-label">Kode</label>
                            <div>
                                <input type="text" name="id" class="form-control" id="id" autocomplete="off" placeholder="Kode Unit">
                                <span id="kode_error" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nama" class="control-label">Unit</label>
                            <div>
                                <input type="hidden" id="idubah" name="idubah">
                                <input type="text" name="unit" class="form-control" id="unit" autocomplete="off" placeholder="Nama Unit">
                                <span id="unit_error" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="institusi_id" class="control-label">Institusi</label>
                            <div>
                                <select id="institusi_id" name="institusi_id" class="form-control">
                                    <option value="">- Pilih -</option>
                                    <?php
                                    foreach ($institusi as $dataInstitusi) :
                                        ?>
                                        <option value="<?= $dataInstitusi['id']; ?>"><?= $dataInstitusi['institusi']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <span id="institusi_error" class="text-danger"></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer card-footer">
                        <div>
                            <button id="btn-ubah-unit" type="submit" class="btn btn-primary"><i class="far fa-edit"></i> Ubah</button>
                        </div>
                        <div>
                            <button id="btn-simpan-unit" type="submit" class="btn btn-success"><i class="far fa-check-square"></i> Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>