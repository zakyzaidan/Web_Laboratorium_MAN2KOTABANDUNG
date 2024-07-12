@extends('layouts.dashboard-layouts')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/style-dashboard-inventaris.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/demo.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/theme1.css') }}" />
@endsection

@section('page')
    <div class="bagian_page">
        <section>
            <div class="card">
                <div class="grup">
                    <span class="number">{{ $jumlahBahanBaik }}</span>
                    <p>Bahan / Zat Tersedia</p>
                </div>
                <img src="{{ asset('/image/ds1.png') }}" alt="gambar-stuktur">
            </div>

            <div class="card">
                <div class="grup">
                    <span class="number">{{ $jumlahAlatBaik }}</span>
                    <p>Alat Tersedia</p>
                </div>
                <img src="{{ asset('/image/ds4.png') }}" alt="gambar-stuktur">
            </div>

            <div class="card">
                <div class="grup">
                    <span class="number">{{ $jumlahFasilitasBaik }}</span>
                    <p>Fasilitas</p>
                </div>
                <img src="{{ asset('/image/ds2.png') }}" alt="gambar-stuktur">
            </div>

            <div class="card">
                <div class="grup">
                    <span class="number">{{ $jumlahBahanBuruk }}</span>
                    <p>Bahan / Zat Kondisi Buruk</p>
                </div>
                <img src="{{ asset('/image/ds1.png') }}" alt="gambar-stuktur">
            </div>

            <div class="card">
                <div class="grup">
                    <span class="number">{{ $jumlahAlatBuruk }}</span>
                    <p>Alat Rusak</p>
                </div>
                <img src="{{ asset('/image/ds4.png') }}" alt="gambar-stuktur">
            </div>

            <div class="card">
                <div class="grup">
                    <span class="number">{{ $jumlahTenagaLaboratorium }}</span>
                    <p>Tenaga Pendidik</p>
                </div>
                <img src="{{ asset('/image/ds3.png') }}" alt="gambar-stuktur">
            </div>
        </section>
        <div class="bawah">
            <div class="jadwal">
                <div class="div-calendar">
                    <p>Jadwal Praktikum</p>
                    <div id="caleandar"></div>
                </div>
                <div>
                    <p id="jadwal-title">Praktikum {{ date('d F Y') }}</p>
                    <table class="jadwal-table">
                        <thead>
                            <tr>
                                <th>Jam Pelajaran</th>
                                <th>Nama</th>
                                <th>Kelas</th>
                                <th>Topik Praktikum</th>
                            </tr>
                        </thead>
                        <tbody id="jadwalTableBody">
                            <!-- Rows will be added dynamically -->
                        </tbody>
                    </table>
                </div>
            </div>
            <h6>Tingkat Kerusakan Lab Per Bulan</h6>
            <canvas id="tingkat_kerusakan_tabel"></canvas>
        </div>
        
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="text/javascript" src="{{ asset('js/caleandar.js') }}"></script>
    <!-- <script type="text/javascript" src="{{ asset('js/demo.js') }}"></script> -->

    <script>
        const allLabels = ['', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov',
        'Dec']; // Semua label bulan
        const Data = [0, 10, 5, 20, 45, 15, 20, 10];
        const Labels = allLabels.slice(0, Data.length);
        const ctx = document.getElementById('tingkat_kerusakan_tabel');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: Labels,
                datasets: [{
                    label: 'Tingkat Kerusakan Lab Per Bulan', // Menghilangkan label di atas grafik
                    data: Data,
                    fill: false,
                    pointRadius: 4,
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    title: {
                        display: false,
                        text: 'Tingkat Kerusakan Lab Per Bulan'
                    }
                },
                scales: {
                    x: {
                        border: {
                            color: 'black'
                        },
                        ticks: {
                            color: 'black',
                        }
                    },
                    y: {
                        beginAtZero: true,
                        border: {
                            color: 'black'
                        },
                        ticks: {
                            color: 'black',
                        }
                    }
                }
            }

        });
    </script>
    <script>

$(document).ready(function() {
            var events = {!! json_encode($events) !!};
            events = events.map(event => {
                return {
                    Date: new Date(event.Date),
                    Title: event.Title,
                    Link: event.Link || ''
                };
            });

            var settings = {};
            var element = document.getElementById('caleandar');
            caleandar(element, events, settings);

            async function loadJadwal(date) {
                try {
                    const response = await fetch('/jadwal-praktikum/check-date/' + date);
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    const data = await response.json();
                    $('#jadwalTitle').text('Praktikum ' + date);
                    var tbody = $('#jadwalTableBody');
                    tbody.empty();
                    var jamPelajaranList = ['Jam 1', 'Jam 2', 'Jam 3', 'Jam 4', 'Jam 5', 'Jam 6', 'Jam 7', 'Jam 8', 'Jam 9', 'Jam 10'];

                    jamPelajaranList.forEach(function(jam) {
                        var row = $('<tr>');
                        row.append($('<td>').text(jam));

                        if (data.scheduleData[jam]) {
                            row.addClass('filled');
                            row.append($('<td>').text(data.scheduleData[jam].nama));
                            row.append($('<td>').text(data.scheduleData[jam].kelas));
                            row.append($('<td>').text(data.scheduleData[jam].topik_praktikum));
                        } else {
                            row.append($('<td>').text(''));
                            row.append($('<td>').text(''));
                            row.append($('<td>').text(''));
                        }

                        tbody.append(row);
                    });
                } catch (error) {
                    console.error("Error:", error);
                    alert("Error: " + error.message);
                }
            }

            // Fungsi untuk mengubah tanggal ke format hari, tanggal bulan tahun
            function formatDate(dateString) {
                const date = new Date(dateString);
                const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

                const dayName = days[date.getDay()];
                const day = date.getDate();
                const month = months[date.getMonth()];
                const year = date.getFullYear();

                return `${dayName}, ${day} ${month} ${year}`;
            }

            // Fungsi untuk mendapatkan tanggal hari ini dalam format YYYY-MM-DD
            function getTodayDate() {
                const today = new Date();
                const yyyy = today.getFullYear();
                const mm = String(today.getMonth() + 1).padStart(2, '0');
                const dd = String(today.getDate()).padStart(2, '0');
                return `${yyyy}-${mm}-${dd}`;
            }

            // Muat jadwal untuk hari ini saat halaman dimuat
            const today = getTodayDate();
            loadJadwal(today);
            document.getElementById('jadwal-title').innerText = `Praktikum ${formatDate(today)}`;

            // Update jadwal ketika tanggal di kalender dipilih
            element.addEventListener('click', function(event) {
                const target = event.target.closest('.today, .selected');
                if (target) {
                    const date = target.getAttribute('data-date');
                    loadJadwal(date);
                    document.getElementById('jadwal-title').innerText = `Praktikum ${formatDate(date)}`;
                }
            });

            

            
        });
    </script>
@endsection
