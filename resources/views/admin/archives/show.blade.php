@extends('layouts.master')

@section('title', 'Detail Arsip - E-Arsip PUPR Jambi')

@section('page-title', 'Detail Arsip')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('archives.index') }}">Manajemen Arsip</a></li>
    <li class="breadcrumb-item active">Detail Arsip</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm" style="border-radius: 20px;">
                <div class="card-body p-4">
                    <h4 class="card-title mb-4 font-weight-bold">Informasi Dokumen</h4>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item px-0">
                            <small class="text-muted">Judul Dokumen</small>
                            <h6 class="mb-0 font-weight-bold">{{ $archive->title }}</h6>
                        </li>
                        <li class="list-group-item px-0">
                            <small class="text-muted">Kategori</small>
                            <h6 class="mb-0">{{ $archive->category }}</h6>
                        </li>
                        <li class="list-group-item px-0">
                            <small class="text-muted">Tanggal Dokumen</small>
                            <h6 class="mb-0">{{ $archive->document_date->format('d M Y') }}</h6>
                        </li>
                        <li class="list-group-item px-0">
                            <small class="text-muted">Tahun Anggaran</small>
                            <h6 class="mb-0">{{ $archive->fiscal_year }}</h6>
                        </li>
                        <li class="list-group-item px-0">
                            <small class="text-muted">Jenis Dokumen</small>
                            <h6 class="mb-0">{{ $archive->type }}</h6>
                        </li>
                        <li class="list-group-item px-0">
                            <small class="text-muted">Status</small>
                            <div class="mt-1">
                                @if($archive->status == 'aktif')
                                    <span class="badge badge-pill badge-success px-3 py-2">Aktif</span>
                                @elseif($archive->status == 'arsip')
                                    <span class="badge badge-pill badge-secondary px-3 py-2">Arsip</span>
                                @else
                                    <span class="badge badge-pill badge-danger px-3 py-2">Rahasia</span>
                                @endif
                            </div>
                        </li>
                        <li class="list-group-item px-0">
                            <small class="text-muted">Diunggah Oleh</small>
                            <h6 class="mb-0">{{ $archive->user->name ?? 'Unknown' }}</h6>
                        </li>
                        <li class="list-group-item px-0">
                            <small class="text-muted">Keterangan</small>
                            <p class="mb-0">{{ $archive->description ?? '-' }}</p>
                        </li>
                    </ul>
                    <div class="mt-4">
                        <a href="{{ route('archives.download', $archive->id) }}" class="btn btn-primary btn-block shadow-sm" style="border-radius: 30px;">
                            <i class="fas fa-download mr-2"></i> Download
                        </a>
                        <a href="{{ route('archives.edit', $archive->id) }}" class="btn btn-warning btn-block shadow-sm mt-2" style="border-radius: 30px;">
                            <i class="fas fa-edit mr-2"></i> Edit
                        </a>
                        <a href="{{ route('archives.index') }}" class="btn btn-secondary btn-block shadow-sm mt-2" style="border-radius: 30px;">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card border-0 shadow-sm" style="border-radius: 20px;">
                <div class="card-body p-4">
                    <h4 class="card-title mb-4 font-weight-bold">Preview Dokumen</h4>
                    <div class="embed-responsive embed-responsive-16by9" style="height: 600px;">
                        <iframe class="embed-responsive-item" src="{{ route('archives.preview', $archive->id) }}" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
