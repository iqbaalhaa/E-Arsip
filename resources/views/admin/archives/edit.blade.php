@extends('layouts.master')

@section('title', 'Edit Arsip - E-Arsip PUPR Jambi')

@section('page-title', 'Edit Arsip')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('archives.index') }}">Manajemen Arsip</a></li>
    <li class="breadcrumb-item active">Edit Arsip</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm" style="border-radius: 20px;">
                <div class="card-body p-4">
                    <h4 class="card-title mb-4 font-weight-bold">Form Edit Arsip</h4>
                    <form action="{{ route('archives.update', $archive->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title">Isi Dokumen</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $archive->title) }}" required>
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
                                            <option value="{{ $categoryItem->name }}" {{ old('category', $archive->category) == $categoryItem->name ? 'selected' : '' }}>{{ $categoryItem->name }}</option>
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
                                    <label for="nomor_surat">No Surat/Kode</label>
                                    <input type="text" class="form-control @error('nomor_surat') is-invalid @enderror" id="nomor_surat" name="nomor_surat" value="{{ old('nomor_surat', $archive->nomor_surat) }}">
                                    @error('nomor_surat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="document_date">Tanggal Dokumen</label>
                                    <input type="date" class="form-control @error('document_date') is-invalid @enderror" id="document_date" name="document_date" value="{{ old('document_date', $archive->document_date->format('Y-m-d')) }}" required>
                                    @error('document_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fiscal_year">Tahun</label>
                                    <input type="number" class="form-control @error('fiscal_year') is-invalid @enderror" id="fiscal_year" name="fiscal_year" value="{{ old('fiscal_year', $archive->fiscal_year) }}" required>
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
                                        <option value="Laporan" {{ old('type', $archive->type) == 'Laporan' ? 'selected' : '' }}>Laporan</option>
                                        <option value="Gambar Teknis" {{ old('type', $archive->type) == 'Gambar Teknis' ? 'selected' : '' }}>Gambar Teknis</option>
                                        <option value="Surat" {{ old('type', $archive->type) == 'Surat' ? 'selected' : '' }}>Surat</option>
                                    </select>
                                    @error('type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status">Tingkat Perkembangan</label>
                                    <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                                        <option value="aktif" {{ old('status', $archive->status) == 'aktif' ? 'selected' : '' }}>Asli</option>
                                        <option value="arsip" {{ old('status', $archive->status) == 'arsip' ? 'selected' : '' }}>Copy</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="location_id">Tempat Penyimpanan</label>
                                    <select class="form-control @error('location_id') is-invalid @enderror" id="location_id" name="location_id" required>
                                        <option value="">Pilih Tempat Penyimpanan</option>
                                        @foreach($locations as $loc)
                                            <option value="{{ $loc->id }}" {{ old('location_id', $archive->location_id) == $loc->id ? 'selected' : '' }}>
                                                {{ $loc->name }}{{ $loc->code ? ' - '.$loc->code : '' }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('location_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="file_path">File Dokumen (PDF, Max 10MB)</label>
                            <small class="d-block text-muted mb-2">Biarkan kosong jika tidak ingin mengubah file.</small>
                            <input type="file" class="form-control-file @error('file_path') is-invalid @enderror" id="file_path" name="file_path" accept=".pdf">
                            @error('file_path')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">Keterangan</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description', $archive->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary px-4 py-2" style="border-radius: 30px;">
                                <i class="fas fa-save mr-2"></i> Update
                            </button>
                            <a href="{{ route('archives.index') }}" class="btn btn-secondary px-4 py-2" style="border-radius: 30px;">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
