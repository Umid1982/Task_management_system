<?php

namespace App\Http\Controllers;

use App\Console\Constants\ResponseConstants\ProjectResponseEnum;
use App\Http\Requests\Project\StoreRequest;
use App\Http\Requests\Project\UpdateRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use App\Services\Project\ProjectService;
use App\Models\TeamUser;
use App\Models\User;

class ProjectController extends Controller
{
    public function __construct(protected readonly ProjectService $projectService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = $this->projectService->projectsLists();

        return response([
            'data' => ProjectResource::collection($projects),
            'message' => ProjectResponseEnum::PROJECT_LIST,
            'success' => true
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $storeRequest)
    {
        $project = $this->projectService->projectStore(
            $storeRequest->get('title'),
            $storeRequest->get('description'),
            $storeRequest->get('status_date'),
            $storeRequest->get('team_id')
        );

        return response([
            'data' => ProjectResource::make($project),
            'message' => ProjectResponseEnum::PROJECT_CREATE,
            'success' => true
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return response([
            'data' => ProjectResource::make($project),
            'message' => ProjectResponseEnum::PROJECT_SHOW,
            'success' => true
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Project $project)
    {
        $data = $request->validated();
        $projectUpdate = $this->projectService->projectUpdate($project, $data);
        return response([
            'data' => ProjectResource::make($projectUpdate),
            'message' => ProjectResponseEnum::PROJECT_UPDATED,
            'success' => true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $isSuccess = $this->projectService->delete($project);

        if (!$isSuccess) {
            return response([
                'message' => ProjectResponseEnum::PROJECT_DELETE_FAILED,
                'success' => false,
            ]);
        }

        return response([
            'message' => ProjectResponseEnum::PROJECT_DELETED,
            'success' => true
        ]);
    }
}
