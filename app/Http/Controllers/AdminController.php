<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slot;
use App\Models\Story;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalStudents = User::count();
        $totalCounselors = User::role('counselor')->count();
        $totalStories = Story::count();
        $pendingStories = Story::where('moderation_status', 'pending')->count();
        $totalBookings = Slot::where('status', 'booked')->count();

        return view('admin.dashboard', compact(
            'totalStudents',
            'totalCounselors',
            'totalStories',
            'pendingStories',
            'totalBookings'
        ));
    }

    public function updateSlots(Request $request, $userId)
    {
        $validated = $request->validate([
            'slot_times' => 'required|array',
        ]);

        $user = User::findOrFail($userId);

        $user->slots()->delete();

        foreach ($validated['slot_times'] as $time) {
            Slot::create([
                'counselor_id' => $userId,
                'start_time' => $time['start'],
                'end_time' => $time['end'],
                'status' => 'available',
            ]);
        }

        return redirect()->back()->with('success', 'Counselor slots have been updated successfully.');
    }
}