<?php

namespace App\Listeners;

use App\Events\updatTaskStatusEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateDueDateListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(updatTaskStatusEvent $event): void
    {
        $task = $event->task;
        //check if status = done 
        if ($task->status === 'Completed') {
            $task->due_date = now();
            $task->save();
        }
    }
}
