<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Guru extends Model
{
    use SoftDeletes;

    protected $table = 'guru';

    protected $fillable = [
        'id_card',
        'nip',
        'nama_guru',
        'mapel_id',
        'kode',
        'jk',
        'telp',
        'tmp_lahir',
        'tgl_lahir',
        'foto',
    ];

    public function mapel()
    {
        return $this->belongsTo('App\Mapel')->withDefault();
    }

    public function dsk($id)
    {
        return \App\Nilai::where('guru_id', $id)->first();
    }

    // Tambahan relasi dari file satunya
    public function absen()
    {
        return $this->hasMany(\App\Absen::class);
    }

    public function jadwal()
    {
        return $this->hasMany(\App\Jadwal::class);
    }
}
