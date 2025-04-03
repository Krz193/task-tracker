@props(['projects'])
<aside {{ $attributes->merge(['class' => 'w-1/4']) }}>
    <div class="container flex justify-between items-center mb-4">
        <h1 class="capitalize mb-4 text-xl font-semibold">
            {{ __('Projects List') }}
        </h1>
        <button
            onclick="location.href='{{ route('project.store') }}'"
            type="button"
            class="capitalize text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
            + add new
        </button>
    </div>
    <div class="btn-cont">
        @foreach ($projects as $project)
        <button
            onclick="location.href='/project/{{ $project->id }}'"
            type="button"
            class="w-full text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900
                focus:ring-1 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-4 text-left
                me-2 mb-2 dark:border-gray-600 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-800">

            <div class="overflow-hidden text-ellipsis whitespace-nowrap">
                {{ $project->project_name }}
            </div>
        </button>
        @endforeach
    </div>
</aside>