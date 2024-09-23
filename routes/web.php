<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\InventarisasiAlatController;
use App\Http\Controllers\InventarisasiFasilitasController;
use App\Http\Controllers\InventarisasiBahanController;
use App\Http\Controllers\TenagaLaboratoriumController;
use App\Http\Controllers\JadwalPraktikumController;
use App\Http\Controllers\InventarisasiController;
use App\Http\Controllers\FisikaInventarisasiAlatController;
use App\Http\Controllers\FisikaInventarisasiFasilitasController;
use App\Http\Controllers\FisikaInventarisasiBahanController;
use App\Http\Controllers\FisikaTenagaLaboratoriumController;
use App\Http\Controllers\FisikaJadwalPraktikumController;
use App\Http\Controllers\FisikaInventarisasiController;
use App\Http\Controllers\BiologiInventarisasiAlatController;
use App\Http\Controllers\BiologiInventarisasiFasilitasController;
use App\Http\Controllers\BiologiInventarisasiBahanController;
use App\Http\Controllers\BiologiTenagaLaboratoriumController;
use App\Http\Controllers\BiologiJadwalPraktikumController;
use App\Http\Controllers\BiologiInventarisasiController;
use App\Http\Controllers\PilihLabolatoriumController;
use App\Http\Controllers\PeminjamanPihakLuarController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\BiologiPeminjamanPihakLuarController;
use App\Http\Controllers\FisikaPeminjamanPihakLuarController;
use App\Http\Controllers\StrukturOrganisasiController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Materi;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [LandingController::class, 'index']);

Route::get('/home',[LandingController::class, 'index'])->name('home');

Route::get('/login', function () {
    return view('login');
});

Route::get('/pilih-pembelajaran/{pelajaran}', [KelasController::class,'setpembelajaranSession'])->middleware('auth');
Route::get('/pilih-dashboard/{pelajaran}', [PilihLabolatoriumController::class,'setpembelajaranSession'])->middleware('auth');

Route::get('/pilih-kelas', function () {

    return view('kelaspage');
})->middleware('auth');

Route::get('/struktur-organisasi', [StrukturOrganisasiController::class, 'index'])->name('struktur-organisasi.index');
Route::get('/struktur-organisasi/edit/{id}', [StrukturOrganisasiController::class, 'edit'])->name('struktur-organisasi.edit');
Route::put('/struktur-organisasi/update/{id}', [StrukturOrganisasiController::class, 'update'])->name('struktur-organisasi.update');

Route::get('/pilih-labolatorium', [PilihLabolatoriumController::class, 'index'])->middleware(['auth', 'checkUserType:guru'])->name('pilih-labolatorium');
Route::get('/Dashboard-inventaris', [InventarisasiController::class, 'index'])->middleware(['auth', 'checkUserType:guru']);

Route::prefix('/inventarisasi-alat')->middleware(['auth', 'checkUserType:guru'])->group(function () {
    Route::get('/', [InventarisasiAlatController::class, 'index'])->name('alat.index'); // List of tools
    Route::get('/create', [InventarisasiAlatController::class, 'create'])->name('alat.create'); // Create tool form
    Route::post('/', [InventarisasiAlatController::class, 'store'])->name('alat.store.kimia'); // Store new tool
    Route::get('/{id}', [InventarisasiAlatController::class, 'show'])->name('alat.show.kimia'); // Show tool detail
    Route::get('/{id}/edit', [InventarisasiAlatController::class, 'edit'])->name('alat.edit'); // Edit tool form
    Route::put('/{id}', [InventarisasiAlatController::class, 'update'])->name('alat.update'); // Update tool
    Route::delete('/{id}', [InventarisasiAlatController::class, 'destroy'])->name('alat.destroy'); // Delete tool
});

