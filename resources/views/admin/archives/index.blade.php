@extends('layouts.master')

@section('title', 'Manajemen Arsip - E-Arsip PUPR Jambi')

@section('page-title', 'Manajemen Arsip')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Manajemen Arsip</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm" style="border-radius: 20px;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-4">
                        <div>
                            <h4 class="card-title text-dark font-weight-bold mb-1">Daftar Arsip</h4>
                            <p class="text-muted font-14 mb-0">Kelola dokumen dan arsip digital.</p>
                        </div>
                        <div class="ml-auto">
                            <a href="{{ route('archives.create') }}" class="btn btn-primary shadow-sm px-4 py-2" style="border-radius: 30px;">
                                <i class="fas fa-plus mr-2"></i> Tambah Arsip
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover v-middle mb-0">
                            <thead class="bg-light">
                                <tr class="border-0">
                                    <th class="border-0 font-14 font-weight-bold text-dark pl-4" style="border-top-left-radius: 15px; border-bottom-left-radius: 15px;">Judul</th>
                                    <th class="border-0 font-14 font-weight-bold text-dark">Kategori</th>
                                    <th class="border-0 font-14 font-weight-bold text-dark">Tahun</th>
                                    <th class="border-0 font-14 font-weight-bold text-dark">Tipe</th>
                                    <th class="border-0 font-14 font-weight-bold text-dark text-center">Status</th>
                                    <th class="border-0 font-14 font-weight-bold text-dark text-center pr-4" style="border-top-right-radius: 15px; border-bottom-right-radius: 15px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($archives as $archive)
                                    <tr>
                                        <td class="pl-4 border-top-0">
                                            <h5 class="text-dark mb-0 font-16 font-weight-bold">{{ $archive->title }}</h5>
                                            <span class="text-muted font-12">{{ $archive->document_date->format('d M Y') }}</span>
                                        </td>
                                        <td class="text-muted font-14 border-top-0">{{ $archive->category }}</td>
                                        <td class="text-muted font-14 border-top-0">{{ $archive->fiscal_year }}</td>
                                        <td class="text-muted font-14 border-top-0">{{ $archive->type }}</td>
                                        <td class="text-center border-top-0">
                                            @if($archive->status == 'aktif')
                                                <span class="badge badge-pill badge-success px-3 py-2 shadow-sm" style="border-radius: 10px;">Aktif</span>
                                            @elseif($archive->status == 'arsip')
                                                <span class="badge badge-pill badge-secondary px-3 py-2 shadow-sm" style="border-radius: 10px;">Arsip</span>
                                            @else
                                                <span class="badge badge-pill badge-danger px-3 py-2 shadow-sm" style="border-radius: 10px;">Rahasia</span>
                                            @endif
                                        </td>
                                        <td class="text-center pr-4 border-top-0">
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('archives.show', $archive->id) }}" class="btn btn-outline-info btn-sm mr-2 shadow-sm d-flex align-items-center justify-content-center" style="width: 35px; height: 35px; border-radius: 50%;" title="Lihat" data-toggle="tooltip">
                                                    <i data-feather="eye" class="feather-icon" style="width: 16px; height: 16px;"></i>
                                                </a>
                                                <a href="{{ route('archives.download', $archive->id) }}" class="btn btn-outline-primary btn-sm mr-2 shadow-sm d-flex align-items-center justify-content-center" style="width: 35px; height: 35px; border-radius: 50%;" title="Download" data-toggle="tooltip">
                                                    <i data-feather="download" class="feather-icon" style="width: 16px; height: 16px;"></i>
                                                </a>
                                                <a href="{{ route('archives.edit', $archive->id) }}" class="btn btn-outline-warning btn-sm mr-2 shadow-sm d-flex align-items-center justify-content-center" style="width: 35px; height: 35px; border-radius: 50%;" title="Edit" data-toggle="tooltip">
                                                    <i data-feather="edit-2" class="feather-icon" style="width: 16px; height: 16px;"></i>
                                                </a>
                                                <form action="{{ route('archives.destroy', $archive->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus arsip ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger btn-sm shadow-sm d-flex align-items-center justify-content-center" style="width: 35px; height: 35px; border-radius: 50%;" title="Hapus" data-toggle="tooltip">
                                                        <i data-feather="trash-2" class="feather-icon" style="width: 16px; height: 16px;"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
