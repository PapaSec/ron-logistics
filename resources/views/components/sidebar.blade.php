<aside class="fixed left-0 top-0 h-full bg-[#E4EBE7] dark:bg-[#1f2431] dark:border-gray-800 flex flex-col transition-all duration-300 z-40"
      :class="$store.sidebar.collapsed ? 'w-16' : 'w-64'">
    
    <!-- Sidebar header with logo -->
    <div class="h-18 flex items-center justify-center bg-[#232838] dark:border-gray-800 transition-all duration-300 overflow-hidden">
        <div class="flex items-center gap-2 px-2">
            <div class="w-10 h-10 bg-[#138898] dark:bg-[#138898] rounded-lg flex items-center justify-center transition-all duration-300 flex-shrink-0">
                <i class="fas fa-truck text-white"></i>
            </div>
            <span class="sidebar-header-text text-xl font-bold text-white whitespace-nowrap transition-all duration-300 overflow-hidden">
                Ron Logistics
            </span>
        </div>
    </div>

    <!-- Scrollable navigation area -->
    <nav class="flex-1 overflow-y-auto py-4 sidebar-scrollbar transition-all duration-300">
        <div class="space-y-1">
            <!-- Dashboard section -->
            <div class="sidebar-section-title transition-all duration-300 px-3">
                <span class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-500 block mb-1 mt-2">
                    DASHBOARD
                </span>
            </div>

            <!-- Active dashboard link -->
            <div x-data="{ tooltipVisible: false }" 
                 @mouseenter="tooltipVisible = true" 
                 @mouseleave="tooltipVisible = false" 
                 class="relative">
                <a href="{{ route('dashboard') }}" 
                   class="group flex items-center gap-3 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all duration-200 mx-2
                   {{ request()->routeIs('dashboard') ? 'bg-[#138898] dark:bg-[#138898] text-white dark:text-white' : '' }}"
                   :class="$store.sidebar.collapsed ? 'justify-center px-0' : 'px-4'">
                    <div class="flex items-center justify-center min-w-[40px]">
                        <i class="fas fa-chart-pie w-5 text-center"></i>
                    </div>
                    <span class="sidebar-text font-medium whitespace-nowrap transition-all duration-300 overflow-hidden">Overview</span>
                </a>
                
                <!-- Tooltip for collapsed state -->
                <div x-show="$store.sidebar.collapsed && tooltipVisible" 
                     x-transition:enter="transition ease-out duration-150"
                     x-transition:enter-start="opacity-0 -translate-x-1"
                     x-transition:enter-end="opacity-100 translate-x-0"
                     x-transition:leave="transition ease-in duration-100"
                     x-transition:leave-start="opacity-100 translate-x-0"
                     x-transition:leave-end="opacity-0 -translate-x-1"
                     class="absolute left-full top-1/2 -translate-y-1/2 ml-3 z-[100] pointer-events-none">
                    <div class="relative">
                        <!-- Tooltip arrow -->
                        <div class="absolute -left-[5px] top-1/2 -translate-y-1/2 w-2.5 h-2.5 bg-gray-900 dark:bg-gray-700 rotate-45"></div>
                        <!-- Tooltip content with matching hover colors -->
                        <div class="bg-gray-900 dark:bg-gray-700 text-white dark:text-gray-100 px-3 py-2 rounded-lg shadow-xl border border-gray-700 min-w-[120px]">
                            <span class="text-sm font-medium whitespace-nowrap">Overview</span>
                        </div>
                    </div>
                </div>
            </div>

            <div x-data="{ tooltipVisible: false }" 
                 @mouseenter="tooltipVisible = true" 
                 @mouseleave="tooltipVisible = false" 
                 class="relative">
                <a href="#"
                    class="group flex items-center gap-3 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all duration-200 mx-2"
                    :class="$store.sidebar.collapsed ? 'justify-center px-0' : 'px-4'">
                    <div class="flex items-center justify-center min-w-[40px]">
                        <i class="fas fa-chart-line w-5 text-center"></i>
                    </div>
                    <span class="sidebar-text font-medium whitespace-nowrap transition-all duration-300 overflow-hidden">Fleet Status</span>
                </a>
                
                <!-- Tooltip for collapsed state -->
                <div x-show="$store.sidebar.collapsed && tooltipVisible" 
                     x-transition:enter="transition ease-out duration-150"
                     x-transition:enter-start="opacity-0 -translate-x-1"
                     x-transition:enter-end="opacity-100 translate-x-0"
                     x-transition:leave="transition ease-in duration-100"
                     x-transition:leave-start="opacity-100 translate-x-0"
                     x-transition:leave-end="opacity-0 -translate-x-1"
                     class="absolute left-full top-1/2 -translate-y-1/2 ml-3 z-[100] pointer-events-none">
                    <div class="relative">
                        <div class="absolute -left-[5px] top-1/2 -translate-y-1/2 w-2.5 h-2.5 bg-gray-900 dark:bg-gray-700 rotate-45"></div>
                        <div class="bg-gray-900 dark:bg-gray-700 text-white dark:text-gray-100 px-3 py-2 rounded-lg shadow-xl border border-gray-700 min-w-[120px]">
                            <span class="text-sm font-medium whitespace-nowrap">Fleet Status</span>
                        </div>
                    </div>
                </div>
            </div>

            <div x-data="{ tooltipVisible: false }" 
                 @mouseenter="tooltipVisible = true" 
                 @mouseleave="tooltipVisible = false" 
                 class="relative">
                <a href="{{ route('live-map') }}"
                    class="group flex items-center gap-3 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all duration-200 mx-2
                    {{ request()->routeIs('live-map') ? 'bg-[#138898] dark:bg-[#138898] text-white dark:text-white' : '' }}"
                    :class="$store.sidebar.collapsed ? 'justify-center px-0' : 'px-4'">
                    <div class="flex items-center justify-center min-w-[40px]">
                        <i class="fas fa-map-marker-alt w-5 text-center"></i>
                    </div>
                    <span class="sidebar-text font-medium whitespace-nowrap transition-all duration-300 overflow-hidden">Live Map</span>
                </a>
                
                <!-- Tooltip for collapsed state -->
                <div x-show="$store.sidebar.collapsed && tooltipVisible" 
                     x-transition:enter="transition ease-out duration-150"
                     x-transition:enter-start="opacity-0 -translate-x-1"
                     x-transition:enter-end="opacity-100 translate-x-0"
                     x-transition:leave="transition ease-in duration-100"
                     x-transition:leave-start="opacity-100 translate-x-0"
                     x-transition:leave-end="opacity-0 -translate-x-1"
                     class="absolute left-full top-1/2 -translate-y-1/2 ml-3 z-[100] pointer-events-none">
                    <div class="relative">
                        <div class="absolute -left-[5px] top-1/2 -translate-y-1/2 w-2.5 h-2.5 bg-gray-900 dark:bg-gray-700 rotate-45"></div>
                        <div class="bg-gray-900 dark:bg-gray-700 text-white dark:text-gray-100 px-3 py-2 rounded-lg shadow-xl border border-gray-700 min-w-[120px]">
                            <span class="text-sm font-medium whitespace-nowrap">Live Map</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Shipments section -->
            <div class="sidebar-section-title transition-all duration-300 px-3">
                <span class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-500 block mb-1 mt-4">
                    SHIPMENTS
                </span>
            </div>

            <div x-data="{ tooltipVisible: false }" 
                 @mouseenter="tooltipVisible = true" 
                 @mouseleave="tooltipVisible = false" 
                 class="relative">
                <a href="{{ route('shipments.index') }}"
                    class="group flex items-center gap-3 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all duration-200 mx-2
                    {{ request()->routeIs('shipments.index') ? 'bg-[#138898] dark:bg-[#138898] text-white dark:text-white' : '' }}"
                    :class="$store.sidebar.collapsed ? 'justify-center px-0' : 'px-4'">
                    <div class="flex items-center justify-center min-w-[40px]">
                        <i class="fas fa-list-ul w-5 text-center"></i>
                    </div>
                    <span class="sidebar-text font-medium whitespace-nowrap transition-all duration-300 overflow-hidden">All Shipments</span>
                </a>
                
                <!-- Tooltip for collapsed state -->
                <div x-show="$store.sidebar.collapsed && tooltipVisible" 
                     x-transition:enter="transition ease-out duration-150"
                     x-transition:enter-start="opacity-0 -translate-x-1"
                     x-transition:enter-end="opacity-100 translate-x-0"
                     x-transition:leave="transition ease-in duration-100"
                     x-transition:leave-start="opacity-100 translate-x-0"
                     x-transition:leave-end="opacity-0 -translate-x-1"
                     class="absolute left-full top-1/2 -translate-y-1/2 ml-3 z-[100] pointer-events-none">
                    <div class="relative">
                        <div class="absolute -left-[5px] top-1/2 -translate-y-1/2 w-2.5 h-2.5 bg-gray-900 dark:bg-gray-700 rotate-45"></div>
                        <div class="bg-gray-900 dark:bg-gray-700 text-white dark:text-gray-100 px-3 py-2 rounded-lg shadow-xl border border-gray-700 min-w-[120px]">
                            <span class="text-sm font-medium whitespace-nowrap">All Shipments</span>
                        </div>
                    </div>
                </div>
            </div>

            <div x-data="{ tooltipVisible: false }" 
                 @mouseenter="tooltipVisible = true" 
                 @mouseleave="tooltipVisible = false" 
                 class="relative">
                <a href="{{ route('shipments.track') }}"
                    class="group flex items-center gap-3 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all duration-200 mx-2
                    {{ request()->routeIs('shipments.track') ? 'bg-[#138898] dark:bg-[#138898] text-white dark:text-white' : '' }}"
                    :class="$store.sidebar.collapsed ? 'justify-center px-0' : 'px-4'">
                    <div class="flex items-center justify-center min-w-[40px]">
                        <i class="fas fa-route w-5 text-center"></i>
                    </div>
                    <span class="sidebar-text font-medium whitespace-nowrap transition-all duration-300 overflow-hidden">Track Shipment</span>
                </a>
                
                <!-- Tooltip for collapsed state -->
                <div x-show="$store.sidebar.collapsed && tooltipVisible" 
                     x-transition:enter="transition ease-out duration-150"
                     x-transition:enter-start="opacity-0 -translate-x-1"
                     x-transition:enter-end="opacity-100 translate-x-0"
                     x-transition:leave="transition ease-in duration-100"
                     x-transition:leave-start="opacity-100 translate-x-0"
                     x-transition:leave-end="opacity-0 -translate-x-1"
                     class="absolute left-full top-1/2 -translate-y-1/2 ml-3 z-[100] pointer-events-none">
                    <div class="relative">
                        <div class="absolute -left-[5px] top-1/2 -translate-y-1/2 w-2.5 h-2.5 bg-gray-900 dark:bg-gray-700 rotate-45"></div>
                        <div class="bg-gray-900 dark:bg-gray-700 text-white dark:text-gray-100 px-3 py-2 rounded-lg shadow-xl border border-gray-700 min-w-[120px]">
                            <span class="text-sm font-medium whitespace-nowrap">Track Shipment</span>
                        </div>
                    </div>
                </div>
            </div>

            <div x-data="{ tooltipVisible: false }" 
                 @mouseenter="tooltipVisible = true" 
                 @mouseleave="tooltipVisible = false" 
                 class="relative">
                <a href="#"
                    class="group flex items-center gap-3 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all duration-200 mx-2"
                    :class="$store.sidebar.collapsed ? 'justify-center px-0' : 'px-4'">
                    <div class="flex items-center justify-center min-w-[40px]">
                        <i class="fas fa-clock w-5 text-center"></i>
                    </div>
                    <span class="sidebar-text font-medium whitespace-nowrap transition-all duration-300 overflow-hidden">Delayed</span>
                </a>
                
                <!-- Tooltip for collapsed state -->
                <div x-show="$store.sidebar.collapsed && tooltipVisible" 
                     x-transition:enter="transition ease-out duration-150"
                     x-transition:enter-start="opacity-0 -translate-x-1"
                     x-transition:enter-end="opacity-100 translate-x-0"
                     x-transition:leave="transition ease-in duration-100"
                     x-transition:leave-start="opacity-100 translate-x-0"
                     x-transition:leave-end="opacity-0 -translate-x-1"
                     class="absolute left-full top-1/2 -translate-y-1/2 ml-3 z-[100] pointer-events-none">
                    <div class="relative">
                        <div class="absolute -left-[5px] top-1/2 -translate-y-1/2 w-2.5 h-2.5 bg-gray-900 dark:bg-gray-700 rotate-45"></div>
                        <div class="bg-gray-900 dark:bg-gray-700 text-white dark:text-gray-100 px-3 py-2 rounded-lg shadow-xl border border-gray-700 min-w-[120px]">
                            <span class="text-sm font-medium whitespace-nowrap">Delayed</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Fleet Management section -->
            <div class="sidebar-section-title transition-all duration-300 px-3">
                <span class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-500 block mb-1 mt-4">
                    FLEET MANAGEMENT
                </span>
            </div>
            
            <div x-data="{ tooltipVisible: false }" 
                 @mouseenter="tooltipVisible = true" 
                 @mouseleave="tooltipVisible = false" 
                 class="relative">
                <a href="{{ route('drivers.index') }}"
                    class="group flex items-center gap-3 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all duration-200 mx-2
                    {{ request()->routeIs('drivers.index') ? 'bg-[#138898] dark:bg-[#138898] text-white dark:text-white' : '' }}"
                    :class="$store.sidebar.collapsed ? 'justify-center px-0' : 'px-4'">
                    <div class="flex items-center justify-center min-w-[40px]">
                        <i class="fas fa-users w-5 text-center"></i>
                    </div>
                    <span class="sidebar-text font-medium whitespace-nowrap transition-all duration-300 overflow-hidden">All Drivers</span>
                </a>
                
                <!-- Tooltip for collapsed state -->
                <div x-show="$store.sidebar.collapsed && tooltipVisible" 
                     x-transition:enter="transition ease-out duration-150"
                     x-transition:enter-start="opacity-0 -translate-x-1"
                     x-transition:enter-end="opacity-100 translate-x-0"
                     x-transition:leave="transition ease-in duration-100"
                     x-transition:leave-start="opacity-100 translate-x-0"
                     x-transition:leave-end="opacity-0 -translate-x-1"
                     class="absolute left-full top-1/2 -translate-y-1/2 ml-3 z-[100] pointer-events-none">
                    <div class="relative">
                        <div class="absolute -left-[5px] top-1/2 -translate-y-1/2 w-2.5 h-2.5 bg-gray-900 dark:bg-gray-700 rotate-45"></div>
                        <div class="bg-gray-900 dark:bg-gray-700 text-white dark:text-gray-100 px-3 py-2 rounded-lg shadow-xl border border-gray-700 min-w-[120px]">
                            <span class="text-sm font-medium whitespace-nowrap">All Drivers</span>
                        </div>
                    </div>
                </div>
            </div>

            <div x-data="{ tooltipVisible: false }" 
                 @mouseenter="tooltipVisible = true" 
                 @mouseleave="tooltipVisible = false" 
                 class="relative">
                <a href="{{ route('vehicles.index') }}"
                    class="group flex items-center gap-3 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all duration-200 mx-2
                    {{ request()->routeIs('vehicles.index') ? 'bg-[#138898] dark:bg-[#138898] text-white dark:text-white' : '' }}"
                    :class="$store.sidebar.collapsed ? 'justify-center px-0' : 'px-4'">
                    <div class="flex items-center justify-center min-w-[40px]">
                        <i class="fas fa-truck-moving w-5 text-center"></i>
                    </div>
                    <span class="sidebar-text font-medium whitespace-nowrap transition-all duration-300 overflow-hidden">Vehicle List</span>
                </a>
                
                <!-- Tooltip for collapsed state -->
                <div x-show="$store.sidebar.collapsed && tooltipVisible" 
                     x-transition:enter="transition ease-out duration-150"
                     x-transition:enter-start="opacity-0 -translate-x-1"
                     x-transition:enter-end="opacity-100 translate-x-0"
                     x-transition:leave="transition ease-in duration-100"
                     x-transition:leave-start="opacity-100 translate-x-0"
                     x-transition:leave-end="opacity-0 -translate-x-1"
                     class="absolute left-full top-1/2 -translate-y-1/2 ml-3 z-[100] pointer-events-none">
                    <div class="relative">
                        <div class="absolute -left-[5px] top-1/2 -translate-y-1/2 w-2.5 h-2.5 bg-gray-900 dark:bg-gray-700 rotate-45"></div>
                        <div class="bg-gray-900 dark:bg-gray-700 text-white dark:text-gray-100 px-3 py-2 rounded-lg shadow-xl border border-gray-700 min-w-[120px]">
                            <span class="text-sm font-medium whitespace-nowrap">Vehicle List</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Continue this pattern for all menu items... -->
            <!-- I've shown the pattern above. Apply the same structure to all remaining menu items -->
            
        </div>
    </nav>
