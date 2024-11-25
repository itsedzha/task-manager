<!DOCTYPE html>
<html>
<head>
    <title>Task Manager</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px 12px;
            border: 1px solid #ddd;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Tasks</h1>
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
            @foreach ($tasks as $task)
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
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
