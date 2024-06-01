<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JadwalPraktikum;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;


class JadwalPraktikumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jadwalList = JadwalPraktikum::all();
        return view('Dashboard/table_jadwal', compact('jadwalList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Dashboard/table_jadwal');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'mata_pelajaran' => 'required',
            'topik_praktikum' => 'required',
            'jadwal_praktikum' => 'required',
            'laboratorium' => 'required',
            'image-upload' => 'required|file|mimes:jpg,jpeg,png', // Validasi unggahan gambar
        ]);

        $pathGambar = $request->file('image-upload')->store('public/images');


        // Create a new InventarisasiAlat model instance
        JadwalPraktikum::create([
            'nama' => $request->nama,
            'mata_pelajaran' => $request->mata_pelajaran,
            'topik_praktikum' => $request->topik_praktikum,
            'jadwal_praktikum' => $request->jadwal_praktikum,
            'laboratorium' => $request->laboratorium,
            'foto' => $pathGambar,
        ]);

        return redirect()->route('jadwal.index')->with('success', 'Jadwal Praktikum berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $jadwal = JadwalPraktikum::find($id);
        return view('Dashboard/table_jadwal', compact('jadwal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $jadwal = JadwalPraktikum::findOrFail($id);
            return response()->json($jadwal);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $jadwal = JadwalPraktikum::find($id);

    $jadwal->nama = $request->input('nama');
    $jadwal->mata_pelajaran = $request->input('mata_pelajaran');
    $jadwal->topik_praktikum = $request->input('topik_praktikum');
    $jadwal->jadwal_praktikum = $request->input('jadwal_praktikum');
    $jadwal->laboratorium = $request->input('laboratorium');


    // Cek apakah file baru diunggah
    if ($request->hasFile('image-upload')) {
        // Hapus file lama
        Storage::delete($jadwal->foto);


        // Simpan file baru
        $pathGambar =  $request->file('image-upload')->store('public/images');
        $jadwal->foto = $pathGambar;
    }

    $jadwal->save();

    return redirect()->route('jadwal.index')->with('success', 'Jadwal Praktikum berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jadwal = JadwalPraktikum::find($id);
        Storage::delete($jadwal->foto);

        $jadwal->delete();

        return redirect()->route('jadwal.index')->with('success', 'Jadwal Praktikum berhasil dihapus');
    }

    public function checkDate($jadwal_praktikum)
    {
        try {
            // Cek apakah tanggal tersebut ada di database
            $exists = JadwalPraktikum::where('jadwal_praktikum', $jadwal_praktikum)->exists();

            // Mengembalikan respons dalam format JSON
            return response()->json(['exists' => $exists]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

}
