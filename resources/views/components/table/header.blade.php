@props(['bgColor' => 'bg-[#138898]'])

<thead {{ $attributes->merge(['class' => $bgColor]) }}>
    <tr>
        {{ $slot }}
    </tr>
</thead>