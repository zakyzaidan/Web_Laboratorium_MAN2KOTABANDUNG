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

Route::get('/', function () {
    return view('landing');
});

Route::get('/home', function () {
    $username = session('username');
    $user_type = session('user_type');

    // Sekarang Anda bisa menggunakan $username dan $user_type
    // Misalnya, Anda bisa mengirimkannya ke view
    return view('landing', compact('username', 'user_type'));
})->name('home');

Route::get('/login', function () {
    return view('login');
});

Route::get('/pilih-pembelajaran/{pelajaran}', [KelasController::class,'setpembelajaranSession'])->middleware('auth');

Route::get('/pilih-kelas', function () {
    $username = session('username');
    $user_type = session('user_type');
    return view('kelaspage', compact('username', 'user_type'));
})->middleware('auth');


Route::get('/pilih-labolatorium', [PilihLabolatoriumController::class, 'index'])->middleware(['auth', 'checkUserType:guru'])->name('pilih-labolatorium');
Route::get('/Dashboard-inventaris', [InventarisasiController::class, 'index'])->middleware(['auth', 'checkUserType:guru']);

Route::prefix('inventarisasi-alat')->middleware(['auth', 'checkUserType:guru'])->group(function () {
    Route::get('/', [InventarisasiAlatController::class, 'index'])->name('alat.index'); // List of tools
    Route::get('/create', [InventarisasiAlatController::class, 'create'])->name('alat.create'); // Create tool form
    Route::post('/', [InventarisasiAlatController::class, 'store'])->name('alat.store'); // Store new tool
    Route::get('/{id}', [InventarisasiAlatController::class, 'show'])->name('alat.show'); // Show tool detail
    Route::get('/{id}/edit', [InventarisasiAlatController::class, 'edit'])->name('alat.edit'); // Edit tool form
    Route::put('/{id}', [InventarisasiAlatController::class, 'update'])->name('alat.update'); // Update tool
    Route::delete('/{id}', [InventarisasiAlatController::class, 'destroy'])->name('alat.destroy'); // Delete tool
});

Route::prefix('inventarisasi-fasilitas')->middleware(['auth', 'checkUserType:guru'])->group(function () {
    Route::get('/', [InventarisasiFasilitasController::class, 'index'])->name('fasilitas.index'); // List of tools
    Route::get('/create', [InventarisasiFasilitasController::class, 'create'])->name('fasilitas.create'); // Create tool form
    Route::post('/', [InventarisasiFasilitasController::class, 'store'])->name('fasilitas.store'); // Store new tool
    Route::get('/{id}', [InventarisasiFasilitasController::class, 'show'])->name('fasilitas.show'); // Show tool detail
    Route::get('/{id}/edit', [InventarisasiFasilitasController::class, 'edit'])->name('fasilitas.edit'); // Edit tool form
    Route::put('/{id}', [InventarisasiFasilitasController::class, 'update'])->name('fasilitas.update'); // Update tool
    Route::delete('/{id}', [InventarisasiFasilitasController::class, 'destroy'])->name('fasilitas.destroy'); // Delete tool
});

Route::prefix('inventarisasi-bahan')->middleware(['auth', 'checkUserType:guru'])->group(function () {
    Route::get('/', [InventarisasiBahanController::class, 'index'])->name('bahan.index'); // List of tools
    Route::get('/create', [InventarisasiBahanController::class, 'create'])->name('bahan.create'); // Create tool form
    Route::post('/', [InventarisasiBahanController::class, 'store'])->name('bahan.store'); // Store new tool
    Route::get('/{id}', [InventarisasiBahanController::class, 'show'])->name('bahan.show'); // Show tool detail
    Route::get('/{id}/edit', [InventarisasiBahanController::class, 'edit'])->name('bahan.edit'); // Edit tool form
    Route::put('/{id}', [InventarisasiBahanController::class, 'update'])->name('bahan.update'); // Update tool
    Route::delete('/{id}', [InventarisasiBahanController::class, 'destroy'])->name('bahan.destroy'); // Delete tool
});

