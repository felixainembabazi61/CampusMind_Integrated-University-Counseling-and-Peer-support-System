@extends('layouts.app')
@section('content')
<div class="container">
    <h1>New Story</h1>
    <form action="{{ route('posts.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Category</label>
            <select name="forum_category_id" class="form-select" required>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Your Story</label>
            <textarea name="body" rows="6" class="form-control" required></textarea>
        </div>
        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="is_private" value="1" id="privateCheck">
            <label class="form-check-label" for="privateCheck">Make this private (only visible to you and counselors)</label>
        </div>
        <button type="submit" class="btn btn-success">Publish</button>
    </form>
</div>
@endsection