<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Siswa;

class AuthController extends Controller
{
    // AuthController.php
    public function showLoginForm(){
        return view('login');
    }

    public function login(Request $request){
        $username = $request->input('username');
        $password = $request->input('password');
        // dd($username);
        // Cek di tabel t_admin
        $admin = Admin::where('username', $username)->first();
        // if ($admin && Hash::check($password, $admin->password)) {
        if ($admin && $password == $admin->password) {
            // Jika autentikasi berhasil
            Auth::login($admin);

            // if (Auth::check()) {
            //     dd('Pengguna berhasil diautentikasi');
            // } else {
            //     dd('Pengguna gagal diautentikasi');
            // }
            session(['username' => $username, 'user_type' => 'admin']);
            // dd(session()->all());
            // dd(Auth::check());

            if (Auth::check()) {
                return redirect()->intended('/home');
            } else {
                // Jika autentikasi gagal, kembalikan ke halaman login
                return redirect()->back()->with('error', 'Autentikasi gagal');
            }

        }

        // Cek di tabel t_siswa
        $siswa = Siswa::where('username', $username)->first();
        // if ($siswa && Hash::check($password, $siswa->password)) {
        if ($siswa && $password == $siswa->password) {
            // Jika autentikasi berhasil
            Auth::login($siswa);
            // if (Auth::check()) {
            //     dd('siswa Pengguna berhasil diautentikasi');
            // } else {
            //     dd(' siswaPengguna gagal diautentikasi');
            // }
            session(['username' => $username, 'user_type' => 'siswa']);
            // dd(session()->all());
            // dd(Auth::check());
            return redirect()->intended('/home');
        }

        // Jika autentikasi gagal
        return redirect()->back()->with('error', 'Username atau password salah');
    }

    public function attemptLogin(Request $request){
    // Check if 'username' and 'password' exist in the session
        if ($request->session()->has('username') === true) {
            // 'username' and 'password' exist in the session
            $username = $request->session()->get('username');
            return true;
        } else {

            // 'username' or 'password' does not exist in the session
            return false;
        }
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

}
