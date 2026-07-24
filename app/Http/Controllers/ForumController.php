<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ForumCategory;
use App\Models\ForumPost;

class ForumController extends Controller
{
    public function index()
    {
        $categories = ForumCategory::with(['forumPosts' => function ($q) {
            $q->visibleTo(auth()->user())->latest();
        }])->get();

        return view('forum.index', compact('categories'));
    }

    public function show(ForumPost $post)
    {
        // Authorization: if private, only author/counselor/admin can view
        if ($post->is_private) {
            abort_if(!auth()->user() || 
                (auth()->id() != $post->user_id && 
                !auth()->user()->hasAnyRole(['counselor','admin'])), 403);
        }

        $post->load('comments.user', 'reactions');
        return view('forum.show', compact('post'));
    }
}
