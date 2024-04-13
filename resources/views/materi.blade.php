@extends('layouts.main')
@section('css')
 <link rel="stylesheet" href="{{ asset('css/style-materi.css') }}">
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
 <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">

@endsection
@section('page')
<main>
    <div class="konten-keseluruhan">
        <div class="konten-utama">
            <h2>{{ $materi->judul_materi }}</h2>
            <!-- <img src="{{ asset(Storage::url($materi->thubnail_materi)) }}" alt="gerakmelingkar"> -->
            <div class="materi-pemberajaran-html">
                <iframe id="html-preview" style="position: relative;"></iframe>
                <button id="fullscreen-button" >⛶</button>
            </div>
            <script>
                function previewHTMLFileFromServer(url) {
                    fetch(url)
                        .then(response => response.text())
                        .then(data => {
                            var preview = document.querySelector('#html-preview');
                            preview.srcdoc = data;
                        });
                }

                previewHTMLFileFromServer("{{ asset(Storage::url($materi->modul_pembelajaran_materi)) }}");

                document.querySelector('#fullscreen-button').addEventListener('click', function() {
                    var preview = document.querySelector('#html-preview');
                    if (preview.requestFullscreen) {
                        preview.requestFullscreen();
                    } else if (preview.mozRequestFullScreen) { // Firefox
                        preview.mozRequestFullScreen();
                    } else if (preview.webkitRequestFullscreen) { // Chrome, Safari and Opera
                        preview.webkitRequestFullscreen();
                    } else if (preview.msRequestFullscreen) { // IE/Edge
                        preview.msRequestFullscreen();
                    }
                });
            </script>
            <div id="isi-materi">
                {!! $materi->isi_materi !!}
            </div>
            <script src="{{ asset('JavaScript/script-materi.js') }}"></script>
        </div>
        <div class="tambahan">
            <div class="satu">
                <div id="tujuan-dan-alat-materi">
                    {!! $materi->tujuan_dan_alat_materi !!}
                </div>
            </div>
            <div class="dua">
                <div id="tambahan-materi">
                    {!! $materi->tambahan_materi !!}
                </div>
            </div>
        </div>
    </div>
</main>
@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#isi-materi').summernote({
            toolbar: false,
            disableDragAndDrop: true,
            disableResizeEditor: true
        });

        $('#tujuan-dan-alat-materi').summernote({
            toolbar: false,
            disableDragAndDrop: true,
            disableResizeEditor: true
        });

        $('#tambahan-materi').summernote({
            toolbar: false,
            disableDragAndDrop: true,
            disableResizeEditor: true
        });

    });
</script>
<!-- <script src="JavaScript/script-materi-add-update.js"></script> -->
<!-- {{ asset('css/style-materi.css') }} -->
@endsection
@endsection






