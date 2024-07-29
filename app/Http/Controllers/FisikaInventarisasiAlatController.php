<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FisikaInventarisasiAlat;
use Illuminate\Support\Facades\Storage;

class FisikaInventarisasiAlatController extends Controller
{
    public function index()
    {
        $alatList = FisikaInventarisasiAlat::all();
        return view('Dashboard-Fisika/table_alat', compact('alatList'));
    }

    public function create()
    {
        return view('Dashboard-Fisika/table_alat');
    }

    public function store(Request $request)
{
    // dd('test');
    $request->validate([
        'namaAlat' => 'required',
        'golongan' => 'required',
        'merk' => 'required',
        'ukuran' => 'required',
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
    FisikaInventarisasiAlat::create([
        'nama_alat' => $request->namaAlat,
        'golongan' => $request->golongan,
        'merk' => $request->merk,
        'ukuran' => $request->ukuran,
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




    public function show($id)
    {
        $alat = FisikaInventarisasiAlat::find($id);
        return view('Dashboard-Fisika/detail_alat', compact('alat'));
    }

    public function edit($id)
    {
        try {
            $alat = FisikaInventarisasiAlat::findOrFail($id);
            return response()->json($alat);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function update(Request $request, $id)
{

    $alat = FisikaInventarisasiAlat::find($id);

    $alat->nama_alat = $request->input('namaAlat');
    $alat->golongan = $request->input('golongan');
    $alat->merk = $request->input('merk');
    $alat->ukuran = $request->input('ukuran');
    $alat->produksi = $request->input('produksi');
    $alat->tanggal_masuk = $request->input('tanggal_masuk');
    $alat->kondisi_baik = $request->input('kondisiBaik');
    $alat->kondisi_buruk = $request->input('kondisiBuruk');
    $alat->lokasi_penyimpanan = $request->input('lokasiPenyimpanan');
    $alat->satuan = $request->input('satuan');
    $alat->keterangan = $request->input('keterangan');
    $alat->jumlah = $request->input('jumlah');
    // Cek apakah file baru diunggah
    if ($request->hasFile('image-upload')) {
        // Hapus file lama
        Storage::delete($alat->foto);


        // Simpan file baru
        $pathGambar =  $request->file('image-upload')->store('public/images');
        $alat->foto = $pathGambar;
    }

    $alat->save();

    return redirect()->route('alat.index')->with('success', 'Alat berhasil diperbarui');
}

public function destroy(Request $request,$id)
{
    $alat = FisikaInventarisasiAlat::find($id);
    Storage::delete($alat->foto);

    $alat->delete();

    return redirect()->route('alat.index')->with('success', 'Alat berhasil dihapus');
}
}
