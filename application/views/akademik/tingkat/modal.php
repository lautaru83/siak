<div class="modal fade" id="modal-tingkat" tabindex="-1">
    <div class="vertical-alignment-helper">
        <div class="modal-dialog modal-dialog-default">
            <div class="modal-content card">
                <div class="modal-header card-header bg-gradient-light">
                    <h5 class="modal-title card-title" id="judul-modal">Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-tingkat" class="form-horizontal">
                    <div class="modal-body card-body">
                        <!-- <div class="form-group">
                            <label for="id" class="control-label">Kode</label>
                            <div>
                                <input type="hidden" id="idubah" name="idubah">
                                <input type="text" name="id" class="form-control" id="id" autocomplete="off" placeholder="Kode Jenjang">
                                <span id="kode_error" class="text-danger"></span>
                            </div>
                        </div> -->
                        <div class="form-group">
                            <label for="tingkat" class="control-label">
                                Tingkat Pendidikan
                            </label>
                            <div>
                                <input type="hidden" id="idubah" name="idubah">
                                <input type="text" name="tingkat" class="form-control" id="tingkat" autocomplete="off" placeholder="Nama Tingkat">
                                <span id="tingkat_error" class="text-danger"></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer card-footer">
                        <div>
                            <button id="btn-ubah-tingkat" type="submit" class="btn btn-primary"><i class="far fa-edit"></i> Ubah</button>
                        </div>
                        <div>
                            <button id="btn-simpan-tingkat" type="submit" class="btn btn-success"><i class="far fa-check-square"></i> Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>