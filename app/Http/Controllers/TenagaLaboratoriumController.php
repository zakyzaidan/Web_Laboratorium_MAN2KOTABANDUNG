<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TenagaLaboratorium;
use Illuminate\Support\Facades\Storage;

class TenagaLaboratoriumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tenagaList = TenagaLaboratorium::all();
        return view('Dashboard/table_tenaga', compact('tenagaList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Dashboard/table_tenaga');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'jabatan' => 'required',
            'golongan' => 'required',
            'pendidikan_nama' => 'required',
            'pendidikan_strata' => 'required',
            'rancangan_tugas' => 'required',
            'image-upload' => 'required|file|mimes:jpg,jpeg,png', // Validasi unggahan gambar
        ]);

        $pathGambar = $request->file('image-upload')->store('public/images');


        // Create a new InventarisasiAlat model instance
        TenagaLaboratorium::create([
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'golongan' => $request->golongan,
            'pendidikan_nama' => $request->pendidikan_nama,
            'pendidikan_strata' => $request->pendidikan_strata,
            'rancangan_tugas' => $request->rancangan_tugas,
            'foto' => $pathGambar,
        ]);

        return redirect()->route('tenaga.index')->with('success', 'Tenaga berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tenaga = TenagaLaboratorium::find($id);
        return view('Dashboard/table_tenaga', compact('tenaga'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $tenaga = TenagaLaboratorium::findOrFail($id);
            return response()->json($tenaga);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $tenaga = TenagaLaboratorium::find($id);

    $tenaga->nama = $request->input('nama');
    $tenaga->jabatan = $request->input('jabatan');
    $tenaga->golongan = $request->input('golongan');
    $tenaga->pendidikan_nama = $request->input('pendidikan_nama');
    $tenaga->pendidikan_strata = $request->input('pendidikan_strata');
    $tenaga->rancangan_tugas = $request->input('rancangan_tugas');


    // Cek apakah file baru diunggah
    if ($request->hasFile('image-upload')) {
        // Hapus file lama
        Storage::delete($tenaga->foto);


        // Simpan file baru
        $pathGambar =  $request->file('image-upload')->store('public/images');
        $tenaga->foto = $pathGambar;
    }

    $tenaga->save();

    return redirect()->route('tenaga.index')->with('success', 'Tenaga Laboratorium berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tenaga = TenagaLaboratorium::find($id);
        Storage::delete($tenaga->foto);

        $tenaga->delete();

        return redirect()->route('tenaga.index')->with('success', 'Tenaga Laboratorium berhasil dihapus');
    }
}
