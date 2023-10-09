<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\TransactionCancellation;
use Illuminate\Http\Request;

class TransactionCancellationController extends Controller
{
    public function create(Request $request)
    {
        // Validasi request disini sesuai kebutuhan
        
        $cancellation = TransactionCancellation::create([
            'booking_id' => $request->booking_id,
            'user_id' => $request->user_id,
            'reason' => $request->reason,
        ]);

        return response()->json($cancellation, 201);
    }
}
