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

    //set focus input mahasiswa saat modal muncul
    $('#modal-mahasiswa').on('shown.bs.modal', function () {
        $('#nim').trigger('focus');
    })
    //set focus input mahasiswa saat modal muncul
    // tombol tambah mahasiswa table
    $('#btn-tambah-mahasiswa').on('click', function (e) {
        e.preventDefault();
        const judul = document.getElementById('judul-modal');
        judul.innerHTML = 'Tambah Data Mahasiswa';
        $('#btn-ubah-mahasiswa').hide();
        $('#modal-mahasiswa').modal('show');
    });
    // end tombol tambah mahasiswa table
    // ajax tombol Simpan modal mahasiswa
    $('#btn-simpan-mahasiswa').on('click', function (e) {
        e.preventDefault();
        //const id = $('[name="id"]').val();
        const nim = $('[name="nim"]').val();
        const nama = $('[name="nama"]').val();
        const gender = $('[name="gender"]').val();
        const angkatan_id = $('[name="angkatan_id"]').val();
        $.ajax({
            type: "POST",
            url: base_url + "akademik/mahasiswa/simpan",
            data: {
                nim: nim,
                nama: nama,
                gender: gender,
                angkatan_id: angkatan_id
            },
            dataType: "JSON",
            beforeSend: function () {
                $('#btn-simpan-mahasiswa').attr('disabled', 'disabled');
            },
            success: function (data) {
                if (data.status == 'gagal') {
                    Toast.fire({
                        type: 'error',
                        title: ' Input data tidak valid!!!.'
                    });
                    if (data.nim_error != '') {
                        $('#nim_error').html(data.nim_error);
                    } else {
                        $('#nim_error').html('');
                    }
                    if (data.nama_error != '') {
                        $('#nama_error').html(data.nama_error);
                    } else {
                        $('#nama_error').html('');
                    }
                    if (data.gender_error != '') {
                        $('#gender_error').html(data.gender_error);
                    } else {
                        $('#gender_error').html('');
                    }
                    $('#nim').trigger('focus');
                } else {
                    Toast.fire({
                        type: 'success',
                        title: ' Data berhasil disimpan.'
                    });
                    $('#modal-mahasiswa').modal('hide');
                }
                $('#btn-simpan-mahasiswa').attr('disabled', false);
            }
        });
        return false;
    });
    //end  ajax tombol Simpan modal mahasiswa
    // ajax icon hapus table mahasiswa klik
    $('.btn-hapus-mahasiswa').on('click', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var info = $(this).data('info');
        Swal.fire({
            title: 'Konfirmasi!',
            text: 'Apakah anda yakin akan menghapus Mahasiswa -' + info + '- !?!',
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
                    url: base_url + "akademik/mahasiswa/hapus",
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
    // end ajax icon hapus table mahasiswa klik
    // ajax tombol edit data table mahasiswa klik
    $('.btn-edit-mahasiswa').on('click', function (e) {
        e.preventDefault();
        const judul = document.getElementById('judul-modal');
        judul.innerHTML = 'Ubah Data Tahun Ajaran';
        var id = $(this).data('id');
        $('#btn-simpan-mahasiswa').hide();
        $('#nim').attr('disabled', 'disabled');
        $.ajax({
            url: base_url + 'akademik/mahasiswa/ajax_edit/' + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('[name="idubah"]').val(data.id);
                $('[name="nim"]').val(data.nim);
                $('[name="nama"]').val(data.nama);
                $('[name="gender"]').val(data.gender);
                $('#modal-mahasiswa').modal('show');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    });
    //end ajax tombol edit data table mahasiswa klik
    // ajax tombol modal ubah mahasiswa
    $('#btn-ubah-mahasiswa').on('click', function (e) {
        e.preventDefault();
        const idubah = $('[name="idubah"]').val();
        const nim = $('[name="nim"]').val();
        const nama = $('[name="nama"]').val();
        const gender = $('[name="gender"]').val();
        $.ajax({
            type: "POST",
            url: base_url + "akademik/mahasiswa/ubah/" + idubah,
            data: {
                idubah: idubah,
                nim: nim,
                nama: nama,
                gender: gender
            },
            dataType: 'JSON',
            beforeSend: function () {
                $('#btn-ubah-mahasiswa').attr('disabled', 'disabled');
            },
            success: function (data) {
                if (data.status == 'gagal') {
                    Toast.fire({
                        type: 'error',
                        title: ' Input data tidak valid!!!.'
                    });
                    if (data.nim_error != '') {
                        $('#nim_error').html(data.nim_error);
                    } else {
                        $('#nim_error').html('');
                    }
                    if (data.nama_error != '') {
                        $('#nama_error').html(data.nama_error);
                    } else {
                        $('#nama_error').html('');
                    }
                    if (data.gender_error != '') {
                        $('#gender_error').html(data.gender_error);
                    } else {
                        $('#gender_error').html('');
                    }
                    $('#nim').trigger('focus');
                } else {
                    Toast.fire({
                        type: 'success',
                        title: ' Data berhasil diubah!'
                    });
                    $('#modal-mahasiswa').modal('hide');
                    //dataTable.ajax.reload();
                }
                $('#btn-ubah-mahasiswa').attr('disabled', false);
            }
        });
        return false;
    });
    // end ajax tombol modal ubah mahasiswa



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