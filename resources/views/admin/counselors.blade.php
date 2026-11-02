<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CampusMind - Manage Counselors</title>
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
    <div class="container py-5">
        <h2>Manage Counselors</h2>
        <a href="#" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addCounselorModal">
            Add Counselor
        </a>
        
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Assigned Slots</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($counselors as $counselor)
                <tr>
                    <td>{{ $counselor->name }}</td>
                    <td>{{ $counselor->email }}</td>
                    <td>
                        @if($counselor->slots->isNotEmpty())
                            <ul class="list-group">
                                @foreach($counselor->slots as $slot)
                                    <li class="list-group-item">
                                        {{ \Carbon\Carbon::parse($slot->start_time)->format('M d H:i') }} - {{ \Carbon\Carbon::parse($slot->end_time)->format('H:i') }}
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <span class="text-muted">No slots assigned</span>
                        @endif
                    </td>
                    <td>
                        <form method="POST" action="{{ route('admin.counselors.slots.update', $counselor->id) }}" style="display:inline">
                            @method('PUT')
                            @csrf
                            <button class="btn btn-sm btn-outline-primary" title="Update Slots">
                                <i class="fas fa-edit"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Model for adding counselor -->
    <div class="modal fade" id="addCounselorModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('admin.counselors.slots.update', 0) }}" style="display:none">
                    @csrf @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title">Assign Slots to Counselor</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="userId" id="userId">
                        <div class="mb-3">
                            <label>Select Counselor User ID</label>
                            <input type="number" name="counselorId" id="counselorIdInput" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Slot Times (JSON array with start/end)</label>
                            <textarea name="slotTimes" id="slotTimesInput" class="form-control" rows="3" placeholder='[{"start":"2024-01-01 09:00","end":"2024-01-01 10:00"}]' required></textarea>
                            <small class="text-muted">Example: [{"start":"2024-01-01 09:00","end":"2024-01-01 10:00"},{"start":"2024-01-01 14:00","end":"2024-01-01 15:00"}]</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update Slots</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <footer class="footer mt-auto py-3 bg-white">
        <div class="container">
            <span class="text-center small">CampusMind - Admin Panel</span>
        </div>
    </footer>
    <script>
        // Handle modal open to populate counselor info
        document.querySelectorAll('.counselor-row').forEach(element => {
            element.addEventListener('click', function() {
                // Could populate form with existing slots
            });
        });
    </script>
</body>
</html>