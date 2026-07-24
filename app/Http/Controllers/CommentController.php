<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    //
    public function store(Request $request, ForumPost $post)
{
    $request->validate(['body' => 'required']);
    $post->comments()->create([
        'user_id' => auth()->id(),
        'body' => $request->body,
    ]);
    return back();
}
}
