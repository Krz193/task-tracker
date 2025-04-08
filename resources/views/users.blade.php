<x-app-layout>
    <div class="flex w-full justify-between items-center mb-4">
        <h1 class="text-2xl font-bold capitalize">{{ __('users data') }}</h1>
        <button
            onclick="location.href='{{ route('users.create') }}'"
            type="button"
            class="capitalize border border-gray-900 flex items-center text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5">
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
            <span>{{ __('Add User') }}</span>
        </button>
    </div>

    <div class="relative w-full overflow-x-auto shadow-md sm:rounded-lg">
        <table
            class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead
                class="text-xs text-gray-700 uppercase bg-gray-200">
                <tr>
                    <th scope="col" class="px-6 py-3 capitalize">
                        name
                    </th>
                    <th scope="col" class="px-6 py-3 capitalize">
                        email
                    </th>
                    <th scope="col" class="px-6 py-3 capitalize">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr
                    class="odd:bg-white even:bg-gray-200 border-b border-gray-200">
                    <th
                        scope="row"
                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        {{ $user->name }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $user->email }}
                    </td>
                    <td class="px-6 py-4">
                        <a
                            href="{{ route('users.edit', $user) }}"
                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                            Edit
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5">
                        No user data found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>