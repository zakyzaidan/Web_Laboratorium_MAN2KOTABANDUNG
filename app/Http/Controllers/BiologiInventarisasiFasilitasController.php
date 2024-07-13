<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BiologiInventarisasiFasilitas;
use Illuminate\Support\Facades\Storage;

class BiologiInventarisasiFasilitasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fasilitasList = BiologiInventarisasiFasilitas::all();
        return view('Dashboard-Biologi/table_fasilitas', compact('fasilitasList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Dashboard-Biologi/table_fasilitas');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'namaFasilitas' => 'required',
            'jumlah' => 'required',
            'image-upload' => 'required|file|mimes:jpg,jpeg,png', // Validasi unggahan gambar
            'kondisiBaik' => 'required',
            'kondisiBuruk' => 'required',
            'lokasiPenyimpanan' => 'required',
            'satuan' => 'required', // Validasi kolom satuan
        ]);

        $pathGambar = $request->file('image-upload')->store('public/images');


        // Create a new InventarisasiFasilitas model instance
        BiologiInventarisasiFasilitas::create([
            'nama_fasilitas' => $request->namaFasilitas,
            'jumlah' => $request->jumlah,
            'foto' => $pathGambar,
            'kondisi_baik' => $request->kondisiBaik,
            'kondisi_buruk' => $request->kondisiBuruk,
            'lokasi_penyimpanan' => $request->lokasiPenyimpanan,
            'keterangan' => $request->keterangan,
            'satuan' => $request->satuan,
        ]);

        return redirect()->route('fasilitas.index')->with('success', 'Fasilitas berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $fasilitas = BiologiInventarisasiFasilitas::find($id);
        return view('Dashboard-Biologi/table_fasilitas', compact('fasilitas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $fasilitas = BiologiInventarisasiFasilitas::findOrFail($id);
            return response()->json($fasilitas);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $fasilitas = BiologiInventarisasiFasilitas::find($id);

    $fasilitas->nama_fasilitas = $request->input('namaFasilitas');
    $fasilitas->kondisi_baik = $request->input('kondisiBaik');
    $fasilitas->kondisi_buruk = $request->input('kondisiBuruk');
    $fasilitas->lokasi_penyimpanan = $request->input('lokasiPenyimpanan');
    $fasilitas->satuan = $request->input('satuan');
    $fasilitas->keterangan = $request->input('keterangan');
    $fasilitas->jumlah = $request->input('jumlah');

    // Cek apakah file baru diunggah
    if ($request->hasFile('image-upload')) {
        // Hapus file lama
        Storage::delete($fasilitas->foto);


        // Simpan file baru
        $pathGambar =  $request->file('image-upload')->store('public/images');
        $fasilitas->foto = $pathGambar;
    }

    $fasilitas->save();

    return redirect()->route('fasilitas.index')->with('success', 'Fasilitas berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $fasilitas = BiologiInventarisasiFasilitas::find($id);
    Storage::delete($fasilitas->foto);

    $fasilitas->delete();

    return redirect()->route('fasilitas.index')->with('success', 'Fasilitas berhasil dihapus');
    }
}
