@extends('layouts.app')

@section('title', 'Dashboard')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card text-center">
                            <div class="card-header bg-primary text-white">
                                <i class='bx bx-wallet icon' ></i> Total Jenis Barang
                            </div>
                            <div class="card-body">
                                <p>Total Items: {{ \App\Models\Item::count() }}</p>
                                <button class="btn btn-primary">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
