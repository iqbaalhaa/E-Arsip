<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use App\Models\Category;
use App\Models\InstitutionProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\File;

use Barryvdh\DomPDF\Facade\Pdf;

class ArchiveController extends Controller
{
    public function index(Request $request)
    {
        // $archives = Archive::with('instantion')->latest()->get();

        $query = Archive::with('instantion');

    // Filter Pencarian Judul
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Filter Kategori
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Mengambil data dengan pagination (10 data per halaman)
        $archives = $query->latest()->paginate(10);
        
        // Ambil data kategori untuk isi dropdown
        $categories = \DB::table('categories')->get();

        return view('admin.archives.index', compact('archives', 'categories'));

        // return view('admin.archives.index', compact('archives'));
    }

    public function create()
    {
        $categories = Category::all();
        $institutions = InstitutionProfile::all();

        return view('admin.archives.create', compact('categories', 'institutions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'document_date' => 'required|date',
            'fiscal_year' => 'required|string|max:4',
            'type' => 'required|in:Laporan,Gambar Teknis,Surat',
            'file_path' => 'required|file|mimes:pdf|max:10240',
            'status' => 'required|in:aktif,arsip,rahasia',
            'description' => 'nullable|string',
            'institution_profile_id' => 'required'
        ]);

        if ($request->hasFile('file_path')) {
            $file = $request->file('file_path');
        
            // Membuat nama file unik: Tahun_NamaAsli atau Timestamp_NamaAsli
            $fileName = time() . '_' . $file->getClientOriginalName();
            
            // Memindahkan file ke folder public/File
            $file->move(public_path('File'), $fileName);
            
            // Menyimpan path relatif ke database
            $validated['file_path'] =  $fileName;
        }

        $validated['user_id'] = auth()->id();

        Archive::create($validated);

        return redirect()->route('archives.index')->with('success', 'Arsip berhasil ditambahkan.');
    }

    public function show(Archive $archive)
    {
        return view('admin.archives.show', compact('archive'));
    }

    public function edit(Archive $archive)
    {
        $categories = Category::all();
        return view('admin.archives.edit', compact('archive', 'categories'));
    }

    public function update(Request $request, Archive $archive)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'document_date' => 'required|date',
            'fiscal_year' => 'required|string|max:4',
            'type' => 'required|in:Laporan,Gambar Teknis,Surat',
            'file_path' => 'nullable|file|mimes:pdf|max:10240',
            'status' => 'required|in:aktif,arsip,rahasia',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('file_path')) {
            // 1. Hapus file lama dari folder public/File jika ada
            if ($archive->file_path) {
                $oldPath = public_path('File/' . $archive->file_path);
                if (File::exists($oldPath)) {
                    File::delete($oldPath);
                }
            }

            // 2. Proses upload file baru
            $file = $request->file('file_path');
            $fileName = time() . '_' . $file->getClientOriginalName();
            
            // Pindahkan ke folder public/File
            $file->move(public_path('File'), $fileName);
            
            // Simpan hanya nama filenya saja ke array validated
            $validated['file_path'] = $fileName;
        }

        $archive->update($validated);

        return redirect()->route('archives.index')->with('success', 'Arsip berhasil diperbarui.');
    }

    public function destroy(Archive $archive)
    {
        if ($archive->file_path) {
            Storage::disk('public')->delete($archive->file_path);
        }
        $archive->delete();

        return redirect()->route('archives.index')->with('success', 'Arsip berhasil dihapus.');
    }

    public function download(Archive $archive)
    {
        // Tentukan path lengkap ke folder public/File
        $fullPath = public_path('File/' . $archive->file_path);

        // 1. Cek apakah kolom file_path ada isinya dan apakah file fisiknya ada
        if (!$archive->file_path || !File::exists($fullPath)) {
            return back()->with('error', 'File fisik tidak ditemukan di server.');
        }

        // 2. Lakukan download langsung dari folder public
        // Argumen kedua (opsional) adalah nama file saat di-download nanti
        return response()->download($fullPath, $archive->title . '.pdf');
    }

    public function preview(Archive $archive)
    {
        // if (!Storage::disk('public')->exists($archive->file_path)) {
        //     abort(404);
        // }
        // return response()->file(storage_path('app/public/' . $archive->file_path));

        // Cek apakah file fisik ada di folder public/File
        // Tambahkan manual folder 'File/' sebelum nama file dari DB
        $fullPath = public_path('File/' . $archive->file_path);

        if (!$archive->file_path || !file_exists($fullPath)) {
            abort(404, 'File tidak ditemukan.');
        }

        return response()->file($fullPath);
    }

    public function viewReport() {

        // Profil Instansi
        $profile = \DB::table('institution_profiles')->first();
        $currentYear = date('Y');

        // 1. Data per Instansi
        $instansiData = \DB::table('institution_profiles')
            ->leftJoin('archives', 'institution_profiles.id', '=', 'archives.institution_profile_id')
            ->select('institution_profiles.name', \DB::raw('count(archives.id) as total'))
            ->groupBy('institution_profiles.id', 'institution_profiles.name')
            ->get();

        // 2. Statistik Berdasarkan Tipe (Pola: 'Sangat Rahasia', 'Penting', 'Biasa')
        $typeData = \DB::table('archives')
            ->select('type', \DB::raw('count(*) as total'))
            ->groupBy('type')
            ->get();

        // 3. Grafik Bulanan Tahun Berjalan
        $monthlyData = \DB::table('archives')
            ->select(\DB::raw('MONTH(document_date) as month'), \DB::raw('count(*) as count'))
            ->whereYear('document_date', $currentYear)
            ->groupBy('month')
            ->pluck('count', 'month')->toArray();

        $chartData = [];
        for ($i = 1; $i <= 12; $i++) { $chartData[] = $monthlyData[$i] ?? 0; }

        // 4. Summary Totals
        $stats = [
            'total_arsip' => \DB::table('archives')->count(),
            'tahun_ini' => \DB::table('archives')->whereYear('document_date', $currentYear)->count(),
            'total_kategori' => \DB::table('categories')->count(),
        ];

        return view('admin.laporan', compact('profile', 'instansiData', 'typeData', 'chartData', 'stats', 'currentYear'));

    }

    public function pdf(Request $request)
    {
        $start = $request->tanggal_awal;
        $end = $request->tanggal_akhir;

        // Base Query untuk Archives
        $query = \DB::table('archives')
        ->leftJoin('institution_profiles', 'archives.institution_profile_id', '=', 'institution_profiles.id')
        ->select('archives.*', 'institution_profiles.name as nama_instansi');


        $archives = $query->get();

        // Logika jika user klik "Cetak PDF"
        // if ($request->action == 'pdf') {
            $pdf = Pdf::loadView('admin.pdf', compact('archives', 'start', 'end'));
            return $pdf->download('Laporan_Arsip_'.date('Ymd').'.pdf');
        // }

        // (Data lainnya untuk view Dashboard tetap diambil seperti sebelumnya)
        // return view('admin.', compact('archives', 'profile', 'start', 'end'));
    }
}
