<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Task</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>

        body {
            background-color: #181b34;
            font-family: 'Inter', sans-serif;
            position: relative;
            overflow: hidden;
            color: #E5E7EB; 
        }

        .form-container {
            background-color: #292f4c;
            border-radius: 1rem;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.6);
            padding: 2rem;
            max-width: 600px;
            margin: 5rem auto;
        }

        label {
            font-size: 0.9rem;
            color: #A5B4FC;
            margin-bottom: 0.5rem;
            display: block;
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 1rem; 
            border-radius: 0.75rem;
            background: #1f2436; 
            color: #E5E7EB !important; 
            border: 2px solid transparent;
            margin-bottom: 1.5rem;
            font-size: 1rem;
            font-weight: 500;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        input::placeholder,
        textarea::placeholder {
            color: #64748b;
        }

        input:focus,
        textarea:focus,
        select:focus {
            outline: none;
            border-color: #A5B4FC; 
            box-shadow: 0 0 6px rgba(165, 180, 252, 0.8);
        }

        .submit-btn {
            background-color: #FF4D67;
            color: #FFFFFF;
            padding: 1rem 2rem; 
            border-radius: 0.75rem;
            font-size: 1rem;
            font-weight: bold;
            transition: background-color 0.3s, transform 0.2s;
        }

        .submit-btn:hover {
            background-color: #e33e58;
            transform: translateY(-2px);
        }

        .add-subtask,
        .remove-subtask {
            background-color: #4D9CFF;
            color: #FFFFFF;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            font-weight: bold;
        }

        .add-subtask:hover,
        .remove-subtask:hover {
            background-color: #3C81CC;
        }
    </style>
</head>

<body>
    <div class="form-container">
        <h1 class="text-3xl text-center font-bold text-white mb-6">Create New Task</h1>

        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf

            <label for="title">Title</label>
            <input type="text" name="title" id="title" required placeholder="Enter task title">

            <label for="description">Description</label>
            <textarea name="description" id="description" rows="3" placeholder="Write a brief description"></textarea>

            <label for="priority">Priority</label>
            <select name="priority" id="priority">
                <option value="low">Low</option>
                <option value="medium">Medium</option>
                <option value="high">High</option>
            </select>

            <label for="deadline">Deadline</label>
            <input type="date" name="deadline" id="deadline">

            <div id="subtasks">
                <label>Subtasks</label>
                <div class="flex items-center space-x-2 mt-2">
                    <input type="text" name="subtasks[]" placeholder="Add a subtask">
                    <button type="button" class="add-subtask">+</button>
                </div>
            </div>

            <template id="subtask-template">
                <div class="flex items-center space-x-2 mt-2">
                    <input type="text" name="subtasks[]" placeholder="Add a subtask">
                    <button type="button" class="remove-subtask">x</button>
                </div>
            </template>

            <div class="text-center mt-6">
                <button type="submit" class="submit-btn">Create Task</button>
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
