@props([
    'align' => 'left',
    'nowrap' => false,
    'truncate' => false,
    'colspan' => null,
    'rowspan' => null,
])

<td {{
    $attributes->merge(['class' => 'px-6 py-4 text-sm'])
    ->class([
        'whitespace-nowrap' => $nowrap,
        'max-w-xs truncate' => $truncate,
        'text-right' => $align === 'right',
        'text-center' => $align === 'center',
        'text-left' => $align === 'left',
    ])
}}
@if($colspan) colspan="{{ $colspan }}" @endif
@if($rowspan) rowspan="{{ $rowspan }}" @endif
>
    {{ $slot }}
</td>