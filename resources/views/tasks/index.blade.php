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
    body {
        background-color: #181b34;
        color: #F8FAFC;
        font-family: 'Inter', sans-serif;
    }

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
        background-color: #4c1d2f;
        color: #ff4d5a;
        padding: 0.2rem 0.5rem;
        border-radius: 0.5rem;
        font-size: 0.875rem;
        font-weight: bold;
    }

    .priority-medium {
        background-color: #453413;
        color: #ffb347;
        padding: 0.2rem 0.5rem;
        border-radius: 0.5rem;
        font-size: 0.875rem;
        font-weight: bold;
    }

    .priority-low {
        background-color: #1c3527;
        color: #6cff9f;
        padding: 0.2rem 0.5rem;
        border-radius: 0.5rem;
        font-size: 0.875rem;
        font-weight: bold;
    }

    .circle {
        border: 2px solid #64748b;
        border-radius: 50%;
        height: 1.5rem;
        width: 1.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }

    .circle.checked {
        border-color: #22c55e;
        background-color: #22c55e;
    }

    .circle.checked .material-symbols-outlined {
        color: white;
    }

    #side-menu {
        background-color: #292f4c;
        width: 240px;
        height: 100vh;
        padding: 1rem;
    }

    #side-menu h2 {
        color: #A5B4FC;
        margin-bottom: 1rem;
    }

    #side-menu a {
        display: flex;
        align-items: center;
        padding: 0.5rem;
        border-radius: 0.5rem;
        color: #A5B4FC;
        text-decoration: none;
        transition: background-color 0.2s, color 0.2s;
    }

    #side-menu a:hover {
        background-color: #3B82F6;
        color: #E0F2FE;
    }

    #side-menu a.active {
        background-color: #1E40AF;
        color: white;
    }

    .dashboard-card {
    background-color: #292f4c;
    border: 1px solid #3B425A;
    border-radius: 0.5rem;
    text-align: center;
    padding: 1.5rem;
    color: #E5E7EB;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.dashboard-card:hover {
    transform: translateY(-0.5rem);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.4);
}

.dashboard-card span {
    display: block;
    margin-bottom: 0.5rem;
}

.dashboard-card h2 {
    color: #F8FAFC;
    font-weight: bold;
    font-size: 2rem;
}

.dashboard-card p {
    color: #D1D5DB;
    font-size: 1rem;
}


.reward-card {
    background-color: #292f4c; 
    border: 1px solid #3B425A;
    border-radius: 0.5rem;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    text-align: center;
    padding: 1.5rem;
    transition: transform 0.2s ease, box-shadow 0.2s ease, background-color 0.2s ease;
}

.reward-card:hover {
    background-color: #1f253b; 
    transform: translateY(-0.5rem);
    box-shadow: 0 0 15px rgba(165, 180, 252, 0.5); 
}


.reward-card span {
    color: #A5B4FC;
    transition: filter 0.2s ease;
}

.reward-card:hover span {
    filter: drop-shadow(0 0 10px rgba(165, 180, 252, 0.8)); 
}


.reward-card p {
    color: #E5E7EB;
}

