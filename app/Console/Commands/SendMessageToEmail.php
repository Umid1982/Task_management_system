<?php

namespace App\Console\Commands;

use App\Console\Constants\ResponseConstants\StatusResponseEnum;
use App\Events\SendOverdue;
use App\Events\SendWillOverdue;
use App\Mail\UserSendMessageMail;
use App\Mail\UserSendWarningMessageMail;
use App\Models\Task;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendMessageToEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-message-to-email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send message User to email';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $taskOverdue = 'Вы не уложились вовремя';
        $taskWillOverdue = 'У Вас осталось времени';
        $tasks = Task::query()->where('status', '!=', StatusResponseEnum::NEW)->get();
        $now = now()->timestamp;
        foreach ($tasks as $task) {
            $expiredAt = strtotime($task->expired_at);

            if ($now > $expiredAt && $task->status != StatusResponseEnum::FINISHED) {
                $user = User::query()->where('id', '=', $task->user_id)->first();
                Mail::to($user->email)->send(new UserSendMessageMail($taskOverdue));
            } elseif ($expiredAt - $now <= 14400) {
                $user = User::query()->where('id', '=', $task->user_id)->first();
                Mail::to($user->email)->send(new UserSendWarningMessageMail($taskWillOverdue));
            }
        }
    }
}
