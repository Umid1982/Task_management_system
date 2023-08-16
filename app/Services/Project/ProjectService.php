<?php

namespace App\Services\Project;

use App\Models\Project;

class ProjectService
{
    public function projectsLists()
    {
        return Project::all();
    }

    public function projectStore(string $title,string $description,string $status_date,int $team_id):Project
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

    public function projectUpdate($project,$data)
    {
        $project->update($data);

        return $project;
    }

    public function delete(Project $project)
    {
        try {
            Project::query()->where('team_id', '=', $project->id)->delete();

            $project->delete();

            return true;
        } catch (Exception $exception) {
            return false;
        }
    }
}
