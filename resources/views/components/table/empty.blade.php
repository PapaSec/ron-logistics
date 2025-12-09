@props(['colspan' => 10, 'icon' => 'fa-inbox', 'title' => 'No results found', 'message' => 'Try adjusting your search or filters'])

<tr>
    <td colspan="{{ $colspan }}" class="px-6 py-12 text-center">
        <div class="text-gray-500 dark:text-gray-400">
            <i class="fas {{ $icon }} text-4xl mb-4"></i>
            <p class="text-lg font-medium">{{ $title }}</p>
            <p class="text-sm">{{ $message }}</p>
        </div>
    </td>
</tr>