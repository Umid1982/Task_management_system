<?php

namespace Database\Factories;

use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $team = Team::query()->inRandomOrder()->first();
        return [
            'title'=>$this->faker->title,
            'description'=>$this->faker->text,
            'status_date'=>$this->faker->title,
            'team_id'=>$team->id,
        ];
    }
}
