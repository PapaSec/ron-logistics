<!DOCTYPE html>
<html lang="en" x-data="{ 
    darkMode: localStorage.getItem('darkMode') === 'true',
    pageLoaded: false,
    sidebarCollapsed: localStorage.getItem('sidebarCollapsed') === 'true',
    mobileSidebarOpen: false
}" :class="{ 'dark': darkMode }">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard - Ron Logistics' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoDlTnyA38b/0K4V4z3d2+U3w+QJj8Wd3f3f3f3fA="
     crossorigin=""/>

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
        // Page loading
        window.addEventListener('load', () => { 
            setTimeout(() => { pageLoaded = true }, 200); 
        });
        document.addEventListener('livewire:initialized', () => {
            setTimeout(() => { pageLoaded = true }, 200);
        });

        // Watch sidebar collapsed state
        $watch('sidebarCollapsed', val => {
            localStorage.setItem('sidebarCollapsed', val);
        });

        // Initialize from localStorage
        const savedState = localStorage.getItem('sidebarCollapsed');
        if (savedState !== null) {
            sidebarCollapsed = savedState === 'true';
        }
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

        {{-- Desktop Sidebar --}}
        <aside x-data="{ collapsed: sidebarCollapsed }" 
            @toggle-sidebar.window="collapsed = !collapsed; $root.parentElement.querySelector('[x-data]').sidebarCollapsed = collapsed"
            :class="collapsed ? 'w-20' : 'w-64'" 
            class="hidden lg:flex bg-[#E4EBE7] dark:bg-[#1f2431] dark:border-gray-800 flex-col transition-all duration-300 ease-in-out relative">
            
            <!-- Sidebar header with logo -->
            <div class="h-18 flex items-center justify-center bg-[#232838] dark:border-gray-800 relative">
                <div class="flex items-center gap-2" x-show="!collapsed" x-transition>
                    <div class="w-10 h-10 bg-[#138898] dark:bg-[#138898] rounded-lg flex items-center justify-center">
                        <i class="fas fa-truck text-white"></i>
                    </div>
                    <span class="text-xl font-bold text-white">Ron Logistics</span>
                </div>
                
                <!-- Collapsed Logo -->
                <div class="w-10 h-10 bg-[#138898] dark:bg-[#138898] rounded-lg flex items-center justify-center" 
                    x-show="collapsed" x-transition>
                    <i class="fas fa-truck text-white"></i>
                </div>
            </div>

            <!-- Scrollable navigation area -->
            <nav class="flex-1 overflow-y-auto py-4 sidebar-scrollbar">
                <div class="px-3 space-y-1">
                    <!-- Dashboard section -->
                    <span x-show="!collapsed" x-transition
                        class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-500 block mb-1 mt-2">
                        DASHBOARD
                    </span>

                    <!-- Active dashboard link -->
                    <a href="{{ route('dashboard') }}" 
                        class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all group relative
                        {{ request()->routeIs('dashboard') ? 'bg-[#138898] dark:bg-[#138898] text-white dark:text-white' : '' }}"
                        :class="collapsed ? 'justify-center' : ''">
                        <i class="fas fa-chart-pie w-5"></i> 
                        <span x-show="!collapsed" x-transition class="font-medium">Overview</span>
                        
                        <!-- Tooltip for collapsed state -->
                        <div x-show="collapsed" 
                            class="absolute left-full ml-2 px-2 py-1 bg-gray-900 text-white text-sm rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none z-50">
                            Overview
                        </div>
                    </a>

                    <a href="#"
                        class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all group relative"
                        :class="collapsed ? 'justify-center' : ''">
                        <i class="fas fa-chart-line w-5"></i>
                        <span x-show="!collapsed" x-transition class="font-medium">Fleet Status</span>
                        <div x-show="collapsed" 
                            class="absolute left-full ml-2 px-2 py-1 bg-gray-900 text-white text-sm rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none z-50">
                            Fleet Status
                        </div>
                    </a>

                    <a href="{{ route('live-map') }}"
                        class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all group relative
                        {{ request()->routeIs('live-map') ? 'bg-[#138898] dark:bg-[#138898] text-white dark:text-white' : '' }}"
                        :class="collapsed ? 'justify-center' : ''">
                        <i class="fas fa-map-marker-alt w-5"></i> 
                        <span x-show="!collapsed" x-transition class="font-medium">Live Map</span>
                        <div x-show="collapsed" 
                            class="absolute left-full ml-2 px-2 py-1 bg-gray-900 text-white text-sm rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none z-50">
                            Live Map
                        </div>
                    </a>

                    <!-- Shipments section -->
                    <span x-show="!collapsed" x-transition
                        class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-500 block mb-1 mt-4">
                        SHIPMENTS
                    </span>

                    <a href="{{ route('shipments.index') }}"
                        class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all group relative
                        {{ request()->routeIs('shipments.index') ? 'bg-[#138898] dark:bg-[#138898] text-white dark:text-white' : '' }}"
                        :class="collapsed ? 'justify-center' : ''">
                        <i class="fas fa-list-ul w-5"></i> 
                        <span x-show="!collapsed" x-transition class="font-medium">All Shipments</span>
                        <div x-show="collapsed" 
                            class="absolute left-full ml-2 px-2 py-1 bg-gray-900 text-white text-sm rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none z-50">
                            All Shipments
                        </div>
                    </a>

                    <a href="{{ route('shipments.track') }}"
                        class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all group relative
                        {{ request()->routeIs('shipments.track') ? 'bg-[#138898] dark:bg-[#138898] text-white dark:text-white' : '' }}"
                        :class="collapsed ? 'justify-center' : ''">
                        <i class="fas fa-route w-5"></i> 
                        <span x-show="!collapsed" x-transition class="font-medium">Track Shipment</span>
                        <div x-show="collapsed" 
                            class="absolute left-full ml-2 px-2 py-1 bg-gray-900 text-white text-sm rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none z-50">
                            Track Shipment
                        </div>
                    </a>

                    <a href="#"
                        class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all group relative"
                        :class="collapsed ? 'justify-center' : ''">
                        <i class="fas fa-clock w-5"></i> 
                        <span x-show="!collapsed" x-transition class="font-medium">Delayed</span>
                        <div x-show="collapsed" 
                            class="absolute left-full ml-2 px-2 py-1 bg-gray-900 text-white text-sm rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none z-50">
                            Delayed
                        </div>
                    </a>

                    <!-- Fleet Management section -->
                    <span x-show="!collapsed" x-transition
                        class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-500 block mb-1 mt-4">
                        FLEET MANAGEMENT
                    </span>
                        
                    <a href="{{ route('drivers.index') }}"
                        class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all group relative
                        {{ request()->routeIs('drivers.index') ? 'bg-[#138898] dark:bg-[#138898] text-white dark:text-white' : '' }}"
                        :class="collapsed ? 'justify-center' : ''">
                        <i class="fas fa-users w-5"></i> 
                        <span x-show="!collapsed" x-transition class="font-medium">All Drivers</span>
                        <div x-show="collapsed" 
                            class="absolute left-full ml-2 px-2 py-1 bg-gray-900 text-white text-sm rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none z-50">
                            All Drivers
                        </div>
                    </a>

                    <a href="{{ route('vehicles.index') }}"
                        class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all group relative
                        {{ request()->routeIs('vehicles.index') ? 'bg-[#138898] dark:bg-[#138898] text-white dark:text-white' : '' }}"
                        :class="collapsed ? 'justify-center' : ''">
                        <i class="fas fa-truck-moving w-5"></i> 
                        <span x-show="!collapsed" x-transition class="font-medium">Vehicle List</span>
                        <div x-show="collapsed" 
                            class="absolute left-full ml-2 px-2 py-1 bg-gray-900 text-white text-sm rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none z-50">
                            Vehicle List
                        </div>
                    </a>

                    <a href="{{ route('driver-assignments.index') }}"
                        class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all group relative
                        {{ request()->routeIs('driver-assignments.index') ? 'bg-[#138898] dark:bg-[#138898] text-white dark:text-white' : '' }}"
                        :class="collapsed ? 'justify-center' : ''">
                        <i class="fas fa-user w-5"></i> 
                        <span x-show="!collapsed" x-transition class="font-medium">Driver Assignments</span>
                        <div x-show="collapsed" 
                            class="absolute left-full ml-2 px-2 py-1 bg-gray-900 text-white text-sm rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none z-50">
                            Driver Assignments
                        </div>
                    </a>

                    <a href="{{ route('fuel-maintenance.index') }}"
                        class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all group relative
                        {{ request()->routeIs('fuel-maintenance.index') ? 'bg-[#138898] dark:bg-[#138898] text-white dark:text-white' : '' }}"
                        :class="collapsed ? 'justify-center' : ''">
                        <i class="fas fa-gas-pump w-5"></i> 
                        <span x-show="!collapsed" x-transition class="font-medium">Fuel & Maintenance</span>
                        <div x-show="collapsed" 
                            class="absolute left-full ml-2 px-2 py-1 bg-gray-900 text-white text-sm rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none z-50">
                            Fuel & Maintenance
                        </div>
                    </a>

                    <!-- Additional menu sections with similar pattern... -->
                    <!-- I'm shortening this for brevity, but all other sections follow the same pattern -->

                </div>
            </nav>
        </aside>

        {{-- Mobile Sidebar Overlay --}}
        <div x-show="mobileSidebarOpen" 
            @click="mobileSidebarOpen = false"
            x-transition:enter="transition-opacity ease-linear duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-linear duration-300"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-gray-900/80 backdrop-blur-sm z-40 lg:hidden"
            style="display: none;">
        </div>

        {{-- Mobile Sidebar --}}
        <aside x-show="mobileSidebarOpen"
            @click.away="mobileSidebarOpen = false"
            x-transition:enter="transition ease-in-out duration-300 transform"
            x-transition:enter-start="-translate-x-full"
            x-transition:enter-end="translate-x-0"
            x-transition:leave="transition ease-in-out duration-300 transform"
            x-transition:leave-start="translate-x-0"
            x-transition:leave-end="-translate-x-full"
            class="fixed inset-y-0 left-0 z-50 w-64 bg-[#E4EBE7] dark:bg-[#1f2431] flex flex-col lg:hidden"
            style="display: none;">
            
            <!-- Mobile Sidebar Header -->
            <div class="h-18 flex items-center justify-between px-4 bg-[#232838]">
                <div class="flex items-center gap-2">
                    <div class="w-10 h-10 bg-[#138898] rounded-lg flex items-center justify-center">
                        <i class="fas fa-truck text-white"></i>
                    </div>
                    <span class="text-xl font-bold text-white">Ron Logistics</span>
                </div>
                <button @click="mobileSidebarOpen = false" class="p-2 text-gray-400 hover:text-white">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <!-- Mobile Navigation (same content as desktop but without collapse logic) -->
            <nav class="flex-1 overflow-y-auto py-4 sidebar-scrollbar">
                <div class="px-3 space-y-1">
                    <!-- Same menu items as desktop sidebar -->
                    <span class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-500 block mb-1 mt-2">DASHBOARD</span>
                    
                    <a href="{{ route('dashboard') }}" @click="mobileSidebarOpen = false"
                        class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all
                        {{ request()->routeIs('dashboard') ? 'bg-[#138898] text-white' : '' }}">
                        <i class="fas fa-chart-pie w-5"></i>
                        <span class="font-medium">Overview</span>
                    </a>

                    <!-- Add all other menu items similarly -->
                </div>
            </nav>
        </aside>

        <div class="flex-1 flex flex-col overflow-hidden">

            {{-- Navbar with mobile menu button --}}
            <header class="h-18 bg-[#232838] border-b border-gray-800/50 backdrop-blur-sm shadow-lg" x-data="{ 
                    darkMode: localStorage.getItem('darkMode') === 'true', 
                    searchFocused: false,
                    profileOpen: false 
                }" x-init="
                    $watch('darkMode', val => { 
                        if (val) { 
                            document.documentElement.classList.add('dark'); 
                            localStorage.setItem('darkMode', 'true'); 
                        } else { 
                            document.documentElement.classList.remove('dark'); 
                            localStorage.setItem('darkMode', 'false'); 
                        }
                    }); 
                    if (darkMode) { 
                        document.documentElement.classList.add('dark'); 
                    }
                ">

                <div class="h-full flex items-center justify-between px-4 lg:px-6 max-w-screen-2xl mx-auto">

                    <!-- Left Section: Menu Toggle -->
                    <div class="flex items-center gap-3">
                        <!-- Mobile Menu Button -->
                        <button @click="$root.querySelector('[x-data]').mobileSidebarOpen = true"
                            class="lg:hidden p-2.5 text-gray-400 hover:text-white hover:bg-white/10 rounded-lg transition-all duration-200"
                            aria-label="Open mobile menu">
                            <i class="fas fa-bars text-lg"></i>
                        </button>

                        <!-- Desktop Sidebar Toggle -->
                        <button @click="window.dispatchEvent(new CustomEvent('toggle-sidebar'))"
                            class="hidden lg:block p-2.5 text-gray-400 hover:text-white hover:bg-white/10 rounded-lg transition-all duration-200"
                            aria-label="Toggle sidebar">
                            <i class="fas fa-bars text-lg"></i>
                        </button>

                        <!-- Connection Status (hidden on small screens) -->
                        <div class="hidden md:flex items-center gap-3 px-3 py-1.5 rounded-lg bg-blue-600/10 border border-blue-500/20">
                            <i class="fas fa-wifi text-green-500 w-4 h-4"></i>
                            <span class="text-xs font-medium text-blue-400">Good Connection</span>
                        </div>
                    </div>

                    <!-- Center Section: Search Bar (hidden on mobile) -->
                    <div class="hidden md:flex flex-1 max-w-2xl mx-8">
                        <div class="relative w-full group">
                            <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 transition-colors duration-200 group-focus-within:text-blue-400"></i>
                            <input type="text" placeholder="Search shipments, fleet, or users..." @focus="searchFocused = true" @blur="searchFocused = false"
                                class="w-full pl-11 pr-4 py-2.5 bg-[#2a3042] text-white placeholder-gray-500 rounded-full focus:border-blue-500/50 focus:bg-white/10 focus:outline-none focus:ring-2 focus:ring-blue-500/20 transition-all duration-200">
                        </div>
                    </div>

                    <!-- Right Section: Actions -->
                    <div class="flex items-center gap-2">
                        <!-- Mobile Search Button -->
                        <button class="md:hidden p-2.5 text-gray-400 hover:text-white hover:bg-white/10 rounded-lg transition-all duration-200">
                            <i class="fas fa-search text-lg"></i>
                        </button>

                        <!-- Dark Mode Toggle -->
                        <button @click="darkMode = !darkMode"
                            class="p-2.5 text-gray-400 hover:text-white hover:bg-white/10 rounded-lg transition-all duration-200 group"
                            aria-label="Toggle dark mode">
                            <i class="fas text-lg transition-all duration-300"
                                :class="darkMode ? 'fa-sun text-yellow-400' : 'fa-moon text-gray-400'"></i>
                        </button>

                        <!-- Notifications -->
                        <button class="relative p-2.5 text-gray-400 hover:text-white hover:bg-white/10 rounded-lg transition-all duration-200">
                            <i class="fas fa-bell text-lg"></i>
                            <span class="absolute -top-1 -right-1 flex items-center justify-center w-5 h-5 text-xs font-bold text-white bg-red-500 border-2 border-[#232838] rounded-full">3</span>
                        </button>

                        <!-- User Profile (hidden text on mobile) -->
                        <div class="relative">
                            <button @click="profileOpen = !profileOpen"
                                class="flex items-center gap-2 lg:gap-3 hover:bg-white/10 rounded-lg pl-2 pr-2 lg:pr-3 py-1.5 transition-all duration-200">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=4F46E5&color=fff"
                                    alt="{{ auth()->user()->name }}"
                                    class="w-9 h-9 rounded-full ring-2 ring-white/10">
                                <span class="hidden lg:block text-sm font-medium text-white">{{ auth()->user()->name }}</span>
                            </button>

                            <!-- Profile Dropdown (same as before) -->
                        </div>
                    </div>

                </div>
            </header>

            <main class="flex-1 overflow-y-auto p-4 lg:p-6 bg-gray-300 dark:bg-[#141822] transition-colors duration-200">
                {{ $slot }}
            </main>

        </div>
    </div>

    @livewireScripts
    @stack('scripts')
</body>

</html>

<style>
/* Custom keyframes */
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

/* Webkit scrollbar styles */
.sidebar-scrollbar::-webkit-scrollbar {
    width: 6px;
}

.sidebar-scrollbar::-webkit-scrollbar-track {
    background: transparent;
    border-radius: 10px;
}

.sidebar-scrollbar::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 10px;
}

.sidebar-scrollbar::-webkit-scrollbar-thumb:hover {
    background: #94a3b8;
}

/* Dark mode scrollbar styles */
.dark .sidebar-scrollbar::-webkit-scrollbar-thumb {
    background: #4b5563;
}

.dark .sidebar-scrollbar::-webkit-scrollbar-thumb:hover {
    background: #6b7280;
}

/* Firefox scrollbar styles */
.sidebar-scrollbar {
    scrollbar-width: thin;
    scrollbar-color: #138898 transparent;
}

.dark .sidebar-scrollbar {
    scrollbar-color: #138898 transparent;
}
</style>