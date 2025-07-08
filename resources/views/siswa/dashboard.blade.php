@extends('layouts.app')

@section('title', 'Dashboard Siswa')

@section('content')
<div class="container">
    <h1>Selamat Datang di Dashboard Siswa</h1>
    <p>Halo, {{ Auth::user()->name }}! Ini adalah halaman dashboard khusus siswa.</p>

    <div class="row mt-4">
        {{-- Card Jumlah Kehadiran --}}
        <div class="col-md-4">
            <a href="{{ url('/siswa/absensi') }}" style="text-decoration: none;">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <h5 class="card-title">Absen</h5>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ url('/siswa/jadwal') }}" style="text-decoration: none;">
                <div class="card text-white bg-warning">
                    <div class="card-body">
                        <h5 class="card-title">Jadwal</h5>
                    </div>
                </div>
            </a>
        </div>

        {{-- Card Absen Hari Ini --}}
        <div class="col-md-4">
            <a href="{{ url('siswa/ulangan') }}" style="text-decoration: none;">
                <div class="card text-white bg-success">
                    <div class="card-body">
                        <h5 class="card-title">Ulangan</h5>
                        <p class="card-text">
                            
                        </p>
                    </div>
                </div>
            </a>
        </div>

        {{-- Card Total Jadwal --}}
        <div class="col-md-4 mt-4">
            <a href="{{ url('siswa/sikap') }}" style="text-decoration: none;">
                <div class="card text-white bg-secondary">
                    <div class="card-body">
                        <h5 class="card-title">Sikap</h5>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4 mt-4">
            <a href="{{ url('siswa/rapot') }}" style="text-decoration: none;">
                <div class="card text-white bg-info">
                    <div class="card-body">
                        <h5 class="card-title">Rapot</h5>
                        </div>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection

