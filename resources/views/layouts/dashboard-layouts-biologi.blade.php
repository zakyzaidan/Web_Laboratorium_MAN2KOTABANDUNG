<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MAN 2 KOTA BANDUNG</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/style-layouts-dashboard.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    @yield('css')

</head>

<body>
    <header class="navbar-container">
        <nav class="nav-list">
            <ul>
                <li>
                    <h2>Laboratorium Biologi MAN 2</h2>
                </li>
            @if (session()->has('username'))
            <div style="display: flex">
                    <li style="margin-right: 10px">
                        <form action="{{ route('home') }}" method="GET" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-outline-primary" style="margin-top: 5px; margin-right: 2.5px">HOME</button>
                        </form>
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-outline-secondary" style="margin-top: 5px; margin-right: 2.5px">LOG-OUT</button>
                        </form>
                    </li>
                </div>
                            @else
                                <li><a href="login">LOG-IN</a></li>
                            @endif
            </ul>
        </nav>
    </header>
    <main>
        <aside>
            <hr>
            <div class="profil">
                <div class="circle"></div>
                <p>{{ session('nama') }}</p>
            </div>
            <hr>
            <div class="jadwal">
                <p><a href="/Dashboard-inventaris-biologi">Jadwal Laboratorium</a> <i class="fas fa-chevron-right"></i></p>
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
                            <li>
                                <p><a href="/inventarisasi-alat-biologi/">Daftar Inventarisasi Alat</a></p>
                            </li>
                            <li>
                                <p><a href="/inventarisasi-fasilitas-biologi/">Daftar Inventarisasi fasilitas</a></p>
                            </li>
                            <li>
                                <p><a href="/inventarisasi-bahan-biologi/">Daftar Inventarisasi bahan</a></p>
                            </li>
                            <li>
                                <p><a href="/tenaga-laboratorium-biologi/">Daftar Tenaga Laboratorium</a></p>
                            </li>
                            <li>
                                <p><a href="/jadwal-praktikum-biologi/">Jadwal Praktikum</a></p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </aside>
        @yield('page')
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
            document.querySelector('aside') //.style.height = 'calc(100vh - ' + tinggiHeader + 'px)';
        }
    </script>
    @yield('js')
</body>

</html>
