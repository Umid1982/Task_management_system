<?php

namespace Database\Seeders;

use App\Models\TaskUser;

use Illuminate\Database\Seeder;

class TaskUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TaskUser::factory(10)->create();
    }
}
