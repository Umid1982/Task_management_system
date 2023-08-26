<?php

namespace App\Listeners;

use App\Events\TaskSend;
use App\Mail\User\TaskSendMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendTaskTitleToEmail implements ShouldQueue
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
    public function handle(TaskSend $event): void
    {
        Mail::to($event->email)->send(new TaskSendMail($event->title));
    }
}
