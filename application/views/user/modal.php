<!-- modal -->
<div class="modal fade" id="modal-user" tabindex="-1">
    <div class="vertical-alignment-helper">
        <div class="modal-dialog vertical-align-center">
            <div class="modal-content panel-default">
                <div class="modal-header panel-heading">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="judul-modal">Tambah Data User</h4>
                </div>
                <form id="form-user" class="form-horizontal">
                    <div class="modal-body panel-body">
                        <div id="info" class="panel panel-warning">
                            <div class="panel-heading">
                                <h3 class="panel-title">Info : Kosongkan password jika tidak diubah</h3>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="submenu" class="col-sm-2 control-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="hidden" name="idubah" id="idubah">
                                <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama User" autofocus>
                                <span id="nama_error" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="role_id" class="col-sm-2 control-label">Role</label>
                            <div class="col-sm-10">
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
                            <label for="unit_id" class="col-sm-2 control-label">Unit</label>
                            <div class="col-sm-10">
                                <select name="unit_id" id="unit_id" class="form-control">
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
                            <label for="email" class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-10">
                                <input type="text" name="email" id="email" class="form-control" placeholder="Email">
                                <span id="email_error" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="sandi" class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-10">
                                <input type="password" name="sandi" id="sandi" class="form-control" placeholder="Password">
                                <span id="sandi_error" class="text-danger"></span>
                            </div>
                        </div>
                        <!-- <div class="form-group" id="ganti-password">
                            <label for="newsandi" class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-10">
                                <input type="password" name="newsandi" id="newsandi" class="form-control" placeholder="Password baru">
                                <span id="sandi_error" class="text-danger"></span>
                            </div>
                        </div> -->
                    </div>
                    <div class="modal-footer panel-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        <button id="btn-ubah-user" type="submit" class="btn btn-primary">Ubah</button>
                        <button id="btn-simpan-user" type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- endmodal-->