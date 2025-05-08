<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class DashboardController extends Controller
{
    public function index()
    {
        // atgriez datus autentificetajam user
        $tasks = Task::where('user_id', auth()->id())->get();
    
        $totalTasks = $tasks->count();
        $completedTasks = $tasks->where('completed', true)->count();
        $highPriorityCompleted = $tasks->where('completed', true)->where('priority', 'high')->count();
        $allCompletedBeforeDeadline = $tasks->where('completed', true)->every(function ($task) {
            return now()->lt($task->deadline);
        });
    
        $progress = $totalTasks > 0 ? round(($completedTasks / $totalTasks) * 100, 2) : 0;
        // background color
        // ja nav preference, tad default ir #181b34
        // ja preference ir, tad izmanto preference
        $backgroundColor = auth()->user()->preference->background_color ?? '#181b34';
    
        $badge_5_tasks = $completedTasks >= 5;
        $badge_10_priority = $highPriorityCompleted >= 10;
        $badge_deadline = $completedTasks > 0 && $allCompletedBeforeDeadline;
        $badge_20_total = $completedTasks >= 20;
    
        return view('dashboard', compact(
            'tasks',
            'totalTasks',
            'completedTasks',
            'progress',
            'backgroundColor',
            'badge_5_tasks',
            'badge_10_priority',
            'badge_deadline',
            'badge_20_total'
        ));
    }
    
}
