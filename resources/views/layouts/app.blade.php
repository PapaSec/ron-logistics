<!DOCTYPE html>
<html lang="en" x-data="{ 
    darkMode: localStorage.getItem('darkMode') === 'true',
    pageLoaded: false,
    sidebarCollapsed: localStorage.getItem('sidebarCollapsed') === 'true'
}" :class="{ 'dark': darkMode }">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard - Ron Logistics' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>

    <script>
        try {
            const darkMode = localStorage.getItem('darkMode');
            const sidebarCollapsed = localStorage.getItem('sidebarCollapsed');
            if (darkMode === 'true') {
                document.documentElement.classList.add('dark');
                document.documentElement.style.colorScheme = 'dark';
            }
            if (sidebarCollapsed === 'true') {
                document.documentElement.classList.add('sidebar-collapsed');
            }
        } catch (e) {
            console.log('Initialization error:', e);
        }
    </script>
</head>

<body class="h-full bg-gray-100 dark:bg-[#252b3b] transition-all duration-300" 
    x-init="
        // Store sidebar state
        $watch('sidebarCollapsed', val => {
            localStorage.setItem('sidebarCollapsed', val);
            if (val) {
                document.documentElement.classList.add('sidebar-collapsed');
            } else {
                document.documentElement.classList.remove('sidebar-collapsed');
            }
        });
        
        // Page loaded
        window.addEventListener('load', () => { 
            setTimeout(() => { pageLoaded = true }, 200); 
        });
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

        <div class="flex-1 flex flex-col overflow-hidden transition-all duration-300" 
             :class="sidebarCollapsed ? 'ml-16' : 'ml-64'">

            <x-navbar />

            <main class="flex-1 overflow-y-auto p-6 bg-gray-300 dark:bg-[#141822] transition-all duration-300">
                {{ $slot }}
            </main>

        </div>
    </div>

    @livewireScripts

    @stack('scripts')
</body>

</html>

<style>
/* Custom keyframes for animations */
@keyframes progress {
    0% { transform: translateX(-100%) }
    100% { transform: translateX(100%) }
}
@keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}
.animate-progress {
    animation: progress 2s infinite linear;
}
.animate-spin-slow {
    animation: spin 3s linear infinite;
}

/* Sidebar collapsed global styles */
.sidebar-collapsed .sidebar-text {
    opacity: 0;
    width: 0;
    overflow: hidden;
    margin-left: 0;
}

.sidebar-collapsed .sidebar-section-title {
    display: none;
}

.sidebar-collapsed .sidebar-header-text {
    display: none;
}
</style>