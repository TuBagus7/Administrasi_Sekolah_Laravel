@extends('layouts.app') {{-- Sesuaikan dengan layout Anda --}}

@section('content')
<div class="container">
    <h2>Dashboard Guru</h2>
    <hr>
    <p>Selamat datang, {{ $guru->nama_guru }}</p>

    <div class="row mt-4">
        {{-- Card Jumlah Kehadiran --}}
        <div class="col-md-4">
            <a href="{{ url('/absen/harian') }}" style="text-decoration: none;">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <h5 class="card-title">Jumlah Kehadiran</h5>
                        <p class="card-text">{{ $jumlahAbsen }} hari</p>
                    </div>
                </div>
            </a>
        </div>

        {{-- Card Absen Hari Ini --}}
        <div class="col-md-4">
            <a href="{{ url('/absen/harian') }}" style="text-decoration: none;">
                <div class="card text-white bg-success">
                    <div class="card-body">
                        <h5 class="card-title">Absen Hari Ini</h5>
                        <p class="card-text">
                            @if($absenHariIni)
                                Sudah absen ({{ $absenHariIni->kehadiran->nama_kehadiran }})
                            @else
                                Belum absen
                            @endif
                        </p>
                    </div>
                </div>
            </a>
        </div>

        {{-- Card Total Jadwal --}}
        <div class="col-md-4">
            <a href="{{ url('/jadwal/guru') }}" style="text-decoration: none;">
                <div class="card text-white bg-info">
                    <div class="card-body">
                        <h5 class="card-title">Total Jadwal</h5>
                        <p class="card-text">{{ $jadwal->count() }} jadwal</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4 mt-4">
            <a href="{{ url('/ulangan') }}" style="text-decoration: none;">
                <div class="card text-white bg-secondary">
                    <div class="card-body">
                        <h5 class="card-title">Input Nilai</h5>
                    </div>
                </div>
            </a>
        </div>

            {{-- Card Absen Siswa --}}
            <div class="col-md-4 mt-4">
    <a href="{{ route('guru.riwayat.absensiswa') }}" style="text-decoration: none;">
        <div class="card text-white bg-success">
            <div class="card-body">
                <h5 class="card-title">Absen Siswa Hari Ini</h5>
                </p>
            </div>
        </div>
    </a>
</div>

</div>
@endsection
