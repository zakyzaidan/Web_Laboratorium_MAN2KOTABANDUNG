@extends('layouts.main')
@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.css" />
<link rel="stylesheet" href="{{ asset('css/style-dashboard-table.css') }}">
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
                        <img src="{{URL::asset('image/kelas10.png')}}" alt="Gambar kelas 10">
                    </a>
                    <h3>
                        Kelas 10
                    </h3>
                </li>
                <li>
                    <a href="/pilih-kelas/11">
                        <img src="{{URL::asset('image/kelas11.png')}}" alt="Gambar kelas 11" >
                    </a>
                    <h3>
                        Kelas 11
                    </h3>
                </li>
                <li>
                    <a href="/pilih-kelas/12">
                        <img src="{{URL::asset('image/kelas12.png')}}" alt="Gambar kelas 12" >
                    </a>
                    <h3>
                        Kelas 12
                    </h3>
                </li>
            </ul>
        </div>
        @if (session('user_type') == 'guru')
            <div class="tambah-jadwal">
                <button type="button" class="btn btn-primary" id="addButton"><i class='fas fa-plus'></i> Tambah Jadwal</button>
            </div>
        @endif
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

    <!-- Add/Edit Modal -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <form id="form" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" value="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Tambah Jadwal</h5>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary" id="batalButton" data-dismiss="modal">Batalkan</button>
                        <button type="submit" class="btn btn-primary ml-2">Simpan</button>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{ session('nama') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <input type="text" class="form-control" id="kelas" name="kelas" required>
                    </div>
                    <div class="form-group">
                        <label for="materi_id">Materi:</label>
                        <select class="form-control" id="materi_id" name="materi_id" required>
                            <option value="">Pilih Materi</option>
                            @foreach($materis as $materi)
                            <option value="{{ $materi->id_materi }}">{{ $materi->judul_materi }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div id="alat-container" class="form-group">
                    </div>
                    <div id="bahan-container" class="form-group">
                    </div>

                    <div class="form-group">
                        <label for="jadwal_praktikum">Jadwal Tanggal Praktikum</label>
                        <input type="date" id="jadwal_praktikum" name="jadwal_praktikum" class="form-control" required>
                        <p id="date-error" style="color:red; display:none;">Tanggal ini sudah dipilih, silakan pilih tanggal lain.</p>
                    </div>
                    <div class="form-group">
                        <label for="jadwal_jam_praktikum[]">Jadwal Jam Pelajaran Praktikum</label>
                        <table>
                        <tr>
                            <th>
                        <ul>
                            <li>
                                <input class="form-check-input me-1" type="checkbox" name="jadwal_jam_praktikum[]" value="Jam 1" id="firstCheckbox">
                                <label class="form-check-label" for="firstCheckbox">Jam 1</label>
                            </li>
                            <li>
                                <input class="form-check-input me-1" type="checkbox" name="jadwal_jam_praktikum[]" value="Jam 2" id="secondCheckbox">
                                <label class="form-check-label" for="secondCheckbox">Jam 2</label>
                            </li>
                            <li>
                                <input class="form-check-input me-1" type="checkbox" name="jadwal_jam_praktikum[]" value="Jam 3" id="thirdCheckbox">
                                <label class="form-check-label" for="thirdCheckbox">Jam 3</label>
                            </li>
                            <li>
                                <input class="form-check-input me-1" type="checkbox" name="jadwal_jam_praktikum[]" value="Jam 4" id="fourthCheckbox">
                                <label class="form-check-label" for="thirdCheckbox">Jam 4</label>
                            </li>
                            <li>
                                <input class="form-check-input me-1" type="checkbox" name="jadwal_jam_praktikum[]" value="Jam 5" id="fifthCheckbox" >
                                <label class="form-check-label" for="thirdCheckbox">Jam 5</label>
                            </li>
                        </ul>
                        </th>
                        <th>
                            <ul>
                                <li>
                                    <input class="form-check-input me-1" type="checkbox" name="jadwal_jam_praktikum[]" value="Jam 6" id="firstCheckbox">
                                    <label class="form-check-label" for="firstCheckbox">Jam 6</label>
                                </li>
                                <li>
                                    <input class="form-check-input me-1" type="checkbox" name="jadwal_jam_praktikum[]" value="Jam 7" id="secondCheckbox">
                                    <label class="form-check-label" for="secondCheckbox">Jam 7</label>
                                </li>
                                <li>
                                    <input class="form-check-input me-1" type="checkbox" name="jadwal_jam_praktikum[]" value="Jam 8" id="thirdCheckbox">
                                    <label class="form-check-label" for="thirdCheckbox">Jam 8</label>
                                </li>
                                <li>
                                    <input class="form-check-input me-1" type="checkbox" name="jadwal_jam_praktikum[]" value="Jam 9" id="fourthCheckbox">
                                    <label class="form-check-label" for="thirdCheckbox">Jam 9</label>
                                </li>
                                <li>
                                    <input class="form-check-input me-1" type="checkbox" name="jadwal_jam_praktikum[]" value="Jam 10" id="fifthCheckbox">
                                    <label class="form-check-label" for="thirdCheckbox">Jam 10</label>
                                </li>
                            </ul>
                        </th>
                        </tr>
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</main>

@endsection
@section('js')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="{{ asset('JavaScript/script-kelas.js') }}"></script>
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
            events = {!! json_encode($events) !!};
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

            $('#addButton').click(function() {
                $('#modalLabel').text('Tambah Jadwal praktikum');
                if (pelajaran == 'Kimia'){
                    $('#form').attr('action', '{{ route('jadwal.store.kimia') }}');
                }else if( pelajaran == "Fisika"){
                    $('#form').attr('action', '{{ route('jadwal.store.fisika') }}');
                }else if(pelajaran == "Biologi"){
                    $('#form').attr('action', '{{ route('jadwal.store') }}');
                }
                
                document.querySelector('input[name="_method"]').value = "POST";
                $('input[name="jadwal_jam_praktikum[]"]').prop('disabled', false);
                $('input[name="jadwal_jam_praktikum[]"]').siblings('label').css('text-decoration', 'none');
                $('#form').trigger('reset');
                $('#modal').modal('show');
                //$('#image-preview').attr('src', '{{ asset('image/image-default.png') }}');
            });

            $('#batalButton').click(function(){
                $('#form').trigger('reset');
                $('#modal').modal('hide');
            })

            $('#form').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);

                formData.append('_token', '{{ csrf_token() }}');
                if (document.querySelector('input[name="_method"]').value === 'PUT') {
                    formData.append('_method', 'PUT');
                }

                fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                }).then(response => {
                    if (response.ok) {
                        location.reload();
                        console.log(response);
                    } else {
                        return response.json().then(errorData => {
                            if (errorData.errors) {
                                var errors = errorData.errors;
                                for (var field in errors) {
                                    var errorMessage = errors[field][0];
                                    console.log("Field:", field, "Error Message:", errorMessage);
                                }
                            }
                        });
                    }
                }).catch(error => {
                    console.error("Error:", error);
                });
            });

            async function checkExistingSchedules(jadwal_praktikum) {
                try {
                    let response;
                    if (pelajaran == 'Kimia'){
                        response = await fetch('/jadwal-praktikum/check-date/' + jadwal_praktikum);
                    }else if( pelajaran == "Fisika"){
                        response = await fetch('/jadwal-praktikum-fisika/check-date/' + jadwal_praktikum);
                    }else if(pelajaran == "Biologi"){
                        response = await fetch('/jadwal-praktikum-biologi/check-date/' + jadwal_praktikum);
                    }
                    
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    const data = await response.json();
                    
                    $('input[name="jadwal_jam_praktikum[]"]').each(function() {
                        var jamPelajaran = $(this).val();
                            $(this).prop('disabled', false);
                            $(this).prop('checked', false);
                            $(this).siblings('label').css('text-decoration', 'none');
                            $(this).siblings('.nama').text('');
                            $(this).siblings('.kelas').text('');
                            $(this).siblings('.topik').text('');
                    });
                    $('input[name="jadwal_jam_praktikum[]"]').each(function() {
                        var jamPelajaran = $(this).val();
                        if (data.scheduleData[jamPelajaran]) {
                            $(this).prop('disabled', true);
                            $(this).siblings('label').css('text-decoration', 'line-through');
                            $(this).siblings('.nama').text(data.scheduleData[jamPelajaran].nama);
                            $(this).siblings('.kelas').text(data.scheduleData[jamPelajaran].kelas);
                            $(this).siblings('.topik').text(data.scheduleData[jamPelajaran].topik_praktikum);
                        } else {
                            $(this).prop('disabled', false);
                            $(this).siblings('label').css('text-decoration', 'none');
                            $(this).siblings('.nama').text('');
                            $(this).siblings('.kelas').text('');
                            $(this).siblings('.topik').text('');
                        }
                    });
                } catch (error) {
                    console.error("Error:", error);
                    alert("Error: " + error.message);
                }
            }

                $('#jadwal_praktikum').change(async function() {
                    var selectedDate = $(this).val();
                    await checkExistingSchedules(selectedDate);
                });

                var checkboxes = $('.form-check-input');
                checkboxes.change(function(){
                    if($('.form-check-input:checked').length>0) {
                        checkboxes.removeAttr('required');
                    } else {
                        checkboxes.attr('required', 'required');
                    }
                });

        });

