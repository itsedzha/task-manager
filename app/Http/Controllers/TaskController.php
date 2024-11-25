<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = \App\Models\Task::query();
    
        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->input('search') . '%')
                  ->orWhere('priority', 'like', '%' . $request->input('search') . '%');
        }
    
        $tasks = $query->paginate(10);
    
        $totalTasks = \App\Models\Task::count();
        $completedTasks = \App\Models\Task::where('completed', true)->count();
        $upcomingDeadlines = \App\Models\Task::where('deadline', '>=', now())->count();
    
        // task progresa formula
        $progress = $totalTasks > 0 ? round(($completedTasks / $totalTasks) * 100) : 0;
    
        return view('tasks.index', compact('tasks', 'totalTasks', 'completedTasks', 'upcomingDeadlines', 'progress'));
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
        ]);
    
        \App\Models\Task::create($validated);
    
        return redirect()->route('tasks.index')->with('success', 'Task created successfully!');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $task = \App\Models\Task::findOrFail($id); // Find the task by ID
        return view('tasks.edit', compact('task')); // Pass the task to the view
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
        ]);
    
        $task = \App\Models\Task::findOrFail($id);
        $task->update($validated);
    
        return redirect()->route('tasks.index')->with('success', 'Task updated successfully!');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $task = \App\Models\Task::findOrFail($id); // Find the task by ID
        $task->delete(); // Delete the task
    
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully!');
    }
    
}
