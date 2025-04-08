<x-app-layout>
    {{-- dashboard admin --}}
    <div class="flex mb-5 gap-4 flex-wrap">
        <div class="w-[calc((1/3*100%)-1rem)] p-6 flex flex-col h-[25dvh] bg-white border border-gray-200 rounded-lg shadow-sm">
            <h1 class="text-2xl flex-1 font-bold tracking-tight text-gray-900 capitalize">
                total users
            </h1>
            <p class="font-normal text-gray-700 text-end">
                {{ $data->totalUsers }}
            </p>
        </div>
        <div class="w-[calc((1/3*100%)-1rem)] p-6 flex flex-col h-[25dvh] bg-white border border-gray-200 rounded-lg shadow-sm">
            <h1 class="text-2xl flex-1 font-bold tracking-tight text-gray-900 capitalize">
                total projects
            </h1>
            <p class="font-normal text-gray-700 text-end">
                {{ $data->totalProjects }}
            </p>
        </div>
        <div class="w-[calc((1/3*100%)-1rem)] p-6 flex flex-col h-[25dvh] bg-white border border-gray-200 rounded-lg shadow-sm">
            <h1 class="text-2xl flex-1 font-bold tracking-tight text-gray-900 capitalize">
                total tasks
            </h1>
            <p class="font-normal text-gray-700 text-end">
                {{ $data->totalTasks }}
            </p>
        </div>
        <div class="w-[calc((1/2*100%)-1rem)] p-6 flex flex-col h-[25dvh] bg-white border border-gray-200 rounded-lg shadow-sm">
            <h1 class="text-2xl flex-1 font-bold tracking-tight text-gray-900 capitalize">
                user with the most projects
            </h1>
            <p class="font-normal text-gray-700 text-end">
                {{ $data->topProjectUser->name }} ({{ $data->topProjectUser->topProjects }}
                <span class="capitalize">Project{{ $data->topProjectUser->topProjects>1 ? 's' : ''}})</span>
            </p>
        </div>
        <div class="w-[calc((1/2*100%)-1rem)] p-6 flex flex-col h-[25dvh] bg-white border border-gray-200 rounded-lg shadow-sm">
            <h1 class="text-2xl flex-1 font-bold tracking-tight text-gray-900 capitalize">
                user with the most done tasks
            </h1>
            <p class="font-normal text-gray-700 text-end">
                {{-- {{ dd($data->topTaskDoneUser) }} --}}
                {{ $data->topTaskDoneUser->user->name }} ({{ $data->topTaskDoneUser->tasks_done }}
                <span class="capitalize">Task{{ $data->topTaskDoneUser->tasks_done>1 ? 's' : '' }})</span>
            </p>
        </div>
    </div>


</x-app-layout>
