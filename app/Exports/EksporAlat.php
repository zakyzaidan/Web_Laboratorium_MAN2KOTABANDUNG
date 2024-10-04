<?php

namespace App\Exports;

use App\Models\InventarisasiAlat;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EksporAlat implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $model;

    // Terima model yang akan diekspor melalui constructor
    public function __construct($model)
    {
        $this->model = $model;
    }

    public function collection()
    {
        // Mengambil semua data alat untuk diekspor
        return $this->model::all(['nama_alat', 'jumlah', 'satuan', 'kondisi_baik', 'kondisi_buruk', 'lokasi_penyimpanan', 'keterangan']);
    }

    // Tambahkan judul kolom ke file Excel
    public function headings(): array
    {
        return [
            'Nama Alat',
            'Jumlah',
            'Satuan',
            'Kondisi Baik',
            'Kondisi Buruk',
            'Lokasi Penyimpanan',
            'Keterangan'
        ];
    }
}