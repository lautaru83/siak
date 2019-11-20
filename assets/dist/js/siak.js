// saat document ready
// $('#form_id').trigger("reset"); form reset
$(document).ready(function () {
    const Toast = Swal.mixin({
        toast: true,
        position: 'center',
        showConfirmButton: false,
        timer: 4000
    });
    // atur datatable
    $('#tabel1').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "ordering": false
    })
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
                    if (data.unit_error != '') {
                        $('#unit_error').html(data.unit_error);
                    } else {
                        $('#unit_error').html('');
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
                $('[name="unit_id"]').val(data.unit_id);
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
                    if (data.unit_error != '') {
                        $('#unit_error').html(data.unit_error);
                    } else {
                        $('#unit_error').html('');
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



}); // end document ready
