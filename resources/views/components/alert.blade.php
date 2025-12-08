@props(['type' => 'success'])

@php
    $classes = [
        'success' => 'bg-green-50 dark:bg-green-900/30 border-green-500 text-green-800 dark:text-green-300',
        'error' => 'bg-red-50 dark:bg-red-900/30 border-red-500 text-red-800 dark:text-red-300',
        'warning' => 'bg-yellow-50 dark:bg-yellow-900/30 border-yellow-500 text-yellow-800 dark:text-yellow-300',
        'info' => 'bg-blue-50 dark:bg-blue-900/30 border-blue-500 text-blue-800 dark:text-blue-300',
    ];
    
    $icons = [
        'success' => 'fa-check-circle text-green-500',
        'error' => 'fa-times-circle text-red-500',
        'warning' => 'fa-exclamation-triangle text-yellow-500',
        'info' => 'fa-info-circle text-blue-500',
    ];
@endphp

<div {{ $attributes->merge(['class' => "border-l-4 p-4 rounded-lg mb-4 {$classes[$type]}"]) }}>
    <div class="flex items-center">
        <i class="fas {{ $icons[$type] }} mr-3 text-xl"></i>
        <p class="font-medium">{{ $slot }}</p>
    </div>
</div>