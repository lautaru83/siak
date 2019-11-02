<!-- modal-unit -->
<div class="modal fade" id="modal-unit" tabindex="-1">
    <div class="vertical-alignment-helper">
        <div class="modal-dialog vertical-align-center">
            <div class="modal-content panel-default">
                <div class="modal-header panel-heading">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="judul-modal">Tambah Data unit</h4>
                </div>
                <form id="form-unit" class="form-horizontal">
                    <div class="modal-body panel-body">
                        <div class="form-group">
                            <label for="id" class="col-sm-2 control-label">Kode</label>
                            <div class="col-sm-10">
                                <input type="text" name="id" class="form-control" id="id" placeholder="Kode Unit">
                                <span id="id_error" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="unit" class="col-sm-2 control-label">Unit</label>
                            <div class="col-sm-10">
                                <input type="hidden" id="idubah" name="idubah">
                                <input type="text" name="unit" class="form-control" id="unit" placeholder="Nama Unit">
                                <span id="unit_error" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="institusi_id" class="col-sm-2 control-label">Institusi</label>
                            <div class="col-sm-10">
                                <select id="institusi_id" name="institusi_id" class="form-control">
                                    <option value="">Pilih</option>
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
                    <div class="modal-footer panel-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        <button id="btn-ubah-unit" type="submit" class="btn btn-primary">Ubah</button>
                        <button id="btn-simpan-unit" type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- endmodal-unit -->