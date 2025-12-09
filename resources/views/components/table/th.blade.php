@props(['align' => 'left'])

@php
    $alignments = [
        'left' => 'text-left',
        'center' => 'text-center',
        'right' => 'text-right',
    ];
@endphp

<th {{ $attributes->merge(['class' => "px-6 py-3 {$alignments[$align]} text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider"]) }}>
    {{ $slot }}
</th>