Route::prefix('tenaga-laboratorium')->middleware(['auth', 'checkUserType:guru'])->group(function () {
    Route::get('/', [TenagaLaboratoriumController::class, 'index'])->name('tenaga.index'); // List of tools
    Route::get('/create', [TenagaLaboratoriumController::class, 'create'])->name('tenaga.create'); // Create tool form
    Route::post('/', [TenagaLaboratoriumController::class, 'store'])->name('tenaga.store'); // Store new tool
    Route::get('/{id}', [TenagaLaboratoriumController::class, 'show'])->name('tenaga.show'); // Show tool detail
    Route::get('/{id}/edit', [TenagaLaboratoriumController::class, 'edit'])->name('tenaga.edit'); // Edit tool form
    Route::put('/{id}', [TenagaLaboratoriumController::class, 'update'])->name('tenaga.update'); // Update tool
    Route::delete('/{id}', [TenagaLaboratoriumController::class, 'destroy'])->name('tenaga.destroy'); // Delete tool
});
Route::get('/jadwal-praktikum/check-date/{jadwal_praktikum}', [JadwalPraktikumController::class, 'checkDate']);


Route::prefix('jadwal-praktikum')->middleware(['auth', 'checkUserType:guru'])->group(function () {
    Route::get('/', [JadwalPraktikumController::class, 'index'])->name('jadwal.index'); // List of tools
    Route::get('/create', [JadwalPraktikumController::class, 'create'])->name('jadwal.create'); // Create tool form
    Route::post('/', [JadwalPraktikumController::class, 'store'])->name('jadwal.store'); // Store new tool
    Route::get('/{id}', [JadwalPraktikumController::class, 'show'])->name('jadwal.show'); // Show tool detail
    Route::get('/{id}/edit', [JadwalPraktikumController::class, 'edit'])->name('jadwal.edit'); // Edit tool form
    Route::put('/{id}', [JadwalPraktikumController::class, 'update'])->name('jadwal.update'); // Update tool
    Route::delete('/{id}', [JadwalPraktikumController::class, 'destroy'])->name('jadwal.destroy'); // Delete tool
});

Route::get('/Dashboard-inventaris-fisika', [FisikaInventarisasiController::class, 'index'])->middleware(['auth', 'checkUserType:guru']);

Route::prefix('inventarisasi-alat-fisika')->middleware(['auth', 'checkUserType:guru'])->group(function () {
    Route::get('/', [FisikaInventarisasiAlatController::class, 'index'])->name('alat.index'); // List of tools
    Route::get('/create', [FisikaInventarisasiAlatController::class, 'create'])->name('alat.create'); // Create tool form
    Route::post('/', [FisikaInventarisasiAlatController::class, 'store'])->name('alat.store'); // Store new tool
    Route::get('/{id}', [FisikaInventarisasiAlatController::class, 'show'])->name('alat.show'); // Show tool detail
    Route::get('/{id}/edit', [FisikaInventarisasiAlatController::class, 'edit'])->name('alat.edit'); // Edit tool form
    Route::put('/{id}', [FisikaInventarisasiAlatController::class, 'update'])->name('alat.update'); // Update tool
    Route::delete('/{id}', [FisikaInventarisasiAlatController::class, 'destroy'])->name('alat.destroy'); // Delete tool
});

Route::prefix('inventarisasi-fasilitas-fisika')->middleware(['auth', 'checkUserType:guru'])->group(function () {
    Route::get('/', [FisikaInventarisasiFasilitasController::class, 'index'])->name('fasilitas.index'); // List of tools
    Route::get('/create', [FisikaInventarisasiFasilitasController::class, 'create'])->name('fasilitas.create'); // Create tool form
    Route::post('/', [FisikaInventarisasiFasilitasController::class, 'store'])->name('fasilitas.store'); // Store new tool
    Route::get('/{id}', [FisikaInventarisasiFasilitasController::class, 'show'])->name('fasilitas.show'); // Show tool detail
    Route::get('/{id}/edit', [FisikaInventarisasiFasilitasController::class, 'edit'])->name('fasilitas.edit'); // Edit tool form
    Route::put('/{id}', [FisikaInventarisasiFasilitasController::class, 'update'])->name('fasilitas.update'); // Update tool
    Route::delete('/{id}', [FisikaInventarisasiFasilitasController::class, 'destroy'])->name('fasilitas.destroy'); // Delete tool
});

