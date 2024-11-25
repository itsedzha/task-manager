<!DOCTYPE html>
<html>
<head>
    <title>Task Manager</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f9f9f9;
        }
        h1 {
            color: #333;
        }
        a {
            text-decoration: none;
            color: #007BFF;
        }
        a:hover {
            text-decoration: underline;
        }
        .dashboard {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }
        .card {
            flex: 1;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .card h2 {
            font-size: 2rem;
            margin: 0;
            color: #007BFF;
        }
        .card p {
            margin: 10px 0 0;
            color: #555;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 12px 15px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        button {
            padding: 5px 10px;
            color: white;
            background-color: #dc3545;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        button:hover {
            background-color: #c82333;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #c3e6cb;
            border-radius: 5px;
        }
        .search-bar {
            margin-bottom: 20px;
        }
        input[type="text"] {
            padding: 8px;
            width: 250px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        input[type="submit"] {
            padding: 8px 12px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Task Manager</h1>

    <!-- Display Success Messages -->
    @if (session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    <div class="dashboard">
    <div class="card">
        <h2>{{ $totalTasks }}</h2>
        <p>Total Tasks</p>
    </div>
    <div class="card">
        <h2>{{ $completedTasks }}</h2>
        <p>Completed Tasks</p>
    </div>
    <div class="card">
        <h2>{{ $upcomingDeadlines }}</h2>
        <p>Upcoming Deadlines</p>
    </div>
</div>

<!-- Progress Bar -->
<div style="margin-top: 20px;">
    <h2>Task Progress</h2>
    <div style="background-color: #ddd; border-radius: 10px; overflow: hidden; width: 100%; height: 20px;">
        <div style="width: {{ $progress }}%; background-color: #007BFF; height: 100%;"></div>
    </div>
    <p>{{ $progress }}% of tasks completed</p>
</div>


    <!-- Search Bar -->
    <div class="search-bar">
        <form method="GET" action="{{ route('tasks.index') }}">
            <input type="text" name="search" placeholder="Search tasks..." value="{{ request('search') }}">
            <input type="submit" value="Search">
        </form>
    </div>

    <a href="{{ route('tasks.create') }}">Create New Task</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Priority</th>
                <th>Completed</th>
                <th>Deadline</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tasks as $task)
                <tr>
                    <td>{{ $task->id }}</td>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->description }}</td>
                    <td>{{ ucfirst($task->priority) }}</td>
                    <td>{{ $task->completed ? 'Yes' : 'No' }}</td>
                    <td>{{ $task->deadline }}</td>
                    <td>
                        <a href="{{ route('tasks.edit', $task->id) }}">Edit</a> |
                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this task?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center;">No tasks found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination Links -->
    <div>
        {{ $tasks->links() }}
    </div>
</body>
</html>
