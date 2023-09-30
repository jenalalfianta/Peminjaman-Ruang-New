<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 50px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="mb-4">Selamat datang, Admin</h1>
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Dashboard Admin</h2>
                <p class="card-text">Anda sudah login sebagai admin.</p>
                <!-- Tambahkan konten dashboard admin di sini -->

                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger">Logout</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>