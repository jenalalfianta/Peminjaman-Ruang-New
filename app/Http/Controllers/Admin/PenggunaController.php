<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rule;



class PenggunaController extends Controller
{
    // Menampilkan semua pengguna
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    // Menampilkan form tambah pengguna
    public function create()
    {
        return view('users.create');
    }

    // Menyimpan pengguna baru ke database
    public function store(Request $request)
    {
        // Validasi request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => ['required', Rule::in(['admin', 'user'])],
            'is_active' => 'required|boolean',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'phone_number' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'organization' => 'nullable|string|max:255',
            'job_title' => 'nullable|string|max:255',
        ]);

        // Simpan pengguna baru ke database
        User::create($request->all());

        return redirect()->route('users.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }


    // Menampilkan detail pengguna
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    // Menampilkan form edit pengguna
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        // Validasi request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'password' => 'nullable|string|min:8',
            'role' => ['required', Rule::in(['admin', 'user'])],
            'is_active' => 'required|boolean',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'phone_number' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'organization' => 'nullable|string|max:255',
            'job_title' => 'nullable|string|max:255',
        ]);

        // Perbarui pengguna ke database
        $user->update($request->all());

        return redirect()->route('users.index')->with('success', 'Pengguna berhasil diperbarui.');
    }

    // Menghapus pengguna dari database
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Pengguna berhasil dihapus.');
    }
}
