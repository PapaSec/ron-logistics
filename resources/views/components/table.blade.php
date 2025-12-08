@props([
    'headers' => [],
    'striped' => true,
    'hover' => true,
    'responsive' => true,
    'loading' => false,
    'emptyMessage' => 'No data found',
    'emptyIcon' => 'fas fa-inbox',
])

<div {{ $attributes->merge(['class' => 'bg-white dark:bg-gray-900 rounded-lg shadow']) }}>
    @if($loading)
        <div class="flex items-center justify-center py-8">
            <i class="fas fa-spinner fa-spin text-blue-500 text-2xl mr-3"></i>
            <span class="text-gray-600 dark:text-gray-400">Loading...</span>
        </div>
    @else
        <div @class([
            'overflow-x-auto' => $responsive,
        ])>
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                @if(!empty($headers))
                    <thead class="bg-[#138898]">
                        <tr>
                            @foreach($headers as $header)
                                <th {{ 
                                    $header->attributes->class([
                                        'px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider',
                                        'text-right' => isset($header['align']) && $header['align'] === 'right',
                                        'text-center' => isset($header['align']) && $header['align'] === 'center',
                                    ])
                                }}>
                                    {{ $header }}
                                </th>
                            @endforeach
                        </tr>
                    </thead>
                @endif
                
                <tbody @class([
                    'bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700',
                    'hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors' => $hover,
                ])>
                    {{ $slot }}
                </tbody>
            </table>
        </div>
        
        @if($slot->isEmpty())
            <div class="px-6 py-12 text-center">
                <div class="text-gray-500 dark:text-gray-400">
                    <i class="{{ $emptyIcon }} text-4xl mb-4"></i>
                    <p class="text-lg font-medium">{{ $emptyMessage }}</p>
                    @isset($emptyDescription)
                        <p class="text-sm">{{ $emptyDescription }}</p>
                    @endisset
                </div>
            </div>
        @endif
    @endif
</div>