Route::prefix('inventarisasi-fasilitas')->middleware(['auth', 'checkUserType:guru'])->group(function () {
    Route::get('/', [InventarisasiFasilitasController::class, 'index'])->name('fasilitas.index'); // List of tools
    Route::get('/create', [InventarisasiFasilitasController::class, 'create'])->name('fasilitas.create'); // Create tool form
    Route::post('/', [InventarisasiFasilitasController::class, 'store'])->name('fasilitas.store.kimia'); // Store new tool
    Route::get('/{id}', [InventarisasiFasilitasController::class, 'show'])->name('fasilitas.show'); // Show tool detail
    Route::get('/{id}/edit', [InventarisasiFasilitasController::class, 'edit'])->name('fasilitas.edit'); // Edit tool form
    Route::put('/{id}', [InventarisasiFasilitasController::class, 'update'])->name('fasilitas.update'); // Update tool
    Route::delete('/{id}', [InventarisasiFasilitasController::class, 'destroy'])->name('fasilitas.destroy'); // Delete tool
});

Route::prefix('/inventarisasi-bahan')->middleware(['auth', 'checkUserType:guru'])->group(function () {
    Route::get('/', [InventarisasiBahanController::class, 'index'])->name('bahan.index'); // List of tools
    Route::get('/create', [InventarisasiBahanController::class, 'create'])->name('bahan.create'); // Create tool form
    Route::post('/', [InventarisasiBahanController::class, 'store'])->name('bahan.storekimia'); // Store new tool
    Route::get('/{id}', [InventarisasiBahanController::class, 'show'])->name('bahan.show.kimia'); // Show tool detail
    Route::get('/{id}/edit', [InventarisasiBahanController::class, 'edit'])->name('bahan.edit'); // Edit tool form
    Route::put('/{id}', [InventarisasiBahanController::class, 'update'])->name('bahan.update'); // Update tool
    Route::delete('/{id}', [InventarisasiBahanController::class, 'destroy'])->name('bahan.destroy'); // Delete tool
});

Route::prefix('peminjaman-pihak-luar')->middleware(['auth', 'checkUserType:guru'])->group(function () {
    Route::get('/', [PeminjamanPihakLuarController::class, 'index'])->name('peminjaman.index'); // List of tools
    Route::get('/create', [PeminjamanPihakLuarController::class, 'create'])->name('peminjaman.create'); // Create tool form
    Route::post('/', [PeminjamanPihakLuarController::class, 'store'])->name('peminjaman.store.kimia'); // Store new tool
    Route::get('/{id}', [PeminjamanPihakLuarController::class, 'show'])->name('peminjaman.show.kimia'); // Show tool detail
    Route::get('/{id}/edit', [PeminjamanPihakLuarController::class, 'edit'])->name('peminjaman.edit'); // Edit tool form
    Route::put('/{id}', [PeminjamanPihakLuarController::class, 'update'])->name('peminjaman.update'); // Update tool
    Route::delete('/{id}', [PeminjamanPihakLuarController::class, 'destroy'])->name('peminjaman.destroy'); // Delete tool
});

Route::prefix('tenaga-laboratorium')->middleware(['auth', 'checkUserType:guru'])->group(function () {
    Route::get('/', [TenagaLaboratoriumController::class, 'index'])->name('tenaga.index'); // List of tools
    Route::get('/create', [TenagaLaboratoriumController::class, 'create'])->name('tenaga.create'); // Create tool form
    Route::post('/', [TenagaLaboratoriumController::class, 'store'])->name('tenaga.store.kimia'); // Store new tool
    Route::get('/{id}', [TenagaLaboratoriumController::class, 'show'])->name('tenaga.show'); // Show tool detail
    Route::get('/{id}/edit', [TenagaLaboratoriumController::class, 'edit'])->name('tenaga.edit'); // Edit tool form
    Route::put('/{id}', [TenagaLaboratoriumController::class, 'update'])->name('tenaga.update'); // Update tool
    Route::delete('/{id}', [TenagaLaboratoriumController::class, 'destroy'])->name('tenaga.destroy'); // Delete tool
});
Route::get('/jadwal-praktikum/check-date/{jadwal_praktikum}', [JadwalPraktikumController::class, 'checkDate']);


