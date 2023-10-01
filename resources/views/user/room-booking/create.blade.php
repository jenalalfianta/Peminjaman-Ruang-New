<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Peminjaman Ruangan</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1>Formulir Peminjaman Ruangan</h1>
        <form action="{{ route('user.booking.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="rooms" class="form-label">Pilih Ruangan:</label>
                <select multiple class="form-select" id="rooms" name="rooms[]" required>
                    @foreach($rooms as $room)
                    <option value="{{ $room->id }}">{{ $room->nama_ruangan }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="start_time" class="form-label">Waktu Mulai:</label>
                <input type="datetime-local" class="form-control" id="start_time" name="start_time" required>
            </div>
            <div class="mb-3">
                <label for="end_time" class="form-label">Waktu Selesai:</label>
                <input type="datetime-local" class="form-control" id="end_time" name="end_time" required>
            </div>
            <div class="mb-3">
                <label for="izin_peminjaman" class="form-label">Surat Izin Peminjaman (PDF):</label>
                <input type="file" class="form-control" id="izin_peminjaman" name="izin_peminjaman" accept=".pdf" required>
            </div>
            <div class="mb-3">
                <label for="izin_kegiatan" class="form-label">Surat Izin Kegiatan (PDF):</label>
                <input type="file" class="form-control" id="izin_kegiatan" name="izin_kegiatan" accept=".pdf" required>
            </div>
            <div class="mb-3">
                <label for="keterangan" class="form-label">Keterangan:</label>
                <textarea class="form-control" id="keterangan" name="keterangan"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Ajukan Peminjaman</button>
        </form>
    </div>

    <!-- Bootstrap JS and dependencies (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
