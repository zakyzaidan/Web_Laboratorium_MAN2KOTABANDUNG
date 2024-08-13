<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StrukturOrganisasi;
use Illuminate\Support\Facades\Storage;

class StrukturOrganisasiController extends Controller
{
    public function index()
    {
        $strukturOrganisasi = StrukturOrganisasi::all();
        $pembelajaran = session('pembelajaran');

        if ($pembelajaran == 'Kimia') {
            $layout = 'layouts.dashboard-layouts';
        } elseif ($pembelajaran == 'Fisika') {
            $layout = 'layouts.dashboard-layouts-fisika';
        } elseif ($pembelajaran == 'Biologi') {
            $layout = 'layouts.dashboard-layouts-biologi';
        }
        return view('strukturorganisasi', compact('strukturOrganisasi', 'layout'));
    }

    // Menampilkan form edit
    public function edit($id)
    {
        $struktur = StrukturOrganisasi::findOrFail($id);
        return response()->json($struktur);
    }

    // Menyimpan perubahan
    public function update(Request $request, $id)
    {
        $struktur = StrukturOrganisasi::find($id);
        
        // Cek apakah file baru diunggah
        if ($request->hasFile('image-upload')) {
            // Hapus file lama
            Storage::delete($struktur->foto);


            // Simpan file baru
            $pathGambar =  $request->file('image-upload')->store('public/images');
            $struktur->foto = $pathGambar;
        }

        $struktur->jabatan = $request->input('jabatan');
        $struktur->nama = $request->input('nama');
        $struktur->save();

        return redirect()->route('struktur-organisasi.index')->with('success', 'Struktur organisasi berhasil diperbarui.');
    }
}
