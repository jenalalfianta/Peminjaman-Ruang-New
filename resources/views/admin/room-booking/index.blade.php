<!-- resources/views/admin/room-bookings/index.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Peminjaman Menunggu Persetujuan</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Daftar Peminjaman Menunggu Persetujuan</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Nama Pengguna</th>
                    <th>Ruangan</th>
                    <th>Waktu Peminjaman</th>
                    <th>Lampiran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <!-- Loop through your room bookings data and populate the table rows -->
                <!-- Example row -->
                <tr>
                    <td>User 1</td>
                    <td>Ruangan A</td>
                    <td>2023-12-01 10:00 AM - 2023-12-01 01:00 PM</td>
                    <td><a href="#">Surat Izin</a></td>
                    <td>
                        <button class="btn btn-success">Setujui</button>
                        <button class="btn btn-danger">Tolak</button>
                    </td>
                </tr>
                <!-- End of example row -->
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
