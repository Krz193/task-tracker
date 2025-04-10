@php
    $alertClasses = match ($type) {
        'success' => 'bg-green-100 border border-green-400 text-green-700',
        'error' => 'bg-red-100 border border-red-400 text-red-700',
        'warning' => 'bg-yellow-100 border border-yellow-400 text-yellow-700',
        'info' => 'bg-blue-100 border border-blue-400 text-blue-700',
        default => 'bg-gray-100 border border-gray-400 text-gray-700',
    };

    $iconColor = match ($type) {
        'success' => 'text-green-500',
        'error' => 'text-red-500',
        'warning' => 'text-yellow-500',
        'info' => 'text-blue-500',
        default => 'text-gray-500',
    };

    $states = [
        'success' => 'Success',
        'error' => 'Oops',
        'warning' => 'Hey',
        'info' => 'Hello',
    ];
@endphp

<div 
    class="custom-alert animate-slide-in {{ $alertClasses }} relative w-2/3 justify-self-center px-4 py-3 rounded-lg shadow-xl animate-fade-in alert-dismissible opacity-100 transition-opacity duration-500"
    role="alert"
    {{-- style="animation-delay: {{ $delay() }}s" --}}
>
    <strong class="font-bold">{{ $states[$type] ?? 'Notice' }}!</strong>
    <span class="block sm:inline">{{ $message }}</span>
    <button onclick="this.parentElement.remove();" class="absolute top-0 bottom-0 right-0 px-4 py-3">
        <svg class="fill-current h-6 w-6 {{ $iconColor }}" role="button" xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 20 20">
            <title>Close</title>
            <path d="M14.348 5.652a1 1 0 00-1.414 0L10 8.586 7.066 5.652a1 1 0 10-1.414 1.414L8.586 10l-2.934 2.934a1 1 0 101.414 1.414L10 11.414l2.934 2.934a1 1 0 001.414-1.414L11.414 10l2.934-2.934a1 1 0 000-1.414z"/>
        </svg>
    </button>
</div>

<script>
    document.querySelectorAll('.custom-alert').forEach((alert) => {
        setTimeout(() => {
            alert.classList.remove('animate-slide-in');
            alert.classList.add('animate-slide-out');

            // Tunggu animasi keluar selesai sebelum remove
            setTimeout(() => alert.remove(), 300);
        }, 3000);
    });
</script>
