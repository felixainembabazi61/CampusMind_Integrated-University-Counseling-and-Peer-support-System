@extends('layouts.app')
@section('content')
<div class="container">
    <h3>Chat</h3>
    <div class="card mb-3" style="height: 400px; overflow-y: scroll;" id="chat-box">
        @foreach($messages as $msg)
            <div class="p-2 mb-1 {{ $msg->sender_id == auth()->id() ? 'text-end' : '' }}">
                <strong>{{ $msg->sender->name }}:</strong> {{ $msg->body }}
                <br><small class="text-muted">{{ $msg->created_at->diffForHumans() }}</small>
            </div>
        @endforeach
    </div>
    <form action="{{ route('messages.store', $conversation) }}" method="POST">
        @csrf
        <div class="input-group">
            <input type="text" name="body" class="form-control" required>
            <button class="btn btn-primary">Send</button>
        </div>
    </form>
</div>
@endsection