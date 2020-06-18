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
    $('#rtanggal').daterangepicker({
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
    //         icon: 'success',
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
                        icon: 'warning',
                        title: 'Tanggal diluar periode pembukuan!!!'
                    });
                } else {
                    Toast.fire({
                        icon: 'success',
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
    // --------------------------------------CALK----------------------------
    $('#btn-tampil-catatan').on('click', function (e) {
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
            url: base_url + "akuntansi/catatan/cekinput",
            data: {
                akhir_periode: tanggal
            },
            dataType: "JSON",
            beforeSend: function () {
                $('#btn-tampil-catatan').attr('disabled', 'disabled');
            },
            success: function (response) {
                if (response.status == 'gagal') {
                    Toast.fire({
                        icon: 'warning',
                        title: 'Tanggal diluar periode pembukuan!!!'
                    });
                } else {
                    Toast.fire({
                        icon: 'success',
                        title: ' Menampilkan laporan!!!.' + jenis
                    });
                    $.ajax({
                        type: "POST",
                        cache: false,
                        url: base_url + "akuntansi/catatan/viewdata",
                        data: {
                            akhir_periode: tanggal,
                            jenis: jenis
                        },
                        success: function (data) {
                            $("#data").html(data);
                        }
                    });
                }
                $('#btn-tampil-catatan').attr('disabled', false);
            }
        });
        return false;
    });
    // -------------------------------------/CALK----------------------------
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
                        icon: 'warning',
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
                    //     icon: 'success',
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
                        icon: 'warning',
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
                    //     icon: 'success',
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
                        icon: 'warning',
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
                        icon: 'success',
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
                        icon: 'success',
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
            icon: 'warning',
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
                                icon: 'success',
                                title: ' Data berhasil dihapus!!!.'
                            });
                            document.location.reload();
                        } else {
                            Toast.fire({
                                icon: 'warning',
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
                $('[name="tahunanggaran_id"]').val(data.tahunanggaran_id);
                $('[name="resaldo"]').val(data.resaldo);
                $('[name="terealisasi"]').val(data.terealisasi);
                $('[name="noref"]').val(data.noref);
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
                        icon: 'success',
                        title: ' Data berhasil diubah!'
                    });
                    $('#modal-rapb').modal('hide');
                }
                $('#btn-ubah-rapb').attr('disabled', false);
            }
        });
        return false;
    });
    // end ajax tombol modal ubah rapb
    // -------------------------------------/RAPB-------------------------
    // -------------------------------------/PERIODE AKADEMIK-------------------------
    //set focus input periodeakademik saat modal muncul
    $('#modal-periodeakademik').on('shown.bs.modal', function () {
        $('#id').trigger('focus');
    })
    //set focus input periodeakademik saat modal muncul
    // tombol tambah periodeakademik table
    $('#btn-tambah-periodeakademik').on('click', function (e) {
        e.preventDefault();
        const judul = document.getElementById('judul-modal');
        judul.innerHTML = 'Tambah Data Periode Akademik';
        $('#btn-ubah-periodeakademik').hide();
        $('#modal-periodeakademik').modal('show');
    });
    // end tombol tambah periodeakademik table
    // ajax tombol Simpan modal periodeakademik
    $('#btn-simpan-periodeakademik').on('click', function (e) {
        e.preventDefault();
        const id = $('[name="id"]').val();
        const tahunakademik_id = $('[name="tahunakademik_id"]').val();
        const semester_id = $('[name="semester_id"]').val();
        const keterangan = $('[name="keterangan"]').val();
        const awalPeriode = $('[name="awal_periode"]').val();
        const akhirPeriode = $('[name="akhir_periode"]').val();
        $.ajax({
            type: "POST",
            url: base_url + "akademik/periodeakademik/simpan",
            data: {
                id: id,
                tahunakademik_id: tahunakademik_id,
                semester_id: semester_id,
                keterangan: keterangan,
                awal_periode: awalPeriode,
                akhir_periode: akhirPeriode
            },
            dataType: "JSON",
            beforeSend: function () {
                $('#btn-simpan-periodeakademik').attr('disabled', 'disabled');
            },
            success: function (data) {
                if (data.status == 'gagal') {
                    Toast.fire({
                        type: 'error',
                        title: ' Input data tidak valid!!!.'
                    });
                    if (data.kode_error != '') {
                        $('#kode_error').html(data.kode_error);
                    } else {
                        $('#kode_error').html('');
                    }
                    if (data.tahunakademik_error != '') {
                        $('#tahunakademik_error').html(data.tahunakademik_error);
                    } else {
                        $('#tahunakademik_error').html('');
                    }
                    if (data.semester_error != '') {
                        $('#semester_error').html(data.semester_error);
                    } else {
                        $('#semester_error').html('');
                    }
                    if (data.keterangan_error != '') {
                        $('#keterangan_error').html(data.keterangan_error);
                    } else {
                        $('#keterangan_error').html('');
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
                    $('#id').trigger('focus');
                } else {
                    Toast.fire({
                        icon: 'success',
                        title: ' Data berhasil disimpan.'
                    });
                    $('#modal-periodeakademik').modal('hide');
                }
                $('#btn-simpan-periodeakademik').attr('disabled', false);
            }
        });
        return false;
    });
    //end  ajax tombol Simpan modal periodeakademik
    // ajax icon hapus table periodeakademik klik
    $('.btn-hapus-periodeakademik').on('click', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var info = $(this).data('info');
        Swal.fire({
            title: 'Konfirmasi!',
            text: 'Apakah anda yakin akan menghapus Periode Akademik -' + info + '- !?!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Batal',
            confirmButtonText: 'Hapus'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: base_url + "akademik/periodeakademik/hapus/",
                    data: {
                        id: id,
                        info: info
                    },
                    dataType: 'JSON',
                    success: function (data) {
                        if (data.status == 'sukses') {
                            Toast.fire({
                                icon: 'success',
                                title: ' Data berhasil dihapus!!!.'
                            });
                            document.location.reload();
                        } else {
                            Toast.fire({
                                icon: 'warning',
                                title: ' Penghapusan dibatalkan, data sedang digunakan oleh system!!!.'
                            });
                        }
                    }
                });
            }
        })
    });
    // end ajax icon hapus table periodeakademik klik
    // ajax tombol edit data table periodeakademik klik
    $('.btn-edit-periodeakademik').on('click', function (e) {
        e.preventDefault();
        const judul = document.getElementById('judul-modal');
        judul.innerHTML = 'Ubah Data Periode Akademik';
        var id = $(this).data('id');
        $('#btn-simpan-periodeakademik').hide();
        $('#id').attr('disabled', 'disabled');
        $.ajax({
            url: base_url + 'akademik/periodeakademik/ajax_edit/' + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('[name="idubah"]').val(data.id);
                $('[name="id"]').val(data.id);
                $('[name="tahunakademik_id"]').val(data.tahunakademik_id);
                $('[name="semester_id"]').val(data.semester_id);
                $('[name="keterangan"]').val(data.keterangan);
                $('[name="awal_periode"]').val(data.awal_periode);
                $('[name="akhir_periode"]').val(data.akhir_periode);
                $('#modal-periodeakademik').modal('show');
                $('#tahunakademik_id').trigger('focus');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    });
    //end ajax tombol edit data table periodeakademik klik
    // ajax tombol modal ubah periodeakademik
    $('#btn-ubah-periodeakademik').on('click', function (e) {
        e.preventDefault();
        const idubah = $('[name="idubah"]').val();
        const tahunakademik_id = $('[name="tahunakademik_id"]').val();
        const semester_id = $('[name="semester_id"]').val();
        const keterangan = $('[name="keterangan"]').val();
        const awalPeriode = $('[name="awal_periode"]').val();
        const akhirPeriode = $('[name="akhir_periode"]').val();
        $.ajax({
            type: "POST",
            url: base_url + "akademik/periodeakademik/ubah",
            data: {
                idubah: idubah,
                tahunakademik_id: tahunakademik_id,
                semester_id: semester_id,
                keterangan: keterangan,
                awal_periode: awalPeriode,
                akhir_periode: akhirPeriode
            },
            dataType: 'JSON',
            beforeSend: function () {
                $('#btn-ubah-periodeakademik').attr('disabled', 'disabled');
            },
            success: function (data) {
                if (data.status == 'gagal') {
                    Toast.fire({
                        type: 'error',
                        title: ' Input data tidak valid!!!.'
                    });
                    if (data.tahunakademik_error != '') {
                        $('#tahunakademik_error').html(data.tahunakademik_error);

                    } else {
                        $('#tahunakademik_error').html('');
                    }
                    if (data.semester_error != '') {
                        $('#semester_error').html(data.semester_error);

                    } else {
                        $('#semester_error').html('');
                    }
                    if (data.keterangan_error != '') {
                        $('#keterangan_error').html(data.keterangan_error);

                    } else {
                        $('#keterangan_error').html('');
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
                    $('#tahunakademik_id').trigger('focus');
                } else {
                    Toast.fire({
                        icon: 'success',
                        title: ' Data berhasil diubah!'
                    });
                    $('#modal-periodeakademik').modal('hide');
                    //dataTable.ajax.reload();
                }
                $('#btn-ubah-periodeakademik').attr('disabled', false);
            }
        });
        return false;
    });
    // end ajax tombol modal ubah periodeakademik
    // -------------------------------------/PERIODE AKADEMIK-------------------------
    // -------------------------------------/KELAS AKTIF-------------------------
    //set focus input kelasaktif saat modal muncul
    $('#modal-kelasaktif').on('shown.bs.modal', function () {
        $('#kelas_id').trigger('focus');
    })
    //set focus input kelasaktif saat modal muncul
    // tombol tambah kelasaktif table
    $('#btn-tambah-kelasaktif').on('click', function (e) {
        e.preventDefault();
        const judul = document.getElementById('judul-modal');
        judul.innerHTML = 'Tambah Data Kelas Aktif';
        $('#btn-ubah-kelasaktif').hide();
        $('#modal-kelasaktif').modal('show');
    });
    // end tombol tambah kelasaktif table
    // ajax tombol Simpan modal kelasaktif
    $('#btn-simpan-kelasaktif').on('click', function (e) {
        e.preventDefault();
        // const id = $('[name="id"]').val();
        // const bop_id = $('[name="bop_id"]').val();
        const perak_id = $('[name="perak_id"]').val();
        const kelas_id = $('[name="kelas_id"]').val();
        $.ajax({
            method: "POST",
            url: base_url + "akademik/kelasaktif/simpan",
            data: {
                // bop_id: bop_id,
                perak_id: perak_id,
                kelas_id: kelas_id
            },
            dataType: "JSON",
            beforeSend: function () {
                $('#btn-simpan-kelasaktif').attr('disabled', 'disabled');
            },
            success: function (data) {
                if (data.status == 'gagal') {
                    Toast.fire({
                        type: 'error',
                        title: ' Input data tidak valid!!!.'
                    });
                    if (data.periode_error != '') {
                        $('#periode_error').html(data.periode_error);
                    } else {
                        $('#periode_error').html('');
                    }
                    if (data.kelas_error != '') {
                        $('#kelas_error').html(data.kelas_error);
                    } else {
                        $('#kelas_error').html('');
                    }
                    // if (data.bop_error != '') {
                    //     $('#bop_error').html(data.bop_error);
                    // } else {
                    //     $('#bop_error').html('');
                    // }
                    $('#kelas_id').trigger('focus');
                } else {
                    Toast.fire({
                        icon: 'success',
                        title: ' Data berhasil disimpan.'
                    });
                    $('#modal-kelasaktif').modal('hide');
                }
                $('#btn-simpan-kelasaktif').attr('disabled', false);
            }
        });
        return false;
    });
    //end  ajax tombol Simpan modal kelasaktif
    // ajax icon hapus table kelasaktif klik
    $('.btn-hapus-kelasaktif').on('click', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var info = $(this).data('info');
        Swal.fire({
            title: 'Konfirmasi!',
            text: 'Apakah anda yakin akan menghapus kelas -' + id + info + '- !?!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Batal',
            confirmButtonText: 'Hapus'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    method: "POST",
                    url: base_url + "akademik/kelasaktif/hapus",
                    data: {
                        id: id,
                        info: info
                    },
                    dataType: 'JSON',
                    success: function (data) {
                        if (data.status == 'sukses') {
                            Toast.fire({
                                icon: 'success',
                                title: ' Data berhasil dihapus!!!.'
                            });
                            document.location.reload();
                        } else {
                            Toast.fire({
                                icon: 'warning',
                                title: ' Penghapusan dibatalkan, data sedang digunakan oleh system!!!.'
                            });
                        }
                    }
                });
            }
        })
    });
    // end ajax icon hapus table kelasaktif klik
    // ajax tombol edit data table kelasaktif klik
    $('.btn-edit-kelasaktif').on('click', function (e) {
        e.preventDefault();
        const judul = document.getElementById('judul-modal');
        judul.innerHTML = 'Ubah Data Kelas Aktif';
        var id = $(this).data('id');
        $('#btn-simpan-kelasaktif').hide();
        $.ajax({
            url: base_url + 'akademik/kelasaktif/ajax_edit/' + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('[name="idubah"]').val(data.id);
                $('[name="kelas_id"]').val(data.kelas_id);
                // $('[name="bop_id"]').val(data.bop_id);
                $('#kelas_id').attr('disabled', 'disabled');
                $('#modal-kelasaktif').modal('show');
                $('#kelas_id').trigger('focus');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Sesi login telah habis!refresh halaman dan login kembali');
            }
        });
    });
    //end ajax tombol edit data table kelasaktif klik
    // ajax tombol modal ubah kelasaktif
    $('#btn-ubah-kelasaktif').on('click', function (e) {
        e.preventDefault();
        const idubah = $('[name="idubah"]').val();
        const kelas_id = $('[name="kelas_id"]').val();
        const perak_id = $('[name="perak_id"]').val();
        // const bop_id = $('[name="bop_id"]').val();
        $.ajax({
            type: "POST",
            url: base_url + "akademik/kelasaktif/ubah",
            data: {
                idubah: idubah,
                kelas_id: kelas_id,
                perak_id: perak_id,
                bop_id: bop_id
            },
            dataType: 'JSON',
            beforeSend: function () {
                $('#btn-ubah-kelasaktif').attr('disabled', 'disabled');
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
                    // if (data.bop_error != '') {
                    //     $('#bop_error').html(data.bop_error);

                    // } else {
                    //     $('#bop_error').html('');
                    // }
                    $('#kelas_id').trigger('focus');
                } else {
                    Toast.fire({
                        icon: 'success',
                        title: ' Data berhasil diubah!'
                    });
                    $('#modal-kelasaktif').modal('hide');
                    //dataTable.ajax.reload();
                }
                $('#btn-ubah-kelasaktif').attr('disabled', false);
            }
        });
        return false;
    });
    // end ajax tombol modal ubah kelasaktif
    //set focus input mahasiswaaktif saat modal muncul
    $('#modal-mahasiswaaktif').on('shown.bs.modal', function () {
        //$('#kelas_id').trigger('focus');
    })
    //set focus input mahasiswaaktif saat modal muncul
    // tombol tambah mahasiswaaktif table
    $('#btn-tambah-mahasiswaaktif').on('click', function (e) {
        e.preventDefault();
        const judul = document.getElementById('judul-modal');
        judul.innerHTML = 'Tambah Data Mahasiswa Aktif';
        $('#btn-ubah-mahasiswaaktif').hide();
        $('#modal-mahasiswaaktif').modal('show');
    });
    // end tombol tambah mahasiswaaktif table
    // ajax icon hapus table mahasiswaaktif klik
    $('.btn-hapus-mahasiswaaktif').on('click', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var info = $(this).data('info');
        Swal.fire({
            title: 'Konfirmasi!',
            text: 'Apakah anda yakin akan menghapus mahasiswa -' + info + '- !?!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Batal',
            confirmButtonText: 'Hapus'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    method: "POST",
                    url: base_url + "akademik/kelasaktif/hapusdetail",
                    data: {
                        id: id,
                        info: info
                    },
                    dataType: 'JSON',
                    success: function (data) {
                        if (data.status == 'sukses') {
                            Toast.fire({
                                icon: 'success',
                                title: ' Data berhasil dihapus!!!.'
                            });
                            document.location.reload();
                        } else {
                            Toast.fire({
                                icon: 'warning',
                                title: ' Penghapusan dibatalkan, data sedang digunakan oleh system!!!.'
                            });
                        }
                    }
                });
            }
        })
    });
    // end ajax icon hapus table mahasiswaaktif klik
    // -------------------------------------/KELAS AKTIF-------------------------
    //---------------------------------------MAHASISWA AKTIF CEKBOX----------------------------
    //ajax cekbox mahasiswa aktif
    $('.frm-cek-mhsactive').on('click', function (e) {
        const dekelas_id = $(this).data('iddekelas');
        const mhs_id = $(this).data('mhsid');
        $.ajax({
            url: base_url + "akademik/kelasaktif/ubahmhs",
            method: 'POST',
            data: {
                dekelas_id: dekelas_id,
                mhs_id: mhs_id
            },
            success: function () {
                Toast.fire({
                    icon: 'success',
                    title: 'Data kelas berhasil diperbaharui!'
                });
            }
        });
    });
    //end ajax cekbox mahasiswa aktif
    //--------------------------------------/MAHASISWA AKTIF CEKBOX----------------------------
    //--------------------------------------/KOMPONEN BOP----------------------------
    //set focus input komponenbop saat modal muncul
    $('#modal-komponenbop').on('shown.bs.modal', function () {
        $('#kode').trigger('focus');
    })
    //set focus input komponenbop saat modal muncul
    // tombol tambah komponenbop table
    $('#btn-tambah-komponenbop').on('click', function (e) {
        e.preventDefault();
        const judul = document.getElementById('judul-modal');
        judul.innerHTML = 'Tambah Data Komponen BOP';
        $('#btn-ubah-komponenbop').hide();
        $('#modal-komponenbop').modal('show');
    });
    // end tombol tambah komponenbop table
    // ajax tombol Simpan modal komponenbop
    $('#btn-simpan-komponenbop').on('click', function (e) {
        e.preventDefault();
        const kode = $('[name="kode"]').val();
        const kewajiban = $('[name="kewajiban"]').val();
        const jenis = $('[name="jenis"]').val();
        $.ajax({
            method: "POST",
            url: base_url + "akademik/komponenbop/simpan",
            data: {
                kode: kode,
                kewajiban: kewajiban,
                jenis: jenis
            },
            dataType: "JSON",
            beforeSend: function () {
                $('#btn-simpan-komponenbop').attr('disabled', 'disabled');
            },
            success: function (data) {
                if (data.status == 'gagal') {
                    Toast.fire({
                        type: 'error',
                        title: ' Input data tidak valid!!!.'
                    });
                    if (data.kode_error != '') {
                        $('#kode_error').html(data.kode_error);
                    } else {
                        $('#kode_error').html('');
                    }
                    if (data.komponen_error != '') {
                        $('#komponen_error').html(data.komponen_error);
                    } else {
                        $('#komponen_error').html('');
                    }
                    if (data.jenis_error != '') {
                        $('#jenis_error').html(data.jenis_error);
                    } else {
                        $('#jenis_error').html('');
                    }
                    $('#kode').trigger('focus');
                } else {
                    Toast.fire({
                        icon: 'success',
                        title: ' Data berhasil disimpan.'
                    });
                    $('#modal-komponenbop').modal('hide');
                }
                $('#btn-simpan-komponenbop').attr('disabled', false);
            }
        });
        return false;
    });
    //end  ajax tombol Simpan modal komponenbop
    // ajax tombol edit data table komponenbop klik
    $('.btn-edit-komponenbop').on('click', function (e) {
        e.preventDefault();
        const judul = document.getElementById('judul-modal');
        judul.innerHTML = 'Ubah Data Komponen BOP';
        var id = $(this).data('id');
        $('#btn-simpan-komponenbop').hide();
        $.ajax({
            url: base_url + 'akademik/komponenbop/ajax_edit/' + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('[name="idubah"]').val(data.id);
                $('[name="kode"]').val(data.kode);
                $('[name="kewajiban"]').val(data.kewajiban);
                $('[name="jenis"]').val(data.jenis);
                $('#modal-komponenbop').modal('show');
                $('#kewajiban').trigger('focus');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    });
    //end ajax tombol edit data table komponenbop klik
    // ajax tombol modal ubah komponenbop
    $('#btn-ubah-komponenbop').on('click', function (e) {
        e.preventDefault();
        const idubah = $('[name="idubah"]').val();
        const kode = $('[name="kode"]').val();
        const kewajiban = $('[name="kewajiban"]').val();
        const jenis = $('[name="jenis"]').val();
        $.ajax({
            type: "POST",
            url: base_url + "akademik/komponenbop/ubah",
            data: {
                idubah: idubah,
                kode: kode,
                kewajiban: kewajiban,
                jenis: jenis
            },
            dataType: 'JSON',
            beforeSend: function () {
                $('#btn-ubah-komponenbop').attr('disabled', 'disabled');
            },
            success: function (data) {
                if (data.status == 'gagal') {
                    Toast.fire({
                        type: 'error',
                        title: ' Input data tidak valid!!!.'
                    });
                    if (data.kode_error != '') {
                        $('#kode_error').html(data.kode_error);
                    } else {
                        $('#kode_error').html('');
                    }
                    if (data.komponen_error != '') {
                        $('#komponen_error').html(data.komponen_error);
                    } else {
                        $('#komponen_error').html('');
                    }
                    if (data.jenis_error != '') {
                        $('#jenis_error').html(data.jenis_error);

                    } else {
                        $('#jenis_error').html('');
                    }
                    $('#kode').trigger('focus');
                } else {
                    Toast.fire({
                        icon: 'success',
                        title: ' Data berhasil diubah!'
                    });
                    $('#modal-komponenbop').modal('hide');
                    //dataTable.ajax.reload();
                }
                $('#btn-ubah-komponenbop').attr('disabled', false);
            }
        });
        return false;
    });
    // end ajax tombol modal ubah komponenbop
    // ajax icon hapus table komponenbop klik
    $('.btn-hapus-komponenbop').on('click', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var info = $(this).data('info');
        Swal.fire({
            title: 'Konfirmasi!',
            text: 'Apakah anda yakin akan menghapus Komponen BOP -' + info + '- !?!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Batal',
            confirmButtonText: 'Hapus'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: base_url + "akademik/komponenbop/hapus/",
                    data: {
                        id: id,
                        info: info
                    },
                    dataType: 'JSON',
                    success: function (data) {
                        if (data.status == 'sukses') {
                            Toast.fire({
                                icon: 'success',
                                title: ' Data berhasil dihapus!!!.'
                            });
                            document.location.reload();
                        } else {
                            Toast.fire({
                                icon: 'warning',
                                title: ' Penghapusan dibatalkan, data sedang digunakan oleh system!!!.'
                            });
                        }
                    }
                });
            }
        })
    });
    // end ajax icon hapus table komponenbop klik
    // tombol tambah akunbop table
    $('.btn-tambah-akunbop').on('click', function (e) {
        e.preventDefault();
        var idKewajiban = $(this).data('idkewajiban');
        var info = $(this).data('info');
        const judul = document.getElementById('judul-modalakunbop');
        judul.innerHTML = 'Tambah Akun' + ' ' + info;
        $('[name="namakewajiban"]').val(info);
        $('[name="kewajiban_id"]').val(idKewajiban);
        // $('#btn-ubah-akunbop').hide();
        $('#modal-akunbop').modal('show');
    });
    // end tombol tambah akunbop table
    // ajax tombol Simpan modal akunbop
    $('#btn-simpan-akunbop').on('click', function (e) {
        e.preventDefault();
        const kewajiban_id = $('[name="kewajiban_id"]').val();
        const a6level_id = $('[name="a6level_id"]').val();
        const posisi = $('[name="posisi"]').val();
        $.ajax({
            method: "POST",
            url: base_url + "akademik/komponenbop/simpanakun",
            data: {
                kewajiban_id: kewajiban_id,
                a6level_id: a6level_id,
                posisi: posisi
            },
            dataType: "JSON",
            beforeSend: function () {
                $('#btn-simpan-akunbop').attr('disabled', 'disabled');
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
                    $('#a6level_id').trigger('focus');
                } else {
                    Toast.fire({
                        icon: 'success',
                        title: ' Data berhasil disimpan.'
                    });
                    $('#modal-akunbop').modal('hide');
                }
                $('#btn-simpan-akunbop').attr('disabled', false);
            }
        });
        return false;
    });
    //end  ajax tombol Simpan modal akunbop
    // ajax icon hapus table akunbop klik
    $('.btn-hapus-akunbop').on('click', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var info = $(this).data('info');
        Swal.fire({
            title: 'Konfirmasi!',
            text: 'Apakah anda yakin akan menghapus akun -' + info + '- !?!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Batal',
            confirmButtonText: 'Hapus'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    method: "POST",
                    url: base_url + "akademik/komponenbop/hapusakun",
                    data: {
                        id: id,
                        info: info
                    },
                    dataType: 'JSON',
                    success: function (data) {
                        if (data.status == 'sukses') {
                            Toast.fire({
                                icon: 'success',
                                title: ' Data berhasil dihapus!!!.'
                            });
                            document.location.reload();
                        } else {
                            Toast.fire({
                                icon: 'warning',
                                title: ' Penghapusan dibatalkan, data sedang digunakan oleh system!!!.'
                            });
                        }
                    }
                });
            }
        })
    });
    // end ajax icon hapus table akunbop klik
    //--------------------------------------/KOMPONEN BOP----------------------------
    //---------------------------------------BOP----------------------------
    //set focus input bop saat modal muncul
    $('#modal-bop').on('shown.bs.modal', function () {
        $('#kode').trigger('focus');
    })
    //set focus input bop saat modal muncul
    // tombol tambah bop table
    $('#btn-tambah-bop').on('click', function (e) {
        e.preventDefault();
        const judul = document.getElementById('judul-modal');
        judul.innerHTML = 'Tambah Data BOP';
        $('#btn-ubah-bop').hide();
        $('#modal-bop').modal('show');
    });
    // end tombol tambah bop table
    // ajax tombol Simpan modal bop
    $('#btn-simpan-bop').on('click', function (e) {
        e.preventDefault();
        const kode = $('[name="kode"]').val();
        const detailkelas_id = $('[name="detailkelas_id"]').val();
        $.ajax({
            method: "POST",
            url: base_url + "akademik/bop/simpan",
            data: {
                kode: kode,
                detailkelas_id: detailkelas_id
            },
            dataType: "JSON",
            beforeSend: function () {
                $('#btn-simpan-bop').attr('disabled', 'disabled');
            },
            success: function (data) {
                if (data.status == 'gagal') {
                    Toast.fire({
                        type: 'error',
                        title: ' Input data tidak valid!!!.'
                    });
                    if (data.kode_error != '') {
                        $('#kode_error').html(data.kode_error);
                    } else {
                        $('#kode_error').html('');
                    }
                    if (data.kelas_error != '') {
                        $('#kelas_error').html(data.kelas_error);
                    } else {
                        $('#kelas_error').html('');
                    }
                    $('#kode').trigger('focus');
                } else {
                    Toast.fire({
                        icon: 'success',
                        title: ' Data berhasil disimpan.'
                    });
                    $('#modal-bop').modal('hide');
                }
                $('#btn-simpan-bop').attr('disabled', false);
            }
        });
        return false;
    });
    //end  ajax tombol Simpan modal bop
    // ajax icon hapus table bop klik
    $('.btn-hapus-bop').on('click', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var info = $(this).data('info');
        Swal.fire({
            title: 'Konfirmasi!',
            text: 'Apakah anda yakin akan menghapus BOP -' + info + '- !?!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Batal',
            confirmButtonText: 'Hapus'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: base_url + "akademik/bop/hapus",
                    data: {
                        id: id,
                        info: info
                    },
                    dataType: 'JSON',
                    success: function (data) {
                        if (data.status == 'sukses') {
                            Toast.fire({
                                icon: 'success',
                                title: ' Data berhasil dihapus!!!.'
                            });
                            document.location.reload();
                        } else {
                            Toast.fire({
                                icon: 'warning',
                                title: ' Penghapusan dibatalkan, data sedang digunakan oleh system!!!.'
                            });
                        }
                    }
                });
            }
        })
    });
    // end ajax icon hapus table bop klik
    // ajax tombol edit data table bop klik
    $('.btn-edit-bop').on('click', function (e) {
        e.preventDefault();
        const judul = document.getElementById('judul-modal');
        judul.innerHTML = 'Ubah Data BOP';
        var id = $(this).data('id');
        $('#btn-simpan-bop').hide();
        $.ajax({
            url: base_url + 'akademik/bop/ajax_edit/' + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('[name="idubah"]').val(data.id);
                $('[name="kode"]').val(data.kode);
                $('[name="detailkelas_id"]').val(data.detailkelas_id);
                $('#modal-bop').modal('show');
                $('#kode').trigger('focus');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    });
    //end ajax tombol edit data table bop klik
    // ajax tombol modal ubah bop
    $('#btn-ubah-bop').on('click', function (e) {
        e.preventDefault();
        const idubah = $('[name="idubah"]').val();
        const kode = $('[name="kode"]').val();
        const detailkelas_id = $('[name="detailkelas_id"]').val();
        $.ajax({
            type: "POST",
            url: base_url + "akademik/bop/ubah",
            data: {
                idubah: idubah,
                kode: kode,
                detailkelas_id: detailkelas_id
            },
            dataType: 'JSON',
            beforeSend: function () {
                $('#btn-ubah-bop').attr('disabled', 'disabled');
            },
            success: function (data) {
                if (data.status == 'gagal') {
                    Toast.fire({
                        type: 'error',
                        title: ' Input data tidak valid!!!.'
                    });
                    if (data.kode_error != '') {
                        $('#kode_error').html(data.kode_error);

                    } else {
                        $('#kode_error').html('');
                    }
                    if (data.kelas_error != '') {
                        $('#kelas_error').html(data.kelas_error);

                    } else {
                        $('#kelas_error').html('');
                    }
                    $('#kode').trigger('focus');
                } else {
                    Toast.fire({
                        icon: 'success',
                        title: ' Data berhasil diubah!'
                    });
                    $('#modal-bop').modal('hide');
                    //dataTable.ajax.reload();
                }
                $('#btn-ubah-bop').attr('disabled', false);
            }
        });
        return false;
    });
    // end ajax tombol modal ubah bop
    //set focus input detailbop saat modal muncul
    $('#modal-detailbop').on('shown.bs.modal', function () {
        $('#kewajiban_id').trigger('focus');
    })
    //set focus input detailbop saat modal muncul
    // tombol tambah detailbop table
    $('#btn-tambah-detailbop').on('click', function (e) {
        e.preventDefault();
        const judul = document.getElementById('judul-modal');
        judul.innerHTML = 'Tambah Data Detail BOP';
        $('#btn-ubah-detailbop').hide();
        $('#modal-detailbop').modal('show');
    });
    // end tombol tambah detailbop table
    // ajax tombol Simpan modal detailbop
    $('#btn-simpan-detailbop').on('click', function (e) {
        e.preventDefault();
        const bop_id = $('[name="bop_id"]').val();
        const kewajiban_id = $('[name="kewajiban_id"]').val();
        const jumlah = $('[name="jumlah"]').val();
        $.ajax({
            cache: false,
            method: "POST",
            url: base_url + "akademik/bop/simpandetail",
            data: {
                bop_id: bop_id,
                kewajiban_id: kewajiban_id,
                jumlah: jumlah
            },
            dataType: "JSON",
            beforeSend: function () {
                $('#btn-simpan-detailbop').attr('disabled', 'disabled');
            },
            success: function (data) {
                if (data.status == 'gagal') {
                    Toast.fire({
                        type: 'error',
                        title: ' Input data tidak valid!!!.'
                    });
                    if (data.komponen_error != '') {
                        $('#komponen_error').html(data.komponen_error);
                    } else {
                        $('#komponen_error').html('');
                    }
                    if (data.jumlah_error != '') {
                        $('#jumlah_error').html(data.jumlah_error);
                    } else {
                        $('#jumlah_error').html('');
                    }
                    $('#kewajiban_id').trigger('focus');
                } else {
                    Toast.fire({
                        icon: 'success',
                        title: ' Data berhasil disimpan.'
                    });
                    $('#modal-detailbop').modal('hide');
                }
                $('#btn-simpan-detailbop').attr('disabled', false);
            }
        });
        return false;
    });
    //end  ajax tombol Simpan modal detailbop
    // ajax tombol edit data table detailbop klik
    $('.btn-edit-detailbop').on('click', function (e) {
        e.preventDefault();
        const judul = document.getElementById('judul-modal');
        judul.innerHTML = 'Ubah Data Detail BOP';
        var id = $(this).data('id');
        $('#btn-simpan-detailbop').hide();
        $.ajax({
            url: base_url + 'akademik/bop/edit_detail/' + id,
            type: "GET",
            cache: false,
            dataType: "JSON",
            success: function (data) {
                $('[name="idubah"]').val(data.id);
                $('[name="kewajiban_id"]').val(data.kewajiban_id);
                $('[name="jumlah"]').val(data.jumlah);
                $('#modal-detailbop').modal('show');
                $('#kewajiban_id').trigger('focus');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Sesi user habis, refresh halaman dan login kembali');
            }
        });
    });
    //end ajax tombol edit data table detailbop klik
    // ajax tombol modal ubah detailbop
    $('#btn-ubah-detailbop').on('click', function (e) {
        e.preventDefault();
        const idubah = $('[name="idubah"]').val();
        const kewajiban_id = $('[name="kewajiban_id"]').val();
        const jumlah = $('[name="jumlah"]').val();
        $.ajax({
            type: "POST",
            url: base_url + "akademik/bop/ubahdetail",
            data: {
                idubah: idubah,
                kewajiban_id: kewajiban_id,
                jumlah: jumlah
            },
            dataType: 'JSON',
            beforeSend: function () {
                $('#btn-ubah-detailbop').attr('disabled', 'disabled');
            },
            success: function (data) {
                if (data.status == 'gagal') {
                    Toast.fire({
                        type: 'error',
                        title: ' Input data tidak valid!!!.'
                    });
                    if (data.komponen_error != '') {
                        $('#komponen_error').html(data.komponen_error);

                    } else {
                        $('#komponen_error').html('');
                    }
                    if (data.jumlah_error != '') {
                        $('#jumlah_error').html(data.jumlah_error);

                    } else {
                        $('#jumlah_error').html('');
                    }
                    $('#kewajiban_id').trigger('focus');
                } else {
                    Toast.fire({
                        icon: 'success',
                        title: ' Data berhasil diubah!'
                    });
                    $('#modal-detailbop').modal('hide');
                    //dataTable.ajax.reload();
                }
                $('#btn-ubah-detailbop').attr('disabled', false);
            }
        });
        return false;
    });
    // end ajax tombol modal ubah detailbop
    // ajax icon hapus table detailbop klik
    $('.btn-hapus-detailbop').on('click', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var info = $(this).data('info');
        Swal.fire({
            title: 'Konfirmasi!',
            text: 'Apakah anda yakin akan menghapus detail BOP -' + info + '- !?!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Batal',
            confirmButtonText: 'Hapus'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: base_url + "akademik/bop/hapusdetail",
                    data: {
                        id: id,
                        info: info
                    },
                    dataType: 'JSON',
                    success: function (data) {
                        if (data.status == 'sukses') {
                            Toast.fire({
                                icon: 'success',
                                title: ' Data berhasil dihapus!!!.'
                            });
                            document.location.reload();
                        } else {
                            Toast.fire({
                                icon: 'warning',
                                title: ' Penghapusan dibatalkan, data sedang digunakan oleh system!!!.'
                            });
                        }
                    }
                });
            }
        })
    });
    // end ajax icon hapus table detailbop klik
    //--------------------------------------/BOP----------------------------
    //---------------------------------------ATUR BOP----------------------------
    //set focus input bop saat modal muncul
    $('#modal-aturbop').on('shown.bs.modal', function () {
        $('#kode').trigger('focus');
    })
    //set focus input bop saat modal muncul
    // tombol tambah bop table
    $('#btn-tambah-aturbop').on('click', function (e) {
        e.preventDefault();
        const judul = document.getElementById('judul-modal');
        judul.innerHTML = 'Tambah Data BOP';
        $('#btn-ubah-aturbop').hide();
        $('#modal-aturbop').modal('show');
    });
    // end tombol tambah bop table
    //---------------------------------------/ATUR BOP----------------------------
    //--------------------------------------OPM----------------------------
    $('#nim_opm').keypress(function (e) {
        if (e.which == 13) { // e.which == 13 merupakan kode yang mendeteksi ketika anda   // menekan tombol enter di keyboard
            //letakan fungsi anda disini
            const nim = $('[name="nim_opm"]').val();
            Toast.fire({
                icon: 'success',
                title: 'Cari Data Nim!!!.' + nim
            });
        }
    });
    $('#btn-cari-opm').on('click', function (e) {
        e.preventDefault();
        const nim = $('[name="nim_opm"]').val();
        const ling = base_url + 'akademik/opm/data/' + nim;
        $.ajax({
            url: base_url + 'akademik/opm/cek_mahasiswa',
            type: "POST",
            cache: false,
            dataType: "JSON",
            data: {
                nim: nim
            },
            success: function (data) {
                if (data.status == 'gagal') {
                    Toast.fire({
                        icon: 'warning',
                        title: ' Mahasiswa dengan nim ' + nim + ' tidak ada!!!.'
                    });
                } else {
                    window.location.href = ling;
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Sesi user habis, refresh halaman dan login kembali');
            }
        });

    });
    $('#btn-edit-nimopm').on('click', function (e) {
        e.preventDefault();
        //const tran_id = $('[name="tran_id"]').val();
        const status = $('[name="status"]').val();
        if (status == 1) {
            Toast.fire({
                icon: 'warning',
                title: ' Harap selesaikan/hapus transaksi terlebih dahulu!!!.'
            });
        } else {
            const judul = document.getElementById('judul-modalubah');
            judul.innerHTML = 'Ubah Nim Transaksi';
            $('#modal-opm-ubahnim').modal('show');
        }
    });
    $('#btn-ubah-nimopm').on('click', function (e) {
        e.preventDefault();
        const nim = $('[name="nim_opm"]').val();
        const ling = base_url + 'akademik/opm/data/' + nim;
        if (nim != '') {
            $.ajax({
                url: base_url + 'akademik/opm/cek_mahasiswa',
                type: "POST",
                cache: false,
                dataType: "JSON",
                data: {
                    nim: nim
                },
                success: function (data) {
                    if (data.status == 'gagal') {
                        Toast.fire({
                            icon: 'warning',
                            title: ' Mahasiswa dengan nim ' + nim + ' tidak ada!!!.'
                        });
                    } else {
                        window.location.href = ling;
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert('Sesi user habis, refresh halaman dan login kembali');
                }
            });
        } else {
            Toast.fire({
                icon: 'warning',
                title: ' Harap isi Nim!!!.'
            });
            $('#nim_opm').trigger('focus');
        }
    });
    $('#btn-batal-opmtransaksi').on('click', function (e) {
        e.preventDefault();
        var idOperasional = $(this).data('id');
        var notran = $(this).data('notran');
        var info = $(this).data('info');
        // const notran = $('[name="notran"]').val();
        // const idTransaksi = $('[name="idUbah"]').val();
        Swal.fire({
            title: 'Konfirmasi!',
            text: 'Apakah anda yakin akan menghapus transaksi pembayaran mahasiswa -' + info + '- !?!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Batal',
            confirmButtonText: 'Hapus'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    cache: false,
                    url: base_url + "akademik/opm/bataltransaksi",
                    data: {
                        operasional_id: idOperasional,
                        notran: notran
                    },
                    dataType: 'JSON',
                    success: function (data) {
                        if (data.status == 'sukses') {
                            Toast.fire({
                                icon: 'success',
                                title: ' Data berhasil dihapus!!!.'
                            });
                            document.location.reload();
                        }
                        // else {
                        //     Toast.fire({
                        //         icon: 'warning',
                        //         title: ' Penghapusan dibatalkan!!!.'
                        //     });
                        // }
                    }
                });
            }
            //  else {
            //     Toast.fire({
            //         icon: 'success',
            //         title: ' dibatalkan!!!.'
            //     });
            // }
        });
    });
    $('#btn-simpan-opm').on('click', function (e) {
        e.preventDefault();
        const nim = $('[name="nim"]').val();
        const jurnal = $('[name="jurnal"]').val();
        const notran = $('[name="notran"]').val();
        const nobukti = $('[name="nobukti"]').val();
        const noref = $('[name="noref"]').val();
        const tanggal = $('[name="tanggal_transaksi"]').val();
        const jenis = $('[name="jenis"]').val();
        const keterangan = $('[name="keterangan"]').val();
        const unit_id = $('[name="unit_id"]').val();
        const status = $('[name="status"]').val();
        const mahasiswa_id = $('[name="mahasiswa_id"]').val();
        if (status == 0) {
            $.ajax({
                url: base_url + 'akademik/opm/simpan',
                type: "POST",
                cache: false,
                dataType: "JSON",
                data: {
                    nim: nim,
                    jurnal: jurnal,
                    notran: notran,
                    nobukti: nobukti,
                    noref: noref,
                    tanggal_transaksi: tanggal,
                    keterangan: keterangan,
                    unit_id: unit_id,
                    jenis: jenis,
                    mahasiswa_id: mahasiswa_id
                },
                success: function (data) {
                    $('#nobukti_error').html('');
                    $('#tanggal_error').html('');
                    if (data.status == 'sukses') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Transaksi berhasil disimpan!!!.'
                        });
                        location.reload();
                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: ' Input data tidak valid!!!.'
                        });
                        if (data.nobukti_error != '') {
                            $('#nobukti_error').html(data.nobukti_error);
                        } else {
                            $('#nobukti_error').html('');
                        }
                        if (data.tanggal_error != '') {
                            $('#tanggal_error').html(data.tanggal_error);
                        } else {
                            $('#tanggal_error').html('');
                        }
                        if (data.keterangan_error != '') {
                            $('#keterangan_error').html(data.keterangan_error);
                        } else {
                            $('#keterangan_error').html('');
                        }
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert('Sesi user habis, refresh halaman dan login kembali');
                }
            });
        } else {
            const idTransaksi = $('[name="idUbah"]').val();
            const notr = $('[name="notran"]').val();
            $.ajax({
                url: base_url + 'akademik/opm/ubah/' + idTransaksi,
                type: "POST",
                cache: false,
                dataType: "JSON",
                data: {
                    // nim: nim,
                    // jurnal: jurnal,
                    notran: notr,
                    nobukti: nobukti,
                    noref: noref,
                    tanggal_transaksi: tanggal,
                    keterangan: keterangan,
                    // unit_id: unit_id,
                    jenis: jenis
                    // mahasiswa_id: mahasiswa_id
                },
                success: function (data) {
                    $('#nobukti_error').html('');
                    $('#tanggal_error').html('');
                    if (data.status == 'sukses') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Transaksi berhasil diubah!!!.'
                        });
                        location.reload();
                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: ' Input data tidak valid!!!.'
                        });
                        if (data.nobukti_error != '') {
                            $('#nobukti_error').html(data.nobukti_error);
                        } else {
                            $('#nobukti_error').html('');
                        }
                        if (data.tanggal_error != '') {
                            $('#tanggal_error').html(data.tanggal_error);
                        } else {
                            $('#tanggal_error').html('');
                        }
                        if (data.keterangan_error != '') {
                            $('#keterangan_error').html(data.keterangan_error);
                        } else {
                            $('#keterangan_error').html('');
                        }
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert('Sesi user habis, refresh halaman dan login kembali');
                }
            });
        }
    });
    // tombol tambah rincian OPM table
    $('#btn-tambah-rincianopm').on('click', function (e) {
        e.preventDefault();
        //const tran_id = $('[name="tran_id"]').val();
        const status = $('[name="status"]').val();
        if (status == 0) {
            Toast.fire({
                icon: 'warning',
                title: ' Harap isi dan simpan form transaksi terlebih dahulu!!!.'
            });
        } else {
            const judul = document.getElementById('judul-modal');
            judul.innerHTML = 'Operasional Mahasiswa Reguler';
            $('#btn-ubah-detailopm').hide();
            $('#modal-opm').modal('show');
        }
    });
    // end tombol tambah rincianOPM table
    // tombol simpan rinciantransaksi modal
    $('#btn-simpan-detailopm').on('click', function (e) {
        e.preventDefault();
        const operasional_id = $('[name="operasional_id"]').val();
        const notran = $('[name="notran"]').val();
        const akun_id = $('[name="akun_id"]').val();
        const mahasiswa_id = $('[name="mahasiswa_id"]').val();
        const iddopm = $('[name="iddopm"]').val();
        const akun_lama = $('[name="akun_lama"]').val();
        const dbopid_lama = $('[name="dbopid_lama"]').val();
        const jumlah = $('[name="jumlah"]').val();
        const posisi_akun = $('[name="posisi_akun"]').val();
        const jenis_opm = $('[name="jenis_opm"]').val();
        var anggaran = 0;
        if ($('#is_anggaran').is(":checked")) {
            anggaran = 1;
        }
        const is_anggaran = anggaran;
        const tanggal = $('[name="tanggal_transaksi"]').val();
        $.ajax({
            type: "POST",
            cache: false,
            url: base_url + 'akademik/opm/simpandetail',
            dataType: "JSON",
            data: {
                idubah: iddopm,
                akun_lama: akun_lama,
                operasional_id: operasional_id,
                mahasiswa_id: mahasiswa_id,
                akun_id: akun_id,
                posisi_akun: posisi_akun,
                jumlah: jumlah,
                is_anggaran: is_anggaran,
                jenis: jenis_opm,
                tanggal_transaksi: tanggal,
                notran: notran
            },
            success: function (data) {
                if (data.status == 'sukses') {
                    Toast.fire({
                        icon: 'success',
                        title: 'Transaksi berhasil disimpan!!!.'
                    });
                    location.reload();
                } else {
                    Toast.fire({
                        icon: 'error',
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
                }
            },
            error: function (e) {
                // error: function (jqXHR, textStatus, errorThrown) {
                //alert(jqXHR + textStatus + errorThrown);
                console.log('Error' + e);
            },
        });

    });
    // end tombol simpan rinciantransaksi modal
    // tombol edit rinciantransaksi tabel
    $('.btn-edit-rincianopm').on('click', function (e) {
        e.preventDefault();
        const judul = document.getElementById('judul-modal');
        judul.innerHTML = 'Ubah Rincian Transaksi';
        var id = $(this).data('id');
        $('#btn-simpan-detailopm').hide();
        //$('#modal-opm').modal('show');
        $.ajax({
            url: base_url + 'akademik/opm/edit_detail/' + id,
            type: "GET",
            cache: false,
            dataType: "JSON",
            success: function (data) {
                const dbop_id = data.detailbop_id;
                const ak_id = data.a6level_id;
                const idak = dbop_id + "/" + ak_id;
                //const anggaran=data.anggaran;
                if (data.anggaran == 1) {
                    $('[name="is_anggaran"]').prop("checked", true);
                }
                $('[name="iddopm"]').val(data.id);
                $('[name="akun_lama"]').val(data.a6level_id);
                $('[name="dbopid_lama"]').val(data.detailbop_id);
                $('[name="akun_id"]').val(idak);
                $('[name="posisi_akun"]').val(data.posisi_akun);
                $('[name="jumlah"]').val(data.jumlah);
                $('#modal-opm').modal('show');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Sesi user habis, refresh halaman dan login kembali');
            }
        });

    });
    // end tombol edit rinciantransaksi table
    // tombol ubah rinciantransaksi modal
    $('#btn-ubah-detailopm').on('click', function (e) {
        e.preventDefault();
        //var id = $(this).data('id');
        const operasional_id = $('[name="operasional_id"]').val();
        const iddopm = $('[name="iddopm"]').val();
        const notran = $('[name="notran"]').val();
        const mahasiswa_id = $('[name="mahasiswa_id"]').val();
        const akun_id = $('[name="akun_id"]').val();
        const akun_lama = $('[name="akun_lama"]').val();
        const dbopid_lama = $('[name="dbopid_lama"]').val();
        const jumlah = $('[name="jumlah"]').val();
        const posisi_akun = $('[name="posisi_akun"]').val();
        const jenis_opm = $('[name="jenis_opm"]').val();
        var anggaran = 0;
        if ($('#is_anggaran').is(":checked")) {
            anggaran = 1;
        };
        const is_anggaran = anggaran;
        const tanggal = $('[name="tanggal_transaksi"]').val();
        $.ajax({
            type: "POST",
            cache: false,
            url: base_url + 'akademik/opm/ubahdetail',
            dataType: "JSON",
            data: {
                idubah: iddopm,
                operasional_id: operasional_id,
                akun_id: akun_id,
                mahasiswa_id: mahasiswa_id,
                akun_lama: akun_lama,
                dbopid_lama: dbopid_lama,
                posisi_akun: posisi_akun,
                jumlah: jumlah,
                is_anggaran: is_anggaran,
                jenis: jenis_opm,
                tanggal_transaksi: tanggal,
                notran: notran
                // keterangan: keterangan,
                // unit_id: unit_id,
                // mahasiswa_id: mahasiswa_id
            },
            success: function (data) {
                // $('#nobukti_error').html('');
                // $('#tanggal_error').html('');
                if (data.status == 'sukses') {
                    Toast.fire({
                        icon: 'success',
                        title: 'Transaksi berhasil disimpan!!!.'
                    });
                    location.reload();
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: ' Input data tidak valid!!!.' + jumlah
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
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Sesi user habis, refresh halaman dan login kembali');
            }
        });

    });
    // end tombol ubah rinciantransaksi modal
    // tombol hapus rinciantransaksi table
    $('.btn-hapus-rincianopm').on('click', function (e) {
        e.preventDefault();
        const notran = $('[name="notran"]').val();
        const id = $(this).data('id');
        const a6level_id = $(this).data('id6');
        const info = $(this).data('info');
        Swal.fire({
            title: 'Konfirmasi!',
            text: 'Apakah anda yakin akan menghapus -' + info + '- !?!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Batal',
            confirmButtonText: 'Hapus'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    cache: false,
                    url: base_url + "akademik/opm/hapusdetail",
                    data: {
                        id: id,
                        notran: notran,
                        a6level_id: a6level_id
                    },
                    dataType: 'JSON',
                    success: function (data) {
                        if (data.status == 'sukses') {
                            Toast.fire({
                                icon: 'success',
                                title: ' Data berhasil dihapus!!!.'
                            });
                            document.location.reload();
                        } else {
                            Toast.fire({
                                icon: 'warning',
                                title: ' Penghapusan gagal!!!.'
                            });
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        alert('Sesi user habis, refresh halaman dan login kembali');
                    }
                });
            }
        });
    });
    // end tombol hapus rinciantransaksi table
    // ajax icon selesai opmtransaksi
    $('#btn-selesai-opmtransaksi').on('click', function (e) {
        e.preventDefault();
        var operasional_id = $(this).data('id');
        var total_transaksi = $(this).data('total');
        var notran = $(this).data('notran');
        //var info = $(this).data('info');
        Swal.fire({
            title: 'Konfirmasi!',
            text: 'Apakah anda yakin data telah benar!?!',
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
                    cache: false,
                    url: base_url + "akademik/opm/selesaitransaksi",
                    data: {
                        operasional_id: operasional_id,
                        notran: notran,
                        total_transaksi: total_transaksi
                    },
                    dataType: 'JSON',
                    success: function (data) {
                        if (data.status == 'sukses') {
                            Toast.fire({
                                icon: 'success',
                                title: ' Data berhasil disimpan!!!.'
                            });
                            document.location.reload();
                        } else {
                            Toast.fire({
                                icon: 'warning',
                                title: ' Kesalahan dalam menyelesaikan transaksi!!!.'
                            });
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        alert('Sesi user habis, refresh halaman dan login kembali');
                    }
                });
            }
        })
    });
    // end ajax icon selesai Opm Transaksi
    $('#btn-tes-detailopm').on('click', function (e) {
        e.preventDefault();
        const operasional_id = $('[name="operasional_id"]').val();
        const notran = $('[name="notran"]').val();
        const akun_id = $('[name="akun_id"]').val();
        const mahasiswa_id = $('[name="mahasiswa_id"]').val();
        const iddopm = $('[name="iddopm"]').val();
        const akun_lama = $('[name="akun_lama"]').val();
        const dbopid_lama = $('[name="dbopid_lama"]').val();
        const jumlah = $('[name="jumlah"]').val();
        const posisi_akun = $('[name="posisi_akun"]').val();
        const jenis_opm = $('[name="jenis_opm"]').val();
        var anggaran = 0;
        if ($('#is_anggaran').is(":checked")) {
            anggaran = 1;
        }
        const is_anggaran = anggaran;
        const tanggal = $('[name="tanggal_transaksi"]').val();
        Toast.fire({
            icon: 'success',
            title: ' operasional_id>' + operasional_id + ' tanggal_transaksi >' + tanggal + ' notran>' + notran + ' akun_id>' + akun_id + ' mahasiswa_id>' + mahasiswa_id + ' iddopm >' + iddopm + ' akun_lama >' + akun_lama + ' dbopid_lama >' + dbopid_lama + ' jumlah >' + jumlah + ' posisi_akun >' + posisi_akun + ' jenis_opm >' + jenis_opm
        });
    });

    //--------------------------------------/OPM----------------------------
    //---------------------------------------PEMBUKUAN AKTIF----------------------------
    $('#btn-simpan-pembukuanaktif').on('click', function (e) {
        e.preventDefault();
        //const pembukuan_id = $('#pa_pembukuan_id').val('selectedvalue');
        const pembukuan_id = $('[name="pa_pembukuan_id"]').val();
        const buku_awal = $('[name="awalbuku"]').val();
        const buku_akhir = $('[name="akhirbuku"]').val();
        const anggaran_id = $('[name="pa_anggaran_id"]').val();
        const anggaran_awal = $('[name="awalanggaran"]').val();
        const anggaran_akhir = $('[name="akhiranggaran"]').val();
        const tahunakademik_id = $('[name="idakademik"]').val();
        const perak_id = $('[name="pa_perak_id"]').val();
        const semester_awal = $('[name="awalsemester"]').val();
        const semester_akhir = $('[name="akhirsemester"]').val();
        Swal.fire({
            title: 'Konfirmasi!',
            text: 'Apakah anda yakin merubah periode pembukuaan!?!',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Batal',
            confirmButtonText: 'Confirm'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    cache: false,
                    url: base_url + "akuntansi/pembukuanaktif/ubahpembukuan",
                    data: {
                        pembukuan_id: pembukuan_id,
                        buku_awal: buku_awal,
                        buku_akhir: buku_akhir,
                        anggaran_id: anggaran_id,
                        anggaran_awal: anggaran_awal,
                        anggaran_akhir: anggaran_akhir,
                        tahunakademik_id: tahunakademik_id,
                        perak_id: perak_id,
                        semester_awal: semester_awal,
                        semester_akhir: semester_akhir
                    },
                    dataType: 'JSON',
                    success: function (data) {
                        if (data.status == 'sukses') {
                            Toast.fire({
                                icon: 'success',
                                title: ' Data berhasil disimpan!!!.'
                            });
                            document.location.reload();
                        } else {
                            Toast.fire({
                                icon: 'warning',
                                title: ' Kesalahan dalam menyelesaikan transaksi!!!.'
                            });
                        }
                    },
                    error: function (e) {
                        console.log('Error' + e);
                    }
                });
            }
        })
        // Toast.fire({
        //     icon: 'success',
        //     title: ' simpan!!!. 1> ' + pembukuan_id + ' 2> ' + anggaran_id + ' 3> ' + tahunakademik_id + ' 4> ' + perak_id
        // });


    });
    $("#pa_pembukuan_id").change(function () {
        var pembukuan_id = $("#pa_pembukuan_id option:selected").val();
        $.ajax({
            url: base_url + 'akuntansi/pembukuanaktif/ajaxcombobuku/' + pembukuan_id,
            type: "GET",
            cache: false,
            dataType: "JSON",
            success: function (data) {
                // $('[name="idbuku"]').val(data.id);
                $('[name="awalbuku"]').val(data.awal_periode);
                $('[name="akhirbuku"]').val(data.akhir_periode);
                //$('#modal-detailbop').modal('show');
                //$('#kewajiban_id').trigger('focus');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Sesi user habis, refresh halaman dan login kembali');
            }
        });
        // var pembukuan_id = this.value;
        // var firstDropVal = $('#pick').val();
        // Toast.fire({
        //     icon: 'success',
        //     title: ' isinya !!!. >' + pembukuan_id
        // });
    });
    $("#pa_anggaran_id").change(function () {
        var anggaran_id = $("#pa_anggaran_id option:selected").val();
        $.ajax({
            url: base_url + 'akuntansi/pembukuanaktif/ajaxcomboanggaran/' + anggaran_id,
            type: "GET",
            cache: false,
            dataType: "JSON",
            success: function (data) {
                // $('[name="idbuku"]').val(data.id);
                $('[name="awalanggaran"]').val(data.awal_periode);
                $('[name="akhiranggaran"]').val(data.akhir_periode);
                //$('#modal-detailbop').modal('show');
                //$('#kewajiban_id').trigger('focus');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Sesi user habis, refresh halaman dan login kembali');
            }
        });
    });
    $("#pa_perak_id").change(function () {
        var perak_id = $("#pa_perak_id option:selected").val();
        $.ajax({
            url: base_url + 'akuntansi/pembukuanaktif/ajaxcomboperak/' + perak_id,
            type: "GET",
            cache: false,
            dataType: "JSON",
            success: function (data) {
                $('[name="idakademik"]').val(data.tahunakademik_id);
                $('[name="awalsemester"]').val(data.awal_periode);
                $('[name="akhirsemester"]').val(data.akhir_periode);
                //$('#modal-detailbop').modal('show');
                //$('#kewajiban_id').trigger('focus');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Sesi user habis, refresh halaman dan login kembali');
            }
        });
    });
    //--------------------------------------/PEMBUKUAN AKTIF----------------------------


    // ---------------------/TES---------------------------
});
// document.location.reload();
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
//     icon: 'success',
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
    //         icon: 'success',
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
    //                     icon: 'success',
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
//         icon: 'warning',
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
//                             icon: 'success',
//                             title: ' Data berhasil dihapus!!!.'
//                         });
//                         document.location.reload();
//                     } else {
//                         Toast.fire({
//                             icon: 'warning',
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
    //             icon: 'warning',
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
    //                             icon: 'success',
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
    //                     icon: 'success',
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

    // combo anggaran klik modal rencana anggaran
//----------------------------------AUTO COMPLETE KOMBOBOX----------------------------
    // $('#rapb-kelompok-id').change(function () {
    //     var kelompok_id = $('[name="kelompok_id"]').val();
    //     var anggaran_id = $('[name="idanggaran"]').val();
    //     if (kelompok_id != '') {
    //         $.ajax({
    //             cache: false,
    //             method: "POST",
    //             url: base_url + "akuntansi/rapb/anggarandata",
    //             data: {
    //                 kelompok_id: kelompok_id,
    //                 anggaran_id: anggaran_id
    //             },
    //             success: function (data) {
    //                 $("#rapb-anggaran-id").html(data);
    //             }

    //         });
    //     }
    // });
    // end combo anggaran klik modal rencana anggaran



    // Toast.fire({
    //     icon: 'warning',
    //     title: 'Sesi login habis!!refresh halaman dan login kembali!!!.'
    // });