<?php

namespace App\Console\Commands;

use App\Services\TaskService;
use Illuminate\Console\Command;

class dailyMail extends Command
{
    public function __construct(TaskService $taskService)
    {
        parent::__construct();
        $this->taskService = $taskService;
    }
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:daily-mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $taskService;


    public function handle()
    {
        $this->taskService->sendPendingTasksEmails();
        $this->info('Pending task emails sent successfully.');
    }
}