.reward-card:hover p {
    color: #FFFFFF; 
}


    .task-card {
        background-color: #292f4c;
        border-radius: 0.5rem;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        padding: 1rem;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .task-card:hover {
        transform: translateY(-0.5rem);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .task-title {
        font-weight: 600;
        color: #A5B4FC;
    }

    .task-title.completed {
        text-decoration: line-through;
        color: #6B7280;
    }

    .subtask-container {
        margin-top: 1rem;
        padding-left: 1.5rem;
        border-left: 2px solid #3B425A;
    }

    .subtask-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 0.5rem;
        padding: 0.5rem;
        background-color: #3B425A;
        border-radius: 0.5rem;
        transition: background-color 0.2s ease;
    }

    .subtask-item:hover {
        background-color: #4B5563;
    }

    .subtask-title {
        font-size: 0.875rem;
        color: #E5E7EB;
    }

    .subtask-title.completed {
        text-decoration: line-through;
        color: #9CA3AF;
    }

    .bright-bg {
        background-color: #4C4F72;
        color: #E5E7EB;
        border-radius: 0.5rem;
        padding: 1.5rem;
    }

    .bright-bg h2,
    .bright-bg p {
        color: #F8FAFC;
    }
</style>



</head>

<body class="font-sans">
    
<button id="menu-toggle" class="md:hidden fixed top-4 left-4 z-50 bg-blue-900 text-white p-2 rounded">
    <span class="material-symbols-outlined">menu</span>
</button>

<x-sidebar />

<div class="container mx-auto py-6 ml-64">

<h1 class="text-3xl font-bold text-center text-white">Task Manager</h1>


        @if (session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded mt-4">
            {{ session('success') }}
        </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mt-8">
    <!-- total tasks -->
    <div class="dashboard-card">
        <span class="material-symbols-outlined text-blue-400 text-6xl mb-2">list_alt</span>
        <h2 class="text-3xl font-bold">{{ $totalTasks }}</h2>
        <p class="text-lg text-gray-400">All tasks created</p>
    </div>

    <!-- completed tasks -->
    <div class="dashboard-card">
        <span class="material-symbols-outlined text-green-400 text-6xl mb-2">check_circle</span>
        <h2 class="text-3xl font-bold">{{ $completedTasks }}</h2>
        <p class="text-lg text-gray-400">Tasks finished</p>
    </div>

    <!-- comp rrate -->
    <div class="dashboard-card">
        <span class="material-symbols-outlined text-purple-400 text-6xl mb-2">trending_up</span>
        <h2 class="text-3xl font-bold">{{ $progress }}%</h2>
        <p class="text-lg text-gray-400">Overall progress</p>
        <div class="w-3/4 mx-auto bg-gray-700 rounded-full h-2 mt-4">
            <div class="bg-purple-500 h-2 rounded-full" style="width: {{ $progress }}%;"></div>
        </div>
    </div>

    <!-- toatl points -->
    <div class="dashboard-card">
        <span class="material-symbols-outlined text-yellow-400 text-6xl mb-2">emoji_events</span>
        <h2 class="text-3xl font-bold">{{ $totalPoints }}</h2>
        <p class="text-lg text-gray-400">Motivation points earned</p>
    </div>
</div>



@if ($badge)
<div class="mt-12">
    <h2 class="text-2xl font-semibold text-purple-400 mb-4">Rewards</h2>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mt-6">

        <div class="rounded-lg p-6 text-center min-h-[180px] transition duration-300 
            {{ $badge->badge_5_tasks ? 'bg-green-700 text-white shadow-lg' : 'bg-[#292f4c] text-gray-400' }}">
            <span class="material-symbols-outlined text-6xl mb-2">emoji_events</span>
            <p class="text-lg font-semibold mt-2">Task Master Badge</p>
            <p class="text-sm">Complete 5 tasks</p>
        </div>

        <div class="rounded-lg p-6 text-center min-h-[180px] transition duration-300 
            {{ $badge->badge_10_priority ? 'bg-green-700 text-white shadow-lg' : 'bg-[#292f4c] text-gray-400' }}">
            <span class="material-symbols-outlined text-6xl mb-2">star</span>
            <p class="text-lg font-semibold mt-2">Productivity Star</p>
            <p class="text-sm">Complete 10 high-priority tasks</p>
        </div>

        <div class="rounded-lg p-6 text-center min-h-[180px] transition duration-300 
            {{ $badge->badge_deadline ? 'bg-green-700 text-white shadow-lg' : 'bg-[#292f4c] text-gray-400' }}">
            <span class="material-symbols-outlined text-6xl mb-2">target</span>
            <p class="text-lg font-semibold mt-2">Goal Crusher</p>
            <p class="text-sm">Complete all tasks before deadline</p>
        </div>

        <div class="rounded-lg p-6 text-center min-h-[180px] transition duration-300 
            {{ $badge->badge_20_total ? 'bg-green-700 text-white shadow-lg' : 'bg-[#292f4c] text-gray-400' }}">
            <span class="material-symbols-outlined text-6xl mb-2">workspace_premium</span>
            <p class="text-lg font-semibold mt-2">Ultimate Achiever</p>
            <p class="text-sm">Complete 20 tasks</p>
        </div>

    </div>
</div>
@endif


        <div class="mt-12">
    <h2 class="text-2xl font-semibold text-purple-400">Your Tasks</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-4">
        @forelse ($tasks as $task)
        <div class="task-card">
            <div class="flex items-center space-x-2">
                <div class="circle {{ $task->completed ? 'checked' : '' }}"
                    onclick="document.getElementById('task-complete-{{ $task->id }}').submit();">
                    @if ($task->completed)
                    <span class="material-symbols-outlined">check</span>
                    @endif
                </div>
                <h3 class="task-title {{ $task->completed ? 'completed' : '' }}">
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
            <div class="subtask-container">
                <h4 class="text-sm font-medium text-gray-700">Subtasks</h4>
                <div class="grid gap-2">
                    @foreach ($task->subtasks as $subtask)
                    <div class="subtask-item">
                        <div class="flex items-center space-x-2">
                            <div class="circle {{ $subtask->completed ? 'checked' : '' }}"
                                onclick="document.getElementById('subtask-complete-{{ $subtask->id }}').submit();">
                                @if ($subtask->completed)
                                <span class="material-symbols-outlined">check</span>
                                @endif
                            </div>
                            <span class="subtask-title {{ $subtask->completed ? 'completed' : '' }}">
                                {{ $subtask->title }}
                            </span>
                        </div>
                        <form action="{{ route('subtasks.destroy', $subtask->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-gray-500 hover:text-gray-700 text-lg font-bold">
                                &#x2716;
                            </button>
                        </form>
                        <form id="subtask-complete-{{ $subtask->id }}"
                            action="{{ route('subtasks.update', $subtask->id) }}" method="POST"
                            style="display: none;">
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


<div class="mt-8 text-left">
    <a href="{{ route('tasks.create') }}"
        class="inline-block px-6 py-2 bg-purple-500 text-white rounded hover:bg-purple-600">
        + Add Task
    </a>
</div>

<!-- Wellness Tools sekcija -->
<div class="mt-12">
    <h2 class="text-2xl font-semibold text-purple-400">Wellness Tools</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
        <!-- Box Breathing -->
        <div class="bg-[#292f4c] shadow rounded-lg p-6 text-center text-white">
            <span class="material-symbols-outlined text-blue-400 text-5xl">air</span>
            <h3 class="text-lg font-bold text-purple-200 mt-2">Box Breathing</h3>
            <p class="text-sm text-gray-300" id="box-timer">2 minutes</p>
            <p class="text-sm text-gray-400 mt-2">Breathe in for 4 counts, hold for 4, exhale for 4, hold for 4. Repeat.</p>
            <button id="box-breathing-btn" onclick="toggleTimer('box-timer', 'box-breathing-btn', 120)"
                class="mt-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition-all">
                Start Exercise
            </button>
        </div>

        <!-- Body Scan -->
        <div class="bg-[#292f4c] shadow rounded-lg p-6 text-center text-white">
            <span class="material-symbols-outlined text-green-400 text-5xl">favorite</span>
            <h3 class="text-lg font-bold text-purple-200 mt-2">Body Scan</h3>
            <p class="text-sm text-gray-300" id="body-timer">5 minutes</p>
            <p class="text-sm text-gray-400 mt-2">Close your eyes and focus on each part of your body, releasing tension.</p>
            <button id="body-scan-btn" onclick="toggleTimer('body-timer', 'body-scan-btn', 300)"
                class="mt-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition-all">
                Start Exercise
            </button>
        </div>

        <!-- Mindful Moment -->
        <div class="bg-[#292f4c] shadow rounded-lg p-6 text-center text-white">
    <span class="material-symbols-outlined text-yellow-400 text-5xl">spa</span>
    <h3 class="text-lg font-bold text-purple-200 mt-2">Mindful Moment</h3>
    <p class="text-sm text-gray-300" id="mindful-timer">1 minute</p>
    <p class="text-sm text-gray-400 mt-2">Take a moment to observe your surroundings using all your senses.</p>
    <button id="mindful-moment-btn" onclick="toggleTimer('mindful-timer', 'mindful-moment-btn', 60)"
        class="mt-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition-all">
        Start Exercise
    </button>
</div>
    </div>
</div>

<script>
    const timers = {};

    function toggleTimer(timerId, buttonId, duration) {
        const timerDisplay = document.getElementById(timerId);
        const button = document.getElementById(buttonId);

        if (timers[timerId]) {
            clearInterval(timers[timerId]);
            delete timers[timerId];
            timerDisplay.textContent = buttonId === "box-breathing-btn"
                ? "2 minutes"
                : buttonId === "body-scan-btn"
                ? "5 minutes"
                : "1 minute";
            button.textContent = "Start Exercise";
            button.classList.remove("bg-red-500");
            button.classList.add("bg-blue-500");
        } else {
            button.textContent = "Cancel Exercise";
            button.classList.remove("bg-blue-500");
            button.classList.add("bg-red-500");

            let timer = duration;

            timers[timerId] = setInterval(() => {
                const minutes = Math.floor(timer / 60);
                const seconds = timer % 60;
                timerDisplay.textContent = `${minutes}:${seconds < 10 ? "0" : ""}${seconds}`;

                if (--timer < 0) {
                    clearInterval(timers[timerId]);
                    delete timers[timerId];
                    timerDisplay.textContent = "Done!";
                    button.textContent = "Start Exercise";
                    button.classList.remove("bg-red-500");
                    button.classList.add("bg-blue-500");
                }
            }, 1000);
        }
    }

    // fona krāsa no user preference
    fetch('/user-preference/get')
        .then(response => response.json())
        .then(data => {
            if (data.background_color) {
                document.body.style.backgroundColor = data.background_color;
            }
        })
        .catch(error => {
            console.error('Error fetching background color:', error);
        });
</script>
