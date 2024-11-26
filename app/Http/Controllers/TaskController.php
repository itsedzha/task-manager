<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // For user authentication
use App\Models\Task;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $query = Task::query();

        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->input('search') . '%')
                  ->orWhere('priority', 'like', '%' . $request->input('search') . '%');
        }

        $tasks = $query->where('user_id', Auth::id())->paginate(10); // Filter tasks by logged-in user

        $totalTasks = $tasks->count();
        $completedTasks = $tasks->where('progress', 100)->count();
        $upcomingDeadlines = $tasks->where('deadline', '>=', now())->count();

        $user = Auth::user(); // Get logged-in user
        $totalPoints = $user->points; // Fetch user's points

        $progress = $totalTasks > 0 ? round(($completedTasks / $totalTasks) * 100) : 0;

        return view('tasks.index', compact('tasks', 'totalTasks', 'completedTasks', 'upcomingDeadlines', 'progress', 'totalPoints'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|in:low,medium,high',
            'deadline' => 'nullable|date',
            'progress' => 'nullable|integer|min:0|max:100',
        ]);

        $validated['progress'] = $validated['progress'] ?? 0;
        $validated['points'] = 0;
        $validated['user_id'] = Auth::id(); // Assign task to the logged-in user

        Task::create($validated);

        return redirect()->route('tasks.index')->with('success', 'Uzdevums veiksmīgi izveidots!');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|in:low,medium,high',
            'deadline' => 'nullable|date',
            'progress' => 'required|integer|min:0|max:100',
        ]);

        $task = Task::findOrFail($id);

        $task->update($validated);

        // Update points for the logged-in user
        $user = Auth::user();
        $points = $user->points;

        if ($validated['progress'] == 100 && $task->progress < 100) {
            $points += 10; // Add 10 points for completing the task

            if ($task->priority === 'high') {
                $points += 20; // Add 20 points for high-priority tasks
            }

            if ($task->deadline && now()->lessThanOrEqualTo($task->deadline)) {
                $points += 5; // Add 5 points for meeting the deadline
            }
        }

        $user->update(['points' => $points]); // Save the updated points

        return redirect()->route('tasks.index')->with('success', 'Uzdevums veiksmīgi atjaunināts!');
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);

        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Uzdevums veiksmīgi dzēsts!');
    }
}
