<?php

namespace App\Services\Task;

use App\Events\TaskSend;
use App\Http\Resources\TaskResource;
use App\Mail\User\PasswordMail;
use App\Mail\User\TaskSendMail;
use App\Models\Task;
use App\Models\TaskUser;
use App\Models\User;
use App\Models\UserTask;
use Cassandra\Exception\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use mysql_xdevapi\Exception;
use Spatie\Activitylog\Models\Activity;

class TaskService
{
    /**
     * @throws \Exception
     */
    public function taskList()
    {
        return Task::all();
    }

    public function storeTask($title, $description, $status, $priority, $expired_at, $user_id)
    {
        /** @var Task $task */
        $task = Task::query()->create([
            'title' => $title,
            'description' => $description,
            'status' => $status ? $status : 'new',
            'priority' => $priority,
            'expired_at' => $expired_at,
            'user_id' => $user_id
        ]);
        $user = User::query()->findOrFail($task->user_id);

        event(new TaskSend($title, $user->email));

        /** @var Activity $userAuth */
        $userAuth = auth()->user();
        activity($userAuth->email)->log('Task create ');

        return $task;
    }

    public function updateTask(string $title, string $description, string $status, string $priority, $expired_at, int $user_id, $task)
    {
        if (auth()->user()->hasPermissionTo('update')) {
            $task->update([
                'title' => $title,
                'description' => $description,
                'status' => $status,
                'priority' => $priority,
                'expired_at' => $expired_at,
                'user_id' => $user_id
            ]);

            /** @var Activity $userAuth */
            $userAuth = auth()->user();
            activity($userAuth->email)->log('Task update ');

            return $task;
        }
        return false;
    }

    public function delete($task)
    {
        if (auth()->user()->hasPermissionTo('delete')) {
            $task->delete();

            /** @var Activity $userAuth */
            $userAuth = auth()->user();
            activity($userAuth->email)->log('Task delete ');

            return true;
        }
        return false;

    }

    public function createTaskUsers(int $task_id, int $user_id)
    {
        /** @var TaskUser $taskUser */
        $taskUser = TaskUser::query()->create([
            'task_id' => $task_id,
            'user_id' => $user_id,
        ]);
        return $taskUser;
    }

    public function userTaskTime(int $user_id, int $task_id, $start_time, $end_time)
    {
        $userTime = UserTask::query()->create([
            'user_id' => $user_id,
            'task_id' => $task_id,
            'start_time' => $start_time,
            'end_time' => $end_time,
        ]);
        return $userTime;
    }

    public function dependencie(string $status, Task $task)
    {

        $task->load('children');

        foreach ($task->children as $child) {
            if ($child->status != 'finish') {
                throw new Exception('not all dependent tasks are finished');
            }
        }

        return $task->update([
            'status' => $status,
        ]);
    }
}
