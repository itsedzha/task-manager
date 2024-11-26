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

        <!-- success -->
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded mt-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- dashboard -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
            <div class="bg-white shadow rounded p-6 text-center">
                <h2 class="text-4xl font-bold text-blue-500">{{ $totalTasks }}</h2>
                <p class="text-gray-600">Total Tasks</p>
            </div>
            <div class="bg-white shadow rounded p-6 text-center">
                <h2 class="text-4xl font-bold text-blue-500">{{ $completedTasks }}</h2>
                <p class="text-gray-600">Completed Tasks</p>
            </div>
            <div class="bg-white shadow rounded p-6 text-center">
                <h2 class="text-4xl font-bold text-blue-500">{{ $upcomingDeadlines }}</h2>
                <p class="text-gray-600">Upcoming Deadlines</p>
            </div>
        </div>

        <!-- progress bar-->
        <div class="mt-8">
            <h2 class="text-xl font-semibold text-gray-700">Task Progress</h2>
            <div class="w-full bg-gray-200 rounded-full h-4 mt-2">
                <div class="bg-blue-500 h-4 rounded-full" style="width: {{ $progress }}%"></div>
            </div>
            <p class="text-sm text-gray-600 mt-2">{{ $progress }}% of tasks completed</p>
        </div>

        <!-- reward sekcija -->
        <div class="mt-12">
            <h2 class="text-2xl font-semibold text-gray-800">Rewards</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mt-6">
                <!-- reward badges -->
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

        <!-- search  -->
        <div class="mt-12">
            <form method="GET" action="{{ route('tasks.index') }}" class="flex items-center gap-4">
                <input type="text" name="search" placeholder="Search tasks..." value="{{ request('search') }}"
                       class="w-1/3 px-4 py-2 border rounded focus:outline-none focus:ring focus:ring-blue-200">
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Search</button>
            </form>
        </div>

        <!-- Tasks -->
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
                            <td colspan="7" class="px-4 py-6 text-center text-gray-500">No tasks found.</td>
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
