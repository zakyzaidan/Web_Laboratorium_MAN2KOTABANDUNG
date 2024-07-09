@extends('layouts.dashboard-layouts')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.css" />
<link rel="stylesheet" href="{{ asset('css/style-dashboard-table.css') }}">
@endsection

@section('page')
<div class="bagian_page">
    <div class="table_header">
        <h3>Daftar Tenaga Laboratorium</h3>
        <button type="button" class="btn btn-primary" id="addButton"><i class='fas fa-plus'></i> Tambah</button>
    </div>
    <table id="myTable" class="display">
        <thead>
            <tr>
                <th rowspan="2">nomer</th>
                <th rowspan="2" data-orderable="false">foto</th>
                <th rowspan="2">nama</th>
                <th rowspan="2">jabatan</th>
                <th rowspan="2">gologan</th>
                <th colspan="2">pendidikan</th>
                <th rowspan="2">rancangan tugas</th>
                <th rowspan="2" data-orderable="false">action</th>
            </tr>
            <tr>
                <th>nama</th>
                <th>strata</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1; // Initialize counter
            @endphp
            @foreach ($tenagaList as $tenaga)
            <tr>
                <td>{{ $i++ }}</td>
                <td><img src="{{ asset(Storage::url($tenaga->foto)) }}" width="50" height="50" alt="{{ $tenaga->nama }}"></td>
                <td>{{ $tenaga->nama }}</td>
                <td>{{ $tenaga->jabatan }}</td>
                <td>{{ $tenaga->golongan }}</td>
                <td>{{ $tenaga->pendidikan_nama }}</td>
                <td>{{ $tenaga->pendidikan_strata }}</td>
                <td>{{ $tenaga->rancangan_tugas }}</td>
                <td>
                    <div class="button-container">
                        <button class="btn btn-primary delete-button" data-id="{{ $tenaga->id_tenaga_laboratorium }}" style="background-color: #ff4d4d; border-color: #ff4d4d;">Hapus</button>
                        <button class="btn btn-primary edit-button" data-id="{{ $tenaga->id_tenaga_laboratorium }}" style="background-color: #ffc107; border-color: #ffc107;">Ubah</button>
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
                    <h5 class="modal-title" id="modalLabel">Tambah Tenaga</h5>
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
                        <label for="jabatan">Jabatan</label>
                        <input type="text" class="form-control" id="jabatan" name="jabatan" required>
                    </div>
                    <div class="form-group">
                        <label for="golongan">Golongan</label>
                        <input type="text" class="form-control" id="golongan" name="golongan" required>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pendidikan_nama">Nama Universitas / Politeknik</label>
                                <input type="text" class="form-control" id="pendidikan_nama" name="pendidikan_nama" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pendidikan_strata">Jenjang Pendidikan</label>
                                <select class="form-control" id="pendidikan_strata" name="pendidikan_strata" required>
                                    <option value="">Silahkan Pilih Jenjang Pendidikan</option>
                                    <option value="D1">D1</option>
                                    <option value="D2">D2</option>
                                    <option value="D3">D3</option>
                                    <option value="D4">D4</option>
                                    <option value="S1">S1</option>
                                    <option value="S2">S2</option>
                                    <option value="S3">S3</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="rancangan_tugas">Rancangan Tugas</label>
                        <input type="text" class="form-control" id="rancangan_tugas" name="rancangan_tugas" required>
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
        $('#modalLabel').text('Tambah Tenaga Laboratorium');
        $('#form').attr('action', '{{ route('tenaga.store') }}');
        document.querySelector('input[name="_method"]').value = "POST";
        $('#form').trigger('reset');
        $('#image-preview').attr('src', '{{ asset('image/image-default.png') }}');
        $('#modal').modal('show');
    });

    $(document).on('click', '.edit-button', function() {
        var id = $(this).data('id');
        $.get('/tenaga-laboratorium/' + id + '/edit', function(data) {
            $('#modalLabel').text('Edit Tenaga');
            $('#form').attr('action', '/tenaga-laboratorium/' + id);
            document.querySelector('input[name="_method"]').value = "PUT";
            $('#nama').val(data.nama);
            $('#jabatan').val(data.jabatan);
            $('#golongan').val(data.golongan);

            $('#pendidikan_nama').val(data.pendidikan_nama);
            $('#pendidikan_strata').val(data.pendidikan_strata);
            $('#rancangan_tugas').val(data.rancangan_tugas);
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
                url: '/tenaga-laboratorium/' + id,
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
