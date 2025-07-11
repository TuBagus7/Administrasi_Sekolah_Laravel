@extends('template_backend.home')
@section('heading', 'Show Rapot')
@section('page')
  <li class="breadcrumb-item active">Show Rapot</li>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Show Rapot</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <table class="table" style="margin-top: -10px;">
                        <tr>
                            <td>No Induk Siswa</td>
                            <td>:</td>
                            <td>{{ $siswa->no_induk }}</td>
                        </tr>
                        <tr>
                            <td>Nama Siswa</td>
                            <td>:</td>
                            <td>{{ $siswa->nama_siswa }}</td>
                        </tr>
                        <tr>
                            <td>Nama Kelas</td>
                            <td>:</td>
                            <td>{{ $kelas->nama_kelas }}</td>
                        </tr>
                        <tr>
                            <td>Wali Kelas</td>
                            <td>:</td>
                            <td>{{ $kelas->guru->nama_guru }}</td>
                        </tr>
                        @php
                            $bulan = date('m');
                            $tahun = date('Y');
                        @endphp
                        <tr>
                            <td>Semester</td>
                            <td>:</td>
                            <td>
                                {{ $bulan > 6 ? 'Semester Ganjil' : 'Semester Genap' }}
                            </td>
                        </tr>
                        <tr>
                            <td>Tahun Pelajaran</td>
                            <td>:</td>
                            <td>
                                {{ $bulan > 6 ? $tahun . '/' . ($tahun + 1) : ($tahun - 1) . '/' . $tahun }}
                            </td>
                        </tr>
                    </table>
                    <hr>
                </div>
                <div class="col-md-12">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="ctr" rowspan="2">No.</th>
                                <th rowspan="2">Mata Pelajaran</th>
                                <th class="ctr" colspan="3">Pengetahuan</th>
                                <th class="ctr" colspan="3">Keterampilan</th>
                            </tr>
                            <tr>
                                <th class="ctr">Nilai</th>
                                <th class="ctr">Predikat</th>
                                <th class="ctr">Deskripsi</th>
                                <th class="ctr">Nilai</th>
                                <th class="ctr">Predikat</th>
                                <th class="ctr">Deskripsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mapel as $val => $data)
                                @php
                                    $data = $data[0];
                                    $array = ['mapel' => $val, 'siswa' => $siswa->id];
                                    $jsonData = json_encode($array);
                                    $rapot = $data->cekRapot($jsonData);
                                @endphp
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->mapel->nama_mapel ?? '-' }}</td>
                                    <td class="ctr">{{ $rapot['p_nilai'] ?? '-' }}</td>
                                    <td class="ctr">{{ $rapot['p_predikat'] ?? '-' }}</td>
                                    <td class="ctr">{{ $rapot['p_deskripsi'] ?? '-' }}</td>
                                    <td class="ctr">{{ $rapot['k_nilai'] ?? '-' }}</td>
                                    <td class="ctr">{{ $rapot['k_predikat'] ?? '-' }}</td>
                                    <td class="ctr">{{ $rapot['k_deskripsi'] ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        $("#Nilai").addClass("active");
        $("#liNilai").addClass("menu-open");
        $("#Rapot").addClass("active");
    </script>
@endsection
