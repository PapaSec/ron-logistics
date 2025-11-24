@props([
    'href' => '#',
    'icon' => null, // Set default icon to null
    'style' => 'primary', // New prop: 'primary', 'secondary', 'link', etc.
])

@php
    $baseClasses = 'rounded-lg px-4 py-2 flex items-center transition-colors duration-150 font-medium';
    
    // Define specific colors/styles based on the 'style' prop
    $styleClasses = match ($style) {
        'secondary' => 'bg-gray-200 hover:bg-gray-300 text-gray-800 dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-gray-200',
        'back' => 'bg-black hover:bg-gray-900 text-white',
        'cancel' => 'bg-red-500 hover:bg-red-600 text-white',
        'submit' => 'bg-green-600 hover:bg-green-700 text-white',
        'reset' => 'bg-yellow-700 hover:bg-yellow-600 text-white',
        'clear' => 'px-4 py-2.5 bg-red-500 hover:bg-red-600 text-white transition-all duration-200 flex items-center justify-center',
        'edit' => 'bg-blue-500 hover:bg-blue-600',
        'delete' => 'bg-red-500 hover:bg-red-600',
        default => 'bg-blue-500 hover:bg-blue-600 text-white', // 'primary'
    };
@endphp

<a href="{{ $href }}" 
    {{ $attributes->merge(['class' => $baseClasses . ' ' . $styleClasses]) }}>
    
    @if($icon)
        <i class="{{ $icon }} mr-2"></i>
    @endif
    
    {{ $slot }}
</a>