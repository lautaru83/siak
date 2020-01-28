var tabelRole;
$(document).ready(function () {
    // $("input:text").focus();
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

    // tombol tambah rinciantransaksi table
    $('#btn-tambah-rinciankaskeluar').on('click', function (e) {
        e.preventDefault();
        const tran_id = $('[name="tran_id"]').val();
        if (tran_id == '') {
            Toast.fire({
                type: 'warning',
                title: ' Harap isi dan simpan form transaksi terlebih dahulu!!!.'
            });
        } else {
            const judul = document.getElementById('judul-modal');
            judul.innerHTML = 'Tambah Rincian Transaksi';
            $('#btn-ubah-detailkaskeluar').hide();
            $('#modal-kaskeluar').modal('show');
        }
    });
    // end tombol tambah rinciantransaksi table
    // tombol simpan detailkaskeluar table
    $('#btn-simpan-detailkaskeluar').on('click', function (e) {
        e.preventDefault();
        const transaksi_id = $('[name="transaksi_id"]').val();
        const a6level_id = $('[name="a6level_id"]').val();
        const posisi_akun = $('[name="posisi_akun"]').val();
        const idakun = $('[name="idakun"]').val();
        const idubah = $('[name="idubah"]').val();
        const jumlah = $('[name="jumlah"]').val();
        $.ajax({
            type: "POST",
            url: base_url + "akuntansi/kaskeluar/simpandetail",
            data: {
                idakun: idakun,
                idubah: idubah,
                transaksi_id: transaksi_id,
                a6level_id: a6level_id,
                posisi_akun: posisi_akun,
                jumlah: jumlah
            },
            dataType: "JSON",
            beforeSend: function () {
                $('#btn-simpan-detailkaskeluar').attr('disabled', 'disabled');
            },
            success: function (data) {
                if (data.status == 'gagal') {
                    Toast.fire({
                        type: 'error',
                        title: ' Input data tidak valid!!!.'
                    });
                    if (data.akun_error != '') {
                        $('#akun_error').html(data.akun_error);
                    } else {
                        $('#akun_error').html('');
                    }
                    if (data.posisi_error != '') {
                        $('#posisi_error').html(data.posisi_error);
                    } else {
                        $('#posisi_error').html('');
                    }
                    if (data.jumlah_error != '') {
                        $('#jumlah_error').html(data.jumlah_error);
                    } else {
                        $('#jumlah_error').html('');
                    }

                    $('#a6level_id').trigger('focus');
                } else {
                    //$('#btn-simpan-transaksi').attr('disabled', false);
                    Toast.fire({
                        type: 'success',
                        title: ' Data berhasil disimpan!'
                    });
                    document.location.reload();
                    //$('#modal-kaskeluar').modal('show');
                }
                $('#btn-simpan-detailkaskeluar').attr('disabled', false);
            }
        });
        return false;


    });
    // end tombol simpan detailkaskeluar table
    // tombol ubah detailtransaksi table
    $('#btn-ubah-detailkaskeluar').on('click', function (e) {
        e.preventDefault();
        const idubah = $('[name="idubah"]').val();
        const transaksi_id = $('[name="transaksi_id"]').val();
        const a6level_id = $('[name="a6level_id"]').val();
        const idakun = $('[name="idakun"]').val();
        const posisi_akun = $('[name="posisi_akun"]').val();
        const jumlah = $('[name="jumlah"]').val();
        $.ajax({
            type: "POST",
            url: base_url + "akuntansi/kaskeluar/ubahdetail/" + idubah,
            data: {
                idubah: idubah,
                idakun: idakun,
                transaksi_id: transaksi_id,
                a6level_id: a6level_id,
                posisi_akun: posisi_akun,
                jumlah: jumlah
            },
            dataType: "JSON",
            beforeSend: function () {
                $('#btn-ubah-detailkaskeluar').attr('disabled', 'disabled');
            },
            success: function (data) {
                if (data.status == 'gagal') {
                    Toast.fire({
                        type: 'error',
                        title: ' Input data tidak valid!!!.'
                    });
                    if (data.akun_error != '') {
                        $('#akun_error').html(data.akun_error);
                    } else {
                        $('#akun_error').html('');
                    }
                    if (data.posisi_error != '') {
                        $('#posisi_error').html(data.posisi_error);
                    } else {
                        $('#posisi_error').html('');
                    }
                    if (data.jumlah_error != '') {
                        $('#jumlah_error').html(data.jumlah_error);
                    } else {
                        $('#jumlah_error').html('');
                    }

                    $('#a6level_id').trigger('focus');
                } else {
                    //$('#btn-simpan-transaksi').attr('disabled', false);
                    Toast.fire({
                        type: 'success',
                        title: ' Data berhasil disimpan!'
                    });
                    //document.location.reload();
                    $('#modal-kaskeluar').modal('hide');
                }
                $('#btn-ubah-detailkaskeluar').attr('disabled', false);
            }
        });
        return false;

    });
    // end tombol ubah detailtransaksi table
    // ajax tombol edit data table kelas klik
    $('.btn-edit-detailkaskeluar').on('click', function (e) {
        e.preventDefault();
        const judul = document.getElementById('judul-modal');
        judul.innerHTML = 'Ubah Rincian Transaksi';
        var id = $(this).data('id');
        $('#btn-simpan-detailkaskeluar').hide();
        $('#id').attr('disabled', 'disabled');
        $.ajax({
            url: base_url + 'akuntansi/kaskeluar/ajax_editrincian/' + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('[name="idubah"]').val(data.id);
                $('[name="a6level_id"]').val(data.a6level_id);
                $('[name="idakun"]').val(data.a6level_id);
                $('[name="posisi_akun"]').val(data.posisi_akun);
                $('[name="jumlah"]').val(data.jumlah);
                $('#modal-kaskeluar').modal('show');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    });
    //end ajax tombol edit data table kelas klik
    // ajax icon hapus table rincian klik
    $('.btn-hapus-detailkaskeluar').on('click', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var info = $(this).data('info');
        Swal.fire({
            title: 'Konfirmasi!',
            text: 'Apakah anda yakin akan menghapus Rincian -' + info + '- !?!',
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
                    url: base_url + "akuntansi/kaskeluar/hapusrincian",
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
                                title: ' Penghapusan gagal!!!.'
                            });
                        }
                    }
                });
            }
        })
    });
    // end ajax icon hapus table rincian klik
    // tombol simpan kaskeluar
    $('#btn-simpan-kaskeluar').on('click', function (e) {
        e.preventDefault();
        const notran = $('[name="notran"]').val();
        const tahun_pembukuan_id = $('[name="tahun_pembukuan_id"]').val();
        const jurnal = $('[name="jurnal"]').val();
        const unit_id = $('[name="unit_id"]').val();
        const nobukti = $('[name="nobukti"]').val();
        const tanggal_transaksi = $('[name="tanggal_transaksi"]').val();
        const keterangan = $('[name="keterangan"]').val();
        const status = $(this).data('status');
        if (status == 0) {
            $.ajax({
                type: "POST",
                url: base_url + "akuntansi/kaskeluar/simpan",
                data: {
                    nobukti: nobukti,
                    tanggal_transaksi: tanggal_transaksi,
                    keterangan: keterangan,
                    unit_id: unit_id,
                    jurnal: jurnal,
                    notran: notran,
                    tahun_buku: tahun_pembukuan_id
                },
                dataType: "JSON",
                beforeSend: function () {
                    $('#btn-simpan-kaskeluar').attr('disabled', 'disabled');
                },
                success: function (data) {
                    if (data.status == 'gagal') {
                        Toast.fire({
                            type: 'error',
                            title: ' Input data tidak valid!!!.'
                        });
                        if (data.nobukti_error != '') {
                            $('#nobukti_error').html(data.nobukti_error);
                        } else {
                            $('#nobukti_error').html('');
                        }
                        if (data.keterangan_error != '') {
                            $('#keterangan_error').html(data.keterangan_error);
                        } else {
                            $('#keterangan_error').html('');
                        }
                        if (data.tanggal_error != '') {
                            $('#tanggal_error').html(data.tanggal_error);
                        } else {
                            $('#tanggal_error').html('');
                        }
                        if (data.unit_error != '') {
                            $('#unit_error').html(data.unit_error);
                        } else {
                            $('#unit_error').html('');
                        }

                        $('#nobukti').trigger('focus');
                    } else {
                        //$('#btn-simpan-transaksi').attr('disabled', false);
                        Toast.fire({
                            type: 'success',
                            title: ' Data berhasil disimpan!'
                        });
                        document.location.reload();
                        //$('#modal-kaskeluar').modal('show');
                    }
                    $('#btn-simpan-kaskeluar').attr('disabled', false);
                }
            });
            return false;
        } else {
            const transaksi_id = $('[name="tran_id"]').val();
            const unit_id = $('[name="unit_id"]').val();
            const nobukti = $('[name="nobukti"]').val();
            const tanggal_transaksi = $('[name="tanggal_transaksi"]').val();
            const keterangan = $('[name="keterangan"]').val();
            $.ajax({
                type: "POST",
                url: base_url + "akuntansi/kaskeluar/ubah/" + transaksi_id,
                data: {
                    nobukti: nobukti,
                    tanggal_transaksi: tanggal_transaksi,
                    keterangan: keterangan,
                    unit_id: unit_id
                },
                dataType: "JSON",
                beforeSend: function () {
                    $('#btn-simpan-kaskeluar').attr('disabled', 'disabled');
                },
                success: function (data) {
                    if (data.status == 'gagal') {
                        Toast.fire({
                            type: 'error',
                            title: ' Input data tidak valid!!!.'
                        });
                        if (data.nobukti_error != '') {
                            $('#nobukti_error').html(data.nobukti_error);
                        } else {
                            $('#nobukti_error').html('');
                        }
                        if (data.keterangan_error != '') {
                            $('#keterangan_error').html(data.keterangan_error);
                        } else {
                            $('#keterangan_error').html('');
                        }
                        if (data.tanggal_error != '') {
                            $('#tanggal_error').html(data.tanggal_error);
                        } else {
                            $('#tanggal_error').html('');
                        }
                        if (data.unit_error != '') {
                            $('#unit_error').html(data.unit_error);
                        } else {
                            $('#unit_error').html('');
                        }

                        $('#nobukti').trigger('focus');
                    } else {
                        //$('#btn-simpan-transaksi').attr('disabled', false);
                        Toast.fire({
                            type: 'success',
                            title: ' Data berhasil diubah!'
                        });
                        document.location.reload();
                        //$('#modal-kaskeluar').modal('show');
                    }
                    $('#btn-simpan-kaskeluar').attr('disabled', false);
                }
            });
            return false;
        }
    });
    // end tombol simpan kaskeluar
    // ajax icon selesai kaskeluar
    $('#btn-selesai-kaskeluar').on('click', function (e) {
        e.preventDefault();
        var transaksi_id = $(this).data('id');
        var total_transaksi = $(this).data('total');
        //var info = $(this).data('info');
        Swal.fire({
            title: 'Konfirmasi!',
            text: 'Apakah anda yakin data telah benar!?!' + total_transaksi,
            type: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Batal',
            confirmButtonText: 'Confirm'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: base_url + "akuntansi/kaskeluar/selesaitransaksi",
                    data: {
                        transaksi_id: transaksi_id,
                        total_transaksi: total_transaksi
                    },
                    dataType: 'JSON',
                    success: function (data) {
                        if (data.status == 'sukses') {
                            Toast.fire({
                                type: 'success',
                                title: ' Data berhasil disimpan!!!.'
                            });
                            document.location.reload();
                        } else {
                            Toast.fire({
                                type: 'warning',
                                title: ' Kesalahan dalam menyelesaikan transaksi!!!.'
                            });
                        }
                    }
                });
            }
        })
    });
    // end ajax icon selesai kaskeluar


    // ---------------------/TES---------------------------
});

        // Toast.fire({
        //     type: 'error',
        //     title: ' Input data tidak valid!!!.' + nobukti + '-' + tanggal_transaksi + '-' + notran + '-' + tahun_pembukuan_id + '-' + jurnal + '-' + unit_id + '-' + keterangan
        // });
// Toast.fire({
//     type: 'error',
//     title: ' simpan!!!.'
// });

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