Route::prefix('jadwal-praktikum')->middleware(['auth', 'checkUserType:guru'])->group(function () {
    Route::get('/', [JadwalPraktikumController::class, 'index'])->name('jadwal.index'); // List of tools
    Route::get('/create', [JadwalPraktikumController::class, 'create'])->name('jadwal.create'); // Create tool form
    Route::post('/', [JadwalPraktikumController::class, 'store'])->name('jadwal.store.kimia'); // Store new tool
    Route::get('/{id}', [JadwalPraktikumController::class, 'show'])->name('jadwal.show'); // Show tool detail
    Route::get('/{id}/edit', [JadwalPraktikumController::class, 'edit'])->name('jadwal.edit'); // Edit tool form
    Route::put('/{id}', [JadwalPraktikumController::class, 'update'])->name('jadwal.update'); // Update tool
    Route::delete('/{id}', [JadwalPraktikumController::class, 'destroy'])->name('jadwal.destroy'); // Delete tool
});

Route::get('/Dashboard-inventaris-fisika', [FisikaInventarisasiController::class, 'index'])->middleware(['auth', 'checkUserType:guru']);

Route::prefix('inventarisasi-alat-fisika')->middleware(['auth', 'checkUserType:guru'])->group(function () {
    Route::get('/', [FisikaInventarisasiAlatController::class, 'index'])->name('alat.index'); // List of tools
    Route::get('/create', [FisikaInventarisasiAlatController::class, 'create'])->name('alat.create'); // Create tool form
    Route::post('/', [FisikaInventarisasiAlatController::class, 'store'])->name('alat.store.fisika'); // Store new tool
    Route::get('/{id}', [FisikaInventarisasiAlatController::class, 'show'])->name('alat.show.fisika'); // Show tool detail
    Route::get('/{id}/edit', [FisikaInventarisasiAlatController::class, 'edit'])->name('alat.edit'); // Edit tool form
    Route::put('/{id}', [FisikaInventarisasiAlatController::class, 'update'])->name('alat.update'); // Update tool
    Route::delete('/{id}', [FisikaInventarisasiAlatController::class, 'destroy'])->name('alat.destroy'); // Delete tool
});

Route::prefix('inventarisasi-fasilitas-fisika')->middleware(['auth', 'checkUserType:guru'])->group(function () {
    Route::get('/', [FisikaInventarisasiFasilitasController::class, 'index'])->name('fasilitas.index'); // List of tools
    Route::get('/create', [FisikaInventarisasiFasilitasController::class, 'create'])->name('fasilitas.create'); // Create tool form
    Route::post('/', [FisikaInventarisasiFasilitasController::class, 'store'])->name('fasilitas.store.fisika'); // Store new tool
    Route::get('/{id}', [FisikaInventarisasiFasilitasController::class, 'show'])->name('fasilitas.show'); // Show tool detail
    Route::get('/{id}/edit', [FisikaInventarisasiFasilitasController::class, 'edit'])->name('fasilitas.edit'); // Edit tool form
    Route::put('/{id}', [FisikaInventarisasiFasilitasController::class, 'update'])->name('fasilitas.update'); // Update tool
    Route::delete('/{id}', [FisikaInventarisasiFasilitasController::class, 'destroy'])->name('fasilitas.destroy'); // Delete tool
});

Route::prefix('inventarisasi-bahan-fisika')->middleware(['auth', 'checkUserType:guru'])->group(function () {
    Route::get('/', [FisikaInventarisasiBahanController::class, 'index'])->name('bahan.index'); // List of tools
    Route::get('/create', [FisikaInventarisasiBahanController::class, 'create'])->name('bahan.create'); // Create tool form
    Route::post('/', [FisikaInventarisasiBahanController::class, 'store'])->name('bahan.store.fisika'); // Store new tool
    Route::get('/{id}', [FisikaInventarisasiBahanController::class, 'show'])->name('bahan.show.fisika'); // Show tool detail
    Route::get('/{id}/edit', [FisikaInventarisasiBahanController::class, 'edit'])->name('bahan.edit'); // Edit tool form
    Route::put('/{id}', [FisikaInventarisasiBahanController::class, 'update'])->name('bahan.update'); // Update tool
    Route::delete('/{id}', [FisikaInventarisasiBahanController::class, 'destroy'])->name('bahan.destroy'); // Delete tool
});

