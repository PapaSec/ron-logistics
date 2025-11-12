<!DOCTYPE html>
<html lang="en" x-data="{ 
    pageLoaded: false // Added state management for the loader
}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? 'Ron | Logistics' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    
    <style>
        /* Custom keyframes for the simulated progress bar. */
        @keyframes progress {
            0% { transform: translateX(-100%) }
            100% { transform: translateX(100%) }
        }
        .animate-progress {
            animation: progress 2s infinite linear;
        }
        .animate-spin-slow {
            animation: spin 3s linear infinite;
        }
    </style>
</head>

<body class="min-h-screen bg-gray-900 flex flex-col justify-center items-center"
    x-init="
        // Logic to hide the loader automatically
        window.addEventListener('load', () => { 
            setTimeout(() => { pageLoaded = true }, 200); 
        });
        document.addEventListener('livewire:initialized', () => {
            setTimeout(() => { pageLoaded = true }, 200);
        });
    "
>

    {{-- LOADING OVERLAY (Guest View) --}}
    <div x-show="!pageLoaded" x-transition:leave.duration.500ms
        class="fixed inset-0 bg-gray-900 z-[9999] flex items-center justify-center flex-col gap-4">

        <div class="relative flex items-center justify-center w-24 h-24">
            
            <div class="absolute inset-0 border-4 border-blue-500/50 rounded-full animate-spin-slow"></div>

            <i class="fas fa-truck-moving text-4xl text-blue-400 animate-pulse"></i>
            
        </div>
        
        <div class="text-white text-lg font-semibold tracking-wider flex items-center gap-2">
            <span class="text-blue-400">RON</span>
            <span class="text-gray-300">LOGISTICS</span>
            <span class="text-sm font-light text-blue-500 animate-pulse">. . .</span>
        </div>

        <div class="w-64 h-1 bg-gray-700 rounded-full overflow-hidden mt-2">
            <div class="h-full bg-blue-500 animate-progress w-1/2"></div> 
        </div>

    </div>
    {{-- END Loading overlay --}}
    
    {{ $slot }}

    @livewireScripts
</body>

</html>