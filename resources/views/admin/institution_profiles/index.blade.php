@extends('layouts.master')

@section('title', 'Profil Instansi - E-Arsip PUPR Jambi')

@section('page-title', 'Profil Instansi')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Profil Instansi</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-4">
                        <h4 class="card-title">Daftar Profil Instansi</h4>
                        <div class="ml-auto">
                            <a href="{{ route('institution-profiles.create') }}" class="btn btn-primary btn-sm">
                                <i data-feather="plus" class="feather-icon"></i> Tambah Profil
                            </a>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table no-wrap v-middle mb-0">
                            <thead>
                                <tr class="border-0">
                                    <th class="border-0 font-14 font-weight-medium text-muted">Logo</th>
                                    <th class="border-0 font-14 font-weight-medium text-muted">Nama Instansi</th>
                                    <th class="border-0 font-14 font-weight-medium text-muted">Bidang / Unit</th>
                                    <th class="border-0 font-14 font-weight-medium text-muted">Kontak</th>
                                    <th class="border-0 font-14 font-weight-medium text-muted">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($profiles as $profile)
                                    <tr>
                                        <td class="border-top-0 px-2 py-4">
                                            @if ($profile->logo)
                                                <img src="{{ asset('storage/' . $profile->logo) }}" alt="Logo"
                                                    class="rounded-circle" width="45" height="45">
                                            @else
                                                <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center text-white"
                                                    style="width: 45px; height: 45px;">
                                                    {{ substr($profile->name, 0, 1) }}
                                                </div>
                                            @endif
                                        </td>
                                        <td class="border-top-0 text-muted px-2 py-4 font-14">{{ $profile->name }}</td>
                                        <td class="border-top-0 text-muted px-2 py-4 font-14">{{ $profile->field }}</td>
                                        <td class="border-top-0 text-muted px-2 py-4 font-14">{{ $profile->contact }}</td>
                                        <td class="border-top-0 text-center px-2 py-4 font-14">
                                            <a href="{{ route('institution-profiles.edit', $profile->id) }}"
                                                class="btn btn-warning btn-circle btn-sm" data-toggle="tooltip"
                                                data-placement="top" title="Edit">
                                                <i data-feather="edit-2" class="feather-icon"></i>
                                            </a>
                                            <form action="{{ route('institution-profiles.destroy', $profile->id) }}"
                                                method="POST" class="d-inline"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-circle btn-sm"
                                                    data-toggle="tooltip" data-placement="top" title="Hapus">
                                                    <i data-feather="trash-2" class="feather-icon"></i>
                                                </button>
                                            </form>
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

@section('scripts')
    <script>
        feather.replace();
    </script>
@endsection
