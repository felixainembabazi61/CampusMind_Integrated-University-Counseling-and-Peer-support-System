@extends('layouts.app')
@section('content')
<div class="container">
    <h1>My Conversations</h1>
    @foreach($conversations as $conv)
        <a href="{{ route('conversations.show', $conv) }}" class="list-group-item">
            Chat with {{ auth()->id() == $conv->user_id ? $conv->counselor->name : $conv->user->name }}
            <span class="badge bg-info">{{ $conv->messages->count() }} msgs</span>
        </a>
    @endforeach
</div>
@endsection