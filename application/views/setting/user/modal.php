<div class="modal fade" id="modal-user" tabindex="-1">
    <div class="vertical-alignment-helper">
        <div class="modal-dialog modal-dialog-default">
            <div class="modal-content card">
                <div class="modal-header card-header bg-gradient-light">
                    <h5 class="modal-title card-title" id="judul-modal">Form Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-user" class="form-horizontal">
                    <div class="modal-body card-body">
                        <div class="alert alert-warning" role="alert" id="user-info">
                            NB: Kosongkan kolom password, jika password tidak diubah
                        </div>
                        <div class="form-group">
                            <label for="nama" class="control-label">Nama</label>
                            <div>
                                <input type="hidden" id="idubah" name="idubah">
                                <input type="text" name="nama" class="form-control" id="nama" autocomplete="off" placeholder="Nama User">
                                <span id="nama_error" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="role_id" class="control-label">Role</label>
                            <div>
                                <select id="role_id" name="role_id" class="form-control">
                                    <option value="">- Pilih -</option>
                                    <?php
                                    foreach ($role as $dataRole) :
                                        ?>
                                        <option value="<?= $dataRole['id']; ?>"><?= $dataRole['role']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <span id="role_error" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="unit_id" class="control-label">Unit</label>
                            <div>
                                <select id="unit_id" name="unit_id" class="form-control">
                                    <option value="">- Pilih -</option>
                                    <?php
                                    foreach ($unit as $dataUnit) :
                                        ?>
                                        <option value="<?= $dataUnit['id']; ?>"><?= $dataUnit['unit']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <span id="unit_error" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="control-label">Email</label>
                            <div>
                                <input type="text" name="email" class="form-control" id="email" autocomplete="off" placeholder="Alamat Email">
                                <span id="email_error" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="sandi" class="control-label">Password</label>
                            <div>
                                <input type="text" name="sandi" class="form-control" id="sandi" autocomplete="off" placeholder="Password">
                                <span id="sandi_error" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="is_active" class="control-label">Status User</label>
                            <div>
                                <select id="is_active" name="is_active" class="form-control">
                                    <option value="">- Pilih -</option>
                                    <option value="0">Tidak Aktif</option>
                                    <option value="1">Aktif</option>

                                </select>
                                <span id="status_error" class="text-danger"></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer card-footer">
                        <div>
                            <button id="btn-ubah-user" type="submit" class="btn btn-primary"><i class="far fa-edit"></i> Ubah</button>
                        </div>
                        <div>
                            <button id="btn-simpan-user" type="submit" class="btn btn-success"><i class="far fa-check-square"></i> Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>