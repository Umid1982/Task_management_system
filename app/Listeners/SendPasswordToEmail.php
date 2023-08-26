<?php

namespace App\Listeners;

use App\Events\SendPassword;
use App\Mail\User\PasswordMail;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendPasswordToEmail implements ShouldQueue
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
    public function handle(SendPassword $event): void
    {
        Mail::to($event->email)->send(new PasswordMail($event->password));
    }
}
