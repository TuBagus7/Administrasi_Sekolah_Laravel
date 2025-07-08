<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pengumuman; // Pastikan model benar
use Illuminate\Support\Facades\Storage;

class PengumumanController extends Controller
{
    /**
     * Tampilkan halaman pengumuman
     */
    public function index()
    {
        $pengumuman = Pengumuman::where('opsi', 'pengumuman')->first();
        return view('admin.pengumuman', compact('pengumuman'));
    }

    /**
     * Simpan atau perbarui pengumuman
     */
    public function simpan(Request $request)
    {
        $request->validate([
            'isi' => 'required|string',
            'file_pengumuman' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $data = [
            'isi' => $request->isi,
            'opsi' => 'pengumuman',
        ];

        if ($request->hasFile('file_pengumuman')) {
            $file = $request->file('file_pengumuman');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/pengumuman', $fileName);
            $data['file_path'] = 'pengumuman/' . $fileName;
        }

        // Simpan atau update berdasarkan ID (jika ada)
        Pengumuman::updateOrCreate(
            ['id' => $request->id],
            $data
        );

        return redirect()->back()->with('success', 'Pengumuman berhasil diperbarui!');
    }
}
