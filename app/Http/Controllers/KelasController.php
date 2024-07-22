<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function setKelasSession(Request $request, $kelas){
        $request->session()->put('kelas', $kelas);
        // Mengarahkan pengguna ke halaman berikutnya
        return redirect('/materi-kelas-page');
    }

    public function setpembelajaranSession(Request $request,$kelas){
        $request->session()->put('pembelajaran', $kelas);

        return redirect("/pilih-kelas");
    }
}
