@extends('layouts.dashboard-layouts-fisika')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.css" />
<link rel="stylesheet" href="{{ asset('css/style-dashboard-table.css') }}">
@endsection

@section('page')
<div class="bagian_page">
    <div class="table_header">
        <h3>Jadwal Praktikum</h3>
        <div>
            <button type="button" class="btn btn-success" id="exportButton">
                        <i class="fas fa-file-excel"></i> Download file Excel
                    </button>
            <button type="button" class="btn btn-primary" id="addButton"><i class='fas fa-plus'></i> Tambah</button>
        </div>
    </div>
    <table id="myTable" class="display">
        <thead>
            <tr>
                <th>nomer</th>
                <th>nama</th>
                <th>kelas</th>
                <th>topik praktikum</th>
                <th>jadwal praktikum</th>
                <th>jadwal jam pelajaran</th>
                <th>alat yang dipakai</th>
                <th data-orderable="false">action</th>
            </tr>

        </thead>
        <tbody>
            @php
                use Carbon\Carbon;
                $i = 1; // Initialize counter
            @endphp
            @foreach ($jadwalList as $jadwal)
            @php
                $jadwalJamPelajaran = explode(',', $jadwal->jadwal_jam_praktikum);
            @endphp
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $jadwal->nama }}</td>
                <td>{{ $jadwal->kelas }}</td>
                <td>{{ $jadwal->materi->judul_materi }}</td>
                <td>{{ Carbon::parse($jadwal->jadwal_praktikum)->translatedFormat('d F Y') }}</td>
                <td>
                    <ul>
                        @foreach ($jadwalJamPelajaran as $jam)
                            <li>{{ $jam }}</li>
                        @endforeach
                    </ul>
                </td>
                <td>
                <ul>
                    @foreach ($jadwal->alat as $alat)
                    <li>{{ $alat->nama_alat }} - Jumlah: {{ $alat->pivot->jumlah }}</li>
                    @endforeach
                </ul>
                </td>

                <td>
                    <div class="button-container">
                        <button class="btn btn-primary delete-button" data-id="{{ $jadwal->id_t_jadwal_praktikum }}" style="background-color: #ff4d4d; border-color: #ff4d4d;">Hapus</button>
                        <button class="btn btn-primary edit-button" data-id="{{ $jadwal->id_t_jadwal_praktikum }}" style="background-color: #ffc107; border-color: #ffc107;">Ubah</button>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
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
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
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
                        <!-- Alat akan dimuat di sini dengan JavaScript -->
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
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js"></script>
<script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="{{ asset('JavaScript/script-dashbord-tableV2.js') }}"></script>
<script>
    
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


$(document).ready(function() {
    $('#myTable').DataTable();

    $('#addButton').click(function() {
        $('#modalLabel').text('Tambah Jadwal praktikum');
        $('#form').attr('action', '{{ route('jadwal.store.fisika') }}');
        document.querySelector('input[name="_method"]').value = "POST";
        $('input[name="jadwal_jam_praktikum[]"]').prop('disabled', false);
        $('input[name="jadwal_jam_praktikum[]"]').siblings('label').css('text-decoration', 'none');
        $('#form').trigger('reset');
        $('#modal').modal('show');
        //$('#image-preview').attr('src', '{{ asset('image/image-default.png') }}');
    });

    $(document).on('click', '.edit-button', async function() {
        var id = $(this).data('id');
        try {
            const response = await fetch('/jadwal-praktikum-fisika/' + id + '/edit');
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            const data = await response.json();

            $('#modalLabel').text('Edit Alat');
            $('#form').attr('action', '/jadwal-praktikum-fisika/' + id);
            document.querySelector('input[name="_method"]').value = "PUT";
            $('#nama').val(data.nama);
            $('#kelas').val(data.kelas);
            $('#topik_praktikum').val(data.topik_praktikum);
            $('#jadwal_praktikum').val(data.jadwal_praktikum);

            var jadwalJamPelajaran = data.jadwal_jam_praktikum;
            await checkExistingSchedules(data.jadwal_praktikum);
            $('input[name="jadwal_jam_praktikum[]"]').each(function() {
                if (jadwalJamPelajaran.includes($(this).val())) {
                    $(this).prop('disabled', false).prop('checked', true);
                    $(this).siblings('label').css('text-decoration', 'none');
                } else {
                    $(this).prop('checked', false);
                }
            });

            $('#modal').modal('show');

            // var imageUrl = '{{ asset(Storage::url('')) }}/' + data.foto;
            // imageUrl = imageUrl.replace('/public', '');
            // $('#image-preview').attr('src', imageUrl);
        } catch (error) {
            console.error("Error:", error);
            alert("Error: " + error.message);
        }
    });

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

    $(document).on('click', '.delete-button', function() {
        if (confirm('Are you sure you want to delete this item?')) {
            var id = $(this).data('id');
            $.ajax({
                type: 'POST',
                url: '/jadwal-praktikum-fisika/' + id,
                data: {
                    _token: '{{ csrf_token() }}',
                    _method: 'DELETE'
                },
                success: function(response) {
                    location.reload();
                },
                error: function(error) {
                    console.log("Error:", error);
                }
            });
        }
    });

    async function checkExistingSchedules(jadwal_praktikum) {
    try {
        const response = await fetch('/jadwal-praktikum-fisika/check-date/' + jadwal_praktikum);
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

document.getElementById('exportButton').addEventListener('click', function() {
    window.location.href = '/export-jadwal-praktikum';
});

</script>
@endsection