Route::prefix('inventarisasi-bahan-fisika')->middleware(['auth', 'checkUserType:guru'])->group(function () {
    Route::get('/', [FisikaInventarisasiBahanController::class, 'index'])->name('bahan.index'); // List of tools
    Route::get('/create', [FisikaInventarisasiBahanController::class, 'create'])->name('bahan.create'); // Create tool form
    Route::post('/', [FisikaInventarisasiBahanController::class, 'store'])->name('bahan.store'); // Store new tool
    Route::get('/{id}', [FisikaInventarisasiBahanController::class, 'show'])->name('bahan.show'); // Show tool detail
    Route::get('/{id}/edit', [FisikaInventarisasiBahanController::class, 'edit'])->name('bahan.edit'); // Edit tool form
    Route::put('/{id}', [FisikaInventarisasiBahanController::class, 'update'])->name('bahan.update'); // Update tool
    Route::delete('/{id}', [FisikaInventarisasiBahanController::class, 'destroy'])->name('bahan.destroy'); // Delete tool
});

Route::prefix('tenaga-laboratorium-fisika')->middleware(['auth', 'checkUserType:guru'])->group(function () {
    Route::get('/', [FisikaTenagaLaboratoriumController::class, 'index'])->name('tenaga.index'); // List of tools
    Route::get('/create', [FisikaTenagaLaboratoriumController::class, 'create'])->name('tenaga.create'); // Create tool form
    Route::post('/', [FisikaTenagaLaboratoriumController::class, 'store'])->name('tenaga.store'); // Store new tool
    Route::get('/{id}', [FisikaTenagaLaboratoriumController::class, 'show'])->name('tenaga.show'); // Show tool detail
    Route::get('/{id}/edit', [FisikaTenagaLaboratoriumController::class, 'edit'])->name('tenaga.edit'); // Edit tool form
    Route::put('/{id}', [FisikaTenagaLaboratoriumController::class, 'update'])->name('tenaga.update'); // Update tool
    Route::delete('/{id}', [FisikaTenagaLaboratoriumController::class, 'destroy'])->name('tenaga.destroy'); // Delete tool
});
Route::get('/jadwal-praktikum-fisika/check-date/{jadwal_praktikum}', [FisikaJadwalPraktikumController::class, 'checkDate']);


Route::prefix('jadwal-praktikum-fisika')->middleware(['auth', 'checkUserType:guru'])->group(function () {
    Route::get('/', [FisikaJadwalPraktikumController::class, 'index'])->name('jadwal.index'); // List of tools
    Route::get('/create', [FisikaJadwalPraktikumController::class, 'create'])->name('jadwal.create'); // Create tool form
    Route::post('/', [FisikaJadwalPraktikumController::class, 'store'])->name('jadwal.store'); // Store new tool
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
    Route::get('/{id}', [BiologiInventarisasiAlatController::class, 'show'])->name('alat.show'); // Show tool detail
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
    Route::get('/{id}', [BiologiInventarisasiBahanController::class, 'show'])->name('bahan.show'); // Show tool detail
    Route::get('/{id}/edit', [BiologiInventarisasiBahanController::class, 'edit'])->name('bahan.edit'); // Edit tool form
    Route::put('/{id}', [BiologiInventarisasiBahanController::class, 'update'])->name('bahan.update'); // Update tool
    Route::delete('/{id}', [BiologiInventarisasiBahanController::class, 'destroy'])->name('bahan.destroy'); // Delete tool
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
    return view('materi', compact('materi'));
})->middleware('auth');
Route::post('/materi-kelas-page/add', [MateriController::class,'store'])->middleware('auth');
Route::get('/materi-kelas-page', function (Request $request) {

    $username = session('username');
    $user_type = session('user_type');
    $materi = Materi::paginate(6);

    if ($user_type == 'guru') {
        return view('materikelaspageguru',compact('username', 'user_type','materi'));
    } else if ($user_type == 'siswa') {
        return view('materikelaspagesiswa',compact('username', 'user_type','materi'));
    }

    // Anda bisa menambahkan logika lainnya di sini, misalnya jika user_type tidak ada di session
    return redirect('/login');
})->middleware('auth');




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
