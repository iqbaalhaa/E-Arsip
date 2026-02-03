<?php

use App\Http\Controllers\ArchiveController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InstitutionProfileController;

Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        if (auth()->user()->role === 'admin') {
            return redirect('/admin/dashboard');
        }
        return redirect('/pegawai/dashboard');
    })->name('dashboard');

    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/dashboard', function () {

            $totalArsip = \DB::table('archives')->count();
            $totalKategori = \DB::table('categories')->count();
            $totalInstansi = \DB::table('institution_profiles')->count();
            $arsipTerbaru = \DB::table('archives')
                ->join('categories', 'archives.category', '=', 'categories.name') 
                ->select('archives.*')
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get();

            return view('admin.dashboard', compact('totalArsip', 'totalKategori', 'totalInstansi', 'arsipTerbaru'));

            // return view('admin.dashboard');
        })->name('admin.dashboard');

        Route::post('/pdf', [ArchiveController::class, 'pdf']);
        
        Route::resource('users', UserController::class);
        Route::resource('institution-profiles', InstitutionProfileController::class);
        Route::get('view-report', [ArchiveController::class, 'viewReport']);
    });

    // Archive Routes (Accessible by Admin and Pegawai)
    Route::resource('archives', \App\Http\Controllers\ArchiveController::class);
    Route::get('archives/{archive}/download', [\App\Http\Controllers\ArchiveController::class, 'download'])->name('archives.download');
    Route::get('archives/{archive}/preview', [\App\Http\Controllers\ArchiveController::class, 'preview'])->name('archives.preview');
    Route::resource('categories', \App\Http\Controllers\CategoryController::class);

    Route::middleware(['role:pegawai'])->group(function () {
        Route::get('/pegawai/dashboard', function () {

            $totalArsip = \DB::table('archives')->count();
            $totalKategori = \DB::table('categories')->count();
            $totalInstansi = \DB::table('institution_profiles')->count();
            $arsipTerbaru = \DB::table('archives')
                ->join('categories', 'archives.category', '=', 'categories.name') // sesuaikan jika kolomnya berbeda
                ->select('archives.*')
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get();

            return view('pegawai.dashboard', compact('totalArsip', 'totalKategori', 'totalInstansi', 'arsipTerbaru'));

            // return view('pegawai.dashboard');
        })->name('pegawai.dashboard');
    });
});
