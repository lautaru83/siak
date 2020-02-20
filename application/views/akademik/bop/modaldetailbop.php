<!-- Modal Komponen BOP -->
<div class="modal fade" id="modal-detailbop" tabindex="-1">
    <div class="vertical-alignment-helper">
        <div class="modal-dialog modal-dialog-default">
            <div class="modal-content card">
                <div class="modal-header card-header bg-gradient-light">
                    <h5 class="modal-title card-title" id="judul-modal">Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-detailbop" class="form-horizontal">
                    <div class="modal-body card-body">
                        <div class="form-group">
                            <label for="kewajiban_id" class="control-label">Komponen BOP</label>
                            <div>
                                <input type="hidden" id="idubah" name="idubah">
                                <input type="hidden" id="bop_id" name="bop_id" value="<?= $bop_id; ?>">
                                <select id="kewajiban_id" name="kewajiban_id" class="form-control">
                                    <option value="">- Pilih -</option>
                                    <?php
                                    //$akun = "";
                                    if ($komponen) {
                                        foreach ($komponen as $dataKomponen) :
                                    ?>
                                            <option value="<?= $dataKomponen['id']; ?>"><?= $dataKomponen['kode']; ?> - <?= $dataKomponen['kewajiban'] ?></option>
                                    <?php
                                        endforeach;
                                    }
                                    ?>
                                </select>
                            </div>
                            <span id="komponen_error" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label for="jumlah" class="control-label">
                                Jumlah (Rp)
                            </label>
                            <div>
                                <input type="text" name="jumlah" class="form-control" id="jumlah" data-inputmask="'alias': 'decimal', 'groupSeparator': '.', 'autoGroup': true, 'digits': 2, 'digitsOptional': false,'allowMinus':false, 'placeholder': '0', 'radixPoint': ',', 'rightAlign': false">
                                <span id="jumlah_error" class="text-danger"></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer card-footer">
                        <div>
                            <button id="btn-ubah-detailbop" type="submit" class="btn btn-primary"><i class="far fa-edit"></i> Ubah</button>
                        </div>
                        <div>
                            <button id="btn-simpan-detailbop" type="submit" class="btn btn-success"><i class="far fa-check-square"></i> Simpan</button>
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