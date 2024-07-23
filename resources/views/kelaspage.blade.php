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
        <div class="jadwal">
            <div class="div-calendar">
                <h5>Jadwal Praktikum</h5>
                <div id="caleandar"></div>
            </div>
            <div class="jadwal-jam-praktikum">
                <h5 id="jadwal-title">Praktikum {{ date('d F Y') }}</h5>
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
    </main>
@endsection
@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="JavaScript/script-kelas.js"></script>
<script type="text/javascript" src="{{ asset('js/caleandar.js') }}"></script>

<script>
    var pelajaran = "{{session('pembelajaran')}}";
    var linkFetch = "";
    if (pelajaran == 'Kimia'){
        linkFetch = "/jadwal-praktikum/check-date/";
    }else if( pelajaran == "Fisika"){
        linkFetch = "/jadwal-praktikum-fisika/check-date/";
    }else if(pelajaran == "Biologi"){
        linkFetch = "/jadwal-praktikum-biologi/check-date/";
    }

    $(document).ready(function() {
            var events = [];
            events = {!! json_encode(Session::get('events')) !!};
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
                    const response = await fetch(linkFetch + date);

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

