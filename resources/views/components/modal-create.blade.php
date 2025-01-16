<div class="modal fade" id="modal-create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">TAMBAH ITEM</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="item_name" class="control-label">New Item</label>
                    <input type="text" class="form-control" id="item_name">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-title"></div>
                </div>

                <div class="form-group">
                    <label for="type_item" class="control-label">Type Item</label>
                    <select class="form-control" id="type_item" name="type_item">
                        <option value="Berat">Berat</option>
                        <option value="camilan">Camilan</option>
                        <option value="Minuman">Minuman</option>
                    </select>
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-type"></div>
                </div>

                <div class="form-group">
                    <label class="control-label">Total Item</label>
                    <input type="number" class="form-control" id="total_item">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-content"></div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">TUTUP</button>
                <button type="button" class="btn btn-primary" id="store">SIMPAN</button>
            </div>
        </div>
    </div>
</div>
<script>
    $("body").on("click", "#btn-create-post", function() {
        $("#modal-create").modal("show");
    });

    $("#store").click(function(e) {
        e.preventDefault();

        let item_name = $("#item_name").val();
        let type_item = $("#type_item").val();
        let total_item = $("#total_item").val();
        let token = $("meta[name='csrf-token']").attr("content");

        $.ajax({
            url: "{{ route('item.store') }}",
            type: "POST",
            cache: false,
            data: {
                "item_name": item_name,
                "type_item": type_item,
                "total_item": total_item,
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

                let items = `
                    <tr id="index_${response.data.id}">
                        <td>${response.data.item_name}</td>
                        <td>${response.data.type_item}</td>
                        <td>${response.data.total_item}</td>
                        <td class="text-center">
                            <a href="javascript:void(0)" id="btn-edit-post" data-id="${response.data.id}" class="btn btn-primary btn-sm">EDIT</a>
                            <a href="javascript:void(0)" id="btn-delete-post" data-id="${response.data.id}" class="btn btn-danger btn-sm">DELETE</a>
                        </td>
                    </tr>
                `;

                $("#table-items").prepend(items);

                $("#item_name").val("");
                $("#type_item").val("");
                $("#total_item").val("");

                $("#modal-create").modal("hide");
            },
            error: function(error) {
                if (error.status === 422) {
                    let errors = error.responseJSON.errors;
                    let errorMessage = '';

                    if (errors.item_name) {
                        errorMessage += `<strong>Item Name:</strong> ${errors.item_name[0]}<br>`;
                    }
                    if (errors.type_item) {
                        errorMessage += `<strong>Type Item:</strong> ${errors.type_item[0]}<br>`;
                    }
                    if (errors.total_item) {
                        errorMessage += `<strong>Total Item:</strong> ${errors.total_item[0]}<br>`;
                    }

                    Swal.fire({
                        title: "Eror prend!",
                        html: errorMessage,
                        icon: "error",
                        confirmButtonText: "OK"
                    });
                } else {
                    Swal.fire({
                        title: "Unexpected Error!",
                        text: "An unexpected error occurred. Please try again later.",
                        icon: "error",
                        confirmButtonText: "OK"
                    });
                }
            }
        });
    });
</script>
