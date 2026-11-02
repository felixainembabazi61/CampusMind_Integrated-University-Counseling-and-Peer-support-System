<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Story;
use App\Models\User;

class StoryController extends Controller
{
    public function index()
    {
        $stories = Story::where('moderation_status', 'approved')
            ->latest()
            ->get();
        return view('campusmind.stories', compact('stories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|in:exam_anxiety,grief,financial_stress,career_uncertainty,other',
        ]);

        $story = Story::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'content' => $request->content,
            'category' => $request->category,
            'moderation_status' => 'pending',
        ]);

        return back()->with('success', 'Your story has been submitted for moderation and will be published once reviewed.');
    }
}
