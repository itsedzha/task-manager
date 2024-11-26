<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans">

    <!-- headeris -->
    <div class="container mx-auto py-6">
        <h1 class="text-3xl font-bold text-center text-gray-800">Task Manager</h1>

        <!-- pazinojuma succ message -->
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded mt-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- dashboard -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mt-8">
            <!-- total tasks-->
            <div class="bg-white shadow rounded-lg p-6 text-center">
                <img src="{{ asset('dashboard-icons/list-check.png') }}" alt="Total Tasks" class="w-12 h-12 mx-auto mb-4">
                <h2 class="text-3xl font-bold text-blue-500">{{ $totalTasks }}</h2>
                <p class="text-sm text-gray-600">Total Tasks<br><span class="text-gray-500">All tasks created</span></p>
            </div>

            <!-- completed tasks -->
            <div class="bg-white shadow rounded-lg p-6 text-center">
                <img src="{{ asset('dashboard-icons/check-circle.png') }}" alt="Completed Tasks" class="w-12 h-12 mx-auto mb-4">
                <h2 class="text-3xl font-bold text-green-500">{{ $completedTasks }}</h2>
                <p class="text-sm text-gray-600">Completed Tasks<br><span class="text-gray-500">Tasks finished</span></p>
            </div>

            <!-- completion rate -->
            <div class="bg-white shadow rounded-lg p-6 text-center">
                <img src="{{ asset('dashboard-icons/arrow-trend-up.png') }}" alt="Completion Rate" class="w-12 h-12 mx-auto mb-4">
                <h2 class="text-3xl font-bold text-purple-500">{{ $progress }}%</h2>
                <p class="text-sm text-gray-600">Completion Rate<br><span class="text-gray-500">Overall progress</span></p>
            </div>

            <!-- punkti  -->
            <div class="bg-white shadow rounded-lg p-6 text-center">
                <img src="{{ asset('dashboard-icons/trophy.png') }}" alt="Total Points" class="w-12 h-12 mx-auto mb-4">
                <h2 class="text-3xl font-bold text-yellow-500">{{ $totalPoints }}</h2>
                <p class="text-sm text-gray-600">Total Points<br><span class="text-gray-500">Motivation points earned</span></p>
            </div>
        </div>

        <!-- progress -->
        <div class="mt-8">
            <h2 class="text-xl font-semibold text-gray-700">Task Progress</h2>
            <div class="w-full bg-gray-200 rounded-full h-4 mt-2">
                <div class="bg-blue-500 h-4 rounded-full" style="width: {{ $progress }}%"></div>
            </div>
            <p class="text-sm text-gray-600 mt-2">{{ $progress }}% of tasks completed</p>
        </div>

        <!-- rewards-->
        <div class="mt-12">
            <h2 class="text-2xl font-semibold text-gray-800">Rewards</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mt-6">
                <!-- badges -->
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

        <!-- tasks -->
        <div class="mt-12">
            <a href="{{ route('tasks.create') }}" class="inline-block mb-4 px-6 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                Create New Task
            </a>
            <div class="bg-white shadow rounded overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead>
                    <tr class="bg-gray-200 text-gray-700">
                        <th class="px-4 py-2">ID</th>
                        <th class="px-4 py-2">Title</th>
                        <th class="px-4 py-2">Description</th>
                        <th class="px-4 py-2">Priority</th>
                        <th class="px-4 py-2">Completed</th>
                        <th class="px-4 py-2">Deadline</th>
                        <th class="px-4 py-2">Progress</th>
                        <th class="px-4 py-2">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($tasks as $task)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $task->id }}</td>
                            <td class="px-4 py-2">{{ $task->title }}</td>
                            <td class="px-4 py-2">{{ $task->description }}</td>
                            <td class="px-4 py-2">{{ ucfirst($task->priority) }}</td>
                            <td class="px-4 py-2">{{ $task->completed ? 'Yes' : 'No' }}</td>
                            <td class="px-4 py-2 {{ $task->is_deadline_soon ? 'text-red-500 font-semibold' : '' }}">
                                {{ $task->deadline }}
                            </td>
                            <td class="px-4 py-2">
                                <div class="w-full bg-gray-200 rounded-full h-4 mb-2">
                                    <div class="bg-blue-500 h-4 rounded-full" style="width: {{ $task->progress }}%;"></div>
                                </div>
                                <p class="text-sm text-gray-600">{{ $task->progress }}% completed</p>
                                <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="range" name="progress" value="{{ $task->progress }}" 
                                           class="w-full mt-2" min="0" max="100"
                                           onchange="this.form.submit()">
                                </form>
                            </td>
                            <td class="px-4 py-2">
                                <a href="{{ route('tasks.edit', $task->id) }}" class="text-blue-500 hover:underline">Edit</a>
                                |
                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure?')" class="text-red-500 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-4 py-6 text-center text-gray-500">No tasks found.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $tasks->links() }}
        </div>
    </div>

</body>
</html>
