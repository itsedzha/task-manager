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
        $progress = $totalTasks > 0 ? round(($completedTasks / $totalTasks) * 100, 2) : 0;

// background color
        // ja nav preference, tad default ir #181b34
        // ja preference ir, tad izmanto preference
$backgroundColor = auth()->user()->preference->background_color ?? '#181b34';

return view('dashboard', compact('tasks', 'totalTasks', 'completedTasks', 'progress', 'backgroundColor'));
    }
}
