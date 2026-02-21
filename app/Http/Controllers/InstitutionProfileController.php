<?php

namespace App\Http\Controllers;

use App\Models\InstitutionProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\File;

class InstitutionProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profiles = InstitutionProfile::all();
        return view('admin.institution_profiles.index', compact('profiles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.institution_profiles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'address' => 'required|string',
        //     'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        //     'field' => 'required|string|max:255',
        //     'contact' => 'required|string|max:255',
        // ]);

        // $data = $request->all();

        // if ($request->hasFile('logo')) {
        //     $logoPath = $request->file('logo')->store('institution_logos', 'public');
        //     $data['logo'] = $logoPath;
        // }

        // InstitutionProfile::create($data);

        // return redirect()->route('institution-profiles.index')->with('success', 'Profil Instansi berhasil ditambahkan.');


        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'field' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
        ]);

        $data = $request->all();

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            
            // Membuat nama file yang unik agar tidak menimpa file lama
            $fileName = time() . '_' . $file->getClientOriginalName();
            
            // Memindahkan file ke folder 'public/File'
            $file->move(public_path('File'), $fileName);
            
            // Menyimpan path/nama file ke database
            $data['logo'] = $fileName;
        }

        InstitutionProfile::create($data);

        return redirect()->route('institution-profiles.index')->with('success', 'Profil Instansi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(InstitutionProfile $institutionProfile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InstitutionProfile $institutionProfile)
    {
        return view('admin.institution_profiles.edit', compact('institutionProfile'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InstitutionProfile $institutionProfile)
    {
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'address' => 'required|string',
        //     'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        //     'field' => 'required|string|max:255',
        //     'contact' => 'required|string|max:255',
        // ]);

        // $data = $request->all();

        // if ($request->hasFile('logo')) {
        //     // Delete old logo
        //     if ($institutionProfile->logo) {
        //         Storage::disk('public')->delete($institutionProfile->logo);
        //     }
        //     $logoPath = $request->file('logo')->store('institution_logos', 'public');
        //     $data['logo'] = $logoPath;
        // }

        // $institutionProfile->update($data);

        // return redirect()->route('institution-profiles.index')->with('success', 'Profil Instansi berhasil diperbarui.');

            $request->validate([
                'name' => 'required|string|max:255',
                'address' => 'required|string',
                'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'field' => 'required|string|max:255',
                'contact' => 'required|string|max:255',
            ]);

            $data = $request->all();

            if ($request->hasFile('logo')) {
                // 1. Hapus logo lama jika ada di folder public/File
                if ($institutionProfile->logo && File::exists(public_path('File/' . $institutionProfile->logo))) {
                    File::delete(public_path('File/' . $institutionProfile->logo));
                }

                // 2. Proses upload logo baru
                $file = $request->file('logo');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('File'), $fileName);
                
                // 3. Set path baru untuk disimpan ke database
                $data['logo'] =  $fileName;
            }

            $institutionProfile->update($data);

            return redirect()->route('institution-profiles.index')->with('success', 'Profil Instansi berhasil diperbarui.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InstitutionProfile $institutionProfile)
    {
        if ($institutionProfile->logo) {
            // Storage::disk('public')->delete($institutionProfile->logo);

            File::delete(public_path('File/' . $institutionProfile->logo));
        }
        $institutionProfile->delete();

        return redirect()->route('institution-profiles.index')->with('success', 'Profil Instansi berhasil dihapus.');
    }
}
