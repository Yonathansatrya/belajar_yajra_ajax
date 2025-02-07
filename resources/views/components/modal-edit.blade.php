<!-- Modal -->
<div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    {{-- berfungsi sebagai hidden area --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">EDIT ITEM</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <input type="hidden" id="item_id">

                <div class="form-group">
                    <label for="item_name" class="control-label">Name Item</label>
                    <input type="text" class="form-control" id="item_name-edit">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-item_name-edit"></div>
                </div>

                <div class="form-group">
                    <label for="type_item" class="control-label">Type Item</label>
                    <select class="form-control" id="type_item-edit" name="type_item-edit">
                        <option value="Berat">Berat</option>
                        <option value="camilan">Camilan</option>
                        <option value="Minuman">Minuman</option>
                    </select>
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-type_item-edit"></div>
                </div>

                <div class="form-group">
                    <label class="control-label">Total Item</label>
                    <input type="number" class="form-control" id="total_item-edit">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-total_item-edit"></div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">TUTUP</button>
                <button type="button" class="btn btn-primary" id="update">UPDATE</button>
            </div>
        </div>
    </div>
</div>



<script>
    $('body').on('click', '#btn-edit-item', function() {

        let Item_id = $(this).data('id');

        $.ajax({
            url: `/item/${Item_id}`,
            type: "GET",
            cache: false,
            success: function(response) {

                $('#item_id').val(response.data.id);
                $('#item_name-edit').val(response.data.item_name);
                $('#type_item-edit').val(response.data.type_item);
                $('#total_item-edit').val(response.data.total_item);

                $('#modal-edit').modal('show');
            }
        });
    });

    $('#update').click(function(e) {
        e.preventDefault();

        let item_id = $('#item_id').val();
        let item_name = $("#item_name-edit").val();
        let type_item = $("#type_item-edit").val();
        let total_item = $("#total_item-edit").val();
        let token = $("meta[name='csrf-token']").attr("content");

        $.ajax({
            url: `/item/${item_id}`,
            type: "POST",
            cache: false,
            data: {
                "item_name": item_name,
                "type_item": type_item,
                "total_item": total_item,
                "_token": token,
                '_method': 'PUT'
            },

            success: function(response) {
                Swal.fire({
                    type: 'success',
                    icon: 'success',
                    title: `${response.message}`,
                    showConfirmButton: false,
                    timer: 3000
                });

                let items = `
                    <tr id="index_${response.data.id}">
                        <td>${response.data.item_name}</td>
                        <td>${response.data.type_item}</td>
                        <td>${response.data.total_item}</td>
                        <td class="text-center">
                            <a href="javascript:void(0)" id="btn-edit-item" data-id="${response.data.id}" class="btn btn-primary btn-sm">EDIT</a>
                            <a href="javascript:void(0)" id="btn-delete-item" data-id="${response.data.id}" class="btn btn-danger btn-sm">DELETE</a>
                        </td>
                    </tr>
                `;

                $(`#index_${response.data.id}`).replaceWith(items);

                $('#modal-edit').modal('hide');


            },
            error: function(error) {
                let errorMessage = '';

                if (error.responseJSON && error.responseJSON.item_name) {
                    errorMessage +=
                        `<strong>Item Name:</strong> ${error.responseJSON.item_name[0]}<br>`;
                }

                if (error.responseJSON && error.responseJSON.type_item) {
                    errorMessage +=
                        `<strong>Type Item:</strong> ${error.responseJSON.type_item[0]}<br>`;
                }

                if (error.responseJSON && error.responseJSON.total_item) {
                    errorMessage +=
                        `<strong>Total Item:</strong> ${error.responseJSON.total_item[0]}<br>`;
                }

                if (!errorMessage) {
                    errorMessage = 'An unexpected error occurred. Please try again later.';
                }

                Swal.fire({
                    title: "Validation Error!",
                    html: errorMessage,
                    icon: "error",
                    confirmButtonText: "OK"
                });
            }
        });
    });
</script>
