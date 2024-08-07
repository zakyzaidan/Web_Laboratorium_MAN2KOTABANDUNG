@extends('layouts.dashboard-layouts-biologi')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.css" />
<link rel="stylesheet" href="{{ asset('css/style-dashboard-table.css') }}">
@endsection

@section('page')
<div class="bagian_page">
    <div class="table_header">
        <h3>Peminjaman Pihak Luar</h3>
        <button type="button" class="btn btn-primary" id="addButton"><i class='fas fa-plus'></i> Tambah</button>
    </div>
    <table id="myTable" class="display">
        <thead>
            <tr>
                <th>nomer</th>
                <th>nama peminjam</th>
                <th>nama instansi/organisasi</th>
                <th>tanggal peminjaman</th>
                <th>tanggal pengembalian</th>
                <th>alat yang dipinjam</th>
                <th>status</th>
                <th data-orderable="false">action</th>
            </tr>

        </thead>
        <tbody>
            @php
                use Carbon\Carbon;
                $i = 1; // Initialize counter
            @endphp
            @foreach ($peminjamanList as $peminjam)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $peminjam->nama_peminjam }}</td>
                <td>{{ $peminjam->nama_instansi }}</td>
                <td>{{ Carbon::parse($peminjam->tanggal_peminjaman)->translatedFormat('d F Y') }} - {{ Carbon::parse($peminjam->rencana_pengembalian)->translatedFormat('d F Y') }}</td>
                @if( $peminjam->tanggal_pengembalian === NULL)
                <td>-</td>
                @else
                <td>{{ Carbon::parse($peminjam->tanggal_pengembalian)->translatedFormat('d F Y') }}</td>
                @endif
                <td>
                    <ul>
                        @foreach ($peminjam->alat as $alat)
                        <li>{{ $alat->nama_alat }} - Jumlah: {{ $alat->pivot->jumlah }}</li>
                        @endforeach
                    </ul>
                </td>
                <td>{{ $peminjam->status }}</td>

                <td>
                    <div class="button-container">
                        @if( $peminjam->status === "Sedang dipinjam")
                        <button class="btn btn-info dikembalikan" data-id="{{ $peminjam->id }}">Sudah dikembalikan</button>
                        @else
                        <button class="btn btn-primary delete-button" data-id="{{ $peminjam->id }}" style="background-color: #ff4d4d; border-color: #ff4d4d;">Hapus</button>
                        @endif
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
                    <h5 class="modal-title" id="modalLabel">Tambah Peminjaman</h5>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
                        <button type="submit" class="btn btn-primary ml-2">Simpan</button>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_peminjam">Nama Peminjam</label>
                        <input type="text" class="form-control" id="nama_peminjam" name="nama_peminjam" required>
                    </div>
                    <div class="form-group">
                        <label for="nama_instansi">Nama instansi atau organisasi</label>
                        <input type="text" class="form-control" id="nama_instansi" name="nama_instansi" required>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_peminjaman">Tanggal Peminjaman</label>
                        <input type="date" id="tanggal_peminjaman" name="tanggal_peminjaman" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="rencana_pengembalian">Rencana Pengembalian</label>
                        <input type="date" id="rencana_pengembalian" name="rencana_pengembalian" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <input type="hidden" type="date" id="tanggal_pengembalian" name="tanggal_pengembalian" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="hidden"  type="text" class="form-control" id="status" name="status" value="Sedang dipinjam" required>
                    </div>

                    
                    <!-- Tabel Alat -->
                                <div class="form-group">
                                    <label for="search-tool">Cari Alat</label>
                                    <input type="text" class="form-control" id="search-tool" placeholder="Cari Alat..." oninput="searchTools()">
                                </div>
                                <div class="form-group">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Foto</th>
                                                <th>Nama Alat</th>
                                                <th>Lokasi Penyimpanan</th>
                                                <th>Jumlah Tersedia</th>
                                                <th>Jumlah Dipinjam</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tools-table">
                                            @foreach($alats as $alat)
                                            <tr>
                                                <input type="hidden"  id="alat[]" type="number"  name="alat[]" value="{{ $alat->id_t_inventarisasi_alat }}">
                                                <td><img src="{{ asset(Storage::url($alat->foto)) }}" alt="Foto Alat" style="width: 50px; height: 50px;"></td>
                                                <td>{{ $alat->nama_alat }}</td>
                                                <td>{{ $alat->lokasi_penyimpanan }}</td>
                                                <td>{{ $alat->jumlah }}</td>
                                                <td>
                                                    <input id="jumlah_alat[]" type="number"  name="jumlah_alat[]" min=0 max='{{ $alat->jumlah }}'>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- Akhir Tabel Alat -->

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
        $('#modalLabel').text('Tambah Peminjaman');
        $('#form').attr('action', '{{ route('peminjaman.store.biologi') }}');
        document.querySelector('input[name="_method"]').value = "POST";
        $('#form').trigger('reset');
        $('#modal').modal('show');
        //$('#image-preview').attr('src', '{{ asset('image/image-default.png') }}');
    });

    $(document).on('click', '.dikembalikan', function() {
        var id = $(this).data('id');
        if(confirm('Apakah alat-alat yang dipinjam sudah dikembalikan?')){
            var formData = new FormData();
    
            formData.append('tanggal_pengembalian', '{{ Carbon::now() }}')
            formData.append('status', "Sudah dikembalikan")
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('_method', 'PUT');
            
            fetch('/peminjaman-pihak-luar-biologi/' + id, {
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
        }

    });

    $('#form').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);

        formData.append('_token', '{{ csrf_token() }}');
        if (document.querySelector('input[name="_method"]').value === 'PUT') {
            formData.append('_method', 'PUT');
        }

        formData.delete('alat[]');
        formData.delete('jumlah_alat[]');
        
        // Collect tool IDs and quantities
        $('#tools-table tr').each(function() {
            var toolId = $(this).find('input[name="alat[]"]').val();
            var quantity = $(this).find('input[name="jumlah_alat[]"]').val();

            // Only include tools with a non-zero quantity
            if (quantity > 0) {
                formData.append('alat[]', toolId);
                formData.append('jumlah_alat[]', quantity);
            }
        });
        
        // console.log([...formData]);

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
                url: '/peminjaman-pihak-luar-biologi/' + id,
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

    function searchTools() {
        const query = $('#search-tool').val().toLowerCase();
        $('#tools-table tr').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(query) > -1)
        });
    }
    

});


</script>
@endsection
