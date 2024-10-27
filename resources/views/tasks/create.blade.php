<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>create new task</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body dir="rtl">
    <div class="container mt-5">
        <h2 class="text-center mb-4">create new task</h2>
        
        <div class="card shadow-lg p-4">
            <form action="{{ route('tasks.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="title" class="form-label">title</label>
                    <input type="text" name="title" id="title" class="form-control"  >
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">description</label>
                    <textarea name="description" id="description" class="form-control" rows="3"  ></textarea>
                </div>

                

                <div class="mb-3">
                    <label for="status" class="form-label">status</label>
                    <select name="status" id="status" class="form-select" required>
                        <option value="Pending"> Pending</option>
                        <option value="Completed">Completed</option>
                    </select>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary w-50"> add task</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
