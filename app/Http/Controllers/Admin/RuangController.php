<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ruang;
use Illuminate\Support\Facades\Validator;

class RuangController extends Controller
{
    public function index()
    {
        $ruang = Ruang::all();
        return view('admin.ruang.index', compact('ruang'));
    }

    public function create()
    {
        return view('admin.ruang.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_ruangan' => 'required|unique:ruang',
            'nama_ruangan' => 'required',
            'lantai_ruangan' => 'required',
            'kapasitas' => 'required|integer',
            'deskripsi' => 'nullable',
            'aktif' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Ruang::create($request->all());

        return redirect()->route('ruang.index')->with('success', 'Ruang berhasil ditambahkan.');
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $ruang = Ruang::where('kode_ruangan', 'like', "%$keyword%")
                        ->orWhere('nama_ruangan', 'like', "%$keyword%")
                        ->get();

        return view('admin.ruang.index', compact('ruang'));
    }

    public function edit($id)
    {
        $ruang = Ruang::findOrFail($id);
        return view('admin.ruang.edit', compact('ruang'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'kode_ruangan' => 'required|unique:ruang,kode_ruangan,'.$id,
            'nama_ruangan' => 'required',
            'lantai_ruangan' => 'required',
            'kapasitas' => 'required|integer',
            'deskripsi' => 'nullable',
            'aktif' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $ruang = Ruang::findOrFail($id);
        
        $ruang->update([
            'kode_ruangan' => $request->input('kode_ruangan'),
            'nama_ruangan' => $request->input('nama_ruangan'),
            'lantai_ruangan' => $request->input('lantai_ruangan'),
            'kapasitas' => $request->input('kapasitas'),
            'deskripsi' => $request->input('deskripsi'),
            'aktif' => $request->has('aktif'), // Menggunakan has() untuk mendeteksi apakah checkbox aktif dicentang atau tidak
        ]);

        return redirect()->route('ruang.index')->with('success', 'Ruang berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $ruang = Ruang::findOrFail($id);
        $ruang->delete();

        return redirect()->route('ruang.index')->with('success', 'Ruang berhasil dihapus.');
    }

}
