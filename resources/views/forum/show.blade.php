@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h2>{{ $post->title }}</h2>
            <p class="text-muted">Posted by {{ $post->user->name }} • {{ $post->created_at->diffForHumans() }}</p>
            @if($post->is_private)
                <span class="badge bg-warning text-dark">Private</span>
            @endif
            <hr>
            <p>{{ $post->body }}</p>
            <div class="reactions mb-3">
                <button class="btn btn-sm btn-outline-primary react-btn" data-type="like" data- reactable-type="App\Models\ForumPost" data-id="{{ $post->id }}">👍 Like ({{ $post->reactions->where('type','like')->count() }})</button>
            </div>
            <!-- Report -->
            <form action="{{ route('reports.store') }}" method="POST" class="d-inline">
                @csrf
                <input type="hidden" name="reportable_type" value="App\Models\ForumPost">
                <input type="hidden" name="reportable_id" value="{{ $post->id }}">
                <input type="text" name="reason" placeholder="Reason" class="form-control form-control-sm d-inline w-auto" required>
                <button class="btn btn-sm btn-outline-danger">Report</button>
            </form>
        </div>
    </div>

    <h4 class="mt-4">Comments</h4>
    @foreach($post->comments as $comment)
        <div class="card mb-2">
            <div class="card-body">
                <strong>{{ $comment->user->name }}</strong>
                <p>{{ $comment->body }}</p>
                <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
            </div>
        </div>
    @endforeach

    @auth
    <form action="{{ route('comments.store', $post) }}" method="POST" class="mt-3">
        @csrf
        <textarea name="body" class="form-control" rows="2" required></textarea>
        <button class="btn btn-primary mt-2">Comment</button>
    </form>
    @endauth
</div>
@endsection