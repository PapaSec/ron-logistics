@props([
    'label' => null,
    'name',
    'required' => false,
    'icon' => 'fas fa-calendar-alt',
    'model' => null,
    'value' => null,
    'placeholder' => '',
])

<div class="group" wire:key="{{ $name }}">
    @if($label)
        <label for="{{ $name }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            {{ $label }} @if($required)<span class="text-red-500">*</span>@endif
        </label>
    @endif
    
    <div class="relative">
        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
            <i class="{{ $icon }} text-gray-400 transition-colors duration-200 group-focus-within:text-blue-400"></i>
        </div>
        <input 
            type="date" 
            id="{{ $name }}" 
            name="{{ $name }}"
            value="{{ $value ?? old($name) }}"
            @if($model) wire:model="{{ $model }}" @endif
            {{ $attributes->merge([
                'class' => 'w-full pl-11 pr-4 py-2.5 bg-white dark:bg-white/5 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 rounded-xl border border-gray-300 dark:border-white/10 focus:border-blue-500/50 focus:bg-white dark:focus:bg-white/10 focus:outline-none focus:ring-2 focus:ring-blue-500/20 transition-all duration-200',
                'required' => $required
            ]) }}
        >
    </div>
    
    @error($model ?? $name)
        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
    @enderror
</div>