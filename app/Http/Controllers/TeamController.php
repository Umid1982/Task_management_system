<?php

namespace App\Http\Controllers;

use App\Console\Constants\ResponseConstants\ParticipantTeamResponseEnum;
use App\Console\Constants\ResponseConstants\TeamResponseEnum;
use App\Http\Requests\Team\StoreRequest;
use App\Http\Requests\Team\UpdateRequest;
use App\Http\Resources\ParticipantResource;
use App\Http\Resources\TeamResource;
use App\Models\Team;
use App\Services\Team\TeamService;
use Illuminate\Http\Response;

class TeamController extends Controller
{
    public function __construct(
        protected readonly TeamService $teamService
    )
    {

    }

    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $teams = $this->teamService->teamsList();

        return response([
            'data' => TeamResource::collection($teams),
            'message' => TeamResponseEnum::TEAM_LIST,
            'success' => true,
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        if (auth()->user()->hasPermission('create team')) {
            abort(403);
        }

        $team = $this->teamService->storeTeam(
            $request->get('name'),
            $request->get('user_id')
        );
        return response([
            'data' => TeamResource::make($team),
            'message' => TeamResponseEnum::TEAM_STORE,
            'success' => true,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Team $team)
    {
        if (auth()->user()->hasPermissionTo('show')){
            return response([
                'data' => TeamResource::make($team),
                'message' => TeamResponseEnum::TEAM_SHOW,
                'success' => true,
            ]);
        }
        return  response([
            'message' => TeamResponseEnum::ERROR,
            'success' => false,
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Team $team)
    {
        $teamUpdate = $this->teamService->updateTeam(
            $request->get('name'),
            $request->get('user_id'),
            $team
        );

        return response([
            'data' => TeamResource::make($teamUpdate),
            'message' => TeamResponseEnum::TEAM_UPDATE,
            'success' => true,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $team)
    {
        $isSuccess = $this->teamService->delete($team);

        if (!$isSuccess) {
            return response([
                'message' => TeamResponseEnum::TEAM_DELETE_FAILED,
                'success' => false,
            ]);
        }

        return response([
            'message' => TeamResponseEnum::TEAM_DELETE,
            'success' => true,
        ]);
    }


    public function participantTeam(\App\Http\Requests\ParticipantTeam\StoreRequest $storeRequest)
    {
        $data = $this->teamService->createParticipant($storeRequest);
        return response([
            'data' => ParticipantResource::make($data->load('user')->load('team')),
            'message' => TeamResponseEnum::PARTICIPANT_TEAM_CREATE,
            'success' => true
        ]);
    }
}
