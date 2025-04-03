<x-app-layout>
    {{-- {{ dd($project) }}
    --}}

    <div class="container flex flex-col w-full">
        <div class="container flex flex-row justify-between items-center">
            <h1 class="text-left block mb-4 text-xl font-semibold">{{ $project->project_name }}</h1>
            <div class="flex">
                <button
                    onclick="location.href='{{ route('tasks.create', $project) }}'"
                    type="button"
                    class="capitalize text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">
                    + Add Task
                </button>
                <button
                    onclick="location.href='{{ route('project.edit', $project->id) }}'"
                    type="button"
                    class="capitalize text-black bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:focus:ring-yellow-900">
                    Edit Project
                </button>
                <form
                    action="{{ route('project.destroy', $project) }}"
                    method="POST"
                    onsubmit="return confirm('Are you sure you want to delete this project?');">
                    @csrf @method('DELETE')
                    <button
                        type="submit"
                        class="capitalize text-white bg-red-700 hover:bg-red-800 font-medium rounded-lg text-sm px-5 py-2.5">
                        Delete
                    </button>
                </form>
            </div>
        </div>
        <div class="container mb-4 mt-2">
            <p>{{ $project->description }}</p>
        </div>
        <div class="card-container container p-3 flex flex-wrap gap-4">
            @forelse ($project->tasks as $task)
            <div
                class="flex flex-col justify-between w-full sm:w-[48%] p-6 bg-white border border-gray-200 rounded-lg shadow-sm">

                <div class="container">
                    <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{ $task->task_name }}</h2>
                    <p class="mt-3 mb-5">{{ $task->description }}</p>
                </div>
                
                <!-- Dropdown untuk mengubah status -->
                <div class="card-footer">
                    <label
                        for="status-{{ $task->id }}"
                        class="block mb-2 text-sm font-medium text-gray-900">Status:</label>
                    <select
                        id="status-{{ $task->id }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        data-url="{{ route('tasks.updateStatus', $task->id) }}"
                        onchange="updateStatus(this)">
                        @foreach (\App\Enums\TaskStatus::cases() as $status)
                        <option value="{{ $status->value }}" {{ ($task->status->value ?? '') === $status->value ? 'selected' : '' }}>
                            {{ ucfirst(str_replace('_', ' ', $status->value)) }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            @empty
            <h1 class="my-3 text-2xl font-bold tracking-tight text-gray-900 text-center w-full">
                Belum ada task pada project ini.
            </h1>
            @endforelse
        </div>
    </div>

    <script>
        function updateStatus(selectElement) {
            const updateUrl = selectElement.dataset.url;
            const newStatus = selectElement.value;

            fetch(updateUrl, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({status: newStatus})
            })
                .then(response => {
                    if (!response.ok) {
                        return response
                            .text()
                            .then(text => {
                                throw new Error(text);
                            }); // Tangani HTML error Laravel
                    }
                    return response.json();
                })
                .then(data => alert(data.message))
                .catch(error => console.error('Error:', error));
        }
    </script>
</x-app-layout>