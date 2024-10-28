{{-- @extends('layouts.app')

@section('content') --}}
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> edit status</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body dir="rtl">
    <div class="container mt-5">
        <h2 class="text-center mb-4"> edit status</h2>
        
        <div class="card shadow-lg p-4">
            <form action="{{ route('status', $task) }}" method="POST">
                @csrf
                @method('Patch')

               
               

                <div class="mb-3">
                    <label for="status" class="form-label">status</label>
                    <select name="status" id="status" class="form-select" required>
                        <option value="Pending" {{ $task->status == 'Pending' ? 'selected' : '' }}> Pending</option>
                        <option value="Completed" {{ $task->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary w-50"> update</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
{{-- @endsection --}}
