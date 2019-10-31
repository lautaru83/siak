<!-- modal-tambah -->
<div class="modal fade" id="modal-tambah-unit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Data Unit</h4>
            </div>
            <form class="form-horizontal" method="POST" action="<?= base_url('unit/add') ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="idunit" class="col-sm-2 control-label">Kode</label>
                        <div class="col-sm-10">
                            <input type="text" name="idunit" class="form-control" id="idunit" autocomplete="off" placeholder="Kode" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="unit" class="col-sm-2 control-label">Unit</label>
                        <div class="col-sm-10">
                            <input type="text" name="unit" class="form-control" id="unit" autocomplete="off" placeholder="Unit" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="institusi_id" class="col-sm-2 control-label">Institusi</label>
                        <div class="col-sm-10">
                            <select id="instutusi_id" name="institusi_id" class="form-control" required>
                                <option value="">Pilih</option>
                                <?php
                                foreach ($institusi as $dataInstitusi) :
                                    ?>
                                    <option value="<?= $dataInstitusi['id']; ?>"><?= $dataInstitusi['institusi']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end modal-tambah -->

<!-- modal-ubah -->
<div class="modal fade" id="modal-ubah-unit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Ubah Data unit</h4>
            </div>
            <form id="form_ubah" class="form-horizontal">
                <div class="modal-body">

                    <div class="form-group">
                        <label for="idunit" class="col-sm-2 control-label">Kode</label>
                        <div class="col-sm-10">
                            <input type="text" name="idunit" class="form-control" id="idunit" placeholder="Kode" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="unit" class="col-sm-2 control-label">Unit</label>
                        <div class="col-sm-10">
                            <input type="hidden" id="idubah" name="idubah">
                            <input type="text" name="unit" class="form-control" id="unit" placeholder="Unit" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="institusi_id" class="col-sm-2 control-label">Institusi</label>
                        <div class="col-sm-10">
                            <select id="instutusi_id" name="institusi_id" class="form-control" required>
                                <option value="">Pilih</option>
                                <?php
                                foreach ($institusi as $dataInstitusi) :
                                    ?>
                                    <option value="<?= $dataInstitusi['id']; ?>"><?= $dataInstitusi['institusi']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <!-- Beri id "loading-simpan" untuk loading ketika klik tombol simpan -->
                    <!-- <div id="loading-simpan" class="pull-left">
                        <b>Sedang menyimpan...</b>
                    </div> -->

                    <!-- Beri id "loading-ubah" untuk loading ketika klik tombol ubah -->
                    <!-- <div id="loading-ubah" class="pull-left">
                        <b>Sedang mengubah...</b>
                    </div> -->
                    <button type="submit" class="btn btn-primary">Ubah</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- endmodal-ubah -->

<!-- modal-hapus -->
<div class="modal fade" id="modal-hapus-unit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Hapus Data Unit</h4>
            </div>
            <form class="form-horizontal" method="POST" action="<?= base_url('unit/hapus') ?>">
                <div class="modal-body">
                    <p>Apakah anda yakin akan menghapus unit ? </p>
                    <input type="hidden" id="idhapus" name="idhapus">
                    <input type="text" name="unithapus" class="form-control" id="unithapus">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- endmodal-hapus -->