@extends('layouts.master')

@section('title', 'Dashboard Pegawai - E-Arsip PUPR Jambi')

@section('page-title', 'Selamat Datang Pegawai!')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/pegawai/dashboard') }}">Dashboard Pegawai</a></li>
@endsection

@section('content')
    <div class="row mb-4">
        <div class="col-md-4 col-sm-12 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div>
                            <h2 class="text-dark mb-1 font-weight-medium">{{ $totalArsip }}</h2>
                            <h6 class="text-muted font-weight-normal mb-0">Total Arsip</h6>
                        </div>
                        <div class="ml-auto">
                            <div class="bg-primary-lighten p-3 rounded-circle">
                                <i data-feather="file-text" class="text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-12 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div>
                            <h2 class="text-dark mb-1 font-weight-medium">{{ $totalKategori }}</h2>
                            <h6 class="text-muted font-weight-normal mb-0">Total Kategori</h6>
                        </div>
                        <div class="ml-auto">
                            <div class="bg-success-lighten p-3 rounded-circle">
                                <i data-feather="grid" class="text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-12 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div>
                            <h2 class="text-dark mb-1 font-weight-medium">{{ $totalInstansi }}</h2>
                            <h6 class="text-muted font-weight-normal mb-0">Total Instansi</h6>
                        </div>
                        <div class="ml-auto">
                            <div class="bg-warning-lighten p-3 rounded-circle">
                                <i data-feather="home" class="text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h4 class="card-title mb-4">Arsip yang Baru Diunggah</h4>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="thead-light">
                                <tr>
                                    <th>Judul Dokumen</th>
                                    <th>Kategori</th>
                                    <th class="text-center">Tahun</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($arsipTerbaru as $arsip)
                                    <tr>
                                        <td>
                                            <h5 class="text-dark mb-0 font-16 font-weight-medium">
                                                {{ Str::limit($arsip->title, 40) }}</h5>
                                            <small
                                                class="text-muted">{{ \Carbon\Carbon::parse($arsip->document_date)->format('d M Y') }}</small>
                                        </td>
                                        <td><span class="badge bg-light text-primary">{{ $arsip->category }}</span></td>
                                        <td class="text-center">{{ $arsip->fiscal_year }}</td>
                                        <td>
                                            <a href="{{ url('archives/' . $arsip->id) }}"
                                                class="btn btn-sm btn-circle btn-outline-primary">
                                                <i data-feather="eye" style="width: 14px"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-4">Belum ada data arsip.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="col-lg-4">
            <div class="card shadow-sm border-0 bg-primary text-white p-2">
                <div class="card-body">
                    <h4 class="text-white">Quick Action</h4>
                    <p class="small opacity-7">Gunakan fitur laporan untuk melihat statistik lengkap bulanan dan tahunan.
                    </p>
                    <div class="d-grid mt-4">
                        <a href="{{ url('view-report') }}" class="btn btn-light text-primary font-weight-medium">
                            <i data-feather="bar-chart-2" class="mr-2"></i> Lihat Laporan
                        </a>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
@endsection
