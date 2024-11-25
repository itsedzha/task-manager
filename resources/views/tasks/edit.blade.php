<!DOCTYPE html>
<html>
<head>
    <title>Edit Task</title>
</head>
<body>
    <h1>Edit Task</h1>
    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title" value="{{ $task->title }}" required><br><br>

        <label for="description">Description:</label><br>
        <textarea id="description" name="description">{{ $task->description }}</textarea><br><br>

        <label for="priority">Priority:</label><br>
        <select id="priority" name="priority">
            <option value="low" {{ $task->priority === 'low' ? 'selected' : '' }}>Low</option>
            <option value="medium" {{ $task->priority === 'medium' ? 'selected' : '' }}>Medium</option>
            <option value="high" {{ $task->priority === 'high' ? 'selected' : '' }}>High</option>
        </select><br><br>

        <label for="deadline">Deadline:</label><br>
        <input type="date" id="deadline" name="deadline" value="{{ $task->deadline }}"><br><br>

        <button type="submit">Update Task</button>
    </form>
    <a href="{{ route('tasks.index') }}">Back to Task List</a>
</body>
</html>
