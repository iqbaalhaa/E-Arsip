@extends('layouts.master')

@section('title', 'Dashboard Pegawai - E-Arsip PUPR Jambi')

@section('page-title', 'Selamat Datang Pegawai!')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/pegawai/dashboard') }}">Dashboard Pegawai</a></li>
@endsection

@section('content')
    <div class="card-group">
        <div class="card border-right">
            <div class="card-body">
                <div class="d-flex d-lg-flex d-md-block align-items-center">
                    <div>
                        <div class="d-inline-flex align-items-center">
                            <h2 class="text-dark mb-1 font-weight-medium">Pegawai Area</h2>
                        </div>
                        <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Restricted Access</h6>
                    </div>
                    <div class="ml-auto mt-md-3 mt-lg-0">
                        <span class="opacity-7 text-muted"><i data-feather="user"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Halaman Khusus Pegawai</h4>
                    <p>Anda login sebagai Pegawai. Silahkan kelola arsip Anda.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
