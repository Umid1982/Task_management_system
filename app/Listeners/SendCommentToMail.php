<?php

namespace App\Listeners;

use App\Events\SendComment;
use App\Mail\User\CommentSendMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendCommentToMail implements ShouldQueue
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
    public function handle(SendComment $event): void
    {
        Mail::to($event->email)->send(new CommentSendMail($event->comment));
    }
}
