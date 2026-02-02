@extends('layouts.master')

@section('title', 'Kategori Arsip - E-Arsip PUPR Jambi')

@section('page-title', 'Kategori Arsip')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Kategori Arsip</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm" style="border-radius: 20px;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-4">
                        <div>
                            <h4 class="card-title text-dark font-weight-bold mb-1">Daftar Kategori</h4>
                            <p class="text-muted font-14 mb-0">Kelola kategori arsip.</p>
                        </div>
                        <div class="ml-auto">
                            <a href="{{ route('categories.create') }}" class="btn btn-primary shadow-sm px-4 py-2" style="border-radius: 30px;">
                                <i class="fas fa-plus mr-2"></i> Tambah Kategori
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover v-middle mb-0">
                            <thead class="bg-light">
                                <tr class="border-0">
                                    <th class="border-0 font-14 font-weight-bold text-dark pl-4" style="border-top-left-radius: 15px; border-bottom-left-radius: 15px;">Nama Kategori</th>
                                    <th class="border-0 font-14 font-weight-bold text-dark">Keterangan</th>
                                    <th class="border-0 font-14 font-weight-bold text-dark text-center pr-4" style="border-top-right-radius: 15px; border-bottom-right-radius: 15px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td class="pl-4 border-top-0">
                                            <h5 class="text-dark mb-0 font-16 font-weight-bold">{{ $category->name }}</h5>
                                        </td>
                                        <td class="text-muted font-14 border-top-0">{{ $category->description ?? '-' }}</td>
                                        <td class="text-center pr-4 border-top-0">
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-outline-warning btn-sm mr-2 shadow-sm d-flex align-items-center justify-content-center" style="width: 35px; height: 35px; border-radius: 50%;" title="Edit" data-toggle="tooltip">
                                                    <i data-feather="edit-2" class="feather-icon" style="width: 16px; height: 16px;"></i>
                                                </a>
                                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
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
