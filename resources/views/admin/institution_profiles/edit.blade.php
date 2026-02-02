@extends('layouts.master')

@section('title', 'Edit Profil Instansi - E-Arsip PUPR Jambi')

@section('page-title', 'Edit Profil Instansi')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('institution-profiles.index') }}">Profil Instansi</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Form Edit Profil Instansi</h4>
                    <form action="{{ route('institution-profiles.update', $institutionProfile->id) }}" method="POST" enctype="multipart/form-data" class="mt-4">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Nama Instansi</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $institutionProfile->name) }}" placeholder="Masukkan Nama Instansi" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="address">Alamat</label>
                            <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="3" placeholder="Masukkan Alamat" required>{{ old('address', $institutionProfile->address) }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="field">Bidang / Unit Kerja</label>
                            <input type="text" class="form-control @error('field') is-invalid @enderror" id="field" name="field" value="{{ old('field', $institutionProfile->field) }}" placeholder="Masukkan Bidang / Unit Kerja" required>
                            @error('field')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="contact">Kontak Resmi</label>
                            <input type="text" class="form-control @error('contact') is-invalid @enderror" id="contact" name="contact" value="{{ old('contact', $institutionProfile->contact) }}" placeholder="Masukkan Kontak Resmi (Telp/Email)" required>
                            @error('contact')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="logo">Logo Instansi</label>
                            @if($institutionProfile->logo)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $institutionProfile->logo) }}" alt="Logo Saat Ini" class="img-thumbnail" style="max-width: 150px;">
                                </div>
                            @endif
                            <input type="file" class="form-control-file @error('logo') is-invalid @enderror" id="logo" name="logo">
                            <small class="form-text text-muted">Biarkan kosong jika tidak ingin mengubah logo. Format: jpg, jpeg, png. Maksimal 2MB.</small>
                            @error('logo')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-actions mt-4">
                            <button type="submit" class="btn btn-primary"> <i data-feather="save" class="feather-icon"></i> Update</button>
                            <a href="{{ route('institution-profiles.index') }}" class="btn btn-dark">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
