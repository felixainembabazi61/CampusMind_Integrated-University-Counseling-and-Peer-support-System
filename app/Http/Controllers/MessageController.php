<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conversation;

class MessageController extends Controller
{
    //
    public function store(Request $request, Conversation $conversation)
    {
        $request->validate(['body' => 'required']);
         $conversation->messages()->create([
            'user_id' => auth()->id(),
            'body' => $request->body,
         ]);
        return back();
    }
}
