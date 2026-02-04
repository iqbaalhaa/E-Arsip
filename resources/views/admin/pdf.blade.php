<!DOCTYPE html>
<html>

<head>
    <title>Laporan Arsip PUPR</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            margin: 0;
            padding: 0;
        }

        /* Layout Kop Surat */
        .header-container {
            position: relative;
            border-bottom: 3px double #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
            text-align: center;
        }

        .logo-container {
            position: absolute;
            top: 0;
            left: 0;
        }

        .logo-container img {
            width: 70px;
            /* Ukuran Logo PUPR */
        }

        .text-container {
            margin-left: 80px;
            /* Agar teks tidak menimpa logo */
            margin-right: 20px;
        }

        .text-container h1 {
            font-size: 14px;
            margin: 0;
            font-weight: normal;
        }

        .text-container h2 {
            font-size: 16px;
            margin: 2px 0;
            font-weight: bold;
        }

        .text-container p {
            font-size: 10px;
            margin: 1px 0;
        }

        /* Tabel Data */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .text-center {
            text-align: center;
        }

        /* Tanda Tangan */
        .ttd-section {
            margin-top: 30px;
            float: right;
            width: 200px;
            text-align: center;
        }

        .spacer {
            height: 60px;
        }
    </style>
</head>

<body>

    <div class="header-container">
        <div class="logo-container">
            <img src="{{ public_path('template/assets/images/logo.png') }}">
        </div>
        <div class="text-container">
            <h1>KEMENTERIAN PEKERJAAN UMUM DAN PERUMAHAN RAKYAT</h1>
            <h2>DINAS PEKERJAAN UMUM DAN PERUMAHAN RAKYAT</h2>
            <h2>PROVINSI JAMBI</h2>
            <p>Jl. H. Zainir Haviz No.4, Paal Lima, Kec. Kota Baru, Kota Jambi, Jambi 36129</p>
            {{-- <p>Telepon: (0741) XXXXX | Email: info@puprjambi.go.id</p> --}}
        </div>
    </div>

    <h3 class="text-center">LAPORAN DATA ARSIP</h3>
    <p class="text-center">Periode: {{ date('d-m-Y', strtotime($start)) ?? 'Semua' }} s/d
        {{ date('d-m-Y', strtotime($end)) ?? 'Semua' }}</p>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th>Tanggal</th>
                <th>Judul Dokumen</th>
                <th>Kategori</th>
                {{-- <th>Tahun</th> --}}
                <th>Nama Instansi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($archives as $index => $item)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ date('d-m-Y', strtotime($item->document_date)) }}</td>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->category }}</td>
                    <td>{{ $item->nama_instansi }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- <div class="ttd-section">
        <p>Jambi, {{ date('d F Y') }}</p>
        <p>Kepala Dinas,</p>
        <div class="spacer"></div>
        <p><strong>( ________________ )</strong></p>
        <p>NIP. ............................</p>
    </div> --}}

</body>

</html>
