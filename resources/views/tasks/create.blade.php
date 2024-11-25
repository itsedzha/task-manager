<!DOCTYPE html>
<html>
<head>
    <title>Create Task</title>
</head>
<body>
    <h1>Create New Task</h1>
    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf
        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title" required><br><br>

        <label for="description">Description:</label><br>
        <textarea id="description" name="description"></textarea><br><br>

        <label for="priority">Priority:</label><br>
        <select id="priority" name="priority">
            <option value="low">Low</option>
            <option value="medium">Medium</option>
            <option value="high">High</option>
        </select><br><br>

        <label for="deadline">Deadline:</label><br>
        <input type="date" id="deadline" name="deadline"><br><br>

        <button type="submit">Create Task</button>
    </form>
    <a href="{{ route('tasks.index') }}">Back to Task List</a>
</body>
</html>
 
<!-- generated mockup template with chatgpt -->