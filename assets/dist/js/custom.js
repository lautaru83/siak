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


    //---------------------------------------END INSTITUSI----------------------------------------

    //---------------------------------------UNIT----------------------------------------
    $('#modal-ubah').on('show.bs.modal', function (event) {
        var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
        var modal = $(this)
        modal.find('#idubah').attr("value", div.data('id'));
        modal.find('#role').attr("value", div.data('role'));
        modal.find('#keterangan').html(div.data('keterangan'));

    });
    $('#modal-ubah-unit').on('show.bs.modal', function (event) {
        var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
        var modal = $(this)

        // Isi nilai pada field
        modal.find('#idunit').attr("value", div.data('id'));
        modal.find('#unit').attr("value", div.data('unit'));
        modal.find('#institusi_id').attr("value", div.data('idinstitusi'));
        //
    });
    $('#modal-hapus-unit').on('show.bs.modal', function (event) {
        var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
        var modal = $(this)

        // Isi nilai pada field
        modal.find('#idhapus').attr("value", div.data('id'));
        modal.find('#unithapus').attr("value", div.data('unit'));
    });

    //---------------------------------------END UNIT----------------------------------------




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


    //ubah=tes-klik
    // $('.ubah-tes').on('click', function (e) {
    //     e.preventDefault();
    //     const id = $(this).data('id');

    //     $.ajax({
    //         url: base_url + "institusi/ajax_edit/" + id,
    //         type: "GET",
    //         dataType: "JSON",
    //         success: function (data) {
    //             $('[name="id"]').val(data.id);
    //             $('[name="institusi"]').val(data.institusi);
    //             $('[name="keterangan"]').val(data.keterangan);
    //             $('#modal-institusi').modal('show');
    //         },
    //         error: function (jqXHR, textStatus, errorThrown) {
    //             alert('Error get data from ajax');
    //         }
    //     });
    // });

