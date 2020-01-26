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
    });
    $('#tanggal_transaksi').daterangepicker({
        singleDatePicker: true,
        locale: {
            format: 'DD-MM-YYYY'
        }
    });
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
    // cek data
    // $('#btn-tes').on('click', function (e) {
    //     e.preventDefault();
    //     const a6level_id = $('[name="a6level_id"]').val();
    //     const tahunbuku = $('[name="tahun_pembukuan_id"]').val();
    //     const saldo = $('[name="saldoawal"]').val();
    //     Toast.fire({
    //         type: 'success',
    //         title: ' Datanya ' + a6level_id + "-" + tahunbuku + "-" + saldo + "-"
    //     });
    // });
    // cek data


    //set focus input kelas saat modal muncul
    $('#modal-kelas').on('shown.bs.modal', function () {
        $('#kelas').trigger('focus');
    })
    //set focus input kelas saat modal muncul
    // tombol tambah kelas table
    $('#btn-tambah-kelas').on('click', function (e) {
        e.preventDefault();
        const judul = document.getElementById('judul-modal');
        judul.innerHTML = 'Tambah Data Kelas';
        $('#btn-ubah-kelas').hide();
        $('#modal-kelas').modal('show');
    });
    // end tombol tambah kelas table
    // ajax tombol Simpan modal kelas
    $('#btn-simpan-kelas').on('click', function (e) {
        e.preventDefault();
        //const id = $('[name="id"]').val();
        const kelas = $('[name="kelas"]').val();
        const prodi_id = $('[name="prodi_id"]').val();
        const akademik_id = $('[name="akademik_id"]').val();
        const tingkat_id = $('[name="tingkat_id"]').val();
        $.ajax({
            type: "POST",
            url: base_url + "akademik/kelas/simpan",
            data: {
                kelas: kelas,
                prodi_id: prodi_id,
                akademik_id: akademik_id,
                tingkat_id: tingkat_id
            },
            dataType: "JSON",
            beforeSend: function () {
                $('#btn-simpan-kelas').attr('disabled', 'disabled');
            },
            success: function (data) {
                if (data.status == 'gagal') {
                    Toast.fire({
                        type: 'error',
                        title: ' Input data tidak valid!!!.'
                    });
                    if (data.kelas_error != '') {
                        $('#kelas_error').html(data.kelas_error);
                    } else {
                        $('#kelas_error').html('');
                    }
                    if (data.akademik_error != '') {
                        $('#akademik_error').html(data.akademik_error);
                    } else {
                        $('#akademik_error').html('');
                    }
                    if (data.prodi_error != '') {
                        $('#prodi_error').html(data.prodi_error);
                    } else {
                        $('#prodi_error').html('');
                    }
                    if (data.tingkat_error != '') {
                        $('#tingkat_error').html(data.tingkat_error);
                    } else {
                        $('#tingkat_error').html('');
                    }
                    $('#kelas').trigger('focus');
                } else {
                    Toast.fire({
                        type: 'success',
                        title: ' Data berhasil disimpan.'
                    });
                    $('#modal-kelas').modal('hide');
                }
                $('#btn-simpan-kelas').attr('disabled', false);
            }
        });
        return false;
    });
    //end  ajax tombol Simpan modal kelas
    // ajax icon hapus table kelas klik
    $('.btn-hapus-kelas').on('click', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var info = $(this).data('info');
        Swal.fire({
            title: 'Konfirmasi!',
            text: 'Apakah anda yakin akan menghapus Kelas -' + info + '- !?!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Batal',
            confirmButtonText: 'Hapus'
        }).then((result) => {
            if (result.value) {
                // Toast.fire({
                //     type: 'success',
                //     title: id + "-" + info
                // });
                $.ajax({
                    type: "POST",
                    url: base_url + "akademik/kelas/hapus",
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
    // end ajax icon hapus table kelas klik
    // ajax tombol edit data table kelas klik
    $('.btn-edit-kelas').on('click', function (e) {
        e.preventDefault();
        const judul = document.getElementById('judul-modal');
        judul.innerHTML = 'Ubah Data Tahun Ajaran';
        var id = $(this).data('id');
        $('#btn-simpan-kelas').hide();
        $('#id').attr('disabled', 'disabled');
        $.ajax({
            url: base_url + 'akademik/kelas/ajax_edit/' + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('[name="idubah"]').val(data.id);
                $('[name="kelas"]').val(data.kelas);
                $('[name="akademik_id"]').val(data.akademik_id);
                $('[name="prodi_id"]').val(data.prodi_id);
                $('[name="tingkat_id"]').val(data.tingkat_id);
                $('#modal-kelas').modal('show');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    });
    //end ajax tombol edit data table kelas klik
    // ajax tombol modal ubah kelas
    $('#btn-ubah-kelas').on('click', function (e) {
        e.preventDefault();
        const idubah = $('[name="idubah"]').val();
        const kelas = $('[name="kelas"]').val();
        const prodi_id = $('[name="prodi_id"]').val();
        const akademik_id = $('[name="akademik_id"]').val();
        const tingkat_id = $('[name="tingkat_id"]').val();
        $.ajax({
            type: "POST",
            url: base_url + "akademik/kelas/ubah/" + idubah,
            data: {
                idubah: idubah,
                kelas: kelas,
                prodi_id: prodi_id,
                akademik_id: akademik_id,
                tingkat_id: tingkat_id
            },
            dataType: 'JSON',
            beforeSend: function () {
                $('#btn-ubah-kelas').attr('disabled', 'disabled');
            },
            success: function (data) {
                if (data.status == 'gagal') {
                    Toast.fire({
                        type: 'error',
                        title: ' Input data tidak valid!!!.'
                    });
                    if (data.kelas_error != '') {
                        $('#kelas_error').html(data.kelas_error);
                    } else {
                        $('#kelas_error').html('');
                    }
                    if (data.akademik_error != '') {
                        $('#akademik_error').html(data.akademik_error);
                    } else {
                        $('#akademik_error').html('');
                    }
                    if (data.prodi_error != '') {
                        $('#prodi_error').html(data.prodi_error);
                    } else {
                        $('#prodi_error').html('');
                    }
                    if (data.tingkat_error != '') {
                        $('#tingkat_error').html(data.tingkat_error);
                    } else {
                        $('#tingkat_error').html('');
                    }
                    $('#kelas').trigger('focus');
                } else {
                    Toast.fire({
                        type: 'success',
                        title: ' Data berhasil diubah!'
                    });
                    $('#modal-kelas').modal('hide');
                    //dataTable.ajax.reload();
                }
                $('#btn-ubah-kelas').attr('disabled', false);
            }
        });
        return false;
    });
    // end ajax tombol modal ubah kelas




    // ---------------------/TES---------------------------
});

// cek data
  // $('#btn-simpan-level6').on('click', function (e) {
    //     e.preventDefault();
    //     const a5level_id = $('[name="a5level_id"]').val();
    //     const kode6 = $('[name="kode6"]').val();
    //     const idubah6 = $('[name="idubah6"]').val();
    //     const level6 = $('[name="level6"]').val();
    //     const posisi = $('[name="posisi"]').val();
    //     const institusi_id = $('[name="institusi_id"]').val();
    //     const id = a5level_id + '.' + kode6;
    //     Toast.fire({
    //         type: 'success',
    //         title: ' Datanya ' + id + "-" + a5level_id + "-" + kode6 + "-" + idubah6 + "-" + level6 + "-" + posisi + "-" + institusi_id + "-"
    //     });
    // });
// cek data

// Toast.fire({
//     type: 'error',
//     title: ' Input data tidak valid!!!.'
// });
//set focus input level5 saat modal muncul
// $('#modal-level5').on('shown.bs.modal', function () {
//     $('#kode5').trigger('focus');
// })
//set focus input level5 saat modal muncul
    // tombol tambah level6 table
    // $('.btn-tambah-level6').on('click', function (e) {
    //     e.preventDefault();
    //     const info = $(this).data('info');
    //     const id5 = $(this).data('id5');
    //     const judul = document.getElementById('judul-modal-level6');
    //     judul.innerHTML = 'Tambah Akun ' + info;
    //     const kode5 = document.getElementById('kd5');
    //     kd5.innerHTML = id5 + ".";
    //     $('[name="a5level_id"]').val(id5);
    //     $('#btn-ubah-level6').hide();
    //     $('#modal-level6').modal('show');
    // });
    // end tombol tambah level6 table
    // btn simpan level5 modal
    // $('#btn-simpan-level5').on('click', function (e) {
    //     e.preventDefault();
    //     const a4level_id = $('[name="a4level_id"]').val();
    //     const kode5 = $('[name="kode5"]').val();
    //     const idubah5 = $('[name="idubah5"]').val();
    //     const level5 = $('[name="level5"]').val();
    //     const id = a4level_id + '.' + kode5;
    //     $.ajax({
    //         type: "POST",
    //         url: base_url + "akuntansi/kodeperkiraan/simpanakun5",
    //         data: {
    //             id: id,
    //             a4level_id: a4level_id,
    //             kode5: kode5,
    //             idubah5: idubah5,
    //             level5: level5
    //         },
    //         dataType: "JSON",
    //         beforeSend: function () {
    //             $('#btn-simpan-level5').attr('disabled', 'disabled');
    //         },
    //         success: function (data) {
    //             if (data.status == 'gagal') {
    //                 Toast.fire({
    //                     type: 'error',
    //                     title: ' Input data tidak valid!!!.'
    //                 });
    //                 if (data.kode5_error != '') {
    //                     $('#kode5_error').html(data.kode5_error);
    //                 } else {
    //                     $('#kode5_error').html('');
    //                 }
    //                 if (data.level5_error != '') {
    //                     $('#level5_error').html(data.level5_error);
    //                 } else {
    //                     $('#level5_error').html('');
    //                 }
    //                 $('#kode5').trigger('focus');
    //             } else {
    //                 Toast.fire({
    //                     type: 'success',
    //                     title: ' Data berhasil disimpan.'
    //                 });
    //                 $('#modal-level5').modal('hide');
    //             }
    //             $('#btn-simpan-level5').attr('disabled', false);
    //         }
    //     });
    //     return false;

    // });
    // end btn simpan level5 modal

// ajax icon hapus table level6 klik
// $('.btn-hapus-level6').on('click', function (e) {
//     e.preventDefault();
//     var id = $(this).data('id');
//     var info = $(this).data('info');
//     Swal.fire({
//         title: 'Konfirmasi!',
//         text: 'Apakah anda yakin akan menghapus Akun -' + info + '- !?!',
//         type: 'warning',
//         showCancelButton: true,
//         confirmButtonColor: '#3085d6',
//         cancelButtonColor: '#d33',
//         cancelButtonText: 'Batal',
//         confirmButtonText: 'Hapus'
//     }).then((result) => {
//         if (result.value) {
//             $.ajax({
//                 type: "POST",
//                 url: base_url + "akuntansi/kodeperkiraan/hapusakun6/",
//                 data: {
//                     id: id,
//                     info: info
//                 },
//                 dataType: 'JSON',
//                 success: function (data) {
//                     if (data.status == 'sukses') {
//                         Toast.fire({
//                             type: 'success',
//                             title: ' Data berhasil dihapus!!!.'
//                         });
//                         document.location.reload();
//                     } else {
//                         Toast.fire({
//                             type: 'warning',
//                             title: ' Penghapusan dibatalkan, data sedang digunakan oleh system!!!.'
//                         });
//                     }
//                 }
//             });
//         }
//     })
// });
// end ajax icon hapus table level6 klik


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

        // btn-aktif-jenistransaksi
    // $('.btn-aktif-tahunanggaran').on('click', function (e) {
    //     e.preventDefault();
    //     var id = $(this).data('id');
    //     var info = $(this).data('info');
    //     var aktif = $(this).data('aktif');
    //     if (aktif == 0) {
    //         Swal.fire({
    //             title: 'Konfirmasi!',
    //             text: 'Apakah anda yakin akan mengaktifkan Tahun Anggaran -' + info + '- !?!',
    //             type: 'warning',
    //             showCancelButton: true,
    //             confirmButtonColor: '#3085d6',
    //             cancelButtonColor: '#d33',
    //             cancelButtonText: 'Batal',
    //             confirmButtonText: 'Aktif'
    //         }).then((result) => {
    //             if (result.value) {
    //                 $.ajax({
    //                     url: base_url + "akuntansi/tahunanggaran/tahunaktif",
    //                     data: {
    //                         id: id,
    //                         info: info
    //                     },
    //                     type: "POST",
    //                     //dataType: 'JSON',
    //                     success: function () {
    //                         Toast.fire({
    //                             type: 'success',
    //                             title: ' Tahun' + info + ' berhasil diaktifkan!'
    //                         });
    //                         document.location.reload();
    //                     }
    //                 });
    //             }
    //         })
    //     }
    // });
    // end btn-aktif-tahunanggaran
    // ajax tombol modal ubah jenistransaksi
    // $('#btn-ubah-jenistransaksi').on('click', function (e) {
    //     e.preventDefault();
    //     const idubah = $('[name="idubah"]').val();
    //     const jenis_transaksi = $('[name="jenis_transaksi"]').val();
    //     $.ajax({
    //         type: "POST",
    //         url: base_url + "akuntansi/jenistransaksi/ubah/" + idubah,
    //         data: {
    //             idubah: idubah,
    //             jenis_transaksi: jenis_transaksi
    //         },
    //         dataType: 'JSON',
    //         beforeSend: function () {
    //             $('#btn-ubah-jenistransaksi').attr('disabled', 'disabled');
    //         },
    //         success: function (data) {
    //             if (data.status == 'gagal') {
    //                 Toast.fire({
    //                     type: 'error',
    //                     title: ' Input data tidak valid!!!.'
    //                 });
    //                 if (data.jenis_transaksi_error != '') {
    //                     $('#jenis_transaksi_error').html(data.jenis_transaksi_error);

    //                 } else {
    //                     $('#jenis_transaksi_error').html('');
    //                 }
    //                 $('#jenis_transaksi').trigger('focus');
    //             } else {
    //                 Toast.fire({
    //                     type: 'success',
    //                     title: ' Data berhasil diubah!'
    //                 });
    //                 $('#modal-jenistransaksi').modal('hide');
    //                 //dataTable.ajax.reload();
    //             }
    //             $('#btn-ubah-jenistransaksi').attr('disabled', false);
    //         }
    //     });
    //     return false;
    // });
    // end ajax tombol modal ubah jenistransaksi

      // ajax tombol edit data table level5 klik
    //   $('.btn-edit-level5').on('click', function (e) {
    //     e.preventDefault();
    //     const judul = document.getElementById('judul-modal');
    //     judul.innerHTML = 'Ubah Data Kode Perkiraan';
    //     const kode4 = document.getElementById('kode4');
    //     kode4.innerHTML = $(this).data('id4') + ".";
    //     var id = $(this).data('id');
    //     $('#btn-simpan-level5').hide();
    //     $('#kode5').attr('disabled', 'disabled');
    //     $.ajax({
    //         url: base_url + 'akuntansi/kodeperkiraan/ajax_edit5/' + id,
    //         type: "GET",
    //         dataType: "JSON",
    //         success: function (data) {
    //             $('[name="a4level_id"]').val(data.a4level_id);
    //             $('[name="idubah5"]').val(data.id);
    //             $('[name="kode5"]').val(data.kode5);
    //             $('[name="level5"]').val(data.level5);
    //             $('#modal-level5').modal('show');
    //             $('#level5').trigger('focus');
    //         },
    //         error: function (jqXHR, textStatus, errorThrown) {
    //             alert('Error get data from ajax');
    //         }
    //     });
    // });
    //end ajax tombol edit data table level5 klik