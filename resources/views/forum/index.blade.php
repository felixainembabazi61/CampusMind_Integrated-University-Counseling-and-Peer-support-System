@extends('layouts.app')
@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Forum</h1>
        <a href="{{ route('posts.create') }}" class="btn btn-primary">Share Your Story</a>
    </div>
    @foreach($categories as $category)
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">{{ $category->name }}</div>
            <div class="card-body">
                @forelse($category->forumPosts as $post)
                    <div class="border-bottom py-2 d-flex justify-content-between">
                        <div>
                            <a href="{{ route('forum.show', $post) }}">{{ $post->title }}</a>
                            <small class="text-muted">by {{ $post->user->name }}</small>
                            @if($post->is_private)
                                <span class="badge bg-warning text-dark">Private</span>
                            @endif
                        </div>
                        <small>{{ $post->created_at->diffForHumans() }}</small>
                    </div>
                @empty
                    <p class="text-muted">No posts in this category yet.</p>
                @endforelse
            </div>
        </div>
    @endforeach
</div>
@endsection