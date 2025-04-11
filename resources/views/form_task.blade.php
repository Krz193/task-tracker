<x-app-layout>
    {{-- {{ dd($project) }} --}}
    <div class="container flex flex-col items-center">
        <div class="justify-center w-full">
            <h1 class="text-left block mb-4 text-xl font-semibold">
                {{ ucfirst(isset($task) ? "edit task $task->task_name in $project->project_name" : "add task to $project->project_name") }}
            </h1>
        </div>

        <form
            action="{{ isset($task) ? route('tasks.update', $task) : route('tasks.store') }}"
            method="POST"
            class="flex flex-col w-[70%]"
            enctype="multipart/form-data">
            @csrf @if(isset($task)) @method('PUT') @endif

            <!-- Name -->
            <div class="mb-4">
                <label for="task_name" class="block text-sm font-medium text-gray-700">{{ ucfirst('task name') }}</label>
                <input
                    type="text"
                    id="task_name"
                    name="task_name"
                    value="{{ isset($task) ? $task->task_name : old('task_name') }}"
                    required="required"
                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <!-- Description -->
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">{{ ucfirst('description') }}</label>
                <input
                    type="text"
                    id="description"
                    name="description"
                    value="{{ isset($task) ? $task->description : old('description') }}"
                    required="required"
                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <!-- Submit Button -->
            <button
                type="submit"
                class="w-full text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5">
                {{ isset($task) ? 'Update' : 'Add' }}
            </button>
        </form>
    </div>
</x-app-layout>