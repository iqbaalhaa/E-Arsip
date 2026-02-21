@extends('layouts.master')

@section('title', 'Lokasi Dokumen - E-Arsip PUPR Jambi')

@section('page-title', 'Lokasi Dokumen')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Lokasi Dokumen</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm" style="border-radius: 20px;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-4">
                        <h4 class="card-title mb-0">Daftar Lokasi</h4>
                        <div class="ml-auto">
                            <button type="button" class="btn btn-primary btn-sm shadow-sm px-3 btn-rounded" data-toggle="modal" data-target="#createLocationModal">
                                <i data-feather="plus" class="feather-icon"></i> Tambah Lokasi
                            </button>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="bg-light">
                                <tr>
                                    <th>Nama Lokasi</th>
                                    <th>Kode</th>
                                    <th>Keterangan</th>
                                    <th style="width: 150px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($locations as $loc)
                                    <tr>
                                        <td class="font-weight-medium">{{ $loc->name }}</td>
                                        <td>{{ $loc->code ?? '-' }}</td>
                                        <td>{{ $loc->description ?? '-' }}</td>
                                        <td>
                                            <div class="btn-actions">
                                                <button type="button" class="btn btn-warning btn-sm shadow-sm px-3 btn-rounded btn-edit-location"
                                                    data-id="{{ $loc->id }}"
                                                    data-name="{{ $loc->name }}"
                                                    data-code="{{ $loc->code }}"
                                                    data-description="{{ $loc->description }}"
                                                    data-update-url="{{ route('locations.update', $loc->id) }}">
                                                    Edit
                                                </button>
                                                <form action="{{ route('locations.destroy', $loc->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm shadow-sm px-3 btn-rounded" onclick="return confirm('Hapus lokasi ini?')">Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted">Belum ada lokasi</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="createLocationModal" tabindex="-1" role="dialog" aria-labelledby="createLocationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createLocationModalLabel">Tambah Lokasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="createLocationForm" action="{{ route('locations.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="create_name">Nama Lokasi</label>
                            <input type="text" class="form-control" id="create_name" name="name" required>
                            <div class="invalid-feedback" id="create_error_name"></div>
                        </div>
                        <div class="form-group">
                            <label for="create_code">Kode</label>
                            <input type="text" class="form-control" id="create_code" name="code">
                            <div class="invalid-feedback" id="create_error_code"></div>
                        </div>
                        <div class="form-group">
                            <label for="create_description">Keterangan</label>
                            <textarea class="form-control" id="create_description" name="description" rows="3"></textarea>
                            <div class="invalid-feedback" id="create_error_description"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary shadow-sm px-3 btn-rounded" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary shadow-sm px-3 btn-rounded">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editLocationModal" tabindex="-1" role="dialog" aria-labelledby="editLocationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editLocationModalLabel">Edit Lokasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editLocationForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input type="hidden" id="edit_id">
                        <div class="form-group">
                            <label for="edit_name">Nama Lokasi</label>
                            <input type="text" class="form-control" id="edit_name" name="name" required>
                            <div class="invalid-feedback" id="edit_error_name"></div>
                        </div>
                        <div class="form-group">
                            <label for="edit_code">Kode</label>
                            <input type="text" class="form-control" id="edit_code" name="code">
                            <div class="invalid-feedback" id="edit_error_code"></div>
                        </div>
                        <div class="form-group">
                            <label for="edit_description">Keterangan</label>
                            <textarea class="form-control" id="edit_description" name="description" rows="3"></textarea>
                            <div class="invalid-feedback" id="edit_error_description"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary shadow-sm px-3 btn-rounded" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary shadow-sm px-3 btn-rounded">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div aria-live="polite" aria-atomic="true" style="position: fixed; top: 20px; right: 20px; min-width: 280px; z-index: 1080;">
        <div class="toast" id="actionToast" data-delay="3000" style="min-width: 280px;">
            <div class="toast-header">
                <i data-feather="check-circle" class="mr-2"></i>
                <strong class="mr-auto">Berhasil</strong>
                <small>Baru saja</small>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body"></div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var createForm = document.getElementById('createLocationForm');
            var editForm = document.getElementById('editLocationForm');
            var editModal = $('#editLocationModal');
            var createModal = $('#createLocationModal');
            function showToast(message) {
                $('#actionToast .toast-body').text(message || 'Aksi berhasil');
                $('#actionToast').toast('show');
            }

            function clearErrors(prefix) {
                ['name','code','description'].forEach(function(field){
                    var input = document.getElementById(prefix + '_' + field);
                    var err = document.getElementById(prefix + '_error_' + field);
                    if (input) { input.classList.remove('is-invalid'); }
                    if (err) { err.textContent = ''; }
                });
            }

            createForm.addEventListener('submit', function (e) {
                e.preventDefault();
                clearErrors('create');
                var formData = new FormData(createForm);
                fetch(createForm.action, {
                    method: 'POST',
                    headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
                    body: formData
                }).then(function (res) {
                    if (res.ok) return res.json();
                    return res.json().then(function (data) { throw data; });
                }).then(function (data) {
                    var tbody = document.querySelector('table tbody');
                    var loc = data.location;
                    var tr = document.createElement('tr');
                    tr.setAttribute('data-row-id', loc.id);
                    tr.innerHTML =
                        '<td class="font-weight-medium">' + (loc.name || '') + '</td>' +
                        '<td>' + (loc.code || '-') + '</td>' +
                        '<td>' + (loc.description || '-') + '</td>' +
                        '<td>' +
                        '<button type="button" class="btn btn-warning btn-sm btn-edit-location" ' +
                        'data-id="' + loc.id + '" ' +
                        'data-name="' + (loc.name || '') + '" ' +
                        'data-code="' + (loc.code || '') + '" ' +
                        'data-description="' + (loc.description || '') + '" ' +
                        'data-update-url="' + data.update_url + '">Edit</button> ' +
                        '<form action="' + data.delete_url + '" method="POST" class="d-inline">' +
                        '<input type="hidden" name="_token" value="{{ csrf_token() }}">' +
                        '<input type="hidden" name="_method" value="DELETE">' +
                        '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Hapus lokasi ini?\')">Hapus</button>' +
                        '</form>' +
                        '</td>';
                    tbody.insertBefore(tr, tbody.firstChild);
                    createForm.reset();
                    createModal.modal('hide');
                    showToast(data.message || 'Lokasi berhasil ditambahkan.');
                }).catch(function (err) {
                    if (err && err.errors) {
                        Object.keys(err.errors).forEach(function (f) {
                            var input = document.getElementById('create_' + f);
                            var msg = document.getElementById('create_error_' + f);
                            if (input) input.classList.add('is-invalid');
                            if (msg) msg.textContent = err.errors[f][0];
                        });
                    }
                });
            });

            document.querySelectorAll('.btn-edit-location').forEach(function (btn) {
                btn.addEventListener('click', function () {
                    clearErrors('edit');
                    document.getElementById('edit_id').value = this.dataset.id;
                    document.getElementById('edit_name').value = this.dataset.name || '';
                    document.getElementById('edit_code').value = this.dataset.code || '';
                    document.getElementById('edit_description').value = this.dataset.description || '';
                    editForm.setAttribute('action', this.dataset.updateUrl);
                    editModal.modal('show');
                });
            });

            editForm.addEventListener('submit', function (e) {
                e.preventDefault();
                clearErrors('edit');
                var formData = new FormData(editForm);
                fetch(editForm.action, {
                    method: 'POST',
                    headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
                    body: formData
                }).then(function (res) {
                    if (res.ok) return res.json();
                    return res.json().then(function (data) { throw data; });
                }).then(function (data) {
                    var loc = data.location;
                    var rows = document.querySelectorAll('table tbody tr');
                    rows.forEach(function (row) {
                        var idCell = row.querySelector('td');
                        var editBtn = row.querySelector('.btn-edit-location');
                        if (editBtn && editBtn.dataset.id == loc.id) {
                            row.children[0].textContent = loc.name || '';
                            row.children[1].textContent = loc.code || '-';
                            row.children[2].textContent = loc.description || '-';
                            editBtn.dataset.name = loc.name || '';
                            editBtn.dataset.code = loc.code || '';
                            editBtn.dataset.description = loc.description || '';
                        }
                    });
                    editModal.modal('hide');
                    showToast(data.message || 'Lokasi berhasil diperbarui.');
                }).catch(function (err) {
                    if (err && err.errors) {
                        Object.keys(err.errors).forEach(function (f) {
                            var input = document.getElementById('edit_' + f);
                            var msg = document.getElementById('edit_error_' + f);
                            if (input) input.classList.add('is-invalid');
                            if (msg) msg.textContent = err.errors[f][0];
                        });
                    }
                });
            });
        });
    </script>
@endsection
