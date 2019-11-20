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


    // ---------------------/TES---------------------------
});
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