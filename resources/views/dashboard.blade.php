<x-app-layout>
    <p>
        {{ (Auth::check() && Auth::user()->role->value === 'admin') ? 'admin' : 'member' }}
    </p>
</x-app-layout>
