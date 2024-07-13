@extends('layouts.dashboard-layouts-fisika')

@section('css')
<link rel="stylesheet" href="{{ asset('css/style-detail.css') }}">

@endsection

@section('page')
<div class="container">
        <a href="/inventarisasi-bahan-fisika/" class="btn-back"><i class="fas fa-arrow-left"></i> Kembali</a>
        <h3>Kartu Bahan</h3>
        <div class="card-container">
            <div class="card">
                <img src="{{ asset(Storage::url($bahan->foto)) }}" alt="Ethanol">
                <div class="data">
                    <h1>{{ $bahan->nama_bahan }}</h1>
                    <p><strong>Golongan:</strong> {{ $bahan->golongan }}</p>
                    <hr>
                    <p><strong>Mr:</strong> {{ $bahan->mr }}</p>
                    <hr>
                    <p><strong>Kemurnian:</strong> {{ $bahan->kemurnian }}</p>
                    <hr>
                    <p><strong>Konsentrasi:</strong> {{ $bahan->konsentrasi }}</p>
                    <hr>
                    <p><strong>wujud:</strong> {{ $bahan->wujud }}</p>
                    <hr>
                    <p><strong>Merk:</strong> {{ $bahan->merk }}</p>
                    <hr>
                    <p><strong>Produksi:</strong> {{ $bahan->produksi }}</p>
                    <hr>
                    <p><strong>Lokasi Penyimpanan:</strong> {{ $bahan->lokasi_penyimpanan }}</p>
                    <hr>
                    @php
                        use Carbon\Carbon;
                    @endphp
                    <p><strong>Tanggal Masuk:</strong> {{ Carbon::parse($bahan->tanggal_masuk)->translatedFormat('d F Y') }}</p>
                    <hr>
                    <p><strong>Persediaan:</strong> Layak <i class="far fa-square" style="color: #03378A;"></i>  Tidak Layak <i class="fas fa-square" style="color: #03378A;"></i></p>
                    <div class="btn-group">
                        <button class="btn btn-left">{{ $bahan->kondisi_baik }} {{ $bahan->satuan }}</button>
                        <button class="btn btn-right">{{ $bahan->kondisi_buruk }} {{ $bahan->satuan }}</button>
                    </div>
                    <hr>
                    <p><strong>Keterangan:</strong></p>
                    <textarea class="form-control" rows="3" readonly>{{ $bahan->keterangan }}</textarea>
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
