@extends('template_backend.home')

@section('heading', 'Pengumuman')

@section('page')
    <li class="breadcrumb-item active">Pengumuman</li>
@endsection

@section('content')
<div class="col-md-12">
    <div class="card card-outline card-info">
        <form class="form-group" action="{{ route('admin.pengumuman.simpan') }}" method="post">
            @csrf

            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">Form Pengumuman</h3>
                <div class="d-flex gap-2">
                    <button type="submit" name="submit" class="btn btn-outline-primary">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                    <button type="button" class="btn btn-tool btn-sm" data-card-widget="remove" data-toggle="tooltip" title="Tutup">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>

            <div class="card-body pad">
                <div class="mb-3">
                    <input type="hidden" name="id" value="{{ $pengumuman->id ?? '' }}">
                    <textarea class="textarea form-control @error('isi') is-invalid @enderror" 
                              name="isi" 
                              placeholder="Tulis pengumuman di sini..." 
                              style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                        {{ old('isi', $pengumuman->isi ?? '') }}
                    </textarea>
                    @error('isi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('script')
<script>
    $("#Pengumuman").addClass("active");
</script>
@endsection
