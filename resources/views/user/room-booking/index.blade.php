<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Peminjaman Ruangan</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1>Daftar Peminjaman Ruangan</h1>
        <ul class="list-group mt-3">
            @forelse($bookings as $booking)
            <li class="list-group-item">
                Peminjaman ID: {{ $booking->id }}<br>
                Waktu: {{ $booking->start_time }} - {{ $booking->end_time }}
            </li>
            @empty
            <li class="list-group-item">
                Tidak ada peminjaman ruangan saat ini.
            </li>
            @endforelse
        </ul>
    </div>

    <!-- Bootstrap JS and dependencies (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>





