@extends($layout)

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.css" />
<link rel="stylesheet" href="{{ asset('css/style-dashboard-table.css') }}">
@endsection

@section('page')
<div class="bagian_page">
    <div class="table_header">
        <h3>Daftar Data Guru</h3>
        <button type="button" class="btn btn-primary" id="addButton"><i class='fas fa-plus'></i> Tambah</button>
    </div>
    <table id="myTable" class="display">
    <thead>
        <tr>
            <th>Nomer</th>
            <th>NIP</th>
            <th>Nama</th>
            <th>Jenis Kelamin</th>
            <th data-orderable="false">Action</th>
        </tr>
    </thead>
    <tbody>
        @php
            $i = 1; // Initialize counter
        @endphp
        @foreach ($dataGuru as $guru)
        <tr>
            <td>{{ $i++ }}</td>
            <td>{{ $guru->nip }}</td>
            <td>{{ $guru->nama }}</td>
            <td>{{ $guru->kelamin }}</td>
            <td>
                <div class="button-container">
                    <button class="btn btn-primary delete-button" data-id="{{ $guru->id }}" style="background-color: #ff4d4d; border-color: #ff4d4d;">Hapus</button>
                    <button class="btn btn-primary edit-button" data-id="{{ $guru->id }}" style="background-color: #ffc107; border-color: #ffc107;">Ubah</button>
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
                    <h5 class="modal-title" id="modalLabel">Tambah Guru</h5>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
                        <button type="submit" class="btn btn-primary ml-2">Simpan</button>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="form-group">
                        <label for="nip">NIP</label>
                        <input type="text" class="form-control" id="nip" name="nip" required>
                    </div>
                    <div class="form-group">
                        <label for="kelamin">Jenis Kelamin</label>
                        <select class="form-control" id="kelamin" name="kelamin" required>
                            <option value="">Silahkan Pilih</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
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
        $('#modalLabel').text('Tambah Data Guru');
        $('#form').attr('action', '{{ route('data-guru.add') }}');
        document.querySelector('input[name="_method"]').value = "POST";
        $('#form').trigger('reset');
        $('#modal').modal('show');
    });

    $(document).on('click', '.edit-button', function() {
        var id = $(this).data('id');
        $.get('/data-guru/edit/' + id, function(data) {
            $('#modalLabel').text('Edit Tenaga');
            $('#form').attr('action', '/data-guru/update/' + id);
            document.querySelector('input[name="_method"]').value = "PUT";
            $('#nip').val(data.nip);
            $('#nama').val(data.nama);
            $('#kelamin').val(data.kelamin);

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
                url: '/data-guru/delete/' + id,
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

</script>
@endsection
