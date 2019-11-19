<div class="modal fade" id="modal-menu" tabindex="-1">
    <div class="vertical-alignment-helper">
        <div class="modal-dialog modal-dialog-default">
            <div class="modal-content card">
                <div class="modal-header card-header bg-gradient-light">
                    <h5 class="modal-title card-title" id="judul-modal">Form Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-menu" class="form-horizontal">
                    <div class="modal-body card-body">
                        <div class="form-group">
                            <label for="menu" class="control-label">Menu</label>
                            <div>
                                <input type="hidden" id="idubah" name="idubah">
                                <input type="text" name="menu" class="form-control" id="menu" autocomplete="off" placeholder="Nama Menu">
                                <span id="menu_error" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="icon" class="control-label">
                                Icon
                            </label>
                            <div>
                                <input type="text" name="icon" class="form-control" id="icon" autocomplete="off" placeholder="Icon">
                                <span id="icon_error" class="text-danger"></span>
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
                            <button id="btn-ubah-menu" type="submit" class="btn btn-primary"><i class="far fa-edit"></i> Ubah</button>
                        </div>
                        <div>
                            <button id="btn-simpan-menu" type="submit" class="btn btn-success"><i class="far fa-check-square"></i> Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>