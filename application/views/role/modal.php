<!-- modal-tambah -->
<div class="modal fade" id="modal-tambah">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Data Role</h4>
            </div>
            <form class="form-horizontal" method="POST" action="<?= base_url('role/add') ?>">
                <div class="modal-body">

                    <div class="form-group">
                        <label for="role" class="col-sm-2 control-label">Role</label>
                        <div class="col-sm-10">
                            <input type="text" name="role" class="form-control" id="role" autocomplete="off" placeholder="Role" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="keterangan" class="col-sm-2 control-label">Keterangan</label>
                        <div class="col-sm-10">
                            <textarea name="keterangan" id="keterangan" class="form-control" placeholder="Keterangan" rows="3" required></textarea>
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
<div class="modal fade" id="modal-ubah">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Ubah Data Role</h4>
            </div>
            <form class="form-horizontal" method="POST" action="<?= base_url('role/ubah') ?>">
                <div class="modal-body">

                    <div class="form-group">
                        <label for="role" class="col-sm-2 control-label">Role</label>
                        <div class="col-sm-10">
                            <input type="hidden" id="idubah" name="idubah">
                            <input type="text" name="role" class="form-control" id="role" autocomplete="off" placeholder="Role" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="keterangan" class="col-sm-2 control-label">Keterangan</label>
                        <div class="col-sm-10">
                            <textarea name="keterangan" id="keterangan" class="form-control" placeholder="Keterangan" rows="3" required></textarea>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Ubah</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- endmodal-ubah -->

<!-- modal-hapus -->
<div class="modal fade" id="modal-hapus">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Hapus Data Role</h4>
            </div>
            <form class="form-horizontal" method="POST" action="<?= base_url('role/hapus') ?>">
                <div class="modal-body">
                    <p>Apakah anda yakin akan menghapus role ? </p>
                    <input type="hidden" id="idhapus" name="idhapus">
                    <input type="text" name="rolehapus" class="form-control" id="rolehapus">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- endmodal-hapus -->