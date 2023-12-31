<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

//        \App\Models\User::factory(10)->create();
        $this->call([
//            TeamSeeder::class,
//            TeamUserSeeder::class,
//            ProjectSeeder::class,
//            TaskSeeder::class,
//            RoleSeeder::class,
//            CommentTaskSeeder::class,
//        TaskUserSeeder::class,
        UserTaskSeeder::class,
        ]);
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
