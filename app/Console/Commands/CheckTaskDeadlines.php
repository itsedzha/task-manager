<?php

namespace App\Console\Commands;

use App\Models\Task;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CheckTaskDeadlines extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tasks:check-deadlines';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check for upcoming task deadlines and create notifications';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // šodienas un rītdienas datumi
        $today = Carbon::today();
        $tomorrow = Carbon::tomorrow();
        
        $tasks = Task::where('completed', 0)
            ->whereDate('deadline', '>=', $today)
            ->whereDate('deadline', '<=', $tomorrow)
            ->get();
            
        $notificationCount = 0;
        
        foreach ($tasks as $task) {
            // pārbauda vai deadline ir šodien
            if ($task->deadline->isToday()) {
                $message = "Task \"$task->title\" is due today!";
            } else {
                $message = "Task \"$task->title\" is due tomorrow!";
            }
            
            // pārbauda vai notifikācija jau eksistē un nav redzēta
            $existingNotification = Notification::where('task_id', $task->id)
                ->where('read', false)
                ->where('created_at', '>=', Carbon::today()->startOfDay())
                ->exists();
                
            if (!$existingNotification) {
                Notification::create([
                    'user_id' => $task->user_id,
                    'task_id' => $task->id,
                    'message' => $message,
                    'type' => 'deadline',
                    'read' => false,
                ]);
                
                $notificationCount++;
            }
        }
        
        $this->info("Created $notificationCount deadline notifications.");
    }
}
