@extends('template_backend.home')

@section('heading', 'Riwayat Absensi Siswa')
@section('page')
    <li class="breadcrumb-item active">Riwayat Absensi</li>
@endsection

@section('content')

<div class="col-12">
    <div class="card">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <span>Riwayat Absensi Semua Siswa</span>
            {{-- Form filter tanggal --}}
            <form action="{{ route('guru.riwayat.absensiswa') }}" method="GET" class="form-inline">
                <label for="tanggal" class="mr-2 text-white">Filter Tanggal:</label>
                <input type="date" name="tanggal" id="tanggal" class="form-control mr-2" value="{{ request('tanggal') }}">
                <button type="submit" class="btn btn-light btn-sm mr-2">Filter</button>
                <a href="{{ route('guru.riwayat.absensiswa') }}" class="btn btn-secondary btn-sm">Reset</a>
            </form>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Siswa</th>
                        <th>Mapel</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Jam Absen</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($dataAbsensi as $index => $absen)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $absen->siswa->user->name ?? '-' }}</td>
                            <td>{{ $absen->mapel }}</td>
                            <td>{{ $absen->status }}</td>
                            <td>{{ \Carbon\Carbon::parse($absen->tanggal)->format('d-m-Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($absen->created_at)->format('H:i:s') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">Belum ada data absensi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@section('script')
    <script>
        $("#RiwayatAbsenSiswa").addClass("active");
    </script>
@endsection
