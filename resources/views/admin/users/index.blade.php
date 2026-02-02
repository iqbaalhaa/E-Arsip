@extends('layouts.master')

@section('title', 'Manajemen User - E-Arsip PUPR Jambi')

@section('page-title', 'Manajemen User')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Manajemen User</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm" style="border-radius: 20px;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-4">
                        <div>
                            <h4 class="card-title text-dark font-weight-bold mb-1">Daftar User</h4>
                            <p class="text-muted font-14 mb-0">Kelola data pengguna sistem E-Arsip dengan mudah.</p>
                        </div>
                        <div class="ml-auto">
                            <a href="{{ route('users.create') }}" class="btn btn-primary shadow-sm px-4 py-2" style="border-radius: 30px;">
                                <i class="fas fa-plus mr-2"></i> Tambah User
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover v-middle mb-0">
                            <thead class="bg-light">
                                <tr class="border-0">
                                    <th class="border-0 font-14 font-weight-bold text-dark pl-4" style="border-top-left-radius: 15px; border-bottom-left-radius: 15px;">User</th>
                                    <th class="border-0 font-14 font-weight-bold text-dark">Email</th>
                                    <th class="border-0 font-14 font-weight-bold text-dark text-center">Role</th>
                                    <th class="border-0 font-14 font-weight-bold text-dark text-center">Status</th>
                                    <th class="border-0 font-14 font-weight-bold text-dark text-center pr-4" style="border-top-right-radius: 15px; border-bottom-right-radius: 15px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="pl-4 border-top-0">
                                            <div class="d-flex no-block align-items-center">
                                                <div class="mr-3">
                                                    <div class="btn-circle btn-light-info text-info d-flex align-items-center justify-content-center font-weight-bold shadow-sm" style="width: 45px; height: 45px; border-radius: 50%; background-color: #eef5f9;">
                                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                                    </div>
                                                </div>
                                                <div>
                                                    <h5 class="text-dark mb-0 font-16 font-weight-bold">{{ $user->name }}</h5>
                                                    <span class="text-muted font-12">Bergabung {{ $user->created_at->format('d M Y') }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-muted font-14 border-top-0">{{ $user->email }}</td>
                                        <td class="text-center border-top-0">
                                            @if($user->role == 'admin')
                                                <span class="badge badge-pill badge-primary px-3 py-2 shadow-sm" style="border-radius: 10px;">Admin</span>
                                            @else
                                                <span class="badge badge-pill badge-secondary px-3 py-2 shadow-sm" style="border-radius: 10px;">Pegawai</span>
                                            @endif
                                        </td>
                                        <td class="text-center border-top-0">
                                            @if($user->is_active)
                                                <span class="badge badge-pill badge-primary px-3 py-2 shadow-sm" style="border-radius: 10px;">
                                                    <i class="fas fa-check-circle mr-1"></i> Aktif
                                                </span>
                                            @else
                                                <span class="badge badge-pill badge-secondary px-3 py-2 shadow-sm" style="border-radius: 10px;">
                                                    <i class="fas fa-times-circle mr-1"></i> Nonaktif
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-center pr-4 border-top-0">
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-outline-warning btn-sm mr-2 shadow-sm d-flex align-items-center justify-content-center" style="width: 35px; height: 35px; border-radius: 50%;" title="Edit" data-toggle="tooltip">
                                                    <i data-feather="edit-2" class="feather-icon" style="width: 16px; height: 16px;"></i>
                                                </a>
                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
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
