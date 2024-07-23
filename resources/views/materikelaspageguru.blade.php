@extends('layouts.main')
@section('css')
 <link rel="stylesheet" href="css/style-materi-add-update.css">
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
 <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
 <script>console.log("----------")</script>
@endsection
@section('page')
    <main>

        <div class="materi-pembelajaran">
            <div class="header">
                <h2>MATERI PEMBELAJARAN PRAKTIKUM <br> {{session("pembelajaran")}} - Kelas {{session("kelas")}} </h2>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" onclick="clearForm()">Tambah +</button>

            </div>
            <div class="detail">
                <?php $i = 0; ?>
                @foreach ($materi as $item)
                    <div class="card" style="width: 30rem;">
                        <a href="/materi/{{$item->id_materi}}">
                            <img class="card-img-top" src="{{ asset(Storage::url($item->thubnail_materi)) }}" alt="Card image cap">
                        </a>
                        <div class="card-body">
                            <a href="/materi/{{$item->id_materi}}">
                                <h3 class="card-title">{{ $item->judul_materi }}</h3>
                                <h5 class="card-subtitle mb-2 text-body-secondary">{{ $item->penulis }}</h5>
                            </a>
                        </div>
                        <div class="card-body card-action">
                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal" onclick="editData({{ $item->id_materi }})">Edit</button>
                            <form action="/materi-kelas-page/delete" method="post" onsubmit="return confirmDeletion()">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $item->id_materi }}">
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                            
                        </div>
                    </div>
                    <?php $i++; ?>
                    @if ($i % 3 == 0)
                        </div><div class="detail">
                    @endif
                @endforeach
            </div>
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
                    <div class="modal-dialog modal-xl" role="document" >
                        <div class="modal-content" >
                            <form action="/materi-kelas-page" id="form" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="_method" value="PUT">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Materi</h5>
                                    <button type="batal" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
                                    <button type="submit" value="Submit" class="btn btn-primary">Tambahkan</button>

                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <figcaption>tampilan materi & modul pembelajaran</figcaption>
                                        <div class="thumbnail">
                                            <div class="input">
                                                <img id="image-preview" src="image/image-default.png" alt="Preview Image">
                                                <div class="foto">
                                                    <p>Unggah Thumbnail materi 1 Anda di sini. <b>Format yang didukung</b>: .jpg, .jpeg, atau .png</p>
                                                    <label for="image-upload" class="custom-file-upload">
                                                        Unggah foto  <i class="fas fa-upload"></i>
                                                    </label>
                                                    <input id="image-upload" name="image-upload" type="file" accept=".jpg, .jpeg, .png" onchange="previewImage()" required/>
                                                </div>
                                            </div>
                                            <div class="input">
                                                <iframe id="html-preview"></iframe>
                                                <div class="html">
                                                    <p>Unggah Simulasi html jika ada. (optional)</p>
                                                    <label for="html-upload" class="custom-file-upload">
                                                        Unggah Laman  <i class="fas fa-upload"></i>
                                                    </label>
                                                    <input id="html-upload" name="html-upload" type="file" accept=".html" onchange="previewHTMLFile()">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label for="judul">Judul</label>
                                        <div class="gabung-input-text">
                                            <input type="text" class="form-control" id="judul" name="judul" maxlength="80" placeholder="Silahkan Tuliskan Judul Materi" oninput="updateCount()">
                                            <small id="judulHelp" class="form-text text-muted">0/80</small>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="penulis">Penulis</label>
                                        <input type="text" class="form-control" id="penulis" name="penulis" value="{{ session('nama') }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="file-materi">File Pendukung Materi</label>
                                        <input type="file" class="form-control" id="file-materi" name="file-materi" accept=".pdf, .doc, .docx" required>
                                    </div>
                                    <div class="form-group" >
                                        <label for="isi-materi">isi materi</label>
                                        <textarea id="isi-materi" name="isi-materi"></textarea>

                                    </div>
                                    <div class="form-group" >
                                        <label for="tujuan-dan-alat">tujuan & alat</label>
                                        <textarea id="tujuan-dan-alat" name="tujuan-dan-alat"></textarea>

                                    </div>
                                    <div class="form-group" >
                                        <label for="tambahan">tambahan</label>
                                        <textarea id="tambahan" name="tambahan"></textarea>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @if ($errors->any())
                    <script>
                        alert('{{$errors->first()}}');
                    </script>
                @endif


                <!-- <div>
                    <img src="image/gerakmelingkar.png" alt="gerakmelingkar">
                    <figcaption>Gerak Melingkar</figcaption>
                    <a href="">Lihat Detail -></a>
                </div>
                <div>
                    <img src="image/ayunanbandulsederhana.png" alt="ayunanbandul">
                    <figcaption>Ayunan Bandul Sederhana</figcaption>
                    <a href="">Lihat Detail -></a>
                </div>
                <div>
                    <img src="image/energipotensial.png" alt="energipotensial">
                    <figcaption>Energi Potensial</figcaption>
                    <a href="">Lihat Detail -></a>
                </div> -->

            <!-- <br><br><br><br><br><br>
            <div class="detail">
                <div>
                    <img src="image/gerakmelingkar.png" alt="gerakmelingkar">
                    <figcaption>Gerak Melingkar</figcaption>
                    <a href="">Lihat Detail -></a>
                </div>
                <div>
                    <img src="image/ayunanbandulsederhana.png" alt="ayunanbandul">
                    <figcaption>Ayunan Bandul Sederhana</figcaption>
                    <a href="">Lihat Detail -></a>
                </div>
                <div>
                    <img src="image/energipotensial.png" alt="energipotensial">
                    <figcaption>Energi Potensial</figcaption>
                    <a href="">Lihat Detail -></a>
                </div>
            </div> -->
        </div>
        <div class="pagination">
            {{ $materi->links('vendor.pagination.custom') }}
        </div>

    </main>
@endsection
@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<!-- <script src="https://cdn.ckeditor.com/ckeditor5/41.2.1/super-build/ckeditor.js"></script> -->
<!-- <script src="https://cdn.ckeditor.com/ckeditor5/41.2.1/classic/ckeditor.js"></script> -->
<script src="JavaScript/script-materi-add-update.js"></script>
@if (session('success'))
    <script>
        console.log('test successful');
        alert('{{ session('success') }}');
        resetForm();

    </script>
@endif
<!-- <script src="https://cdn.ckeditor.com/4.22.1/full-all/ckeditor.js"></script> -->

<script type="module" src="js/test.js"></script>
<!-- <script type="module" src="js/ckeditor.js"></script> -->

<script>
    // JavaScript function for confirmation dialog
    function confirmDeletion() {
        return confirm('Apakah Anda yakin ingin menghapus materi ini?');
    }
</script>

@endsection

