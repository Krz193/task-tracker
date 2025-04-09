@props(['projects'])
<aside {{ $attributes->merge(['class' => 'w-1/4 max-w-1/4 flex flex-col']) }}>
    {{-- sidebar header --}}
    <div class="container flex flex-col gap-2">
        <a href="{{ route('dashboard') }}"
        class="px-5 py-3 capitalize border-2 border-gray-300 bg-gray-50 hover:bg-gray-200 w-full rounded-lg flex items-center gap-2">
            <svg class="w-[24px] h-[24px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                <path fill-rule="evenodd" d="M11.293 3.293a1 1 0 0 1 1.414 0l6 6 2 2a1 1 0 0 1-1.414 1.414L19 12.414V19a2 2 0 0 1-2 2h-3a1 1 0 0 1-1-1v-3h-2v3a1 1 0 0 1-1 1H7a2 2 0 0 1-2-2v-6.586l-.293.293a1 1 0 0 1-1.414-1.414l2-2 6-6Z" clip-rule="evenodd"/>
            </svg>
            
            <span>dashboard</span>
        </a>

        @admin
        <a href="{{ route('users.index') }}"
        class="px-5 py-3 capitalize border-2 border-gray-300 bg-gray-50 hover:bg-gray-200 w-full rounded-lg flex items-center gap-2">
            <svg class="w-[24px] h-[24px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                <path fill-rule="evenodd" d="M8 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4H6Zm7.25-2.095c.478-.86.75-1.85.75-2.905a5.973 5.973 0 0 0-.75-2.906 4 4 0 1 1 0 5.811ZM15.466 20c.34-.588.535-1.271.535-2v-1a5.978 5.978 0 0 0-1.528-4H18a4 4 0 0 1 4 4v1a2 2 0 0 1-2 2h-4.535Z" clip-rule="evenodd"/>
            </svg>
            
            <span>users</span>
        </a>
        @endadmin
    </div>

    {{-- sidebar body --}}
    <div class="container flex-1">
        <div class="container flex justify-between items-center my-6">
            <h1 class="capitalize text-xl font-semibold">
                {{ __('Projects List') }}
            </h1>
            <button
                onclick="location.href='{{ route('project.store') }}'"
                type="button"
                class="capitalize flex items-center text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5">
                <svg
                    class="w-6 h-6 me-2"
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    fill="none"
                    viewbox="0 0 24 24">
                    <path
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M5 12h14m-7 7V5"/>
                </svg>
                <span>new project</span>
            </button>
        </div>
        <div class="btn-cont">
            @forelse ($projects as $project)
            <button
                onclick="location.href='{{ route('project.index', $project->id) }}'"
                type="button"
                class="
                    {{ (request()->route('id') == $project->id) ? 'bg-gray-700 text-white' : ''}}
                    w-full text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-700
                    focus:ring-1 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-4 text-left
                    me-2 mb-2">

                <div class="overflow-hidden text-ellipsis whitespace-nowrap">
                    {{ $project->project_name }}
                </div>
            </button>
            @empty
            <p>{{ __('belum ada project.') }}</p>
            @endforelse
        </div>
    </div>

    {{-- sidebar footer --}}
    <div class="container flex h-[50px] items-center">
        <span class="flex-1">
            {{ Auth::user()->name }}
        </span>
        <a href="{{ route('logout') }}"
        class="px-4 py-2 capitalize text-center border-2 border-red-400 bg-red-100 hover:bg-red-300 rounded-lg flex items-center gap-2">
            <svg class="w-6 h-6 text-gray-800 rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H8m12 0-4 4m4-4-4-4M9 4H7a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h2"/>
            </svg>
            
            <span>logout</span>
        </a>
    </div>
</aside>