<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Absensi;
use App\Models\Mahasiswa;
use App\Models\Matakuliah;

class AbsensiController extends Controller
{
    // Menampilkan halaman absensi
    public function index()
    {
        $mahasiswa = Mahasiswa::all();
        $matakuliah = Matakuliah::all();

        $absensi = DB::table('absensis')
            ->join('mahasiswas', 'absensis.mahasiswa_id', '=', 'mahasiswas.id')
            ->join('matakuliah', 'absensis.matakuliah_id', '=', 'matakuliah.id')
            ->select(
                'absensis.*',
                'mahasiswas.NIM',
                'mahasiswas.name',
                'matakuliah.kode',
                'matakuliah.nama_matakuliah'
            )
            ->get();

        return view('absensi.index', compact(
            'mahasiswa',
            'matakuliah',
            'absensi'
        ));
    }

    // Menyimpan absensi semua mahasiswa
    public function store(Request $request)
    {
        $request->validate([
            'matakuliah_id' => 'required|exists:matakuliah,id',
            'tanggal_absensi' => 'required|date',
            'mahasiswa_id' => 'required|array',
            'status_absen' => 'required|array',
            'status_absen.*' => 'required|in:H,A,I,S',
        ]);

        foreach ($request->mahasiswa_id as $index => $mahasiswa_id) {

            $request->validate([
                'mahasiswa_id.' . $index => 'required|exists:mahasiswas,id',
            ]);

            Absensi::create([
                'mahasiswa_id' => $mahasiswa_id,
                'matakuliah_id' => $request->matakuliah_id,
                'tanggal_absensi' => $request->tanggal_absensi,
                'status_absen' => $request->status_absen[$index],
            ]);
        }

        return redirect()->route('absensi.index')
            ->with('success', 'Data absensi berhasil disimpan!');
    }
}
