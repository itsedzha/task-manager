<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Task</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans">

    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold text-center text-gray-800 mb-6">Create New Task</h1>

        <form action="{{ route('tasks.store') }}" method="POST" class="space-y-4 bg-white p-6 rounded shadow">
            @csrf

            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" name="title" id="title" required 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" id="description" rows="3"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
            </div>

            <div>
                <label for="priority" class="block text-sm font-medium text-gray-700">Priority</label>
                <select name="priority" id="priority"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="low">Low</option>
                    <option value="medium">Medium</option>
                    <option value="high">High</option>
                </select>
            </div>

            <div>
                <label for="deadline" class="block text-sm font-medium text-gray-700">Deadline</label>
                <input type="date" name="deadline" id="deadline"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div id="subtasks">
                <label class="block text-sm font-medium text-gray-700">Subtasks</label>
                <div class="flex items-center space-x-2 mt-2">
                    <input type="text" name="subtasks[]" placeholder="Add a subtask"
                        class="flex-grow rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <button type="button" class="add-subtask bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">+</button>
                </div>
            </div>
            <template id="subtask-template">
                <div class="flex items-center space-x-2 mt-2">
                    <input type="text" name="subtasks[]" placeholder="Add a subtask"
                        class="flex-grow rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <button type="button" class="remove-subtask bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">x</button>
                </div>
            </template>

            <div class="text-right">
                <button type="submit" class="bg-green-500 text-white px-6 py-2 rounded hover:bg-green-600">Create Task</button>
            </div>
        </form>
    </div>

    <script>
        document.querySelector('.add-subtask').addEventListener('click', function () {
            const template = document.querySelector('#subtask-template').content.cloneNode(true);
            template.querySelector('.remove-subtask').addEventListener('click', function () {
                this.parentNode.remove();
            });
            document.querySelector('#subtasks').appendChild(template);
        });
    </script>
</body>
</html>
