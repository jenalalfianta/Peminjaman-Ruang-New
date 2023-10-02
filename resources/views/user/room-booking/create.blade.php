<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pemesanan Ruangan</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1>Formulir Pemesanan Ruangan</h1>
        <form action="{{ route('user.booking.store') }}" method="post">
            @csrf
            <div class="mb-3">
                <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{ $userId }}">
            </div>

            <div class="mb-3">
                <label for="room_search" class="form-label">Cari Ruangan</label>
                <input type="text" class="form-control" id="room_search" placeholder="Ketik nama ruangan atau kriteria lainnya">
            </div>

            <div class="mb-3">
                <label for="room_id" class="form-label">Pilih Ruangan</label>
                <select class="form-control" id="room_id" name="room_id[]" multiple required>
                    <!-- Daftar ruangan yang sesuai dengan pencarian ditampilkan di sini -->
                </select>
                @error('room_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="start_time" class="form-label">Waktu Mulai</label>
                <input type="datetime-local" class="form-control" id="start_time" name="start_time" required>
                @error('start_time')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="end_time" class="form-label">Waktu Selesai</label>
                <input type="datetime-local" class="form-control" id="end_time" name="end_time" required>
                @error('end_time')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="izin_peminjaman_path" class="form-label">Lokasi Surat Izin Peminjaman (PDF, maksimal 1MB)</label>
                <input type="file" class="form-control" id="izin_peminjaman_path" name="izin_peminjaman_path" accept=".pdf" required>
                @error('izin_peminjaman_path')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="izin_kegiatan_path" class="form-label">Lokasi Surat Izin Kegiatan (PDF, maksimal 1MB)</label>
                <input type="file" class="form-control" id="izin_kegiatan_path" name="izin_kegiatan_path" accept=".pdf" required>
                @error('izin_kegiatan_path')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="keterangan" class="form-label">Keterangan</label>
                <textarea class="form-control" id="keterangan" name="keterangan"></textarea>
                @error('keterangan')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Ajukan Pemesanan</button>
        </form>
    </div>

    <!-- Bootstrap JS and dependencies (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Contoh data ruangan (gantilah ini dengan data yang sesuai dari server)
        var rooms = [
            { id: 1, name: "Ruangan 1" },
            { id: 2, name: "Ruangan 2" },
            { id: 3, name: "Ruangan 3" },
            // Tambahkan data ruangan lainnya sesuai kebutuhan
        ];

        // Fungsi untuk memuat ruangan berdasarkan pencarian
        function loadRoomsBySearch(searchTerm) {
            // Bersihkan opsi yang ada sebelumnya
            $('#room_id').empty();

            // Filter ruangan berdasarkan pencarian
            var filteredRooms = rooms.filter(function(room) {
                return room.name.toLowerCase().includes(searchTerm.toLowerCase());
            });

            // Tambahkan opsi ruangan ke dalam dropdown
            filteredRooms.forEach(function(room) {
                $('#room_id').append('<option value="' + room.id + '">' + room.name + '</option>');
            });
        }

        // Panggil fungsi loadRoomsBySearch setiap kali pengguna mengetikkan sesuatu
        $('#room_search').on('input', function() {
            var searchTerm = $(this).val();
            loadRoomsBySearch(searchTerm);
        });
    </script>
</body>

</html>
