<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = \App\Models\Task::query();
    
        // s
        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->input('search') . '%')
                  ->orWhere('priority', 'like', '%' . $request->input('search') . '%');
        }
    
        $tasks = $query->paginate(10);
    
        // Dashboard Metrics
        $totalTasks = \App\Models\Task::count();
        $completedTasks = \App\Models\Task::where('completed', true)->count();
        $upcomingDeadlines = \App\Models\Task::where('deadline', '>=', now())->count();
    
        $totalPoints = $completedTasks * 10; // 10 punkti par katru uzdevumu
    
        // deadline highlight
        foreach ($tasks as $task) {
            $task->is_deadline_soon = $task->deadline && $task->deadline->between(now(), now()->addDays(3));
        }
    
        // progresa formula
        $progress = $totalTasks > 0 ? round(($completedTasks / $totalTasks) * 100) : 0;
    
        return view('tasks.index', compact('tasks', 'totalTasks', 'completedTasks', 'upcomingDeadlines', 'progress', 'totalPoints'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|in:low,medium,high',
            'deadline' => 'nullable|date',
            'progress' => 'nullable|integer|min:0|max:100',
        ]);

        // Default progress to 0 if not provided
        $validated['progress'] = $validated['progress'] ?? 0;

        Task::create($validated);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|in:low,medium,high',
            'deadline' => 'nullable|date',
            'progress' => 'nullable|integer|min:0|max:100',
        ]);

        $task = Task::findOrFail($id);

        $task->update($validated);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully!');
    }
}
