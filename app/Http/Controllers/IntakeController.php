<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Intake;
use App\Models\User;

class IntakeController extends Controller
{
    public function create()
    {
        return view('campusmind.intake');
    }

    public function store(Request $request)
    {
        $request->validate([
            'urgency_category' => 'required|in:general,high,crisis',
            'responses' => 'required|json',
        ]);

        $intake = Intake::create([
            'user_id' => auth()->id(),
            'urgency_category' => $request->urgency_category,
            'responses' => $request->responses,
        ]);

        return back()->with('success', 'Your intake form has been submitted successfully. A counselor will triage your request based on the urgency category.');
    }
}
