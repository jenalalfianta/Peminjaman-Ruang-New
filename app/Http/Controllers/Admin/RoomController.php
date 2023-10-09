<?php

namespace App\Http\Controllers\Admin;

use App\Models\Room;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoomController extends Controller
{
    public function index()
    {
        $ruang = Room::all();
        return view('admin.ruang.index', compact('ruang'));
    }

    public function create()
    {
        return view('admin.ruang.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|unique:rooms',
            'roomName' => 'required',
            'floor' => 'required',
            'capacity' => 'required|integer',
            'description' => 'nullable',
            'isActive' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Room::create($request->all());

        return redirect()->route('room.index')->with('success', 'Ruang berhasil ditambahkan.');
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $ruang = Room::where('code', 'like', "%$keyword%")
                     ->orWhere('roomName', 'like', "%$keyword%")
                     ->get();
        
        return view('admin.ruang.index', compact('ruang', 'keyword'));
    }

    public function edit($id)
    {
        $ruang = Room::findOrFail($id);
        return view('admin.ruang.edit', compact('ruang'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'roomName' => 'required',
            'floor' => 'required',
            'capacity' => 'required|integer',
            'description' => 'nullable',
            'isActive' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $ruang = Room::findOrFail($id);

        $ruang->update([
            'roomName' => $request->input('roomName'),
            'floor' => $request->input('floor'),
            'capacity' => $request->input('capacity'),
            'description' => $request->input('description'),
            'isActive' => $request->has('isActive'), // Menggunakan has() untuk mendeteksi apakah checkbox isActive dicentang atau tidak
        ]);

        return redirect()->route('room.index')->with('success', 'Ruang berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $ruang = Room::findOrFail($id);
        $ruang->delete();

        return redirect()->route('room.index')->with('success', 'Ruang berhasil dihapus.');
    }

}
