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
            </div>
            <div class="detail">
                <?php $i = 0; ?>
                @foreach ($materi as $item)
                    <div class="tampilan-materi">
                        <div class="tampilan-foto">
                            <a href="/materi/{{$item->id_materi}}">
                                <img src="{{ asset(Storage::url($item->thubnail_materi)) }}" alt="gerakmelingkar">
                            </a>
                        </div>
                        <figcaption>
                            {{ $item->judul_materi }}
                        </figcaption>
                    </div>
                    <?php $i++; ?>
                    @if ($i % 3 == 0)
                        </div><div class="detail">
                    @endif
                @endforeach
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
<script src="JavaScript/script-materi-add-update.js"></script>
@if (session('success'))
    <script>
        console.log('test successful');
        alert('{{ session('success') }}');
        resetForm();

    </script>
@endif
<script type="module" src="js/test.js"></script>
@endsection

