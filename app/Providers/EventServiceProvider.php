<?php

namespace App\Providers;

use App\Events\SendComment;
use App\Events\SendPassword;
use App\Events\TaskSend;
use App\Listeners\SendCommentToMail;
use App\Listeners\SendPasswordToEmail;
use App\Listeners\SendTaskTitleToEmail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        SendPassword::class => [
            SendPasswordToEmail::class,
        ],
        TaskSend::class => [
            SendTaskTitleToEmail::class,
        ],
        SendComment::class => [
            SendCommentToMail::class,
        ],


    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
