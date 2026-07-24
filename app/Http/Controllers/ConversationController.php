<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conversation;
use App\Models\User;

class ConversationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
         $conversations = Conversation::where('user_id', auth()->id())
        ->orWhere('counselor_id', auth()->id())
        ->with('user', 'counselor', 'messages')
        ->get();
    return view('conversations.index', compact('conversations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // start a chat with a counselor
    $request->validate(['counselor_id' => 'required|exists:users,id']);
    $counselor = User::role('counselor')->findOrFail($request->counselor_id);

    $conversation = Conversation::firstOrCreate([
        'user_id'      => auth()->id(),
        'counselor_id' => $counselor->id,
    ]);

    return redirect()->route('conversations.show', $conversation);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $conversation = Conversation::findOrFail($id);
        // ensure participant
    abort_if($conversation->user_id != auth()->id() && $conversation->counselor_id != auth()->id(), 403);
    $messages = $conversation->messages()->with('sender')->latest()->get();
    return view('conversations.show', compact('conversation', 'messages'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
