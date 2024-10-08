<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EksporFasilitas implements FromCollection, WithHeadings
{
    protected $model;

    // Terima model yang akan diekspor melalui constructor
    public function __construct($model)
    {
        $this->model = $model;
    }

    /**
     * Mengambil data dari model yang dipilih
     */
    public function collection()
    {
        return $this->model::all(['nama_fasilitas', 'jumlah', 'satuan', 'kondisi_baik', 'kondisi_buruk', 'lokasi_penyimpanan', 'keterangan']);
    }

    /**
     * Judul kolom untuk file Excel
     */
    public function headings(): array
    {
        return [
            'Nama Fasilitas',
            'Jumlah',
            'Satuan',
            'Kondisi Baik',
            'Kondisi Buruk',
            'Lokasi Penyimpanan',
            'Keterangan'
        ];
    }
}
