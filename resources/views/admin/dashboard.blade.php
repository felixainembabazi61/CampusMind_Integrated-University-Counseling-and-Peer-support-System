<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CampusMind - Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-md navbar-dark bg-primary mb-4">
        <div class="container">
            <a class="navbar-brand" href="#">CampusMind Admin</a>
            <a class="navbar-text" href="{{ route('forum.index') }}">Forum</a>
            <a class="navbar-text" href="{{ route('auth.logout') }}">Logout</a>
        </div>
    </nav>
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h5 class="card-title">Total Students</h5>
                        <h2>{{ $totalStudents }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h5 class="card-title">Counselors</h5>
                        <h2>{{ $totalCounselors }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <h5 class="card-title">Total Stories</h5>
                        <h2>{{ $totalStories }}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <h5 class="card-title">Pending Moderation</h5>
                        <h2>{{ $pendingStories }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-secondary text-white">
                    <div class="card-body">
                        <h5 class="card-title">Booked Sessions</h5>
                        <h2>{{ $totalBookings }}</h2>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h4>Recent Stories Pending Moderation</h4>
            </div>
            <div class="card-body">
                @if($pendingStories > 0)
                    <p>There are {{ $pendingStories }} stories awaiting moderation.</p>
                    <ul class="list-group">
                        @foreach(Story::where('moderation_status', 'pending')->latest()->take(5) as $story)
                            <li class="list-group-item">
                                <strong>{{ $story->title }}</strong> - {{ ucfirst($story->category) }}
                                <br>
                                <small>Submitted by user {{ $story->user->name }}</small>
                                <a href="#" class="btn btn-sm btn-outline-primary float-right">Review</a>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p>No pending stories.</p>
                @endif
            </div>
        </div>
    </div>
    <footer class="footer mt-auto py-3 bg-white">
        <div class="container">
            <span class="text-center small">CampusMind - Admin Panel</span>
        </div>
    </footer>
</body>
</html>