<script>
    $('body').on('click', '#btn-delete-item', function() {
        let item_id = $(this).data('id');
        let token = $("meta[name='csrf-token']").attr("content");
        Swal.fire({
            title: 'Apakah Kamu Yakin?',
            text: "ingin menghapus data ini!",
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'TIDAK',
            confirmButtonText: 'YA, HAPUS!'
        }).then((result) => {
            if (result.isConfirmed) {
                console.log('test');
                $.ajax({
                    url: `/item/${item_id}`,
                    type: "DELETE",
                    cache: false,
                    data: {
                        "_token": token
                    },
                    success: function(response) {

                        Swal.fire({
                            type: 'success',
                            icon: 'success',
                            title: `${response.message}`,
                            showConfirmButton: false,
                            timer: 3000
                        });
                        $(`#index_${item_id}`).remove();

                        $('#data').DataTable().ajax.reload();
                    }
                });


            }
        })

    });
</script>
