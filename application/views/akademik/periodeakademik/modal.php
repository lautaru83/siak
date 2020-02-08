<div class="modal fade" id="modal-periodeakademik" tabindex="-1">
    <div class="vertical-alignment-helper">
        <div class="modal-dialog modal-dialog-default">
            <div class="modal-content card">
                <div class="modal-header card-header bg-gradient-light">
                    <h5 class="modal-title card-title" id="judul-modal">Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-periodeakademik" class="form-horizontal">
                    <div class="modal-body card-body">
                        <div class="form-group">
                            <label for="id" class="control-label">Kode</label>
                            <div>
                                <input type="hidden" id="idubah" name="idubah">
                                <input type="text" name="id" class="form-control" id="id" placeholder="Kode Periode Akademik">
                                <span id="kode_error" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tahunakademik_id" class="control-label">Tahun Akademik</label>
                            <div>
                                <select id="tahunakademik_id" name="tahunakademik_id" class="form-control">
                                    <option value="">- Pilih -</option>
                                    <?php
                                    foreach ($tahunakademik as $dataTahunakademik) :
                                    ?>
                                        <option value="<?= $dataTahunakademik['id']; ?>"><?= $dataTahunakademik['tahunakademik']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <span id="tahunakademik_error" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="semester_id" class="control-label">Semester</label>
                            <div>
                                <select id="semester_id" name="semester_id" class="form-control">
                                    <option value="">- Pilih -</option>
                                    <?php
                                    foreach ($semester as $dataSemester) :
                                    ?>
                                        <option value="<?= $dataSemester['id']; ?>"><?= $dataSemester['semester']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <span id="semester_error" class="text-danger"></span>
                            </div>
                        </div>
                        <!-- Date awal periode -->
                        <div class="form-group">
                            <label>Awal Semester</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="far fa-calendar-alt"></i>
                                    </span>
                                </div>
                                <input type="text" name="awal_periode" class="form-control float-right" id="awal_periode" placeholder="Tanggal awal semester">
                                <span id="awal_periode_error" class="text-danger"></span>
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->
                        <!-- /awal periode -->
                        <!-- Date akhir periode -->
                        <div class="form-group">
                            <label>Akhir Semester</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="far fa-calendar-alt"></i>
                                    </span>
                                </div>
                                <input type="text" name="akhir_periode" class="form-control float-right" id="akhir_periode" placeholder="Tanggal akhir semester">
                                <span id="akhir_periode_error" class="text-danger"></span>
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->
                        <!-- /akhir periode -->
                        <div class="form-group">
                            <label for="keterangan" class="control-label">
                                Keterangan
                            </label>
                            <div>
                                <input type="text" name="keterangan" class="form-control" id="keterangan" autocomplete="off" placeholder="Keterangan">
                                <span id="keterangan_error" class="text-danger"></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer card-footer">
                        <div>
                            <button id="btn-ubah-periodeakademik" type="submit" class="btn btn-primary"><i class="far fa-edit"></i> Ubah</button>
                        </div>
                        <div>
                            <button id="btn-simpan-periodeakademik" type="submit" class="btn btn-success"><i class="far fa-check-square"></i> Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>