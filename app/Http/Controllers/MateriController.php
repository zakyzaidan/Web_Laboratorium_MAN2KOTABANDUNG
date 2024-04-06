<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materi; // Pastikan Anda telah membuat model Materi

class MateriController extends Controller
{
    /**
     * Menampilkan daftar materi.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $materi = Materi::all();
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
            'image-upload' => 'required|file',
            'html-upload' => 'required|file',
        ]);

        $pathGambar = $request->file('image-upload')->store('public/images');
        $pathDokumen = $request->file('html-upload')->store('public/documents');
        $judul = $request->input('judul');
        $isi_materi = $request->input('edit1');
        $tujuan_dan_alat_materi = $request->input('edit2');
        $tambahan_materi = $request->input('edit3');
        $kelas = session('kelas'); // Ganti dengan data kelas Anda
        $id_admin = session('id_admin');

        Materi::create([
            'judul_materi' => $judul,
            'thubnail_materi' => $pathGambar,
            'modul_pembelajaran_materi' => $pathDokumen,
            'isi_materi' => $isi_materi,
            'tujuan_dan_alat_materi' => $tujuan_dan_alat_materi,
            'tambahan_materi' => $tambahan_materi,
            'kelas' => $kelas, // Menambahkan data kelas ke database
            'id_admin' => $id_admin, // Menambahkan id_admin ke database
            // Tambahkan data lainnya di sini
        ]);
        return redirect('/materi-kelas-page');
    }

    /**
     * Menampilkan detail dari materi tertentu.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $materi = Materi::find($id);
        return view('materi.show', compact('materi'));
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
        $materi->update($request->all());
        return redirect('/materi');
    }

    /**
     * Menghapus materi tertentu dari database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $materi = Materi::find($id);
        $materi->delete();
        return redirect('/materi');
    }
}
