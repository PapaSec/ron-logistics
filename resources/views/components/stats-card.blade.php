<div {{ $attributes->merge(['class' => 'bg-[#E4EBE7] dark:bg-[#1f2431] rounded-lg p-6']) }}>
    <div class="flex items-center justify-between">
        <div>
            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $value }}</p>
            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $title }}</p>
            
            @if($showTrend)
                <div class="flex items-center mt-2">
                    <span class="text-xs {{ str_starts_with($trend, '+') ? 'text-green-500' : 'text-red-500' }} font-medium">
                        <i class="fas {{ str_starts_with($trend, '+') ? 'fa-arrow-up' : 'fa-arrow-down' }} mr-1"></i>
                        {{ $trend }}
                    </span>
                    <span class="text-xs text-gray-500 dark:text-gray-400 ml-2">{{ $trendText }}</span>
                </div>
            @endif
        </div>
        
        <div class="w-12 h-12 rounded-lg flex items-center justify-center {{ $iconBg }}">
            <i class="{{ $icon }} text-xl {{ $iconColor }}"></i>
        </div>
    </div>
</div>