Route::prefix('peminjaman-pihak-luar-fisika')->middleware(['auth', 'checkUserType:guru'])->group(function () {
    Route::get('/', [FisikaPeminjamanPihakLuarController::class, 'index'])->name('peminjaman.index'); // List of tools
    Route::get('/create', [FisikaPeminjamanPihakLuarController::class, 'create'])->name('peminjaman.create'); // Create tool form
    Route::post('/', [FisikaPeminjamanPihakLuarController::class, 'store'])->name('peminjaman.store.fisika'); // Store new tool
    Route::get('/{id}', [FisikaPeminjamanPihakLuarController::class, 'show'])->name('peminjaman.show.fisika'); // Show tool detail
    Route::get('/{id}/edit', [FisikaPeminjamanPihakLuarController::class, 'edit'])->name('peminjaman.edit'); // Edit tool form
    Route::put('/{id}', [FisikaPeminjamanPihakLuarController::class, 'update'])->name('peminjaman.update'); // Update tool
    Route::delete('/{id}', [FisikaPeminjamanPihakLuarController::class, 'destroy'])->name('peminjaman.destroy'); // Delete tool
});

Route::prefix('tenaga-laboratorium-fisika')->middleware(['auth', 'checkUserType:guru'])->group(function () {
    Route::get('/', [FisikaTenagaLaboratoriumController::class, 'index'])->name('tenaga.index'); // List of tools
    Route::get('/create', [FisikaTenagaLaboratoriumController::class, 'create'])->name('tenaga.create'); // Create tool form
    Route::post('/', [FisikaTenagaLaboratoriumController::class, 'store'])->name('tenaga.store.fisika'); // Store new tool
    Route::get('/{id}', [FisikaTenagaLaboratoriumController::class, 'show'])->name('tenaga.show'); // Show tool detail
    Route::get('/{id}/edit', [FisikaTenagaLaboratoriumController::class, 'edit'])->name('tenaga.edit'); // Edit tool form
    Route::put('/{id}', [FisikaTenagaLaboratoriumController::class, 'update'])->name('tenaga.update'); // Update tool
    Route::delete('/{id}', [FisikaTenagaLaboratoriumController::class, 'destroy'])->name('tenaga.destroy'); // Delete tool
});
Route::get('/jadwal-praktikum-fisika/check-date/{jadwal_praktikum}', [FisikaJadwalPraktikumController::class, 'checkDate']);
// API route untuk mendapatkan alat berdasarkan materi
Route::get('/jadwal-praktikum-fisika/materi/{materi}/alat', [FisikaJadwalPraktikumController::class, 'getAlatByMateri']);
Route::get('/jadwal-praktikum-biologi/materi/{materi}/alat', [BiologiJadwalPraktikumController::class, 'getAlatByMateri']);
Route::get('/jadwal-praktikum-kimia/materi/{materi}/alat', [JadwalPraktikumController::class, 'getAlatByMateri']);

Route::prefix('jadwal-praktikum-fisika')->middleware(['auth', 'checkUserType:guru'])->group(function () {
    Route::get('/', [FisikaJadwalPraktikumController::class, 'index'])->name('jadwal.index'); // List of tools
    Route::get('/create', [FisikaJadwalPraktikumController::class, 'create'])->name('jadwal.create'); // Create tool form
    Route::post('/', [FisikaJadwalPraktikumController::class, 'store'])->name('jadwal.store.fisika'); // Store new tool
    Route::get('/{id}', [FisikaJadwalPraktikumController::class, 'show'])->name('jadwal.show'); // Show tool detail
    Route::get('/{id}/edit', [FisikaJadwalPraktikumController::class, 'edit'])->name('jadwal.edit'); // Edit tool form
    Route::put('/{id}', [FisikaJadwalPraktikumController::class, 'update'])->name('jadwal.update'); // Update tool
    Route::delete('/{id}', [FisikaJadwalPraktikumController::class, 'destroy'])->name('jadwal.destroy'); // Delete tool
});



Route::get('/Dashboard-inventaris-biologi', [BiologiInventarisasiController::class, 'index'])->middleware(['auth', 'checkUserType:guru']);

