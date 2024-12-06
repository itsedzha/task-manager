<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <style>
        .material-symbols-outlined {
            font-variation-settings:
                'FILL' 0,
                'wght' 400,
                'GRAD' 0,
                'opsz' 24;
        }

        .trophy-icon {
            color: #FFD700;
        }

        .priority-high {
            background-color: #ffe5e5;
            color: #d90000;
            padding: 0.2rem 0.5rem;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            font-weight: bold;
        }

        .priority-medium {
            background-color: #fff8db;
            color: #ff9900;
            padding: 0.2rem 0.5rem;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            font-weight: bold;
        }

        .priority-low {
            background-color: #e9f6e7;
            color: #009900;
            padding: 0.2rem 0.5rem;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            font-weight: bold;
        }

        .circle {
            border: 2px solid #9ca3af;
            border-radius: 50%;
            height: 1.5rem;
            width: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .circle.checked {
            border-color: #4caf50;
            background-color: #4caf50;
        }

        .circle.checked .material-symbols-outlined {
            color: white;
        }
    </style>
</head>

<body class="bg-gray-50 font-sans">

    <div class="container mx-auto py-6">
        <h1 class="text-3xl font-bold text-center text-gray-800">Task Manager</h1>

        @if (session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded mt-4">
            {{ session('success') }}
        </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mt-8">
            <div class="bg-white shadow rounded-lg p-6 text-center">
                <img src="{{ asset('dashboard-icons/list-check.png') }}" alt="Total Tasks"
                    class="w-12 h-12 mx-auto mb-4">
                <h2 class="text-3xl font-bold text-blue-500">{{ $totalTasks }}</h2>
                <p class="text-sm text-gray-600">Total Tasks<br><span class="text-gray-500">All tasks created</span></p>
            </div>

            <div class="bg-white shadow rounded-lg p-6 text-center">
                <img src="{{ asset('dashboard-icons/check-circle.png') }}" alt="Completed Tasks"
                    class="w-12 h-12 mx-auto mb-4">
                <h2 class="text-3xl font-bold text-green-500">{{ $completedTasks }}</h2>
                <p class="text-sm text-gray-600">Completed Tasks<br><span class="text-gray-500">Tasks finished</span></p>
            </div>

            <div class="bg-white shadow rounded-lg p-6 text-center">
                <img src="{{ asset('dashboard-icons/arrow-trend-up.png') }}" alt="Completion Rate"
                    class="w-12 h-12 mx-auto mb-4">
                <h2 class="text-3xl font-bold text-purple-500">{{ $progress }}%</h2>
                <p class="text-sm text-gray-600">Completion Rate<br><span class="text-gray-500">Overall progress</span></p>
                <div class="w-3/4 mx-auto bg-gray-200 rounded-full h-2 mt-2">
                    <div class="bg-purple-500 h-2 rounded-full" style="width: {{ $progress }}%;"></div>
                </div>
            </div>

            <div class="bg-white shadow rounded-lg p-6 text-center">
                <img src="{{ asset('dashboard-icons/trophy.png') }}" alt="Total Points" class="w-12 h-12 mx-auto mb-4">
                <h2 class="text-3xl font-bold text-yellow-500">{{ $totalPoints }}</h2>
                <p class="text-sm text-gray-600">Total Points<br><span class="text-gray-500">Motivation points
                        earned</span></p>
            </div>
        </div>

        <div class="mt-12">
            <h2 class="text-2xl font-semibold text-gray-800">Rewards</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mt-6">
                <div class="bg-indigo-50 border border-indigo-300 rounded-lg shadow p-4 text-center">
                    <span class="material-symbols-outlined text-purple-500 text-6xl">emoji_events</span>
                    <p class="text-lg font-semibold text-gray-700 mt-2">Task Master Badge</p>
                    <p class="text-gray-500 text-sm">Complete 5 tasks</p>
                </div>
                <div class="bg-indigo-50 border border-indigo-300 rounded-lg shadow p-4 text-center">
                    <span class="material-symbols-outlined text-blue-500 text-6xl">star</span>
                    <p class="text-lg font-semibold text-gray-700 mt-2">Productivity Star</p>
                    <p class="text-gray-500 text-sm">Complete 10 high-priority tasks</p>
                </div>
                <div class="bg-indigo-50 border border-indigo-300 rounded-lg shadow p-4 text-center">
                    <span class="material-symbols-outlined text-green-500 text-6xl">target</span>
                    <p class="text-lg font-semibold text-gray-700 mt-2">Goal Crusher</p>
                    <p class="text-gray-500 text-sm">Complete all tasks before deadline</p>
                </div>
                <div class="bg-indigo-50 border border-indigo-300 rounded-lg shadow p-4 text-center">
                    <span class="material-symbols-outlined text-yellow-500 text-6xl">workspace_premium</span>
                    <p class="text-lg font-semibold text-gray-700 mt-2">Ultimate Achiever</p>
                    <p class="text-gray-500 text-sm">Complete 20 tasks</p>
                </div>
            </div>
        </div>

        <div class="mt-12">
    <h2 class="text-2xl font-semibold text-gray-800">Your Tasks</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-4">
        @forelse ($tasks as $task)
        <div class="bg-white shadow rounded-lg p-4">
            <div class="flex items-center space-x-2">
                <div class="circle {{ $task->completed ? 'checked' : '' }}"
                    onclick="document.getElementById('task-complete-{{ $task->id }}').submit();">
                    @if ($task->completed)
                    <span class="material-symbols-outlined">check</span>
                    @endif
                </div>
                <h3
                    class="text-lg font-semibold text-gray-800 {{ $task->completed ? 'line-through text-gray-500' : '' }}">
                    {{ $task->title }}
                </h3>
            </div>
            <p class="text-gray-600 text-sm">{{ $task->description }}</p>
            <div class="flex items-center text-sm text-gray-600 mt-2">
                <span class="material-symbols-outlined text-gray-500 mr-1">calendar_month</span>
                {{ $task->deadline ? $task->deadline->format('M d, Y') : 'No deadline' }}
            </div>
            <span
                class="{{ $task->priority === 'high' ? 'priority-high' : ($task->priority === 'medium' ? 'priority-medium' : 'priority-low') }}">
                {{ ucfirst($task->priority) }}
            </span>

            @if ($task->subtasks->count() > 0)
            <div class="mt-4">
                <h4 class="text-sm font-medium text-gray-700">Subtasks</h4>
                <div class="grid gap-2">
                    @foreach ($task->subtasks as $subtask)
                    <div class="flex items-center justify-between bg-gray-100 p-2 rounded">
                        <div class="flex items-center space-x-2">
                            <div class="circle {{ $subtask->completed ? 'checked' : '' }}"
                                onclick="document.getElementById('subtask-complete-{{ $subtask->id }}').submit();">
                                @if ($subtask->completed)
                                <span class="material-symbols-outlined">check</span>
                                @endif
                            </div>
                            <span
                                class="{{ $subtask->completed ? 'line-through text-gray-500' : '' }}">{{ $subtask->title }}</span>
                        </div>
                        <form action="{{ route('subtasks.destroy', $subtask->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-gray-500 hover:text-gray-700 text-lg font-bold">
                                &#x2716;
                            </button>
                        </form>
                        <form id="subtask-complete-{{ $subtask->id }}"
                            action="{{ route('subtasks.update', $subtask->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="completed" value="{{ $subtask->completed ? 0 : 1 }}">
                        </form>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <div class="flex items-center justify-between mt-4">
                <span class="flex items-center">
                    <span class="material-symbols-outlined trophy-icon mr-1">emoji_events</span>
                    {{ $task->points }}
                </span>
                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500 hover:text-red-700">
                        <span class="material-symbols-outlined">delete</span>
                    </button>
                </form>
            </div>
            <form id="task-complete-{{ $task->id }}" action="{{ route('tasks.update', $task->id) }}" method="POST"
                style="display: none;">
                @csrf
                @method('PATCH')
                <input type="hidden" name="completed" value="{{ $task->completed ? 0 : 1 }}">
            </form>
        </div>
        @empty
        <p class="text-center text-gray-500">No tasks found. Create your first task!</p>
        @endforelse
    </div>
</div>

<div class="mt-8 text-right">
    <a href="{{ route('tasks.create') }}"
        class="inline-block px-6 py-2 bg-purple-500 text-white rounded hover:bg-purple-600">
        + Add Task
    </a>
</div>

<!-- Wellness Tools sekcija -->
<div class="mt-12">
    <h2 class="text-2xl font-semibold text-purple-700">Wellness Tools</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
        <!-- Box Breathing -->
        <div class="bg-white shadow rounded-lg p-6 text-center">
            <span class="material-symbols-outlined text-blue-500 text-5xl">air</span>
            <h3 class="text-lg font-bold text-gray-800 mt-2">Box Breathing</h3>
            <p class="text-sm text-gray-500">2 minutes</p>
            <p class="text-sm text-gray-600 mt-2">Breathe in for 4 counts, hold for 4, exhale for 4, hold for 4. Repeat.</p>
            <button id="start-box-breathing"
                class="mt-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                Start Exercise
            </button>
        </div>
        <!-- Body Scan -->
        <div class="bg-white shadow rounded-lg p-6 text-center">
            <span class="material-symbols-outlined text-green-500 text-5xl">favorite</span>
            <h3 class="text-lg font-bold text-gray-800 mt-2">Body Scan</h3>
            <p class="text-sm text-gray-500">5 minutes</p>
            <p class="text-sm text-gray-600 mt-2">Close your eyes and focus on each part of your body, releasing tension.</p>
            <button id="start-body-scan"
                class="mt-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                Start Exercise
            </button>
        </div>
        <!-- Mindful Moment -->
        <div class="bg-white shadow rounded-lg p-6 text-center">
            <span class="material-symbols-outlined text-yellow-500 text-5xl">spa</span>
            <h3 class="text-lg font-bold text-gray-800 mt-2">Mindful Moment</h3>
            <p class="text-sm text-gray-500">1 minute</p>
            <p class="text-sm text-gray-600 mt-2">Take a moment to observe your surroundings using all your senses.</p>
            <button id="start-mindful-moment"
                class="mt-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                Start Exercise
            </button>
        </div>
    </div>
</div>
