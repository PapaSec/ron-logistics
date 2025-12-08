@props([
    'align' => 'left',
    'sortable' => false,
    'sortBy' => null,
    'sortDirection' => null,
])

<th {{
    $attributes->merge(['class' => 'px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider'])
    ->class([
        'text-right' => $align === 'right',
        'text-center' => $align === 'center',
        'text-left' => $align === 'left',
        'cursor-pointer select-none' => $sortable,
    ])
}}
@if($sortable && $sortBy)
    wire:click="sortBy('{{ $sortBy }}')"
@endif
>
    <div class="flex items-center gap-1">
        {{ $slot }}
        
        @if($sortable && $sortBy && $sortDirection)
            <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} text-xs"></i>
        @elseif($sortable)
            <i class="fas fa-sort text-xs opacity-50"></i>
        @endif
    </div>
</th>