<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FisikaInventarisasiAlat;
use App\Models\FisikaInventarisasiBahan;
use App\Models\FisikaInventarisasiFasilitas;
use App\Models\FisikaTenagaLaboratorium;
use App\Models\FisikaJadwalPraktikum;

class FisikaInventarisasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil jumlah data dari tabel t_inventarisasi_alat dengan kondisi baik dan buruk
        $jumlahAlatBaik = FisikaInventarisasiAlat::sum('kondisi_baik');
        $jumlahAlatBuruk = FisikaInventarisasiAlat::sum('kondisi_buruk');

        // Mengambil jumlah data dari tabel t_inventarisasi_bahan dengan kondisi baik dan buruk
        $jumlahBahanBaik = FisikaInventarisasiBahan::sum('kondisi_baik');
        $jumlahBahanBuruk = FisikaInventarisasiBahan::sum('kondisi_buruk');

        // Mengambil jumlah data dari tabel t_inventarisasi_fasilitas dengan kondisi baik dan buruk
        $jumlahFasilitasBaik = FisikaInventarisasiFasilitas::sum('kondisi_baik');
        $jumlahFasilitasBuruk = FisikaInventarisasiFasilitas::sum('kondisi_buruk');

        // Mengambil jumlah tenaga laboratorium
        $jumlahTenagaLaboratorium = FisikaTenagaLaboratorium::count();

        // Mengambil data jadwal praktikum
        $jadwalPraktikum = FisikaJadwalPraktikum::all();

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
        return view('Dashboard-Fisika/inventaris', compact(
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
