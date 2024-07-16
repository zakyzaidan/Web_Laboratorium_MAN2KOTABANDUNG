<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Siswa;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        // Cek di tabel t_admin dengan username utuh
        $admin = Admin::where('nip', $username)->first();

        // // Jika admin tidak ditemukan, cek dengan username yang dikurangi satu karakter jika diakhiri dengan 'A'
        // if (!$admin && substr($username, -1) === 'A') {
        //     $shortenedUsername = substr($username, 0, -1);
        //     $admin = Admin::where('username', $shortenedUsername)->first();
        // }

        if ($admin && $password == $admin->nip) {
            $id_admin = $admin->id_admin;
            Auth::login($admin);
            session(['username' => $username, 'nama' => $admin->nama, 'user_type' => 'guru', 'id_admin' => $id_admin]);
            return redirect()->intended('/home');

            // // Arahkan ke dashboard jika username diakhiri dengan 'A'
            // if (substr($username, -1) === 'A') {
            //     session(['username' => $username, 'user_type' => 'inventaris', 'id_admin' => $id_admin]);
            //     return redirect()->intended('/pilih-labolatorium');
            // } else {
            //     session(['username' => $username, 'user_type' => 'admin', 'id_admin' => $id_admin]);
            //     return redirect()->intended('/home');
            // }
        }

        // Cek di tabel t_siswa
        $siswa = Siswa::where('nis', $username)->first();
        if ($siswa && $password == $siswa->nis) {
            Auth::login($siswa);
            session(['username' => $username, 'nama'=>$siswa->nama,  'user_type' => 'siswa']);
            return redirect()->intended('/home');
        }

        // Jika autentikasi gagal
        return redirect()->back()->with('error', 'Username atau password salah');
    }

    public function attemptLogin(Request $request)
    {
        // Check if 'username' and 'password' exist in the session
        if ($request->session()->has('username')) {
            // 'username' and 'password' exist in the session
            $username = $request->session()->get('username');
            return true;
        } else {
            // 'username' or 'password' does not exist in the session
            return false;
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}

