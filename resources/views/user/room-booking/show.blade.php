<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rincian Peminjaman Ruangan</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1>Rincian Peminjaman Ruangan</h1>
        <div class="card mt-3">
            <div class="card-body">
                <h5 class="card-title">Peminjaman ID: {{ $booking->id }}</h5>
                <p class="card-text">Waktu: {{ $booking->start_time }} - {{ $booking->end_time }}</p>
                <p class="card-text">Keterangan: {{ $booking->keterangan }}</p>
                <!-- Tambahkan elemen lain sesuai kebutuhan -->
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
