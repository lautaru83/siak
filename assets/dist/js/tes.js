var tabelRole;
$(document).ready(function () {
    $('#awal_periode').daterangepicker({
        singleDatePicker: true,
        locale: {
            format: 'DD-MM-YYYY'
        }
    });
    $('#akhir_periode').daterangepicker({
        singleDatePicker: true,
        locale: {
            format: 'DD-MM-YYYY'
        }
    })
    const Toast = Swal.mixin({
        toast: true,
        position: 'center',
        showConfirmButton: false,
        timer: 4000
    });
    tabelRole = $('#tabel-tes').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "ordering": false,
        "ajax": {
            url: site_url + "tes/ajax_data",
            type: 'GET'
        },
    });
    // ---------------------TES---------------------------
    //set focus input tahunanggaran saat modal muncul
    $('#modal-tahunanggaran').on('shown.bs.modal', function () {
        $('#tahun_anggaran').trigger('focus');
    })
    //set focus input tahunanggaran saat modal muncul
    // tombol tambah tahunanggaran table
    $('#btn-tambah-tahunanggaran').on('click', function (e) {
        e.preventDefault();
        const judul = document.getElementById('judul-modal');
        judul.innerHTML = 'Tambah Data Tahun Anggaran';
        $('#btn-ubah-tahunanggaran').hide();
        $('#modal-tahunanggaran').modal('show');
    });
    // end tombol tambah tahunanggaran table
    // ajax tombol Simpan modal tahunanggaran
    $('#btn-simpan-tahunanggaran').on('click', function (e) {
        e.preventDefault();
        const tahunAnggaran = $('[name="tahun_anggaran"]').val();
        const awalPeriode = $('[name="awal_periode"]').val();
        const akhirPeriode = $('[name="akhir_periode"]').val();
        const keterangan = $('[name="keterangan"]').val();
        // const is_active = $('[name="is_active"]').val();
        $.ajax({

            type: "POST",
            url: base_url + "akuntansi/tahunanggaran/simpan",
            data: {
                tahun_anggaran: tahunAnggaran,
                awal_periode: awalPeriode,
                akhir_periode: akhirPeriode,
                keterangan: keterangan
            },
            dataType: "JSON",
            beforeSend: function () {
                $('#btn-simpan-tahunanggaran').attr('disabled', 'disabled');
            },
            success: function (data) {
                if (data.status == 'gagal') {
                    Toast.fire({
                        type: 'error',
                        title: ' Input data tidak valid!!!.'
                    });
                    if (data.tahun_anggaran_error != '') {
                        $('#tahun_anggaran_error').html(data.tahun_anggaran_error);
                    } else {
                        $('#tahun_anggaran_error').html('');
                    }
                    if (data.awal_periode_error != '') {
                        $('#awal_periode_error').html(data.awal_periode_error);
                    } else {
                        $('#awal_periode_error').html('');
                    }
                    if (data.akhir_periode_error != '') {
                        $('#akhir_periode_error').html(data.akhir_periode_error);
                    } else {
                        $('#akhir_periode_error').html('');
                    }
                    if (data.keterangan_error != '') {
                        $('#keterangan_error').html(data.keterangan_error);
                    } else {
                        $('#keterangan_error').html('');
                    }
                    // if (data.status_error != '') {
                    //     $('#status_error').html(data.status_error);
                    // } else {
                    //     $('#status_error').html('');
                    // }
                    $('#tahun_anggaran').trigger('focus');
                } else {
                    Toast.fire({
                        type: 'success',
                        title: ' Data berhasil disimpan.'
                    });
                    $('#modal-tahunanggaran').modal('hide');
                }
                $('#btn-simpan-tahunanggaran').attr('disabled', false);
            }
        });
        return false;
    });
    //end  ajax tombol Simpan modal tahunanggaran
    // ajax icon hapus table tahunanggaran klik
    $('.btn-hapus-tahunanggaran').on('click', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var info = $(this).data('info');
        Swal.fire({
            title: 'Konfirmasi!',
            text: 'Apakah anda yakin akan menghapus Tahun Anggaran -' + info + '- !?!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Batal',
            confirmButtonText: 'Hapus'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: base_url + "akuntansi/tahunanggaran/hapus",
                    type: "POST",
                    data: {
                        id: id,
                        info: info
                    },
                    dataType: 'JSON',
                    success: function (data) {
                        if (data.status == 'sukses') {
                            Toast.fire({
                                type: 'success',
                                title: ' Data berhasil dihapus!!!.'
                            });
                            document.location.reload();
                        } else {
                            Toast.fire({
                                type: 'warning',
                                title: ' Penghapusan dibatalkan, data sedang digunakan oleh system!!!.'
                            });
                        }
                    }
                });
            }
        })
    });
    // end ajax icon hapus table tahunanggaran klik
    // ajax tombol edit data table tahunanggaran klik
    $('.btn-edit-tahunanggaran').on('click', function (e) {
        e.preventDefault();
        const judul = document.getElementById('judul-modal');
        judul.innerHTML = 'Ubah Data Tahun Anggaran';
        var id = $(this).data('id');
        $('#btn-simpan-tahunanggaran').hide();
        $('#id').attr('disabled', 'disabled');
        $.ajax({
            url: base_url + 'akuntansi/tahunanggaran/ajax_edit/' + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('[name="idubah"]').val(data.id);
                $('[name="tahun_anggaran"]').val(data.tahun_anggaran);
                $('[name="awal_periode"]').val(data.awal_periode);
                $('[name="akhir_periode"]').val(data.akhir_periode);
                $('[name="keterangan"]').val(data.keterangan);
                // $('[name="is_active"]').val(data.is_active);
                $('#modal-tahunanggaran').modal('show');

            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });

    });
    //end ajax tombol edit data table tahunanggaran klik
    // ajax tombol modal ubah tahunanggaran
    $('#btn-ubah-tahunanggaran').on('click', function (e) {
        e.preventDefault();
        const idubah = $('[name="idubah"]').val();
        const tahunAnggaran = $('[name="tahun_anggaran"]').val();
        const awalPeriode = $('[name="awal_periode"]').val();
        const akhirPeriode = $('[name="akhir_periode"]').val();
        const keterangan = $('[name="keterangan"]').val();
        $.ajax({
            type: "POST",
            url: base_url + "akuntansi/tahunanggaran/ubah/" + idubah,
            data: {
                idubah: idubah,
                awal_periode: awalPeriode,
                tahun_anggaran: tahunAnggaran,
                akhir_periode: akhirPeriode,
                keterangan: keterangan
            },
            dataType: 'JSON',
            beforeSend: function () {
                $('#btn-ubah-tahunanggaran').attr('disabled', 'disabled');
            },
            success: function (data) {
                if (data.status == 'gagal') {
                    Toast.fire({
                        type: 'error',
                        title: ' Input data tidak valid!!!.'
                    });
                    if (data.tahun_anggaran_error != '') {
                        $('#tahun_anggaran_error').html(data.tahun_anggaran_error);

                    } else {
                        $('#tahun_anggaran_error').html('');
                    }
                    if (data.awal_periode_error != '') {
                        $('#awal_periode_error').html(data.awal_periode_error);

                    } else {
                        $('#awal_periode_error').html('');
                    }
                    if (data.akhir_periode_error != '') {
                        $('#akhir_periode_error').html(data.akhir_periode_error);
                    } else {
                        $('#akhir_periode_error').html('');
                    }
                    if (data.keterangan_error != '') {
                        $('#keterangan_error').html(data.keterangan_error);
                    } else {
                        $('#keterangan_error').html('');
                    }
                    //$('#institusi').trigger('focus');
                } else {
                    Toast.fire({
                        type: 'success',
                        title: ' Data berhasil diubah!'
                    });
                    $('#modal-tahunanggaran').modal('hide');
                    //dataTable.ajax.reload();
                }
                $('#btn-ubah-tahunanggaran').attr('disabled', false);
            }
        });
        return false;
    });
    // end ajax tombol modal ubah tahunanggaran
    // btn-aktif-tahunanggaran
    $('.btn-aktif-tahunanggaran').on('click', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var info = $(this).data('info');
        var aktif = $(this).data('aktif');
        if (aktif == 0) {
            Swal.fire({
                title: 'Konfirmasi!',
                text: 'Apakah anda yakin akan mengaktifkan Tahun Anggaran -' + info + '- !?!',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Batal',
                confirmButtonText: 'Aktif'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: base_url + "akuntansi/tahunanggaran/tahunaktif",
                        data: {
                            id: id,
                            info: info
                        },
                        type: "POST",
                        //dataType: 'JSON',
                        success: function () {
                            Toast.fire({
                                type: 'success',
                                title: ' Tahun' + info + ' berhasil diaktifkan!'
                            });
                            document.location.reload();
                        }
                    });
                }
            })
        }
    });
    // end btn-aktif-tahunanggaran


    // ---------------------/TES---------------------------
});
// $('#form_id').trigger("reset"); form reset

// function atur_datatable() {
    //     $('#tabel1').DataTable({
        //         "paging": true,
        //         "lengthChange": true,
        //         "searching": true,
        //         "ordering": true,
        //         "info": true,
        //         "autoWidth": false,
        //         "ordering": false
        //     });
        // };
        // $('#btn-simpan-institusi').attr('disabled', false);
        // $('#keterangan').val("");
        // $('#institusi').val("");
        // $('#institusi').trigger('focus');
        // $('.custom-file-input').on('change', function () {
        //     let fileName = $(this).val().split('\\').pop();
        //     $(this).next('.custom-file-label').addClass("selected").html(fileName);
        // });