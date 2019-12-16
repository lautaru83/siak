<!-- Modal Level 5 -->
<div class="modal fade" id="modal-level5" tabindex="-1">
    <div class="vertical-alignment-helper">
        <div class="modal-dialog modal-dialog-default">
            <div class="modal-content card">
                <div class="modal-header card-header bg-gradient-light">
                    <h5 class="modal-title card-title" id="judul-modal">Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-level5" class="form-horizontal">
                    <div class="modal-body card-body">
                        <div class="form-group">
                            <label for="kode5" class="control-label">Kode</label>
                            <div class="input-group">
                                <input type="hidden" id="idubah5" name="idubah5">
                                <input type="hidden" id="a4level_id" name="a4level_id">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="kode4">kode</span>
                                </div>
                                <input type="text" name="kode5" class="form-control w-20" id="kode5" placeholder="Kode">
                                <div class="input-group-append">
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                            <span id="kode5_error" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label>Nama Akun</label>
                            <div class="input-group">
                                <input type="text" name="level5" class="form-control float-right" id="level5" placeholder="Nama Akun">
                            </div>
                            <span id="level5_error" class="text-danger"></span>
                            <!-- /.input group -->
                        </div>
                    </div>
                    <div class="modal-footer card-footer">
                        <div>
                            <button id="btn-ubah-level5" type="submit" class="btn btn-primary"><i class="far fa-edit"></i> Ubah</button>
                        </div>
                        <div>
                            <button id="btn-simpan-level5" type="submit" class="btn btn-success"><i class="far fa-check-square"></i> Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>
<!-- end Modal Level 5 -->

<!-- Modal Level 6 -->
<div class="modal fade" id="modal-level6" tabindex="-1">
    <div class="vertical-alignment-helper">
        <div class="modal-dialog modal-dialog-default">
            <div class="modal-content card">
                <div class="modal-header card-header bg-gradient-light">
                    <h5 class="modal-title card-title" id="judul-modal-level6">Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-level6" class="form-horizontal">
                    <div class="modal-body card-body">
                        <div class="form-group">
                            <label for="kode6" class="control-label">Kode</label>
                            <div class="input-group">
                                <input type="hidden" id="idubah6" name="idubah6">
                                <input type="hidden" id="a5level_id" name="a5level_id">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="kd5">kode</span>
                                </div>
                                <input type="text" name="kode6" class="form-control w-20" id="kode6" placeholder="Kode">
                            </div>
                            <span id="kode6_error" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label>Nama Akun</label>
                            <div class="input-group">
                                <input type="text" name="level6" class="form-control float-right" id="level6" placeholder="Nama Akun">
                            </div>
                            <span id="level6_error" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label for="institusi_id" class="control-label">Institusi</label>
                            <div>
                                <select id="institusi_id" name="institusi_id" class="form-control">
                                    <option value="">- Pilih -</option>
                                    <?php
                                    if ($institusi) {
                                        foreach ($institusi as $dataInstitusi) :
                                            ?>
                                            <option value="<?= $dataInstitusi['id']; ?>"><?= $dataInstitusi['institusi']; ?></option>
                                    <?php
                                        endforeach;
                                    }
                                    ?>
                                </select>
                            </div>
                            <span id="institusi_error" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label for="posisi" class="control-label">Posisi Akun</label>
                            <div>
                                <select id="posisi" name="posisi" class="form-control">
                                    <option value="">- Pilih -</option>
                                    <option value="D">Debet</option>
                                    <option value="K">Kredit</option>
                                </select>
                            </div>
                            <span id="posisi_error" class="text-danger"></span>
                        </div>         
                    </div>
                    <div class="modal-footer card-footer">
                        <div>
                            <button id="btn-ubah-level6" type="submit" class="btn btn-primary"><i class="far fa-edit"></i> Ubah</button>
                        </div>
                        <div>
                            <button id="btn-simpan-level6" type="submit" class="btn btn-success"><i class="far fa-check-square"></i> Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>
<!-- end Modal Level 6 -->