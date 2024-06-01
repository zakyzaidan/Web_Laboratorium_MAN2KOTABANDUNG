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
            <canvas id="tingkat_kerusakan_tabel"></canvas>
            <div class="jadwal">
                <p>Jadwal Praktikum</p>
                <div id="caleandar"></div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="text/javascript" src="{{ asset('js/caleandar.js') }}"></script>
    <!-- <script type="text/javascript" src="{{ asset('js/demo.js') }}"></script> -->

    <!-- <script>
    var events = {!! json_encode($events) !!};
    var settings = {};
    var element = document.getElementById('caleandar');
    caleandar(element, events, settings);
    </script> -->
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
    var events = {!! json_encode($events) !!};
    events = events.map(event => {
        return {
            Date: new Date(event.Date),
            Title: event.Title,
            Link: event.Link || ''
        };
    });
    //      var settings = {};
    // var element = document.getElementById('caleandar');
    // caleandar(element, events, settings);
//     var events = [
//   {'Date': new Date(2024, 6, 7), 'Title': 'Praktikum Fisika.'},
//   {'Date': new Date(2024, 6, 18), 'Title': 'New Garfield movie comes out!', 'Link': 'https://garfield.com'},
//   {'Date': new Date(2024, 6, 27), 'Title': '25 year anniversary', 'Link': 'https://www.google.com.au/#q=anniversary+gifts'},
// ];
var settings = {};
var element = document.getElementById('caleandar');
caleandar(element, events, settings);
    </script>
@endsection