Route::prefix('inventarisasi-alat-biologi')->middleware(['auth', 'checkUserType:guru'])->group(function () {
    Route::get('/', [BiologiInventarisasiAlatController::class, 'index'])->name('alat.index'); // List of tools
    Route::get('/create', [BiologiInventarisasiAlatController::class, 'create'])->name('alat.create'); // Create tool form
    Route::post('/', [BiologiInventarisasiAlatController::class, 'store'])->name('alat.store'); // Store new tool
    Route::get('/{id}', [BiologiInventarisasiAlatController::class, 'show'])->name('alat.show.biologi'); // Show tool detail
    Route::get('/{id}/edit', [BiologiInventarisasiAlatController::class, 'edit'])->name('alat.edit'); // Edit tool form
    Route::put('/{id}', [BiologiInventarisasiAlatController::class, 'update'])->name('alat.update'); // Update tool
    Route::delete('/{id}', [BiologiInventarisasiAlatController::class, 'destroy'])->name('alat.destroy'); // Delete tool
});

Route::prefix('inventarisasi-fasilitas-biologi')->middleware(['auth', 'checkUserType:guru'])->group(function () {
    Route::get('/', [BiologiInventarisasiFasilitasController::class, 'index'])->name('fasilitas.index'); // List of tools
    Route::get('/create', [BiologiInventarisasiFasilitasController::class, 'create'])->name('fasilitas.create'); // Create tool form
    Route::post('/', [BiologiInventarisasiFasilitasController::class, 'store'])->name('fasilitas.store'); // Store new tool
    Route::get('/{id}', [BiologiInventarisasiFasilitasController::class, 'show'])->name('fasilitas.show'); // Show tool detail
    Route::get('/{id}/edit', [BiologiInventarisasiFasilitasController::class, 'edit'])->name('fasilitas.edit'); // Edit tool form
    Route::put('/{id}', [BiologiInventarisasiFasilitasController::class, 'update'])->name('fasilitas.update'); // Update tool
    Route::delete('/{id}', [BiologiInventarisasiFasilitasController::class, 'destroy'])->name('fasilitas.destroy'); // Delete tool
});

Route::prefix('inventarisasi-bahan-biologi')->middleware(['auth', 'checkUserType:guru'])->group(function () {
    Route::get('/', [BiologiInventarisasiBahanController::class, 'index'])->name('bahan.index'); // List of tools
    Route::get('/create', [BiologiInventarisasiBahanController::class, 'create'])->name('bahan.create'); // Create tool form
    Route::post('/', [BiologiInventarisasiBahanController::class, 'store'])->name('bahan.store'); // Store new tool
    Route::get('/{id}', [BiologiInventarisasiBahanController::class, 'show'])->name('bahan.show.biologi'); // Show tool detail
    Route::get('/{id}/edit', [BiologiInventarisasiBahanController::class, 'edit'])->name('bahan.edit'); // Edit tool form
    Route::put('/{id}', [BiologiInventarisasiBahanController::class, 'update'])->name('bahan.update'); // Update tool
    Route::delete('/{id}', [BiologiInventarisasiBahanController::class, 'destroy'])->name('bahan.destroy'); // Delete tool
});

Route::prefix('peminjaman-pihak-luar-biologi')->middleware(['auth', 'checkUserType:guru'])->group(function () {
    Route::get('/', [BiologiPeminjamanPihakLuarController::class, 'index'])->name('peminjaman.index'); // List of tools
    Route::get('/create', [BiologiPeminjamanPihakLuarController::class, 'create'])->name('peminjaman.create'); // Create tool form
    Route::post('/', [BiologiPeminjamanPihakLuarController::class, 'store'])->name('peminjaman.store.biologi'); // Store new tool
    Route::get('/{id}', [BiologiPeminjamanPihakLuarController::class, 'show'])->name('peminjaman.show.biologi'); // Show tool detail
    Route::get('/{id}/edit', [BiologiPeminjamanPihakLuarController::class, 'edit'])->name('peminjaman.edit'); // Edit tool form
    Route::put('/{id}', [BiologiPeminjamanPihakLuarController::class, 'update'])->name('peminjaman.update'); // Update tool
    Route::delete('/{id}', [BiologiPeminjamanPihakLuarController::class, 'destroy'])->name('peminjaman.destroy'); // Delete tool
});

