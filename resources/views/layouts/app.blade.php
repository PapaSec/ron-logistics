<!DOCTYPE html>
<html lang="en" x-data="{ 
    darkMode: localStorage.getItem('darkMode') === 'true',
    pageLoaded: false // 🐛 FIX: Initialize pageLoaded state
}" :class="{ 'dark': darkMode }">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard - Ron Logistics' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <script>
        try {
            const darkMode = localStorage.getItem('darkMode');
            if (darkMode === 'true') {
                document.documentElement.classList.add('dark');
                document.documentElement.style.colorScheme = 'dark';
            }
        } catch (e) {
            console.log('Dark mode initialization error:', e);
        }
    </script>
</head>

<body class="h-full bg-gray-100 dark:bg-[#252b3b] transition-colors duration-200" 
    x-init="
        // 🐛 FIX: Set pageLoaded to true when Livewire/page components are finished loading
        // A short delay ensures all styles/assets have rendered before hiding.
        window.addEventListener('load', () => { 
            setTimeout(() => { pageLoaded = true }, 200); 
        });
        // Also listen for Livewire components being loaded
        document.addEventListener('livewire:initialized', () => {
            setTimeout(() => { pageLoaded = true }, 200);
        });
    "
>
    
    {{-- LOADING OVERLAY --}}
    <div x-show="!pageLoaded" x-transition:leave.duration.500ms
        class="fixed inset-0 bg-[#252b3b] dark:bg-[#1a1f2e] z-[9999] flex items-center justify-center flex-col gap-4">

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


    <div class="flex h-screen overflow-hidden">

        <x-sidebar />

        <div class="flex-1 flex flex-col overflow-hidden">

            <x-navbar />

            <main class="flex-1 overflow-y-auto p-6 bg-gray-300 dark:bg-[#212529] transition-colors duration-200">
                {{ $slot }}
            </main>

        </div>
    </div>

    @livewireScripts
</body>

</html>

<style>
/* Custom keyframes for the simulated progress bar. 
   You would need to ensure Tailwind CSS can use these keys, or define them in your CSS file. */
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