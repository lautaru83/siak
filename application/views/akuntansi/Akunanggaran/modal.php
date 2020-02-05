<!-- Modal Level 5 -->
<div class="modal fade" id="modal-akunanggaran" tabindex="-1">
    <div class="vertical-alignment-helper">
        <div class="modal-dialog modal-dialog-default">
            <div class="modal-content card">
                <div class="modal-header card-header bg-gradient-light">
                    <h5 class="modal-title card-title" id="judul-modal">Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-akunanggaran" class="form-horizontal">
                    <div class="modal-body card-body">
                        <div class="form-group">
                            <label for="a6level_id" class="control-label">Kodeperkiraan</label>
                            <div>
                                <input type="hidden" id="anggaran_id" name="anggaran_id">
                                <select id="a6level_id" name="a6level_id" class="form-control">
                                    <option value="">- Pilih -</option>
                                    <?php
                                    if ($akun) {
                                        foreach ($akun as $dataAkun) :
                                    ?>
                                            <option value="<?= $dataAkun['id']; ?>"><?= $dataAkun['id']; ?> - <?= $dataAkun['level6'] ?></option>
                                    <?php
                                        endforeach;
                                    }
                                    ?>

                                </select>
                            </div>
                            <span id="akun_error" class="text-danger"></span>
                        </div>
                    </div>
                    <div class="modal-footer card-footer">
                        <!-- <div>
                            <button id="btn-ubah-akunanggaran" type="submit" class="btn btn-primary"><i class="far fa-edit"></i> Ubah</button>
                        </div> -->
                        <div>
                            <button id="btn-simpan-akunanggaran" type="submit" class="btn btn-success"><i class="far fa-check-square"></i> Simpan</button>
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
                            <label>Nama Akun</label>
                            <div class="input-group">
                                <input type="hidden" id="idubah" name="idubah">
                                <input type="hidden" id="kelompok_id" name="kelompok_id">
                                <input type="hidden" id="institusi_id" name="kelompok_id" value="<?= $institusi_id ?>">
                                <input type="text" name="anggaran" class="form-control float-right" id="anggaran" placeholder="Nama Akun">
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