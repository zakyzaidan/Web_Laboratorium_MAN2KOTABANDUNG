@extends('layouts.main')
@section('css')
 <link rel="stylesheet" href="css/style-materi-add-update.css">
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
 <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endsection
@section('page')
    <main>

        <div class="materi-pembelajaran">
            <div class="header">
                <h2>MATERI PEMBELAJARAN <br> PRAKTIKUM</h2>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">+</button>


                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
                    <div class="modal-dialog modal-xl" role="document" >
                        <div class="modal-content" >
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Materi</h5>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
                            <button type="button" class="btn btn-primary">Simpan</button>
                        </div>
                        <div class="modal-body">
                            <form>
                            <div class="form-group">

                                <label for="thumbnail">tampilan materi & modul pembelajaran</label>
                                <div class="thumbnail">
                                    <div class="input">
                                        <img id="image-preview" src="image/image-default.png" alt="Preview Image">
                                        <div class="foto">
                                            <p>Unggah Thumbnail materi 1 Anda di sini. <b>Pedoman penting</b>: 347x288 piksel. <b>Format yang didukung</b>: .jpg, .jpeg, atau .png</p>
                                            <label for="image-upload" class="custom-file-upload">
                                                Unggah foto  <i class="fas fa-upload"></i>
                                            </label>
                                            <input id="image-upload" type="file" accept=".jpg, .jpeg, .png" onchange="previewImage()"/>
                                        </div>
                                    </div>
                                    <div class="input">
                                        <iframe id="html-preview"></iframe>
                                        <div class="html">
                                            <p>Unggah Simulasi pada materi yang akan anda unggah. </p>
                                            <label for="html-upload" class="custom-file-upload">
                                                Unggah Laman  <i class="fas fa-upload"></i>
                                            </label>
                                            <input id="html-upload" type="file" accept=".html" onchange="previewHTMLFile()">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="form-group">
                                <label for="judul">Judul</label>
                                <div class="gabung-input-text">
                                    <input type="text" class="form-control" id="judul" maxlength="80" placeholder="Silahkan Tuliskan Judul Materi" oninput="updateCount()">
                                    <small id="judulHelp" class="form-text text-muted">0/80</small>
                                </div>
                            </div>
                            <div class="form-group" >
                                <label for="isi-materi">isi materi</label>
                                <textarea id="edit1" name="editordata"></textarea>

                            </div>
                            <div class="form-group" >
                                <label for="tujuan-dan-alat">tujuan & alat</label>
                                <textarea id="edit2" name="editordata"></textarea>

                            </div>
                            <div class="form-group" >
                                <label for="tambahan">tambahan</label>
                                <textarea id="edit3" name="editordata"></textarea>

                            </div>
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
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
            </div>
            <br><br><br><br><br><br>
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
            </div>
        </div>



        <br><br><br><br>
        <div class="pagination">
            <a href="#">«</a>
            <a href="#">1</a>
            <a href="#" class="">2</a>
            <a href="#">3</a>
            <a href="#">4</a>
            <a href="#">5</a>
            <a href="#">»</a>
        </div>
        <br><br><br><br>
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

<!-- <script src="https://cdn.ckeditor.com/4.22.1/full-all/ckeditor.js"></script> -->

<script type="module" src="js/test.js"></script>
<!-- <script type="module" src="js/ckeditor.js"></script> -->

@endsection

