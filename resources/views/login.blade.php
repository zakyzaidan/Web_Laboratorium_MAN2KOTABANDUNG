{{-- @extends('layouts.main') --}}
{{-- @section('css') --}}
<link rel="stylesheet" href="css/style-login.css">
{{-- @endsection --}}
{{-- @section('page') --}}
<main-login>

    <div class="profil-login" id="profil-login">
        <h1>بِسْمِ اللهِ الرَّحْمٰنِ الرَّحِيْمِ</h1>
        <h1>SELAMAT DATANG DI LABORATORIUM</h1>
        <h1>MAN 2 KOTA BANDUNG</h1>
    </div>
    <div class="halamanLogin" id="halaman-login">
        <form class="login-container" method="post" action="/login">
            @csrf
            <div class="judul-form-login">
                <h2>LOGIN AKUN</h2>
                <p>Silahkan Masukan Akun anda</p>
            </div>
            <label for="uname"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="username" required >

            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="password" required>

            <button type="submit">Login</button>
        </form >
    </div>
</main-login>
<script src="JavaScript/script-login.js"></script>
{{-- @endsection --}}
