<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Siswa; // ✅ Tambahan penting!

class Absensi extends Model
{
    protected $table = 'absensi';

    protected $fillable = ['siswa_id', 'tanggal', 'mapel', 'status'];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
