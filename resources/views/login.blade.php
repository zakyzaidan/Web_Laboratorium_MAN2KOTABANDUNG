@extends('layouts.main')
@section('css')
<link rel="stylesheet" href="css/style.css">
@endsection
@section('page')
<main>

    <div class="profil">
        <h1>بِسْمِ اللهِ الرَّحْمٰنِ الرَّحِيْمِ</h1>
        <h1>SELAMAT DATANG DI LABORATORIUM</h1>
        <h1>MAN 2 KOTA BANDUNG</h1>
    </div>

    <form class="login-container" action="/landing-page" method="get">
        @csrf
        <div class="judul-form">
            <h2>LOGIN AKUN</h2>
            <p>Silahkan Masukan Akun anda</p>
        </div>
        <label for="uname"><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="uname" required >

        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="psw" required>

        <button type="submit">Login</button>
    </form >
</main>

@endsection
