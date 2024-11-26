<form action="{{ route('tasks.update', $task->id) }}" method="POST">
    @csrf
    @method('PATCH')
    <div>
        <label for="title">Title</label>
        <input type="text" id="title" name="title" value="{{ $task->title }}" class="border rounded w-full" required>
    </div>
    <div>
        <label for="description">Description</label>
        <textarea id="description" name="description" class="border rounded w-full">{{ $task->description }}</textarea>
    </div>
    <div>
        <label for="priority">Priority</label>
        <select id="priority" name="priority" class="border rounded w-full" required>
            <option value="low" {{ $task->priority == 'low' ? 'selected' : '' }}>Low</option>
            <option value="medium" {{ $task->priority == 'medium' ? 'selected' : '' }}>Medium</option>
            <option value="high" {{ $task->priority == 'high' ? 'selected' : '' }}>High</option>
        </select>
    </div>
    <div>
        <label for="deadline">Deadline</label>
        <input type="date" id="deadline" name="deadline" value="{{ $task->deadline }}" class="border rounded w-full">
    </div>
    <div>
        <label>Subtasks</label>
        <div id="subtasks-container">
            @foreach ($task->subtasks as $subtask)
                <div class="subtask-item flex items-center gap-2 mb-2">
                    <input type="text" name="subtasks[]" value="{{ $subtask->title }}" class="border rounded w-full">
                    <button type="button" class="remove-subtask text-red-500">X</button>
                </div>
            @endforeach
        </div>
        <button type="button" id="add-subtask" class="bg-blue-500 text-white px-3 py-1 rounded mt-2">+ Add Subtask</button>
    </div>
    <button type="submit" class="bg-green-500 text-white px-4 py-2 mt-4">Update Task</button>
</form>

<script>
    document.getElementById('add-subtask').addEventListener('click', function() {
        const container = document.getElementById('subtasks-container');
        const newSubtask = document.createElement('div');
        newSubtask.classList.add('subtask-item', 'flex', 'items-center', 'gap-2', 'mb-2');
        newSubtask.innerHTML = `
            <input type="text" name="subtasks[]" class="border rounded w-full" placeholder="Add a subtask">
            <button type="button" class="remove-subtask text-red-500">X</button>
        `;
        container.appendChild(newSubtask);
    });

    document.addEventListener('click', function(e) {
        if (e.target && e.target.classList.contains('remove-subtask')) {
            e.target.parentElement.remove();
        }
    });
</script>
