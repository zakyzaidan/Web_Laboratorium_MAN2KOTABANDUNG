<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JadwalPraktikum;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;


class JadwalPraktikumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jadwalList = JadwalPraktikum::all();
        return view('Dashboard/table_jadwal', compact('jadwalList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Dashboard/table_jadwal');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'mata_pelajaran' => 'required',
            'topik_praktikum' => 'required',
            'jadwal_praktikum' => 'required',
            'laboratorium' => 'required',
            'jadwal_jam_praktikum' => 'required|array',
        ]);
        
        $jadwalJamPelajaran = implode(',', $request->jadwal_jam_praktikum);

        // Create a new InventarisasiAlat model instance
        JadwalPraktikum::create([
            'nama' => $request->nama,
            'mata_pelajaran' => $request->mata_pelajaran,
            'topik_praktikum' => $request->topik_praktikum,
            'jadwal_praktikum' => $request->jadwal_praktikum,
            'laboratorium' => $request->laboratorium,
            'jadwal_jam_praktikum' => $jadwalJamPelajaran,
        ]);

        return redirect()->route('jadwal.index')->with('success', 'Jadwal Praktikum berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $jadwal = JadwalPraktikum::find($id);
        return view('Dashboard/table_jadwal', compact('jadwal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $jadwal = JadwalPraktikum::findOrFail($id);
            $jadwal->jadwal_jam_praktikum = explode(',', $jadwal->jadwal_jam_praktikum);
            return response()->json($jadwal);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {


        $jadwalJamPelajaran = implode(',', $request->jadwal_jam_praktikum);
        $jadwal = JadwalPraktikum::find($id);

    $jadwal->nama = $request->input('nama');
    $jadwal->mata_pelajaran = $request->input('mata_pelajaran');
    $jadwal->topik_praktikum = $request->input('topik_praktikum');
    $jadwal->jadwal_praktikum = $request->input('jadwal_praktikum');
    $jadwal->laboratorium = $request->input('laboratorium');
    $jadwal->jadwal_jam_praktikum = $jadwalJamPelajaran;




    $jadwal->save();

    return redirect()->route('jadwal.index')->with('success', 'Jadwal Praktikum berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jadwal = JadwalPraktikum::find($id);

        $jadwal->delete();

        return redirect()->route('jadwal.index')->with('success', 'Jadwal Praktikum berhasil dihapus');
    }

    public function checkTimeSlot(Request $request)
    {
        $jadwalPraktikum = $request->jadwal_praktikum;
        $jadwalJamPelajaran = JadwalPraktikum::where('jadwal_praktikum', $jadwalPraktikum)->pluck('jadwal_jam_praktikum');

        $existingSlots = [];
        foreach ($jadwalJamPelajaran as $jamPelajaran) {
            $slots = explode(',', $jamPelajaran);
            $existingSlots = array_merge($existingSlots, $slots);
        }

        return response()->json($existingSlots);
    }

    public function checkDate($jadwal_praktikum)
{
    try {
        $existingSchedules = JadwalPraktikum::where('jadwal_praktikum', $jadwal_praktikum)->get();
        $existingJamPelajaran = [];

        foreach ($existingSchedules as $schedule) {
            $existingJamPelajaran = array_merge($existingJamPelajaran, explode(',', $schedule->jadwal_jam_praktikum));
        }

        return response()->json(['jadwal_jam_praktikum' => $existingJamPelajaran]);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}


    // public function checkDate($jadwal_praktikum)
    // {
    //     try {
    //         // Cek apakah tanggal tersebut ada di database
    //         $exists = JadwalPraktikum::where('jadwal_praktikum', $jadwal_praktikum)->exists();

    //         // Mengembalikan respons dalam format JSON
    //         return response()->json(['exists' => $exists]);
    //     } catch (\Exception $e) {
    //         return response()->json(['error' => $e->getMessage()], 500);
    //     }
    // }

}
