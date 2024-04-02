<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/login', function () {
    return view('login');
});

Route::get('/pilih-kelas', function () {
    return view('kelaspage');
});

Route::get('/materi-kelas-page-siswa', function () {
    return view('materikelaspagesiswa');
});

Route::get('/materi-kelas-page-guru', function () {
    return view('materikelaspageguru');
});
