@extends('layouts.master')

@section('title', 'Tambah Kategori - E-Arsip PUPR Jambi')

@section('page-title', 'Tambah Kategori')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Kategori Arsip</a></li>
    <li class="breadcrumb-item active">Tambah Kategori</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm" style="border-radius: 20px;">
                <div class="card-body p-4">
                    <h4 class="card-title mb-4 font-weight-bold">Form Tambah Kategori</h4>
                    <form action="{{ route('categories.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nama Kategori</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">Keterangan</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary px-4 py-2" style="border-radius: 30px;">
                                <i class="fas fa-save mr-2"></i> Simpan
                            </button>
                            <a href="{{ route('categories.index') }}" class="btn btn-secondary px-4 py-2" style="border-radius: 30px;">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
