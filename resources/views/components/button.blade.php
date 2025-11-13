@props([
    'href' => '#',
    'icon' => 'fas fa-plus-circle', // Default icon
])

<!-- Button Component -->
<a href="{{ $href }}" {{ $attributes->merge(['class' => 'bg-blue-500 hover:bg-blue-600 text-white rounded-lg px-4 py-2 flex items-center transition-colors duration-150']) }}>
    <i class="{{ $icon }} mr-2"></i> {{ $slot }}
</a>