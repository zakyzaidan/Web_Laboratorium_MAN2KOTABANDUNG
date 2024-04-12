@extends('layouts.main')
@section('page')
    <main>
        <div class="pilihan-pelajaran" id="pilihan-pelajaran">

            <h2>
                MATERI PEMBELAJARAN
            </h2>
            <ul>
                <li>
                    @if (session()->has('username'))
                    <a href="">
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
                    <a href="/pilih-kelas">
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
                    <a href="">
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
        <div class="profil" id="profil">

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
        <div class="Galeri-Laboratorium">
            <h2>
                GALERI LABORATORIUM
            </h2>
            <div class="container-galeri-isi-lab">
                <div class="isi-lab" >
                    <div class="penjelasan-galeri-lab-posisi1">
                        <h3>Lab Kimia</h3>
                        <p>MAN 2 Kota Bandung memiliki sebuah Laboratorium Kimia yang dapat digunakan siswa untuk keberlangsungan belajar mengajar.</p>
                    </div>
                    <div class="slidegambar">
                        <div id="carouselExampleIndicators1" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#carouselExampleIndicators1" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                <button type="button" data-bs-target="#carouselExampleIndicators1" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                <button type="button" data-bs-target="#carouselExampleIndicators1" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                <button type="button" data-bs-target="#carouselExampleIndicators1" data-bs-slide-to="3" aria-label="Slide 4"></button>
                            </div>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                <img src="image/image_lab.png" class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                <img src="image/image_lab.png" class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                <img src="image/image_lab.png" class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                <img src="image/image_lab.png" class="d-block w-100" alt="...">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="penjelasan-galeri-lab-posisi2">
                        <h3>Lab Kimia</h3>
                        <p>MAN 2 Kota Bandung memiliki sebuah Laboratorium Kimia yang dapat digunakan siswa untuk keberlangsungan belajar mengajar.</p>
                    </div>
                </div>
                <div class="isi-lab">
                    <div class="penjelasan-galeri-lab-posisi1">
                        <h3>Lab Fisika</h3>
                        <p>MAN 2 Kota Bandung memiliki sebuah Laboratorium Fisika yang dapat digunakan siswa untuk keberlangsungan belajar mengajar.</p>
                    </div>
                    <div class="penjelasan-galeri-lab-posisi2">
                        <h3 style="text-align:right">Lab Fisika</h3>
                        <p style="text-align:right">MAN 2 Kota Bandung memiliki sebuah Laboratorium Fisika yang dapat digunakan siswa untuk keberlangsungan belajar mengajar.</p>
                    </div>
                    <div class="slidegambar">
                        <div id="carouselExampleIndicators2" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#carouselExampleIndicators2" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                <button type="button" data-bs-target="#carouselExampleIndicators2" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                <button type="button" data-bs-target="#carouselExampleIndicators2" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                <button type="button" data-bs-target="#carouselExampleIndicators2" data-bs-slide-to="3" aria-label="Slide 4"></button>
                            </div>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                <img src="image/image_lab.png" class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                <img src="image/image_lab.png" class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                <img src="image/image_lab.png" class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                <img src="image/image_lab.png" class="d-block w-100" alt="...">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="isi-lab">
                    <div class="penjelasan-galeri-lab-posisi1">
                        <h3>Lab Kimia</h3>
                        <p>MAN 2 Kota Bandung memiliki sebuah Laboratorium Kimia yang dapat digunakan siswa untuk keberlangsungan belajar mengajar.</p>
                    </div>
                    <div class="slidegambar">
                        <div id="carouselExampleIndicators3" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#carouselExampleIndicators3" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                <button type="button" data-bs-target="#carouselExampleIndicators3" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                <button type="button" data-bs-target="#carouselExampleIndicators3" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                <button type="button" data-bs-target="#carouselExampleIndicators3" data-bs-slide-to="3" aria-label="Slide 4"></button>
                            </div>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                <img src="image/image_lab.png" class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                <img src="image/image_lab.png" class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                <img src="image/image_lab.png" class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                <img src="image/image_lab.png" class="d-block w-100" alt="...">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="penjelasan-galeri-lab-posisi2">
                        <h3>Lab Biologi</h3>
                        <p>MAN 2 Kota Bandung memiliki sebuah Laboratorium Biologi yang dapat digunakan siswa untuk keberlangsungan belajar mengajar.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="peraturan">
            <h2>TATA TERTIB LABORATORIUM <br>MAN 2 KOTA BANDUNG</h2>
            <div class="isi-peraturan">
                    <div class="container-peraturan">
                    <ol type="1">
                        <li>Siswa yang memasuki laboratorium harus seizin dan dalam pengawasan guru atau petugas laboratorium </li>
                        <li>Siswa harus memakai jas praktikum selama berada di dalam laboratorium</li>
                        <li>Sebelum praktikum, siswa harus mengisi daftar hadir terlebih dahulu</li>
                        <li>Siswa melaksanakan percobaan sesuai dengan jadwal yang telah ditetapkan</li>
                        <li>Siswa yang melakukan praktikum harus sudah mempelajari lebih dahulu petunjuk praktikumnya (teori dan langkah-langkah praktik)</li>
                        <li>Siswa wajib menjaga kebersihan laboratorium</li>
                        <li>Selama melakukan percobaan dilarang:</li>
                        <ol type="a">
                            <li>Melakukan kegiatan-kegiatan di luar petunjuk praktikum</li>
                            <li>Bergurau, ngobrol, makan, dan minum di ruang praktikum</li>
                            <li>Menggunakan alat-alat atau bahan-bahan di luar petunjuk dan tanpa izin guru atau petugas praktikum.</li>
                            <li>Mencoba-coba mencampurkan zat-zat yang tersedia tanpa seizin guru, petugas laboratorium atau petunjuk praktikum.</li>
                            <li>Membuang sampah yang tidak larut di bak cuci sebab akan menyumbat saluran.</li>
                        </ol>
                        <li>Tidak membawa alat/bahan praktikum ke luar laboratorium, kecuali sudah memenuhi ketentuan peminjaman-keluar yang berlaku.</li>
                        <li>Jika dalam praktikum terjadi kecelakaan (kena pecahan kaca, terbakar, tertusuk, tertelan bahan kimia) harap segera melapor kepada guru atau petugas laboratorium.</li>
                        <li>Untuk percobaan yang menggunakan sumber listrik PLN harus meminta diperiksa kepada pengawas praktikum (guru/petugas laboratorium) sebelum disambungkan.</li>
                        <li>Mengembalikan alat-alat ke tempat semula serta melaporkan kepada pengawas praktikum (guru/petugas laboratorium)</li>
                        <li>Siswa yang melanggar tata tertib dapat dikenakan sanksi</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="struktur-organisasi" id="struktur-organisasi">
            <h2>
                STRUKTUR ORGANISASI
            </h2>
            <div class="baris1">
                <div class="box1">
                    <img src="/image/Intersect.png" alt="gambar-stuktur">
                    <p>Penanggung Jawab</p>
                    <div class="line"></div>
                    <h5>Plt. KEPALA MADRASAH<br>Dr. H. Awaludin Hamzah, M.Ag</h5>
                </div>
                <div class="line1"></div>
            </div>
            <div class="baris2">
                <div class="box1">
                    <img src="/image/Intersect.png" alt="gambar-stuktur">
                    <p>Wakamad Kurikulum</p>
                    <div class="line"></div>
                    <h5>Ikeu Kartika, M.P.Kim</h5>
                </div>
                <div class="line3"></div>
                <div class="line2">
                    <div class="subline1"></div>
                    <div class="subline2"></div>
                </div>
                <div class="line3"></div>
                <div class="box1">
                    <img src="/image/Intersect.png" alt="gambar-stuktur">
                    <p>Wakamad Sarana dan Prasarana</p>
                    <div class="line"></div>
                    <h5>Yayan Ristamanjaya, S.Pd., S.E, M.M</h5>
                </div>
            </div>
            <div class="baris3">
                <div class="line4"></div>
                <div class="arrow">
                    <i class="fas fa-chevron-down"></i>
                    <i class="fas fa-chevron-down"></i>
                </div>
            </div>
            <div class="baris2">
                <div class="box1">
                    <img src="/image/Intersect.png" alt="gambar-stuktur">
                    <p>Kepala Lab Fisika</p>
                    <div class="line"></div>
                    <h5>Dra. Dewi Kartilah</h5>
                </div>
                <div class="line3"></div>
                <div class="box1">
                    <img src="/image/Intersect.png" alt="gambar-stuktur">
                    <p>Kepala Lab Kimia</p>
                    <div class="line"></div>
                    <h5>Iwan Rosadi, M.Pd</h5>
                </div>
                <div class="line3"></div>
                <div class="box1">
                    <img src="/image/Intersect.png" alt="gambar-stuktur">
                    <p>Kepala Lab Biologi</p>
                    <div class="line"></div>
                    <h5>Dra. Nenen Shanti W</h5>
                </div>
            </div>
            <div class="baris3">
                <div class="line4"></div>
                <div class="arrow">
                    <i class="fas fa-chevron-down"></i>
                    <i class="fas fa-chevron-down"></i>
                </div>
            </div>
            <div class="kontainer-struktur1">
                <h2>Guru Mata Pelajaran</h2>
            </div>
            <div class="baris3">
                <div class="line5"></div>
                <div class="config">
                    <i class="fas fa-chevron-down"></i>
                </div>

            </div>
            <div class="kontainer-struktur2">
                <h2>Siswa</h2>
            </div>

            <div class="ketorgChart">
                <div class="satu">
                    <div class="garis1"></div>
                    <i class="fas fa-chevron-right"></i>
                    <p>Garis Koordinasi</p>
                </div>
                <div class="satu">
                    <div class="garis2"></div>
                    <i class="fas fa-chevron-right"></i>
                    <p>Garis Komando</p>
                </div>
            </div>
        </div>
    </main>
@section('js')

<script src="JavaScript/script-landing.js"></script>
@endsection
@endsection

