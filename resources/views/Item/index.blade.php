@extends('layouts.app')

@section('title', 'Data Item')
<link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.dataTables.css" />
<script src="https://cdn.datatables.net/2.2.1/js/dataTables.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.dataTables.css">
<script src="https://cdn.datatables.net/2.2.1/js/dataTables.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">

@section('content')
    <div class="container" style="margin-top: 50px">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded-md mt-4">
                    <div class="card-body">
                        <a href="javascript:void(0)" class="btn btn-success mb-2" id="btn-create-post">Create Item</a>
                        <table id="data" class="table table-bordered table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Name Item</th>
                                    <th>Type Item</th>
                                    <th>Stock Item</th>
                                    <th>Color Item</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Name Item</th>
                                    <th>Type Item</th>
                                    <th>Stock Item</th>
                                    <th>Color Item</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @include('components.modal-create')
        @include('components.modal-edit')
        @include('components.modal-destroy')
        <script>
            let table = new DataTable('#data', {
                ajax: '/item', 
                columns: [{
                        data: 'item_name',
                    },
                    {
                        data: 'type_item', 
                        orderable: false
                    },
                    {
                        data: 'total_item',
                    },
                    {
                        data: 'color_item', 
                        orderable: false
                    },
                    {
                        data: 'id',
                        render: function(data, type, row) {
                           
                            return `
                    <a href="javascript:void(0)" id="btn-edit-item" data-id="${data}" class="btn btn-primary btn-sm">EDIT</a>
                    <a href="javascript:void(0)" id="btn-delete-item" data-id="${data}" class="btn btn-danger btn-sm">DELETE</a>
                `;
                        }
                    }
                ]
            });

            setInterval(function() {
                table.ajax.reload(null, false); 
            }, 2000);
        </script>
    </div>
@endsection
