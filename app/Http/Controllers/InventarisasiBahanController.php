<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InventarisasiBahan;
use Illuminate\Support\Facades\Storage;

class InventarisasiBahanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bahanList = InventarisasiBahan::all();
        return view('Dashboard/table_bahan', compact('bahanList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Dashboard/table_bahan');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'namaBahan' => 'required',
            'golongan' => 'required',
            'mr' => 'required',
            'kemurnian' => 'required',
            'konsentrasi' => 'required',
            'wujud' => 'required',
            'merk' => 'required',
            'produksi' => 'required',
            'tanggal_masuk' => 'required',
            'jumlah' => 'required',
            'image-upload' => 'required|file|mimes:jpg,jpeg,png', // Validasi unggahan gambar
            'kondisiBaik' => 'required',
            'kondisiBuruk' => 'required',
            'lokasiPenyimpanan' => 'required',
            'satuan' => 'required', // Validasi kolom satuan
        ]);

        $pathGambar = $request->file('image-upload')->store('public/images');


        // Create a new InventarisasiAlat model instance
        InventarisasiBahan::create([
            'nama_bahan' => $request->namaBahan,
            'golongan' => $request->golongan,
            'mr' => $request->mr,
            'kemurnian' => $request->kemurnian,
            'konsentrasi' => $request->konsentrasi,
            'wujud' => $request->wujud,
            'merk' => $request->merk,
            'produksi' => $request->produksi,
            'tanggal_masuk' => $request->tanggal_masuk,
            'jumlah' => $request->jumlah,
            'foto' => $pathGambar,
            'kondisi_baik' => $request->kondisiBaik,
            'kondisi_buruk' => $request->kondisiBuruk,
            'lokasi_penyimpanan' => $request->lokasiPenyimpanan,
            'keterangan' => $request->keterangan,
            'satuan' => $request->satuan,
        ]);

        return redirect()->route('alat.index')->with('success', 'Alat berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $bahan = InventarisasiBahan::find($id);
        return view('Dashboard/detail_bahan', compact('bahan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $bahan = InventarisasiBahan::findOrFail($id);
            return response()->json($bahan);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $bahan = InventarisasiBahan::find($id);

    $bahan->nama_bahan = $request->input('namaBahan');
    $bahan->golongan = $request->input('golongan');
    $bahan->mr = $request->input('mr');
    $bahan->kemurnian = $request->input('kemurnian');
    $bahan->konsentrasi = $request->input('konsentrasi');
    $bahan->wujud = $request->input('wujud');
    $bahan->merk = $request->input('merk');
    $bahan->produksi = $request->input('produksi');
    $bahan->tanggal_masuk = $request->input('tanggal_masuk');
    $bahan->kondisi_baik = $request->input('kondisiBaik');
    $bahan->kondisi_buruk = $request->input('kondisiBuruk');
    $bahan->lokasi_penyimpanan = $request->input('lokasiPenyimpanan');
    $bahan->satuan = $request->input('satuan');

    // Cek apakah file baru diunggah
    if ($request->hasFile('image-upload')) {
        // Hapus file lama
        Storage::delete($bahan->foto);


        // Simpan file baru
        $pathGambar =  $request->file('image-upload')->store('public/images');
        $bahan->foto = $pathGambar;
    }

    $bahan->save();

    return redirect()->route('bahan.index')->with('success', 'Bahan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $bahan = InventarisasiBahan::find($id);
        Storage::delete($bahan->foto);

        $bahan->delete();

        return redirect()->route('bahan.index')->with('success', 'Bahan berhasil dihapus');
    }
}
