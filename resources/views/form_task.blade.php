<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Add Task to {{ $project->project_name }}</h1>
        
        <form action="{{ route('tasks.store', $project->id) }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Task Name</label>
                <input type="text" name="task_name" required class="w-full p-2 border rounded">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" class="w-full p-2 border rounded"></textarea>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                Save Task
            </button>
        </form>
    </div>
</x-app-layout>
