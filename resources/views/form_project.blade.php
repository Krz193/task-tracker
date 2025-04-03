<x-app-layout>
    <div class="container flex flex-col items-center">
        <div class="justify-center w-full">
            <h1 class="text-left block capitalize mb-4 text-xl font-semibold">
                {{ isset($project) ? 'Edit Project' : 'New Project' }}
            </h1>
        </div>

        <form
            action="{{ isset($project) ? route('project.update', $project) : route('project.store') }}"
            method="POST"
            class="flex flex-col w-[70%]"
            enctype="multipart/form-data">
            @csrf @if(isset($project)) @method('PUT') @endif

            <!-- Name -->
            <div class="mb-4">
                <label for="project_name" class="block text-sm font-medium text-gray-700">Project Name</label>
                <input
                    type="text"
                    id="project_name"
                    name="project_name"
                    value="{{ isset($project) ? $project->project_name : old('project_name') }}"
                    required="required"
                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"></div>

                <!-- Description -->
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <input
                        type="text"
                        id="description"
                        name="description"
                        value="{{ isset($project) ? $project->description : old('description') }}"
                        required="required"
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"></div>

                    <!-- Image -->
                    <div class="mb-4">
                        <label for="image" class="block text-sm font-medium text-gray-700">Project Image</label>
                        <input type="file" name="image" 
                        accept="image/*">
                    </div>

                    @if(isset($project) && $project->image)
                    <div class="mb-4">
                        <label for="image" class="block text-sm font-medium text-gray-700">
                            Current Image
                        </label>
                        <img src="{{ asset('storage/' . $project->image) }}" alt="Project Image" class="w-32 h-auto">
                    </div>
                    @endif

                    <!-- Submit Button -->
                    <button
                        type="submit"
                        class="w-full text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5">
                        {{ isset($project) ? 'Update' : 'Add' }}
                    </button>
                    </form>
                </div>
            </x-app-layout>