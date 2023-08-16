<?php

namespace App\Services\Team;



use App\Models\Team;
use App\Models\TeamUser;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class TeamService
{

    /**
     * Список комманд
     *
     * @return Collection
     */
    public function teamsList(): Collection
    {
        return Team::all();
    }

    public function storeTeam(string $name,int $user_id)
    {
        /** @var Team $team */
        $team = Team::query()->create([
            'name'=>$name,
            'user_id'=>$user_id,
        ]);
        return $team;
    }

    public function updateTeam($name,$user_id,$team)
    {
        $team->update([
            'name'=>$name,
            'user_id'=>$user_id,
        ]);
        return $team;
    }

    public function delete(Team $team): bool
    {
        try {
            TeamUser::query()->where('team_id', '=', $team->id)->delete();

            $team->delete();

            return true;
        } catch (Exception $exception) {
            return false;
        }
    }
    public function createParticipant($storeRequest)

    {
        /** @var TeamUser $teamUser */
        $data = $storeRequest->validated();
        $teamUser = TeamUser::query()->create($data);
        return $teamUser;

//        if (User::query()->where('id', '=', $storeRequest['user_id'])
//            &&
//            Team::query()->where('id', '=', $storeRequest['team_id'])) {
//            $teamUser = TeamUser::query()->create([
//                'user_id' => $data['participant_id'],
//                'team_id' => $data['team_id']
//            ]);
//            return $teamUser;
//        }
//        return false;

    }
}


