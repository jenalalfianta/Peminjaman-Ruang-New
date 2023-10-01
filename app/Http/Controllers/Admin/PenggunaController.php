<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PenggunaController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => ['required', Rule::in(['admin', 'user'])],
            'is_active' => 'nullable|boolean',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'phone_number' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'organization' => 'nullable|string|max:255',
            'job_title' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Ubah email menjadi lowercase
        $email = Str::lower($request->input('email'));

        // Ubah nama menjadi Title Case
        $name = Str::title($request->input('name'));

        // Simpan data ke dalam database
        User::create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($request->input('password')),
            'role' => $request->input('role'),
            'is_active' => $request->has('is_active'),
            'phone_number' => $request->input('phone_number'),
            'address' => $request->input('address'),
            'organization' => $request->input('organization'),
            'job_title' => $request->input('job_title'),
        ]);

        return redirect()->route('users.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $users = User::where('name', 'like', "%$keyword%")
                     ->orWhere('email', 'like', "%$keyword%")
                     ->get();

        return view('admin.users.index', compact('users'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:8',
            'role' => ['required', Rule::in(['admin', 'user'])],
            'is_active' => 'nullable|boolean',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'phone_number' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'organization' => 'nullable|string|max:255',
            'job_title' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Ubah email menjadi lowercase
        $email = Str::lower($request->input('email'));

        // Ubah nama menjadi Title Case
        $name = Str::title($request->input('name'));

        $user = User::findOrFail($id);

        $user->update([
            'name' => $name,
            'password' => bcrypt($request->input('password')),
            'role' => $request->input('role'),
            'is_active' => $request->has('is_active'),
            'phone_number' => $request->input('phone_number'),
            'address' => $request->input('address'),
            'organization' => $request->input('organization'),
            'job_title' => $request->input('job_title'),
        ]);

        return redirect()->route('users.index')->with('success', 'Pengguna berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Pengguna berhasil dihapus.');
    }
}
