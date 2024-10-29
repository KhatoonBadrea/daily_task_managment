<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Services\TaskService;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Requests\UpdateTaskStatusRequest;

class TaskController extends Controller
{

    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $tasks = $this->taskService->getAllTasks();
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }

    /**
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * create new task
     * @param StoreTaskRequest $request
     * @return ????
     */
    public function store(StoreTaskRequest $request)
    {
        $validationdata = $request->validated();

        $this->taskService->createTask($validationdata);
        return redirect()->route('tasks.index')->with('success', 'task added successfully');
    }

    /**
     */
    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    /**
     */
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }
    

    /**
     * 
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {

        $validationdata = $request->validated();

        $this->taskService->updateTask($task, $validationdata);
        return redirect()->route('tasks.index')->with('success', 'task update successfully');
    }

    /**
     */
    public function destroy(Task $task)
    {
        $this->taskService->deleteTask($task);
        return redirect()->route('tasks.index');
    }

  
}
