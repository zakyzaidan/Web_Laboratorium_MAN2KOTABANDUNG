<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FisikaJadwalPraktikum;
use App\Models\BiologiJadwalPraktikum;
use App\Models\Materi;
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
            $materis = Materi::with('fisika_alat')->where('pelajaran','Fisika')->get();
        } elseif ($kelas == 'Biologi'){
            $jadwalPraktikum = BiologiJadwalPraktikum::all();
            $materis = Materi::with('biologi_alat')->where('pelajaran','Biologi')->get();
        } elseif ($kelas == 'Kimia'){
            $jadwalPraktikum = JadwalPraktikum::all();
            $materis = Materi::with(['kimia_alat', 'kimia_bahan'])->where('pelajaran','Kimia')->get();
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

        return view('kelaspage', compact('events', 'materis'));
    }
}
