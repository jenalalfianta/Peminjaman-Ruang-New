<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Ruang Baru</title>
    <!-- Bootstrap CSS via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        Buat Ruang Baru
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
                        <form method="POST" action="{{ route('ruang.store') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="kode_ruangan" class="form-label">Kode Ruangan:</label>
                                <input type="text" class="form-control" id="kode_ruangan" name="kode_ruangan" required>
                            </div>
                            <div class="mb-3">
                                <label for="nama_ruangan" class="form-label">Nama Ruangan:</label>
                                <input type="text" class="form-control" id="nama_ruangan" name="nama_ruangan" required>
                            </div>
                            <div class="mb-3">
                                <label for="lantai_ruangan" class="form-label">Lantai Ruangan:</label>
                                <input type="text" class="form-control" id="lantai_ruangan" name="lantai_ruangan"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="kapasitas" class="form-label">Kapasitas Ruangan:</label>
                                <input type="number" class="form-control" id="kapasitas" name="kapasitas" required>
                            </div>
                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi Ruangan:</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi"></textarea>
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" value="1" id="aktif" name="aktif" checked>
                                <label class="form-check-label" for="aktif">
                                    Aktif
                                </label>
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
