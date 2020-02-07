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
    // --------------------------------------NERACA----------------------------
    $('#btn-tampil-neraca').on('click', function (e) {
        e.preventDefault();
        var laporan = $(this).data('laporan');
        var jenis = "";
        var idInstitusi = $(this).data('id');
        //const akhir_periode = $('[name="akhir_periode"]').val();
        const tanggal = $('[name="akhir_periode"]').val();
        // const buku_awal = $(this).data('tgl1');
        // const buku_akhir = $(this).data('tgl2');
        const ckKonsolidasi = document.getElementById("ckkonsolidasi");
        const ckKomparatif = document.getElementById("ckkomparatif");
        if (idInstitusi == '01') {
            if (ckKonsolidasi.checked == true && ckKomparatif.checked == false) {
                jenis = "3"; //konsolidasi
            } else if (ckKonsolidasi.checked == false && ckKomparatif.checked == true) {
                jenis = "2"; //komparatif
            } else if (ckKonsolidasi.checked == true && ckKomparatif.checked == true) {
                jenis = "4"; //konsolidasi komparatif
            } else {
                jenis = "1"; //institusi
            }
        } else {
            if (ckKomparatif.checked == true) {
                jenis = "2"; //komparatif
            } else {
                jenis = "1"; //institusi
            }
        }
        $.ajax({
            cache: false,
            type: "POST",
            url: base_url + "akuntansi/neraca/cekinput",
            data: {
                akhir_periode: tanggal
            },
            dataType: "JSON",
            beforeSend: function () {
                $('#btn-tampil-neraca').attr('disabled', 'disabled');
            },
            success: function (response) {
                if (response.status == 'gagal') {
                    Toast.fire({
                        type: 'warning',
                        title: 'Tanggal diluar periode pembukuan!!!'
                    });
                } else {
                    Toast.fire({
                        type: 'success',
                        title: ' Tampilkan laporan!!!.' + jenis
                    });
                    $.ajax({
                        type: "POST",
                        cache: false,
                        url: base_url + "akuntansi/neraca/viewdata",
                        data: {
                            akhir_periode: tanggal,
                            jenis: jenis
                        },
                        success: function (data) {
                            $("#data").html(data);
                        }
                    });
                }
                $('#btn-tampil-neraca').attr('disabled', false);
            }
        });
        return false;
    });
    // -------------------------------------/NERACA----------------------------
    // --------------------------------------AKTIVITAS-------------------------
    $('#btn-tampil-activitas').on('click', function (e) {
        e.preventDefault();
        var laporan = $(this).data('laporan');
        var jenis = "";
        var idInstitusi = $(this).data('id');
        //const akhir_periode = $('[name="akhir_periode"]').val();
        const tanggal = $('[name="akhir_periode"]').val();
        // const buku_awal = $(this).data('tgl1');
        // const buku_akhir = $(this).data('tgl2');
        const ckKonsolidasi = document.getElementById("ckkonsolidasi");
        const ckKomparatif = document.getElementById("ckkomparatif");
        if (idInstitusi == '01') {
            if (ckKonsolidasi.checked == true && ckKomparatif.checked == false) {
                jenis = "3"; //konsolidasi
            } else if (ckKonsolidasi.checked == false && ckKomparatif.checked == true) {
                jenis = "2"; //komparatif
            } else if (ckKonsolidasi.checked == true && ckKomparatif.checked == true) {
                jenis = "4"; //konsolidasi komparatif
            } else {
                jenis = "1"; //institusi
            }
        } else {
            if (ckKomparatif.checked == true) {
                jenis = "2"; //komparatif
            } else {
                jenis = "1"; //institusi
            }
        }
        $.ajax({
            cache: false,
            type: "POST",
            url: base_url + "akuntansi/activitas/cekinput",
            data: {
                akhir_periode: tanggal
            },
            dataType: "JSON",
            beforeSend: function () {
                $('#btn-tampil-laporanutama').attr('disabled', 'disabled');
            },
            success: function (response) {
                if (response.status == 'gagal') {
                    Toast.fire({
                        type: 'warning',
                        title: 'Tanggal diluar periode pembukuan!!!'
                    });
                } else {
                    $.ajax({
                        type: "POST",
                        cache: false,
                        url: base_url + "akuntansi/activitas/viewdata",
                        data: {
                            akhir_periode: tanggal,
                            jenis: jenis
                        },
                        success: function (data) {
                            $("#data").html(data);
                        }
                    });
                    // Toast.fire({
                    //     type: 'success',
                    //     title: ' Tampilkan laporan!!!. aaaaa' + jenis
                    // });
                }
                $('#btn-tampil-activitas').attr('disabled', false);
            }
        });
        return false;
    });
    // -------------------------------------/AKTIVITAS-------------------------
    // --------------------------------------PERUBAHAN ASET-------------------------
    $('#btn-tampil-perubahanaset').on('click', function (e) {
        e.preventDefault();
        var laporan = $(this).data('laporan');
        var jenis = "";
        var idInstitusi = $(this).data('id');
        //const akhir_periode = $('[name="akhir_periode"]').val();
        const tanggal = $('[name="akhir_periode"]').val();
        // const buku_awal = $(this).data('tgl1');
        // const buku_akhir = $(this).data('tgl2');
        const ckKonsolidasi = document.getElementById("ckkonsolidasi");
        const ckKomparatif = document.getElementById("ckkomparatif");
        if (idInstitusi == '01') {
            if (ckKonsolidasi.checked == true && ckKomparatif.checked == false) {
                jenis = "3"; //konsolidasi
            } else if (ckKonsolidasi.checked == false && ckKomparatif.checked == true) {
                jenis = "2"; //komparatif
            } else if (ckKonsolidasi.checked == true && ckKomparatif.checked == true) {
                jenis = "4"; //konsolidasi komparatif
            } else {
                jenis = "1"; //institusi
            }
        } else {
            if (ckKomparatif.checked == true) {
                jenis = "2"; //komparatif
            } else {
                jenis = "1"; //institusi
            }
        }
        $.ajax({
            cache: false,
            type: "POST",
            url: base_url + "akuntansi/perubahanaset/cekinput",
            data: {
                akhir_periode: tanggal
            },
            dataType: "JSON",
            beforeSend: function () {
                $('#btn-tampil-laporanutama').attr('disabled', 'disabled');
            },
            success: function (response) {
                if (response.status == 'gagal') {
                    Toast.fire({
                        type: 'warning',
                        title: 'Tanggal diluar periode pembukuan!!!'
                    });
                } else {
                    $.ajax({
                        type: "POST",
                        cache: false,
                        url: base_url + "akuntansi/perubahanaset/viewdata",
                        data: {
                            akhir_periode: tanggal,
                            jenis: jenis
                        },
                        success: function (data) {
                            $("#data").html(data);
                        }
                    });
                    // Toast.fire({
                    //     type: 'success',
                    //     title: ' Tampilkan laporan!!!. aaaaa' + jenis
                    // });
                }
                $('#btn-tampil-perubahanaset').attr('disabled', false);
            }
        });
        return false;
    });
    // -------------------------------------/PERUBAHAN ASET-------------------------
    // --------------------------------------PERUBAHAN ARUS-------------------------
    $('#btn-tampil-perubahanarus').on('click', function (e) {
        e.preventDefault();
        var laporan = $(this).data('laporan');
        var jenis = "";
        var idInstitusi = $(this).data('id');
        const tanggal = $('[name="akhir_periode"]').val();
        const ckKonsolidasi = document.getElementById("ckkonsolidasi");
        //const ckKomparatif = document.getElementById("ckkomparatif");
        if (idInstitusi == '01') {
            if (ckKonsolidasi.checked == true) {
                jenis = "2"; //konsolidasi
            } else {
                jenis = "1"; //institusi
            }
        } else {
            jenis = "1"; //institusi
        }
        $.ajax({
            cache: false,
            type: "POST",
            url: base_url + "akuntansi/perubahanarus/cekinput",
            data: {
                akhir_periode: tanggal
            },
            dataType: "JSON",
            beforeSend: function () {
                $('#btn-tampil-laporanutama').attr('disabled', 'disabled');
            },
            success: function (response) {
                if (response.status == 'gagal') {
                    Toast.fire({
                        type: 'warning',
                        title: 'Tanggal diluar periode pembukuan!!!'
                    });
                } else {
                    $.ajax({
                        type: "POST",
                        cache: false,
                        url: base_url + "akuntansi/perubahanarus/viewdata",
                        data: {
                            akhir_periode: tanggal,
                            jenis: jenis
                        },
                        success: function (data) {
                            $("#data").html(data);
                        }
                    });
                    Toast.fire({
                        type: 'success',
                        title: ' Tampilkan laporan!!!. aaaaa' + jenis
                    });
                }
                $('#btn-tampil-perubahanarus').attr('disabled', false);
            }
        });
        return false;
    });
    // -------------------------------------/PERUBAHAN ASET-------------------------
    // -------------------------------------/RAPB-------------------------
    $('.modal-akunanggaran').on('shown.bs.modal', function () {
        $('#a6level_id').trigger('focus');
    })
    // btn - tambah - rapb
    // tombol tambah rapb table
    $('#btn-tambah-rapb').on('click', function (e) {
        e.preventDefault();
        const th = $(this).data('th');
        const tahunanggaran_id = $(this).data('id');
        const judul = document.getElementById('judul-modal');
        judul.innerHTML = 'Tambah RAPB' + '   ' + th;
        $('#btn-ubah-rapb').hide();
        $('[name="tahunanggaran_id"]').val(tahunanggaran_id);
        $('#modal-rapb').modal('show');
    });

    // end tombol tambah rapb table
    // combo anggaran klik modal rencana anggaran
    $('#rapb-kelompok-id').change(function () {
        var kelompok_id = $('[name="kelompok_id"]').val();
        var anggaran_id = $('[name="idanggaran"]').val();
        if (kelompok_id != '') {
            $.ajax({
                cache: false,
                method: "POST",
                url: base_url + "akuntansi/rapb/anggarandata",
                data: {
                    kelompok_id: kelompok_id,
                    anggaran_id: anggaran_id
                },
                success: function (data) {
                    $("#rapb-anggaran-id").html(data);
                }

            });
        }
    });
    // end combo anggaran klik modal rencana anggaran
    // btn simpan rapb modal
    $('#btn-simpan-rapb').on('click', function (e) {
        e.preventDefault();
        const rencana = $('[name="rencana"]').val();
        const anggaran_id = $('[name="anggaran_id"]').val();
        const tahunanggaran_id = $('[name="tahunanggaran_id"]').val();
        const kelompok_id = $('[name="kelompok_id"]').val();
        const resaldo = $('[name="resaldo"]').val();
        const terealisasi = $('[name="terealisasi"]').val();
        const noref = $('[name="noref"]').val();
        $.ajax({
            type: "POST",
            url: base_url + "akuntansi/rapb/simpan",
            data: {
                rencana: rencana,
                anggaran_id: anggaran_id,
                kelompok_id: kelompok_id,
                tahunanggaran_id: tahunanggaran_id,
                resaldo: resaldo,
                terealisasi: terealisasi,
                noref: noref
            },
            dataType: "JSON",
            beforeSend: function () {
                $('#btn-simpan-rapb').attr('disabled', 'disabled');
            },
            success: function (data) {
                if (data.status == 'gagal') {
                    Toast.fire({
                        type: 'error',
                        title: ' Input data tidak valid!!!.' + rencana
                    });
                    if (data.rencana_error != '') {
                        $('#rencana_error').html(data.rencana_error);
                    } else {
                        $('#rencana_error').html('');
                    }
                    if (data.kelompok_error != '') {
                        $('#kelompok_error').html(data.kelompok_error);
                    } else {
                        $('#kelompok_error').html('');
                    }
                    if (data.anggaran_error != '') {
                        $('#anggaran_error').html(data.anggaran_error);
                    } else {
                        $('#anggaran_error').html('');
                    }
                    if (data.resaldo_error != '') {
                        $('#resaldo_error').html(data.resaldo_error);
                    } else {
                        $('#resaldo_error').html('');
                    }
                    $('#rencana').trigger('focus');
                } else {
                    Toast.fire({
                        type: 'success',
                        title: ' Data berhasil disimpan.'
                    });
                    $('#modal-rapb').modal('hide');
                }
                $('#btn-simpan-rapb').attr('disabled', false);
            }
        });
        return false;
    });
    // end btn simpan rapb modal
    // ajax icon hapus table rapb klik
    $('.btn-hapus-rapb').on('click', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var info = $(this).data('info');
        Swal.fire({
            title: 'Konfirmasi!',
            text: 'Apakah anda yakin akan menghapus RAPB -' + info + '- !?!',
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
                    url: base_url + "akuntansi/rapb/hapus/",
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
    // end ajax icon hapus table rapb klik
    //  ajax tombol edit data table rapb klik
    $('.btn-edit-rapb').on('click', function (e) {
        e.preventDefault();
        const judul = document.getElementById('judul-modal');
        judul.innerHTML = 'Ubah Data RAPB';
        var id = $(this).data('id');
        var idKel = $(this).data('idkel');
        var anggaran_id = $(this).data('idanggaran');
        //var alamat = base_url + 'akuntansi/rapb/ajax_edit/' + id + '/' + idKel;
        $('#btn-simpan-rapb').hide();
        $.ajax({
            url: base_url + 'akuntansi/rapb/ajax_edit',
            method: "POST",
            data: {
                id: id,
                kelompok_id: idKel
            },
            dataType: "JSON",
            success: function (data) {
                $('[name="idanggaran"]').val(data.anggaran_id);
                $('[name="kelompok_id"]').val(data.kelompok_id);
                $('[name="rencana"]').val(data.rencana);
                $('[name="idubah"]').val(data.id);
                //$('[name="anggaran_id"]').val(data.anggaran_id).trigger('change');
                $('[name="tahunanggaran_id"]').val(data.tahunanggaran_id);
                $('[name="resaldo"]').val(data.resaldo);
                $('[name="terealisasi"]').val(data.terealisasi);
                $('[name="noref"]').val(data.noref);
                //$('[name="anggaran_id"]').val(data.anggaran_id).trigger('change');
                // $('#modal-rapb').modal('show');
                // $('#rencana').trigger('focus');
                $.ajax({
                    url: base_url + "akuntansi/rapb/anggarandataedit",
                    method: "POST",
                    data: {
                        kelompok_id: idKel,
                        anggaran_id: anggaran_id
                    },
                    success: function (data2) {
                        $("#rapb-anggaran-id").html(data2);
                        $('#modal-rapb').modal('show');
                        $('#rencana').trigger('focus');
                    }
                })
            },
            error: function (jqXHR, textStatus, errorThrown) {
                // Toast.fire({
                //     type: 'success',
                //     title: ' simpan!!!.' + alamat
                // });
                alert('Error get data from ajax');
            }
        });
    });
    // end ajax tombol edit data table rapb klik
    // ajax tombol modal ubah rapb
    $('#btn-ubah-rapb').on('click', function (e) {
        e.preventDefault();
        const idubah = $('[name="idubah"]').val();
        const rencana = $('[name="rencana"]').val();
        const anggaran_id = $('[name="anggaran_id"]').val();
        const tahunanggaran_id = $('[name="tahunanggaran_id"]').val();
        const kelompok_id = $('[name="kelompok_id"]').val();
        const resaldo = $('[name="resaldo"]').val();
        const terealisasi = $('[name="terealisasi"]').val();
        const noref = $('[name="noref"]').val();
        $.ajax({
            type: "POST",
            url: base_url + "akuntansi/rapb/ubah",
            data: {
                idubah: idubah,
                rencana: rencana,
                anggaran_id: anggaran_id,
                kelompok_id: kelompok_id,
                tahunanggaran_id: tahunanggaran_id,
                resaldo: resaldo,
                terealisasi: terealisasi,
                noref: noref
            },
            dataType: 'JSON',
            beforeSend: function () {
                $('#btn-ubah-rapb').attr('disabled', 'disabled');
            },
            success: function (data) {
                if (data.status == 'gagal') {
                    Toast.fire({
                        type: 'error',
                        title: ' Input data tidak valid!!!.'
                    });
                    if (data.rencana_error != '') {
                        $('#rencana_error').html(data.rencana_error);
                    } else {
                        $('#rencana_error').html('');
                    }
                    if (data.kelompok_error != '') {
                        $('#kelompok_error').html(data.kelompok_error);
                    } else {
                        $('#kelompok_error').html('');
                    }
                    if (data.anggaran_error != '') {
                        $('#anggaran_error').html(data.anggaran_error);
                    } else {
                        $('#anggaran_error').html('');
                    }
                    if (data.resaldo_error != '') {
                        $('#resaldo_error').html(data.resaldo_error);
                    } else {
                        $('#resaldo_error').html('');
                    }
                    $('#rencana').trigger('focus');
                } else {
                    Toast.fire({
                        type: 'success',
                        title: ' Data berhasil diubah!'
                    });
                    $('#modal-rapb').modal('hide');
                    //dataTable.ajax.reload();
                }
                $('#btn-ubah-rapb').attr('disabled', false);
            }
        });
        return false;
    });
    // end ajax tombol modal ubah rapb


    // -------------------------------------/RAPB-------------------------








    // ---------------------/TES---------------------------
});
 // $('#btn-tes-modal').on('click', function (e) {
    //     e.preventDefault();
    //     $('#modal-rapb-pendapatan').modal('show');
    // });
// error: function (jqXHR, textStatus, errorThrown) {
//     alert('Error get data from ajax');
// }
//------PENTING 
// onclick="return false;" // fungsi pada tag html untuk disable aksi
//------PENTING 
//------LOAD VIEW 
// $.ajax({
        //     type: "POST",
        //     cache: false,
        //     url: base_url + "akuntansi/neraca/viewdata",
        //     data: {
        //         tanggal: tanggal
        //     },
        //     success: function (data) {
        //         $("#data").html(data);
        //     }
        // });

//------LOAD VIEW AJAX
// if (data.success){
//     $("#divid").load(" #divid");
//      }

        // Toast.fire({
        //     type: 'error',
        //     title: ' Input data tidak valid!!!.' + nobukti + '-' + tanggal_transaksi + '-' + notran + '-' + tahun_pembukuan_id + '-' + jurnal + '-' + unit_id + '-' + keterangan
        // });
// Toast.fire({
//     type: 'success',
//     title: ' simpan!!!.'
// });
// js mengambil nilai atribut sebuah tag
     //const alamat = $('#frm-laporan').attr("action");

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
