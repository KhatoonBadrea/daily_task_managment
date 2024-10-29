<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Task;
use App\Models\User;
use App\Mail\SendServiceMail;
use Illuminate\Support\Facades\Log;
use App\Events\updatTaskStatusEvent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
                'user_id' => Auth::user()->id,
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
            event(new updatTaskStatusEvent($task));
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


    public function sendPendingTasksEmails()
    {
        $users = User::with(['tasks' => function ($query) {
            $query->where('status', 'Pending')
                ->whereDate('created_at', Carbon::today());
        }])->get();

        foreach ($users as $user) {
            if ($user->tasks->isNotEmpty()) {
                Mail::to($user->email)->send(new SendServiceMail($user->tasks));
            }
        }

        return 'Pending task emails sent to users.';
    }
}
