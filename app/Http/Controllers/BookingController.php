<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Slot;

class BookingController extends Controller
{
    public function index()
    {
        $slots = Slot::with('counselor')->where('status', 'available')->latest()->get();

        return view('campusmind.bookings', compact('slots'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'slot_id' => 'required|exists:slots,id',
        ]);

        $slot = Slot::findOrFail($validated['slot_id']);

        if ($slot->status === 'booked') {
            return redirect()->route('campusmind.index')->with('error', 'This slot is already booked. Please choose another.');
        }

        $booking = Booking::create([
            'user_id' => auth()->id(),
            'slot_id' => $slot->id,
            'status' => 'confirmed',
            'notes' => 'Booked via CampusMind session portal.',
        ]);

        $slot->update(['status' => 'booked']);

        return redirect()->route('campusmind.index')->with('success', 'Your counseling session has been booked successfully! Booking ID: #' . $booking->id);
    }
}
