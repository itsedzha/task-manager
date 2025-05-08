<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Task</title>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
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
            max-width: 720px;
            margin: 5rem auto;
            width: 90%; 
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
            padding: 1.1rem 1.25rem !important;
            border-radius: 0.75rem;
            background: #1f2436;
            color: #E5E7EB !important;
            border: 2px solid transparent;
            margin-bottom: 1.75rem; 
            font-size: 1.05rem;
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
        
        <div class="flex items-center mb-8">
            <a href="/tasks" class="text-white hover:text-purple-400 transition mr-4" title="Back to tasks">
                <span class="material-symbols-outlined text-3xl">home</span>
            </a>
            <h1 class="text-2xl font-bold text-white">Create New Task</h1>
        </div>

        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf

            <div class="space-y-4">
                <div>
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" required placeholder="Enter task title">
                </div>

                <div>
                    <label for="description">Description</label>
                    <textarea name="description" id="description" rows="4" placeholder="Write a brief description"></textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="priority">Priority</label>
                        <select name="priority" id="priority">
                            <option value="low">Low</option>
                            <option value="medium">Medium</option>
                            <option value="high">High</option>
                        </select>
                    </div>

                    <div>
                        <label for="deadline">Deadline</label>
                        <input type="date" name="deadline" id="deadline">
                    </div>
                </div>
                
                <div>
                    <label for="progress">Progress (0-100%)</label>
                    <div class="flex items-center space-x-4">
                        <input type="range" name="progress" id="progress" min="0" max="100" value="0" 
                            class="w-full h-2 bg-gray-700 rounded-lg appearance-none cursor-pointer">
                        <span id="progress-value" class="text-white font-medium">0%</span>
                    </div>
                </div>

                <div>
                    <label>Subtasks</label>
                    <div id="subtasks" class="space-y-2">
                        <div class="flex items-center gap-2">
                            <input type="text" name="subtasks[]" placeholder="Add a subtask">
                            <button type="button" class="add-subtask">+</button>
                        </div>
                    </div>

                    <template id="subtask-template">
                        <div class="flex items-center gap-2 mt-2">
                            <input type="text" name="subtasks[]" placeholder="Add a subtask">
                            <button type="button" class="remove-subtask">x</button>
                        </div>
                    </template>
                </div>
            </div>

            <div class="text-center mt-8">
                <button type="submit" class="submit-btn">Create Task</button>
            </div>
        </form>
    </div>

    <script>
        document.querySelector('.add-subtask').addEventListener('click', function () {
            const template = document.querySelector('#subtask-template').content.cloneNode(true);
            template.querySelector('.remove-subtask').addEventListener('click', function () {
                this.parentElement.remove();
            });
            document.querySelector('#subtasks').appendChild(template);
        });

        const progressSlider = document.getElementById('progress');
        const progressValue = document.getElementById('progress-value');

        progressSlider.addEventListener('input', function() {
            progressValue.textContent = this.value + '%';
        });
    </script>
</body>


</html>
