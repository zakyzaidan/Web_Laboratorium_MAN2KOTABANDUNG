<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materi; // Pastikan Anda telah membuat model Materi
use Illuminate\Support\Facades\Storage;

class MateriController extends Controller
{
    /**
     * Menampilkan daftar materi.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $materi = Materi::paginate(6);
        return view('materi.index', compact('materi'));
    }

    /**
     * Menampilkan form untuk membuat materi baru.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('materi.create');
    }

    /**
     * Menyimpan materi baru ke database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'image-upload' => 'required|file|mimes:jpg,jpeg,png',
            'html-upload' => 'required|file|mimes:html',
            'judul' => 'required',
            'isi-materi' => 'required',
            'tujuan-dan-alat' => 'required',
            'tambahan' => 'required',
        ]);

        $pathGambar = $request->file('image-upload')->store('public/images');
        $pathDokumen = $request->file('html-upload')->store('public/documents');
        $judul = $request->input('judul');
        $isi_materi = $request->input('isi-materi');
        $tujuan_dan_alat_materi = $request->input('tujuan-dan-alat');
        $tambahan_materi = $request->input('tambahan');
        $kelas = session('kelas'); // Ganti dengan data kelas Anda
        $pembelajaran = session('pembelajaran');
        $id_admin = session('id_admin');
        // dd($pembelajaran);
        Materi::create([
            'judul_materi' => $judul,
            'thubnail_materi' => $pathGambar,
            'modul_pembelajaran_materi' => $pathDokumen,
            'isi_materi' => $isi_materi,
            'tujuan_dan_alat_materi' => $tujuan_dan_alat_materi,
            'tambahan_materi' => $tambahan_materi,
            'kelas' => $kelas, // Menambahkan data kelas ke database
            'pelajaran' => $pembelajaran,
            'id_admin' => $id_admin, // Menambahkan id_admin ke database
            // Tambahkan data lainnya di sini
        ]);
        // Reset sesi
        // Dapatkan semua data dari sesi

        return redirect('/materi-kelas-page')->with('success', 'Data berhasil disimpan');
    }

    /**
     * Menampilkan detail dari materi tertentu.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {

        $materi = Materi::find($id);

        return response()->json([
            'thubnail_materi' => Storage::url($materi->thubnail_materi),
            'modul_pembelajaran_materi' => Storage::url($materi->modul_pembelajaran_materi),
            'judul_materi' => $materi->judul_materi,
            'isi_materi' => $materi->isi_materi,
            'tujuan_dan_alat_materi' => $materi->tujuan_dan_alat_materi,
            'tambahan_materi' => $materi->tambahan_materi,
        ]);
    }

    /**
     * Menampilkan form untuk mengedit materi tertentu.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $materi = Materi::find($id);
        return view('materi.edit', compact('materi'));
    }

    /**
     * Memperbarui materi tertentu di database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $materi = Materi::find($id);

        // Update data materi
        $materi->judul_materi = $request->input('judul');
        $materi->isi_materi = $request->input('isi-materi');
        $materi->tujuan_dan_alat_materi = $request->input('tujuan-dan-alat');
        $materi->tambahan_materi = $request->input('tambahan');

        // Cek apakah file baru diunggah
        if ($request->hasFile('image-upload')) {
            // Hapus file lama
            Storage::delete($materi->thubnail_materi);

            // Simpan file baru
            $pathGambar = $request->file('image-upload')->store('public/images');
            $materi->thubnail_materi = $pathGambar;
        }

        if ($request->hasFile('html-upload')) {
            // Hapus file lama
            Storage::delete($materi->modul_pembelajaran_materi);

            // Simpan file baru
            $pathDokumen = $request->file('html-upload')->store('public/documents');
            $materi->modul_pembelajaran_materi = $pathDokumen;
        }

        // Simpan perubahan
        $materi->save();

        return redirect('/materi-kelas-page');
    }


    /**
     * Menghapus materi tertentu dari database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->input('id');
        $materi = Materi::find($id);

        // Delete files from storage
        Storage::delete($materi->thubnail_materi);
        Storage::delete($materi->modul_pembelajaran_materi);

        // Check if files are deleted
        if (!Storage::exists($materi->thubnail_materi) && !Storage::exists($materi->modul_pembelajaran_materi)) {
            $materi->delete();
            return redirect('/materi-kelas-page')->with('success', 'Files and record deleted successfully');
        } else {
            return redirect('/materi-kelas-page')->with('error', 'Failed to delete files or record');
        }
    }

}
