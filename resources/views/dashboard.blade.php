@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9">
                <h3>Selamat Datang Prendd!!</h3>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card text-center">
                            <div class="card-header bg-primary text-white">
                                <i class="fas fa-chart-bar"></i> Total Jenis Barang
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
