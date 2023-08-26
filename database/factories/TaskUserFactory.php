<?php

namespace Database\Factories;


use App\Models\Task;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TeamUser>
 */
class TaskUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::query()->inRandomOrder()->first();
        $team = Task::query()->inRandomOrder()->first();
        return [
            'user_id'=>$user->id,
            'task_id'=>$team->id,
        ];
    }
}
