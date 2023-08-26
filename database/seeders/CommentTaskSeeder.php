<?php

namespace Database\Seeders;

use App\Models\CommentTask;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentTaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CommentTask::factory(15)->create();
    }
}
