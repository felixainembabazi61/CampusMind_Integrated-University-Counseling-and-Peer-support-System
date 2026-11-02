<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CampusMind - Story Sharing Hub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-md navbar-dark bg-primary mb-4">
        <div class="container">
            <a class="navbar-brand" href="#">CampusMind</a>
            <a class="navbar-text" href="{{ route('forum.index') }}">Forum</a>
        </div>
    </nav>
    <div class="container py-5">
        <h2>Community Story & Resource Sharing</h2>
        <p class="lead">Browse anonymous stories from students who have overcome similar challenges. All content is moderated before publication.</p>
        
        <hr>
        
        <h5>Share Your Story</h5>
        <p>Help others by sharing your journey. Your story will be reviewed by moderators before going live.</p>
        <form method="POST" action="{{ route('stories.store') }}" class="mb-4">
            @csrf
            <div class="row mb-3">
                <div class="col-md-6">
                    <label>Title (required)</label>
                    <input type="text" name="title" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label>Category</label>
                    <select name="category" class="form-select">
                        <option value="exam_anxiety">Exam Anxiety</option>
                        <option value="grief">Grief</option>
                        <option value="financial_stress">Financial Stress</option>
                        <option value="career_uncertainty">Career Uncertainty</option>
                        <option value="other">Other</option>
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label>Your Story (required)</label>
                <textarea name="content" class="form-control" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit Story</button>
        </form>
        
        <h5>Featured Stories</h5>
        @if($stories->isEmpty())
            <p>No stories available yet. Be the first to share your experience!</p>
        @else
            <div class="row">
                @foreach($stories as $story)
                    <div class="col-md-4 mb-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title">{{ $story->title }}</h5>
                                <p class="card-text">{{ substr($story->content, 0, 100) }}...</p>
                                <small class="text-muted">Category: {{ ucfirst($story->category) }}</small>
                            </div>
                            <div class="card-footer small">
                                <span>Submitted: {{ \Carbon\Carbon::parse($story->created_at)->format('M d, Y') }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
    <footer class="footer mt-auto py-3 bg-white">
        <div class="container">
            <span class="text-center small">CampusMind - Moderated peer support community</span>
        </div>
    </footer>
</body>
</html>