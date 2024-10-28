<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TaskService
{
    /**
     */
    public function getAllTasks()
    {
        return Task::all();
    }

    /**
     */
    public function createTask(array $data)
    {
        try {
            Task::create([
                'title' => $data['title'],
                'description' => $data['description'],
                'due_date' => null,
                'status' => 'Pending',
            ]);
        } catch (\Exception $e) {
            Log::error('Error in TaskService@createTask: ' . $e->getMessage());
            return null;
        }
    }

    /**
     */
    public function updateTask(Task $task, array $data)
    {
        try {

            $task->update(array_filter([
                'title' => $data['title'] ?? $task->title,
                'description' => $data['description'] ?? $task->description,
                'due_date' => $data['due_date'] ?? $task->due_date,
                'status' => $data['status'] ?? $task->status,

            ]));
            return $task;
        } catch (\Exception $e) {
            Log::error('Error in TaskService@updateTask: ' . $e->getMessage());
            return null;
        }
    }

    /**
     */
    public function deleteTask(Task $task)
    {
        try {
            $task->delete();
        } catch (\Exception $e) {
            Log::error('Error in TaskService@deleteTask: ' . $e->getMessage());
        }
    }

    public function updateTaskstatus(Task $task, array $data)
    {
        try {

            $task->update([
                'status' => $data['status'] ?? $task->status,
            ]);

            // dd($task);
            return true;
        } catch (\Exception $e) {
            Log::error('Error in TaskService@updateTask: ' . $e->getMessage());
            return null;
        }
    }
}
