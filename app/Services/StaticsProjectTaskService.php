<?php

namespace App\Services;

use App\Models\Project;
use App\Models\Task;

class StaticsProjectTaskService
{
    public function statisticalList()
    {
        $in_progressProject = Project::query()->where('status_date', '=', 'in_progress')->get();
        $finishedProject = Project::query()->where('status_date', '=', 'finish')->get();
        $overdueProject = Project::query()->where('status_date', '=', 'overdue')->get();

        $in_progressTask = Task::query()->where('status', '=', 'in_progress')->get();
        $finishedTask = Task::query()->where('status', '=', 'finish')->get();
        $overdueTask = Task::query()->where('status', '=', 'overdue')->get();

        return [
            'project' => [
                'inProgress' => $in_progressProject->count(),
                'finish' => $finishedProject->count(),
                'overdue' => $overdueProject->count(),
            ],
            'task' => [
                'inProgress' => $in_progressTask->count(),
                'finish' => $finishedTask->count(),
                'overdue' => $overdueTask->count(),
            ]
        ];
    }
}
