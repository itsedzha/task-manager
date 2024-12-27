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

        // datus aizsuta uz dashboard skatu
        return view('dashboard', compact('tasks', 'totalTasks', 'completedTasks', 'progress'));
    }
}
