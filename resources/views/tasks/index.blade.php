<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <style>
        .material-symbols-outlined {
            font-variation-settings:
                'FILL' 0,
                'wght' 400,
                'GRAD' 0,
                'opsz' 24;
        }
        .trophy-icon {
            color: #FFD700; /* Gold for the trophy */
        }
        .bin-icon {
            color: #FF0000; /* Red for the delete icon */
            cursor: pointer;
        }
        .bin-icon:hover {
            color: #CC0000; /* Darker red on hover */
        }
        .card-heading {
            color: rgb(107 114 128 / var(--tw-text-opacity));
        }
    </style>
</head>
<body class="bg-gray-50 font-sans">

    <!-- Header -->
    <div class="container mx-auto py-6">
        <h1 class="text-3xl font-bold text-center text-gray-800">Task Manager</h1>

        <!-- Success Message -->
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded mt-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Dashboard -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mt-8">
            <!-- Total Tasks -->
            <div class="bg-white shadow rounded-lg p-6 text-center">
                <img src="{{ asset('dashboard-icons/list-check.png') }}" alt="Total Tasks" class="w-12 h-12 mx-auto mb-4">
                <h2 class="text-3xl font-bold text-blue-500">{{ $totalTasks }}</h2>
                <p class="text-sm card-heading">Total Tasks<br><span class="text-gray-500">All tasks created</span></p>
            </div>

            <!-- Completed Tasks -->
            <div class="bg-white shadow rounded-lg p-6 text-center">
                <img src="{{ asset('dashboard-icons/check-circle.png') }}" alt="Completed Tasks" class="w-12 h-12 mx-auto mb-4">
                <h2 class="text-3xl font-bold text-green-500">{{ $completedTasks }}</h2>
                <p class="text-sm card-heading">Completed Tasks<br><span class="text-gray-500">Tasks finished</span></p>
            </div>

            <!-- Completion Rate -->
            <div class="bg-white shadow rounded-lg p-6 text-center">
                <img src="{{ asset('dashboard-icons/arrow-trend-up.png') }}" alt="Completion Rate" class="w-12 h-12 mx-auto mb-4">
                <h2 class="text-3xl font-bold text-purple-500">{{ $progress }}%</h2>
                <p class="text-sm card-heading">Completion Rate<br><span class="text-gray-500">Overall progress</span></p>
                <!-- Small Progress Bar -->
                <div class="w-3/4 mx-auto bg-gray-200 rounded-full h-2 mt-2">
                    <div class="bg-purple-500 h-2 rounded-full" style="width: {{ $progress }}%;"></div>
                </div>
            </div>

            <!-- Points -->
            <div class="bg-white shadow rounded-lg p-6 text-center">
                <img src="{{ asset('dashboard-icons/trophy.png') }}" alt="Total Points" class="w-12 h-12 mx-auto mb-4">
                <h2 class="text-3xl font-bold text-yellow-500">{{ $totalPoints }}</h2>
                <p class="text-sm card-heading">Total Points<br><span class="text-gray-500">Motivation points earned</span></p>
            </div>
        </div>

        <!-- Rewards -->
        <div class="mt-12">
            <h2 class="text-2xl font-semibold text-gray-800">Rewards</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mt-6">
                <!-- Badges -->
                <div class="bg-indigo-50 border border-indigo-300 rounded-lg shadow p-4 text-center">
                    <img src="{{ asset('badges/task-master.png') }}" alt="Task Master" class="mx-auto w-16 mb-4">
                    <p class="text-lg font-semibold text-gray-700">Task Master</p>
                </div>
                <div class="bg-indigo-50 border border-indigo-300 rounded-lg shadow p-4 text-center">
                    <img src="{{ asset('badges/star.png') }}" alt="Productivity Star" class="mx-auto w-16 mb-4">
                    <p class="text-lg font-semibold text-gray-700">Productivity Star</p>
                </div>
                <div class="bg-indigo-50 border border-indigo-300 rounded-lg shadow p-4 text-center">
                    <img src="{{ asset('badges/goal-crusher.png') }}" alt="Goal Crusher" class="mx-auto w-16 mb-4">
                    <p class="text-lg font-semibold text-gray-700">Goal Crusher</p>
                </div>
                <div class="bg-indigo-50 border border-indigo-300 rounded-lg shadow p-4 text-center">
                    <img src="{{ asset('badges/ultimate-achiever.png') }}" alt="Ultimate Achiever" class="mx-auto w-16 mb-4">
                    <p class="text-lg font-semibold text-gray-700">Ultimate Achiever</p>
                </div>
            </div>
        </div>

        <!-- Tasks -->
        <div class="mt-12">
    <h2 class="text-2xl font-semibold text-gray-800">Your Tasks</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-4">
        @forelse ($tasks as $task)
            <div class="bg-white shadow rounded-lg p-4">
                <h3 class="text-lg font-semibold text-gray-800">{{ $task->title }}</h3>
                <p class="text-gray-600 text-sm">{{ $task->description }}</p>
                <!-- Priority Badge -->
                <span class="
                    text-sm font-medium px-2 py-1 rounded-full 
                    @if($task->priority === 'high') 
                        bg-red-100 text-red-500 
                    @elseif($task->priority === 'medium') 
                        bg-yellow-100 text-yellow-500 
                    @else 
                        bg-green-100 text-green-500 
                    @endif">
                    {{ ucfirst($task->priority) }}
                </span>
                <!-- Task Deadline -->
                <div class="flex items-center text-sm text-gray-600 mt-2">
                    <span class="material-symbols-outlined text-gray-500 mr-1">calendar_month</span>
                    {{ $task->deadline->format('M d, Y') }}
                </div>
                <!-- Task Progress -->
                <div class="mt-4">
                    <span class="block text-sm font-medium text-gray-700 mb-1">Progress</span>
                    <div class="w-full bg-gray-200 rounded-full h-3">
                        <div class="bg-purple-500 h-3 rounded-full" style="width: {{ $task->progress }}%;"></div>
                    </div>
                    <p class="text-sm text-gray-600 mt-2">{{ $task->progress }}%</p>
                </div>
                <!-- Points and Actions -->
                <div class="flex items-center justify-between mt-4">
                    <span class="flex items-center">
                        <span class="material-symbols-outlined trophy-icon mr-1">emoji_events</span>
                        {{ $task->points }}
                    </span>
                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">
                            <span class="material-symbols-outlined bin-icon">delete</span>
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <p class="text-center text-gray-500">No tasks found. Create your first task!</p>
        @endforelse
    </div>
</div>


        <!-- Add Task Button -->
        <div class="mt-8 text-right">
            <a href="{{ route('tasks.create') }}" class="inline-block px-6 py-2 bg-purple-500 text-white rounded hover:bg-purple-600">
                + Add Task
            </a>
        </div>
    </div>
</body>
</html>
