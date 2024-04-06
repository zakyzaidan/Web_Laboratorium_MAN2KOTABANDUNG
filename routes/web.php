<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\KelasController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
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

Route::get('/pilih-kelas', function () {
    $username = session('username');
    $user_type = session('user_type');
    return view('kelaspage', compact('username', 'user_type'));
})->middleware('auth');

Route::get('/pilih-kelas/{kelas}', [KelasController::class,'setKelasSession'])->middleware('auth');

Route::match(['get', 'post'], '/materi-kelas-page', function (Request $request) {
    if ($request->isMethod('post')) {
        // Logika untuk menangani permintaan POST
        // Misalnya, Anda dapat memanggil fungsi store() di MateriController
        app('App\Http\Controllers\MateriController')->store($request);
    }

    $username = session('username');
    $user_type = session('user_type');

    if ($user_type == 'admin') {
        return view('materikelaspageguru',compact('username', 'user_type'));
    } else if ($user_type == 'siswa') {
        return view('materikelaspagesiswa',compact('username', 'user_type'));
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
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
