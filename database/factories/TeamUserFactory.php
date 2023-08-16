<?php

namespace Database\Factories;


use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TeamUser>
 */
class TeamUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::query()->inRandomOrder()->first();
        $team = Team::query()->inRandomOrder()->first();
        return [
            'user_id'=>$user->id,
            'team_id'=>$team->id,
        ];
    }
}
