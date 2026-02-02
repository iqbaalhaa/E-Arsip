@extends('layouts.master')

@section('title', 'Tambah Arsip - E-Arsip PUPR Jambi')

@section('page-title', 'Tambah Arsip')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('archives.index') }}">Manajemen Arsip</a></li>
    <li class="breadcrumb-item active">Tambah Arsip</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm" style="border-radius: 20px;">
                <div class="card-body p-4">
                    <h4 class="card-title mb-4 font-weight-bold">Form Tambah Arsip</h4>
                    <form action="{{ route('archives.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title">Judul Dokumen</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="category">Kategori Dokumen</label>
                                    <select class="form-control @error('category') is-invalid @enderror" id="category" name="category" required>
                                        <option value="">Pilih Kategori</option>
                                        @foreach($categories as $categoryItem)
                                            <option value="{{ $categoryItem->name }}" {{ old('category') == $categoryItem->name ? 'selected' : '' }}>{{ $categoryItem->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="document_date">Tanggal Dokumen</label>
                                    <input type="date" class="form-control @error('document_date') is-invalid @enderror" id="document_date" name="document_date" value="{{ old('document_date') }}" required>
                                    @error('document_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fiscal_year">Tahun Anggaran</label>
                                    <input type="number" class="form-control @error('fiscal_year') is-invalid @enderror" id="fiscal_year" name="fiscal_year" value="{{ old('fiscal_year') }}" required>
                                    @error('fiscal_year')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="type">Jenis Dokumen</label>
                                    <select class="form-control @error('type') is-invalid @enderror" id="type" name="type" required>
                                        <option value="">Pilih Jenis</option>
                                        <option value="Laporan" {{ old('type') == 'Laporan' ? 'selected' : '' }}>Laporan</option>
                                        <option value="Gambar Teknis" {{ old('type') == 'Gambar Teknis' ? 'selected' : '' }}>Gambar Teknis</option>
                                        <option value="Surat" {{ old('type') == 'Surat' ? 'selected' : '' }}>Surat</option>
                                    </select>
                                    @error('type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status">Status Dokumen</label>
                                    <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                                        <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                        <option value="arsip" {{ old('status') == 'arsip' ? 'selected' : '' }}>Arsip</option>
                                        <option value="rahasia" {{ old('status') == 'rahasia' ? 'selected' : '' }}>Rahasia</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="file_path">File Dokumen (PDF, Max 10MB)</label>
                            <input type="file" class="form-control-file @error('file_path') is-invalid @enderror" id="file_path" name="file_path" accept=".pdf" required>
                            @error('file_path')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
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
                            <a href="{{ route('archives.index') }}" class="btn btn-secondary px-4 py-2" style="border-radius: 30px;">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
