<div class="modal fade" id="modal-kelasaktif" tabindex="-1">
    <div class="vertical-alignment-helper">
        <div class="modal-dialog modal-dialog-default">
            <div class="modal-content card">
                <div class="modal-header card-header bg-gradient-light">
                    <h5 class="modal-title card-title" id="judul-modal">Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-kelasaktif" class="form-horizontal">
                    <div class="modal-body card-body">
                        <!-- <div class="form-group">
                            <label for="id" class="control-label">
                                Kode Kelas
                            </label>
                            <div>
                                <input type="hidden" id="idubah" name="idubah">
                                <input type="text" name="id" class="form-control" id="id" autocomplete="off" placeholder="Kode kelas">
                                <span id="kode_error" class="text-danger"></span>
                            </div>
                        </div> -->
                        <div class="form-group">
                            <label for="prodi_id" class="control-label">Tahun Akademik</label>
                            <div>
                                <?php
                                $perak_id = "";
                                $keterangan = "";
                                if ($periode) {
                                    $perak_id = $periode['id'];
                                    $keterangan = $periode['keterangan'];
                                }
                                ?>
                                <input type="hidden" id="idubah" name="idubah">
                                <input type="hidden" id="perak_id" name="perak_id" value="<?= $perak_id; ?>">
                                <input type="text" name="periodeAk" class="form-control" id="periodeAk" value="<?= $keterangan; ?>" disabled>
                                <span id="periode_error" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="kelas_id" class="control-label">Kelas</label>
                            <div>
                                <select id="kelas_id" name="kelas_id" class="form-control">
                                    <option value="">- Pilih -</option>
                                    <?php
                                    foreach ($kelas as $dataKelas) :
                                    ?>
                                        <option value="<?= $dataKelas['id']; ?>"><?= $dataKelas['keterangan']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <span id="kelas_error" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="bop_id" class="control-label">Kode BOP</label>
                            <div>
                                <select id="bop_id" name="bop_id" class="form-control">
                                    <option value="">- Pilih -</option>
                                    <?php
                                    if ($bop) {
                                        foreach ($bop as $dataBop) :
                                    ?>
                                            <option value="<?= $dataBop['id']; ?>"><?= $dataBop['kode']; ?> <?= $dataBop['keterangan']; ?></option>
                                    <?php
                                        endforeach;
                                    }
                                    ?>
                                </select>
                                <span id="bop_error" class="text-danger"></span>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer card-footer">
                        <div>
                            <button id="btn-ubah-kelasaktif" type="submit" class="btn btn-primary"><i class="far fa-edit"></i> Ubah</button>
                        </div>
                        <div>
                            <button id="btn-simpan-kelasaktif" type="submit" class="btn btn-success"><i class="far fa-check-square"></i> Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>