// saat document ready
// $('#form_id').trigger("reset"); form reset
$(document).ready(function () {
    const Toast = Swal.mixin({
        toast: true,
        position: 'center',
        showConfirmButton: false,
        timer: 4000
    });
    $(":input").inputmask(); // input matauang
    // atur datatable
    $('#tabel1').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "ordering": false
    });
    // end atur datatable
    //tampil tooltips text 
    $('#sidebar-menu').on('hover', '.nav-item', function (e) {
        $(this).$('[data-toggle="tooltip"]').tooltip()
    })
    //end tooltips text 
    // saat modal ditutup
    $('body').on('hidden.bs.modal', '.modal', function () {
        $(this).removeData('bs.modal');
        //$("#tabel-data").load(" #tabel-data > *"); //isi . load harus dikasih spasi
        //$('#tabel1').DataTable().ajax.reload();
        //atur_datatable();
        //dataTable.ajax.reload();
        document.location.reload();
    });
    // end saat modal ditutup

    //---------------------------------------INSTITUSI----------------------------------------
    //set focus input intitusi saat modal muncul
    $('#modal-institusi').on('shown.bs.modal', function () {
        $('#institusi').trigger('focus')
    })
    //set focus input intitusi saat modal muncul
    // tombol tambah institusi table
    $('#btn-tambah-institusi').on('click', function (e) {
        e.preventDefault();
        const judul = document.getElementById('judul-modal');
        judul.innerHTML = 'Tambah Data Institusi';
        $('#btn-ubah-institusi').hide();
        $('#modal-institusi').modal('show');
    });
    // end tombol tambah institusi table
    // ajax tombol Simpan modal institusi
    $('#btn-simpan-institusi').on('click', function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: base_url + "/institusi/simpan",
            data: $("#form-institusi").serialize(),
            dataType: "JSON",
            beforeSend: function () {
                $('#btn-simpan-institusi').attr('disabled', 'disabled');
            },
            success: function (data) {
                if (data.status == 'gagal') {
                    Toast.fire({
                        type: 'error',
                        title: ' Input data tidak valid!!!.'
                    });
                    if (data.institusi_error != '') {
                        $('#institusi_error').html(data.institusi_error);
                    } else {
                        $('#institusi_error').html('');
                    }
                    if (data.keterangan_error != '') {
                        $('#keterangan_error').html(data.keterangan_error);
                    } else {
                        $('#keterangan_error').html('');
                    }
                    $('#institusi').trigger('focus');
                } else {
                    Toast.fire({
                        type: 'success',
                        title: ' Data berhasil disimpan.'
                    });
                    $('#modal-institusi').modal('hide');
                }
                $('#btn-simpan-institusi').attr('disabled', false);
            }
        });
        return false;
    });
    //end  ajax tombol Simpan modal institusi
    // ajax icon hapus table institusi klik
    $('.btn-hapus-institusi').on('click', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var info = $(this).data('info');
        Swal.fire({
            title: 'Konfirmasi!',
            text: 'apakah anda yakin akan menghapus Institusi -' + info + ' !?!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Batal',
            confirmButtonText: 'Hapus'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: site_url + "institusi/hapus/" + id + "/" + info,
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
    // end ajax icon hapus table institusi klik
    // ajax tombol ubah data table institusi klik
    $('.btn-edit-institusi').on('click', function (e) {
        e.preventDefault();
        const judul = document.getElementById('judul-modal');
        judul.innerHTML = 'Ubah Data Institusi';
        var id = $(this).data('id');
        $('#btn-simpan-institusi').hide();
        $.ajax({
            url: site_url + 'institusi/ajax_edit/' + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('[name="idubah"]').val(data.id);
                $('[name="institusi"]').val(data.institusi);
                $('[name="keterangan"]').val(data.keterangan);
                $('#modal-institusi').modal('show');
                $('#institusi').trigger('focus');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });

    });
    //end ajax tombol ubah data table institusi klik
    // ajax tombol modal ubah institusi
    $('#btn-ubah-institusi').on('click', function (e) {
        e.preventDefault();
        var id = $('#idubah').val();
        $.ajax({
            type: "POST",
            url: site_url + "institusi/ubah/" + id,
            data: $("#form-institusi").serialize(),
            dataType: 'JSON',
            beforeSend: function () {
                $('#btn-ubah-institusi').attr('disabled', 'disabled');
            },
            success: function (data) {
                if (data.status == 'gagal') {
                    Toast.fire({
                        type: 'error',
                        title: ' Input data tidak valid!!!.'
                    });
                    if (data.institusi_error != '') {
                        $('#institusi_error').html(data.institusi_error);

                    } else {
                        $('#institusi_error').html('');
                    }
                    if (data.keterangan_error != '') {
                        $('#keterangan_error').html(data.keterangan_error);
                    } else {
                        $('#keterangan_error').html('');
                    }
                    $('#institusi').trigger('focus');
                } else {
                    Toast.fire({
                        type: 'success',
                        title: ' Data berhasil diubah!'
                    });
                    $('#modal-institusi').modal('hide');
                    //dataTable.ajax.reload();
                }
                $('#btn-ubah-institusi').attr('disabled', false);
            }
        });
        return false;
    });
    // end ajax tombol modal ubah institusi
    //--------------------------------------/INSTITUSI----------------------------------------
    //---------------------------------------ROLE----------------------------------------
    //set focus input role saat modal muncul
    $('#modal-role').on('shown.bs.modal', function () {
        $('#role').trigger('focus')
    })
    //set focus input role saat modal muncul
    // tombol tambah role table
    $('#btn-tambah-role').on('click', function (e) {
        e.preventDefault();
        const judul = document.getElementById('judul-modal');
        judul.innerHTML = 'Tambah Data Role';
        $('#btn-ubah-role').hide();
        $('#modal-role').modal('show');
    });
    // end tombol tambah role table
    // ajax tombol Simpan modal role
    $('#btn-simpan-role').on('click', function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: base_url + "/role/simpan",
            data: $("#form-role").serialize(),
            dataType: "JSON",
            beforeSend: function () {
                $('#btn-simpan-role').attr('disabled', 'disabled');
            },
            success: function (data) {
                if (data.status == 'gagal') {
                    Toast.fire({
                        type: 'error',
                        title: ' Input data tidak valid!!!.'
                    });
                    if (data.role_error != '') {
                        $('#role_error').html(data.role_error);
                    } else {
                        $('#role_error').html('');
                    }
                    if (data.keterangan_error != '') {
                        $('#keterangan_error').html(data.keterangan_error);
                    } else {
                        $('#keterangan_error').html('');
                    }
                    $('#role').trigger('focus');
                } else {
                    Toast.fire({
                        type: 'success',
                        title: ' Data berhasil disimpan.'
                    });
                    $('#modal-role').modal('hide');
                }
                $('#btn-simpan-role').attr('disabled', false);
            }
        });
        return false;
    });
    //end  ajax tombol Simpan modal role
    // ajax icon hapus table role klik
    $('.btn-hapus-role').on('click', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var info = $(this).data('info');
        Swal.fire({
            title: 'Konfirmasi!',
            text: 'apakah anda yakin akan menghapus Role -' + info + ' !?!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Batal',
            confirmButtonText: 'Hapus'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: site_url + "role/hapus/" + id + "/" + info,
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
    // end ajax icon hapus table role klik
    // ajax tombol ubah data table role klik
    $('.btn-edit-role').on('click', function (e) {
        e.preventDefault();
        const judul = document.getElementById('judul-modal');
        judul.innerHTML = 'Ubah Data Role';
        var id = $(this).data('id');
        $('#btn-simpan-role').hide();
        $.ajax({
            url: site_url + 'role/ajax_edit/' + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('[name="idubah"]').val(data.id);
                $('[name="role"]').val(data.role);
                $('[name="keterangan"]').val(data.keterangan);
                $('#modal-role').modal('show');
                $('#role').trigger('focus');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });

    });
    //end ajax tombol ubah data table role klik
    // ajax tombol modal ubah role
    $('#btn-ubah-role').on('click', function (e) {
        e.preventDefault();
        var id = $('#idubah').val();
        $.ajax({
            type: "POST",
            url: site_url + "role/ubah/" + id,
            data: $("#form-role").serialize(),
            dataType: 'JSON',
            beforeSend: function () {
                $('#btn-ubah-role').attr('disabled', 'disabled');
            },
            success: function (data) {
                if (data.status == 'gagal') {
                    Toast.fire({
                        type: 'error',
                        title: ' Input data tidak valid!!!.'
                    });
                    if (data.role_error != '') {
                        $('#role_error').html(data.role_error);

                    } else {
                        $('#role_error').html('');
                    }
                    if (data.keterangan_error != '') {
                        $('#keterangan_error').html(data.keterangan_error);
                    } else {
                        $('#keterangan_error').html('');
                    }
                    $('#role').trigger('focus');
                } else {
                    Toast.fire({
                        type: 'success',
                        title: ' Data berhasil diubah!'
                    });
                    $('#modal-role').modal('hide');
                    //dataTable.ajax.reload();
                }
                $('#btn-ubah-role').attr('disabled', false);
            }
        });
        return false;
    });
    // end ajax tombol modal ubah role
    //--------------------------------------/ROLE----------------------------------------
    //---------------------------------------MENU----------------------------------------
    //set focus input menu saat modal muncul
    $('#modal-menu').on('shown.bs.modal', function () {
        $('#menu').trigger('focus')
    })
    //set focus input menu saat modal muncul
    // tombol tambah menu table
    $('#btn-tambah-menu').on('click', function (e) {
        e.preventDefault();
        const judul = document.getElementById('judul-modal');
        judul.innerHTML = 'Tambah Data Menu';
        $('#btn-ubah-menu').hide();
        $('#modal-menu').modal('show');
    });
    // end tombol tambah menu table
    // ajax tombol Simpan modal menu
    $('#btn-simpan-menu').on('click', function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: base_url + "/menu/simpan",
            data: $("#form-menu").serialize(),
            dataType: "JSON",
            beforeSend: function () {
                $('#btn-simpan-menu').attr('disabled', 'disabled');
            },
            success: function (data) {
                if (data.status == 'gagal') {
                    Toast.fire({
                        type: 'error',
                        title: ' Input data tidak valid!!!.'
                    });
                    if (data.menu_error != '') {
                        $('#menu_error').html(data.menu_error);
                    } else {
                        $('#menu_error').html('');
                    }
                    if (data.icon_error != '') {
                        $('#icon_error').html(data.icon_error);
                    } else {
                        $('#icon_error').html('');
                    }
                    if (data.keterangan_error != '') {
                        $('#keterangan_error').html(data.keterangan_error);
                    } else {
                        $('#keterangan_error').html('');
                    }
                    $('#menu').trigger('focus');
                } else {
                    Toast.fire({
                        type: 'success',
                        title: ' Data berhasil disimpan.'
                    });
                    $('#modal-menu').modal('hide');
                }
                $('#btn-simpan-menu').attr('disabled', false);
            }
        });
        return false;
    });
    //end  ajax tombol Simpan modal menu
    // ajax icon hapus table menu klik
    $('.btn-hapus-menu').on('click', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var info = $(this).data('info');
        Swal.fire({
            title: 'Konfirmasi!',
            text: 'apakah anda yakin akan menghapus Menu -' + info + ' !?!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Batal',
            confirmButtonText: 'Hapus'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: site_url + "menu/hapus/" + id + "/" + info,
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
    // end ajax icon hapus table menu klik
    // ajax tombol ubah data table menu klik
    $('.btn-edit-menu').on('click', function (e) {
        e.preventDefault();
        const judul = document.getElementById('judul-modal');
        judul.innerHTML = 'Ubah Data Menu';
        var id = $(this).data('id');
        $('#btn-simpan-menu').hide();
        $.ajax({
            url: site_url + 'menu/ajax_edit/' + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('[name="idubah"]').val(data.id);
                $('[name="menu"]').val(data.menu);
                $('[name="icon"]').val(data.icon);
                $('[name="keterangan"]').val(data.keterangan);
                $('#modal-menu').modal('show');
                $('#menu').trigger('focus');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });

    });
    //end ajax tombol ubah data table menu klik
    // ajax tombol modal ubah menu
    $('#btn-ubah-menu').on('click', function (e) {
        e.preventDefault();
        var id = $('#idubah').val();
        $.ajax({
            type: "POST",
            url: site_url + "menu/ubah/" + id,
            data: $("#form-menu").serialize(),
            dataType: 'JSON',
            beforeSend: function () {
                $('#btn-ubah-menu').attr('disabled', 'disabled');
            },
            success: function (data) {
                if (data.status == 'gagal') {
                    Toast.fire({
                        type: 'error',
                        title: ' Input data tidak valid!!!.'
                    });
                    if (data.menu_error != '') {
                        $('#menu_error').html(data.menu_error);

                    } else {
                        $('#menu_error').html('');
                    }
                    if (data.icon_error != '') {
                        $('#icon_error').html(data.icon_error);
                    } else {
                        $('#icon_error').html('');
                    }
                    if (data.keterangan_error != '') {
                        $('#keterangan_error').html(data.keterangan_error);
                    } else {
                        $('#keterangan_error').html('');
                    }
                    $('#menu').trigger('focus');
                } else {
                    Toast.fire({
                        type: 'success',
                        title: ' Data berhasil diubah!'
                    });
                    $('#modal-menu').modal('hide');
                    //dataTable.ajax.reload();
                }
                $('#btn-ubah-menu').attr('disabled', false);
            }
        });
        return false;
    });
    // end ajax tombol modal ubah menu
    //--------------------------------------/MENU----------------------------------------
    //---------------------------------------USER----------------------------------------
    //set focus input user saat modal muncul
    $('#modal-user').on('shown.bs.modal', function () {
        $('#nama').trigger('focus')
    })
    //set focus input user saat modal muncul
    // tombol tambah user table
    $('#btn-tambah-user').on('click', function (e) {
        e.preventDefault();
        const judul = document.getElementById('judul-modal');
        judul.innerHTML = 'Tambah Data User';
        $('#btn-ubah-user').hide();
        $('#user-info').hide();
        $('#modal-user').modal('show');
    });
    // end tombol tambah user table
    // ajax tombol Simpan modal user
    $('#btn-simpan-user').on('click', function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: base_url + "/user/simpan",
            data: $("#form-user").serialize(),
            dataType: "JSON",
            beforeSend: function () {
                $('#btn-simpan-user').attr('disabled', 'disabled');
            },
            success: function (data) {
                if (data.status == 'gagal') {
                    Toast.fire({
                        type: 'error',
                        title: ' Input data tidak valid!!!.'
                    });
                    if (data.nama_error != '') {
                        $('#nama_error').html(data.nama_error);
                    } else {
                        $('#nama_error').html('');
                    }
                    if (data.role_error != '') {
                        $('#role_error').html(data.role_error);
                    } else {
                        $('#role_error').html('');
                    }
                    if (data.institusi_error != '') {
                        $('#institusi_error').html(data.institusi_error);
                    } else {
                        $('#institusi_error').html('');
                    }
                    if (data.email_error != '') {
                        $('#email_error').html(data.email_error);
                    } else {
                        $('#email_error').html('');
                    }
                    if (data.sandi_error != '') {
                        $('#sandi_error').html(data.sandi_error);
                    } else {
                        $('#sandi_error').html('');
                    }
                    if (data.status_error != '') {
                        $('#status_error').html(data.status_error);
                    } else {
                        $('#status_error').html('');
                    }
                    $('#nama').trigger('focus');
                } else {
                    Toast.fire({
                        type: 'success',
                        title: ' Data berhasil disimpan.'
                    });
                    $('#modal-user').modal('hide');
                }
                $('#btn-simpan-user').attr('disabled', false);
            }
        });
        return false;
    });
    //end  ajax tombol Simpan modal user
    // ajax icon hapus table user klik
    $('.btn-hapus-user').on('click', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var info = $(this).data('info');
        Swal.fire({
            title: 'Konfirmasi!',
            text: 'apakah anda yakin akan menghapus User -' + info + ' !?!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Batal',
            confirmButtonText: 'Hapus'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: site_url + "user/hapus/" + id + "/" + info,
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
    // end ajax icon hapus table user klik
    // ajax tombol ubah data table user klik
    $('.btn-edit-user').on('click', function (e) {
        e.preventDefault();
        const judul = document.getElementById('judul-modal');
        judul.innerHTML = 'Ubah Data User';
        var id = $(this).data('id');
        $('#btn-simpan-user').hide();
        $('#email').attr('disabled', 'disabled');
        $.ajax({
            url: site_url + 'user/ajax_edit/' + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('[name="idubah"]').val(data.id);
                $('[name="nama"]').val(data.nama);
                $('[name="role_id"]').val(data.role_id);
                $('[name="institusi_id"]').val(data.institusi_id);
                $('[name="email"]').val(data.email);
                $('[name="is_active"]').val(data.is_active);
                $('#modal-user').modal('show');
                $('#nama').trigger('focus');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });

    });
    //end ajax tombol ubah data table user klik
    // ajax tombol modal ubah user
    $('#btn-ubah-user').on('click', function (e) {
        e.preventDefault();
        var id = $('#idubah').val();
        $.ajax({
            type: "POST",
            url: site_url + "user/ubah/" + id,
            data: $("#form-user").serialize(),
            dataType: 'JSON',
            beforeSend: function () {
                $('#btn-ubah-user').attr('disabled', 'disabled');
            },
            success: function (data) {
                if (data.status == 'gagal') {
                    Toast.fire({
                        type: 'error',
                        title: ' Input data tidak valid!!!.'
                    });
                    if (data.nama_error != '') {
                        $('#nama_error').html(data.nama_error);
                    } else {
                        $('#nama_error').html('');
                    }
                    if (data.role_error != '') {
                        $('#role_error').html(data.role_error);
                    } else {
                        $('#role_error').html('');
                    }
                    if (data.institusi_error != '') {
                        $('#institusi_error').html(data.institusi_error);
                    } else {
                        $('#institusi_error').html('');
                    }
                    if (data.email_error != '') {
                        $('#email_error').html(data.email_error);
                    } else {
                        $('#email_error').html('');
                    }
                    if (data.sandi_error != '') {
                        $('#sandi_error').html(data.sandi_error);
                    } else {
                        $('#sandi_error').html('');
                    }
                    if (data.status_error != '') {
                        $('#status_error').html(data.status_error);
                    } else {
                        $('#status_error').html('');
                    }
                    $('#nama').trigger('focus');
                } else {
                    Toast.fire({
                        type: 'success',
                        title: ' Data berhasil diubah!'
                    });
                    $('#modal-user').modal('hide');
                    //dataTable.ajax.reload();
                }
                $('#btn-ubah-user').attr('disabled', false);
            }
        });
        return false;
    });
    // end ajax tombol modal ubah user
    //--------------------------------------/USER----------------------------------------
    //---------------------------------------UNIT----------------------------------------
    //set focus input unit saat modal muncul
    $('#modal-unit').on('shown.bs.modal', function () {
        $('#id').trigger('focus')
    })
    //set focus input unit saat modal muncul
    // tombol tambah unit table
    $('#btn-tambah-unit').on('click', function (e) {
        e.preventDefault();
        const judul = document.getElementById('judul-modal');
        judul.innerHTML = 'Tambah Data Unit';
        $('#btn-ubah-unit').hide();
        $('#modal-unit').modal('show');
        $('#id').trigger('focus');
    });
    // end tombol tambah unit table
    // ajax tombol Simpan modal unit
    $('#btn-simpan-unit').on('click', function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: base_url + "/unit/simpan",
            data: $("#form-unit").serialize(),
            dataType: "JSON",
            beforeSend: function () {
                $('#btn-simpan-unit').attr('disabled', 'disabled');
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
                    if (data.unit_error != '') {
                        $('#unit_error').html(data.unit_error);
                    } else {
                        $('#unit_error').html('');
                    }
                    if (data.institusi_error != '') {
                        $('#institusi_error').html(data.institusi_error);
                    } else {
                        $('#institusi_error').html('');
                    }
                    $('#id').trigger('focus');
                } else {
                    Toast.fire({
                        type: 'success',
                        title: ' Data berhasil disimpan.'
                    });
                    $('#modal-unit').modal('hide');
                }
                $('#btn-simpan-unit').attr('disabled', false);
            }
        });
        return false;
    });
    //end  ajax tombol Simpan modal unit
    // ajax icon hapus table unit klik
    $('.btn-hapus-unit').on('click', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var info = $(this).data('info');
        Swal.fire({
            title: 'Konfirmasi!',
            text: 'apakah anda yakin akan menghapus Unit -' + info + ' !?!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Batal',
            confirmButtonText: 'Hapus'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: site_url + "unit/hapus/" + id + "/" + info,
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
    // end ajax icon hapus table unit klik
    // ajax tombol ubah data table unit klik
    $('.btn-edit-unit').on('click', function (e) {
        e.preventDefault();
        const judul = document.getElementById('judul-modal');
        judul.innerHTML = 'Ubah Data Unit';
        var id = $(this).data('id');
        $('#id').attr('disabled', 'disabled');
        $('#btn-simpan-unit').hide();
        $.ajax({
            url: site_url + 'unit/ajax_edit/' + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('[name="id"]').val(data.id);
                $('[name="idubah"]').val(data.id);
                $('[name="unit"]').val(data.unit);
                $('[name="institusi_id"]').val(data.institusi_id);
                $('#modal-unit').modal('show');
                $('#unit').trigger('focus');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });

    });
    //end ajax tombol ubah data table unit klik
    // ajax tombol modal ubah unit
    $('#btn-ubah-unit').on('click', function (e) {
        e.preventDefault();
        var id = $('#idubah').val();
        $.ajax({
            type: "POST",
            url: site_url + "unit/ubah/" + id,
            data: $("#form-unit").serialize(),
            dataType: 'JSON',
            beforeSend: function () {
                $('#btn-ubah-unit').attr('disabled', 'disabled');
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
                    if (data.unit_error != '') {
                        $('#unit_error').html(data.unit_error);
                    } else {
                        $('#unit_error').html('');
                    }
                    if (data.institusi_error != '') {
                        $('#institusi_error').html(data.institusi_error);
                    } else {
                        $('#institusi_error').html('');
                    }
                    $('#unit').trigger('focus');
                } else {
                    Toast.fire({
                        type: 'success',
                        title: ' Data berhasil diubah!'
                    });
                    $('#modal-unit').modal('hide');
                    //dataTable.ajax.reload();
                }
                $('#btn-ubah-unit').attr('disabled', false);
            }
        });
        return false;
    });
    // end ajax tombol modal ubah unit
    //--------------------------------------/UNIT----------------------------------------
    //---------------------------------------SUBMENU----------------------------------------
    //set focus input submenu saat modal muncul
    $('#modal-submenu').on('shown.bs.modal', function () {
        $('#submenu').trigger('focus')
    })
    //set focus input submenu saat modal muncul
    // tombol tambah submenu table
    $('#btn-tambah-submenu').on('click', function (e) {
        e.preventDefault();
        const judul = document.getElementById('judul-modal');
        judul.innerHTML = 'Tambah Data Submenu';
        $('#btn-ubah-submenu').hide();
        $('#modal-submenu').modal('show');
        $('#id').trigger('focus');
    });
    // end tombol tambah submenu table
    // ajax tombol Simpan modal submenu
    $('#btn-simpan-submenu').on('click', function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: base_url + "/submenu/simpan",
            data: $("#form-submenu").serialize(),
            dataType: "JSON",
            beforeSend: function () {
                $('#btn-simpan-submenu').attr('disabled', 'disabled');
            },
            success: function (data) {
                if (data.status == 'gagal') {
                    Toast.fire({
                        type: 'error',
                        title: ' Input data tidak valid!!!.'
                    });
                    if (data.submenu_error != '') {
                        $('#submenu_error').html(data.submenu_error);
                    } else {
                        $('#submenu_error').html('');
                    }
                    if (data.menu_error != '') {
                        $('#menu_error').html(data.menu_error);
                    } else {
                        $('#menu_error').html('');
                    }
                    if (data.url_error != '') {
                        $('#url_error').html(data.url_error);
                    } else {
                        $('#url_error').html('');
                    }
                    if (data.icon_error != '') {
                        $('#icon_error').html(data.icon_error);
                    } else {
                        $('#icon_error').html('');
                    }
                    if (data.status_error != '') {
                        $('#status_error').html(data.status_error);
                    } else {
                        $('#status_error').html('');
                    }
                    $('#submenu').trigger('focus');
                } else {
                    Toast.fire({
                        type: 'success',
                        title: ' Data berhasil disimpan.'
                    });
                    $('#modal-submenu').modal('hide');
                }
                $('#btn-simpan-submenu').attr('disabled', false);
            }
        });
        return false;
    });
    //end  ajax tombol Simpan modal submenu
    // ajax icon hapus table submenu klik
    $('.btn-hapus-submenu').on('click', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var info = $(this).data('info');
        Swal.fire({
            title: 'Konfirmasi!',
            text: 'apakah anda yakin akan menghapus Submenu -' + info + ' !?!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Batal',
            confirmButtonText: 'Hapus'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: site_url + "submenu/hapus/" + id + "/" + info,
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
    // end ajax icon hapus table submenu klik
    // ajax tombol edit data table submenu klik
    $('.btn-edit-submenu').on('click', function (e) {
        e.preventDefault();
        const judul = document.getElementById('judul-modal');
        judul.innerHTML = 'Ubah Data Submenu';
        var id = $(this).data('id');
        $('#btn-simpan-submenu').hide();
        $.ajax({
            url: site_url + 'submenu/ajax_edit/' + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('[name="idubah"]').val(data.id);
                $('[name="submenu"]').val(data.submenu);
                $('[name="menu_id"]').val(data.menu_id);
                $('[name="url"]').val(data.url);
                $('[name="icon"]').val(data.icon);
                $('[name="is_active"]').val(data.is_active);
                $('#modal-submenu').modal('show');
                $('#submenu').trigger('focus');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });

    });
    //end ajax tombol edit data table submenu klik
    // ajax tombol modal ubah submenu
    $('#btn-ubah-submenu').on('click', function (e) {
        e.preventDefault();
        var id = $('#idubah').val();
        $.ajax({
            type: "POST",
            url: site_url + "submenu/ubah/" + id,
            data: $("#form-submenu").serialize(),
            dataType: 'JSON',
            beforeSend: function () {
                $('#btn-ubah-submenu').attr('disabled', 'disabled');
            },
            success: function (data) {
                if (data.status == 'gagal') {
                    Toast.fire({
                        type: 'error',
                        title: ' Input data tidak valid!!!.'
                    });
                    if (data.submenu_error != '') {
                        $('#submenu_error').html(data.submenu_error);
                    } else {
                        $('#submenu_error').html('');
                    }
                    if (data.menu_error != '') {
                        $('#menu_error').html(data.menu_error);
                    } else {
                        $('#menu_error').html('');
                    }
                    if (data.url_error != '') {
                        $('#url_error').html(data.url_error);
                    } else {
                        $('#url_error').html('');
                    }
                    if (data.icon_error != '') {
                        $('#icon_error').html(data.icon_error);
                    } else {
                        $('#icon_error').html('');
                    }
                    if (data.status_error != '') {
                        $('#status_error').html(data.status_error);
                    } else {
                        $('#status_error').html('');
                    }
                    $('#submenu').trigger('focus');
                } else {
                    Toast.fire({
                        type: 'success',
                        title: ' Data berhasil diubah!'
                    });
                    $('#modal-submenu').modal('hide');
                    //dataTable.ajax.reload();
                }
                $('#btn-ubah-submenu').attr('disabled', false);
            }
        });
        return false;
    });
    // end ajax tombol modal ubah submenu
    //--------------------------------------/SUBMENU----------------------------------------
    //---------------------------------------ACCESS USER----------------------------------------
    //ajax cekbox access user
    $('.frm-cek-access').on('click', function () {
        const submenuId = $(this).data('submenu');
        const roleId = $(this).data('role');
        $.ajax({
            url: site_url + "role/ubahaccess",
            type: 'post',
            data: {
                submenuId: submenuId,
                roleId: roleId
            },
            beforeSend: function () {
                // $('#btn-ubah-submenu').attr('disabled', 'disabled');
                //$(this).attr('disabled', 'disabled');
            },
            success: function () {
                Toast.fire({
                    type: 'success',
                    title: 'Hak akses berhasil diubah!'
                });
                //$(this).attr('disabled', false);
                // document.location.href = site_url + "role/access/" + roleId;
            }
        });
    });
    //end  ajax cekbox acess user
    //--------------------------------------/ACCESS USER----------------------------------------
    //---------------------------------------TAHUN BUKU----------------------------------------
    //set focus input tahunbuku saat modal muncul
    $('#modal-tahunbuku').on('shown.bs.modal', function () {
        $('#id').trigger('focus');
    })
    //set focus input tahunbuku saat modal muncul
    // tombol tambah tahunbuku table
    $('#btn-tambah-tahunbuku').on('click', function (e) {
        e.preventDefault();
        const judul = document.getElementById('judul-modal');
        judul.innerHTML = 'Tambah Data Tahun Pembukuan';
        $('#btn-ubah-tahunbuku').hide();
        $('#modal-tahunbuku').modal('show');
    });
    // end tombol tambah tahunbuku table
    // ajax tombol Simpan modal tahunbuku
    $('#btn-simpan-tahunbuku').on('click', function (e) {
        e.preventDefault();
        const id = $('[name="id"]').val();
        const awalPeriode = $('[name="awal_periode"]').val();
        const akhirPeriode = $('[name="akhir_periode"]').val();
        const keterangan = $('[name="keterangan"]').val();
        // const is_active = $('[name="is_active"]').val();
        $.ajax({

            type: "POST",
            url: base_url + "akuntansi/tahunbuku/simpan",
            data: {
                id: id,
                awal_periode: awalPeriode,
                akhir_periode: akhirPeriode,
                keterangan: keterangan
            },
            dataType: "JSON",
            beforeSend: function () {
                $('#btn-simpan-tahunbuku').attr('disabled', 'disabled');
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
                    $('#id').trigger('focus');
                } else {
                    Toast.fire({
                        type: 'success',
                        title: ' Data berhasil disimpan.'
                    });
                    $('#modal-tahunbuku').modal('hide');
                }
                $('#btn-simpan-tahunbuku').attr('disabled', false);
            }
        });
        return false;
    });
    //end  ajax tombol Simpan modal tahunbuku
    // ajax icon hapus table tahunbuku klik
    $('.btn-hapus-tahunbuku').on('click', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var info = $(this).data('info');
        Swal.fire({
            title: 'Konfirmasi!',
            text: 'apakah anda yakin akan menghapus Tahun Pembukuan -' + info + ' !?!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Batal',
            confirmButtonText: 'Hapus'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: base_url + "akuntansi/tahunbuku/hapus/" + id + "/" + info,
                    type: "POST",
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
    // end ajax icon hapus table tahunbuku klik
    // ajax tombol edit data table tahunbuku klik
    $('.btn-edit-tahunbuku').on('click', function (e) {
        e.preventDefault();
        const judul = document.getElementById('judul-modal');
        judul.innerHTML = 'Ubah Data Tahun Pembukuan';
        var id = $(this).data('id');
        $('#btn-simpan-tahunbuku').hide();
        $('#id').attr('disabled', 'disabled');
        $.ajax({
            url: base_url + 'akuntansi/tahunbuku/ajax_edit/' + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('[name="idubah"]').val(data.id);
                $('[name="id"]').val(data.id);
                $('[name="awal_periode"]').val(data.awal_periode);
                $('[name="akhir_periode"]').val(data.akhir_periode);
                $('[name="keterangan"]').val(data.keterangan);
                // $('[name="is_active"]').val(data.is_active);
                $('#modal-tahunbuku').modal('show');
                $('#id').trigger('focus');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });

    });
    //end ajax tombol edit data table tahunbuku klik
    // ajax tombol modal ubah tahunbuku
    $('#btn-ubah-tahunbuku').on('click', function (e) {
        e.preventDefault();
        const idubah = $('[name="idubah"]').val();
        const awalPeriode = $('[name="awal_periode"]').val();
        const akhirPeriode = $('[name="akhir_periode"]').val();
        const keterangan = $('[name="keterangan"]').val();
        $.ajax({
            type: "POST",
            url: base_url + "akuntansi/tahunbuku/ubah/" + idubah,
            data: {
                idubah: idubah,
                awal_periode: awalPeriode,
                akhir_periode: akhirPeriode,
                keterangan: keterangan
            },
            dataType: 'JSON',
            beforeSend: function () {
                $('#btn-ubah-tahunbuku').attr('disabled', 'disabled');
            },
            success: function (data) {
                if (data.status == 'gagal') {
                    Toast.fire({
                        type: 'error',
                        title: ' Input data tidak valid!!!.'
                    });
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
                    $('#modal-tahunbuku').modal('hide');
                    //dataTable.ajax.reload();
                }
                $('#btn-ubah-tahunbuku').attr('disabled', false);
            }
        });
        return false;
    });
    // end ajax tombol modal ubah tahunbuku
    // btn-aktif-tahunbuku
    $('.btn-aktif-tahunbuku').on('click', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var info = $(this).data('info');
        if (info == 0) {
            Swal.fire({
                title: 'Konfirmasi!',
                text: 'Apakah anda yakin akan mengaktifkan Tahun Pembukuan -' + id + '- !?!',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Batal',
                confirmButtonText: 'Aktif'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: base_url + "akuntansi/tahunbuku/tahunaktif/" + id,
                        type: "POST",
                        // dataType: 'JSON',
                        success: function () {
                            Toast.fire({
                                type: 'success',
                                title: ' Tahun' + id + ' berhasil diaktifkan!'
                            });
                            document.location.reload();
                        }
                    });
                }
            })
        }
    });
    // end btn-aktif-tahunbuku
    //--------------------------------------/TAHUN BUKU----------------------------------------
    //---------------------------------------TAHUN ANGGARAN------------------------------------
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
    //--------------------------------------/TAHUN ANGGARAN------------------------------------
    //---------------------------------------JENIS TRANSAKSI------------------------------------
    //set focus input jenistransaksi saat modal muncul
    $('#modal-jenistransaksi').on('shown.bs.modal', function () {
        $('#id').trigger('focus');
    })
    //set focus input jenistransaksi saat modal muncul
    // tombol tambah jenistransaksi table
    $('#btn-tambah-jenistransaksi').on('click', function (e) {
        e.preventDefault();
        const judul = document.getElementById('judul-modal');
        judul.innerHTML = 'Tambah Data Jenis Transaksi';
        $('#btn-ubah-jenistransaksi').hide();
        $('#modal-jenistransaksi').modal('show');
    });
    // end tombol tambah jenistransaksi table
    // ajax tombol Simpan modal jenistransaksi
    $('#btn-simpan-jenistransaksi').on('click', function (e) {
        e.preventDefault();
        const id = $('[name="id"]').val();
        const jenis_transaksi = $('[name="jenis_transaksi"]').val();
        // const is_active = $('[name="is_active"]').val();
        $.ajax({

            type: "POST",
            url: base_url + "akuntansi/jenistransaksi/simpan",
            data: {
                id: id,
                jenis_transaksi: jenis_transaksi,
            },
            dataType: "JSON",
            beforeSend: function () {
                $('#btn-simpan-jenistransaksi').attr('disabled', 'disabled');
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
                    if (data.jenis_transaksi_error != '') {
                        $('#jenis_transaksi_error').html(data.jenis_transaksi_error);
                    } else {
                        $('#jenis_transaksi_error').html('');
                    }
                    $('#id').trigger('focus');
                } else {
                    Toast.fire({
                        type: 'success',
                        title: ' Data berhasil disimpan.'
                    });
                    $('#modal-jenistransaksi').modal('hide');
                }
                $('#btn-simpan-jenistransaksi').attr('disabled', false);
            }
        });
        return false;
    });
    //end  ajax tombol Simpan modal jenistransaksi
    // ajax icon hapus table jenistransaksi klik
    $('.btn-hapus-jenistransaksi').on('click', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var info = $(this).data('info');
        Swal.fire({
            title: 'Konfirmasi!',
            text: 'Apakah anda yakin akan menghapus Jenis Transaksi -' + info + '- !?!',
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
                    url: base_url + "akuntansi/jenistransaksi/hapus/",
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
    // end ajax icon hapus table jenistransaksi klik
    // ajax tombol edit data table jenistransaksi klik
    $('.btn-edit-jenistransaksi').on('click', function (e) {
        e.preventDefault();
        const judul = document.getElementById('judul-modal');
        judul.innerHTML = 'Ubah Data Jenis Transaksi';
        var id = $(this).data('id');
        $('#btn-simpan-jenistransaksi').hide();
        $('#id').attr('disabled', 'disabled');
        $.ajax({
            url: base_url + 'akuntansi/jenistransaksi/ajax_edit/' + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('[name="id"]').val(data.id);
                $('[name="idubah"]').val(data.id);
                $('[name="jenis_transaksi"]').val(data.jenis_transaksi);
                $('#modal-jenistransaksi').modal('show');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    });
    //end ajax tombol edit data table jenistransaksi klik
    // ajax tombol modal ubah jenistransaksi
    $('#btn-ubah-jenistransaksi').on('click', function (e) {
        e.preventDefault();
        const idubah = $('[name="idubah"]').val();
        const jenis_transaksi = $('[name="jenis_transaksi"]').val();
        $.ajax({
            type: "POST",
            url: base_url + "akuntansi/jenistransaksi/ubah/" + idubah,
            data: {
                idubah: idubah,
                jenis_transaksi: jenis_transaksi
            },
            dataType: 'JSON',
            beforeSend: function () {
                $('#btn-ubah-jenistransaksi').attr('disabled', 'disabled');
            },
            success: function (data) {
                if (data.status == 'gagal') {
                    Toast.fire({
                        type: 'error',
                        title: ' Input data tidak valid!!!.'
                    });
                    if (data.jenis_transaksi_error != '') {
                        $('#jenis_transaksi_error').html(data.jenis_transaksi_error);

                    } else {
                        $('#jenis_transaksi_error').html('');
                    }
                    $('#jenis_transaksi').trigger('focus');
                } else {
                    Toast.fire({
                        type: 'success',
                        title: ' Data berhasil diubah!'
                    });
                    $('#modal-jenistransaksi').modal('hide');
                    //dataTable.ajax.reload();
                }
                $('#btn-ubah-jenistransaksi').attr('disabled', false);
            }
        });
        return false;
    });
    // end ajax tombol modal ubah jenistransaksi

    //--------------------------------------/JENIS TRANSAKSI------------------------------------
    //---------------------------------------KODEPERKIRAAN------------------------------------
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
                }
                $('#btn-ubah-level6').attr('disabled', false);
            }
        });
        return false;
    });
    // end ajax tombol modal ubah level6
    //--------------------------------------/KODEPERKIRAAN------------------------------------
    //---------------------------------------AKUN TRANSAKSI CEKBOX----------------------------
    //ajax cekbox akun transaksi
    $('.frm-cek-akuntransaksi').on('click', function (e) {
        const tranId = $(this).data('tranid');
        const level6Id = $(this).data('level6id');
        $.ajax({
            url: base_url + "akuntansi/jenistransaksi/ubahakun",
            type: 'post',
            data: {
                jenis_transaksi_id: tranId,
                a6level_id: level6Id
            },
            success: function () {
                Toast.fire({
                    type: 'success',
                    title: 'akun transaksi berhasil diperbaharui!'
                });
            }
        });
    });
    //end ajax cekbox akun transaksi
    //--------------------------------------/AKUN TRANSAKSI CEKBOX----------------------------
    //---------------------------------------KODE ANGGARAN------------------------------------
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
    //--------------------------------------/KODE ANGGARAN------------------------------------
    //---------------------------------------SALDOAWAL------------------------------------
    //set focus input saldoawal saat modal muncul
    $('#modal-saldoawal').on('shown.bs.modal', function () {
        $('#saldoawal').trigger('focus');
    })
    //set focus input saldoawal saat modal muncul
    // btn simpan saldoawal modal
    $('#btn-simpan-saldoawal').on('click', function (e) {
        e.preventDefault();
        const a6level_id = $('[name="a6level_id"]').val();
        const tahunbuku = $('[name="tahun_pembukuan_id"]').val();
        const saldo = $('[name="saldoawal"]').val();
        $.ajax({
            type: "POST",
            url: base_url + "akuntansi/saldoawal/simpan",
            data: {
                a6level_id: a6level_id,
                tahun_pembukuan_id: tahunbuku,
                saldoawal: saldo
            },
            dataType: "JSON",
            beforeSend: function () {
                $('#btn-simpan-saldoawal').attr('disabled', 'disabled');
            },
            success: function (data) {
                if (data.status == 'gagal') {
                    Toast.fire({
                        type: 'error',
                        title: ' Input data tidak valid!!!.'
                    });
                    if (data.saldoawal_error != '') {
                        $('#saldoawal_error').html(data.saldoawal_error);
                    } else {
                        $('#saldoawal_error').html('');
                    }
                    $('#saldoawal').trigger('focus');
                } else {
                    Toast.fire({
                        type: 'success',
                        title: ' Pengaturan saldo berhasil.'
                    });
                    $('#modal-saldoawal').modal('hide');
                }
                $('#btn-simpan-saldoawal').attr('disabled', false);
            }
        });
        return false;

    });
    // end btn simpan saldoawal modal
    // ajax tombol edit data table saldoawal klik
    $('.btn-edit-saldoawal').on('click', function (e) {
        e.preventDefault();
        const judul = document.getElementById('judul-modal');
        judul.innerHTML = 'Atur saldo awal';
        const thbuku_id = $(this).data('thbukuid');
        const akun_id = $(this).data('akunid');
        const level6 = $(this).data('info');
        $.ajax({
            url: base_url + 'akuntansi/saldoawal/ajax_edit',
            type: "POST",
            data: {
                a6level_id: akun_id,
                tahun_pembukuan_id: thbuku_id,
                level6: level6
            },
            dataType: "JSON",
            success: function (data) {
                if (data.status == 'ubah') {
                    $('[name="idubah"]').val(data.id);
                    $('[name="a6level_id"]').val(data.a6level_id);
                    $('[name="level6"]').val(data.level6);
                    $('[name="tahun_pembukuan_id"]').val(data.tahun_pembukuan_id);
                    $('[name="saldoawal"]').val(data.saldoawal);
                    $('[name="saldo"]').val(data.saldoawal);
                    $('#btn-simpan-saldoawal').hide();
                    $('#modal-saldoawal').modal('show');
                    $('#saldoawal').trigger('focus');
                } else {
                    $('[name="a6level_id"]').val(data.a6level_id);
                    $('[name="level6"]').val(data.level6);
                    $('[name="tahun_pembukuan_id"]').val(data.tahun_pembukuan_id);
                    $('#btn-ubah-saldoawal').hide();
                    $('#modal-saldoawal').modal('show');
                    $('#saldoawal').trigger('focus');
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    });
    //end ajax tombol edit data table saldoawal klik
    // ajax icon hapus table level6 klik
    $('.btn-hapus-saldoawal').on('click', function (e) {
        e.preventDefault();
        var thbuku_id = $(this).data('thbukuid');
        var akun_id = $(this).data('akunid');
        var info = $(this).data('info');
        Swal.fire({
            title: 'Konfirmasi!',
            text: 'Anda yakin akan menghapus Saldo Akun -' + info + '- !?!',
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
                    url: base_url + "akuntansi/saldoawal/hapus",
                    data: {
                        tahun_pembukuan_id: thbuku_id,
                        a6level_id: akun_id,
                        info: info
                    },
                    dataType: 'JSON',
                    success: function (data) {
                        if (data.status == 'sukses') {
                            Toast.fire({
                                type: 'success',
                                title: ' Saldo berhasil dihapus!!!.'
                            });

                            document.location.reload();
                        } else {
                            Toast.fire({
                                type: 'warning',
                                title: 'Akun tidak meiliki saldo!!!.'
                            });
                        }
                    }
                });
            }
        })
    });
    // end ajax icon hapus table saldoawal klik
    // ajax tombol modal ubah saldoawal
    $('#btn-ubah-saldoawal').on('click', function (e) {
        e.preventDefault();
        const idubah = $('[name="idubah"]').val();
        const thbuku_id = $('[name="tahun_pembukuan_id"]').val();
        const akun_id = $('[name="a6level_id"]').val();
        const saldo = $('[name="saldoawal"]').val();
        $.ajax({
            type: "POST",
            url: base_url + "akuntansi/saldoawal/ubah",
            data: {
                id: idubah,
                tahun_pembukuan_id: thbuku_id,
                a6level_id: akun_id,
                saldoawal: saldo
            },
            dataType: 'JSON',
            beforeSend: function () {
                $('#btn-ubah-saldoawal').attr('disabled', 'disabled');
            },
            success: function (data) {
                if (data.status == 'gagal') {
                    Toast.fire({
                        type: 'error',
                        title: ' Input data tidak valid!!!.'
                    });
                    if (data.saldoawal_error != '') {
                        $('#saldoawal_error').html(data.saldoawal_error);

                    } else {
                        $('#saldoawal_error').html('');
                    }
                    $('#saldoawal').trigger('focus');
                } else {
                    Toast.fire({
                        type: 'success',
                        title: ' Data berhasil diubah!'
                    });
                    $('#modal-saldoawal').modal('hide');
                    //dataTable.ajax.reload();
                }
                $('#btn-ubah-saldoawal').attr('disabled', false);
            }
        });
        return false;
    });
    // end ajax tombol modal ubah saldoawal
    //--------------------------------------/SALDOAWAL------------------------------------
    //---------------------------------------ANGKATAN------------------------------------

    //set focus input angkatan saat modal muncul
    $('#modal-angkatan').on('shown.bs.modal', function () {
        $('#angkatan').trigger('focus');
    })
    //set focus input angkatan saat modal muncul
    // tombol tambah angkatan table
    $('#btn-tambah-angkatan').on('click', function (e) {
        e.preventDefault();
        const judul = document.getElementById('judul-modal');
        judul.innerHTML = 'Tambah Data Angkatan';
        $('#btn-ubah-angkatan').hide();
        $('#modal-angkatan').modal('show');
    });
    // end tombol tambah angkatan table
    // ajax tombol Simpan modal angkatan
    $('#btn-simpan-angkatan').on('click', function (e) {
        e.preventDefault();
        const id = $('[name="id"]').val();
        const angkatan = $('[name="angkatan"]').val();
        // const is_active = $('[name="is_active"]').val();
        $.ajax({

            type: "POST",
            url: base_url + "akademik/angkatan/simpan",
            data: {
                id: id,
                angkatan: angkatan,
            },
            dataType: "JSON",
            beforeSend: function () {
                $('#btn-simpan-angkatan').attr('disabled', 'disabled');
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
                    if (data.angkatan_error != '') {
                        $('#angkatan_error').html(data.angkatan_error);
                    } else {
                        $('#angkatan_error').html('');
                    }
                    $('#id').trigger('focus');
                } else {
                    Toast.fire({
                        type: 'success',
                        title: ' Data berhasil disimpan.'
                    });
                    $('#modal-angkatan').modal('hide');
                }
                $('#btn-simpan-angkatan').attr('disabled', false);
            }
        });
        return false;
    });
    //end  ajax tombol Simpan modal angkatan
    // ajax icon hapus table angkatan klik
    $('.btn-hapus-angkatan').on('click', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var info = $(this).data('info');
        Swal.fire({
            title: 'Konfirmasi!',
            text: 'Apakah anda yakin akan menghapus Angkatan -' + info + '- !?!',
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
                    url: base_url + "akademik/angkatan/hapus/",
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
    // end ajax icon hapus table angkatan klik
    // ajax tombol edit data table angkatan klik
    $('.btn-edit-angkatan').on('click', function (e) {
        e.preventDefault();
        const judul = document.getElementById('judul-modal');
        judul.innerHTML = 'Ubah Data Angkatan';
        var id = $(this).data('id');
        $('#btn-simpan-angkatan').hide();
        $('#id').attr('disabled', 'disabled');
        $.ajax({
            url: base_url + 'akademik/angkatan/ajax_edit/' + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('[name="id"]').val(data.id);
                $('[name="idubah"]').val(data.id);
                $('[name="angkatan"]').val(data.angkatan);
                $('#modal-angkatan').modal('show');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    });
    //end ajax tombol edit data table angkatan klik
    // ajax tombol modal ubah angkatan
    $('#btn-ubah-angkatan').on('click', function (e) {
        e.preventDefault();
        const idubah = $('[name="idubah"]').val();
        const angkatan = $('[name="angkatan"]').val();
        $.ajax({
            type: "POST",
            url: base_url + "akademik/angkatan/ubah/" + idubah,
            data: {
                idubah: idubah,
                angkatan: angkatan
            },
            dataType: 'JSON',
            beforeSend: function () {
                $('#btn-ubah-angkatan').attr('disabled', 'disabled');
            },
            success: function (data) {
                if (data.status == 'gagal') {
                    Toast.fire({
                        type: 'error',
                        title: ' Input data tidak valid!!!.'
                    });
                    if (data.angkatan_error != '') {
                        $('#angkatan_error').html(data.angkatan_error);

                    } else {
                        $('#angkatan_error').html('');
                    }
                    $('#angkatan').trigger('focus');
                } else {
                    Toast.fire({
                        type: 'success',
                        title: ' Data berhasil diubah!'
                    });
                    $('#modal-angkatan').modal('hide');
                    //dataTable.ajax.reload();
                }
                $('#btn-ubah-angkatan').attr('disabled', false);
            }
        });
        return false;
    });
    // end ajax tombol modal ubah angkatan
    //--------------------------------------/ANGKATAN------------------------------------
    //---------------------------------------JENJANG------------------------------------

    //set focus input jenjang saat modal muncul
    $('#modal-jenjang').on('shown.bs.modal', function () {
        $('#id').trigger('focus');
    })
    //set focus input jenjang saat modal muncul
    // tombol tambah jenjang table
    $('#btn-tambah-jenjang').on('click', function (e) {
        e.preventDefault();
        const judul = document.getElementById('judul-modal');
        judul.innerHTML = 'Tambah Data Jenjang Pendidikan';
        $('#btn-ubah-jenjang').hide();
        $('#modal-jenjang').modal('show');
    });
    // end tombol tambah jenjang table
    // ajax tombol Simpan modal jenjang
    $('#btn-simpan-jenjang').on('click', function (e) {
        e.preventDefault();
        const id = $('[name="id"]').val();
        const jenjang = $('[name="jenjang"]').val();
        // const is_active = $('[name="is_active"]').val();
        $.ajax({

            type: "POST",
            url: base_url + "akademik/jenjang/simpan",
            data: {
                id: id,
                jenjang: jenjang,
            },
            dataType: "JSON",
            beforeSend: function () {
                $('#btn-simpan-jenjang').attr('disabled', 'disabled');
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
                    if (data.jenjang_error != '') {
                        $('#jenjang_error').html(data.jenjang_error);
                    } else {
                        $('#jenjang_error').html('');
                    }
                    $('#id').trigger('focus');
                } else {
                    Toast.fire({
                        type: 'success',
                        title: ' Data berhasil disimpan.'
                    });
                    $('#modal-jenjang').modal('hide');
                }
                $('#btn-simpan-jenjang').attr('disabled', false);
            }
        });
        return false;
    });
    //end  ajax tombol Simpan modal jenjang
    // ajax icon hapus table jenjang klik
    $('.btn-hapus-jenjang').on('click', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var info = $(this).data('info');
        Swal.fire({
            title: 'Konfirmasi!',
            text: 'Apakah anda yakin akan menghapus Jenjang -' + info + '- !?!',
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
                    url: base_url + "akademik/jenjang/hapus/",
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
    // end ajax icon hapus table jenjang klik
    // ajax tombol edit data table jenjang klik
    $('.btn-edit-jenjang').on('click', function (e) {
        e.preventDefault();
        const judul = document.getElementById('judul-modal');
        judul.innerHTML = 'Ubah Data Jenjang Pendidikan';
        var id = $(this).data('id');
        $('#btn-simpan-jenjang').hide();
        $('#id').attr('disabled', 'disabled');
        $.ajax({
            url: base_url + 'akademik/jenjang/ajax_edit/' + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('[name="id"]').val(data.id);
                $('[name="idubah"]').val(data.id);
                $('[name="jenjang"]').val(data.jenjang);
                $('#modal-jenjang').modal('show');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    });
    //end ajax tombol edit data table jenjang klik
    // ajax tombol modal ubah jenjang
    $('#btn-ubah-jenjang').on('click', function (e) {
        e.preventDefault();
        const idubah = $('[name="idubah"]').val();
        const jenjang = $('[name="jenjang"]').val();
        $.ajax({
            type: "POST",
            url: base_url + "akademik/jenjang/ubah/" + idubah,
            data: {
                idubah: idubah,
                jenjang: jenjang
            },
            dataType: 'JSON',
            beforeSend: function () {
                $('#btn-ubah-jenjang').attr('disabled', 'disabled');
            },
            success: function (data) {
                if (data.status == 'gagal') {
                    Toast.fire({
                        type: 'error',
                        title: ' Input data tidak valid!!!.'
                    });
                    if (data.jenjang_error != '') {
                        $('#jenjang_error').html(data.jenjang_error);

                    } else {
                        $('#jenjang_error').html('');
                    }
                    $('#jenjang').trigger('focus');
                } else {
                    Toast.fire({
                        type: 'success',
                        title: ' Data berhasil diubah!'
                    });
                    $('#modal-jenjang').modal('hide');
                    //dataTable.ajax.reload();
                }
                $('#btn-ubah-jenjang').attr('disabled', false);
            }
        });
        return false;
    });
    // end ajax tombol modal ubah jenjang

    //--------------------------------------/JENJANG------------------------------------
    //----------------------------------------JALUR------------------------------------

    //set focus input jalur saat modal muncul
    $('#modal-jalur').on('shown.bs.modal', function () {
        $('#jalur').trigger('focus');
    })
    //set focus input jalur saat modal muncul
    // tombol tambah jalur table
    $('#btn-tambah-jalur').on('click', function (e) {
        e.preventDefault();
        const judul = document.getElementById('judul-modal');
        judul.innerHTML = 'Tambah Data Jalur Pendidikan';
        $('#btn-ubah-jalur').hide();
        $('#modal-jalur').modal('show');
    });
    // end tombol tambah jalur table
    // ajax tombol Simpan modal jalur
    $('#btn-simpan-jalur').on('click', function (e) {
        e.preventDefault();
        //const id = $('[name="id"]').val();
        const jalur = $('[name="jalur"]').val();
        // const is_active = $('[name="is_active"]').val();
        $.ajax({

            type: "POST",
            url: base_url + "akademik/jalur/simpan",
            data: {
                jalur: jalur
            },
            dataType: "JSON",
            beforeSend: function () {
                $('#btn-simpan-jalur').attr('disabled', 'disabled');
            },
            success: function (data) {
                if (data.status == 'gagal') {
                    Toast.fire({
                        type: 'error',
                        title: ' Input data tidak valid!!!.'
                    });
                    if (data.jalur_error != '') {
                        $('#jalur_error').html(data.jalur_error);
                    } else {
                        $('#jalur_error').html('');
                    }
                    $('#id').trigger('focus');
                } else {
                    Toast.fire({
                        type: 'success',
                        title: ' Data berhasil disimpan.'
                    });
                    $('#modal-jalur').modal('hide');
                }
                $('#btn-simpan-jalur').attr('disabled', false);
            }
        });
        return false;
    });
    //end  ajax tombol Simpan modal jalur
    // ajax icon hapus table jalur klik
    $('.btn-hapus-jalur').on('click', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var info = $(this).data('info');
        Swal.fire({
            title: 'Konfirmasi!',
            text: 'Apakah anda yakin akan menghapus Jalur Pendidikan -' + info + '- !?!',
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
                    url: base_url + "akademik/jalur/hapus/",
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
    // end ajax icon hapus table jalur klik
    // ajax tombol edit data table jalur klik
    $('.btn-edit-jalur').on('click', function (e) {
        e.preventDefault();
        const judul = document.getElementById('judul-modal');
        judul.innerHTML = 'Ubah Data Jalur Pendidikan';
        var id = $(this).data('id');
        $('#btn-simpan-jalur').hide();
        // $('#id').attr('disabled', 'disabled');
        $.ajax({
            url: base_url + 'akademik/jalur/ajax_edit/' + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                // $('[name="id"]').val(data.id);
                $('[name="idubah"]').val(data.id);
                $('[name="jalur"]').val(data.jalur);
                $('#modal-jalur').modal('show');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    });
    //end ajax tombol edit data table jalur klik
    // ajax tombol modal ubah jalur
    $('#btn-ubah-jalur').on('click', function (e) {
        e.preventDefault();
        const idubah = $('[name="idubah"]').val();
        const jalur = $('[name="jalur"]').val();
        $.ajax({
            type: "POST",
            url: base_url + "akademik/jalur/ubah/" + idubah,
            data: {
                idubah: idubah,
                jalur: jalur
            },
            dataType: 'JSON',
            beforeSend: function () {
                $('#btn-ubah-jalur').attr('disabled', 'disabled');
            },
            success: function (data) {
                if (data.status == 'gagal') {
                    Toast.fire({
                        type: 'error',
                        title: ' Input data tidak valid!!!.'
                    });
                    if (data.jalur_error != '') {
                        $('#jalur_error').html(data.jalur_error);

                    } else {
                        $('#jalur_error').html('');
                    }
                    $('#jalur').trigger('focus');
                } else {
                    Toast.fire({
                        type: 'success',
                        title: ' Data berhasil diubah!'
                    });
                    $('#modal-jalur').modal('hide');
                    //dataTable.ajax.reload();
                }
                $('#btn-ubah-jalur').attr('disabled', false);
            }
        });
        return false;
    });
    // end ajax tombol modal ubah jalur

    //---------------------------------------/JALUR------------------------------------
    //----------------------------------------TINGKAT------------------------------------

    //set focus input tingkat saat modal muncul
    $('#modal-tingkat').on('shown.bs.modal', function () {
        $('#tingkat').trigger('focus');
    })
    //set focus input tingkat saat modal muncul
    // tombol tambah tingkat table
    $('#btn-tambah-tingkat').on('click', function (e) {
        e.preventDefault();
        const judul = document.getElementById('judul-modal');
        judul.innerHTML = 'Tambah Data Tingkat Pendidikan';
        $('#btn-ubah-tingkat').hide();
        $('#modal-tingkat').modal('show');
    });
    // end tombol tambah tingkat table
    // ajax tombol Simpan modal tingkat
    $('#btn-simpan-tingkat').on('click', function (e) {
        e.preventDefault();
        const id = $('[name="id"]').val();
        const tingkat = $('[name="tingkat"]').val();
        // const is_active = $('[name="is_active"]').val();
        $.ajax({

            type: "POST",
            url: base_url + "akademik/tingkat/simpan",
            data: {
                id: id,
                tingkat: tingkat,
            },
            dataType: "JSON",
            beforeSend: function () {
                $('#btn-simpan-tingkat').attr('disabled', 'disabled');
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
                    if (data.tingkat_error != '') {
                        $('#tingkat_error').html(data.tingkat_error);
                    } else {
                        $('#tingkat_error').html('');
                    }
                    $('#id').trigger('focus');
                } else {
                    Toast.fire({
                        type: 'success',
                        title: ' Data berhasil disimpan.'
                    });
                    $('#modal-tingkat').modal('hide');
                }
                $('#btn-simpan-tingkat').attr('disabled', false);
            }
        });
        return false;
    });
    //end  ajax tombol Simpan modal tingkat
    // ajax icon hapus table tingkat klik
    $('.btn-hapus-tingkat').on('click', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var info = $(this).data('info');
        Swal.fire({
            title: 'Konfirmasi!',
            text: 'Apakah anda yakin akan menghapus Tingkat Pendidikan -' + info + '- !?!',
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
                    url: base_url + "akademik/tingkat/hapus/",
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
    // end ajax icon hapus table tingkat klik
    // ajax tombol edit data table tingkat klik
    $('.btn-edit-tingkat').on('click', function (e) {
        e.preventDefault();
        const judul = document.getElementById('judul-modal');
        judul.innerHTML = 'Ubah Data Tingkat Pendidikan';
        var id = $(this).data('id');
        $('#btn-simpan-tingkat').hide();
        $('#id').attr('disabled', 'disabled');
        $.ajax({
            url: base_url + 'akademik/tingkat/ajax_edit/' + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('[name="id"]').val(data.id);
                $('[name="idubah"]').val(data.id);
                $('[name="tingkat"]').val(data.tingkat);
                $('#modal-tingkat').modal('show');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    });
    //end ajax tombol edit data table tingkat klik
    // ajax tombol modal ubah tingkat
    $('#btn-ubah-tingkat').on('click', function (e) {
        e.preventDefault();
        const idubah = $('[name="idubah"]').val();
        const tingkat = $('[name="tingkat"]').val();
        $.ajax({
            type: "POST",
            url: base_url + "akademik/tingkat/ubah/" + idubah,
            data: {
                idubah: idubah,
                tingkat: tingkat
            },
            dataType: 'JSON',
            beforeSend: function () {
                $('#btn-ubah-tingkat').attr('disabled', 'disabled');
            },
            success: function (data) {
                if (data.status == 'gagal') {
                    Toast.fire({
                        type: 'error',
                        title: ' Input data tidak valid!!!.'
                    });
                    if (data.tingkat_error != '') {
                        $('#tingkat_error').html(data.tingkat_error);

                    } else {
                        $('#tingkat_error').html('');
                    }
                    $('#tingkat').trigger('focus');
                } else {
                    Toast.fire({
                        type: 'success',
                        title: ' Data berhasil diubah!'
                    });
                    $('#modal-tingkat').modal('hide');
                    //dataTable.ajax.reload();
                }
                $('#btn-ubah-tingkat').attr('disabled', false);
            }
        });
        return false;
    });
    // end ajax tombol modal ubah tingkat

    //---------------------------------------/TINGKAT------------------------------------
    //----------------------------------------SEMESTER------------------------------------

    //set focus input semester saat modal muncul
    $('#modal-semester').on('shown.bs.modal', function () {
        $('#semester').trigger('focus');
    })
    //set focus input semester saat modal muncul
    // tombol tambah semester table
    $('#btn-tambah-semester').on('click', function (e) {
        e.preventDefault();
        const judul = document.getElementById('judul-modal');
        judul.innerHTML = 'Tambah Data Semester Pendidikan';
        $('#btn-ubah-semester').hide();
        $('#modal-semester').modal('show');
    });
    // end tombol tambah semester table
    // ajax tombol Simpan modal semester
    $('#btn-simpan-semester').on('click', function (e) {
        e.preventDefault();
        //const id = $('[name="id"]').val();
        const semester = $('[name="semester"]').val();
        // const is_active = $('[name="is_active"]').val();
        $.ajax({

            type: "POST",
            url: base_url + "akademik/semester/simpan",
            data: {
                //id: id,
                semester: semester,
            },
            dataType: "JSON",
            beforeSend: function () {
                $('#btn-simpan-semester').attr('disabled', 'disabled');
            },
            success: function (data) {
                if (data.status == 'gagal') {
                    Toast.fire({
                        type: 'error',
                        title: ' Input data tidak valid!!!.'
                    });
                    // if (data.kode_error != '') {
                    //     $('#kode_error').html(data.kode_error);
                    // } else {
                    //     $('#kode_error').html('');
                    // }
                    if (data.semester_error != '') {
                        $('#semester_error').html(data.semester_error);
                    } else {
                        $('#semester_error').html('');
                    }
                    $('#id').trigger('focus');
                } else {
                    Toast.fire({
                        type: 'success',
                        title: ' Data berhasil disimpan.'
                    });
                    $('#modal-semester').modal('hide');
                }
                $('#btn-simpan-semester').attr('disabled', false);
            }
        });
        return false;
    });
    //end  ajax tombol Simpan modal semester
    // ajax icon hapus table semester klik
    $('.btn-hapus-semester').on('click', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var info = $(this).data('info');
        Swal.fire({
            title: 'Konfirmasi!',
            text: 'Apakah anda yakin akan menghapus Semester Pendidikan -' + info + '- !?!',
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
                    url: base_url + "akademik/semester/hapus/",
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
    // end ajax icon hapus table semester klik
    // ajax tombol edit data table semester klik
    $('.btn-edit-semester').on('click', function (e) {
        e.preventDefault();
        const judul = document.getElementById('judul-modal');
        judul.innerHTML = 'Ubah Data Semester Pendidikan';
        var id = $(this).data('id');
        $('#btn-simpan-semester').hide();
        $('#id').attr('disabled', 'disabled');
        $.ajax({
            url: base_url + 'akademik/semester/ajax_edit/' + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('[name="id"]').val(data.id);
                $('[name="idubah"]').val(data.id);
                $('[name="semester"]').val(data.semester);
                $('#modal-semester').modal('show');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    });
    //end ajax tombol edit data table semester klik
    // ajax tombol modal ubah semester
    $('#btn-ubah-semester').on('click', function (e) {
        e.preventDefault();
        const idubah = $('[name="idubah"]').val();
        const semester = $('[name="semester"]').val();
        $.ajax({
            type: "POST",
            url: base_url + "akademik/semester/ubah/" + idubah,
            data: {
                idubah: idubah,
                semester: semester
            },
            dataType: 'JSON',
            beforeSend: function () {
                $('#btn-ubah-semester').attr('disabled', 'disabled');
            },
            success: function (data) {
                if (data.status == 'gagal') {
                    Toast.fire({
                        type: 'error',
                        title: ' Input data tidak valid!!!.'
                    });
                    if (data.semester_error != '') {
                        $('#semester_error').html(data.semester_error);

                    } else {
                        $('#semester_error').html('');
                    }
                    $('#semester').trigger('focus');
                } else {
                    Toast.fire({
                        type: 'success',
                        title: ' Data berhasil diubah!'
                    });
                    $('#modal-semester').modal('hide');
                    //dataTable.ajax.reload();
                }
                $('#btn-ubah-semester').attr('disabled', false);
            }
        });
        return false;
    });
    // end ajax tombol modal ubah semester

    //---------------------------------------/SEMESTER------------------------------------
    //----------------------------------------TAHUN AJARAN------------------------------------

    //set focus input tahunajaran saat modal muncul
    $('#modal-tahunajaran').on('shown.bs.modal', function () {
        $('#tahun_ajaran').trigger('focus');
    })
    //set focus input tahunajaran saat modal muncul
    // tombol tambah tahunajaran table
    $('#btn-tambah-tahunajaran').on('click', function (e) {
        e.preventDefault();
        const judul = document.getElementById('judul-modal');
        judul.innerHTML = 'Tambah Data Tahun Ajaran';
        $('#btn-ubah-tahunajaran').hide();
        $('#modal-tahunajaran').modal('show');
    });
    // end tombol tambah tahunajaran table
    // ajax tombol Simpan modal tahunajaran
    $('#btn-simpan-tahunajaran').on('click', function (e) {
        e.preventDefault();
        //const id = $('[name="id"]').val();
        const tahunAjaran = $('[name="tahun_ajaran"]').val();
        const awalPeriode = $('[name="awal_periode"]').val();
        const akhirPeriode = $('[name="akhir_periode"]').val();
        // const is_active = $('[name="is_active"]').val();
        $.ajax({

            type: "POST",
            url: base_url + "akademik/tahunajaran/simpan",
            data: {
                //id: id,
                tahun_ajaran: tahunAjaran,
                awal_periode: awalPeriode,
                akhir_periode: akhirPeriode
            },
            dataType: "JSON",
            beforeSend: function () {
                $('#btn-simpan-tahunajaran').attr('disabled', 'disabled');
            },
            success: function (data) {
                if (data.status == 'gagal') {
                    Toast.fire({
                        type: 'error',
                        title: ' Input data tidak valid!!!.'
                    });
                    if (data.tahun_ajaran_error != '') {
                        $('#tahun_ajaran_error').html(data.tahun_ajaran_error);
                    } else {
                        $('#tahun_ajaran_error').html('');
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
                    $('#tahun_ajaran').trigger('focus');
                } else {
                    Toast.fire({
                        type: 'success',
                        title: ' Data berhasil disimpan.'
                    });
                    $('#modal-tahunajaran').modal('hide');
                }
                $('#btn-simpan-tahunajaran').attr('disabled', false);
            }
        });
        return false;
    });
    //end  ajax tombol Simpan modal tahunajaran
    // ajax icon hapus table tahunajaran klik
    $('.btn-hapus-tahunajaran').on('click', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var info = $(this).data('info');
        Swal.fire({
            title: 'Konfirmasi!',
            text: 'Apakah anda yakin akan menghapus Tahun Ajaran -' + info + '- !?!',
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
                    url: base_url + "akademik/tahunajaran/hapus/",
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
    // end ajax icon hapus table tahunajaran klik
    // ajax tombol edit data table tahunajaran klik
    $('.btn-edit-tahunajaran').on('click', function (e) {
        e.preventDefault();
        const judul = document.getElementById('judul-modal');
        judul.innerHTML = 'Ubah Data Tahun Ajaran';
        var id = $(this).data('id');
        $('#btn-simpan-tahunajaran').hide();
        $('#id').attr('disabled', 'disabled');
        $.ajax({
            url: base_url + 'akademik/tahunajaran/ajax_edit/' + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('[name="idubah"]').val(data.id);
                $('[name="tahun_ajaran"]').val(data.tahun_ajaran);
                $('[name="awal_periode"]').val(data.awal_periode);
                $('[name="akhir_periode"]').val(data.akhir_periode);
                $('#modal-tahunajaran').modal('show');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    });
    //end ajax tombol edit data table tahunajaran klik
    // ajax tombol modal ubah tahunajaran
    $('#btn-ubah-tahunajaran').on('click', function (e) {
        e.preventDefault();
        const idubah = $('[name="idubah"]').val();
        const tahunAjaran = $('[name="tahun_ajaran"]').val();
        const awalPeriode = $('[name="awal_periode"]').val();
        const akhirPeriode = $('[name="akhir_periode"]').val();
        $.ajax({
            type: "POST",
            url: base_url + "akademik/tahunajaran/ubah/" + idubah,
            data: {
                tahun_ajaran: tahunAjaran,
                awal_periode: awalPeriode,
                akhir_periode: akhirPeriode
            },
            dataType: 'JSON',
            beforeSend: function () {
                $('#btn-ubah-tahunajaran').attr('disabled', 'disabled');
            },
            success: function (data) {
                if (data.status == 'gagal') {
                    Toast.fire({
                        type: 'error',
                        title: ' Input data tidak valid!!!.'
                    });
                    if (data.tahun_ajaran_error != '') {
                        $('#tahun_ajaran_error').html(data.tahun_ajaran_error);

                    } else {
                        $('#tahun_ajaran_error').html('');
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
                    $('#tahun_ajaran').trigger('focus');
                } else {
                    Toast.fire({
                        type: 'success',
                        title: ' Data berhasil diubah!'
                    });
                    $('#modal-tahunajaran').modal('hide');
                    //dataTable.ajax.reload();
                }
                $('#btn-ubah-tahunajaran').attr('disabled', false);
            }
        });
        return false;
    });
    // end ajax tombol modal ubah tahunajaran

    //---------------------------------------/TAHUN AJARAN------------------------------------



}); // end document ready
