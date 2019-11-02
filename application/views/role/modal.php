<!-- modal- -->
<div class="modal fade" id="modal-role" tabindex="-1">
    <div class="vertical-alignment-helper">
        <div class="modal-dialog vertical-align-center">
            <div class="modal-content panel-default">
                <div class=" modal-header panel-heading">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="judul-modal">Tambah Data Role</h4>
                </div>
                <form id="form-role" class="form-horizontal">
                    <div class="modal-body panel-body">
                        <div class="form-group">
                            <label for="role" class="col-sm-2 control-label">Role</label>
                            <div class="col-sm-10">
                                <input type="hidden" id="idubah" name="idubah">
                                <input type="text" name="role" class="form-control" id="role" autocomplete="off" placeholder="Nama Role">
                                <span id="role_error" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="keterangan" class="col-sm-2 control-label">Keterangan</label>
                            <div class="col-sm-10">
                                <input type="text" name="keterangan" class="form-control" id="keterangan" autocomplete="off" placeholder="Keterangan">
                                <span id="keterangan_error" class="text-danger"></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer panel-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        <button id="btn-ubah-role" type="submit" class="btn btn-primary">Ubah</button>
                        <button id="btn-simpan-role" type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end modal-->