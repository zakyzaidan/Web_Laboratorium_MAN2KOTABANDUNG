<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;

class DataGuruController extends Controller
{
    public function index()
    {
        $dataGuru = Admin::all();
        $pembelajaran = session('pembelajaran');

        if ($pembelajaran == 'Kimia') {
            $layout = 'layouts.dashboard-layouts';
        } elseif ($pembelajaran == 'Fisika') {
            $layout = 'layouts.dashboard-layouts-fisika';
        } elseif ($pembelajaran == 'Biologi') {
            $layout = 'layouts.dashboard-layouts-biologi';
        }
        return view('dataguru', compact('dataGuru', 'layout'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function add(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nip' => 'required',
            'kelamin' => 'required',
        ]);

        // Create a new InventarisasiAlat model instance
        Admin::create([
            'nama' => $request->nama,
            'nip' => $request->nip,
            'kelamin' => $request->kelamin,
        ]);

        return redirect()->route('data-guru.index')->with('success', 'Guru berhasil ditambahkan');
    }

    // Menampilkan form edit
    public function edit($id)
    {
        $struktur = Admin::findOrFail($id);
        return response()->json($struktur);
    }

    // Menyimpan perubahan
    public function update(Request $request, $id)
    {
        $guru = Admin::find($id);

        $guru->nip = $request->input('nip');
        $guru->nama = $request->input('nama');
        $guru->kelamin = $request->input('kelamin');
        $guru->save();

        return redirect()->route('data-guru.index')->with('success', 'Data guru berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $guru = Admin::find($id);

        $guru->delete();

        return redirect()->route('data-guru.index')->with('success', 'Data guru berhasil dihapus');
    }
}
