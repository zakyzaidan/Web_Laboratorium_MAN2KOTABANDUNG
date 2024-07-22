@extends('layouts.main')
@section('css')
<link rel="stylesheet" href="{{ asset('css/style-kelas.css') }}">
@endsection
@section('page')
    <main>
        <div class="pilihan-kelas">
            <h2>
                MATERI<br>PEMBELAJARAN - {{session('pembelajaran')}}
            </h2>
            <ul>
                <li>
                    <a href="/pilih-kelas/10" >
                        <img src="image/kelas10.png" >
                    </a>
                    <h3>
                        Kelas 10
                    </h3>
                </li>
                <li>
                    <a href="/pilih-kelas/11">
                        <img src="image/kelas11.png" >
                    </a>
                    <h3>
                        Kelas 11
                    </h3>
                </li>
                <li>
                    <a href="/pilih-kelas/12">
                        <img src="image/kelas12.png" >
                    </a>
                    <h3>
                        Kelas 12
                    </h3>
                </li>
            </ul>
        </div>
    </main>
@endsection
@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="JavaScript/script-kelas.js"></script>
@endsection