if (pelajaran == 'Kimia'){
    document.getElementById('materi_id').addEventListener('change', function() {
    var materiId = this.value;
    fetch('/jadwal-praktikum-kimia/materi/' + materiId + '/alat')
        .then(response => response.json())
        .then(data => {
            var alatContainer = document.getElementById('alat-container');
            var bahanContainer = document.getElementById('bahan-container');

            alatContainer.innerHTML = ''; // Bersihkan container alat
            bahanContainer.innerHTML = ''; // Bersihkan container bahan

            // menampilkan alat
            var table = document.createElement('table');
            table.className = 'table table-bordered';

            var thead = document.createElement('thead');
            var headerRow = document.createElement('tr');
            var headers = ['Foto', 'Nama Alat', 'Jumlah tersedia', 'Jumlah dipinjam'];
            headers.forEach(headerText => {
                var th = document.createElement('th');
                th.textContent = headerText;
                headerRow.appendChild(th);
            });
            thead.appendChild(headerRow);
            table.appendChild(thead);

            var tbody = document.createElement('tbody');
            tbody.id = 'tools-table';

            data[0].forEach(alat => {
                var row = document.createElement('tr');

                var fotoCell = document.createElement('td');
                var fotoImg = document.createElement('img');
                var imageUrl = '{{ asset(Storage::url('')) }}/' + alat.foto;
                imageUrl = imageUrl.replace('/public', '');
                fotoImg.src = imageUrl;
                fotoImg.alt = 'Foto Alat';
                fotoImg.style.width = '50px';
                fotoImg.style.height = '50px';
                fotoCell.appendChild(fotoImg);
                row.appendChild(fotoCell);

                var namaCell = document.createElement('td');
                namaCell.textContent = alat.nama_alat;
                row.appendChild(namaCell);

                var lokasiCell = document.createElement('td');
                lokasiCell.textContent = alat.jumlah;
                row.appendChild(lokasiCell);

                var jumlahCell = document.createElement('td');
                var input = document.createElement('input');
                input.type = 'number';
                input.name = 'jumlah_alat[]';
                input.className = 'form-control';
                input.min = 0;
                input.max = alat.jumlah;
                input.placeholder = 'Jumlah alat yang dibutuhkan';
                jumlahCell.appendChild(input);

                var hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'alat[]';
                hiddenInput.value = alat.id_t_inventarisasi_alat;
                jumlahCell.appendChild(hiddenInput);

                row.appendChild(jumlahCell);

                tbody.appendChild(row);
            });

            table.appendChild(tbody);
            alatContainer.appendChild(table);

            // Menampilkan Bahan
            var bahanTable = document.createElement('table');
            bahanTable.className = 'table table-bordered';

            var bahanThead = document.createElement('thead');
            var bahanHeaderRow = document.createElement('tr');
            var bahanHeaders = ['Nama Bahan', 'Jumlah tersedia', 'Jumlah', 'Satuan'];
            bahanHeaders.forEach(headerText => {
                var th = document.createElement('th');
                th.textContent = headerText;
                bahanHeaderRow.appendChild(th);
            });
            bahanThead.appendChild(bahanHeaderRow);
            bahanTable.appendChild(bahanThead);

            var bahanTbody = document.createElement('tbody');
            bahanTbody.id = 'materials-table';

            data[1].forEach(bahan => {
                var row = document.createElement('tr');

                var namaCell = document.createElement('td');
                namaCell.textContent = bahan.nama_bahan;
                row.appendChild(namaCell);

                var lokasiCell = document.createElement('td');
                lokasiCell.textContent = bahan.jumlah;
                row.appendChild(lokasiCell);
                
                var jumlahCell = document.createElement('td');
                var input = document.createElement('input');
                input.type = 'number';
                input.name = 'jumlah_bahan[]';
                input.className = 'form-control';
                input.min = 0;
                input.max = bahan.jumlah;
                input.placeholder = 'Jumlah bahan yang dibutuhkan';
                jumlahCell.appendChild(input);
                
                var hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'bahan[]';
                hiddenInput.value = bahan.id_t_inventarisasi_bahan;
                jumlahCell.appendChild(hiddenInput);
                
                row.appendChild(jumlahCell);
                
                var satuanCell = document.createElement('td');
                satuanCell.textContent = bahan.satuan;
                row.appendChild(satuanCell);

                bahanTbody.appendChild(row);
            });

            bahanTable.appendChild(bahanTbody);
            bahanContainer.appendChild(bahanTable);
        });
});
        }else if( pelajaran == "Fisika"){
            document.getElementById('materi_id').addEventListener('change', function() {
                var materiId = this.value;
                fetch('/jadwal-praktikum-fisika/materi/' + materiId + '/alat')
                    .then(response => response.json())
                    .then(data => {
                        var alatContainer = document.getElementById('alat-container');
                        alatContainer.innerHTML = ''; // Bersihkan container
            
                        var table = document.createElement('table');
                        table.className = 'table table-bordered';
            
                        var thead = document.createElement('thead');
                        var headerRow = document.createElement('tr');
                        var headers = ['Foto', 'Nama Alat', 'Jumlah tersedia', 'Jumlah dipinjam'];
                        headers.forEach(headerText => {
                            var th = document.createElement('th');
                            th.textContent = headerText;
                            headerRow.appendChild(th);
                        });
                        thead.appendChild(headerRow);
                        table.appendChild(thead);
            
                        var tbody = document.createElement('tbody');
                        tbody.id = 'tools-table';
            
                        data.forEach(alat => {
                            var row = document.createElement('tr');
            
                            var fotoCell = document.createElement('td');
                            var fotoImg = document.createElement('img');
                            var imageUrl = '{{ asset(Storage::url('')) }}/' + alat.foto;
                            imageUrl = imageUrl.replace('/public', '');
                            fotoImg.src = imageUrl;
                            fotoImg.alt = 'Foto Alat';
                            fotoImg.style.width = '50px';
                            fotoImg.style.height = '50px';
                            fotoCell.appendChild(fotoImg);
                            row.appendChild(fotoCell);
            
                            var namaCell = document.createElement('td');
                            namaCell.textContent = alat.nama_alat;
                            row.appendChild(namaCell);
            
                            var lokasiCell = document.createElement('td');
                            lokasiCell.textContent = alat.jumlah;
                            row.appendChild(lokasiCell);
            
                            var jumlahCell = document.createElement('td');
                            var input = document.createElement('input');
                            input.type = 'number';
                            input.name = 'jumlah_alat[]';
                            input.className = 'form-control';
                            input.min = 0;
                            input.max = alat.jumlah;
                            input.placeholder = 'Jumlah alat yang dibutuhkan';
                            jumlahCell.appendChild(input);
            
                            var hiddenInput = document.createElement('input');
                            hiddenInput.type = 'hidden';
                            hiddenInput.name = 'alat[]';
                            hiddenInput.value = alat.id_t_inventarisasi_alat;
                            jumlahCell.appendChild(hiddenInput);
            
                            row.appendChild(jumlahCell);
            
                            tbody.appendChild(row);
                        });
            
                        table.appendChild(tbody);
                        alatContainer.appendChild(table);
                    });
            });
        }else if(pelajaran == "Biologi"){
            document.getElementById('materi_id').addEventListener('change', function() {
    var materiId = this.value;
    fetch('/jadwal-praktikum-biologi/materi/' + materiId + '/alat')
        .then(response => response.json())
        .then(data => {
            var alatContainer = document.getElementById('alat-container');
            alatContainer.innerHTML = ''; // Bersihkan container

            var table = document.createElement('table');
            table.className = 'table table-bordered';

            var thead = document.createElement('thead');
            var headerRow = document.createElement('tr');
            var headers = ['Foto', 'Nama Alat', 'Jumlah tersedia', 'Jumlah dipinjam'];
            headers.forEach(headerText => {
                var th = document.createElement('th');
                th.textContent = headerText;
                headerRow.appendChild(th);
            });
            thead.appendChild(headerRow);
            table.appendChild(thead);

            var tbody = document.createElement('tbody');
            tbody.id = 'tools-table';

            data.forEach(alat => {
                var row = document.createElement('tr');

                var fotoCell = document.createElement('td');
                var fotoImg = document.createElement('img');
                var imageUrl = '{{ asset(Storage::url('')) }}/' + alat.foto;
                imageUrl = imageUrl.replace('/public', '');
                fotoImg.src = imageUrl;
                fotoImg.alt = 'Foto Alat';
                fotoImg.style.width = '50px';
                fotoImg.style.height = '50px';
                fotoCell.appendChild(fotoImg);
                row.appendChild(fotoCell);

                var namaCell = document.createElement('td');
                namaCell.textContent = alat.nama_alat;
                row.appendChild(namaCell);

                var lokasiCell = document.createElement('td');
                lokasiCell.textContent = alat.jumlah;
                row.appendChild(lokasiCell);

                var jumlahCell = document.createElement('td');
                var input = document.createElement('input');
                input.type = 'number';
                input.name = 'jumlah_alat[]';
                input.className = 'form-control';
                input.min = 0;
                input.max = alat.jumlah;
                input.placeholder = 'Jumlah alat yang dibutuhkan';
                jumlahCell.appendChild(input);

                var hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'alat[]';
                hiddenInput.value = alat.id_t_inventarisasi_alat;
                jumlahCell.appendChild(hiddenInput);

                row.appendChild(jumlahCell);

                tbody.appendChild(row);
            });

            table.appendChild(tbody);
            alatContainer.appendChild(table);
        });
});
        }

</script>

@endsection

