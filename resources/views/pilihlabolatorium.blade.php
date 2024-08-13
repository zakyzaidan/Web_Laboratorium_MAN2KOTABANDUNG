@extends('layouts.main')
@section('css')
 <link rel="stylesheet" href="css/pilih-lab.css">
@endsection
@section('page')
<main>
<div class="pilihan-pelajaran" id="pilihan-pelajaran">

<h2>
    PILIH DASHBOARD LABOLATORIUM
</h2>
<ul>
    <li>
        @if (session()->has('username'))
        <a href="/pilih-dashboard/Kimia">
            <img src="image/Lab-Kimia.png" alt="Lab Kimia">
        </a>
        <h3>Kimia</h3>
        @else
        <img src="image/Lab-Kimia.png" alt="Lab Kimia">
        <h3>Lab Kimia</h3>
        @endif
    </li>
    <li>
        @if (session()->has('username'))
        <a href="/pilih-dashboard/Fisika">
            <img src="image/Lab-Fisika.png" alt="Lab Fisika">
        </a>
        <h3>Fisika</h3>
        @else

        <img src="image/Lab-Fisika.png" alt="Lab Fisika">

        <h3>Lab Fisika</h3>
        @endif
    </li>
    <li>
        @if (session()->has('username'))
        <a href="/pilih-dashboard/Biologi">
            <img src="image/Lab-Biologi.png" alt="Lab Biologi" >
        </a>
        <h3>Biologi</h3>
        @else

        <img src="image/Lab-Biologi.png" alt="Lab Biologi" >

        <h3>Lab Biologi</h3>
        @endif
    </li>
</ul>
</div>
</main>
@endsection
@section('js')

<script src="JavaScript/script-landing.js"></script>
@endsection
