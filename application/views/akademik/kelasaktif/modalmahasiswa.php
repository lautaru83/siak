<div class="modal fade" id="modal-mahasiswaaktif" tabindex="-1">
    <div class="vertical-alignment-helper">
        <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered" role="document">
            <div class="modal-content card">
                <div class="modal-header card-header bg-gradient-light">
                    <h5 class="modal-title card-title" id="judul-modal">Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-mahasiswaaktif" class="form-horizontal">
                    <div class="modal-body card-body">
                        <!-- isi data mahasiswa -->
                        <table class="table table-sm table-bordered table-head-fixed">
                            <thead>
                                <tr>
                                    <td width="5%" class="text-center">No</td>
                                    <td width="15%">NIM</td>
                                    <td width="">Nama</td>
                                    <td width="8%" class="text-center" style="color: grey"><i class="fas fa-cog"></i></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $nom = 1;
                                $mahasiswa = $this->Mahasiswa_model->ambil_data_by_kelas_id($kelas_id);
                                if ($mahasiswa) {
                                    foreach ($mahasiswa as $dataMahasiswa) :
                                        $idmhs = $dataMahasiswa['id'];
                                ?>
                                        <tr>
                                            <td width="5%" class="text-center"><?= $nom; ?></td>
                                            <td width="15%"><?= $dataMahasiswa['nim']; ?></td>
                                            <td width=""><?= $dataMahasiswa['nama']; ?></td>
                                            <td width="8%" class="text-center">
                                                <div class="form-check"><input class="form-check-input frm-cek-mhsactive" type="checkbox" data-iddekelas="<?= $dekelas_id; ?>" data-mhsid="<?= $idmhs; ?>" <?= cek_mahasiswaaktif($dekelas_id, $idmhs); ?>></div>
                                            </td>
                                        </tr>
                                    <?php
                                        $nom++;
                                    endforeach;
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="4">Tidak ditemukan data</td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer card-footer">
                        <div>
                            <button id="btn-ubah-mahasiswaaktif" type="submit" class="btn btn-primary"><i class="far fa-edit"></i> Ubah</button>
                        </div>
                        <div>
                            <button id="btn-selesai-mahasiswaaktif" data-dismiss="modal" class="btn btn-success"><i class="far fa-check-square"></i> Selesai</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>