<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{

    public function index()
    {
        // Ambil semua transaksi pemesanan dengan ruangan yang dipilih oleh pengguna
        $transactions = Transaction::with('bookingRooms.ruang')->where('status', 'pending')->get();
        
        return view('admin.roombooking.index', compact('transactions'));
    }

    public function confirmTransaction($id)
    {
        // Temukan transaksi berdasarkan ID
        $transaction = Transaction::find($id);
        
        // Lakukan konfirmasi, misalnya, mengubah status menjadi "Dikonfirmasi"
        $transaction->status = 'Dikonfirmasi';
        $transaction->save();
        
        return redirect()->back()->with('success', 'Transaksi telah berhasil dikonfirmasi.');
    }

    public function create(Request $request)
    {
        // Validasi request disini sesuai kebutuhan
        
        $booking = Transaction::create([
            'user_id' => $request->user_id,
            'room_id' => $request->room_id,
            'title' => $request->title,
            'start' => $request->start,
            'end' => $request->end,
            'status' => $request->status,
            'izin_peminjaman_path' => $request->izin_peminjaman_path,
            'izin_kegiatan_path' => $request->izin_kegiatan_path,
            'keterangan' => $request->keterangan,
        ]);

        return response()->json($booking, 201);
    }
}
