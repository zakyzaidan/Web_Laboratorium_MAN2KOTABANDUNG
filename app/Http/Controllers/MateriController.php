<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materi; // Pastikan Anda telah membuat model Materi
use App\Models\FisikaInventarisasiAlat;
use App\Models\BiologiInventarisasiAlat;
use App\Models\InventarisasiAlat;
use App\Models\InventarisasiBahan;
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
        
        $username = session('username');
        $user_type = session('user_type');
        if(session('pembelajaran') == 'Fisika'){
            $alat = FisikaInventarisasiAlat::all(); // Ambil semua data alat
        }else if(session('pembelajaran') == 'Biologi'){
            $alat = BiologiInventarisasiAlat::all(); // Ambil semua data alat
        }else if(session('pembelajaran') == 'Kimia'){
            $alat = InventarisasiAlat::all(); // Ambil semua data alat
            $bahan = InventarisasiBahan::all(); // Ambil semua data alat
            
            $materi = Materi::where('kelas', session('kelas'))->where('pelajaran',session('pembelajaran'))->paginate(6);
            $selectedAlatIds = [];

            if ($user_type == 'guru') {
                return view('materikelaspageguru',compact('username', 'user_type','materi', 'alat', 'bahan', 'selectedAlatIds'));
            } else if ($user_type == 'siswa') {
                return view('materikelaspagesiswa',compact('username', 'user_type','materi'));
            }
        }else{
            return redirect('/');
        }

        $materi = Materi::where('kelas', session('kelas'))->where('pelajaran',session('pembelajaran'))->paginate(6);
        $selectedAlatIds = [];

        if ($user_type == 'guru') {
            return view('materikelaspageguru',compact('username', 'user_type','materi', 'alat', 'selectedAlatIds'));
        } else if ($user_type == 'siswa') {
            return view('materikelaspagesiswa',compact('username', 'user_type','materi'));
        }

        // Anda bisa menambahkan logika lainnya di sini, misalnya jika user_type tidak ada di session
        return redirect('/login');

        // $alat = FisikaInventarisasiAlat::all(); // Ambil semua data alat
        // $materi = Materi::paginate(6);
        // return view('materi.index', compact('materi', 'alat'));
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
            //'html-upload' => 'required|file|mimes:html',
            'judul' => 'required',
            'isi-materi' => 'required',
            'tujuan-dan-alat' => 'required',
            'tambahan' => 'required',
            'alat' => 'required|array', 
        ]);

        $pathGambar = $request->file('image-upload')->store('public/images');
        $pathDokumen = $request->file('html-upload')?->store('public/documents') ?? '';
        $pathFileMateri = $request->file('file-materi')->store('public/files');

        $judul = $request->input('judul');
        $isi_materi = $request->input('isi-materi');
        $tujuan_dan_alat_materi = $request->input('tujuan-dan-alat');
        $tambahan_materi = $request->input('tambahan');
        $penulis = $request->input('penulis');
        $kelas = session('kelas'); // Ganti dengan data kelas Anda
        $pembelajaran = session('pembelajaran');
        $id_admin = session('id_admin');
        
        //dd($request->input('alat'));
        $materi = Materi::create([
            'judul_materi' => $judul,
            'thubnail_materi' => $pathGambar,
            'modul_pembelajaran_materi' => $pathDokumen,
            'isi_materi' => $isi_materi,
            'tujuan_dan_alat_materi' => $tujuan_dan_alat_materi,
            'tambahan_materi' => $tambahan_materi,
            'kelas' => $kelas, // Menambahkan data kelas ke database
            'pelajaran' => $pembelajaran,
            'id_admin' => $id_admin, // Menambahkan id_admin ke database
            'penulis' => $penulis,
            'file_materi' => $pathFileMateri,
            // Tambahkan data lainnya di sini
        ]);
        // Reset sesi
        // Dapatkan semua data dari sesi

        // Simpan relasi alat yang dipilih
        if(session('pembelajaran') == "Fisika"){
            $materi->fisika_alat()->attach($request->input('alat'));
        }else if(session('pembelajaran') == "Biologi"){
            $materi->biologi_alat()->attach($request->input('alat'));
        }else if(session('pembelajaran') == "Kimia"){
            $materi->kimia_alat()->attach($request->input('alat'));
            $materi->kimia_bahan()->attach($request->input('bahan'));
        }

        $materi->save();

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
        
        if(session('pembelajaran') == "Fisika"){
            $alatIds = $materi->fisika_alat()->pluck('t_fisika_inventarisasi_alat_id')->toArray();
        }else if(session('pembelajaran') == "Biologi"){
            $alatIds = $materi->biologi_alat()->pluck('t_biologi_inventarisasi_alat_id')->toArray();
        }else if(session('pembelajaran') == "Kimia"){
            $alatIds = $materi->kimia_alat()->pluck('t_kimia_inventarisasi_alat_id')->toArray();
            $bahanIds = $materi->kimia_bahan()->pluck('t_kimia_inventarisasi_bahan_id')->toArray();
        }

        return response()->json([
            'thubnail_materi' => Storage::url($materi->thubnail_materi),
            'modul_pembelajaran_materi' => Storage::url($materi->modul_pembelajaran_materi),
            'judul_materi' => $materi->judul_materi,
            'isi_materi' => $materi->isi_materi,
            'tujuan_dan_alat_materi' => $materi->tujuan_dan_alat_materi,
            'tambahan_materi' => $materi->tambahan_materi,
            'penulis' => $materi->penulis,
            'file_materi' => Storage::url($materi->file_materi),
            'alat' => $alatIds,
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
        $inventarisasiAlat = FisikaInventarisasiAlat::all();

        // Dapatkan ID alat yang sudah terhubung dengan materi
        $selectedAlatIds = $materi->inventarisasiAlat()->pluck('inventarisasi_alat.id')->toArray();

        return view('materi.edit', compact('materi','inventarisasiAlat', 'selectedAlatIds'));
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
        $request->validate([
            'judul' => 'required',
            'isi-materi' => 'required',
            'tujuan-dan-alat' => 'required',
            'tambahan' => 'required',
            'alat' => 'required|array',
        ]);

        $materi = Materi::find($id);

        // Update data materi
        $materi->judul_materi = $request->input('judul');
        $materi->isi_materi = $request->input('isi-materi');
        $materi->tujuan_dan_alat_materi = $request->input('tujuan-dan-alat');
        $materi->tambahan_materi = $request->input('tambahan');
        $materi->penulis = $request->input('penulis');

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

        if ($request->hasFile('file-materi')) {
            // Hapus file lama
            Storage::delete($materi->file_materi);

            // Simpan file baru
            $pathFileMateri = $request->file('file-materi')->store('public/files');
            $materi->file_materi = $pathFileMateri;
        }

        // Simpan perubahan
        $materi->save();

        // Delete hubungan antara materi dan alat lama
        if(session('pembelajaran') == "Fisika"){
            $materi->fisika_alat()->detach();
            $materi->fisika_alat()->attach($request->input('alat'));
        }else if(session('pembelajaran') == "Biologi"){
            $materi->biologi_alat()->detach();
            $materi->biologi_alat()->attach($request->input('alat'));
        }else if(session('pembelajaran') == "Kimia"){
            $materi->kimia_alat()->detach();
            $materi->kimia_alat()->attach($request->input('alat'));
            $materi->kimia_bahan()->detach();
            $materi->kimia_bahan()->attach($request->input('bahan'));
        }

        // Update hubungan antara materi dan alat yang dipilih

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
        Storage::delete($materi->file_materi);
        
        // Check if files are deleted
        if (!Storage::exists($materi->thubnail_materi)) {
            $materi->delete();
            return redirect('/materi-kelas-page')->with('success', 'Files and record deleted successfully');
        } else {
            return redirect('/materi-kelas-page')->with('error', 'Failed to delete files or record');
        }
    }

}
