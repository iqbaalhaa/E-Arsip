@extends('layouts.master')

@section('title', 'Dashboard Admin - E-Arsip PUPR Jambi')

@section('page-title', 'Selamat Datang Admin!')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Dashboard Admin</a></li>
@endsection

@section('content')
    <div class="card-group">
        <div class="card border-right">
            <div class="card-body">
                <div class="d-flex d-lg-flex d-md-block align-items-center">
                    <div>
                        <div class="d-inline-flex align-items-center">
                            <h2 class="text-dark mb-1 font-weight-medium">Admin Area</h2>
                        </div>
                        <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Full Access</h6>
                    </div>
                    <div class="ml-auto mt-md-3 mt-lg-0">
                        <span class="opacity-7 text-muted"><i data-feather="shield"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Halaman Khusus Admin</h4>
                    <p>Anda login sebagai Admin. Anda memiliki akses penuh ke sistem.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
