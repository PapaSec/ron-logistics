@props(['viewRoute' => null, 'editRoute' => null, 'deleteId' => null])

<div class="flex items-center justify-end gap-2">
    @if($viewRoute)
        <a href="{{ $viewRoute }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300" title="View">
            <i class="fas fa-eye"></i>
        </a>
    @endif

    @if($editRoute)
        <a href="{{ $editRoute }}" class="text-yellow-600 hover:text-yellow-800 dark:text-yellow-400 dark:hover:text-yellow-300" title="Edit">
            <i class="fas fa-edit"></i>
        </a>
    @endif

    @if($deleteId)
        <button wire:click="confirmDelete({{ $deleteId }})" class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300" title="Delete">
            <i class="fas fa-trash"></i>
        </button>
    @endif
</div>