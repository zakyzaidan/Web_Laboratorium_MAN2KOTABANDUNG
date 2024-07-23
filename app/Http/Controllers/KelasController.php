<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FisikaJadwalPraktikum;
use App\Models\BiologiJadwalPraktikum;
use App\Models\JadwalPraktikum;

class KelasController extends Controller
{
    public function setKelasSession(Request $request, $kelas){
        $request->session()->put('kelas', $kelas);
        // Mengarahkan pengguna ke halaman berikutnya
        return redirect('/materi-kelas-page');
    }

    public function setpembelajaranSession(Request $request,$kelas){
        $request->session()->put('pembelajaran', $kelas);

        // Mengambil data jadwal praktikum
        if ($kelas == 'Fisika'){
            $jadwalPraktikum = FisikaJadwalPraktikum::all();
        } elseif ($kelas == 'Biologi'){
            $jadwalPraktikum = BiologiJadwalPraktikum::all();
        } elseif ($kelas == 'Kimia'){
            $jadwalPraktikum = JadwalPraktikum::all();
        } else {
            return redirect('/');
        }

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

        return redirect("/pilih-kelas")->with('events', $events);
    }
}
