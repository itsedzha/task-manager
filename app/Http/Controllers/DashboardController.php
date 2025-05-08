<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\UserBadge;


class DashboardController extends Controller
{
    public function index()
    {
        // atgriez datus autentificetajam user
        $user = auth()->user();
    
        $tasks = Task::where('user_id', $user->id)->get();
    
        $totalTasks = $tasks->count();
        $completedTasks = $tasks->where('completed', true)->count();
        $progress = $totalTasks > 0 ? round(($completedTasks / $totalTasks) * 100, 2) : 0;
    
        $highPriorityCompleted = $tasks->where('completed', true)->where('priority', 'high')->count();
        $onTimeCompleted = $tasks->where('completed', true)
            ->filter(fn($task) => $task->deadline && $task->updated_at <= $task->deadline)
            ->count();
    
            // background color
        // ja nav preference, tad default ir #181b34
        // ja preference ir, tad izmanto preference
        $backgroundColor = $user->preference->background_color ?? '#181b34';
    
        $badge = $user->badge ?? new \App\Models\UserBadge(['user_id' => $user->id]);
    
       // atbloķē rewards, ja atbilst prasībām (tikai vienu reizi)
        if (!$badge->badge_5_tasks && $completedTasks >= 5) {
            $badge->badge_5_tasks = true;
        }
    
        if (!$badge->badge_10_priority && $highPriorityCompleted >= 10) {
            $badge->badge_10_priority = true;
        }
    
        if (!$badge->badge_deadline && $onTimeCompleted == $completedTasks && $completedTasks > 0) {
            $badge->badge_deadline = true;
        }
    
        if (!$badge->badge_20_total && $totalTasks >= 20) {
            $badge->badge_20_total = true;
        }
    
        $badge->save();
    
        return view('dashboard', compact(
            'tasks', 'totalTasks', 'completedTasks', 'progress', 'backgroundColor', 'badge'
        ));
    }
    
}
