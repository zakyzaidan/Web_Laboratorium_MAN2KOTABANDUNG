@extends('layouts.main')
@section('css')
 <link rel="stylesheet" href="css/style-materi-add-update.css">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
@endsection
@section('page')
    <main>
        <div class="materi-pembelajaran">
            <div class="header">
                <h2>MATERI PEMBELAJARAN <br> PRAKTIKUM</h2>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">+</button>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Materi</h5>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
                            <button type="button" class="btn btn-primary">Simpan</button>
                        </div>
                        <div class="modal-body">
                            <form>
                            <div class="form-group">
                                <label for="thumbnail">Thumbnail Materi</label>
                                <div class="thumbnail">
                                    <img id="image-preview" src="image/image-default.png" alt="Preview Image">
                                    <div class="foto">
                                        <p>Unggah Thumbnail materi 1 Anda di sini. <b>Pedoman penting</b>: 347x288 piksel. <b>Format yang didukung</b>: .jpg, .jpeg, atau .png</p>
                                        <label for="image-upload" class="custom-file-upload">
                                            Unggah foto  <i class="fas fa-upload"></i>
                                        </label>
                                        <input id="image-upload" type="file" accept=".jpg, .jpeg, .png" onchange="previewImage()"/>
                                    </div>
                                </div>
                                <div class="thumbnail">
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
                            <div class="form-group">
                                <label for="judul">Judul:</label>
                                <input type="text" class="form-control" id="judul">
                            </div>
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi:</label>
                                <textarea class="form-control" id="deskripsi"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="detailEksperimen">Detail Eksperimen:</label>
                                <textarea class="form-control" id="detailEksperimen"></textarea>
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
@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="JavaScript/script-materi-add-update.js"></script>
<script src="JavaScript/script-landing.js"></script>
@endsection
@endsection

