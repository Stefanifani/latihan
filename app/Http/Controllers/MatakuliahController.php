<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matakuliah;

class MatakuliahController extends Controller
{
    // Menampilkan semua data mata kuliah
    public function index()
    {
        $matakuliah = Matakuliah::all();

        return view('matakuliah.index', compact('matakuliah'));
    }

    // Menampilkan form tambah
    public function create()
    {
        return view('matakuliah.create');
    }

    // Menyimpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|unique:matakuliah,kode',
            'nama_matakuliah' => 'required'
        ]);

        Matakuliah::create($request->all());

        return redirect()->route('matakuliah.index')
                         ->with('success', 'Data berhasil ditambahkan!');
    }

    // Menampilkan form edit
    public function edit($id)
    {
        $matakuliah = Matakuliah::findOrFail($id);

        return view('matakuliah.edit', compact('matakuliah'));
    }

    // Memperbarui data
    public function update(Request $request, $id)
    {
        $matakuliah = Matakuliah::findOrFail($id);

        $request->validate([
            'kode' => 'required|unique:matakuliah,kode,' . $id,
            'nama_matakuliah' => 'required'
        ]);

        $matakuliah->update($request->all());

        return redirect()->route('matakuliah.index')
                         ->with('success', 'Data berhasil diperbarui!');
    }

    // Menghapus data
    public function destroy($id)
    {
        $matakuliah = Matakuliah::findOrFail($id);

        $matakuliah->delete();

        return redirect()->route('matakuliah.index')
                         ->with('success', 'Data berhasil dihapus!');
    }
}
