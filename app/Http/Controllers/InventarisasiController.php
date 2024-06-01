<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InventarisasiAlat;
use App\Models\InventarisasiBahan;
use App\Models\InventarisasiFasilitas;
use App\Models\TenagaLaboratorium;
use App\Models\JadwalPraktikum;

class InventarisasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil jumlah data dari tabel t_inventarisasi_alat dengan kondisi baik dan buruk
        $jumlahAlatBaik = InventarisasiAlat::sum('kondisi_baik');
        $jumlahAlatBuruk = InventarisasiAlat::sum('kondisi_buruk');

        // Mengambil jumlah data dari tabel t_inventarisasi_bahan dengan kondisi baik dan buruk
        $jumlahBahanBaik = InventarisasiBahan::sum('kondisi_baik');
        $jumlahBahanBuruk = InventarisasiBahan::sum('kondisi_buruk');

        // Mengambil jumlah data dari tabel t_inventarisasi_fasilitas dengan kondisi baik dan buruk
        $jumlahFasilitasBaik = InventarisasiFasilitas::sum('kondisi_baik');
        $jumlahFasilitasBuruk = InventarisasiFasilitas::sum('kondisi_buruk');

        // Mengambil jumlah tenaga laboratorium
        $jumlahTenagaLaboratorium = TenagaLaboratorium::count();

        // Mengambil data jadwal praktikum
        $jadwalPraktikum = JadwalPraktikum::all();

        // Inisialisasi array kosong untuk menampung data jadwal praktikum
        $events = [];

        // Iterasi melalui setiap jadwal praktikum dan menambahkannya ke array $events
        foreach ($jadwalPraktikum as $jadwal) {
            // Format data sesuai dengan yang dibutuhkan oleh caleandar.js
            $event = [
                'Date' => date('Y, n, j', strtotime($jadwal->jadwal_praktikum)), // Ubah tanggal ke format tahun, bulan, hari
                'Title' => $jadwal->mata_pelajaran . ' - ' . $jadwal->topik_praktikum, // Judul acara
                // Jika Anda ingin menambahkan tautan, Anda bisa menambahkannya di sini
            ];

            // Tambahkan event ke array events
            $events[] = $event;
        }
        // dd($events);

        // Mengembalikan view dengan data yang digabungkan
        return view('Dashboard/inventaris', compact(
            'jumlahAlatBaik', 'jumlahAlatBuruk',
            'jumlahBahanBaik', 'jumlahBahanBuruk',
            'jumlahFasilitasBaik', 'jumlahFasilitasBuruk',
            'jumlahTenagaLaboratorium', 'events'
        ));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
