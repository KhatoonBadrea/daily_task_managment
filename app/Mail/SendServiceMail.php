<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendServiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $tasks;

    /**
     * Create a new message instance.
     */
    public function __construct($tasks)
    {
        $this->tasks = $tasks;
    }

    public function build()
    {
        return $this->subject('Pending Tasks Reminder')
                    ->view('email.pendingTask')
                    ->with(['tasks' => $this->tasks]);
    }
}
