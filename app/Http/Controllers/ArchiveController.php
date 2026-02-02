<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArchiveController extends Controller
{
    public function index()
    {
        $archives = Archive::latest()->get();
        return view('admin.archives.index', compact('archives'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.archives.create', compact('categories'));
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
        ]);

        if ($request->hasFile('file_path')) {
            $path = $request->file('file_path')->store('archives', 'public');
            $validated['file_path'] = $path;
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
            if ($archive->file_path) {
                Storage::disk('public')->delete($archive->file_path);
            }
            $path = $request->file('file_path')->store('archives', 'public');
            $validated['file_path'] = $path;
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
        if (!Storage::disk('public')->exists($archive->file_path)) {
            return back()->with('error', 'File fisik tidak ditemukan.');
        }
        return Storage::disk('public')->download($archive->file_path);
    }

    public function preview(Archive $archive)
    {
        if (!Storage::disk('public')->exists($archive->file_path)) {
            abort(404);
        }
        return response()->file(storage_path('app/public/' . $archive->file_path));
    }
}
