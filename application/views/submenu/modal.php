<!-- modal -->
<div class="modal fade" id="modal-submenu" tabindex="-1">
    <div class="vertical-alignment-helper">
        <div class="modal-dialog vertical-align-center">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="judul-modal">Tambah Data Submenu</h4>
                </div>
                <form id="form-submenu" class="form-horizontal">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="submenu" class="col-sm-2 control-label">Submenu</label>
                            <div class="col-sm-10">
                                <input type="hidden" id="idubah" name="idubah">
                                <input type="text" name="submenu" class="form-control" id="submenu" placeholder="Nama submenu">
                                <span id="submenu_error" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="menu_id" class="col-sm-2 control-label">Menu</label>
                            <div class="col-sm-10">
                                <select id="menu_id" name="menu_id" class="form-control">
                                    <option value="">- Pilih -</option>
                                    <?php
                                    foreach ($menu as $dataMenu) :
                                        ?>
                                        <option value="<?= $dataMenu['id']; ?>"><?= $dataMenu['menu']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <span id="menu_error" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="url" class="col-sm-2 control-label">Url</label>
                            <div class="col-sm-10">
                                <input type="text" name="url" class="form-control" id="url" placeholder="Url">
                                <span id="url_error" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="icon" class="col-sm-2 control-label">Icon</label>
                            <div class="col-sm-10">
                                <input type="text" name="icon" class="form-control" id="icon" placeholder="Icon">
                                <span id="icon_error" class="text-danger"></span>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button id="btn-ubah-submenu" type="submit" class="btn btn-primary">Ubah</button>
                        <button id="btn-simpan-submenu" type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- endmodal-->