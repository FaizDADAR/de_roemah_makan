<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function create()
    {
        return view('pages.booking');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'people' => 'required|integer|min:1|max:20',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required|string',
            'note' => 'nullable|string|max:500',
        ]);

        $booking = Booking::create($validated);

        return redirect()->route('booking.create')
            ->with('success', 'Booking berhasil! Kami akan segera mengkonfirmasi.')
            ->with('booking', $booking);
    }
}
