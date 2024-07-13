@extends('layouts.dashboard-layouts-fisika')

@section('css')
<link rel="stylesheet" href="{{ asset('css/style-detail.css') }}">

@endsection

@section('page')
<div class="container">
        <a href="/inventarisasi-alat-fisika/" class="btn-back"><i class="fas fa-arrow-left"></i> Kembali</a>
        <h3>Kartu Alat</h3>
        <div class="card-container">
            <div class="card">
                <img src="{{ asset(Storage::url($alat->foto)) }}" alt="Ethanol">
                <div class="data">
                    <h1>{{ $alat->nama_alat }}</h1>
                    <p><strong>Golongan:</strong> {{ $alat->golongan }}</p>
                    <hr>
                    <p><strong>Merk:</strong> {{ $alat->merk }}</p>
                    <hr>
                    <p><strong>Ukuran:</strong> {{ $alat->ukuran }}</p>
                    <hr>
                    <p><strong>Produksi:</strong> {{ $alat->produksi }}</p>
                    <hr>
                    @php
                        use Carbon\Carbon;
                    @endphp
                    <p><strong>Tanggal Masuk:</strong> {{ Carbon::parse($alat->tanggal_masuk)->translatedFormat('d F Y') }}</p>
                    <hr>
                    <p><strong>Lokasi Penyimpanan:</strong> {{ $alat->lokasi_penyimpanan }}</p>
                    <hr>
                    <p><strong>Persediaan:</strong> Layak <i class="far fa-square" style="color: #03378A;"></i>  Tidak Layak <i class="fas fa-square" style="color: #03378A;"></i></p>
                    <div class="btn-group">
                        <button class="btn btn-left">{{ $alat->kondisi_baik }} {{ $alat->satuan }}</button>
                        <button class="btn btn-right">{{ $alat->kondisi_buruk }} {{ $alat->satuan }}</button>
                    </div>
                    <hr>
                    <p><strong>Keterangan:</strong></p>
                    <textarea class="form-control" rows="3" readonly>{{ $alat->keterangan }}</textarea>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
@endsection
