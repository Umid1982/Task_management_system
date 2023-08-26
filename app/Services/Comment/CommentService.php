<?php

namespace App\Services\Comment;

use App\Events\SendComment;
use App\Mail\User\CommentSendMail;
use App\Models\CommentTask;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class CommentService
{
    /** @throws \Exception */

    public function commentList()
    {
        return CommentTask::all();
    }

    public function storeComment($comment, $task_id)
    {
        $comment = CommentTask::query()->create([
            'comment' => $comment,
            'user_id' => auth()->user()->id,
            'task_id' => $task_id
        ]);
        return $comment;
    }

    public function updateComment($comment, $task_id, $commentTask)
    {
        if (auth()->user()->hasPermissionTo('update')) {

            $commentTask->update([
                'comment' => $comment,
                'user_id' => auth()->user()->id,
                'task_id' => $task_id
            ]);
            return $commentTask;
        }
        return false;
    }

    public function delete($commentTask)
    {
        if (auth()->user()->hasPermissionTo('delete')) {
            $commentTask->delete();
            return true;
        }
        return false;

    }

    public function send($comment, $user_id, $task_id)
    {
        if (auth()->user()->hasAnyRole('admin', 'manager')) {
            $commentUser = CommentTask::query()->create([
                'comment' => $comment,
                'user_id' => $user_id,
                'task_id' => $task_id
            ]);
            $user = User::query()->findOrFail($commentUser->user_id);
            event(new SendComment($user->email, $comment));
            return $commentUser;
        }
        return false;
    }
}
