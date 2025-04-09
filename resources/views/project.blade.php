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
                    class="capitalize border border-gray-900 flex items-center text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">
                    {{-- svg icon plus --}}
                    <svg
                        class="w-6 h-6 me-2"
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        fill="none"
                        viewBox="0 0 24 24">
                        <path
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M5 12h14m-7 7V5"/>
                    </svg>
                    <span>Add Task</span>
                </button>
                <button
                    onclick="location.href='{{ route('project.edit', $project->id) }}'"
                    type="button"
                    class="capitalize border border-yellow-600 flex items-center text-black bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:focus:ring-yellow-900">
                    {{-- svg icon edit --}}
                    <svg
                        class="w-6 h-6 me-2"
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        fill="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            fill-rule="evenodd"
                            d="M11.32 6.176H5c-1.105 0-2 .949-2 2.118v10.588C3 20.052 3.895 21 5 21h11c1.105 0 2-.948 2-2.118v-7.75l-3.914 4.144A2.46 2.46 0 0 1 12.81 16l-2.681.568c-1.75.37-3.292-1.263-2.942-3.115l.536-2.839c.097-.512.335-.983.684-1.352l2.914-3.086Z"
                            clip-rule="evenodd"/>
                        <path
                            fill-rule="evenodd"
                            d="M19.846 4.318a2.148 2.148 0 0 0-.437-.692 2.014 2.014 0 0 0-.654-.463 1.92 1.92 0 0 0-1.544 0 2.014 2.014 0 0 0-.654.463l-.546.578 2.852 3.02.546-.579a2.14 2.14 0 0 0 .437-.692 2.244 2.244 0 0 0 0-1.635ZM17.45 8.721 14.597 5.7 9.82 10.76a.54.54 0 0 0-.137.27l-.536 2.84c-.07.37.239.696.588.622l2.682-.567a.492.492 0 0 0 .255-.145l4.778-5.06Z"
                            clip-rule="evenodd"/>
                    </svg>
                    <span>Edit Project</span>
                </button>
                <form
                    action="{{ route('project.destroy', $project) }}"
                    method="POST"
                    onsubmit="return confirm('Are you sure you want to delete this project?');">
                    @csrf @method('DELETE')
                    <button
                        type="submit"
                        class="capitalize border border-red-900 flex items-center text-white bg-red-700 hover:bg-red-800 font-medium rounded-lg text-sm px-5 py-2.5">
                        {{-- svg icon trashbin --}}
                        <svg
                            class="w-6 h-6 me-2"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg"
                            width="24"
                            height="24"
                            fill="currentColor"
                            viewBox="0 0 24 24">
                            <path
                                fill-rule="evenodd"
                                d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z"
                                clip-rule="evenodd"/>
                        </svg>
                        <span>Delete</span>
                    </button>
                </form>
            </div>
        </div>
        <div class="container flex mb-4 mt-2">
            <!-- Cek apakah proyek memiliki gambar -->
            @if ($project->image)
            <div class="mt-4">
                <img
                    src="{{ asset('storage/' . $project->image) }}"
                    alt="Project Image"
                    class="w-full max-w-md rounded-lg shadow-md"></div>
                @endif
                <p class="{{ $project->image ? 'ps-5' : 'ps-0'}} py-2 pe-0 text-justify">
                    {{ $project->description }}
                </p>
            </div>
            <div class="card-container container mt-3 flex flex-wrap gap-4 justify-start">
                @forelse ($project->tasks as $task)
                <div
                    class="flex flex-col justify-between w-full sm:w-[49%] p-6 bg-white border border-gray-200 rounded-lg shadow-sm">

                    <div class="container">
                        <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{ $task->task_name }}</h2>
                        <p class="mt-3 mb-5">{{ $task->description }}</p>
                    </div>

                    <!-- Dropdown untuk mengubah status -->
                    <div class="card-footer flex justify-between gap-4">

                        {{-- Function untuk mengatur warna Dropdown sesuai status --}}
                        @php
                            $statusClass = match ($task->status->value) {
                                \App\Enums\TaskStatus::DONE->value => 'bg-green-200 border-green-600',
                                \App\Enums\TaskStatus::IN_PROGRESS->value => 'bg-yellow-200 border-yellow-600',
                                \App\Enums\TaskStatus::TODO->value => 'bg-red-200 border-red-600',
                                default => 'bg-gray-50 border-gray-600',
                            };
                        @endphp

                        <div class="status flex-1">
                            <label
                                for="status-{{ $task->id }}"
                                class="block mb-2 text-sm font-medium text-gray-900">Status:</label>
                            <select
                                id="status-{{ $task->id }}"
                                class="{{ $statusClass }}
                                border text-gray-900 text-sm rounded-lg focus:border-blue-500 block w-full p-2.5"
                                data-url="{{ route('tasks.updateStatus', $task->id) }}"
                                onchange="updateStatus(this)">
                                @foreach (\App\Enums\TaskStatus::cases() as $status)
                                <option
                                    class="bg-gray-50"
                                    value="{{ $status->value }}"
                                    {{ ($task->status->value ?? '') === $status->value ? 'selected' : '' }}>
                                    {{ ucfirst(str_replace('_', ' ', $status->value)) }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="action self-end">
                            <form
                                action="{{ route('tasks.destroy', $task) }}"
                                method="POST"
                                onsubmit="return confirm('Are you sure you want to delete {{ $task->task_name }}?');">
                                @csrf @method('DELETE')
                                <button
                                    type="submit"
                                    class="capitalize border border-red-900 flex items-center text-white bg-red-700 hover:bg-red-800 rounded-lg text-center py-2 px-4   ">
                                    {{-- svg icon trashbin --}}
                                    <svg
                                        class="w-6 h-6"
                                        aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="24"
                                        height="24"
                                        fill="currentColor"
                                        viewBox="0 0 24 24">
                                        <path
                                            fill-rule="evenodd"
                                            d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z"
                                            clip-rule="evenodd"/>
                                    </svg>
                                    {{-- <span>Delete</span> --}}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @empty
                <h1
                    class="my-3 text-2xl font-bold tracking-tight text-gray-900 text-center w-full">
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
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ status: newStatus })
            })
            .then(response => {
                if (!response.ok) {
                    return response.text().then(text => { throw new Error(text); });
                }
                return response.json();
            })
            .then(data => {
                // Toast atau alert
                alert(data.message);

                console.log(data.status);
    
                // Update class style pada select
                const classMap = {
                    'done': 'bg-green-200 border-green-600',
                    'in progress': 'bg-yellow-200 border-yellow-600',
                    'to do': 'bg-red-200 border-red-600',
                };
    
                // Reset class lama
                selectElement.classList.remove(
                    'bg-green-200', 'border-green-600',
                    'bg-yellow-200', 'border-yellow-600',
                    'bg-red-200', 'border-red-600',
                    'bg-gray-50', 'border-gray-600'
                );
    
                // Tambah class baru sesuai status dari response
                const status = data.status; // e.g. "DONE"
                const newClass = classMap[status] || 'bg-gray-50 border-gray-600';
    
                newClass.split(' ').forEach(cls => selectElement.classList.add(cls));
            })
            .catch(error => console.error('Error:', error));
        }
    </script>        
    
</x-app-layout>