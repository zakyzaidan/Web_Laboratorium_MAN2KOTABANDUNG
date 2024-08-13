<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class PilihLabolatoriumController extends Controller
{
    //
    public function index()
    {
        return view('pilihlabolatorium');
    }

    public function setpembelajaranSession(Request $request, $pelajaran){
        $request->session()->put('pembelajaran', $pelajaran);

        // Mengambil data jadwal praktikum
        if ($pelajaran == 'Fisika'){
            return redirect('/Dashboard-inventaris-fisika');
        } elseif ($pelajaran == 'Biologi'){
            return redirect('/Dashboard-inventaris-biologi');
        } elseif ($pelajaran == 'Kimia'){
            return redirect('/Dashboard-inventaris');
        } else {
            return redirect('/');
        }

    }
}
