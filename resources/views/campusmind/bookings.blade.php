<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CampusMind - Book Counseling Sessions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #eef7ff 0%, #fdf2f8 50%, #f5f3ff 100%);
            min-height: 100vh;
            color: #1f2937;
        }
        .campus-card {
            border: 0;
            border-radius: 1.25rem;
            box-shadow: 0 16px 40px rgba(31, 41, 55, 0.08);
            overflow: hidden;
        }
        .campus-header {
            background: linear-gradient(135deg, #2563eb, #7c3aed);
            color: white;
            padding: 1.25rem 1.5rem;
            border-radius: 1.2rem 1.2rem 0 0;
        }
        .session-item {
            border-radius: 1rem;
            border: 1px solid rgba(99, 102, 241, 0.12);
            background: rgba(255,255,255,0.7);
            margin-bottom: 1rem;
            padding: 1rem 1.25rem;
        }
        .book-btn {
            background: linear-gradient(120deg, #2563eb, #8b5cf6);
            border: none;
            border-radius: 0.8rem;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark mb-4" style="background: linear-gradient(135deg, #1d4ed8, #7c3aed);">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('home') }}">CampusMind</a>
            <div class="d-flex gap-3 align-items-center">
                <a class="nav-link text-white" href="{{ route('forum.index') }}">Forum</a>
                <a class="nav-link text-white" href="{{ route('intake.create') }}">Intake</a>
                <a class="nav-link text-white" href="{{ route('stories.index') }}">Stories</a>
            </div>
        </div>
    </nav>

    <div class="container py-4">
        <div class="campus-card mb-4">
            <div class="campus-header">
                <h2 class="mb-1">Book a counseling session</h2>
                <p class="mb-0 text-white-50">Choose a time slot that works for you.</p>
            </div>
            <div class="card-body p-4">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                @if($slots->isEmpty())
                    <div class="alert alert-light border">No available slots at the moment. Please check back later.</div>
                @else
                    @foreach($slots as $slot)
                        <div class="session-item">
                            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                                <div>
                                    <div class="fw-bold text-primary">{{ $slot->counselor ? $slot->counselor->name : 'Unassigned counselor' }}</div>
                                    <div class="small text-muted mb-2">{{ $slot->counselor ? 'Counselor' : 'Session time' }}</div>
                                    <div class="text-dark">
                                        <strong>Time:</strong> {{ \Carbon\Carbon::parse($slot->start_time)->format('M d, Y h:i A') }} - {{ \Carbon\Carbon::parse($slot->end_time)->format('h:i A') }}
                                    </div>
                                </div>
                                <form method="POST" action="{{ route('bookings.store') }}">
                                    @csrf
                                    <input type="hidden" name="slot_id" value="{{ $slot->id }}">
                                    <button type="submit" class="btn book-btn text-white px-4">Book now</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    <footer class="footer mt-auto py-3">
        <div class="container text-center small text-secondary">CampusMind - Integrated University Counseling & Peer Support Platform</div>
    </footer>
</body>
</html>