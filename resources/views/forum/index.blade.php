@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row" style="min-height: 80vh;">
        <!-- Left Sidebar: Categories -->
        <div class="col-md-3 col-lg-2 bg-light border-end p-3">
            <h5 class="mb-3">Categories</h5>
            <div class="list-group">
                <!-- "All" link to reset filter -->
                <a href="{{ route('forum.index') }}" 
                   class="list-group-item list-group-item-action {{ !$selectedCategory ? 'active' : '' }}">
                    All Categories
                </a>
                @foreach($categories as $category)
                    <a href="{{ route('forum.index', ['category' => $category->slug]) }}" 
                       class="list-group-item list-group-item-action d-flex justify-content-between align-items-center 
                              {{ $selectedCategory && $selectedCategory->id === $category->id ? 'active' : '' }}">
                        {{ $category->name }}
                        <span class="badge bg-secondary rounded-pill">{{ $category->forum_posts_count }}</span>
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Right Main Content: Posts -->
        <div class="col-md-9 col-lg-10 p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1>
                    @if($selectedCategory)
                        {{ $selectedCategory->name }}
                    @else
                        All Stories
                    @endif
                </h1>
                <a href="{{ route('posts.create') }}" class="btn btn-primary">Share Your Story</a>
            </div>

            @forelse($posts as $post)
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h5 class="card-title mb-1">
                                    <a href="{{ route('forum.show', $post) }}" class="text-decoration-none text-dark">
                                        {{ $post->title }}
                                    </a>
                                </h5>
                                <p class="text-muted small mb-0">
                                    Posted by {{ $post->user->name }} • {{ $post->created_at->diffForHumans() }}
                                    @if($post->is_private)
                                        <span class="badge bg-warning text-dark">Private</span>
                                    @endif
                                </p>
                            </div>
                            <small class="text-muted">{{ $post->created_at->format('M d') }}</small>
                        </div>
                        <p class="card-text mt-2">{{ Str::limit($post->body, 100) }}</p>
                    </div>
                </div>
            @empty
                <div class="text-center text-muted mt-5">
                    <p>No stories yet in this category.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection