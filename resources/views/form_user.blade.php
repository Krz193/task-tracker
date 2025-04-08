<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">
            {{ isset($user) ? 'Edit User' : 'Add User' }}
        </h1>

        <form action="{{ isset($user) ? route('users.update', $user->id) : route('users.store') }}" method="POST">
            @csrf
            @if(isset($user))
                @method('PUT')
            @endif

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">{{ __('Name') }}</label>
                <input type="text" name="name" value="{{ old('name', $user->name ?? '') }}" required class="w-full p-2 border rounded">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">{{ __('Email') }}</label>
                <input type="email" name="email" value="{{ old('email', $user->email ?? '') }}" required class="w-full p-2 border rounded">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">{{ __('Password') }}</label>
                <input type="password" name="password" class="w-full p-2 border rounded" 
                    @if(isset($user))
                    placeholder="Leave blank to keep current password"
                    @endif
                >
            </div>            

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded capitalize">
                {{ isset($user) ? 'Update User' : 'Add User' }}
            </button>
        </form>
    </div>
</x-app-layout>
