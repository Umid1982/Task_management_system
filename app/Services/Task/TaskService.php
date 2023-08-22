<?php

namespace App\Services\Task;

use App\Models\Task;
use App\Models\TaskUser;

class TaskService
{
    /**
     * @throws \Exception
     */
    public function taskList()
    {
        return Task::all();
    }

    public function storeTask($title, $description, $status, $priority, $user_id)
    {
        /** @var Task $task */
        $task = Task::query()->create([
            'title' => $title,
            'description' => $description,
            'status' => $status,
            'priority' => $priority,
            'user_id' => $user_id
        ]);
        return $task;
    }

    public function updateTask(string $title, string $description, string $status, string $priority, int $user_id, $task)
    {
        if (auth()->user()->hasPermissionTo('update')) {
            $task->update([
                'title' => $title,
                'description' => $description,
                'status' => $status,
                'priority' => $priority,
                'user_id' => $user_id
            ]);
            return $task;
        }
        return false;
    }

    public function delete($task)
    {
        if (auth()->user()->hasPermissionTo('delete')) {
            $task->delete();
            return true;
        }
        return false;

    }

    public function createTaskUsers(int $task_id, int $user_id)
    {
        /** @var TaskUser $taskUser */
        $taskUser = TaskUser::query()->create([
            'task_id' => $task_id,
            'user_id' => $user_id
        ]);
        return $taskUser;
    }
}
