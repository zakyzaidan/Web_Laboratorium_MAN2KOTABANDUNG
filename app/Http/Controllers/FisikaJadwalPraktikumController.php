<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FisikaJadwalPraktikum;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;


class FisikaJadwalPraktikumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jadwalList = FisikaJadwalPraktikum::all();
        return view('Dashboard-Fisika/table_jadwal', compact('jadwalList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Dashboard-Fisika/table_jadwal');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'kelas' => 'required',
            'topik_praktikum' => 'required',
            'jadwal_praktikum' => 'required',
            'jadwal_jam_praktikum' => 'required|array',
        ]);
        
        $jadwalJamPelajaran = implode(',', $request->jadwal_jam_praktikum);

        // Create a new InventarisasiAlat model instance
        FisikaJadwalPraktikum::create([
            'nama' => $request->nama,
            'kelas' => $request->kelas,
            'topik_praktikum' => $request->topik_praktikum,
            'jadwal_praktikum' => $request->jadwal_praktikum,
            'jadwal_jam_praktikum' => $jadwalJamPelajaran,
        ]);

        return redirect()->route('jadwal.index')->with('success', 'Jadwal Praktikum berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $jadwal = FisikaJadwalPraktikum::find($id);
        return view('Dashboard-Fisika/table_jadwal', compact('jadwal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $jadwal = FisikaJadwalPraktikum::findOrFail($id);
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
        $jadwal = FisikaJadwalPraktikum::find($id);

    $jadwal->nama = $request->input('nama');
    $jadwal->kelas = $request->input('kelas');
    $jadwal->topik_praktikum = $request->input('topik_praktikum');
    $jadwal->jadwal_praktikum = $request->input('jadwal_praktikum');
    $jadwal->jadwal_jam_praktikum = $jadwalJamPelajaran;




    $jadwal->save();

    return redirect()->route('jadwal.index')->with('success', 'Jadwal Praktikum berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jadwal = FisikaJadwalPraktikum::find($id);

        $jadwal->delete();

        return redirect()->route('jadwal.index')->with('success', 'Jadwal Praktikum berhasil dihapus');
    }

    public function checkDate($jadwal_praktikum)
{
    try {
        $existingSchedules = FisikaJadwalPraktikum::where('jadwal_praktikum', $jadwal_praktikum)->get();
        $scheduleData = [];

        foreach ($existingSchedules as $schedule) {
            $jamPelajaran = explode(',', $schedule->jadwal_jam_praktikum);
            foreach ($jamPelajaran as $jam) {
                $scheduleData[$jam] = [
                    'nama' => $schedule->nama,
                    'kelas' => $schedule->kelas,
                    'topik_praktikum' => $schedule->topik_praktikum,
                ];
            }
        }

        return response()->json(['scheduleData' => $scheduleData]);
    } catch (\Exception $e) {
        return response()->json(['scheduleData' => []]);
    }
}




    // public function checkDate($jadwal_praktikum)
    // {
    //     try {
    //         $existingSchedules = JadwalPraktikum::where('jadwal_praktikum', $jadwal_praktikum)->get();
    //         $existingJamPelajaran = [];

    //         foreach ($existingSchedules as $schedule) {
    //             $existingJamPelajaran = array_merge($existingJamPelajaran, explode(',', $schedule->jadwal_jam_praktikum));
    //             $nama = $schedule->nama;
    //             $kelas = $schedule->kelas;
    //             $topik_praktikum = $schedule->topik_praktikum;
    //         }


            
    //         return response()->json(['jadwal_jam_praktikum' => $existingJamPelajaran, 'nama' => $nama, 'kelas' => $kelas, 'topik_praktikum' => $topik_praktikum]);
    //     } catch (\Exception $e) {
    //         return response()->json(['jadwal_jam_praktikum' => $existingJamPelajaran, 'nama' => '', 'kelas' => '', 'topik_praktikum' => '']);
    //     }
    // }


}
