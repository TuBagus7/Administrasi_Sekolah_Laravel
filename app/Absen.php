<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Guru;
use App\Kehadiran;

class Absen extends Model
{
    protected $table = 'absensi_guru';

    protected $fillable = ['guru_id', 'tanggal', 'kehadiran_id'];

    public function guru()
    {
        return $this->belongsTo(Guru::class)->withDefault();
    }

    public function kehadiran()
    {
        return $this->belongsTo(Kehadiran::class, 'kehadiran_id')->withDefault();
    }
}
