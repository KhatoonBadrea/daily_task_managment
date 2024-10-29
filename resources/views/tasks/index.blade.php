
<div class="container">
    <style>
        .header-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
            margin-bottom: 20px;
        }
        .header-section h2 {
            font-size: 1.75rem;
            color: #343a40;
        }
        .table-container {
            margin: 0 auto;
            width: 100%;
            max-width: 1200px;
        }
        .table-custom {
            background-color: #f8f9fa;
            width: 100%;
        }
        .table-custom thead {
            background-color: #343a40;
            color: white;
        }
        .table-custom th, .table-custom td {
            vertical-align: middle;
            text-align: center;
        }
        .badge-status {
            font-size: 0.85rem;
            padding: 0.5em 0.75em;
        }
        .alert-success {
            margin-top: 10px;
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }
        .btn-custom {
            font-size: 0.85rem;
            margin-right: 5px;
        }
    </style>

    <div class="header-section">
        <h2>Task List</h2>
        <a href="{{ route('tasks.create') }}" class="btn btn-primary">Add New Task</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="table-container">
        <div class="table-responsive">
            <table class="table table-hover table-bordered table-striped border-dark table-custom">
                <thead>
                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Due Date</th>
                        <th scope="col">Status</th>
                        <th scope="col" colspan="3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasks as $task)
                    <tr>
                        <td>{{ $task->title }}</td>
                        <td>{{ $task->description }}</td>
                        <td>{{ $task->due_date }}</td>
                        <td>
                            <span class="badge badge-status badge-{{ $task->status == 'complete' ? 'success' : 'secondary' }}">
                                {{ ucfirst($task->status) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('tasks.show', $task) }}" class="btn btn-info btn-sm btn-custom">Show</a>
                        </td>
                        <td>
                            <a href="{{ route('tasks.edit', $task) }}" class="btn btn-warning btn-sm btn-custom">Edit</a>
                        </td>
                       
                        
                        <td>
                            <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm btn-custom" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
