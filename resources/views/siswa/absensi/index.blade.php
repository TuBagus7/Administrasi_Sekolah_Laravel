@extends('template_backend.home')

@section('heading', 'Absensi Harian Siswa')
@section('page')
    <li class="breadcrumb-item active">Absensi Harian</li>
@endsection

@section('content')

<!-- Form Absensi (Full Width) -->
<div class="col-12">
    <div class="card">
        <div class="card-header bg-primary text-white">
            Absensi Hari Ini ({{ $tanggal }})
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('absensi.siswa.store') }}">
                @csrf

                <div class="form-group">
                    <label for="mapel">Mata Pelajaran</label>
                    <select name="mapel" id="mapel" class="form-control" required>
                        @foreach ($mapel as $m)
                            <option value="{{ $m }}">{{ $m }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mt-2">
                    <label for="status">Status Kehadiran</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="Hadir">Hadir</option>
                        <option value="Izin">Izin</option>
                        <option value="Sakit">Sakit</option>
                        <option value="Alpha">Alpha</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary mt-3 w-100">
                    <i class="fas fa-save"></i> Simpan Absensi
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Riwayat Absensi (Full Width) -->
<div class="col-12 mt-4">
    <div class="card">
        <div class="card-header bg-dark text-white">
            Riwayat Absensi Hari Ini
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Mapel</th>
                        <th>Status</th>
                        <th>Jam Absen</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($dataAbsensiHariIni as $index => $absen)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $absen->mapel }}</td>
                            <td>{{ $absen->status }}</td>
                            <td>{{ \Carbon\Carbon::parse($absen->created_at)->format('H:i:s') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">Belum ada data absensi hari ini.</td>
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
        $("#AbsensiSiswa").addClass("active");
    </script>
@endsection
