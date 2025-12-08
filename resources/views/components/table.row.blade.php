@props([
    'clickable' => false,
    'url' => null,
])

<tr {{ 
    $attributes->merge(['class' => 'hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors']) 
    ->when($clickable, function($attributes) {
        return $attributes->merge(['class' => 'cursor-pointer']);
    })
}}>
    @if($clickable && $url)
        <a href="{{ $url }}" class="contents">
            {{ $slot }}
        </a>
    @else
        {{ $slot }}
    @endif
</tr>