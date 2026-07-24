<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ForumCategory;
use App\Models\ForumPost;

class ForumController extends Controller
{
    public function index(Request $request)
{
    $categories = ForumCategory::with('latestPost')->withCount('forumPosts')->get();

    // Get the selected category slug from the query string (if any)
    $selectedSlug = $request->query('category');
    $selectedCategory = null;

    // Fetch posts – either filtered by category or all visible posts
    $query = ForumPost::with('user', 'category')
                ->visibleTo(auth()->user())
                ->latest();

    if ($selectedSlug) {
        $selectedCategory = ForumCategory::where('slug', $selectedSlug)->first();
        if ($selectedCategory) {
            $query->where('forum_category_id', $selectedCategory->id);
        }
    }

    $posts = $query->get();

    return view('forum.index', compact('categories', 'posts', 'selectedCategory'));
}
}
