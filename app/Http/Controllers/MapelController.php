<?php

namespace App\Http\Controllers;

use App\Jadwal;
use App\Mapel;
use App\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

class MapelController extends Controller
{
    public function index()
    {
        $mapel = Mapel::orderBy('kelompok', 'asc')->orderBy('nama_mapel', 'asc')->get();
        return view('admin.mapel.index', compact('mapel'));
    }

    public function create()
    {
        // 
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_mapel' => 'required',
            'kelompok' => 'required'
        ]);

        Mapel::updateOrCreate(
            ['id' => $request->mapel_id],
            [
                'nama_mapel' => $request->nama_mapel,
                'kelompok' => $request->kelompok,
            ]
        );

        return redirect()->back()->with('success', 'Data mapel berhasil diperbarui!');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $mapel = Mapel::findOrFail($id);
        return view('admin.mapel.edit', compact('mapel'));
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $mapel = Mapel::findOrFail($id);
        $countJadwal = Jadwal::where('mapel_id', $mapel->id)->count();
        if ($countJadwal >= 1) {
            Jadwal::where('mapel_id', $mapel->id)->delete();
        }

        $countGuru = Guru::where('mapel_id', $mapel->id)->count();
        if ($countGuru >= 1) {
            Guru::where('mapel_id', $mapel->id)->delete();
        }

        $mapel->delete();
        return redirect()->back()->with('warning', 'Data mapel berhasil dihapus! (Silahkan cek trash data mapel)');
    }

    public function trash()
    {
        $mapel = Mapel::onlyTrashed()->get();
        return view('admin.mapel.trash', compact('mapel'));
    }

    public function restore($id)
    {
        $id = Crypt::decrypt($id);
        $mapel = Mapel::withTrashed()->findOrFail($id);

        $countJadwal = Jadwal::withTrashed()->where('mapel_id', $mapel->id)->count();
        if ($countJadwal >= 1) {
            Jadwal::withTrashed()->where('mapel_id', $mapel->id)->restore();
        }

        $countGuru = Guru::withTrashed()->where('mapel_id', $mapel->id)->count();
        if ($countGuru >= 1) {
            Guru::withTrashed()->where('mapel_id', $mapel->id)->restore();
        }

        $mapel->restore();
        return redirect()->back()->with('info', 'Data mapel berhasil direstore! (Silahkan cek data mapel)');
    }

    public function kill($id)
    {
        $mapel = Mapel::withTrashed()->findOrFail($id);

        $countJadwal = Jadwal::withTrashed()->where('mapel_id', $mapel->id)->count();
        if ($countJadwal >= 1) {
            Jadwal::withTrashed()->where('mapel_id', $mapel->id)->forceDelete();
        }

        $countGuru = Guru::withTrashed()->where('mapel_id', $mapel->id)->count();
        if ($countGuru >= 1) {
            Guru::withTrashed()->where('mapel_id', $mapel->id)->forceDelete();
        }

        $mapel->forceDelete();
        return redirect()->back()->with('success', 'Data mapel berhasil dihapus secara permanen');
    }

    public function getMapelJson(Request $request)
    {
        $jadwal = Jadwal::orderBy('mapel_id', 'asc')->where('kelas_id', $request->kelas_id)->get();
        $jadwal = $jadwal->groupBy('mapel_id');

        foreach ($jadwal as $val => $data) {
            $newForm[] = [
                'mapel' => $data[0]->pelajaran($val)->nama_mapel,
                'guru' => $data[0]->pengajar($data[0]->guru_id)->id
            ];
        }

        return response()->json($newForm);
    }
}
