<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function setKelasSession(Request $request, $kelas)
{
    $request->session()->put('kelas', $kelas);


    // Mengarahkan pengguna ke halaman berikutnya
    return redirect('/materi-kelas-page');
}
}
