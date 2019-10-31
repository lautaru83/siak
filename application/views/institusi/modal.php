<!-- modal-tambah -->
<div class="modal fade" id="modal-institusi" tabindex="-1">
    <div class="vertical-alignment-helper">
        <div class="modal-dialog vertical-align-center">
            <div class="modal-content">
                <form id="form-institusi" class="form-horizontal">
                    <div class=" modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="judul-modal">Tambah Data Institusi</h4>
                    </div>
                    <div class="modal-body">
                        <!-- Beri id "pesan-error" untuk menampung pesan error -->
                        <div id="pesan-error" class="alert alert-danger"></div>
                        <div class="form-group">
                            <label for="institusi" class="col-sm-2 control-label">Institusi</label>
                            <div class="col-sm-10">
                                <input type="hidden" id="id" name="id">
                                <input type="text" name="institusi" class="form-control" id="institusi" autocomplete="off" placeholder="Nama Institusi">
                                <span id="institusi_error" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="keterangan" class="col-sm-2 control-label">Keterangan</label>
                            <div class="col-sm-10">
                                <input type="text" name="keterangan" class="form-control" id="keterangan" autocomplete="off" placeholder="Keterangan">
                                <span id="keterangan_error" class="text-danger"></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="btn-ubah-institusi" type="submit" class="btn btn-primary">Ubah</button>
                        <button id="btn-simpan-institusi" type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end modal-tambah -->