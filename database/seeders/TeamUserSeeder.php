<?php

namespace Database\Seeders;

use App\Models\TeamUser;
use Database\Factories\TeamUserFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeamUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TeamUser::factory(10)->create();
    }
}
