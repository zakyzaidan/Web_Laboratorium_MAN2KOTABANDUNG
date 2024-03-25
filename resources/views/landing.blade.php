@extends('layouts.main')
@section('css')
<link rel="stylesheet" href="css/style-header.css">
<!-- Font Awesome 5.15.4 -->
<link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
      integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer" />
@endsection
@section('page')
    <header class="navbar-container">
        <nav class="nav-list">
            <ul>
                <li><img src="image/logo-man2.png" alt="logo"></li>
                <li><a href="#About me">BERANDA</a></li>
                <li><a href="">LAB KIMIA</a></li>
                <li><a href="">LAB FISIKA</a></li>
                <li><a href="">LAB BIOLOGI</a></li>
                <li><a href="">STRUKTUR ORGANISASI</a></li>
                <li><a href="">TENTANG</a></li>
            </ul>
        </nav>
        <div class="keterangan">
            <p>
                LABORATORIUM MAN 2 KOTA BANDUNG
            </p>
            <div class="highlight">
                <a class="prev" onclick="plusSlides(-1)">❮</a>
                <div class="slideshow-container" id="slideshow-container">
                    <!-- Gambar akan ditambahkan di sini oleh JavaScript -->
                </div>
                <a class="next" onclick="plusSlides(1)">❯</a>
            </div>
        </div>
    </header>
    <main>
        <div class="pilihan-pelajaran">
            <h2>
                MATERI<br>PEMBELAJARAN
            </h2>
            <ul>
                <li>
                    <a href="">
                        <img src="image/Lab-Kimia.png" alt="Lab Kimia">
                    </a>
                    <h3>
                        Lab<br>Kimia
                    </h3>
                </li>
                <li>
                    <a href="">
                        <img src="image/Lab-Fisika.png" alt="Lab Fisika">
                    </a>
                    <h3>
                        Lab<br>Fisika
                    </h3>
                </li>
                <li>
                    <a href="">
                        <img src="image/Lab-Biologi.png" alt="Lab Biologi">
                    </a>
                    <h3>
                        Lab<br>Biologi
                    </h3>
                </li>
            </ul>
        </div>
        <div class="profil">
            <div class="deskripsi">
                <h2>
                    Selamat Datang Di Laboratorium<br>
                    MAN 2 Kota Bandung
                </h2>
                <h3>
                    Visi MAN 2 Kota Bandung
                </h3>
                <p>
                    Menjadi Lembaga Pendidikan Terdepan Dalam Menyempurnakan Akhlak Peradaban Generasi Bangsa.
                </p>
                <h3>
                    Misi MAN 2 Kota Bandung
                </h3>
                <ol>
                    <li>
                    Mengokohkan profesionalisme dan inovasi tenaga pendidik dan kependidikan madrasah;
                    </li>
                    <li>
                    Meningkatkan kebermaknaan keterampilan hidup (life skill) peserta didik madrasah;
                    </li>
                    <li>
                    Menjalin produktivitas komunikasi pendidikan yang mendorong percepatan peningkatan kualitas pelayanan prima dan mutu lulusan madrasah berakhlakulkarimah;.
                    </li>
                    <li>
                    Menciptakan lingkungan madrasah yang mendidik, berbudaya, sehat, bersih dan beradab;
                    </li>
                    <li>
                    Memantapkan sistem pelayanan prima dan managemen pendidikan madrasah.
                    </li>
                </ol>
            </div>
            <iframe src="https://www.youtube.com/embed/qdMzvF3vANA?si=Y-qgHaV71Obb7SEy?modestbranding=1&showinfo=0&controls=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        </div>
        <div class="Tenaga-Laboratorium">
            <h2>
            TENAGA LABORATORIUM
            </h2>
            <div class="detail">
                <a class="prev" onclick="plusSlides2(-1)">❮</a>
                <div class="slideshow-container2" id="slideshow-container2">
                    <!-- Gambar akan ditambahkan di sini oleh JavaScript -->
                </div>
                <a class="next" onclick="plusSlides2(1)">❯</a>
            </div>
        </div>
    </main>
    <footer>

        <div class="row1">
            <div class="col1">
                <div class="row3">
                    <img src="image/logo-man2.png" alt="logo">
                    <h2>LABORATORIUM<br>
                        MAN 2<br>
                        KOTA BANDUNG</h2>
                </div>
                <p>Jl. Raya Cipadung No.57, Cipadung, Kec. Cibiru, Kota Bandung, Jawa Barat 40615</p>
            </div>
            <div class="col2">
                <h2>Kontak kami</h2>
                <ul>
                    <li>
                        <a href="#"><i class="fab fa-facebook-f" style="color: white;"></i></a>
                    </li>
                    <li>
                        <a href=""><i class="fab fa-instagram" style="color: white;"></i></a>
                    </li>
                    <li>
                        <a href=""><i class="fab fa-whatsapp" style="color: white;"></i></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row2">
            <p>&copy; 2024 All Rights Reserved</p>
        </div>
    </footer>
@section('js')
<script src="JavaScript/script-landing.js"></script>
@endsection
@endsection