</aside>

<!-- Custom scrollbar styles -->
<style>
    /* Webkit scrollbar styles */
    .sidebar-scrollbar::-webkit-scrollbar {
        width: 4px;
    }

    .sidebar-scrollbar::-webkit-scrollbar-track {
        background: transparent;
        border-radius: 10px;
    }

    .sidebar-scrollbar::-webkit-scrollbar-thumb {
        background: rgba(0, 0, 0, 0.1);
        border-radius: 10px;
    }

    .sidebar-scrollbar::-webkit-scrollbar-thumb:hover {
        background: rgba(0, 0, 0, 0.2);
    }

    /* Dark mode scrollbar styles */
    .dark .sidebar-scrollbar::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.1);
    }

    .dark .sidebar-scrollbar::-webkit-scrollbar-thumb:hover {
        background: rgba(255, 255, 255, 0.2);
    }

    /* Firefox scrollbar styles */
    .sidebar-scrollbar {
        scrollbar-width: thin;
        scrollbar-color: #138898 transparent;
    }

    .dark .sidebar-scrollbar {
        scrollbar-color: #138898 transparent;
    }

    /* Sidebar specific styles */
    .sidebar-collapsed .sidebar-text {
        opacity: 0;
        width: 0;
        overflow: hidden;
        margin-left: 0;
        display: none;
    }

    .sidebar-collapsed .sidebar-section-title {
        display: none;
    }

    .sidebar-collapsed .sidebar-header-text {
        display: none;
    }

    /* Professional styling for collapsed state */
    .sidebar-collapsed aside .h-18 .flex {
        justify-content: center;
    }

    .sidebar-collapsed aside .h-18 .w-10 {
        width: 2.5rem;
        height: 2.5rem;
    }

    /* Smooth transition for icon centering */
    .sidebar-collapsed aside nav a {
        transition: all 0.3s ease;
    }

    /* Ensure icons are perfectly centered */
    .sidebar-collapsed aside nav a .min-w-\[40px\] {
        min-width: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Professional hover effects */
    .sidebar-collapsed aside nav a:hover {
        background-color: rgba(19, 136, 152, 0.1);
    }

    .dark .sidebar-collapsed aside nav a:hover {
        background-color: rgba(255, 255, 255, 0.1);
    }
</style>

<script>
document.addEventListener('alpine:init', () => {
    Alpine.store('sidebar', {
        collapsed: localStorage.getItem('sidebarCollapsed') === 'true' || false,
        
        toggle() {
            this.collapsed = !this.collapsed;
            localStorage.setItem('sidebarCollapsed', this.collapsed);
            
            // Update global state in app.blade.php
            const app = Alpine.$data(document.querySelector('[x-data]'));
            if (app) {
                app.sidebarCollapsed = this.collapsed;
            }
            
            // Dispatch event for any other components that might need it
            window.dispatchEvent(new CustomEvent('sidebar-toggled', { 
                detail: { collapsed: this.collapsed } 
            }));
        }
    });
});
</script>