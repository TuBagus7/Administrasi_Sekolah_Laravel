<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    // Tambahkan 'file_path' agar bisa disimpan
    protected $fillable = ['opsi', 'isi', 'file_path'];

    protected $table = 'pengumuman';
}
