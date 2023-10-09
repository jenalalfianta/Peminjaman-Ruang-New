<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\TransactionRoom;
use Illuminate\Http\Request;


class TransactionRoomController extends Controller
{
    public function create(Request $request)
    {
        // Validasi request disini sesuai kebutuhan
        
        $bookingRoom = TransactionRoom::create([
            'booking_id' => $request->booking_id,
            'room_id' => $request->room_id,
        ]);

        return response()->json($bookingRoom, 201);
    }
}
