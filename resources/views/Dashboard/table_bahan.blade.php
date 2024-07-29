@extends('layouts.dashboard-layouts')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.css" />
<link rel="stylesheet" href="{{ asset('css/style-dashboard-table.css') }}">
@endsection

@section('page')
<div class="bagian_page">
    <div class="table_header">
        <h3>Daftar Inventarisasi Bahan</h3>
        <button type="button" class="btn btn-primary" id="addButton"><i class='fas fa-plus'></i> Tambah</button>
    </div>
    <table id="myTable" class="display">
        <thead>
            <tr>
                <th rowspan="2">nomer</th>
                <th rowspan="2" data-orderable="false">foto</th>
                <th rowspan="2">nama Bahan</th>
                <th rowspan="2">jumlah</th>
                <th rowspan="2">satuan</th>
                <th colspan="2">kondisi</th>
                <th rowspan="2">lokasi penyimpanan</th>
                <th rowspan="2">keterangan</th>
                <th rowspan="2" data-orderable="false">action</th>
            </tr>
            <tr>
                <th>baik</th>
                <th>buruk</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1; // Initialize counter
            @endphp
            @foreach ($bahanList as $bahan)
            <tr>
                <td>{{ $i++ }}</td>
                <td><img src="{{ asset(Storage::url($bahan->foto)) }}" width="50" height="50" alt="{{ $bahan->nama_bahan }}"></td>
                <td class="clickable-row" data-href="{{ route('bahan.show', $bahan->id_t_inventarisasi_bahan) }}">{{ $bahan->nama_bahan }}</td>
                <td>{{ $bahan->jumlah }}</td>
                <td>{{ $bahan->satuan }}</td>
                <td>{{ $bahan->kondisi_baik }}</td>
                <td>{{ $bahan->kondisi_buruk }}</td>
                <td>{{ $bahan->lokasi_penyimpanan }}</td>
                <td>{{ $bahan->keterangan }}</td>
                <td>
                    <div class="button-container">
                        <button class="btn btn-primary delete-button" data-id="{{ $bahan->id_t_inventarisasi_bahan }}" style="background-color: #ff4d4d; border-color: #ff4d4d;">Hapus</button>
                        <button class="btn btn-primary edit-button" data-id="{{ $bahan->id_t_inventarisasi_bahan }}" style="background-color: #ffc107; border-color: #ffc107;">Ubah</button>
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
                    <h5 class="modal-title" id="modalLabel">Tambah Bahan</h5>
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
                            <p>Silahkan Unggah Foto Inventaris Bahan.<br><b>Pedoman penting</b>: 347x288 piksel.
                                <br><b>Format yang didukung</b>: .jpg, .jpeg, atau .png</p>
                            <label for="image-upload" class="custom-file-upload">
                                Unggah foto <i class="fas fa-upload"></i>
                            </label>
                            <input id="image-upload" name="image-upload" type="file" accept=".jpg, .jpeg, .png" onchange="previewImage()" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="namaBahan">Nama Bahan</label>
                        <input type="text" class="form-control" id="namaBahan" name="namaBahan" required>
                    </div>
                    <div class="form-group">
                        <label for="golongan">Golongan</label>
                        <input type="text" class="form-control" id="golongan" name="golongan" required>
                    </div>
                    <div class="form-group">
                        <label for="mr">Mr</label>
                        <input type="text" class="form-control" id="mr" name="mr" required>
                    </div>
                    <div class="form-group">
                        <label for="kemurnian">Kemurnian</label>
                        <input type="text" class="form-control" id="kemurnian" name="kemurnian" required>
                    </div>
                    <div class="form-group">
                        <label for="konsentrasi">konsentrasi</label>
                        <input type="text" class="form-control" id="konsentrasi" name="konsentrasi" required>
                    </div>
                    <div class="form-group">
                        <label for="wujud">wujud</label>
                        <input type="text" class="form-control" id="wujud" name="wujud" required>
                    </div>

                    <div class="form-group">
                        <label for="merk">Merk</label>
                        <input type="text" class="form-control" id="merk" name="merk" required>
                    </div>
                    <div class="form-group">
                        <label for="produksi">Produksi</label>
                        <input type="text" class="form-control" id="produksi" name="produksi" required>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_masuk">Tanggal Masuk</label>
                        <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk" required>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jumlah">Jumlah</label>
                                <input type="number" class="form-control" id="jumlah" name="jumlah" required>
                            </div>
                            <div class="form-group">
                                <label for="kondisiBaik">Kondisi Baik</label>
                                <input type="number" class="form-control" id="kondisiBaik" name="kondisiBaik" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="satuan">Satuan</label>
                                <select class="form-control" id="satuan" name="satuan" required>
                                    <option value="">Silahkan Pilih Satuan</option>
                                    <option value="buah">Buah</option>
                                    <option value="unit">Unit</option>
                                    <option value="meter">Meter</option>
                                    <option value="liter">Liter</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="kondisiBuruk">Kondisi Buruk</label>
                                <input type="number" class="form-control" id="kondisiBuruk" name="kondisiBuruk" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="lokasiPenyimpanan">Lokasi Penyimpanan</label>
                        <input type="text" class="form-control" id="lokasiPenyimpanan" name="lokasiPenyimpanan" required>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea class="form-control" id="keterangan" name="keterangan" rows="3"></textarea>
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
<script src="{{ asset('JavaScript/script-dashbord-table.js') }}"></script>
<script>
$(document).ready(function() {
    $('#myTable').DataTable();

    $('#addButton').click(function() {
        $('#modalLabel').text('Tambah Bahan');
        $('#form').attr('action', '{{ route('bahan.store.kimia') }}');
        document.querySelector('input[name="_method"]').value = "POST";
        $('#form').trigger('reset');
        $('#image-preview').attr('src', '{{ asset('image/image-default.png') }}');
        $('#modal').modal('show');
    });

    $(document).on('click', '.edit-button', function() {
        var id = $(this).data('id');
        $.get('/inventarisasi-bahan/' + id + '/edit', function(data) {
            $('#modalLabel').text('Edit Bahan');
            $('#form').attr('action', '/inventarisasi-bahan/' + id);
            document.querySelector('input[name="_method"]').value = "PUT";
            $('#namaBahan').val(data.nama_bahan);
            $('#golongan').val(data.golongan);
            $('#mr').val(data.mr);
            $('#kemurnian').val(data.kemurnian);
            $('#konsentrasi').val(data.konsentrasi);
            $('#wujud').val(data.wujud);
            $('#merk').val(data.merk);
            $('#produksi').val(data.produksi);
            $('#tanggal_masuk').val(data.tanggal_masuk);
            $('#jumlah').val(data.jumlah);
            $('#kondisiBaik').val(data.kondisi_baik);
            $('#satuan').val(data.satuan);
            $('#kondisiBuruk').val(data.kondisi_buruk);
            $('#lokasiPenyimpanan').val(data.lokasi_penyimpanan);
            $('#keterangan').val(data.keterangan);
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
                url: '/inventarisasi-bahan/' + id,
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
    $(".clickable-row").click(function() {
        window.location = $(this).data("href");
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
