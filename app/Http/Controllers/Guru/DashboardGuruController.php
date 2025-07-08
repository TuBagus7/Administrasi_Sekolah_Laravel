<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Absen;
use App\Models\Jadwal;
use App\Models\Guru;

class DashboardGuruController extends Controller
{
    public function index()
    {
        $guru = Auth::guard('guru')->user();

        $jumlahAbsen = Absen::where('guru_id', $guru->id)->count();

        $absenHariIni = Absen::where('guru_id', $guru->id)
            ->whereDate('tanggal', now())
            ->first();

        $jadwal = Jadwal::where('guru_id', $guru->id)->get();

        return view('guru.dashboard', compact('guru', 'jumlahAbsen', 'absenHariIni', 'jadwal'));
    }
}
