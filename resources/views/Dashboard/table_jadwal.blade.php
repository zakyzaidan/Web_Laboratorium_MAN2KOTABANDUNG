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
                <th>nama</th>
                <th>kelas</th>
                <th>topik praktikum</th>
                <th>jadwal praktikum</th>
                <th>jadwal jam pelajaran</th>
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
                <td>{{ $jadwal->topik_praktikum }}</td>
                <td>{{ Carbon::parse($jadwal->jadwal_praktikum)->translatedFormat('d F Y') }}</td>
                <td>
                    <ul>
                        @foreach ($jadwalJamPelajaran as $jam)
                            <li>{{ $jam }}</li>
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
                        <label for="topik_praktikum">Topik Praktikum</label>
                        <input type="text" class="form-control" id="topik_praktikum" name="topik_praktikum" required>
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
$(document).ready(function() {
    $('#myTable').DataTable();

    $('#addButton').click(function() {
        $('#modalLabel').text('Tambah Jadwal praktikum');
        $('#form').attr('action', '{{ route('jadwal.store') }}');
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
            const response = await fetch('/jadwal-praktikum/' + id + '/edit');
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            const data = await response.json();

            $('#modalLabel').text('Edit Alat');
            $('#form').attr('action', '/jadwal-praktikum/' + id);
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

    async function checkExistingSchedules(jadwal_praktikum) {
    try {
        const response = await fetch('/jadwal-praktikum/check-date/' + jadwal_praktikum);
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        const data = await response.json();
        
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


</script>
@endsection
