@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Our Counselors</h1>
    <div class="row">
        @foreach($counselors as $counselor)
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5>{{ $counselor->name }}</h5>
                        <p class="text-muted">{{ $counselor->email }}</p>
                        <form action="{{ route('conversations.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="counselor_id" value="{{ $counselor->id }}">
                            <button class="btn btn-sm btn-success">Start Chat</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection