<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MAN 2 KOTA BANDUNG</title>

    <link rel="stylesheet" href="{{ asset('css/style-dashboard-inventaris.css') }}">

    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
    integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer" />

</head>
<body>
    <header>
        <h2>Laboratorium MAN 2</h2>
    </header>
    <main>
        <aside>
            <hr>
            <div class="profil">
                <div class="circle"></div>
                <p>Dr. Dadang Suparlan M.T</p>
            </div>
            <hr>
            <div class="jadwal">
                <p>Jadwal Laboratorium <i class="fas fa-chevron-right"></i></p>
            </div>
            <hr>
            <div class="Inventaris">
                <div class="dropdown" onclick="myFunction()">
                    <div class="text">
                        <span>Inventaris Lab</span>
                        <i id="arrow" class="fas fa-chevron-right"></i>
                    </div>
                    <div id="myDropdown" class="dropdown-content">
                        <ul>
                            <li><p>Daftar Inventarisasi Barang</p></li>
                            <li><p>Daftar Usulan Barang</p></li>
                            <li><p>Daftar Peminjaman Barang</p></li>
                        </ul>
                    </div>
                </div>
            </div>
        </aside>
        <section>
            <div class="card">
                <div class="grup">
                    <span class="number">32</span>
                    <p>Bahan / Zat Tersedia</p>
                </div>
                <img src="{{ asset('/image/ds1.png') }}" alt="gambar-stuktur">
            </div>

            <div class="card">
                <div class="grup">
                    <span class="number">32</span>
                    <p>Alat Tersedia</p>
                </div>
                <img src="{{ asset('/image/ds4.png') }}" alt="gambar-stuktur">
            </div>

            <div class="card">
                <div class="grup">
                    <span class="number">32</span>
                    <p>Fasilitas</p>
                </div>
                <img src="{{ asset('/image/ds2.png') }}" alt="gambar-stuktur">
            </div>

            <div class="card">
                <div class="grup">
                    <span class="number">32</span>
                    <p>Bahan / Zat Kondisi Buruk</p>
                </div>
                <img src="{{ asset('/image/ds1.png') }}" alt="gambar-stuktur">
            </div>

            <div class="card">
                <div class="grup">
                    <span class="number">32</span>
                    <p>Alat Rusak</p>
                </div>
                <img src="{{ asset('/image/ds4.png') }}" alt="gambar-stuktur">
            </div>

            <div class="card">
                <div class="grup">
                    <span class="number">32</span>
                    <p>Tenaga Pendidik</p>
                </div>
                <img src="{{ asset('/image/ds3.png') }}" alt="gambar-stuktur">
            </div>
        </section>
    </main>
    <script>
        function myFunction() {
            var dropdown = document.getElementById("myDropdown");
            dropdown.classList.toggle("show");

            var arrow = document.getElementById("arrow");
            if (dropdown.classList.contains("show")) {
                arrow.className = "fas fa-chevron-down";
            } else {
                arrow.className = "fas fa-chevron-right";
            }
        }
        window.onload = function() {
            var tinggiHeader = document.querySelector('header').offsetHeight;
            document.querySelector('aside').style.height = 'calc(100vh - ' + tinggiHeader + 'px)';
        }

    </script>
</body>
</html>
