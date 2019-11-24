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
    //set focus input level5 saat modal muncul
    $('#modal-level5').on('shown.bs.modal', function () {
        $('#kode5').trigger('focus');
    })
    //set focus input level5 saat modal muncul
    // tombol tambah level5 table
    $('.btn-tambah-level5').on('click', function (e) {
        e.preventDefault();
        const info = $(this).data('info');
        const id4 = $(this).data('id4');
        const judul = document.getElementById('judul-modal');
        judul.innerHTML = 'Tambah Akun ' + info;
        const kode4 = document.getElementById('kode4');
        kode4.innerHTML = id4 + ".";
        $('[name="a4level_id"]').val(id4);
        $('#btn-ubah-level5').hide();
        $('#modal-level5').modal('show');
    });
    // end tombol tambah level5 table
    // btn simpan level5 modal
    $('#btn-simpan-level5').on('click', function (e) {
        e.preventDefault();
        const a4level_id = $('[name="a4level_id"]').val();
        const kode5 = $('[name="kode5"]').val();
        const idubah5 = $('[name="idubah5"]').val();
        const level5 = $('[name="level5"]').val();
        const id = a4level_id + '.' + kode5;
        // const a4level_id = $('[name="a4level_id"]').val();
        // Toast.fire({
        //     type: 'success',
        //     title: a4level_id + "." + kode5 + "-" + level5
        // });
        $.ajax({
            type: "POST",
            url: base_url + "akuntansi/kodeperkiraan/simpanakun5",
            data: {
                id: id,
                a4level_id: a4level_id,
                kode5: kode5,
                idubah5: idubah5,
                level5: level5
            },
            dataType: "JSON",
            beforeSend: function () {
                $('#btn-simpan-level5').attr('disabled', 'disabled');
            },
            success: function (data) {
                if (data.status == 'gagal') {
                    Toast.fire({
                        type: 'error',
                        title: ' Input data tidak valid!!!.'
                    });
                    if (data.kode5_error != '') {
                        $('#kode5_error').html(data.kode5_error);
                    } else {
                        $('#kode5_error').html('');
                    }
                    if (data.level5_error != '') {
                        $('#level5_error').html(data.level5_error);
                    } else {
                        $('#level5_error').html('');
                    }
                    $('#kode5').trigger('focus');
                } else {
                    Toast.fire({
                        type: 'success',
                        title: ' Data berhasil disimpan.'
                    });
                    $('#modal-level5').modal('hide');
                }
                $('#btn-simpan-level5').attr('disabled', false);
            }
        });
        return false;

    });
    // end btn simpan level5 modal
    //set focus input level6 saat modal muncul
    $('#modal-level6').on('shown.bs.modal', function () {
        $('#kode6').trigger('focus');
    })
    //set focus input level6 saat modal muncul
    // tombol tambah level6 table
    $('.btn-tambah-level6').on('click', function (e) {
        e.preventDefault();
        const info = $(this).data('info');
        const id5 = $(this).data('id5');
        const judul = document.getElementById('judul-modal-level6');
        judul.innerHTML = 'Tambah Akun ' + info;
        const kode5 = document.getElementById('kd5');
        kd5.innerHTML = id5 + ".";
        $('[name="a5level_id"]').val(id5);
        $('#btn-ubah-level6').hide();
        $('#modal-level6').modal('show');
    });
    // end tombol tambah level6 table
    // btn simpan level6 modal
    $('#btn-simpan-level6').on('click', function (e) {
        e.preventDefault();
        const a5level_id = $('[name="a5level_id"]').val();
        const kode6 = $('[name="kode6"]').val();
        const idubah6 = $('[name="idubah6"]').val();
        const level6 = $('[name="level6"]').val();
        const posisi = $('[name="posisi"]').val();
        const institusi_id = $('[name="institusi_id"]').val();
        const id = a5level_id + '.' + kode6;
        $.ajax({
            type: "POST",
            url: base_url + "akuntansi/kodeperkiraan/simpanakun6",
            data: {
                id: id,
                a5level_id: a5level_id,
                kode6: kode6,
                level6: level6,
                posisi: posisi,
                institusi_id: institusi_id
            },
            dataType: "JSON",
            beforeSend: function () {
                $('#btn-simpan-level6').attr('disabled', 'disabled');
            },
            success: function (data) {
                if (data.status == 'gagal') {
                    Toast.fire({
                        type: 'error',
                        title: ' Input data tidak valid!!!.'
                    });
                    if (data.kode6_error != '') {
                        $('#kode6_error').html(data.kode6_error);
                    } else {
                        $('#kode6_error').html('');
                    }
                    if (data.level6_error != '') {
                        $('#level6_error').html(data.level6_error);
                    } else {
                        $('#level6_error').html('');
                    }
                    if (data.posisi_error != '') {
                        $('#posisi_error').html(data.posisi_error);
                    } else {
                        $('#posisi_error').html('');
                    }
                    if (data.institusi_error != '') {
                        $('#institusi_error').html(data.institusi_error);
                    } else {
                        $('#institusi_error').html('');
                    }
                    $('#kode6').trigger('focus');
                } else {
                    Toast.fire({
                        type: 'success',
                        title: ' Data berhasil disimpan.'
                    });
                    $('#modal-level6').modal('hide');
                }
                $('#btn-simpan-level6').attr('disabled', false);
            }
        });
        return false;
    });
    // end btn simpan level5 modal
    // ajax icon hapus table level5 klik
    $('.btn-hapus-level5').on('click', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var info = $(this).data('info');
        Swal.fire({
            title: 'Konfirmasi!',
            text: 'Apakah anda yakin akan menghapus Akun -' + info + '- !?!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Batal',
            confirmButtonText: 'Hapus'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: base_url + "akuntansi/kodeperkiraan/hapusakun5/",
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
    // end ajax icon hapus table level5 klik
    // ajax icon hapus table level6 klik
    $('.btn-hapus-level6').on('click', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var info = $(this).data('info');
        Swal.fire({
            title: 'Konfirmasi!',
            text: 'Apakah anda yakin akan menghapus Akun -' + info + '- !?!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Batal',
            confirmButtonText: 'Hapus'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: base_url + "akuntansi/kodeperkiraan/hapusakun6/",
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
    // end ajax icon hapus table level6 klik
    // ajax tombol edit data table level5 klik
    $('.btn-edit-level5').on('click', function (e) {
        e.preventDefault();
        const judul = document.getElementById('judul-modal');
        judul.innerHTML = 'Ubah Data Kode Perkiraan';
        const kode4 = document.getElementById('kode4');
        kode4.innerHTML = $(this).data('id4') + ".";
        var id = $(this).data('id');
        $('#btn-simpan-level5').hide();
        $('#kode5').attr('disabled', 'disabled');
        $.ajax({
            url: base_url + 'akuntansi/kodeperkiraan/ajax_edit5/' + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('[name="a4level_id"]').val(data.a4level_id);
                $('[name="idubah5"]').val(data.id);
                $('[name="kode5"]').val(data.kode5);
                $('[name="level5"]').val(data.level5);
                $('#modal-level5').modal('show');
                $('#level5').trigger('focus');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    });
    //end ajax tombol edit data table level5 klik
    // ajax tombol edit data table level6 klik
    $('.btn-edit-level6').on('click', function (e) {
        e.preventDefault();
        const judul = document.getElementById('judul-modal-level6');
        judul.innerHTML = 'Ubah Data Kode Perkiraan';
        const kode5 = document.getElementById('kd5');
        kode5.innerHTML = $(this).data('id5') + ".";
        var id = $(this).data('id');
        $('#btn-simpan-level6').hide();
        $('#kode6').attr('disabled', 'disabled');
        $.ajax({
            url: base_url + 'akuntansi/kodeperkiraan/ajax_edit6/' + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('[name="a5level_id"]').val(data.a5level_id);
                $('[name="idubah6"]').val(data.id);
                $('[name="kode6"]').val(data.kode6);
                $('[name="level6"]').val(data.level6);
                $('[name="posisi"]').val(data.posisi);
                $('[name="institusi_id"]').val(data.institusi_id);
                $('#modal-level6').modal('show');
                $('#level6').trigger('focus');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    });
    //end ajax tombol edit data table level6 klik
    // ajax tombol modal ubah level5
    $('#btn-ubah-level5').on('click', function (e) {
        e.preventDefault();
        const idubah5 = $('[name="idubah5"]').val();
        const level5 = $('[name="level5"]').val();
        $.ajax({
            type: "POST",
            url: base_url + "akuntansi/kodeperkiraan/ubahakun5/" + idubah5,
            data: {
                idubah5: idubah5,
                level5: level5
            },
            dataType: 'JSON',
            beforeSend: function () {
                $('#btn-ubah-level5').attr('disabled', 'disabled');
            },
            success: function (data) {
                if (data.status == 'gagal') {
                    Toast.fire({
                        type: 'error',
                        title: ' Input data tidak valid!!!.'
                    });
                    if (data.level5_error != '') {
                        $('#level5_error').html(data.level5_error);

                    } else {
                        $('#level5_error').html('');
                    }
                    $('#level5').trigger('focus');
                } else {
                    Toast.fire({
                        type: 'success',
                        title: ' Data berhasil diubah!'
                    });
                    $('#modal-level5').modal('hide');
                    //dataTable.ajax.reload();
                }
                $('#btn-ubah-level5').attr('disabled', false);
            }
        });
        return false;
    });
    // end ajax tombol modal ubah level5
    // ajax tombol modal ubah level6
    $('#btn-ubah-level6').on('click', function (e) {
        e.preventDefault();
        const idubah6 = $('[name="idubah6"]').val();
        const level6 = $('[name="level6"]').val();
        const posisi = $('[name="posisi"]').val();
        const institusi_id = $('[name="institusi_id"]').val();
        $.ajax({
            type: "POST",
            url: base_url + "akuntansi/kodeperkiraan/ubahakun6/" + idubah6,
            data: {
                idubah6: idubah6,
                level6: level6,
                posisi: posisi,
                institusi_id: institusi_id
            },
            dataType: 'JSON',
            beforeSend: function () {
                $('#btn-ubah-level6').attr('disabled', 'disabled');
            },
            success: function (data) {
                if (data.status == 'gagal') {
                    Toast.fire({
                        type: 'error',
                        title: ' Input data tidak valid!!!.'
                    });
                    if (data.kode6_error != '') {
                        $('#kode6_error').html(data.kode6_error);
                    } else {
                        $('#kode6_error').html('');
                    }
                    if (data.level6_error != '') {
                        $('#level6_error').html(data.level6_error);
                    } else {
                        $('#level6_error').html('');
                    }
                    if (data.posisi_error != '') {
                        $('#posisi_error').html(data.posisi_error);

                    } else {
                        $('#posisi_error').html('');
                    }
                    if (data.institusi_error != '') {
                        $('#institusi_error').html(data.institusi_error);

                    } else {
                        $('#institusi_error').html('');
                    }
                    $('#level6').trigger('focus');
                } else {
                    Toast.fire({
                        type: 'success',
                        title: ' Data berhasil diubah!'
                    });
                    $('#modal-level6').modal('hide');
                    //dataTable.ajax.reload();
                }
                $('#btn-ubah-level6').attr('disabled', false);
            }
        });
        return false;
    });
    // end ajax tombol modal ubah level6

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