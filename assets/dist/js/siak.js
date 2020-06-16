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
                        icon: 'error',
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
                        icon: 'success',
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
            icon: 'warning',
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
                        icon: 'error',
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
                        icon: 'success',
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
                        icon: 'error',
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
                        icon: 'success',
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
            icon: 'warning',
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
                        icon: 'error',
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
                        icon: 'success',
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
                        icon: 'error',
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
                        icon: 'success',
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
            icon: 'warning',
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
                        icon: 'error',
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
                        icon: 'success',
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
                        icon: 'error',
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
                        icon: 'success',
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
            icon: 'warning',
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
                        icon: 'error',
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
                        icon: 'success',
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
                        icon: 'error',
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
                        icon: 'success',
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
            icon: 'warning',
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
                        icon: 'error',
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
                        icon: 'success',
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
                        icon: 'error',
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
                        icon: 'success',
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
            icon: 'warning',
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
                        icon: 'error',
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
                        icon: 'success',
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
                    icon: 'success',
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
                        icon: 'error',
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
                        icon: 'success',
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
            icon: 'warning',
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
                        icon: 'error',
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
                        icon: 'success',
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
                icon: 'warning',
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
                                icon: 'success',
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
        $('#tahunanggaran').trigger('focus');
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
        const tahunAnggaran = $('[name="tahunanggaran"]').val();
        const awalPeriode = $('[name="awal_periode"]').val();
        const akhirPeriode = $('[name="akhir_periode"]').val();
        const keterangan = $('[name="keterangan"]').val();
        // const is_active = $('[name="is_active"]').val();
        $.ajax({

            type: "POST",
            url: base_url + "akuntansi/tahunanggaran/simpan",
            data: {
                tahunanggaran: tahunAnggaran,
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
                        icon: 'error',
                        title: ' Input data tidak valid!!!.'
                    });
                    if (data.tahunanggaran_error != '') {
                        $('#tahunanggaran_error').html(data.tahunanggaran_error);
                    } else {
                        $('#tahunanggaran_error').html('');
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
                    $('#tahunanggaran').trigger('focus');
                } else {
                    Toast.fire({
                        icon: 'success',
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
            icon: 'warning',
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
                $('[name="tahunanggaran"]').val(data.tahunanggaran);
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
        const tahunAnggaran = $('[name="tahunanggaran"]').val();
        const awalPeriode = $('[name="awal_periode"]').val();
        const akhirPeriode = $('[name="akhir_periode"]').val();
        const keterangan = $('[name="keterangan"]').val();
        $.ajax({
            type: "POST",
            url: base_url + "akuntansi/tahunanggaran/ubah/" + idubah,
            data: {
                idubah: idubah,
                awal_periode: awalPeriode,
                tahunanggaran: tahunAnggaran,
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
                        icon: 'error',
                        title: ' Input data tidak valid!!!.'
                    });
                    if (data.tahunanggaran_error != '') {
                        $('#tahunanggaran_error').html(data.tahunanggaran_error);

                    } else {
                        $('#tahunanggaran_error').html('');
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
                        icon: 'success',
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
                icon: 'warning',
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
                                icon: 'success',
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
                        icon: 'error',
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
                        icon: 'success',
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
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Batal',
            confirmButtonText: 'Hapus'
        }).then((result) => {
            if (result.value) {
                // Toast.fire({
                //     icon: 'success',
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
                        icon: 'error',
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
                        icon: 'success',
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
                        icon: 'error',
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
                        icon: 'success',
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
                        icon: 'error',
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
                        icon: 'success',
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
                    url: base_url + "akuntansi/kodeperkiraan/hapusakun5/",
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
    // end ajax icon hapus table level5 klik
    // ajax icon hapus table level6 klik
    $('.btn-hapus-level6').on('click', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var info = $(this).data('info');
        Swal.fire({
            title: 'Konfirmasi!',
            text: 'Apakah anda yakin akan menghapus Akun -' + info + '- !?!',
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
                    url: base_url + "akuntansi/kodeperkiraan/hapusakun6/",
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
                        icon: 'error',
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
                        icon: 'success',
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
                        icon: 'error',
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
                        icon: 'success',
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
                    icon: 'success',
                    title: 'akun transaksi berhasil diperbaharui!'
                });
            }
        });
    });
    //end ajax cekbox akun transaksi
    //--------------------------------------/AKUN TRANSAKSI CEKBOX----------------------------
    //---------------------------------------KODE ANGGARAN------------------------------------
    //set focus input unitanggaran saat modal muncul
    $('#modal-akunanggaran').on('shown.bs.modal', function () {
        $('#a6level_id').trigger('focus');
    })
    //set focus input unitanggaran saat modal muncul
    // tombol tambah unitanggaran table
    $('.btn-tambah-akunanggaran').on('click', function (e) {
        e.preventDefault();
        const info = $(this).data('info');
        const anggaran_id = $(this).data('id');
        const judul = document.getElementById('judul-modal');
        judul.innerHTML = 'Kodeperkiraan Anggaran' + info;
        $('[name="anggaran_id"]').val(anggaran_id);
        $('#modal-akunanggaran').modal('show');
    });
    // end tombol tambah unitanggaran table

    //set focus input anggaran saat modal muncul
    $('#modal-anggaran').on('shown.bs.modal', function () {
        $('#anggaran').trigger('focus');
    })
    //set focus input anggaran saat modal muncul
    // tombol tambah anggaran table
    $('.btn-tambah-anggaran').on('click', function (e) {
        e.preventDefault();
        const info = $(this).data('info');
        const idkelompok = $(this).data('idkelompok');
        const judul = document.getElementById('judul-modal-anggaran');
        judul.innerHTML = 'Tambah Akun ' + info;
        // const kodeUnit = document.getElementById('kdunit');
        // kodeUnit.innerHTML = idunit + ".";
        $('[name="kelompok_id"]').val(idkelompok);
        $('#btn-ubah-anggaran').hide();
        $('#modal-anggaran').modal('show');
    });
    // end tombol tambah anggaran table
    // btn simpan akunanggaran
    $('#btn-simpan-akunanggaran').on('click', function (e) {
        e.preventDefault();
        // const unitanggaran_id = $('[name="unitanggaran_id"]').val();
        // const kodeanggaran = $('[name="kodeanggaran"]').val();
        const anggaran_id = $('[name="anggaran_id"]').val();
        const a6level_id = $('[name="a6level_id"]').val();
        $.ajax({
            type: "POST",
            url: base_url + "akuntansi/akunanggaran/simpanakun",
            data: {
                anggaran_id: anggaran_id,
                a6level_id: a6level_id
            },
            dataType: "JSON",
            beforeSend: function () {
                $('#btn-simpan-anggaran').attr('disabled', 'disabled');
            },
            success: function (data) {
                if (data.status == 'gagal') {
                    Toast.fire({
                        icon: 'error',
                        title: ' Input data tidak valid!!!.'
                    });

                    if (data.akun_error != '') {
                        $('#akun_error').html(data.akun_error);
                    } else {
                        $('#akun_error').html('');
                    }
                    $('#a6level_id').trigger('focus');
                } else {
                    Toast.fire({
                        icon: 'success',
                        title: ' Data berhasil disimpan.'
                    });
                    $('#modal-akunanggaran').modal('hide');
                }
                $('#btn-simpan-akunanggaran').attr('disabled', false);
            }
        });
        return false;
    });
    // end btn simpan akunanggaran
    // ajax icon hapus table anggaran klik
    $('.btn-hapus-akunanggaran').on('click', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var info = $(this).data('info');
        Swal.fire({
            title: 'Konfirmasi!',
            text: 'Apakah anda yakin akan menghapus Akun -' + info + '- !?!',
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
                    url: base_url + "akuntansi/akunanggaran/hapusakunanggaran",
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
    // end ajax icon hapus table anggaran klik

    // btn simpan anggaran modal
    $('#btn-simpan-anggaran').on('click', function (e) {
        e.preventDefault();
        // const unitanggaran_id = $('[name="unitanggaran_id"]').val();
        // const kodeanggaran = $('[name="kodeanggaran"]').val();
        const idubah = $('[name="idubah"]').val();
        const anggaran = $('[name="anggaran"]').val();
        const posisi = $('[name="posisi"]').val();
        const institusi_id = $('[name="institusi_id"]').val();
        const kelompok_id = $('[name="kelompok_id"]').val();
        $.ajax({
            type: "POST",
            url: base_url + "akuntansi/akunanggaran/simpananggaran",
            data: {
                kelompok_id: kelompok_id,
                idubah: idubah,
                anggaran: anggaran,
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
                        icon: 'error',
                        title: ' Input data tidak valid!!!.'
                    });

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
                    $('#anggaran').trigger('focus');
                } else {
                    Toast.fire({
                        icon: 'success',
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
                    url: base_url + "akuntansi/akunanggaran/hapusanggaran",
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
    // end ajax icon hapus table anggaran klik
    // ajax tombol edit data table anggaran klik
    $('.btn-edit-anggaran').on('click', function (e) {
        e.preventDefault();
        const judul = document.getElementById('judul-modal-anggaran');
        judul.innerHTML = 'Ubah Data Anggaran';
        var id = $(this).data('id');
        $('#btn-simpan-anggaran').hide();
        $.ajax({
            url: base_url + 'akuntansi/akunanggaran/ajax_editanggaran/' + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('[name="kelompok_id"]').val(data.kelompok_id);
                $('[name="idubah"]').val(data.id);
                $('[name="anggaran"]').val(data.anggaran);
                $('[name="posisi"]').val(data.posisi);
                $('#modal-anggaran').modal('show');
                $('#anggaran').trigger('focus');
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
        const idubah = $('[name="idubah"]').val();
        const anggaran = $('[name="anggaran"]').val();
        const posisi = $('[name="posisi"]').val();
        $.ajax({
            type: "POST",
            url: base_url + "akuntansi/akunanggaran/ubahanggaran",
            data: {
                idubah: idubah,
                anggaran: anggaran,
                posisi: posisi
            },
            dataType: 'JSON',
            beforeSend: function () {
                $('#btn-ubah-anggaran').attr('disabled', 'disabled');
            },
            success: function (data) {
                if (data.status == 'gagal') {
                    Toast.fire({
                        icon: 'error',
                        title: ' Input data tidak valid!!!.'
                    });
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
                    $('#anggaran').trigger('focus');
                } else {
                    Toast.fire({
                        icon: 'success',
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
        const posisi_saldo = $('[name="posisi_saldo"]').val();
        const saldo = $('[name="saldoawal"]').val();
        $.ajax({
            type: "POST",
            url: base_url + "akuntansi/saldoawal/simpan",
            data: {
                a6level_id: a6level_id,
                posisi_saldo: posisi_saldo,
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
                        icon: 'error',
                        title: ' Input data tidak valid!!!.'
                    });
                    if (data.saldoawal_error != '') {
                        $('#saldoawal_error').html(data.saldoawal_error);
                    } else {
                        $('#saldoawal_error').html('');
                    }
                    if (data.posisi_error != '') {
                        $('#posisi_error').html(data.posisi_error);
                    } else {
                        $('#posisi_error').html('');
                    }
                    $('#saldoawal').trigger('focus');
                } else {
                    Toast.fire({
                        icon: 'success',
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
        const posisi = $(this).data('posisi');
        $.ajax({
            url: base_url + 'akuntansi/saldoawal/ajax_edit',
            type: "POST",
            data: {
                a6level_id: akun_id,
                tahun_pembukuan_id: thbuku_id,
                level6: level6,
                posisi: posisi
            },
            dataType: "JSON",
            success: function (data) {
                if (data.status == 'ubah') {
                    $('[name="idubah"]').val(data.id);
                    $('[name="a6level_id"]').val(data.a6level_id);
                    $('[name="level6"]').val(data.level6);
                    $('[name="posisi_saldo"]').val(data.posisi_saldo);
                    $('[name="tahun_pembukuan_id"]').val(data.tahun_pembukuan_id);
                    $('[name="saldoawal"]').val(data.saldoawal);
                    $('[name="saldo"]').val(data.saldoawal);
                    $('#btn-simpan-saldoawal').hide();
                    $('#modal-saldoawal').modal('show');
                    $('#saldoawal').trigger('focus');
                } else {
                    $('[name="a6level_id"]').val(data.a6level_id);
                    $('[name="level6"]').val(data.level6);
                    $('[name="posisi_saldo"]').val(data.posisi_saldo);
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
                                icon: 'success',
                                title: ' Saldo berhasil dihapus!!!.'
                            });

                            document.location.reload();
                        } else {
                            Toast.fire({
                                icon: 'warning',
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
        const posisi_saldo = $('[name="posisi_saldo"]').val();
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
                posisi_saldo: posisi_saldo,
                saldoawal: saldo
            },
            dataType: 'JSON',
            beforeSend: function () {
                $('#btn-ubah-saldoawal').attr('disabled', 'disabled');
            },
            success: function (data) {
                if (data.status == 'gagal') {
                    Toast.fire({
                        icon: 'error',
                        title: ' Input data tidak valid!!!.'
                    });
                    if (data.posisi_error != '') {
                        $('#posisi_error').html(data.posisi_error);

                    } else {
                        $('#posisi_error').html('');
                    }
                    if (data.saldoawal_error != '') {
                        $('#saldoawal_error').html(data.saldoawal_error);

                    } else {
                        $('#saldoawal_error').html('');
                    }
                    $('#saldoawal').trigger('focus');
                } else {
                    Toast.fire({
                        icon: 'success',
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
                        icon: 'error',
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
                        icon: 'success',
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
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Batal',
            confirmButtonText: 'Hapus'
        }).then((result) => {
            if (result.value) {
                // Toast.fire({
                //     icon: 'success',
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
                        icon: 'error',
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
                        icon: 'success',
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
                        icon: 'error',
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
                        icon: 'success',
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
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Batal',
            confirmButtonText: 'Hapus'
        }).then((result) => {
            if (result.value) {
                // Toast.fire({
                //     icon: 'success',
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
                        icon: 'error',
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
                        icon: 'success',
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
                        icon: 'error',
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
                        icon: 'success',
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
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Batal',
            confirmButtonText: 'Hapus'
        }).then((result) => {
            if (result.value) {
                // Toast.fire({
                //     icon: 'success',
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
                        icon: 'error',
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
                        icon: 'success',
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
                        icon: 'error',
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
                        icon: 'success',
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
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Batal',
            confirmButtonText: 'Hapus'
        }).then((result) => {
            if (result.value) {
                // Toast.fire({
                //     icon: 'success',
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
                        icon: 'error',
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
                        icon: 'success',
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
                        icon: 'error',
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
                        icon: 'success',
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
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Batal',
            confirmButtonText: 'Hapus'
        }).then((result) => {
            if (result.value) {
                // Toast.fire({
                //     icon: 'success',
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
                        icon: 'error',
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
                        icon: 'success',
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
    //----------------------------------------TAHUN AKADEMIK------------------------------------

    //set focus input tahunakademik saat modal muncul
    $('#modal-tahunakademik').on('shown.bs.modal', function () {
        $('#id').trigger('focus');
    })
    //set focus input tahunakademik saat modal muncul
    // tombol tambah tahunakademik table
    $('#btn-tambah-tahunakademik').on('click', function (e) {
        e.preventDefault();
        const judul = document.getElementById('judul-modal');
        judul.innerHTML = 'Tambah Data Tahun Akademik';
        $('#btn-ubah-tahunakademik').hide();
        $('#modal-tahunakademik').modal('show');
    });
    // end tombol tambah tahunakademik table
    // ajax tombol Simpan modal tahunakademik
    $('#btn-simpan-tahunakademik').on('click', function (e) {
        e.preventDefault();
        const id = $('[name="id"]').val();
        const tahunAkademik = $('[name="tahunakademik"]').val();
        const awalPeriode = $('[name="awal_periode"]').val();
        const akhirPeriode = $('[name="akhir_periode"]').val();
        $.ajax({
            type: "POST",
            url: base_url + "akademik/tahunakademik/simpan",
            data: {
                id: id,
                tahunakademik: tahunAkademik,
                awal_periode: awalPeriode,
                akhir_periode: akhirPeriode
            },
            dataType: "JSON",
            beforeSend: function () {
                $('#btn-simpan-tahunakademik').attr('disabled', 'disabled');
            },
            success: function (data) {
                if (data.status == 'gagal') {
                    Toast.fire({
                        icon: 'error',
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
                    $('#modal-tahunakademik').modal('hide');
                }
                $('#btn-simpan-tahunakademik').attr('disabled', false);
            }
        });
        return false;
    });
    //end  ajax tombol Simpan modal tahunakademik
    // ajax icon hapus table tahunakademik klik
    $('.btn-hapus-tahunakademik').on('click', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var info = $(this).data('info');
        Swal.fire({
            title: 'Konfirmasi!',
            text: 'Apakah anda yakin akan menghapus Tahun Akademik -' + info + '- !?!',
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
                    url: base_url + "akademik/tahunakademik/hapus/",
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
    // end ajax icon hapus table tahunakademik klik
    // ajax tombol edit data table tahunakademik klik
    $('.btn-edit-tahunakademik').on('click', function (e) {
        e.preventDefault();
        const judul = document.getElementById('judul-modal');
        judul.innerHTML = 'Ubah Data Tahun Akademik';
        var id = $(this).data('id');
        $('#btn-simpan-tahunakademik').hide();
        $('#id').attr('disabled', 'disabled');
        $.ajax({
            url: base_url + 'akademik/tahunakademik/ajax_edit/' + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('[name="idubah"]').val(data.id);
                $('[name="id"]').val(data.id);
                $('[name="tahunakademik"]').val(data.tahunakademik);
                $('[name="awal_periode"]').val(data.awal_periode);
                $('[name="akhir_periode"]').val(data.akhir_periode);
                $('#modal-tahunakademik').modal('show');
                $('#tahunakademik').trigger('focus');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    });
    //end ajax tombol edit data table tahunakademik klik
    // ajax tombol modal ubah tahunakademik
    $('#btn-ubah-tahunakademik').on('click', function (e) {
        e.preventDefault();
        const idubah = $('[name="idubah"]').val();
        const tahunAkademik = $('[name="tahunakademik"]').val();
        const awalPeriode = $('[name="awal_periode"]').val();
        const akhirPeriode = $('[name="akhir_periode"]').val();
        $.ajax({
            type: "POST",
            url: base_url + "akademik/tahunakademik/ubah",
            data: {
                idubah: idubah,
                tahunakademik: tahunAkademik,
                awal_periode: awalPeriode,
                akhir_periode: akhirPeriode
            },
            dataType: 'JSON',
            beforeSend: function () {
                $('#btn-ubah-tahunakademik').attr('disabled', 'disabled');
            },
            success: function (data) {
                if (data.status == 'gagal') {
                    Toast.fire({
                        icon: 'error',
                        title: ' Input data tidak valid!!!.'
                    });
                    if (data.tahunakademik_error != '') {
                        $('#tahunakademik_error').html(data.tahunakademik_error);

                    } else {
                        $('#tahunakademik_error').html('');
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
                    $('#tahunakademik').trigger('focus');
                } else {
                    Toast.fire({
                        icon: 'success',
                        title: ' Data berhasil diubah!'
                    });
                    $('#modal-tahunakademik').modal('hide');
                    //dataTable.ajax.reload();
                }
                $('#btn-ubah-tahunakademik').attr('disabled', false);
            }
        });
        return false;
    });
    // end ajax tombol modal ubah tahunakademik

    //---------------------------------------/TAHUN AJARAN------------------------------------
    //----------------------------------------JURUSAN-----------------------------------------

    //set focus input jurusan saat modal muncul
    $('#modal-jurusan').on('shown.bs.modal', function () {
        $('#id').trigger('focus');
    })
    //set focus input jurusan saat modal muncul
    // tombol tambah jurusan table
    $('#btn-tambah-jurusan').on('click', function (e) {
        e.preventDefault();
        const judul = document.getElementById('judul-modal');
        judul.innerHTML = 'Tambah Data Jurusan';
        $('#btn-ubah-jurusan').hide();
        $('#modal-jurusan').modal('show');
    });
    // end tombol tambah jurusan table
    // ajax tombol Simpan modal jurusan
    $('#btn-simpan-jurusan').on('click', function (e) {
        e.preventDefault();
        const id = $('[name="id"]').val();
        const jurusan = $('[name="jurusan"]').val();
        const unit_id = $('[name="unit_id"]').val();
        $.ajax({

            type: "POST",
            url: base_url + "akademik/jurusan/simpan",
            data: {
                id: id,
                jurusan: jurusan,
                unit_id: unit_id
            },
            dataType: "JSON",
            beforeSend: function () {
                $('#btn-simpan-jurusan').attr('disabled', 'disabled');
            },
            success: function (data) {
                if (data.status == 'gagal') {
                    Toast.fire({
                        icon: 'error',
                        title: ' Input data tidak valid!!!.'
                    });
                    if (data.kode_error != '') {
                        $('#kode_error').html(data.kode_error);
                    } else {
                        $('#kode_error').html('');
                    }
                    if (data.jurusan_error != '') {
                        $('#jurusan_error').html(data.jurusan_error);
                    } else {
                        $('#jurusan_error').html('');
                    }
                    if (data.unit_error != '') {
                        $('#unit_error').html(data.unit_error);
                    } else {
                        $('#unit_error').html('');
                    }
                    $('#id').trigger('focus');
                } else {
                    Toast.fire({
                        icon: 'success',
                        title: ' Data berhasil disimpan.'
                    });
                    $('#modal-jurusan').modal('hide');
                }
                $('#btn-simpan-jurusan').attr('disabled', false);
            }
        });
        return false;
    });
    //end  ajax tombol Simpan modal jurusan
    // ajax icon hapus table jurusan klik
    $('.btn-hapus-jurusan').on('click', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var info = $(this).data('info');
        Swal.fire({
            title: 'Konfirmasi!',
            text: 'Apakah anda yakin akan menghapus Jurusan -' + info + '- !?!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Batal',
            confirmButtonText: 'Hapus'
        }).then((result) => {
            if (result.value) {
                // Toast.fire({
                //     icon: 'success',
                //     title: id + "-" + info
                // });
                $.ajax({
                    type: "POST",
                    url: base_url + "akademik/jurusan/hapus",
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
    // end ajax icon hapus table jurusan klik
    // ajax tombol edit data table jurusan klik
    $('.btn-edit-jurusan').on('click', function (e) {
        e.preventDefault();
        const judul = document.getElementById('judul-modal');
        judul.innerHTML = 'Ubah Data Tahun Pendidikan';
        var id = $(this).data('id');
        $('#btn-simpan-jurusan').hide();
        $('#id').attr('disabled', 'disabled');
        $.ajax({
            url: base_url + 'akademik/jurusan/ajax_edit/' + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('[name="id"]').val(data.id);
                $('[name="idubah"]').val(data.id);
                $('[name="jurusan"]').val(data.jurusan);
                $('[name="unit_id"]').val(data.unit);
                $('#modal-jurusan').modal('show');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    });
    //end ajax tombol edit data table jurusan klik
    // ajax tombol modal ubah jurusan
    $('#btn-ubah-jurusan').on('click', function (e) {
        e.preventDefault();
        const idubah = $('[name="idubah"]').val();
        const jurusan = $('[name="jurusan"]').val();
        const unit_id = $('[name="unit_id"]').val();
        $.ajax({
            type: "POST",
            url: base_url + "akademik/jurusan/ubah/" + idubah,
            data: {
                idubah: idubah,
                jurusan: jurusan,
                unit_id: unit_id
            },
            dataType: 'JSON',
            beforeSend: function () {
                $('#btn-ubah-jurusan').attr('disabled', 'disabled');
            },
            success: function (data) {
                if (data.status == 'gagal') {
                    Toast.fire({
                        icon: 'error',
                        title: ' Input data tidak valid!!!.'
                    });
                    if (data.jurusan_error != '') {
                        $('#jurusan_error').html(data.jurusan_error);

                    } else {
                        $('#jurusan_error').html('');
                    }
                    $('#jurusan').trigger('focus');
                } else {
                    Toast.fire({
                        icon: 'success',
                        title: ' Data berhasil diubah!'
                    });
                    $('#modal-jurusan').modal('hide');
                    //dataTable.ajax.reload();
                }
                $('#btn-ubah-jurusan').attr('disabled', false);
            }
        });
        return false;
    });
    // end ajax tombol modal ubah jurusan


    //---------------------------------------/JURUSAN-----------------------------------------
    //----------------------------------------PRODI-----------------------------------------

    //set focus input prodi saat modal muncul
    $('#modal-prodi').on('shown.bs.modal', function () {
        $('#id').trigger('focus');
    })
    //set focus input prodi saat modal muncul
    // tombol tambah prodi table
    $('#btn-tambah-prodi').on('click', function (e) {
        e.preventDefault();
        const judul = document.getElementById('judul-modal');
        judul.innerHTML = 'Tambah Data Program Pendidikan';
        $('#btn-ubah-prodi').hide();
        $('#modal-prodi').modal('show');
    });
    // end tombol tambah prodi table
    // ajax tombol Simpan modal prodi
    $('#btn-simpan-prodi').on('click', function (e) {
        e.preventDefault();
        const id = $('[name="id"]').val();
        const prodi = $('[name="prodi"]').val();
        const jenjang_id = $('[name="jenjang_id"]').val();
        const jurusan_id = $('[name="jurusan_id"]').val();
        const jalur_id = $('[name="jalur_id"]').val();
        $.ajax({

            type: "POST",
            url: base_url + "akademik/prodi/simpan",
            data: {
                id: id,
                prodi: prodi,
                jenjang_id: jenjang_id,
                jurusan_id: jurusan_id,
                jalur_id: jalur_id
            },
            dataType: "JSON",
            beforeSend: function () {
                $('#btn-simpan-prodi').attr('disabled', 'disabled');
            },
            success: function (data) {
                if (data.status == 'gagal') {
                    Toast.fire({
                        icon: 'error',
                        title: ' Input data tidak valid!!!.'
                    });
                    if (data.kode_error != '') {
                        $('#kode_error').html(data.kode_error);
                    } else {
                        $('#kode_error').html('');
                    }
                    if (data.prodi_error != '') {
                        $('#prodi_error').html(data.prodi_error);
                    } else {
                        $('#prodi_error').html('');
                    }
                    if (data.jenjang_error != '') {
                        $('#jenjang_error').html(data.jenjang_error);
                    } else {
                        $('#jenjang_error').html('');
                    }
                    if (data.jurusan_error != '') {
                        $('#jurusan_error').html(data.jurusan_error);
                    } else {
                        $('#jurusan_error').html('');
                    }
                    if (data.jalur_error != '') {
                        $('#jalur_error').html(data.jalur_error);
                    } else {
                        $('#jalur_error').html('');
                    }
                    $('#id').trigger('focus');
                } else {
                    Toast.fire({
                        icon: 'success',
                        title: ' Data berhasil disimpan.'
                    });
                    $('#modal-prodi').modal('hide');
                }
                $('#btn-simpan-prodi').attr('disabled', false);
            }
        });
        return false;
    });
    //end  ajax tombol Simpan modal prodi
    // ajax icon hapus table prodi klik
    $('.btn-hapus-prodi').on('click', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var info = $(this).data('info');
        Swal.fire({
            title: 'Konfirmasi!',
            text: 'Apakah anda yakin akan menghapus Prodi -' + info + '- !?!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Batal',
            confirmButtonText: 'Hapus'
        }).then((result) => {
            if (result.value) {
                // Toast.fire({
                //     icon: 'success',
                //     title: id + "-" + info
                // });
                $.ajax({
                    type: "POST",
                    url: base_url + "akademik/prodi/hapus",
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
    // end ajax icon hapus table prodi klik
    // ajax tombol edit data table prodi klik
    $('.btn-edit-prodi').on('click', function (e) {
        e.preventDefault();
        const judul = document.getElementById('judul-modal');
        judul.innerHTML = 'Ubah Data Tahun Pendidikan';
        var id = $(this).data('id');
        $('#btn-simpan-prodi').hide();
        $('#id').attr('disabled', 'disabled');
        $.ajax({
            url: base_url + 'akademik/prodi/ajax_edit/' + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('[name="id"]').val(data.id);
                $('[name="idubah"]').val(data.id);
                $('[name="prodi"]').val(data.prodi);
                $('[name="jenjang_id"]').val(data.jenjang_id);
                $('[name="jurusan_id"]').val(data.jurusan_id);
                $('[name="jalur_id"]').val(data.jalur_id);
                $('#modal-prodi').modal('show');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    });
    //end ajax tombol edit data table prodi klik
    // ajax tombol modal ubah prodi
    $('#btn-ubah-prodi').on('click', function (e) {
        e.preventDefault();
        const idubah = $('[name="idubah"]').val();
        const prodi = $('[name="prodi"]').val();
        const jenjang_id = $('[name="jenjang_id"]').val();
        const jurusan_id = $('[name="jurusan_id"]').val();
        const jalur_id = $('[name="jalur_id"]').val();
        $.ajax({
            type: "POST",
            url: base_url + "akademik/prodi/ubah/" + idubah,
            data: {
                idubah: idubah,
                prodi: prodi,
                jenjang_id: jenjang_id,
                jurusan_id: jurusan_id,
                jalur_id: jalur_id
            },
            dataType: 'JSON',
            beforeSend: function () {
                $('#btn-ubah-prodi').attr('disabled', 'disabled');
            },
            success: function (data) {
                if (data.status == 'gagal') {
                    Toast.fire({
                        icon: 'error',
                        title: ' Input data tidak valid!!!.'
                    });
                    if (data.prodi_error != '') {
                        $('#prodi_error').html(data.prodi_error);

                    } else {
                        $('#prodi_error').html('');
                    }
                    if (data.jenjang_error != '') {
                        $('#jenjang_error').html(data.jenjang_error);
                    } else {
                        $('#jenjang_error').html('');
                    }
                    if (data.jurusan_error != '') {
                        $('#jurusan_error').html(data.jurusan_error);
                    } else {
                        $('#jurusan_error').html('');
                    }
                    if (data.jalur_error != '') {
                        $('#jalur_error').html(data.jalur_error);
                    } else {
                        $('#jalur_error').html('');
                    }
                    $('#prodi').trigger('focus');
                } else {
                    Toast.fire({
                        icon: 'success',
                        title: ' Data berhasil diubah!'
                    });
                    $('#modal-prodi').modal('hide');
                    //dataTable.ajax.reload();
                }
                $('#btn-ubah-prodi').attr('disabled', false);
            }
        });
        return false;
    });
    // end ajax tombol modal ubah prodi

    //---------------------------------------/PRODI-----------------------------------------
    //----------------------------------------DETAILTAHUNAJARAN-----------------------------------------

    //set focus input detailtahunajaran saat modal muncul
    $('#modal-detailtahunajaran').on('shown.bs.modal', function () {
        $('#tahun_ajaran_id').trigger('focus');
    })
    //set focus input detailtahunajaran saat modal muncul
    // tombol tambah detailtahunajaran table
    $('#btn-tambah-detailtahunajaran').on('click', function (e) {
        e.preventDefault();
        const judul = document.getElementById('judul-modal');
        judul.innerHTML = 'Tambah Data Detail Tahun Ajaran';
        $('#btn-ubah-detailtahunajaran').hide();
        $('#modal-detailtahunajaran').modal('show');
    });
    // end tombol tambah detailtahunajaran table
    // ajax tombol Simpan modal detailtahunajaran
    $('#btn-simpan-detailtahunajaran').on('click', function (e) {
        e.preventDefault();
        //const id = $('[name="id"]').val();
        const tahun_ajaran_id = $('[name="tahun_ajaran_id"]').val();
        const semester_id = $('[name="semester_id"]').val();
        const awal_periode = $('[name="awal_periode"]').val();
        const akhir_periode = $('[name="akhir_periode"]').val();
        const keterangan = $('[name="keterangan"]').val();
        $.ajax({
            type: "POST",
            url: base_url + "akademik/detailtahunajaran/simpan",
            data: {
                tahun_ajaran_id: tahun_ajaran_id,
                semester_id: semester_id,
                awal_periode: awal_periode,
                akhir_periode: akhir_periode,
                keterangan: keterangan
            },
            dataType: "JSON",
            beforeSend: function () {
                $('#btn-simpan-detailtahunajaran').attr('disabled', 'disabled');
            },
            success: function (data) {
                if (data.status == 'gagal') {
                    Toast.fire({
                        icon: 'error',
                        title: ' Input data tidak valid!!!.'
                    });
                    if (data.tahun_ajaran_error != '') {
                        $('#tahun_ajaran_error').html(data.tahun_ajaran_error);
                    } else {
                        $('#tahun_ajaran_error').html('');
                    }
                    if (data.semester_error != '') {
                        $('#semester_error').html(data.semester_error);
                    } else {
                        $('#semester_error').html('');
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
                    $('#tahun_ajaran_id').trigger('focus');
                } else if (data.status == 'batal') {
                    Toast.fire({
                        icon: 'warning',
                        title: ' Penyimpanan dibatalkan, kombinasi Tahun ajaran dan Semester telah ada!!!.'
                    });
                } else {
                    Toast.fire({
                        icon: 'success',
                        title: ' Data berhasil disimpan.'
                    });
                    $('#modal-detailtahunajaran').modal('hide');
                }
                $('#btn-simpan-detailtahunajaran').attr('disabled', false);
            }
        });
        return false;
    });
    //end  ajax tombol Simpan modal detailtahunajaran
    // ajax icon hapus table detailtahunajaran klik
    $('.btn-hapus-detailtahunajaran').on('click', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var info = $(this).data('info');
        Swal.fire({
            title: 'Konfirmasi!',
            text: 'Apakah anda yakin akan menghapus Tahun Ajaran -' + info + '- !?!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Batal',
            confirmButtonText: 'Hapus'
        }).then((result) => {
            if (result.value) {
                // Toast.fire({
                //     icon: 'success',
                //     title: id + "-" + info
                // });
                $.ajax({
                    type: "POST",
                    url: base_url + "akademik/detailtahunajaran/hapus",
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
    // end ajax icon hapus table detailtahunajaran klik
    // ajax tombol edit data table detailtahunajaran klik
    $('.btn-edit-detailtahunajaran').on('click', function (e) {
        e.preventDefault();
        const judul = document.getElementById('judul-modal');
        judul.innerHTML = 'Ubah Data Tahun Ajaran';
        var id = $(this).data('id');
        $('#btn-simpan-detailtahunajaran').hide();
        $('#id').attr('disabled', 'disabled');
        $.ajax({
            url: base_url + 'akademik/detailtahunajaran/ajax_edit/' + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('[name="idubah"]').val(data.id);
                $('[name="tahun_ajaran_id"]').val(data.tahun_ajaran_id);
                $('[name="semester_id"]').val(data.semester_id);
                $('[name="awal_periode"]').val(data.awal_periode);
                $('[name="akhir_periode"]').val(data.akhir_periode);
                $('[name="keterangan"]').val(data.keterangan);
                $('#modal-detailtahunajaran').modal('show');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    });
    //end ajax tombol edit data table detailtahunajaran klik
    // ajax tombol modal ubah detailtahunajaran
    $('#btn-ubah-detailtahunajaran').on('click', function (e) {
        e.preventDefault();
        const idubah = $('[name="idubah"]').val();
        const tahun_ajaran_id = $('[name="tahun_ajaran_id"]').val();
        const semester_id = $('[name="semester_id"]').val();
        const awal_periode = $('[name="awal_periode"]').val();
        const akhir_periode = $('[name="akhir_periode"]').val();
        const keterangan = $('[name="keterangan"]').val();
        $.ajax({
            type: "POST",
            url: base_url + "akademik/detailtahunajaran/ubah/" + idubah,
            data: {
                tahun_ajaran_id: tahun_ajaran_id,
                semester_id: semester_id,
                awal_periode: awal_periode,
                akhir_periode: akhir_periode,
                keterangan: keterangan
            },
            dataType: 'JSON',
            beforeSend: function () {
                $('#btn-ubah-detailtahunajaran').attr('disabled', 'disabled');
            },
            success: function (data) {
                if (data.status == 'gagal') {
                    Toast.fire({
                        icon: 'error',
                        title: ' Input data tidak valid!!!.'
                    });
                    if (data.tahun_ajaran_error != '') {
                        $('#tahun_ajaran_error').html(data.tahun_ajaran_error);
                    } else {
                        $('#tahun_ajaran_error').html('');
                    }
                    if (data.semester_error != '') {
                        $('#semester_error').html(data.semester_error);
                    } else {
                        $('#semester_error').html('');
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
                    $('#tahun_ajaran_id').trigger('focus');
                } else if (data.status == 'batal') {
                    Toast.fire({
                        icon: 'warning',
                        title: ' Perubahan dibatalkan, kombinasi Tahun ajaran dan Semester telah ada!!!.'
                    });
                    $('#tahun_ajaran_id').trigger('focus');
                } else {
                    Toast.fire({
                        icon: 'success',
                        title: ' Data berhasil diubah!'
                    });
                    $('#modal-detailtahunajaran').modal('hide');
                    //dataTable.ajax.reload();
                }
                $('#btn-ubah-detailtahunajaran').attr('disabled', false);
            }
        });
        return false;
    });
    // end ajax tombol modal ubah detailtahunajaran

    //----------------------------------/DETAILTAHUNAJARAN-----------------------------------------
    //-----------------------------------KELAS-----------------------------------------

    //set focus input kelas saat modal muncul
    $('#modal-kelas').on('shown.bs.modal', function () {
        $('#id').trigger('focus');
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
        const id = $('[name="id"]').val();
        const prodi_id = $('[name="prodi_id"]').val();
        const angkatan_id = $('[name="angkatan_id"]').val();
        const keterangan = $('[name="keterangan"]').val();
        $.ajax({
            type: "POST",
            url: base_url + "akademik/kelas/simpan",
            data: {
                id: id,
                prodi_id: prodi_id,
                angkatan_id: angkatan_id,
                keterangan: keterangan
            },
            dataType: "JSON",
            beforeSend: function () {
                $('#btn-simpan-kelas').attr('disabled', 'disabled');
            },
            success: function (data) {
                if (data.status == 'gagal') {
                    Toast.fire({
                        icon: 'error',
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
                    if (data.prodi_error != '') {
                        $('#prodi_error').html(data.prodi_error);
                    } else {
                        $('#prodi_error').html('');
                    }
                    if (data.keterangan_error != '') {
                        $('#keterangan_error').html(data.keterangan_error);
                    } else {
                        $('#keterangan_error').html('');
                    }
                    $('#id').trigger('focus');
                } else {
                    Toast.fire({
                        icon: 'success',
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
                    url: base_url + "akademik/kelas/hapus",
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
                $('[name="id"]').val(data.id);
                $('[name="angkatan_id"]').val(data.angkatan_id);
                $('[name="prodi_id"]').val(data.prodi_id);
                $('[name="keterangan"]').val(data.keterangan);
                $('#modal-kelas').modal('show');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                Toast.fire({
                    icon: 'warning',
                    title: 'Sesi login habis!!refresh halaman dan login kembali!!!.'
                });
            }
        });
    });
    //end ajax tombol edit data table kelas klik
    // ajax tombol modal ubah kelas
    $('#btn-ubah-kelas').on('click', function (e) {
        e.preventDefault();
        const idubah = $('[name="idubah"]').val();
        // const id = $('[name="id"]').val();
        const prodi_id = $('[name="prodi_id"]').val();
        const angkatan_id = $('[name="angkatan_id"]').val();
        const keterangan = $('[name="keterangan"]').val();
        $.ajax({
            type: "POST",
            url: base_url + "akademik/kelas/ubah",
            data: {
                idubah: idubah,
                prodi_id: prodi_id,
                angkatan_id: angkatan_id,
                keterangan: keterangan
            },
            dataType: 'JSON',
            beforeSend: function () {
                $('#btn-ubah-kelas').attr('disabled', 'disabled');
            },
            success: function (data) {
                if (data.status == 'gagal') {
                    Toast.fire({
                        icon: 'error',
                        title: ' Input data tidak valid!!!.'
                    });
                    if (data.angkatan_error != '') {
                        $('#angkatan_error').html(data.angkatan_error);
                    } else {
                        $('#angkatan_error').html('');
                    }
                    if (data.prodi_error != '') {
                        $('#prodi_error').html(data.prodi_error);
                    } else {
                        $('#prodi_error').html('');
                    }
                    if (data.keterangan_error != '') {
                        $('#keterangan_error').html(data.keterangan_error);
                    } else {
                        $('#keterangan_error').html('');
                    }
                    $('#prodi').trigger('focus');
                } else {
                    Toast.fire({
                        icon: 'success',
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

    //----------------------------------/KELAS-----------------------------------------
    //----------------------------------MAHASISWA-----------------------------------------
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
        const is_active = $('[name="is_active"]').val();
        const kelas_id = $('[name="kelas_id"]').val();
        $.ajax({
            type: "POST",
            url: base_url + "akademik/mahasiswa/simpan",
            data: {
                nim: nim,
                nama: nama,
                is_active: is_active,
                kelas_id: kelas_id
            },
            dataType: "JSON",
            beforeSend: function () {
                $('#btn-simpan-mahasiswa').attr('disabled', 'disabled');
            },
            success: function (data) {
                if (data.status == 'gagal') {
                    Toast.fire({
                        icon: 'error',
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
                    if (data.status_error != '') {
                        $('#status_error').html(data.status_error);
                    } else {
                        $('#status_error').html('');
                    }
                    $('#nim').trigger('focus');
                } else {
                    Toast.fire({
                        icon: 'success',
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
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Batal',
            confirmButtonText: 'Hapus'
        }).then((result) => {
            if (result.value) {
                // Toast.fire({
                //     icon: 'success',
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
                $('[name="is_active"]').val(data.is_active);
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
        const is_active = $('[name="is_active"]').val();
        $.ajax({
            type: "POST",
            url: base_url + "akademik/mahasiswa/ubah/" + idubah,
            data: {
                idubah: idubah,
                nim: nim,
                nama: nama,
                is_active: is_active
            },
            dataType: 'JSON',
            beforeSend: function () {
                $('#btn-ubah-mahasiswa').attr('disabled', 'disabled');
            },
            success: function (data) {
                if (data.status == 'gagal') {
                    Toast.fire({
                        icon: 'error',
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
                    if (data.status_error != '') {
                        $('#status_error').html(data.status_error);
                    } else {
                        $('#status_error').html('');
                    }
                    $('#nim').trigger('focus');
                } else {
                    Toast.fire({
                        icon: 'success',
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
    //----------------------------------/MAHASISWA-----------------------------------------
    //----------------------------------/KASMASUK-----------------------------------------

    // tombol tambah rinciantransaksi table
    $('#btn-tambah-rinciankasmasuk').on('click', function (e) {
        e.preventDefault();
        const tran_id = $('[name="tran_id"]').val();
        if (tran_id == '') {
            Toast.fire({
                icon: 'warning',
                title: ' Harap isi dan simpan form transaksi terlebih dahulu!!!.'
            });
        } else {
            const judul = document.getElementById('judul-modal');
            judul.innerHTML = 'Tambah Rincian Transaksi';
            $('#btn-ubah-detailkasmasuk').hide();
            $('#modal-kasmasuk').modal('show');
        }
    });
    // end tombol tambah rinciantransaksi table
    // tombol simpan detailkasmasuk table
    $('#btn-simpan-detailkasmasuk').on('click', function (e) {
        e.preventDefault();
        const transaksi_id = $('[name="transaksi_id"]').val();
        const a6level_id = $('[name="a6level_id"]').val();
        const posisi_akun = $('[name="posisi_akun"]').val();
        const idakun = $('[name="idakun"]').val();
        const idjt = $('[name="idjt"]').val();
        const tgl2 = $('[name="tgl2"]').val();
        const idubah = $('[name="idubah"]').val();
        const jumlah = $('[name="jumlah"]').val();
        $.ajax({
            cache: false,
            type: "POST",
            url: base_url + "akuntansi/kasmasuk/simpandetail",
            data: {
                idakun: idakun,
                idubah: idubah,
                transaksi_id: transaksi_id,
                idjt: idjt,
                a6level_id: a6level_id,
                posisi_akun: posisi_akun,
                tgl2: tgl2,
                jumlah: jumlah
            },
            dataType: "JSON",
            beforeSend: function () {
                $('#btn-simpan-detailkasmasuk').attr('disabled', 'disabled');
            },
            success: function (data) {
                if (data.status == 'gagal') {
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

                    $('#a6level_id').trigger('focus');
                } else {
                    //$('#btn-simpan-transaksi').attr('disabled', false);
                    Toast.fire({
                        icon: 'success',
                        title: ' Data berhasil disimpan!'
                    });
                    document.location.reload();
                    //$('#modal-kasmasuk').modal('show');
                }
                $('#btn-simpan-detailkasmasuk').attr('disabled', false);
            }
        });
        return false;
    });
    // end tombol simpan detailkasmasuk table
    // tombol ubah detailtransaksi table
    $('#btn-ubah-detailkasmasuk').on('click', function (e) {
        e.preventDefault();
        const idubah = $('[name="idubah"]').val();
        const transaksi_id = $('[name="transaksi_id"]').val();
        const a6level_id = $('[name="a6level_id"]').val();
        const idakun = $('[name="idakun"]').val();
        const tgl2 = $('[name="tgl2"]').val();
        const posisi_akun = $('[name="posisi_akun"]').val();
        const jumlah = $('[name="jumlah"]').val();
        $.ajax({
            cache: false,
            type: "POST",
            url: base_url + "akuntansi/kasmasuk/ubahdetail/" + idubah,
            data: {
                idubah: idubah,
                idakun: idakun,
                transaksi_id: transaksi_id,
                a6level_id: a6level_id,
                posisi_akun: posisi_akun,
                tgl2: tgl2,
                jumlah: jumlah
            },
            dataType: "JSON",
            beforeSend: function () {
                $('#btn-ubah-detailkasmasuk').attr('disabled', 'disabled');
            },
            success: function (data) {
                if (data.status == 'gagal') {
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

                    $('#a6level_id').trigger('focus');
                } else {
                    //$('#btn-simpan-transaksi').attr('disabled', false);
                    Toast.fire({
                        icon: 'success',
                        title: ' Data berhasil disimpan!'
                    });
                    //document.location.reload();
                    $('#modal-kasmasuk').modal('hide');
                }
                $('#btn-ubah-detailkasmasuk').attr('disabled', false);
            }
        });
        return false;

    });
    // end tombol ubah detailtransaksi table
    // ajax tombol edit data table kelas klik
    $('.btn-edit-detailkasmasuk').on('click', function (e) {
        e.preventDefault();
        const judul = document.getElementById('judul-modal');
        judul.innerHTML = 'Ubah Rincian Transaksi';
        var id = $(this).data('id');
        $('#btn-simpan-detailkasmasuk').hide();
        $('#id').attr('disabled', 'disabled');
        $.ajax({
            url: base_url + 'akuntansi/kasmasuk/ajax_editrincian/' + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('[name="idubah"]').val(data.id);
                $('[name="a6level_id"]').val(data.a6level_id);
                $('[name="idakun"]').val(data.a6level_id);
                $('[name="posisi_akun"]').val(data.posisi_akun);
                $('[name="jumlah"]').val(data.jumlah);
                $('#modal-kasmasuk').modal('show');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    });
    //end ajax tombol edit data table kelas klik
    // ajax icon hapus table rincian klik
    $('.btn-hapus-detailkasmasuk').on('click', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var info = $(this).data('info');
        Swal.fire({
            title: 'Konfirmasi!',
            text: 'Apakah anda yakin akan menghapus Rincian -' + info + '- !?!',
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
                    url: base_url + "akuntansi/kasmasuk/hapusrincian",
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
                                title: ' Penghapusan gagal!!!.'
                            });
                        }
                    }
                });
            }
        })
    });
    // end ajax icon hapus table rincian klik
    // tombol simpan kasmasuk
    $('#btn-simpan-kasmasuk').on('click', function (e) {
        e.preventDefault();
        const notran = $('[name="notran"]').val();
        const tahun_pembukuan_id = $('[name="tahun_pembukuan_id"]').val();
        const jurnal = $('[name="jurnal"]').val();
        const unit_id = $('[name="unit_id"]').val();
        const noref = $('[name="noref"]').val();
        const nobukti = $('[name="nobukti"]').val();
        const tanggal_transaksi = $('[name="tanggal_transaksi"]').val();
        const keterangan = $('[name="keterangan"]').val();
        const status = $(this).data('status');
        if (status == 0) {
            $.ajax({
                type: "POST",
                url: base_url + "akuntansi/kasmasuk/simpan",
                data: {
                    nobukti: nobukti,
                    tanggal_transaksi: tanggal_transaksi,
                    keterangan: keterangan,
                    unit_id: unit_id,
                    noref: noref,
                    jurnal: jurnal,
                    notran: notran,
                    tahun_buku: tahun_pembukuan_id
                },
                dataType: "JSON",
                beforeSend: function () {
                    $('#btn-simpan-kasmasuk').attr('disabled', 'disabled');
                },
                success: function (data) {
                    if (data.status == 'gagal') {
                        Toast.fire({
                            icon: 'error',
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
                            icon: 'success',
                            title: ' Data berhasil disimpan!'
                        });
                        document.location.reload();
                        //$('#modal-kasmasuk').modal('show');
                    }
                    $('#btn-simpan-kasmasuk').attr('disabled', false);
                }
            });
            return false;
        } else {
            const transaksi_id = $('[name="tran_id"]').val();
            const unit_id = $('[name="unit_id"]').val();
            const nobukti = $('[name="nobukti"]').val();
            const noref = $('[name="noref"]').val();
            const tanggal_transaksi = $('[name="tanggal_transaksi"]').val();
            const keterangan = $('[name="keterangan"]').val();
            $.ajax({
                type: "POST",
                url: base_url + "akuntansi/kasmasuk/ubah/" + transaksi_id,
                data: {
                    nobukti: nobukti,
                    tanggal_transaksi: tanggal_transaksi,
                    keterangan: keterangan,
                    noref: noref,
                    unit_id: unit_id
                },
                dataType: "JSON",
                beforeSend: function () {
                    $('#btn-simpan-kasmasuk').attr('disabled', 'disabled');
                },
                success: function (data) {
                    if (data.status == 'gagal') {
                        Toast.fire({
                            icon: 'error',
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
                            icon: 'success',
                            title: ' Data berhasil diubah!'
                        });
                        document.location.reload();
                        //$('#modal-kasmasuk').modal('show');
                    }
                    $('#btn-simpan-kasmasuk').attr('disabled', false);
                }
            });
            return false;
        }
    });
    // end tombol simpan kasmasuk
    // ajax icon selesai kasmasuk
    $('#btn-selesai-kasmasuk').on('click', function (e) {
        e.preventDefault();
        var transaksi_id = $(this).data('id');
        var total_transaksi = $(this).data('total');
        //var info = $(this).data('info');
        Swal.fire({
            title: 'Konfirmasi!',
            text: 'Apakah anda yakin data telah benar!?!',
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
                    url: base_url + "akuntansi/kasmasuk/selesaitransaksi",
                    data: {
                        transaksi_id: transaksi_id,
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
                    }
                });
            }
        })
    });
    // end ajax icon selesai kasmasuk
    //----------------------------------/KASMASUK-----------------------------------------
    //----------------------------------/KAS KELUAR-----------------------------------------

    // tombol tambah rinciantransaksi table
    $('#btn-tambah-rinciankaskeluar').on('click', function (e) {
        e.preventDefault();
        const tran_id = $('[name="tran_id"]').val();
        if (tran_id == '') {
            Toast.fire({
                icon: 'warning',
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
        const idjt = $('[name="idjt"]').val();
        const idubah = $('[name="idubah"]').val();
        const tgl2 = $('[name="tgl2"]').val();
        const jumlah = $('[name="jumlah"]').val();
        $.ajax({
            cache: false,
            type: "POST",
            url: base_url + "akuntansi/kaskeluar/simpandetail",
            data: {
                idakun: idakun,
                idubah: idubah,
                idjt: idjt,
                transaksi_id: transaksi_id,
                a6level_id: a6level_id,
                posisi_akun: posisi_akun,
                tgl2: tgl2,
                jumlah: jumlah
            },
            dataType: "JSON",
            beforeSend: function () {
                $('#btn-simpan-detailkaskeluar').attr('disabled', 'disabled');
            },
            success: function (data) {
                if (data.status == 'gagal') {
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

                    $('#a6level_id').trigger('focus');
                } else {
                    //$('#btn-simpan-transaksi').attr('disabled', false);
                    Toast.fire({
                        icon: 'success',
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
        const tgl2 = $('[name="tgl2"]').val();
        const posisi_akun = $('[name="posisi_akun"]').val();
        const jumlah = $('[name="jumlah"]').val();
        $.ajax({
            cache: false,
            type: "POST",
            url: base_url + "akuntansi/kaskeluar/ubahdetail/" + idubah,
            data: {
                idubah: idubah,
                idakun: idakun,
                transaksi_id: transaksi_id,
                a6level_id: a6level_id,
                posisi_akun: posisi_akun,
                tgl2: tgl2,
                jumlah: jumlah
            },
            dataType: "JSON",
            beforeSend: function () {
                $('#btn-ubah-detailkaskeluar').attr('disabled', 'disabled');
            },
            success: function (data) {
                if (data.status == 'gagal') {
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

                    $('#a6level_id').trigger('focus');
                } else {
                    //$('#btn-simpan-transaksi').attr('disabled', false);
                    Toast.fire({
                        icon: 'success',
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
                    url: base_url + "akuntansi/kaskeluar/hapusrincian",
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
        const noref = $('[name="noref"]').val();
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
                    noref: noref,
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
                            icon: 'error',
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
                            icon: 'success',
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
            const noref = $('[name="noref"]').val();
            const tanggal_transaksi = $('[name="tanggal_transaksi"]').val();
            const keterangan = $('[name="keterangan"]').val();
            $.ajax({
                type: "POST",
                url: base_url + "akuntansi/kaskeluar/ubah/" + transaksi_id,
                data: {
                    nobukti: nobukti,
                    noref: noref,
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
                            icon: 'error',
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
                            icon: 'success',
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
            text: 'Apakah anda yakin data telah benar!?!',
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
                    url: base_url + "akuntansi/kaskeluar/selesaitransaksi",
                    data: {
                        transaksi_id: transaksi_id,
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
                    }
                });
            }
        })
    });
    // end ajax icon selesai kaskeluar

    //----------------------------------/KAS KELUAR-----------------------------------------
    //----------------------------------/BANK MASUK-----------------------------------------

    // tombol tambah rinciantransaksi table
    $('#btn-tambah-rincianbankmasuk').on('click', function (e) {
        e.preventDefault();
        const tran_id = $('[name="tran_id"]').val();
        if (tran_id == '') {
            Toast.fire({
                icon: 'warning',
                title: ' Harap isi dan simpan form transaksi terlebih dahulu!!!.'
            });
        } else {
            const judul = document.getElementById('judul-modal');
            judul.innerHTML = 'Tambah Rincian Transaksi';
            $('#btn-ubah-detailbankmasuk').hide();
            $('#modal-bankmasuk').modal('show');
        }
    });
    // end tombol tambah rinciantransaksi table
    // tombol simpan detailbankmasuk table
    $('#btn-simpan-detailbankmasuk').on('click', function (e) {
        e.preventDefault();
        const transaksi_id = $('[name="transaksi_id"]').val();
        const a6level_id = $('[name="a6level_id"]').val();
        const posisi_akun = $('[name="posisi_akun"]').val();
        const tgl2 = $('[name="tgl2"]').val();
        const idakun = $('[name="idakun"]').val();
        const idjt = $('[name="idjt"]').val();
        const idubah = $('[name="idubah"]').val();
        const jumlah = $('[name="jumlah"]').val();
        $.ajax({
            cache: false,
            type: "POST",
            url: base_url + "akuntansi/bankmasuk/simpandetail",
            data: {
                idakun: idakun,
                idubah: idubah,
                idjt: idjt,
                transaksi_id: transaksi_id,
                a6level_id: a6level_id,
                posisi_akun: posisi_akun,
                tgl2: tgl2,
                jumlah: jumlah
            },
            dataType: "JSON",
            beforeSend: function () {
                $('#btn-simpan-detailbankmasuk').attr('disabled', 'disabled');
            },
            success: function (data) {
                if (data.status == 'gagal') {
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

                    $('#a6level_id').trigger('focus');
                } else {
                    //$('#btn-simpan-transaksi').attr('disabled', false);
                    Toast.fire({
                        icon: 'success',
                        title: ' Data berhasil disimpan!'
                    });
                    document.location.reload();
                    //$('#modal-bankmasuk').modal('show');
                }
                $('#btn-simpan-detailbankmasuk').attr('disabled', false);
            }
        });
        return false;


    });
    // end tombol simpan detailbankmasuk table
    // tombol ubah detailtransaksi table
    $('#btn-ubah-detailbankmasuk').on('click', function (e) {
        e.preventDefault();
        const idubah = $('[name="idubah"]').val();
        const transaksi_id = $('[name="transaksi_id"]').val();
        const a6level_id = $('[name="a6level_id"]').val();
        const idakun = $('[name="idakun"]').val();
        const tgl2 = $('[name="tgl2"]').val();
        const posisi_akun = $('[name="posisi_akun"]').val();
        const jumlah = $('[name="jumlah"]').val();
        $.ajax({
            cache: false,
            type: "POST",
            url: base_url + "akuntansi/bankmasuk/ubahdetail/" + idubah,
            data: {
                idubah: idubah,
                idakun: idakun,
                transaksi_id: transaksi_id,
                a6level_id: a6level_id,
                posisi_akun: posisi_akun,
                tgl2: tgl2,
                jumlah: jumlah
            },
            dataType: "JSON",
            beforeSend: function () {
                $('#btn-ubah-detailbankmasuk').attr('disabled', 'disabled');
            },
            success: function (data) {
                if (data.status == 'gagal') {
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

                    $('#a6level_id').trigger('focus');
                } else {
                    //$('#btn-simpan-transaksi').attr('disabled', false);
                    Toast.fire({
                        icon: 'success',
                        title: ' Data berhasil disimpan!'
                    });
                    //document.location.reload();
                    $('#modal-bankmasuk').modal('hide');
                }
                $('#btn-ubah-detailbankmasuk').attr('disabled', false);
            }
        });
        return false;

    });
    // end tombol ubah detailtransaksi table
    // ajax tombol edit data table kelas klik
    $('.btn-edit-detailbankmasuk').on('click', function (e) {
        e.preventDefault();
        const judul = document.getElementById('judul-modal');
        judul.innerHTML = 'Ubah Rincian Transaksi';
        var id = $(this).data('id');
        $('#btn-simpan-detailbankmasuk').hide();
        $('#id').attr('disabled', 'disabled');
        $.ajax({
            url: base_url + 'akuntansi/bankmasuk/ajax_editrincian/' + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('[name="idubah"]').val(data.id);
                $('[name="a6level_id"]').val(data.a6level_id);
                $('[name="idakun"]').val(data.a6level_id);
                $('[name="posisi_akun"]').val(data.posisi_akun);
                $('[name="jumlah"]').val(data.jumlah);
                $('#modal-bankmasuk').modal('show');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    });
    //end ajax tombol edit data table kelas klik
    // ajax icon hapus table rincian klik
    $('.btn-hapus-detailbankmasuk').on('click', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var info = $(this).data('info');
        Swal.fire({
            title: 'Konfirmasi!',
            text: 'Apakah anda yakin akan menghapus Rincian -' + info + '- !?!',
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
                    url: base_url + "akuntansi/bankmasuk/hapusrincian",
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
                                title: ' Penghapusan gagal!!!.'
                            });
                        }
                    }
                });
            }
        })
    });
    // end ajax icon hapus table rincian klik
    // tombol simpan bankmasuk
    $('#btn-simpan-bankmasuk').on('click', function (e) {
        e.preventDefault();
        const notran = $('[name="notran"]').val();
        const tahun_pembukuan_id = $('[name="tahun_pembukuan_id"]').val();
        const jurnal = $('[name="jurnal"]').val();
        const unit_id = $('[name="unit_id"]').val();
        const noref = $('[name="noref"]').val();
        const nobukti = $('[name="nobukti"]').val();
        const tanggal_transaksi = $('[name="tanggal_transaksi"]').val();
        const keterangan = $('[name="keterangan"]').val();
        const status = $(this).data('status');
        if (status == 0) {
            $.ajax({
                type: "POST",
                url: base_url + "akuntansi/bankmasuk/simpan",
                data: {
                    nobukti: nobukti,
                    tanggal_transaksi: tanggal_transaksi,
                    keterangan: keterangan,
                    unit_id: unit_id,
                    noref: noref,
                    jurnal: jurnal,
                    notran: notran,
                    tahun_buku: tahun_pembukuan_id
                },
                dataType: "JSON",
                beforeSend: function () {
                    $('#btn-simpan-bankmasuk').attr('disabled', 'disabled');
                },
                success: function (data) {
                    if (data.status == 'gagal') {
                        Toast.fire({
                            icon: 'error',
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
                            icon: 'success',
                            title: ' Data berhasil disimpan!'
                        });
                        document.location.reload();
                        //$('#modal-bankmasuk').modal('show');
                    }
                    $('#btn-simpan-bankmasuk').attr('disabled', false);
                }
            });
            return false;
        } else {
            const transaksi_id = $('[name="tran_id"]').val();
            const unit_id = $('[name="unit_id"]').val();
            const noref = $('[name="noref"]').val();
            const nobukti = $('[name="nobukti"]').val();
            const tanggal_transaksi = $('[name="tanggal_transaksi"]').val();
            const keterangan = $('[name="keterangan"]').val();
            $.ajax({
                type: "POST",
                url: base_url + "akuntansi/bankmasuk/ubah/" + transaksi_id,
                data: {
                    nobukti: nobukti,
                    noref: noref,
                    tanggal_transaksi: tanggal_transaksi,
                    keterangan: keterangan,
                    unit_id: unit_id
                },
                dataType: "JSON",
                beforeSend: function () {
                    $('#btn-simpan-bankmasuk').attr('disabled', 'disabled');
                },
                success: function (data) {
                    if (data.status == 'gagal') {
                        Toast.fire({
                            icon: 'error',
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
                            icon: 'success',
                            title: ' Data berhasil diubah!'
                        });
                        document.location.reload();
                        //$('#modal-bankmasuk').modal('show');
                    }
                    $('#btn-simpan-bankmasuk').attr('disabled', false);
                }
            });
            return false;
        }
    });
    // end tombol simpan bankmasuk
    // ajax icon selesai bankmasuk
    $('#btn-selesai-bankmasuk').on('click', function (e) {
        e.preventDefault();
        var transaksi_id = $(this).data('id');
        var total_transaksi = $(this).data('total');
        //var info = $(this).data('info');
        Swal.fire({
            title: 'Konfirmasi!',
            text: 'Apakah anda yakin data telah benar!?!',
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
                    url: base_url + "akuntansi/bankmasuk/selesaitransaksi",
                    data: {
                        transaksi_id: transaksi_id,
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
                    }
                });
            }
        })
    });
    // end ajax icon selesai bankmasuk

    //----------------------------------/BANK MASUK-----------------------------------------
    //----------------------------------/BANK KELUAR-----------------------------------------

    // tombol tambah rinciantransaksi table
    $('#btn-tambah-rincianbankkeluar').on('click', function (e) {
        e.preventDefault();
        const tran_id = $('[name="tran_id"]').val();
        if (tran_id == '') {
            Toast.fire({
                icon: 'warning',
                title: ' Harap isi dan simpan form transaksi terlebih dahulu!!!.'
            });
        } else {
            const judul = document.getElementById('judul-modal');
            judul.innerHTML = 'Tambah Rincian Transaksi';
            $('#btn-ubah-detailbankkeluar').hide();
            $('#modal-bankkeluar').modal('show');
        }
    });
    // end tombol tambah rinciantransaksi table
    // tombol simpan detailbankkeluar table
    $('#btn-simpan-detailbankkeluar').on('click', function (e) {
        e.preventDefault();
        const transaksi_id = $('[name="transaksi_id"]').val();
        const a6level_id = $('[name="a6level_id"]').val();
        const posisi_akun = $('[name="posisi_akun"]').val();
        const idakun = $('[name="idakun"]').val();
        const idjt = $('[name="idjt"]').val();
        const tgl2 = $('[name="tgl2"]').val();
        const idubah = $('[name="idubah"]').val();
        const jumlah = $('[name="jumlah"]').val();
        $.ajax({
            type: "POST",
            url: base_url + "akuntansi/bankkeluar/simpandetail",
            data: {
                idakun: idakun,
                idubah: idubah,
                idjt: idjt,
                transaksi_id: transaksi_id,
                a6level_id: a6level_id,
                posisi_akun: posisi_akun,
                tgl2: tgl2,
                jumlah: jumlah
            },
            dataType: "JSON",
            beforeSend: function () {
                $('#btn-simpan-detailbankkeluar').attr('disabled', 'disabled');
            },
            success: function (data) {
                if (data.status == 'gagal') {
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

                    $('#a6level_id').trigger('focus');
                } else {
                    //$('#btn-simpan-transaksi').attr('disabled', false);
                    Toast.fire({
                        icon: 'success',
                        title: ' Data berhasil disimpan!'
                    });
                    document.location.reload();
                    //$('#modal-bankkeluar').modal('show');
                }
                $('#btn-simpan-detailbankkeluar').attr('disabled', false);
            }
        });
        return false;
    });
    // end tombol simpan detailbankkeluar table
    // tombol ubah detailtransaksi table
    $('#btn-ubah-detailbankkeluar').on('click', function (e) {
        e.preventDefault();
        const idubah = $('[name="idubah"]').val();
        const transaksi_id = $('[name="transaksi_id"]').val();
        const a6level_id = $('[name="a6level_id"]').val();
        const tgl2 = $('[name="tgl2"]').val();
        const idakun = $('[name="idakun"]').val();
        const posisi_akun = $('[name="posisi_akun"]').val();
        const jumlah = $('[name="jumlah"]').val();
        $.ajax({
            cache: false,
            type: "POST",
            url: base_url + "akuntansi/bankkeluar/ubahdetail/" + idubah,
            data: {
                idubah: idubah,
                idakun: idakun,
                transaksi_id: transaksi_id,
                a6level_id: a6level_id,
                posisi_akun: posisi_akun,
                tgl2: tgl2,
                jumlah: jumlah
            },
            dataType: "JSON",
            beforeSend: function () {
                $('#btn-ubah-detailbankkeluar').attr('disabled', 'disabled');
            },
            success: function (data) {
                if (data.status == 'gagal') {
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

                    $('#a6level_id').trigger('focus');
                } else {
                    //$('#btn-simpan-transaksi').attr('disabled', false);
                    Toast.fire({
                        icon: 'success',
                        title: ' Data berhasil disimpan!'
                    });
                    //document.location.reload();
                    $('#modal-bankkeluar').modal('hide');
                }
                $('#btn-ubah-detailbankkeluar').attr('disabled', false);
            }
        });
        return false;

    });
    // end tombol ubah detailtransaksi table
    // ajax tombol edit data table kelas klik
    $('.btn-edit-detailbankkeluar').on('click', function (e) {
        e.preventDefault();
        const judul = document.getElementById('judul-modal');
        judul.innerHTML = 'Ubah Rincian Transaksi';
        var id = $(this).data('id');
        $('#btn-simpan-detailbankkeluar').hide();
        $('#id').attr('disabled', 'disabled');
        $.ajax({
            url: base_url + 'akuntansi/bankkeluar/ajax_editrincian/' + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('[name="idubah"]').val(data.id);
                $('[name="a6level_id"]').val(data.a6level_id);
                $('[name="idakun"]').val(data.a6level_id);
                $('[name="posisi_akun"]').val(data.posisi_akun);
                $('[name="jumlah"]').val(data.jumlah);
                $('#modal-bankkeluar').modal('show');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    });
    //end ajax tombol edit data table kelas klik
    // ajax icon hapus table rincian klik
    $('.btn-hapus-detailbankkeluar').on('click', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var info = $(this).data('info');
        Swal.fire({
            title: 'Konfirmasi!',
            text: 'Apakah anda yakin akan menghapus Rincian -' + info + '- !?!',
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
                    url: base_url + "akuntansi/bankkeluar/hapusrincian",
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
                                title: ' Penghapusan gagal!!!.'
                            });
                        }
                    }
                });
            }
        })
    });
    // end ajax icon hapus table rincian klik
    // tombol simpan bankkeluar
    $('#btn-simpan-bankkeluar').on('click', function (e) {
        e.preventDefault();
        const notran = $('[name="notran"]').val();
        const tahun_pembukuan_id = $('[name="tahun_pembukuan_id"]').val();
        const jurnal = $('[name="jurnal"]').val();
        const noref = $('[name="noref"]').val();
        const unit_id = $('[name="unit_id"]').val();
        const nobukti = $('[name="nobukti"]').val();
        const tanggal_transaksi = $('[name="tanggal_transaksi"]').val();
        const keterangan = $('[name="keterangan"]').val();
        const status = $(this).data('status');
        if (status == 0) {
            $.ajax({
                type: "POST",
                url: base_url + "akuntansi/bankkeluar/simpan",
                data: {
                    nobukti: nobukti,
                    tanggal_transaksi: tanggal_transaksi,
                    keterangan: keterangan,
                    unit_id: unit_id,
                    noref: noref,
                    jurnal: jurnal,
                    notran: notran,
                    tahun_buku: tahun_pembukuan_id
                },
                dataType: "JSON",
                beforeSend: function () {
                    $('#btn-simpan-bankkeluar').attr('disabled', 'disabled');
                },
                success: function (data) {
                    if (data.status == 'gagal') {
                        Toast.fire({
                            icon: 'error',
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
                            icon: 'success',
                            title: ' Data berhasil disimpan!'
                        });
                        document.location.reload();
                        //$('#modal-bankkeluar').modal('show');
                    }
                    $('#btn-simpan-bankkeluar').attr('disabled', false);
                }
            });
            return false;
        } else {
            const transaksi_id = $('[name="tran_id"]').val();
            const unit_id = $('[name="unit_id"]').val();
            const noref = $('[name="noref"]').val();
            const nobukti = $('[name="nobukti"]').val();
            const tanggal_transaksi = $('[name="tanggal_transaksi"]').val();
            const keterangan = $('[name="keterangan"]').val();
            $.ajax({
                type: "POST",
                url: base_url + "akuntansi/bankkeluar/ubah/" + transaksi_id,
                data: {
                    nobukti: nobukti,
                    noref: noref,
                    tanggal_transaksi: tanggal_transaksi,
                    keterangan: keterangan,
                    unit_id: unit_id
                },
                dataType: "JSON",
                beforeSend: function () {
                    $('#btn-simpan-bankkeluar').attr('disabled', 'disabled');
                },
                success: function (data) {
                    if (data.status == 'gagal') {
                        Toast.fire({
                            icon: 'error',
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
                            icon: 'success',
                            title: ' Data berhasil diubah!'
                        });
                        document.location.reload();
                        //$('#modal-bankkeluar').modal('show');
                    }
                    $('#btn-simpan-bankkeluar').attr('disabled', false);
                }
            });
            return false;
        }
    });
    // end tombol simpan bankkeluar
    // ajax icon selesai bankkeluar
    $('#btn-selesai-bankkeluar').on('click', function (e) {
        e.preventDefault();
        var transaksi_id = $(this).data('id');
        var total_transaksi = $(this).data('total');
        //var info = $(this).data('info');
        Swal.fire({
            title: 'Konfirmasi!',
            text: 'Apakah anda yakin data telah benar!?!',
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
                    url: base_url + "akuntansi/bankkeluar/selesaitransaksi",
                    data: {
                        transaksi_id: transaksi_id,
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
                    }
                });
            }
        })
    });
    // end ajax icon selesai bankkeluar

    //----------------------------------/BANK KELUAR-----------------------------------------
    //----------------------------------/NON KAS BANK-----------------------------------------

    // tombol tambah rinciantransaksi table
    $('#btn-tambah-rinciannonkasbank').on('click', function (e) {
        e.preventDefault();
        const tran_id = $('[name="tran_id"]').val();
        if (tran_id == '') {
            Toast.fire({
                icon: 'warning',
                title: ' Harap isi dan simpan form transaksi terlebih dahulu!!!.'
            });
        } else {
            const judul = document.getElementById('judul-modal');
            judul.innerHTML = 'Tambah Rincian Transaksi';
            $('#btn-ubah-detailnonkasbank').hide();
            $('#modal-nonkasbank').modal('show');
        }
    });
    // end tombol tambah rinciantransaksi table
    // tombol simpan detailnonkasbank table
    $('#btn-simpan-detailnonkasbank').on('click', function (e) {
        e.preventDefault();
        const transaksi_id = $('[name="transaksi_id"]').val();
        const a6level_id = $('[name="a6level_id"]').val();
        const tgl2 = $('[name="tgl2"]').val();
        const posisi_akun = $('[name="posisi_akun"]').val();
        const idakun = $('[name="idakun"]').val();
        const idjt = $('[name="idjt"]').val();
        const idubah = $('[name="idubah"]').val();
        const jumlah = $('[name="jumlah"]').val();
        $.ajax({
            cache: false,
            type: "POST",
            url: base_url + "akuntansi/nonkasbank/simpandetail",
            data: {
                idakun: idakun,
                idubah: idubah,
                idjt: idjt,
                transaksi_id: transaksi_id,
                a6level_id: a6level_id,
                posisi_akun: posisi_akun,
                tgl2: tgl2,
                jumlah: jumlah
            },
            dataType: "JSON",
            beforeSend: function () {
                $('#btn-simpan-detailnonkasbank').attr('disabled', 'disabled');
            },
            success: function (data) {
                if (data.status == 'gagal') {
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

                    $('#a6level_id').trigger('focus');
                } else {
                    //$('#btn-simpan-transaksi').attr('disabled', false);
                    Toast.fire({
                        icon: 'success',
                        title: ' Data berhasil disimpan!'
                    });
                    document.location.reload();
                    //$('#modal-nonkasbank').modal('show');
                }
                $('#btn-simpan-detailnonkasbank').attr('disabled', false);
            }
        });
        return false;
    });
    // end tombol simpan detailnonkasbank table
    // tombol ubah detailtransaksi table
    $('#btn-ubah-detailnonkasbank').on('click', function (e) {
        e.preventDefault();
        const idubah = $('[name="idubah"]').val();
        const transaksi_id = $('[name="transaksi_id"]').val();
        const a6level_id = $('[name="a6level_id"]').val();
        const idakun = $('[name="idakun"]').val();
        const tgl2 = $('[name="tgl2"]').val();
        const posisi_akun = $('[name="posisi_akun"]').val();
        const jumlah = $('[name="jumlah"]').val();
        $.ajax({
            cache: false,
            type: "POST",
            url: base_url + "akuntansi/nonkasbank/ubahdetail/" + idubah,
            data: {
                idubah: idubah,
                idakun: idakun,
                transaksi_id: transaksi_id,
                a6level_id: a6level_id,
                posisi_akun: posisi_akun,
                tgl2: tgl2,
                jumlah: jumlah
            },
            dataType: "JSON",
            beforeSend: function () {
                $('#btn-ubah-detailnonkasbank').attr('disabled', 'disabled');
            },
            success: function (data) {
                if (data.status == 'gagal') {
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

                    $('#a6level_id').trigger('focus');
                } else {
                    //$('#btn-simpan-transaksi').attr('disabled', false);
                    Toast.fire({
                        icon: 'success',
                        title: ' Data berhasil disimpan!'
                    });
                    //document.location.reload();
                    $('#modal-nonkasbank').modal('hide');
                }
                $('#btn-ubah-detailnonkasbank').attr('disabled', false);
            }
        });
        return false;

    });
    // end tombol ubah detailtransaksi table
    // ajax tombol edit data table kelas klik
    $('.btn-edit-detailnonkasbank').on('click', function (e) {
        e.preventDefault();
        const judul = document.getElementById('judul-modal');
        judul.innerHTML = 'Ubah Rincian Transaksi';
        var id = $(this).data('id');
        $('#btn-simpan-detailnonkasbank').hide();
        $('#id').attr('disabled', 'disabled');
        $.ajax({
            url: base_url + 'akuntansi/nonkasbank/ajax_editrincian/' + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('[name="idubah"]').val(data.id);
                $('[name="a6level_id"]').val(data.a6level_id);
                $('[name="idakun"]').val(data.a6level_id);
                $('[name="posisi_akun"]').val(data.posisi_akun);
                $('[name="jumlah"]').val(data.jumlah);
                $('#modal-nonkasbank').modal('show');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    });
    //end ajax tombol edit data table kelas klik
    // ajax icon hapus table rincian klik
    $('.btn-hapus-detailnonkasbank').on('click', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var info = $(this).data('info');
        Swal.fire({
            title: 'Konfirmasi!',
            text: 'Apakah anda yakin akan menghapus Rincian -' + info + '- !?!',
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
                    url: base_url + "akuntansi/nonkasbank/hapusrincian",
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
                                title: ' Penghapusan gagal!!!.'
                            });
                        }
                    }
                });
            }
        })
    });
    // end ajax icon hapus table rincian klik
    // tombol simpan nonkasbank
    $('#btn-simpan-nonkasbank').on('click', function (e) {
        e.preventDefault();
        const notran = $('[name="notran"]').val();
        const tahun_pembukuan_id = $('[name="tahun_pembukuan_id"]').val();
        const jurnal = $('[name="jurnal"]').val();
        const unit_id = $('[name="unit_id"]').val();
        const noref = $('[name="noref"]').val();
        const nobukti = $('[name="nobukti"]').val();
        const tanggal_transaksi = $('[name="tanggal_transaksi"]').val();
        const keterangan = $('[name="keterangan"]').val();
        const status = $(this).data('status');
        if (status == 0) {
            $.ajax({
                type: "POST",
                url: base_url + "akuntansi/nonkasbank/simpan",
                data: {
                    nobukti: nobukti,
                    tanggal_transaksi: tanggal_transaksi,
                    keterangan: keterangan,
                    unit_id: unit_id,
                    noref: noref,
                    jurnal: jurnal,
                    notran: notran,
                    tahun_buku: tahun_pembukuan_id
                },
                dataType: "JSON",
                beforeSend: function () {
                    $('#btn-simpan-nonkasbank').attr('disabled', 'disabled');
                },
                success: function (data) {
                    if (data.status == 'gagal') {
                        Toast.fire({
                            icon: 'error',
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
                            icon: 'success',
                            title: ' Data berhasil disimpan!'
                        });
                        document.location.reload();
                        //$('#modal-nonkasbank').modal('show');
                    }
                    $('#btn-simpan-nonkasbank').attr('disabled', false);
                }
            });
            return false;
        } else {
            const transaksi_id = $('[name="tran_id"]').val();
            const unit_id = $('[name="unit_id"]').val();
            const noref = $('[name="noref"]').val();
            const nobukti = $('[name="nobukti"]').val();
            const tanggal_transaksi = $('[name="tanggal_transaksi"]').val();
            const keterangan = $('[name="keterangan"]').val();
            $.ajax({
                type: "POST",
                url: base_url + "akuntansi/nonkasbank/ubah/" + transaksi_id,
                data: {
                    nobukti: nobukti,
                    noref: noref,
                    tanggal_transaksi: tanggal_transaksi,
                    keterangan: keterangan,
                    unit_id: unit_id
                },
                dataType: "JSON",
                beforeSend: function () {
                    $('#btn-simpan-nonkasbank').attr('disabled', 'disabled');
                },
                success: function (data) {
                    if (data.status == 'gagal') {
                        Toast.fire({
                            icon: 'error',
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
                            icon: 'success',
                            title: ' Data berhasil diubah!'
                        });
                        document.location.reload();
                        //$('#modal-nonkasbank').modal('show');
                    }
                    $('#btn-simpan-nonkasbank').attr('disabled', false);
                }
            });
            return false;
        }
    });
    // end tombol simpan nonkasbank
    // ajax icon selesai nonkasbank
    $('#btn-selesai-nonkasbank').on('click', function (e) {
        e.preventDefault();
        var transaksi_id = $(this).data('id');
        var total_transaksi = $(this).data('total');
        //var info = $(this).data('info');
        Swal.fire({
            title: 'Konfirmasi!',
            text: 'Apakah anda yakin data telah benar!?!',
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
                    url: base_url + "akuntansi/nonkasbank/selesaitransaksi",
                    data: {
                        transaksi_id: transaksi_id,
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
                    }
                });
            }
        })
    });
    // end ajax icon selesai nonkasbank

    //----------------------------------/NON KAS BANK-----------------------------------------


}); // end document ready
