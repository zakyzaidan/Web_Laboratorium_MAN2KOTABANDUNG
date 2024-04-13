<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MateriController;
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
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/pilih-pembelajaran/{pelajaran}', [KelasController::class,'setpembelajaranSession'])->middleware('auth');

Route::get('/pilih-kelas', function () {
    $username = session('username');
    $user_type = session('user_type');
    return view('kelaspage', compact('username', 'user_type'));
})->middleware('auth');

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

    if ($user_type == 'admin') {
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
