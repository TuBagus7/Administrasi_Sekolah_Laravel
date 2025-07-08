<?php

namespace App\Http\Controllers;

use App\Mapel;
use Illuminate\Http\Request;
use App\Models\Absensi;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AbsensiSiswaController extends Controller
{
    public function __construct()
    {
        // Pastikan user sudah login untuk semua method di controller ini
        $this->middleware('auth');
    }

    /**
     * Tampilkan form absensi untuk siswa
     */
    public function index()
    {
        $tanggal = Carbon::now()->toDateString();
        $mapel = Mapel::pluck('nama_mapel');
    
        $dataAbsensiHariIni = []; // ← tambahkan inisialisasi awal dulu
    
        $user = Auth::user();
        $siswa = $user->siswa;
    
        if ($siswa) {
            $dataAbsensiHariIni = \App\Models\Absensi::where('siswa_id', $siswa->id)
                ->where('tanggal', $tanggal)
                ->get();
        }
    
        return view('siswa.absensi.index', compact('tanggal', 'mapel', 'dataAbsensiHariIni'));
    }
    

    /**
     * Simpan absensi yang diisi siswa
     */
    public function store(Request $request)
    {
        $request->validate([
            'mapel' => 'required',
            'status' => 'required|in:Hadir,Izin,Sakit,Alpha',
        ]);

        // Pastikan user punya relasi siswa (gunakan relasi di model User)
        $user = Auth::user();
        if (!$user->siswa) {
            return back()->with('error', 'Data siswa tidak ditemukan.');
        }

        $siswa = $user->siswa;

        // Cegah dobel absensi per siswa per hari per mapel dengan updateOrCreate
        Absensi::updateOrCreate(
            [
                'siswa_id' => $siswa->id,
                'tanggal' => Carbon::now()->toDateString(),
                'mapel' => $request->mapel,
            ],
            [
                'status' => $request->status,
            ]
        );

        return back()->with('success', 'Absensi berhasil disimpan.');
    }
}
