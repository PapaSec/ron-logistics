@props([
    'actions' => [],
    'align' => 'right',
])

<td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
    <div @class([
        'flex items-center gap-2',
        'justify-end' => $align === 'right',
        'justify-start' => $align === 'left',
        'justify-center' => $align === 'center',
    ])>
        {{ $slot }}
        
        @foreach($actions as $action)
            @if($action['type'] === 'view')
                <a href="{{ $action['url'] }}"
                   class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300"
                   title="View">
                    <i class="fas fa-eye"></i>
                </a>
            @elseif($action['type'] === 'edit')
                <a href="{{ $action['url'] }}"
                   class="text-yellow-600 hover:text-yellow-800 dark:text-yellow-400 dark:hover:text-yellow-300"
                   title="Edit">
                    <i class="fas fa-edit"></i>
                </a>
            @elseif($action['type'] === 'delete')
                <button wire:click="confirmDelete({{ $action['id'] }})"
                        class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300"
                        title="Delete">
                    <i class="fas fa-trash"></i>
                </button>
            @endif
        @endforeach
    </div>
</td>