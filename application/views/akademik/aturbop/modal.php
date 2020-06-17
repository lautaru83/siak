<!-- Modal BOP -->
<div class="modal fade" id="modal-aturbop" tabindex="-1">
    <div class="vertical-alignment-helper">
        <div class="modal-dialog modal-dialog-default">
            <div class="modal-content card">
                <div class="modal-header card-header bg-gradient-light">
                    <h5 class="modal-title card-title" id="judul-modal">Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-aturbop" class="form-horizontal">
                    <div class="modal-body card-body">
                        <div class="form-group">
                            <label for="kode" class="control-label">
                                Kode Pembayaran
                            </label>
                            <div>
                                <input type="hidden" id="idubah" name="idubah">
                                <input type="text" name="kode" class="form-control" id="kode" placeholder="Kode Pembayaran">
                                <span id="kode_error" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="detailkelas_id" class="control-label">
                                Kelas Aktif
                            </label>
                            <div>
                                <select id="detailkelas_id" name="detailkelas_id" class="form-control">
                                    <option value="">- Pilih -</option>
                                    <?php
                                    if ($kelasaktif) {
                                        foreach ($kelasaktif as $dataKelas) :
                                    ?>
                                            <option value="<?= $dataKelas['detailkelas_id']; ?>"><?= $dataKelas['kelas_id']; ?> - <?= $dataKelas['keterangan']; ?></option>
                                    <?php
                                        endforeach;
                                    }
                                    ?>
                                </select>
                                <span id="kelas_error" class="text-danger"></span>
                            </div>
                            <!-- <div>
                                <input type="text" name="keterangan" class="form-control" id="keterangan" placeholder="Keterangan">
                                <span id="keterangan_error" class="text-danger"></span>
                            </div> -->
                        </div>
                    </div>
                    <div class="modal-footer card-footer">
                        <div>
                            <button id="btn-ubah-aturbop" type="submit" class="btn btn-primary"><i class="far fa-edit"></i> Ubah</button>
                        </div>
                        <div>
                            <button id="btn-simpan-aturbop" type="submit" class="btn btn-success"><i class="far fa-check-square"></i> Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>
<!-- /Modal BOP -->