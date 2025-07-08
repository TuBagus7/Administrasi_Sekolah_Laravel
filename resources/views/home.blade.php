@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Dashboard Admin</h1>

    <div class="row">
        <div class="col-md-3 mb-3">
            <a href="{{ url('/guru') }}" class="btn btn-primary btn-block">Manajemen Guru</a>
        </div>
        <div class="col-md-3 mb-3">
            <a href="{{ url('/siswa') }}" class="btn btn-success btn-block">Manajemen Siswa</a>
        </div>
        <div class="col-md-3 mb-3">
            <a href="{{ url('/kelas') }}" class="btn btn-info btn-block">Manajemen Kelas</a>
        </div>
        <div class="col-md-3 mb-3">
            <a href="{{ url('/mapel') }}" class="btn btn-warning btn-block">Manajemen Mapel</a>
        </div>
        <div class="col-md-3 mb-3">
            <a href="{{ url('/jadwal') }}" class="btn btn-danger btn-block">Jadwal</a>
        </div>
        <div class="col-md-3 mb-3">
            <a href="{{ url('/nilai') }}" class="btn btn-secondary btn-block">Nilai</a>
        </div>
        <div class="col-md-3 mb-3">
            <a href="{{ url('/sikap') }}" class="btn btn-dark btn-block">Sikap</a>
        </div>
        <div class="col-md-3 mb-3">
            <a href="{{ url('/ulangan') }}" class="btn btn-outline-primary btn-block">Ulangan</a>
        </div>
        <div class="col-md-3 mb-3">
            <a href="{{ url('/rapot') }}" class="btn btn-outline-success btn-block">Rapot</a>
        </div>
        <div class="col-md-3 mb-3">
            <a href="{{ url('/user') }}" class="btn btn-outline-info btn-block">Manajemen User</a>
        </div>
        <div class="col-md-3 mb-3">
            <a href="{{ url('/admin/pengumuman') }}" class="btn btn-outline-warning btn-block">Pengumuman</a>
        </div>
    </div>
</div>
@endsection
