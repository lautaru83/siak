<div class="modal fade" id="modal-submenu" tabindex="-1">
    <div class="vertical-alignment-helper">
        <div class="modal-dialog modal-dialog-default">
            <div class="modal-content card">
                <div class="modal-header card-header bg-gradient-light">
                    <h5 class="modal-title card-title" id="judul-modal">Form Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-submenu" class="form-horizontal">
                    <div class="modal-body card-body">
                        <div class="form-group">
                            <label for="submenu" class="control-label">Submenu</label>
                            <div>
                                <input type="hidden" id="idubah" name="idubah">
                                <input type="text" name="submenu" class="form-control" id="submenu" autocomplete="off" placeholder="Nama submenu">
                                <span id="submenu_error" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="menu_id" class="control-label">Menu</label>
                            <div>
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
                            <label for="url" class="control-label">Url</label>
                            <div>
                                <input type="text" name="url" class="form-control" id="url" autocomplete="off" placeholder="url">
                                <span id="url_error" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="icon" class="control-label">Icon</label>
                            <div>
                                <input type="text" name="icon" class="form-control" id="icon" autocomplete="off" placeholder="Icon">
                                <span id="icon_error" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="is_active" class="control-label">Status</label>
                            <div>
                                <select id="is_active" name="is_active" class="form-control">
                                    <option value="">- Pilih -</option>
                                    <option value="0">Non Aktif</option>
                                    <option value="1">Aktif</option>

                                </select>
                                <span id="status_error" class="text-danger"></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer card-footer">
                        <div>
                            <button id="btn-ubah-submenu" type="submit" class="btn btn-primary"><i class="far fa-edit"></i> Ubah</button>
                        </div>
                        <div>
                            <button id="btn-simpan-submenu" type="submit" class="btn btn-success"><i class="far fa-check-square"></i> Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>