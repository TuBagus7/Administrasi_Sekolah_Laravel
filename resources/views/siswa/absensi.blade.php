@extends('layouts.app')

@section('content')
<div class="row">
    <!-- Kolom Kiri: Tabel Absensi -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-primary text-white">Daftar Absensi Hari Ini</div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>Kelas</th>
                            <th>Mapel</th>
                            <th>Status</th>
                            <th>Jam Absen</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($dataAbsensi as $index => $absen)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $absen->siswa->nama }}</td>
                            <td>{{ $absen->siswa->kelas->nama ?? '-' }}</td>
                            <td>{{ $absen->mapel }}</td>
                            <td>{{ $absen->status }}</td>
                            <td>{{ $absen->created_at->format('H:i:s') }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="6" class="text-center">Belum ada data absensi</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Kolom Kanan: Form Absensi -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-primary text-white">Absen Siswa</div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form action="{{ route('absensi.siswa.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Mata Pelajaran</label>
                        <select name="mapel" class="form-control" required>
                            @foreach ($mapel as $m)
                                <option value="{{ $m }}">{{ $m }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mt-2">
                        <label>Status Kehadiran</label>
                        <select name="status" class="form-control" required>
                            <option value="">-- Pilih Status --</option>
                            <option value="Hadir">Hadir</option>
                            <option value="Izin">Izin</option>
                            <option value="Sakit">Sakit</option>
                            <option value="Alpha">Alpha</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">
                        <i class="fa fa-save"></i> Absen
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
