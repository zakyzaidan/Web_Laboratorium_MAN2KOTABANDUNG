<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MAN 2 KOTA BANDUNG</title>
    {{-- @yield('css') --}}
    <link rel="stylesheet" href="css/style-landing.css">
    {{-- <link rel="stylesheet" href="css/style.css"> --}}
    <link rel="stylesheet" href="css/style-headerfooter.css">
<!-- Font Awesome 5.15.4 -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
</head>
<body>
    <header class="navbar-container">
        <nav class="nav-list">
            <ul>
                <li><img src="image/logo-man2.png" alt="logo"></li>
                <li><a href="landing">BERANDA</a></li>
                <li><a href="">LAB KIMIA</a></li>
                <li><a href="">LAB FISIKA</a></li>
                <li><a href="">LAB BIOLOGI</a></li>
                <li><a href="">STRUKTUR ORGANISASI</a></li>
                <li><a href="">TENTANG</a></li>
                <li class="login"><a href="login">LOG-IN</a></li>
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

    @yield('page')

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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    @yield('js')

</body>
</html>
