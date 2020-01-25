<div class="modal fade" id="modal-semester" tabindex="-1">
    <div class="vertical-alignment-helper">
        <div class="modal-dialog modal-dialog-default">
            <div class="modal-content card">
                <div class="modal-header card-header bg-gradient-light">
                    <h5 class="modal-title card-title" id="judul-modal">Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-semester" class="form-horizontal">
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
                            <label for="semester" class="control-label">
                                Semester Pendidikan
                            </label>
                            <div>
                                <input type="hidden" id="idubah" name="idubah">
                                <input type="text" name="semester" class="form-control" id="semester" autocomplete="off" placeholder="Nama Semester">
                                <span id="semester_error" class="text-danger"></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer card-footer">
                        <div>
                            <button id="btn-ubah-semester" type="submit" class="btn btn-primary"><i class="far fa-edit"></i> Ubah</button>
                        </div>
                        <div>
                            <button id="btn-simpan-semester" type="submit" class="btn btn-success"><i class="far fa-check-square"></i> Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>