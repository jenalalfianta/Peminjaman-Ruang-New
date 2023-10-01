<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Pengguna Baru</title>
    <!-- Bootstrap CSS via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        Buat Pengguna Baru
                    </div>
                    <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                        <form method="POST" action="{{ route('users.store') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama:</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password:</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="mb-3">
                                <label for="role" class="form-label">Role:</label>
                                <select class="form-select" id="role" name="role" required>
                                    <option value="admin">Admin</option>
                                    <option value="user" selected>User</option>
                                </select>
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" value="1" id="is_active" name="is_active" checked>
                                <label class="form-check-label" for="is_active">
                                    Aktif
                                </label>
                            </div>
                            <div class="mb-3">
                                <label for="photo" class="form-label">Foto Profil:</label>
                                <input type="file" class="form-control" id="photo" name="photo">
                            </div>
                            <div class="mb-3">
                                <label for="phone_number" class="form-label">Nomor Telepon:</label>
                                <input type="text" class="form-control" id="phone_number" name="phone_number">
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Alamat:</label>
                                <textarea class="form-control" id="address" name="address"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="organization" class="form-label">Unit/Organisasi:</label>
                                <input type="text" class="form-control" id="organization" name="organization">
                            </div>
                            <div class="mb-3">
                                <label for="job_title" class="form-label">Jabatan:</label>
                                <input type="text" class="form-control" id="job_title" name="job_title">
                            </div>

                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS via CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
