<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
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
            'isActive' => 'nullable|boolean',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'phoneNumber' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'organization' => 'nullable|string|max:255',
            'jobTitle' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = [
            'name' => Str::title($request->input('name')),
            'email' => Str::lower($request->input('email')),
            'password' => bcrypt($request->input('password')),
            'role' => $request->input('role'),
            'isActive' => $request->has('isActive'),
            'phoneNumber' => $request->input('phoneNumber'),
            'address' => $request->input('address'),
            'organization' => $request->input('organization'),
            'jobTitle' => $request->input('jobTitle'),
            'email_verified_at' => now()
        ];

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            if ($file->getSize() > 2048 * 1024) {
                return redirect()->back()->withErrors(['photo' => 'Ukuran file harus kurang dari 2MB.'])->withInput();
            }

            $randomName = Str::random(20);
            $ext = $file->getClientOriginalExtension();
            $uniqueFileName = $randomName . '.' . $ext;

            $file->storeAs('private/photos', $uniqueFileName);
            $data['photo'] = $uniqueFileName;
        }

        User::create($data);

        return redirect()->route('users.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $users = User::where('name', 'like', "%$keyword%")
                     ->orWhere('email', 'like', "%$keyword%")
                     ->get();

        return view('admin.users.index', compact('users', 'keyword'));
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
            'password' => 'nullable|string|min:8',
            'role' => ['required', Rule::in(['admin', 'user'])],
            'isActive' => 'nullable|boolean',
            'photo' => 'nullable|mimes:jpeg,png,jpg,gif|max:2048',
            'phoneNumber' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'organization' => 'nullable|string|max:255',
            'jobTitle' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Mengambil file foto jika ada
        if ($request->hasFile('photo')) {
            // Memeriksa ukuran file
            $file = $request->file('photo');
            if ($file->getSize() > 2048 * 1024) {
                return redirect()->back()->withErrors(['photo' => 'Ukuran file harus kurang dari 2MB.'])->withInput();
            }

            // Membuat nama unik dengan karakter acak
            $randomName = Str::random(20); // 20 karakter acak
            $ext = $file->getClientOriginalExtension();
            $uniqueFileName = $randomName . '.' . $ext;

            // Menyimpan file dengan nama unik di direktori privat
            $file->storeAs('private/photos', $uniqueFileName);

            // Update nama file foto di database
            $user = User::findOrFail($id);
            $user->photo = $uniqueFileName;
            $user->save();
        }

        // Ubah nama menjadi Title Case
        $name = Str::title($request->input('name'));

        $user = User::findOrFail($id);

        // Periksa apakah kolom password diisi atau tidak
        if ($request->filled('password')) {
            // Jika password baru disediakan dalam formulir, update password
            $password = bcrypt($request->input('password'));
        } else {
            // Jika password tidak disediakan, gunakan password yang sudah ada
            $password = $user->password;
        }

        $isActive = $request->has('isActive') ? true : false;

        // Update hanya data yang diubah dalam formulir
        $user->update([
            'name' => $name,
            'password' => $password,
            'role' => $request->input('role'),
            'isActive' => $isActive,
            'phoneNumber' => $request->input('phoneNumber'),
            'address' => $request->input('address'),
            'organization' => $request->input('organization'),
            'jobTitle' => $request->input('jobTitle'),
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
