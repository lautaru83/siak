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
    //set focus input unitanggaran saat modal muncul
    $('#modal-unitanggaran').on('shown.bs.modal', function () {
        $('#kodeunit').trigger('focus');
    })
    //set focus input unitanggaran saat modal muncul
    // tombol tambah unitanggaran table
    $('.btn-tambah-unitanggaran').on('click', function (e) {
        e.preventDefault();
        const info = $(this).data('info');
        const idkelompok = $(this).data('idkelompok');
        const judul = document.getElementById('judul-modal');
        judul.innerHTML = 'Tambah Akun ' + info;
        $('[name="kelompokanggaran_id"]').val(idkelompok);
        $('#btn-ubah-unitanggaran').hide();
        $('#modal-unitanggaran').modal('show');
    });
    // end tombol tambah unitanggaran table
    // btn simpan unitanggaran modal
    $('#btn-simpan-unitanggaran').on('click', function (e) {
        e.preventDefault();
        const kelompokanggaran_id = $('[name="kelompokanggaran_id"]').val();
        const kodeunit = $('[name="kodeunit"]').val();
        const idubahunit = $('[name="idubahunit"]').val();
        const unit_anggaran = $('[name="unit_anggaran"]').val();
        const id = kodeunit;
        $.ajax({
            type: "POST",
            url: base_url + "akuntansi/kodeanggaran/simpanunit",
            data: {
                id: id,
                kelompokanggaran_id: kelompokanggaran_id,
                kodeunit: kodeunit,
                idubahunit: idubahunit,
                unit_anggaran: unit_anggaran
            },
            dataType: "JSON",
            beforeSend: function () {
                $('#btn-simpan-unitanggaran').attr('disabled', 'disabled');
            },
            success: function (data) {
                if (data.status == 'gagal') {
                    Toast.fire({
                        type: 'error',
                        title: ' Input data tidak valid!!!.'
                    });
                    if (data.kodeunit_error != '') {
                        $('#kodeunit_error').html(data.kodeunit_error);
                    } else {
                        $('#kodeunit_error').html('');
                    }
                    if (data.unit_error != '') {
                        $('#unit_error').html(data.unit_error);
                    } else {
                        $('#unit_error').html('');
                    }
                    $('#kodeunit').trigger('focus');
                } else {
                    Toast.fire({
                        type: 'success',
                        title: ' Data berhasil disimpan.'
                    });
                    $('#modal-unitanggaran').modal('hide');
                }
                $('#btn-simpan-unitanggaran').attr('disabled', false);
            }
        });
        return false;

    });
    // end btn simpan unitanggaran modal
    // ajax icon hapus table unitanggaran klik
    $('.btn-hapus-unitanggaran').on('click', function (e) {
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
                    url: base_url + "akuntansi/kodeanggaran/hapusunit/",
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
    // end ajax icon hapus table unitanggaran klik
    // ajax tombol edit data table unitanggaran klik
    $('.btn-edit-unitanggaran').on('click', function (e) {
        e.preventDefault();
        const judul = document.getElementById('judul-modal');
        judul.innerHTML = 'Ubah Data Akun Anggaran';
        var id = $(this).data('id');
        $('#btn-simpan-unitanggaran').hide();
        $('#kodeunit').attr('disabled', 'disabled');
        $.ajax({
            url: base_url + 'akuntansi/kodeanggaran/ajax_editunit/' + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('[name="kelompokanggaran_id"]').val(data.kelompokanggaran_id);
                $('[name="idubahunit"]').val(data.id);
                $('[name="kodeunit"]').val(data.id);
                $('[name="unit_anggaran"]').val(data.unit_anggaran);
                $('#modal-unitanggaran').modal('show');
                $('#unit_anggaran').trigger('focus');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    });
    //end ajax tombol edit data table unitanggaran klik
    // ajax tombol modal ubah unitanggaran
    $('#btn-ubah-unitanggaran').on('click', function (e) {
        e.preventDefault();
        const idubahunit = $('[name="idubahunit"]').val();
        const unit_anggaran = $('[name="unit_anggaran"]').val();
        $.ajax({
            type: "POST",
            url: base_url + "akuntansi/kodeanggaran/ubahunit/" + idubahunit,
            data: {
                idubahunit: idubahunit,
                unit_anggaran: unit_anggaran
            },
            dataType: 'JSON',
            beforeSend: function () {
                $('#btn-ubah-unitanggaran').attr('disabled', 'disabled');
            },
            success: function (data) {
                if (data.status == 'gagal') {
                    Toast.fire({
                        type: 'error',
                        title: ' Input data tidak valid!!!.'
                    });
                    if (data.unit_error != '') {
                        $('#unit_error').html(data.unit_error);
                    } else {
                        $('#unit_error').html('');
                    }
                    $('#unit_anggaran').trigger('focus');
                } else {
                    Toast.fire({
                        type: 'success',
                        title: ' Data berhasil diubah!'
                    });
                    $('#modal-unitanggaran').modal('hide');
                    //dataTable.ajax.reload();
                }
                $('#btn-ubah-unitanggaran').attr('disabled', false);
            }
        });
        return false;
    });
    // end ajax tombol modal ubah unitanggaran
    //set focus input anggaran saat modal muncul
    $('#modal-anggaran').on('shown.bs.modal', function () {
        $('#kodeanggaran').trigger('focus');
    })
    //set focus input anggaran saat modal muncul
    // tombol tambah anggaran table
    $('.btn-tambah-anggaran').on('click', function (e) {
        e.preventDefault();
        const info = $(this).data('info');
        const idunit = $(this).data('idunit');
        const judul = document.getElementById('judul-modal-anggaran');
        judul.innerHTML = 'Tambah Akun ' + info;
        const kodeUnit = document.getElementById('kdunit');
        kodeUnit.innerHTML = idunit + ".";
        $('[name="unitanggaran_id"]').val(idunit);
        $('#btn-ubah-anggaran').hide();
        $('#modal-anggaran').modal('show');
    });
    // end tombol tambah anggaran table
    // btn simpan anggaran modal
    $('#btn-simpan-anggaran').on('click', function (e) {
        e.preventDefault();
        const unitanggaran_id = $('[name="unitanggaran_id"]').val();
        const kodeanggaran = $('[name="kodeanggaran"]').val();
        const idubahanggaran = $('[name="idubahanggaran"]').val();
        const nama_anggaran = $('[name="nama_anggaran"]').val();
        const posisi = $('[name="posisi"]').val();
        const institusi_id = $('[name="institusi_id"]').val();
        const id = unitanggaran_id + "." + kodeanggaran;
        $.ajax({
            type: "POST",
            url: base_url + "akuntansi/kodeanggaran/simpananggaran",
            data: {
                id: id,
                unitanggaran_id: unitanggaran_id,
                kodeanggaran: kodeanggaran,
                idubahanggaran: idubahanggaran,
                nama_anggaran: nama_anggaran,
                posisi: posisi,
                institusi_id: institusi_id
            },
            dataType: "JSON",
            beforeSend: function () {
                $('#btn-simpan-anggaran').attr('disabled', 'disabled');
            },
            success: function (data) {
                if (data.status == 'gagal') {
                    Toast.fire({
                        type: 'error',
                        title: ' Input data tidak valid!!!.'
                    });
                    if (data.kodeanggaran_error != '') {
                        $('#kodeanggaran_error').html(data.kodeanggaran_error);
                    } else {
                        $('#kodeanggaran_error').html('');
                    }
                    if (data.anggaran_error != '') {
                        $('#anggaran_error').html(data.anggaran_error);
                    } else {
                        $('#anggaran_error').html('');
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
                    $('#kodeanggaran').trigger('focus');
                } else {
                    Toast.fire({
                        type: 'success',
                        title: ' Data berhasil disimpan.'
                    });
                    $('#modal-anggaran').modal('hide');
                }
                $('#btn-simpan-anggaran').attr('disabled', false);
            }
        });
        return false;

    });
    // end btn simpan anggaran modal
    // ajax icon hapus table anggaran klik
    $('.btn-hapus-anggaran').on('click', function (e) {
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
                    url: base_url + "akuntansi/kodeanggaran/hapusanggaran",
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
    // end ajax icon hapus table anggaran klik
    // ajax tombol edit data table anggaran klik
    $('.btn-edit-anggaran').on('click', function (e) {
        e.preventDefault();
        const idunit = $(this).data('idunit');
        const judul = document.getElementById('judul-modal-anggaran');
        judul.innerHTML = 'Ubah Data Akun Anggaran';
        const kodeUnit = document.getElementById('kdunit');
        kodeUnit.innerHTML = idunit + ".";
        var id = $(this).data('id');
        $('#btn-simpan-anggaran').hide();
        $('#kodeanggaran').attr('disabled', 'disabled');
        $.ajax({
            url: base_url + 'akuntansi/kodeanggaran/ajax_editanggaran/' + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('[name="unitanggaran_id"]').val(data.unitanggaran_id);
                $('[name="idubahanggaran"]').val(data.id);
                $('[name="kodeanggaran"]').val(data.kode);
                $('[name="nama_anggaran"]').val(data.nama_anggaran);
                $('[name="posisi"]').val(data.posisi);
                $('[name="institusi_id"]').val(data.institusi_id);
                $('#modal-anggaran').modal('show');
                $('#nama_anggaran').trigger('focus');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    });
    //end ajax tombol edit data table anggaran klik
    // ajax tombol modal ubah anggaran
    $('#btn-ubah-anggaran').on('click', function (e) {
        e.preventDefault();
        const idubahanggaran = $('[name="idubahanggaran"]').val();
        const nama_anggaran = $('[name="nama_anggaran"]').val();
        const posisi = $('[name="posisi"]').val();
        const institusi_id = $('[name="institusi_id"]').val();
        $.ajax({
            type: "POST",
            url: base_url + "akuntansi/kodeanggaran/ubahanggaran/" + idubahanggaran,
            data: {
                idubahanggaran: idubahanggaran,
                nama_anggaran: nama_anggaran,
                posisi: posisi,
                institusi_id: institusi_id
            },
            dataType: 'JSON',
            beforeSend: function () {
                $('#btn-ubah-anggaran').attr('disabled', 'disabled');
            },
            success: function (data) {
                if (data.status == 'gagal') {
                    Toast.fire({
                        type: 'error',
                        title: ' Input data tidak valid!!!.'
                    });
                    if (data.kodeanggaran_error != '') {
                        $('#kodeanggaran_error').html(data.kodeanggaran_error);
                    } else {
                        $('#kodeanggaran_error').html('');
                    }
                    if (data.anggaran_error != '') {
                        $('#anggaran_error').html(data.anggaran_error);
                    } else {
                        $('#anggaran_error').html('');
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
                    $('#nama_anggaran').trigger('focus');
                } else {
                    Toast.fire({
                        type: 'success',
                        title: ' Data berhasil diubah!'
                    });
                    $('#modal-anggaran').modal('hide');
                    //dataTable.ajax.reload();
                }
                $('#btn-ubah-anggaran').attr('disabled', false);
            }
        });
        return false;
    });
    // end ajax tombol modal ubah anggaran

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