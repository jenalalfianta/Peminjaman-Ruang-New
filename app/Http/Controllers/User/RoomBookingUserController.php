<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\BookingRoom;
use App\Models\RoomBooking;
use App\Models\Ruang;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class RoomBookingUserController extends Controller
{
    public function showBookingView()
    {
        // Ambil data pemesanan ruangan yang telah disetujui untuk ditampilkan di view
        $approvedBookings = RoomBooking::where('status', 'approved')
            ->orderBy('start_time', 'asc')
            ->get();

        // Kirim data pemesanan ruangan ke view dan tampilkan tampilan pemesanan
        return view('user.room-booking.index', ['bookings' => $approvedBookings]);
    }

    public function showBookingForm()
    {
        // Mengambil daftar ruangan aktif dari database
        $availableRooms = Ruang::where('aktif', true)->get();

        // Mengambil ID pengguna yang telah diautentikasi
        $userId = Auth::id();

        return view('user.room-booking.create', compact('userId','availableRooms'));
    }

    public function searchRooms(Request $request)
    {
        $query = $request->input('query');
    
        // Lakukan pencarian ruangan berdasarkan query
        $rooms = Ruang::where('nama_ruangan', 'like', "%$query%")
                    ->orWhere('lantai_ruangan', 'like', "%$query%")
                    ->orWhere('kapasitas', 'like', "%$query%")
                    ->get();
    
        // Kembalikan hasil pencarian dalam format JSON
        return response()->json(['rooms' => $rooms]);
    }

    public function storeBooking(Request $request)
    {
        // Validasi data yang diterima dari formulir
        $request->validate([
            'user_id' => 'required|integer',
            'room_id' => 'required|exists:ruang,id',
            'start_time' => 'required|date|after_or_equal:now',
            'end_time' => 'required|date|after:start_time',
            'izin_peminjaman_path' => 'required|mimes:pdf|max:1024', // Maksimum 1MB
            'izin_kegiatan_path' => 'required|mimes:pdf|max:1024', // Maksimum 1MB
            'keterangan' => 'nullable|string',
        ], [
            'start_time.after_or_equal' => 'Waktu mulai harus setidaknya sekarang atau di masa depan.',
            'end_time.after' => 'Waktu selesai harus setelah waktu mulai.'
        ]);
    
        // Pastikan pemesanan berlangsung minimal 1 jam (3600 detik)
        $startTimestamp = strtotime($request->start_time);
        $endTimestamp = strtotime($request->end_time);
        if ($endTimestamp - $startTimestamp < 3600) {
            return response()->json(['error' => 'Peminjaman harus berlangsung minimal 1 jam.']);
        }
    
        // Generate nama file unik dengan timestamp
        $izinPeminjamanFileName = 'izin_peminjaman_' . Str::random(20) . '_' . time() . '.' . $request->file('izin_peminjaman_path')->getClientOriginalExtension();
        $izinKegiatanFileName = 'izin_kegiatan_' . Str::random(20) . '_' . time() . '.' . $request->file('izin_kegiatan_path')->getClientOriginalExtension();
    
        // Simpan file dengan nama unik ke direktori yang diinginkan
        $izinPeminjamanPath = $request->file('izin_peminjaman_path')->storeAs(
            'private/letters',
            $izinPeminjamanFileName,
            'local'
        );
    
        $izinKegiatanPath = $request->file('izin_kegiatan_path')->storeAs(
            'private/letters',
            $izinKegiatanFileName,
            'local'
        );
    
        // Membuat pemesanan ruangan
        $booking = new RoomBooking();
        $booking->user_id = $request->user_id;
        $booking->start_time = $request->start_time;
        $booking->end_time = $request->end_time;
        $booking->izin_peminjaman_path = $izinPeminjamanPath;
        $booking->izin_kegiatan_path = $izinKegiatanPath;
        $booking->keterangan = $request->keterangan;
        $booking->status = 'pending';
        $booking->save();

        // Menyimpan ruangan yang dipesan
        foreach ($request->room_ids as $roomId) {
            $bookingRoom = new BookingRoom();
            $bookingRoom->booking_id = $booking->id;
            $bookingRoom->room_id = $roomId;
            $bookingRoom->save();
        }

        return response()->json(['message' => 'Booking created successfully']);
    }

    // Membuat Pemesanan Ruangan Baru
    public function createBooking(Request $request)
    {
        // Validasi data yang diterima dari formulir (termasuk validasi ruangan yang tersedia dan waktu tidak tumpang tindih)
        $request->validate([
            'user_id' => 'required|integer',
            'room_ids' => 'required|array',
            'room_ids.*' => 'exists:ruang,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'izin_peminjaman_path' => 'required|string',
            'izin_kegiatan_path' => 'required|string',
            'keterangan' => 'nullable|string',
        ]);

        // Membuat pemesanan ruangan
        $booking = new RoomBooking();
        $booking->user_id = $request->user_id;
        $booking->start_time = $request->start_time;
        $booking->end_time = $request->end_time;
        $booking->izin_peminjaman_path = $request->izin_peminjaman_path;
        $booking->izin_kegiatan_path = $request->izin_kegiatan_path;
        $booking->keterangan = $request->keterangan;
        $booking->save();

        // Menyimpan ruangan yang dipesan
        foreach ($request->room_ids as $roomId) {
            $bookingRoom = new BookingRoom();
            $bookingRoom->booking_id = $booking->id;
            $bookingRoom->room_id = $roomId;
            $bookingRoom->save();
        }

        return response()->json(['message' => 'Booking created successfully']);
    }

    // Membatalkan Pemesanan Ruangan
    public function cancelBooking(Request $request, $bookingId)
    {
        // Validasi permintaan pembatalan dan izin pengguna
        $request->validate([
            'cancellation_reason' => 'required|string',
        ]);

        // Temukan pemesanan berdasarkan ID
        $booking = RoomBooking::findOrFail($bookingId);

        // Validasi apakah pengguna memiliki izin untuk membatalkan pemesanan
        if ($booking->user_id !== auth()->user()->id) {
            return response()->json(['error' => 'Anda tidak memiliki izin untuk membatalkan pemesanan ini.']);
        }

        // Ubah status pemesanan menjadi 'canceled' dan simpan alasan pembatalan
        $booking->status = 'canceled';
        $booking->cancellation_reason = $request->cancellation_reason;
        $booking->canceled_at = Carbon::now();
        $booking->save();

        // Memberi respons sukses kepada pengguna
        return response()->json(['message' => 'Booking canceled successfully']);
    }

    // Mengambil Data Pemesanan untuk Tanggal Tertentu
    public function getBookingsForDate($date)
    {
        // Ambil data pemesanan ruangan untuk tanggal yang diberikan
        $bookings = RoomBooking::whereDate('start_time', $date)
            ->where('status', 'approved')
            ->get();

        // Format data pemesanan sesuai dengan kebutuhan FullCalendar
        $formattedBookings = [];
        foreach ($bookings as $booking) {
            $formattedBookings[] = [
                'title' => 'Booking ID: ' . $booking->id,
                'start' => $booking->start_time->toDateTimeString(),
                'end' => $booking->end_time->toDateTimeString(),
                'url' => route('booking.details', $booking->id), // Tautan ke halaman detail pemesanan
            ];
        }

        // Memberikan respons dengan data pemesanan untuk FullCalendar
        return response()->json($formattedBookings);
    }
}
