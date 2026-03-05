<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasks</title>
    <!-- Add basic Tailwind CSS for quick styling -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Task List</h1>

        <!-- Success Message -->
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Add Task Form -->
        <form action="{{ route('tasks.store') }}" method="POST" class="mb-6 flex gap-2">
            @csrf
            <input type="text" name="title" placeholder="New Task..." required
                class="flex-1 border border-gray-300 rounded px-4 py-2 focus:outline-none focus:border-blue-500">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Add Task
            </button>
        </form>

        <!-- Error Messages -->
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                <ul class="list-disc ml-4">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Task List -->
        <ul class="space-y-3">
            @forelse ($tasks as $task)
                <li class="flex items-center justify-between p-3 border rounded {{ $task->is_completed ? 'bg-gray-50' : 'bg-white' }}">
                    <div class="flex items-center gap-3">
                        <!-- Toggle Completion Form -->
                        <form action="{{ route('tasks.update', $task) }}" method="POST" class="m-0">
                            @csrf
                            @method('PUT')
                            <input type="checkbox" name="is_completed" 
                                onChange="this.form.submit()"
                                class="w-5 h-5 cursor-pointer text-blue-600"
                                {{ $task->is_completed ? 'checked' : '' }}>
                        </form>
                        
                        <span class="{{ $task->is_completed ? 'line-through text-gray-500' : 'text-gray-800' }}">
                            {{ $task->title }}
                        </span>
                    </div>

                    <!-- Delete Form -->
                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="m-0"
                          onsubmit="return confirm('Are you sure you want to delete this task?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-semibold">
                            Delete
                        </button>
                    </form>
                </li>
            @empty
                <li class="text-center text-gray-500 py-4">No tasks yet!</li>
            @endforelse
        </ul>
    </div>
</body>
</html>
