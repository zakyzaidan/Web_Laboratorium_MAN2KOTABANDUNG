<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PeminjamanPihakLuar;
use App\Models\InventarisasiAlat;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class PeminjamanPihakLuarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $peminjamanList = PeminjamanPihakLuar::all();
        $alats = InventarisasiAlat::all();
        return view('Dashboard/table_peminjaman', compact('peminjamanList', 'alats'));
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
        // $request->validate([
        //     'nama_peminjam' => 'required',
        //     'nama_instansi' => 'required',
        //     'status' => 'required',
        //     'tanggal_peminjaman' => 'required',
        //     'tanggal_pengembalian' => 'required',
        //     'alat[]' => 'required|array',
        //     'jumlah_alat[]' => 'required|array',
        // ]);
        
        // Create a new InventarisasiAlat model instance
        $peminjaman = PeminjamanPihakLuar::create([
            'nama_peminjam' => $request->nama_peminjam,
            'nama_instansi' => $request->nama_instansi,
            'status' => $request->status,
            'tanggal_peminjaman' => $request->tanggal_peminjaman,
            'rencana_pengembalian' => $request->rencana_pengembalian,
        ]);

        // Simpan alat dan jumlah yang dipinjam ke tabel pivot
        foreach ($request->input('alat') as $key => $alatId) {
            //perbarui jumlah alat di inventarisasi alat
            $alat = InventarisasiAlat::find($alatId);
            $jumlahLama = $alat->jumlah;
            $jumlahBaru = $jumlahLama - $request->input('jumlah_alat')[$key];
            $alat->jumlah = $jumlahBaru;

            $jumlahLama = $alat->kondisi_baik;
            $jumlahBaru = $jumlahLama - $request->input('jumlah_alat')[$key];
            $alat->kondisi_baik = $jumlahBaru;

            $alat->save();

            $jumlahDipinjam = $request->input('jumlah_alat')[$key];
            $peminjaman->alat()->attach($alatId, ['jumlah' => $jumlahDipinjam]);
        }

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $peminjaman = PeminjamanPihakLuar::find($id);
        return view('Dashboard/table_peminjaman', compact('peminjaman'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $peminjam = PeminjamanPihakLuar::findOrFail($id);

        return response()->json($peminjam);
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $peminjam = PeminjamanPihakLuar::find($id);
        $peminjam->tanggal_pengembalian = $request->input('tanggal_pengembalian');
        $peminjam->status = $request->input('status');
        //perbarui jumlah alat di inventarisasi alat
        foreach ($peminjam->alat as $alatDikembalikan) {
            $alat = InventarisasiAlat::find($alatDikembalikan->id_t_inventarisasi_alat);
            $jumlahDikembalikan = $alatDikembalikan->pivot->jumlah;
            $jumlahBaru = $jumlahDikembalikan + $alat->jumlah;
            $alat->jumlah = $jumlahBaru;

            $jumlahDikembalikan = $alatDikembalikan->pivot->jumlah;
            $jumlahBaru = $jumlahDikembalikan + $alat->kondisi_baik;
            $alat->kondisi_baik = $jumlahBaru;

            $alat->save();
        }

        $peminjam->save();


        return redirect()->route('peminjaman.index')->with('success', 'Bahan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $peminjam = PeminjamanPihakLuar::find($id);

        $peminjam->delete();

        return redirect()->route('peminjaman.index')->with('success', 'Bahan berhasil dihapus');
    }
}
