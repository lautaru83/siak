<!-- Modal Komponen BOP -->
<div class="modal fade" id="modal-komponenbop" tabindex="-1">
    <div class="vertical-alignment-helper">
        <div class="modal-dialog modal-dialog-default">
            <div class="modal-content card">
                <div class="modal-header card-header bg-gradient-light">
                    <h5 class="modal-title card-title" id="judul-modal">Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-komponenbop" class="form-horizontal">
                    <div class="modal-body card-body">
                        <div class="form-group">
                            <label for="kewajiban" class="control-label">
                                Kode Komponen
                            </label>
                            <div>
                                <input type="hidden" id="idubah" name="idubah">
                                <input type="text" name="kode" class="form-control" id="kode" placeholder="Kode Komponen">
                                <span id="kode_error" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="kewajiban" class="control-label">
                                Uraian Komponen
                            </label>
                            <div>
                                <input type="text" name="kewajiban" class="form-control" id="kewajiban" placeholder="Uraian Komponen">
                                <span id="komponen_error" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="jenis" class="control-label">Jenis Komponen</label>
                            <div>
                                <select id="jenis" name="jenis" class="form-control">
                                    <option value="">- Pilih -</option>
                                    <option value="B">- Kas/Bank -</option>
                                    <option value="M">- Pendapatan -</option>
                                    <option value="K">- Beban -</option>
                                </select>
                                <span id="jenis_error" class="text-danger"></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer card-footer">
                        <div>
                            <button id="btn-ubah-komponenbop" type="submit" class="btn btn-primary"><i class="far fa-edit"></i> Ubah</button>
                        </div>
                        <div>
                            <button id="btn-simpan-komponenbop" type="submit" class="btn btn-success"><i class="far fa-check-square"></i> Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>
<!-- /Modal Komponen BOP -->
<!-- Modal Akun BOP -->
<div class="modal fade" id="modal-akunbop" tabindex="-1">
    <div class="vertical-alignment-helper">
        <div class="modal-dialog modal-dialog-default">
            <div class="modal-content card">
                <div class="modal-header card-header bg-gradient-light">
                    <h5 class="modal-title card-title" id="judul-modalakunbop">Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-akunbop" class="form-horizontal">
                    <div class="modal-body card-body">
                        <div class="form-group">
                            <label class="control-label">
                                Nama Komponen
                            </label>
                            <div>
                                <input type="hidden" id="kewajiban_id" name="kewajiban_id">
                                <input type="text" name="namakewajiban" class="form-control" id="namakewajiban" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="a6level_id" class="control-label">Kode Perkiraan</label>
                            <div>
                                <input type="hidden" id="kewajiban_id" name="kewajiban_id">
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
                            <button id="btn-ubah-akunbop" type="submit" class="btn btn-primary"><i class="far fa-edit"></i> Ubah</button>
                        </div> -->
                        <div>
                            <button id="btn-simpan-akunbop" type="submit" class="btn btn-success"><i class="far fa-check-square"></i> Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>
<!-- end Modal Akun BOP -->