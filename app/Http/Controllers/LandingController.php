<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FisikaTenagaLaboratorium;
use App\Models\TenagaLaboratorium;
use App\Models\BiologiTenagaLaboratorium;
use App\Models\StrukturOrganisasi;

class LandingController extends Controller
{
    public function index()
    {
        $strukturOrganisasi = StrukturOrganisasi::all();

        // Ambil data dari masing-masing model
        $fisika = FisikaTenagaLaboratorium::all();
        $kimia = TenagaLaboratorium::all();
        $biologi = BiologiTenagaLaboratorium::all();

        // Gabungkan data menjadi satu koleksi
        $tenagaLaboratorium = collect();
        foreach ($fisika as $model)
            $tenagaLaboratorium->push($model);
        foreach ($kimia as $model)
            $tenagaLaboratorium->push($model);
        foreach ($biologi as $model)
            $tenagaLaboratorium->push($model);        
        

        return view('landing', compact('tenagaLaboratorium', 'strukturOrganisasi'));
    }
}
