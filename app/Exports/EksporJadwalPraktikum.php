<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EksporJadwalPraktikum implements FromCollection, WithHeadings
{
    protected $model;
    protected $pembelajaran;

    public function __construct($model, $pembelajaran)
    {
        $this->model = $model;
        $this->pembelajaran = $pembelajaran;
    }

    public function collection()
    {
        if ($this->pembelajaran === 'Kimia'){
            return $this->model::with(['alat', 'bahan', 'materi'])
            ->get()
            ->map(function($jadwal) {
                return [
                    'nama' => $jadwal->nama,
                    'kelas' => $jadwal->kelas,
                    'topik_praktikum' => $jadwal->materi->judul_materi,
                    'jadwal_praktikum' => $jadwal->jadwal_praktikum,
                    'jadwal_jam_pelajaran' => implode(', ', explode(',', $jadwal->jadwal_jam_praktikum)),
                    'alat_yang_dipinjam' => $jadwal->alat->map(function($alat) {
                        return $alat->nama_alat . ' - Jumlah: ' . $alat->pivot->jumlah;
                    })->implode(', '),
                    'bahan_yang_dipakai' => $jadwal->bahan->map(function($bahan) {
                        return $bahan->nama_bahan . ' - Jumlah: ' . $bahan->pivot->jumlah . ' ' . $bahan->satuan;
                    })->implode(', '),
                ];
            });
        } else {
            return $this->model::with(['alat', 'materi'])
            ->get()
            ->map(function($jadwal) {
                return [
                    'nama' => $jadwal->nama,
                    'kelas' => $jadwal->kelas,
                    'topik_praktikum' => $jadwal->materi->judul_materi,
                    'jadwal_praktikum' => $jadwal->jadwal_praktikum,
                    'jadwal_jam_pelajaran' => implode(', ', explode(',', $jadwal->jadwal_jam_praktikum)),
                    'alat_yang_dipinjam' => $jadwal->alat->map(function($alat) {
                        return $alat->nama_alat . ' - Jumlah: ' . $alat->pivot->jumlah;
                    })->implode(', '),
                ];
            });
        }
    }

    public function headings(): array
    {
        $headings = [
            'Nama',
            'Kelas',
            'Topik Praktikum',
            'Jadwal Praktikum',
            'Jadwal Jam Pelajaran',
            'Alat yang Dipinjam',
        ];

        // Jika sesi adalah Kimia, tambahkan kolom bahan
        if ($this->pembelajaran === 'Kimia') {
            $headings[] = 'Bahan yang Dipakai';
        }

        return $headings;
    }
}
