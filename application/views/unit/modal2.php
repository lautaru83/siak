<!-- modal-ubah -->
<div class="modal fade" id="modal-unit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Ubah Data unit</h4>
            </div>
            <form id="form-unit" class="form-horizontal">
                <div class="modal-body">

                    <div class="form-group">
                        <label for="idunit" class="col-sm-2 control-label">Kode</label>
                        <div class="col-sm-10">
                            <input type="text" name="id" class="form-control" id="id" placeholder="Kode" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="unit" class="col-sm-2 control-label">Unit</label>
                        <div class="col-sm-10">
                            <input type="hidden" id="idubah" name="idubah">
                            <input type="text" name="unit" class="form-control" id="unit" placeholder="Unit" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="institusi_id" class="col-sm-2 control-label">Institusi</label>
                        <div class="col-sm-10">
                            <select id="institusi_id" name="institusi_id" class="form-control" required>
                                <option value="">Pilih</option>
                                <?php
                                foreach ($institusi as $dataInstitusi) :
                                    ?>
                                    <option value="<?= $dataInstitusi['id']; ?>"><?= $dataInstitusi['institusi']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Ubah</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- endmodal-ubah -->