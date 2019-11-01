//var id = 0 // Untuk menampung ID yang kaan di ubah / hapus
$(document).ready(function () {
    // Sembunyikan loading simpan, loading ubah, loading hapus, pesan error, pesan sukes, dan tombol reset
    $('#loading-simpan, #loading-ubah, #loading-hapus, #pesan-error, #pesan-sukses, #btn-reset').hide()

    $('#table1').DataTable();
    $('body').on('hidden.bs.modal', '.modal', function () {
        $(this).removeData('bs.modal');
        document.location.reload();
    });
    //---------------------------------------INSTITUSI----------------------------------------
    // tombol tambah institusi table
    $('#btn-tambah-institusi').on('click', function (e) {
        e.preventDefault();
        const judul = document.getElementById('judul-modal');
        judul.innerHTML = 'Tambah Data Istitusi';
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
                    Swal.fire({
                        title: 'Data tidak valid!',
                        text: '',
                        type: 'warning'
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
                } else {
                    Swal.fire({
                        title: 'Data berhasil disimpan!',
                        text: '',
                        type: 'success'
                    })
                    $('#modal-institusi').modal('hide');
                    dataTable.ajax.reload();
                }
                $('#btn-simpan-institusi').attr('disabled', false);
            }
        });
        return false;
    });
    //end  ajax tombol Simpan modal institusi
    // ajax tombol ubah data table institusi klik
    $('.ubah-institusi').on('click', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        $('#btn-simpan-institusi').hide();
        $.ajax({
            url: site_url + 'institusi/ajax_edit/' + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('[name="id"]').val(data.id);
                $('[name="institusi"]').val(data.institusi);
                $('[name="keterangan"]').val(data.keterangan);
                $('#modal-institusi').modal('show');
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
        var id = $('#id').val();
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
                    Swal.fire({
                        title: 'Data tidak valid!',
                        text: '',
                        type: 'warning'
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
                } else {
                    Swal.fire({
                        title: 'Data berhasil diubah!',
                        text: '',
                        type: 'success'
                    });
                    $('#modal-institusi').modal('hide');
                    dataTable.ajax.reload();
                }
                $('#btn-ubah-institusi').attr('disabled', false);
            }
        });
        return false;
    });
    // end ajax tombol modal ubah institusi
    //Hapus institusi
    $('.hapus-institusi').on('click', function (e) {
        e.preventDefault();
        const href = $(this).attr('href');
        var datainfo = $(this).data('institusi');
        Swal.fire({
            title: 'Apakah anda yakin',
            text: 'Institusi ' + datainfo + ' akan dihapus ?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus Data!'
        }).then((result) => {
            if (result.value) {
                document.location.href = href;
            }
        })
    });
    // end Hapus institusi
    //---------------------------------------END INSTITUSI----------------------------------------

    //---------------------------------------UNIT----------------------------------------
    // tombol tambah unit table
    $('#btn-tambah-unit').on('click', function (e) {
        e.preventDefault();
        const judul = document.getElementById('judul-modal');
        judul.innerHTML = 'Tambah Data Unit';
        $('#btn-ubah-unit').hide();
        $('#modal-unit').modal('show');
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
                    Swal.fire({
                        title: 'Data tidak valid!',
                        text: '',
                        type: 'warning'
                    });
                    if (data.id_error != '') {
                        $('#id_error').html(data.id_error);

                    } else {
                        $('#id_error').html('');
                    }
                    if (data.unit_error != '') {
                        $('#unit_error').html(data.unit_error);
                    } else {
                        $('#unit_error').html('');
                    }
                    if (data.unit_error != '') {
                        $('#institusi_error').html(data.institusi_error);
                    } else {
                        $('#institusi_error').html('');
                    }
                } else {
                    Swal.fire({
                        title: 'Data berhasil disimpan!',
                        text: '',
                        type: 'success'
                    })
                    $('#modal-unit').modal('hide');
                    dataTable.ajax.reload();
                }
                $('#btn-simpan-unit').attr('disabled', false);
            }
        });
        return false;
    });
    //end  ajax tombol Simpan modal unit

    // ajax ubah-unit klik table
    $('.ubah-unit').on('click', function (e) {
        e.preventDefault();
        const judul = document.getElementById('judul-modal');
        judul.innerHTML = 'Ubah Data Unit';
        $('#btn-simpan-unit').hide();
        var id = $(this).data('id');
        $.ajax({
            url: site_url + "unit/ajax_edit/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('[name="id"]').val(data.id);
                $('[name="idubah"]').val(data.id);
                $('[name="institusi_id"]').val(data.institusi_id);
                $('[name="unit"]').val(data.unit);
                $('#id').attr('disabled', 'disabled');
                $('#modal-unit').modal('show');
                $('#unit').focus();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    });
    // end ajax ubah-unit klik table
    // ajax tombol ubah modal unit
    $('#btn-ubah-unit').on('click', function (e) {
        e.preventDefault();
        var id = $('#idubah').val();
        $.ajax({
            type: "POST",
            url: site_url + "unit/ubah/" + id,
            data: $("#form-unit").serialize(),
            dataType: "JSON",
            beforeSend: function () {
                $('#btn-ubah-unit').attr('disabled', 'disabled');
            },
            success: function (data) {
                if (data.status == 'gagal') {
                    Swal.fire({
                        title: 'Data tidak valid!',
                        text: '',
                        type: 'warning'
                    });
                    if (data.id_error != '') {
                        $('#id_error').html(data.id_error);

                    } else {
                        $('#id_error').html('');
                    }
                    if (data.unit_error != '') {
                        $('#unit_error').html(data.unit_error);
                    } else {
                        $('#unit_error').html('');
                    }
                    if (data.unit_error != '') {
                        $('#institusi_error').html(data.institusi_error);
                    } else {
                        $('#institusi_error').html('');
                    }
                } else {
                    Swal.fire({
                        title: 'Data berhasil diubah!',
                        text: '',
                        type: 'success'
                    })
                    $('#modal-unit').modal('hide');
                    dataTable.ajax.reload();
                }
                $('#btn-ubah-unit').attr('disabled', false);
            }
        });
        return false;
    });
    //end  ajax tombol ubah modal unit
    // Hapus unit
    $('.hapus-unit').on('click', function (e) {
        e.preventDefault();
        const href = $(this).attr('href');
        var datainfo = $(this).data('unit');
        Swal.fire({
            title: 'Apakah anda yakin',
            text: 'Unit ' + datainfo + ' akan dihapus ?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus Data!'
        }).then((result) => {
            if (result.value) {
                document.location.href = href;
            }
        })
    });
    // end Hapus unit

    //---------------------------------------END UNIT----------------------------------------
    //---------------------------------------ROLE----------------------------------------
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
                    Swal.fire({
                        title: 'Data tidak valid!',
                        text: '',
                        type: 'warning'
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
                } else {
                    Swal.fire({
                        title: 'Data berhasil disimpan!',
                        text: '',
                        type: 'success'
                    })
                    $('#modal-role').modal('hide');
                    dataTable.ajax.reload();
                }
                $('#btn-simpan-role').attr('disabled', false);
            }
        });
        return false;
    });
    //end  ajax tombol Simpan modal role
    // ajax ubah-role klik table
    $('.ubah-role').on('click', function (e) {
        e.preventDefault();
        const judul = document.getElementById('judul-modal');
        judul.innerHTML = 'Ubah Data Role';
        $('#btn-simpan-role').hide();
        var id = $(this).data('id');
        $.ajax({
            url: site_url + "role/ajax_edit/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('[name="idubah"]').val(data.id);
                $('[name="role"]').val(data.role);
                $('[name="keterangan"]').val(data.keterangan);
                $('#modal-role').modal('show');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    });
    // end ajax ubah-role klik table
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
                    Swal.fire({
                        title: 'Data tidak valid!',
                        text: '',
                        type: 'warning'
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
                } else {
                    Swal.fire({
                        title: 'Data berhasil diubah!',
                        text: '',
                        type: 'success'
                    });
                    $('#modal-role').modal('hide');
                    dataTable.ajax.reload();
                }
                $('#btn-ubah-role').attr('disabled', false);
            }
        });
        return false;
    });
    // end ajax tombol modal ubah role

    // Hapus role
    $('.hapus-role').on('click', function (e) {
        e.preventDefault();
        const href = $(this).attr('href');
        var datainfo = $(this).data('role');
        Swal.fire({
            title: 'Apakah anda yakin',
            text: 'Role ' + datainfo + ' akan dihapus ?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus Data!'
        }).then((result) => {
            if (result.value) {
                document.location.href = href;
            }
        })
    });
    // end Hapus role

    //---------------------------------------ENDROLE----------------------------------------
    //---------------------------------------MENU----------------------------------------
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
            url: site_url + "/menu/simpan",
            data: $("#form-menu").serialize(),
            dataType: "JSON",
            beforeSend: function () {
                $('#btn-simpan-menu').attr('disabled', 'disabled');
            },
            success: function (data) {
                if (data.status == 'gagal') {
                    Swal.fire({
                        title: 'Data tidak valid!',
                        text: '',
                        type: 'warning'
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
                } else {
                    Swal.fire({
                        title: 'Data berhasil disimpan!',
                        text: '',
                        type: 'success'
                    })
                    $('#modal-menu').modal('hide');
                    dataTable.ajax.reload();
                }
                $('#btn-simpan-menu').attr('disabled', false);
            }
        });
        return false;
    });
    //end  ajax tombol Simpan modal menu
    // ajax ubah-menu klik table
    $('.ubah-menu').on('click', function (e) {
        e.preventDefault();
        const judul = document.getElementById('judul-modal');
        judul.innerHTML = 'Ubah Data Menu';
        $('#btn-simpan-menu').hide();
        var id = $(this).data('id');
        $.ajax({
            url: site_url + "menu/ajax_edit/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('[name="idubah"]').val(data.id);
                $('[name="menu"]').val(data.menu);
                $('[name="icon"]').val(data.icon);
                $('[name="keterangan"]').val(data.keterangan);
                $('#modal-menu').modal('show');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    });
    // end ajax ubah-menu klik table
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
                    Swal.fire({
                        title: 'Data tidak valid!',
                        text: '',
                        type: 'warning'
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
                } else {
                    Swal.fire({
                        title: 'Data berhasil diubah!',
                        text: '',
                        type: 'success'
                    });
                    $('#modal-menu').modal('hide');
                    dataTable.ajax.reload();
                }
                $('#btn-ubah-menu').attr('disabled', false);
            }
        });
        return false;
    });
    // end ajax tombol modal ubah menu
    // Hapus menu
    $('.hapus-menu').on('click', function (e) {
        e.preventDefault();
        const href = $(this).attr('href');
        var datainfo = $(this).data('menu');
        Swal.fire({
            title: 'Apakah anda yakin',
            text: 'Menu ' + datainfo + ' akan dihapus ?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus Data!'
        }).then((result) => {
            if (result.value) {
                document.location.href = href;
            }
        })
    });
    // end Hapus menu

    //---------------------------------------ENDMENU----------------------------------------
    //---------------------------------------SUBMENU----------------------------------------
    // tombol tambah menu table
    $('#btn-tambah-submenu').on('click', function (e) {
        e.preventDefault();
        const judul = document.getElementById('judul-modal');
        judul.innerHTML = 'Tambah Data Submenu';
        $('#btn-ubah-submenu').hide();
        $('#modal-submenu').modal('show');
    });
    // end tombol tambah menu table
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
                    Swal.fire({
                        title: 'Data tidak valid!',
                        text: '',
                        type: 'warning'
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
                } else {
                    Swal.fire({
                        title: 'Data berhasil disimpan!',
                        text: '',
                        type: 'success'
                    })
                    $('#modal-submenu').modal('hide');
                    dataTable.ajax.reload();
                }
                $('#btn-simpan-submenu').attr('disabled', false);
            }
        });
        return false;
    });
    //end  ajax tombol Simpan modal submenu
    // Hapus submenu
    $('.hapus-submenu').on('click', function (e) {
        e.preventDefault();
        const href = $(this).attr('href');
        var datainfo = $(this).data('submenu');
        Swal.fire({
            title: 'Apakah anda yakin',
            text: 'Submenu ' + datainfo + ' akan dihapus ?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus Data!'
        }).then((result) => {
            if (result.value) {
                document.location.href = href;
            }
        })
    });
    // end Hapus menu
    // ajax ubah-submenu klik table
    $('.ubah-submenu').on('click', function (e) {
        e.preventDefault();
        const judul = document.getElementById('judul-modal');
        judul.innerHTML = 'Ubah Data Submenu';
        $('#btn-simpan-submenu').hide();
        var id = $(this).data('id');
        $.ajax({
            url: site_url + "submenu/ajax_edit/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('[name="idubah"]').val(data.id);
                $('[name="submenu"]').val(data.submenu);
                $('[name="menu_id"]').val(data.menu_id);
                $('[name="url"]').val(data.url);
                $('[name="icon"]').val(data.icon);
                $('#modal-submenu').modal('show');
                $('#submenu').focus();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    });
    // end ajax ubah-submenu klik table
    // ajax tombol ubah modal submenu
    $('#btn-ubah-submenu').on('click', function (e) {
        e.preventDefault();
        var id = $('#idubah').val();
        $.ajax({
            type: "POST",
            url: site_url + "submenu/ubah/" + id,
            data: $("#form-submenu").serialize(),
            dataType: "JSON",
            beforeSend: function () {
                $('#btn-ubah-submenu').attr('disabled', 'disabled');
            },
            success: function (data) {
                if (data.status == 'gagal') {
                    Swal.fire({
                        title: 'Data tidak valid!',
                        text: '',
                        type: 'warning'
                    })
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
                } else {
                    Swal.fire({
                        title: 'Data berhasil diubah!',
                        text: '',
                        type: 'success'
                    })
                    $('#modal-submenu').modal('hide');
                    dataTable.ajax.reload();
                }
                $('#btn-ubah-submenu').attr('disabled', false);
            }
        });
        return false;
    });
    //end  ajax tombol ubah modal submenu

    //---------------------------------------END-SUBMENU----------------------------------------


}); // end document ready






//sample ajax
// $('.edit-unit').on('click', function (e) {
//     e.preventDefault();
//     const id = $(this).data('id');
//     $.ajax({
//         url: base_url + "unit/ajax_ubah/" + id,
//         type: "GET",
//         dataType: "JSON",
//         success: function (data) {
//             $('[name="id"]').val(data.id);
//             $('#modal-unit').modal('show');
//         },
//         error: function (jqXHR, textStatus, errorThrown) {
//             alert('Error get data from ajax');
//         }
//     });
// })
// end sample ajax

// sample sweetalert
// Swal.fire({
//     title: 'Data tidak valid!' + id,
//     text: '',
//     type: 'warning'
// })
// end sample sweetalert

//tesss
// $('#btn-ubah-institusi').on('click', function (e) {
//     e.preventDefault();
//     var id = $('#id').val();
//     Swal.fire({
//         title: 'Diubah!' + id,
//         text: '',
//         type: 'success'
//     })
// });
//tesss




