<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert sample tasks
        DB::table('tasks')->insert([
            [
                'title' => 'Task 1',
                'description' => 'Complete math homework',
                'priority' => 'low',
                'completed' => false,
                'deadline' => Carbon::now()->addDays(3), // 3 days from now
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Task 2',
                'description' => 'Prepare for physics exam',
                'priority' => 'high',
                'completed' => false,
                'deadline' => Carbon::now()->addDays(1), // 1 day from now
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Task 3',
                'description' => 'Write English essay',
                'priority' => 'medium',
                'completed' => true,
                'deadline' => Carbon::now()->subDay(), // 1 day ago
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
