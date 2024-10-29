<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Tasks</title>
</head>
<body>
    <h1>Pending Tasks for Today</h1>
    <ul>
        @foreach ($tasks as $task)
            <li>
                <strong>Title:</strong> {{ $task->title }} <br>
                <strong>Description:</strong> {{ $task->description }}
            </li>
        @endforeach
    </ul>
</body>
</html>
