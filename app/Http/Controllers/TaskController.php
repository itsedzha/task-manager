<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Badge;
use App\Models\Notification;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
    
        $query = Task::where('user_id', $user->id);
    
        if ($request->has('search')) {
            $query->where(function ($subQuery) use ($request) {
                $subQuery->where('title', 'like', '%' . $request->input('search') . '%')
                         ->orWhere('priority', 'like', '%' . $request->input('search') . '%');
            });
        }
    
        $tasks = $query->paginate(10);
    
        $allTasks = Task::where('user_id', $user->id)->get();
        $totalTasks = $allTasks->count();
        $completedTasks = $allTasks->where('completed', true)->count();
        $highPriorityCompleted = $allTasks->where('priority', 'high')->where('completed', true)->count();
    
        $onTimeCompleted = $allTasks->where('completed', true)
            ->filter(fn($task) => $task->deadline && $task->updated_at <= $task->deadline)
            ->count();
    
        $totalPoints = $completedTasks * 10;
        $progress = $totalTasks > 0 ? round(($completedTasks / $totalTasks) * 100) : 0;
    
        // atgriež badge autentificetajam user no DB
        $badge = $user->badge;
        
        // saņem neredzētos uzdevumu termiņu paziņojumus
        $notifications = Notification::where('user_id', $user->id)
            ->where('read', false)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('tasks.index', compact(
            'tasks',
            'totalTasks',
            'completedTasks',
            'totalPoints',
            'progress',
            'badge',
            'notifications'
        ));
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
            'progress' => 'integer|min:0|max:100',
            'subtasks' => 'array',
            'subtasks.*' => 'nullable|string|max:255',
        ]);

        $progress = $validated['progress'] ?? 0;
        $completed = $progress == 100;

        $task = Task::create([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'priority' => $validated['priority'],
            'deadline' => $validated['deadline'] ?? null,
            'progress' => $progress,
            'completed' => $completed,
            'user_id' => auth()->id(), 
        ]);

        if (!empty($validated['subtasks'])) {
            foreach ($validated['subtasks'] as $subtaskTitle) {
                if (!empty($subtaskTitle)) {
                    DB::table('subtasks')->insert([
                        'task_id' => $task->id,
                        'title' => $subtaskTitle,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }

        return redirect()->route('tasks.index')->with('success', 'Task created successfully!');
    }


    public function edit($id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);
    
        if ($request->has('completed') && !$request->isMethod('GET')) {
            $task->update(['completed' => $request->input('completed')]);
            return redirect()->route('tasks.index')->with('success', 'Task completion status updated!');
        }
    
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|in:low,medium,high',
            'deadline' => 'nullable|date',
            'progress' => 'nullable|integer|min:0|max:100',
            'subtasks' => 'nullable|array',
            'subtasks.*' => 'string|max:255',
        ]);
    
        $progress = $validated['progress'] ?? $task->progress;
        $completed = $progress == 100;
        
        $task->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'priority' => $validated['priority'],
            'deadline' => $validated['deadline'],
            'progress' => $progress,
            'completed' => $completed,
        ]);
    
        $task->subtasks()->delete();
        
        if (isset($validated['subtasks']) && is_array($validated['subtasks'])) {
            foreach ($validated['subtasks'] as $subtaskTitle) {
                if (!empty(trim($subtaskTitle))) {
                    $task->subtasks()->create([
                        'title' => $subtaskTitle, 
                        'completed' => false
                    ]);
                }
            }
        }
    
        return redirect()->route('tasks.index')
            ->with('success', 'Task "' . $validated['title'] . '" updated successfully!');
    }
    
    public function destroy($id)
    {
        $task = Task::findOrFail($id);

        $task->subtasks()->delete();

        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully!');
    }
}
