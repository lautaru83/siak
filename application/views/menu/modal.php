<!-- modal- -->
<div class="modal fade" id="modal-menu" tabindex="-1">
    <div class="vertical-alignment-helper">
        <div class="modal-dialog vertical-align-center">
            <div class="modal-content panel-default">
                <div class="modal-header panel-heading">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="judul-modal">Tambah Data menu</h4>
                </div>
                <form id="form-menu" class="form-horizontal">
                    <div class="modal-body panel-body">
                        <div class="form-group">
                            <label for="menu" class="col-sm-2 control-label">Menu</label>
                            <div class="col-sm-10">
                                <input type="hidden" id="idubah" name="idubah">
                                <input type="text" name="menu" class="form-control" id="menu" autocomplete="off" placeholder="Nama Menu">
                                <span id="menu_error" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="icon" class="col-sm-2 control-label">Icon</label>
                            <div class="col-sm-10">
                                <input type="text" name="icon" class="form-control" id="icon" autocomplete="off" placeholder="Icon">
                                <span id="icon_error" class="text-danger"></span>
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
                        <button id="btn-ubah-menu" type="submit" class="btn btn-primary">Ubah</button>
                        <button id="btn-simpan-menu" type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end modal-->