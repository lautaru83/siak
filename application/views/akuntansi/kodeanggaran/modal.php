<!-- Modal Level 5 -->
<div class="modal fade" id="modal-unitanggaran" tabindex="-1">
    <div class="vertical-alignment-helper">
        <div class="modal-dialog modal-dialog-default">
            <div class="modal-content card">
                <div class="modal-header card-header bg-gradient-light">
                    <h5 class="modal-title card-title" id="judul-modal">Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-unitanggaran" class="form-horizontal">
                    <div class="modal-body card-body">
                        <div class="form-group">
                            <label for="kodeunit" class="control-label">Kode</label>
                            <div class="input-group">
                                <input type="hidden" id="idubahunit" name="idubahunit">
                                <input type="hidden" id="kelompokanggaran_id" name="kelompokanggaran_id">
                                <input type="text" name="kodeunit" class="form-control w-20" id="kodeunit" placeholder="Kode">
                                <div class="input-group-append">
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                            <span id="kodeunit_error" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label>Nama Akun</label>
                            <div class="input-group">
                                <input type="text" name="unit_anggaran" class="form-control float-right" id="unit_anggaran" placeholder="Nama Akun">
                            </div>
                            <span id="unit_error" class="text-danger"></span>
                            <!-- /.input group -->
                        </div>
                    </div>
                    <div class="modal-footer card-footer">
                        <div>
                            <button id="btn-ubah-unitanggaran" type="submit" class="btn btn-primary"><i class="far fa-edit"></i> Ubah</button>
                        </div>
                        <div>
                            <button id="btn-simpan-unitanggaran" type="submit" class="btn btn-success"><i class="far fa-check-square"></i> Simpan</button>
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
<div class="modal fade" id="modal-anggaran" tabindex="-1">
    <div class="vertical-alignment-helper">
        <div class="modal-dialog modal-dialog-default">
            <div class="modal-content card">
                <div class="modal-header card-header bg-gradient-light">
                    <h5 class="modal-title card-title" id="judul-modal-anggaran">Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-anggaran" class="form-horizontal">
                    <div class="modal-body card-body">
                        <div class="form-group">
                            <label for="kodeanggaran" class="control-label">Kode</label>
                            <div class="input-group">
                                <input type="hidden" id="idubahanggaran" name="idubahanggaran">
                                <input type="hidden" id="unitanggaran_id" name="unitanggaran_id">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="kdunit">kode</span>
                                </div>
                                <input type="text" name="kodeanggaran" class="form-control w-20" id="kodeanggaran" placeholder="Kode">
                            </div>
                            <span id="kodeanggaran_error" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label>Nama Akun</label>
                            <div class="input-group">
                                <input type="text" name="nama_anggaran" class="form-control float-right" id="nama_anggaran" placeholder="Nama Akun">
                            </div>
                            <span id="anggaran_error" class="text-danger"></span>
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
                    </div>
                    <div class="modal-footer card-footer">
                        <div>
                            <button id="btn-ubah-anggaran" type="submit" class="btn btn-primary"><i class="far fa-edit"></i> Ubah</button>
                        </div>
                        <div>
                            <button id="btn-simpan-anggaran" type="submit" class="btn btn-success"><i class="far fa-check-square"></i> Simpan</button>
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