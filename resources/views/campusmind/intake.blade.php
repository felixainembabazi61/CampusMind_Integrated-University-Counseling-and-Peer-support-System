<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CampusMind - Confidential Intake Form</title>
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
        <h2>Confidential Intake Questionnaire</h2>
        <p class="lead">Please complete this confidential intake so we can categorize your support request by urgency.</p>
        <hr>
        <form method="POST" action="{{ route('intake.store') }}">
            @csrf
            <div class="row mb-3">
                <label class="col-form-label col-sm-3">Urgency Level:</label>
                <div class="col-sm-8">
                    <select name="urgency_category" class="form-select">
                        <option value="general">General academic stress</option>
                        <option value="high">High - significant distress</option>
                        <option value="crisis">Crisis - immediate support needed</option>
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label>Describe your situation (required):</label>
                <textarea name="responses" class="form-control" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit Intake</button>
            <a class="btn btn-link" href="{{ route('forum.index') }}">Cancel</a>
        </form>
    </div>
    <footer class="footer mt-auto py-3 bg-white">
        <div class="container">
            <span class="text-center small">CampusMind - All information is confidential</span>
        </div>
    </footer>
</body>
</html>