@extends('layouts.dashboard-layouts')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.css" />
<link rel="stylesheet" href="{{ asset('css/style-dashboard-table.css') }}">
@endsection

@section('page')
<div class="bagian_page">
    <div class="table_header">
        <h3>Jadwal Praktikum</h3>
        <button type="button" class="btn btn-primary" id="addButton"><i class='fas fa-plus'></i> Tambah</button>
    </div>
    <table id="myTable" class="display">
        <thead>
            <tr>
                <th>nomer</th>
                <th data-orderable="false">foto</th>
                <th>nama</th>
                <th>nama perajaran</th>
                <th>topik praktikum</th>
                <th>jadwal praktikum</th>
                <th>laboratorium</th>
                <th data-orderable="false">action</th>
            </tr>

        </thead>
        <tbody>
            @php
                use Carbon\Carbon;
                $i = 1; // Initialize counter
            @endphp
            @foreach ($jadwalList as $jadwal)
            <tr>
                <td>{{ $i++ }}</td>
                <td><img src="{{ asset(Storage::url($jadwal->foto)) }}" width="50" height="50" alt="{{ $jadwal->nama }}"></td>
                <td>{{ $jadwal->nama }}</td>
                <td>{{ $jadwal->mata_pelajaran }}</td>
                <td>{{ $jadwal->topik_praktikum }}</td>
                <td>{{ Carbon::parse($jadwal->jadwal_praktikum)->translatedFormat('d F Y') }}</td>
                <td>{{ $jadwal->laboratorium }}</td>
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
                    <figcaption>Unggah Foto</figcaption>
                    <div class="input">
                        <img id="image-preview" src="{{ asset('image/image-default.png') }}" alt="Preview Image">
                        <div class="foto">
                            <p>Silahkan Unggah Foto Tenaga Laboratorium.<br><b>Pedoman penting</b>: 347x288 piksel.
                                <br><b>Format yang didukung</b>: .jpg, .jpeg, atau .png</p>
                            <label for="image-upload" class="custom-file-upload">
                                Unggah foto <i class="fas fa-upload"></i>
                            </label>
                            <input id="image-upload" name="image-upload" type="file" accept=".jpg, .jpeg, .png" onchange="previewImage()" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="form-group">
                        <label for="mata_pelajaran">Mata Pelajaran</label>
                        <select class="form-control" id="mata_pelajaran" name="mata_pelajaran" required>
                            <option value="">pilih mata pelajaran</option>
                            <option value="Kimia">Kimia</option>
                            <option value="Fisika">Fisika</option>
                            <option value="Biologi">Biologi</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="topik_praktikum">Topik Praktikum</label>
                        <input type="text" class="form-control" id="topik_praktikum" name="topik_praktikum" required>
                    </div>
                    <div class="form-group">
                        <label for="jadwal_praktikum">Jadwal Praktikum</label>
                        <input type="date" id="jadwal_praktikum" name="jadwal_praktikum" class="form-control" required>
                        <p id="date-error" style="color:red; display:none;">Tanggal ini sudah dipilih, silakan pilih tanggal lain.</p>
                    </div>
                    <div class="form-group">
                        <label for="laboratorium">Laboratorium</label>
                        <input type="text" class="form-control" id="laboratorium" name="laboratorium" required>
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
$(document).ready(function() {
    $('#myTable').DataTable();

    $('#addButton').click(function() {
        $('#modalLabel').text('Tambah Jadwal praktikum');
        $('#form').attr('action', '{{ route('jadwal.store') }}');
        document.querySelector('input[name="_method"]').value = "POST";
        $('#form').trigger('reset');
        $('#image-preview').attr('src', '{{ asset('image/image-default.png') }}');
        $('#modal').modal('show');
    });

    $(document).on('click', '.edit-button', function() {
        var id = $(this).data('id');
        $.get('/jadwal-praktikum/' + id + '/edit', function(data) {
            $('#modalLabel').text('Edit Alat');
            $('#form').attr('action', '/jadwal-praktikum/' + id);
            document.querySelector('input[name="_method"]').value = "PUT";
            $('#nama').val(data.nama);
            $('#mata_pelajaran').val(data.mata_pelajaran);
            $('#topik_praktikum').val(data.topik_praktikum);

            $('#jadwal_praktikum').val(data.jadwal_praktikum);
            $('#laboratorium').val(data.laboratorium);

            var imageUrl = '{{ asset(Storage::url('')) }}/' + data.foto;
            imageUrl = imageUrl.replace('/public', '');
            $('#image-preview').attr('src', imageUrl);
            $('#modal').modal('show');
        });
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
                url: '/jadwal-praktikum/' + id,
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
    $('#jadwal_praktikum').change(function() {
        var selectedDate = $(this).val();

        $.ajax({
            url: '/jadwal-praktikum/check-date/' + selectedDate,
            method: 'GET',
            success: function(response) {
                if (response.exists) {
                    alert('Tanggal sudah ada di database.');
                    // Jika tanggal sudah ada di database, kosongkan nilai input
                    $('#jadwal_praktikum').val('');
                }
            },
            error: function(xhr, status, error) {
                console.error("Error:", error);
                alert("Error: " + error.message);
            }
        });
    });
});

function previewImage() {
    var file = document.getElementById("image-upload").files[0];
    var reader = new FileReader();
    reader.onloadend = function() {
        document.getElementById('image-preview').src = reader.result;
    }
    if (file) {
        reader.readAsDataURL(file);
    } else {
        document.getElementById('image-preview').src = "";
    }
}
</script>
@endsection
