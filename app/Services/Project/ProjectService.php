<?php

namespace App\Services\Project;

use App\Console\Constants\ResponseConstants\RoleResponseEnum;
use App\Models\Project;
use App\Models\User;
use Exception;
use Spatie\Permission\Models\Role;

class ProjectService
{
    public function projectsLists()
    {
        return Project::all();
    }

    public function projectStore(string $title, string $description, string $status_date, int $team_id): Project
    {
        /** @var Project $project */
        $project = Project::query()->create([
            'title' => $title,
            'description' => $description,
            'status_date' => $status_date,
            'team_id' => $team_id
        ]);

        return $project;
    }

    public function projectUpdate($project, $data)
    {
        if (auth()->user()->hasPermissionTo('update')){
            $project->update($data);

            return $project;
        }
       return false;
    }

    public function delete(Project $project)
    {
        if (auth()->user()->hasPermissionTo('delete')) {
            Project::query()->where('team_id', '=', $project->id)->delete();
            $project->delete();
            return true;
        }
        return false;
    }

}