Route::prefix('tenaga-laboratorium-biologi')->middleware(['auth', 'checkUserType:guru'])->group(function () {
    Route::get('/', [BiologiTenagaLaboratoriumController::class, 'index'])->name('tenaga.index'); // List of tools
    Route::get('/create', [BiologiTenagaLaboratoriumController::class, 'create'])->name('tenaga.create'); // Create tool form
    Route::post('/', [BiologiTenagaLaboratoriumController::class, 'store'])->name('tenaga.store'); // Store new tool
    Route::get('/{id}', [BiologiTenagaLaboratoriumController::class, 'show'])->name('tenaga.show'); // Show tool detail
    Route::get('/{id}/edit', [BiologiTenagaLaboratoriumController::class, 'edit'])->name('tenaga.edit'); // Edit tool form
    Route::put('/{id}', [BiologiTenagaLaboratoriumController::class, 'update'])->name('tenaga.update'); // Update tool
    Route::delete('/{id}', [BiologiTenagaLaboratoriumController::class, 'destroy'])->name('tenaga.destroy'); // Delete tool
});
Route::get('/jadwal-praktikum-biologi/check-date/{jadwal_praktikum}', [BiologiJadwalPraktikumController::class, 'checkDate']);


Route::prefix('jadwal-praktikum-biologi')->middleware(['auth', 'checkUserType:guru'])->group(function () {
    Route::get('/', [BiologiJadwalPraktikumController::class, 'index'])->name('jadwal.index'); // List of tools
    Route::get('/create', [BiologiJadwalPraktikumController::class, 'create'])->name('jadwal.create'); // Create tool form
    Route::post('/', [BiologiJadwalPraktikumController::class, 'store'])->name('jadwal.store'); // Store new tool
    Route::get('/{id}', [BiologiJadwalPraktikumController::class, 'show'])->name('jadwal.show'); // Show tool detail
    Route::get('/{id}/edit', [BiologiJadwalPraktikumController::class, 'edit'])->name('jadwal.edit'); // Edit tool form
    Route::put('/{id}', [BiologiJadwalPraktikumController::class, 'update'])->name('jadwal.update'); // Update tool
    Route::delete('/{id}', [BiologiJadwalPraktikumController::class, 'destroy'])->name('jadwal.destroy'); // Delete tool
});


Route::get('/pilih-kelas/{kelas}', [KelasController::class,'setKelasSession'])->middleware('auth');
Route::post('/materi-kelas-page/delete', [MateriController::class,'destroy'])->middleware('auth');
Route::get('/mengambil-data/{id}', [MateriController::class,'show'])->middleware('auth');
Route::put('/materi-kelas-page/update/{id}', [MateriController::class,'update'])->middleware('auth');

Route::get('/materi/{id}', function ($id) {
    $materi = Materi::find($id);
    if(session('pembelajaran') == "Fisika"){
        $alat = $materi->fisika_alat()->get();
    }else if(session('pembelajaran') == "Biologi"){
        $alat = $materi->biologi_alat()->get();
    }else if(session('pembelajaran') == "Kimia"){
        $alat = $materi->kimia_alat()->get();
        $bahan = $materi->kimia_bahan()->get();
        return view('materi', compact('materi', 'alat', 'bahan'));
    }
    //dd($alat);
    return view('materi', compact('materi', 'alat'));
})->middleware('auth');
Route::post('/materi-kelas-page/add', [MateriController::class,'store'])->middleware('auth');
Route::get('/materi-kelas-page', [MateriController::class,'index'])->middleware('auth');




Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth'])->group(function () {
    Route::get('/pilih-kelas', function () {
        
        $username = session('username');
        $user_type = session('user_type');
        return view('kelaspage', compact('username', 'user_type'));
    });

    // tambahkan route lain yang memerlukan autentikasi di sini
})->middleware('auth');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/foo', function () {
    Artisan::call('storage:link');
})->middleware('auth');
