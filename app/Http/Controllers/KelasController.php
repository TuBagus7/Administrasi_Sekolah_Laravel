<?php

namespace App\Http\Controllers;

use App\Kelas;
use App\Guru;
use App\Jadwal;
use App\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::orderBy('nama_kelas', 'asc')->get();
        $guru = Guru::orderBy('nama_guru', 'asc')->get();
        return view('admin.kelas.index', compact('kelas', 'guru'));
    }

    public function create()
    {
        $guru = Guru::orderBy('nama_guru', 'asc')->get();
        return view('admin.kelas.create', compact('guru'));
    }

    public function store(Request $request)
    {
        if ($request->id != '') {
            $this->validate($request, [
                'nama_kelas' => 'required|min:6|max:10',
                'guru_id' => 'required|unique:kelas',
            ]);
        } else {
            $this->validate($request, [
                'nama_kelas' => 'required|unique:kelas|min:6|max:10',
                'guru_id' => 'required|unique:kelas',
            ]);
        }

        Kelas::updateOrCreate(
            ['id' => $request->id],
            [
                'nama_kelas' => $request->nama_kelas,
                'guru_id' => $request->guru_id,
            ]
        );

        return redirect()->back()->with('success', 'Data kelas berhasil diperbarui!');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);
        $countJadwal = Jadwal::where('kelas_id', $kelas->id)->count();
        if ($countJadwal >= 1) {
            Jadwal::where('kelas_id', $kelas->id)->delete();
        }

        $countSiswa = Siswa::where('kelas_id', $kelas->id)->count();
        if ($countSiswa >= 1) {
            Siswa::where('kelas_id', $kelas->id)->delete();
        }

        $kelas->delete();
        return redirect()->back()->with('warning', 'Data kelas berhasil dihapus! (Silahkan cek trash data kelas)');
    }

    public function trash()
    {
        $kelas = Kelas::onlyTrashed()->get();
        return view('admin.kelas.trash', compact('kelas'));
    }

    public function restore($id)
    {
        $id = Crypt::decrypt($id);
        $kelas = Kelas::withTrashed()->findOrFail($id);

        $countJadwal = Jadwal::withTrashed()->where('kelas_id', $kelas->id)->count();
        if ($countJadwal >= 1) {
            Jadwal::withTrashed()->where('kelas_id', $kelas->id)->restore();
        }

        $countSiswa = Siswa::withTrashed()->where('kelas_id', $kelas->id)->count();
        if ($countSiswa >= 1) {
            Siswa::withTrashed()->where('kelas_id', $kelas->id)->restore();
        }

        $kelas->restore();
        return redirect()->back()->with('info', 'Data kelas berhasil direstore! (Silahkan cek data kelas)');
    }

    public function kill($id)
    {
        $kelas = Kelas::withTrashed()->findOrFail($id);

        $countJadwal = Jadwal::withTrashed()->where('kelas_id', $kelas->id)->count();
        if ($countJadwal >= 1) {
            Jadwal::withTrashed()->where('kelas_id', $kelas->id)->forceDelete();
        }

        $countSiswa = Siswa::withTrashed()->where('kelas_id', $kelas->id)->count();
        if ($countSiswa >= 1) {
            Siswa::withTrashed()->where('kelas_id', $kelas->id)->forceDelete();
        }

        $kelas->forceDelete();
        return redirect()->back()->with('success', 'Data kelas berhasil dihapus secara permanen');
    }

    public function getEdit(Request $request)
    {
        $kelas = Kelas::where('id', $request->id)->get();
        foreach ($kelas as $val) {
            $newForm[] = [
                'id' => $val->id,
                'nama' => $val->nama_kelas,
                'guru_id' => $val->guru_id,
            ];
        }
        return response()->json($newForm);
    }
}
