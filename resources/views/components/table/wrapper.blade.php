@props(['scrollable' => true])

<div {{ $attributes->merge(['class' => 'bg-white dark:bg-gray-900 rounded-lg shadow']) }}>
    <div class="{{ $scrollable ? 'overflow-x-auto table-scrollbar' : '' }}">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            {{ $slot }}
        </table>
    </div>
</div>