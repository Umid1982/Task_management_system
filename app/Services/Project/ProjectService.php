<?php

namespace App\Services\Project;

use App\Console\Constants\ResponseConstants\RoleResponseEnum;
use App\Models\Project;
use App\Models\User;
use Exception;
use Spatie\Activitylog\Models\Activity;
use Spatie\Permission\Models\Role;

class ProjectService
{
    public function projectsLists()
    {
        return Project::all();
    }

    public function projectStore(string $title, string $description, string $status_date, $file, int $team_id): Project
    {
        /** @var Activity $userAuth */
        $userAuth = auth()->user();
        activity($userAuth->email)->log('Project create ');

        /** @var Project $project */
        $project = Project::query()->create([
            'title' => $title,
            'description' => $description,
            'status_date' => $status_date,
            'team_id' => $team_id
        ]);

        if ($file) {
            $project->addMedia($file)->toMediaCollection('file');
        }

        return $project;
    }

    public function projectUpdate(string $title, string $description, string $status_date, $file, int $team_id,$project)
    {
        if (auth()->user()->hasPermissionTo('update')) {
            $project->update([
                'title' => $title,
                'description' => $description,
                'status_date' => $status_date,
                'team_id' => $team_id
            ]);
            $project->clearMediaCollection('file');
            $project->addMedia($file)->toMediaCollection('file');

            /** @var Activity $userAuth */
            $userAuth = auth()->user();
            activity($userAuth->email)->log('Project update ');
            return $project;
        }
        return false;
    }

    public function delete(Project $project)
    {
        if (auth()->user()->hasPermissionTo('delete')) {
            Project::query()->where('team_id', '=', $project->id)->delete();
            $project->delete();

            /** @var Activity $userAuth */
            $userAuth = auth()->user();
            activity($userAuth->email)->log('Project delete ');

            return true;
        }
        return false;
    }

}
