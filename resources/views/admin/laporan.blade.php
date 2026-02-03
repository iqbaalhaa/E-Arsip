@extends('layouts.master')

@section('title', 'Laporan - E-Arsip ' . ($profile->name ?? 'PUPR Jambi'))

@section('content')
    <div class="container-fluid">
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <form action="{{ url('pdf') }}" method="post" class="row align-items-end">
                    @csrf
                    <div class="col-md-3">
                        <label class="form-label font-weight-bold">Tanggal Awal</label>
                        <input type="date" name="tanggal_awal" class="form-control" value="{{ request('tanggal_awal') }}"
                            required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label font-weight-bold">Tanggal Akhir</label>
                        <input type="date" name="tanggal_akhir" class="form-control"
                            value="{{ request('tanggal_akhir') }}" required>
                    </div>
                    <div class="col-md-6 mt-3 mt-md-0">
                        <button type="submit" name="action" value="pdf" class="btn btn-danger">
                            <i class="fas fa-file-pdf mr-1"></i> Cetak PDF
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card bg-primary text-white p-3 shadow-sm border-0">
                    <small class="opacity-7 text-uppercase">Total Seluruh Arsip</small>
                    <h2 class="font-weight-bold">{{ $stats['total_arsip'] }}</h2>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-success text-white p-3 shadow-sm border-0">
                    <small class="opacity-7 text-uppercase">Arsip Tahun {{ $currentYear }}</small>
                    <h2 class="font-weight-bold">{{ $stats['tahun_ini'] }}</h2>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-info text-white p-3 shadow-sm border-0">
                    <small class="opacity-7 text-uppercase">Total Kategori</small>
                    <h2 class="font-weight-bold">{{ $stats['total_kategori'] }}</h2>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-dark text-white p-3 shadow-sm border-0">
                    <small class="opacity-7 text-uppercase">Total Instansi</small>
                    <h2 class="font-weight-bold">{{ $instansiData->count() }}</h2>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Tren Masuknya Arsip Bulanan (Tahun
                            {{ $currentYear }})</h6>
                    </div>
                    <div class="card-body">
                        <canvas id="monthlyChart" height="280"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Klasifikasi Tipe Arsip</h6>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            @foreach ($typeData as $t)
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    {{ $t->type ?? 'Tidak Berlabel' }}
                                    <span class="badge bg-primary rounded-pill text-white">{{ $t->total }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Data Distribusi Arsip Per Instansi</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="bg-light">
                                    <tr>
                                        <th>Nama Instansi</th>
                                        <th>Jumlah Arsip</th>
                                        {{-- <th>Persentase</th> --}}
                                        {{-- <th>Status Kelengkapan</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($instansiData as $d)
                                        <tr>
                                            <td class="font-weight-medium">{{ $d->name }}</td>
                                            <td>{{ $d->total }} Dokumen</td>
                                            {{-- <td>
                                                @php $persen = $stats['total_arsip'] > 0 ? ($d->total / $stats['total_arsip']) * 100 : 0; @endphp
                                                <div class="progress" style="height: 10px;">
                                                    <div class="progress-bar" role="progressbar"
                                                        style="width: {{ $persen }}%"></div>
                                                </div>
                                                <small>{{ number_format($persen, 1) }}% dari total arsip</small>
                                            </td> --}}
                                            {{-- <td><span class="badge bg-success text-white">Terverifikasi</span></td> --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('monthlyChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [{
                    label: 'Arsip Masuk',
                    data: @json($chartData),
                    borderColor: '#4e73df',
                    backgroundColor: 'rgba(78, 115, 223, 0.1)',
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    </script>
@endsection
