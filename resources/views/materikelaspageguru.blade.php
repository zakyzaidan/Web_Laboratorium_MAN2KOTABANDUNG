@extends('layouts.main')
@section('page')
    <main>
        <div class="materi-pembelajaran">
            <div class="header">
                <h2>MATERI PEMBELAJARAN <br> PRAKTIKUM</h2>
                <button class="add-button">+</button>
            </div>
            <div class="detail">
                <div>
                    <img src="image/gerakmelingkar.png" alt="gerakmelingkar">
                    <figcaption>Gerak Melingkar</figcaption>
                    <a href="">Lihat Detail -></a>
                </div>
                <div>
                    <img src="image/ayunanbandulsederhana.png" alt="ayunanbandul">
                    <figcaption>Ayunan Bandul Sederhana</figcaption>
                    <a href="">Lihat Detail -></a>
                </div>
                <div>
                    <img src="image/energipotensial.png" alt="energipotensial">
                    <figcaption>Energi Potensial</figcaption>
                    <a href="">Lihat Detail -></a>
                </div>
            </div>
            <br><br><br><br><br><br>
            <div class="detail">
                <div>
                    <img src="image/gerakmelingkar.png" alt="gerakmelingkar">
                    <figcaption>Gerak Melingkar</figcaption>
                    <a href="">Lihat Detail -></a>
                </div>
                <div>
                    <img src="image/ayunanbandulsederhana.png" alt="ayunanbandul">
                    <figcaption>Ayunan Bandul Sederhana</figcaption>
                    <a href="">Lihat Detail -></a>
                </div>
                <div>
                    <img src="image/energipotensial.png" alt="energipotensial">
                    <figcaption>Energi Potensial</figcaption>
                    <a href="">Lihat Detail -></a>
                </div>
            </div>
        </div>
        <br><br><br><br>
        <div class="pagination">
            <a href="#">«</a>
            <a href="#">1</a>
            <a href="#" class="">2</a>
            <a href="#">3</a>
            <a href="#">4</a>
            <a href="#">5</a>
            <a href="#">»</a>
        </div>
        <br><br><br><br>
    </main>
@section('js')
<script src="JavaScript/script-landing.js"></script>
@endsection
@endsection

