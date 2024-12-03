<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\User; 

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first(); 

        if ($user) {
            DB::table('tasks')->insert([
                [
                    'title' => 'Task 1',
                    'description' => 'Complete math homework',
                    'priority' => 'low',
                    'completed' => false,
                    'deadline' => Carbon::now()->addDays(3),
                    'user_id' => $user->id, // Associate with the first user
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'title' => 'Task 2',
                    'description' => 'Prepare for physics exam',
                    'priority' => 'high',
                    'completed' => false,
                    'deadline' => Carbon::now()->addDays(1),
                    'user_id' => $user->id, // Associate with the first user
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
            ]);
        }
    }
}
