@props([
    'label' => null,
    'name',
    'required' => false,
    'icon' => 'fas fa-list',
    'model' => null,
    'options' => [],
    'inline' => false,
])

<div class="group" wire:key="{{ $name }}">
    @if($label)
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">
            <i class="{{ $icon }} text-gray-400 mr-2"></i>
            {{ $label }} @if($required)<span class="text-red-500">*</span>@endif
        </label>
    @endif
    
    <div class="{{ $inline ? 'flex flex-wrap gap-4' : 'space-y-3' }}">
        @foreach($options as $value => $optionLabel)
            <label class="flex items-center cursor-pointer group/radio">
                <div class="relative">
                    <input 
                        type="radio" 
                        id="{{ $name }}_{{ $value }}" 
                        name="{{ $name }}"
                        value="{{ $value }}"
                        @if($model) wire:model="{{ $model }}" @endif
                        {{ $attributes->merge([
                            'class' => 'peer sr-only',
                            'required' => $required
                        ]) }}
                    >
                    <div class="w-5 h-5 rounded-full border-2 border-gray-300 dark:border-white/20 bg-white dark:bg-white/5 
                                peer-checked:border-[#138898] peer-checked:bg-[#138898] 
                                peer-focus:ring-2 peer-focus:ring-[#138898]/20 
                                transition-all duration-200 
                                flex items-center justify-center">
                        <div class="w-2 h-2 rounded-full bg-white opacity-0 peer-checked:opacity-100 transition-opacity duration-200"></div>
                    </div>
                </div>
                <span class="ml-3 text-sm font-medium text-gray-700 dark:text-gray-300 
                             group-hover/radio:text-gray-900 dark:group-hover/radio:text-white 
                             peer-checked:text-[#138898] dark:peer-checked:text-[#138898]
                             transition-colors duration-200">
                    {{ $optionLabel }}
                </span>
            </label>
        @endforeach
    </div>
    
    @error($model ?? $name)
        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
    @enderror
</div>