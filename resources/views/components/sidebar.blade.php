<aside
    class="fixed left-0 top-0 h-full bg-[#E4EBE7] dark:bg-[#1f2431] dark:border-gray-800 flex flex-col transition-all duration-300 z-40"
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

            <!-- Menu Items -->
            <div x-data="{ tooltipVisible: false }" @mouseenter="tooltipVisible = true" @mouseleave="tooltipVisible = false" class="relative">
                <a href="{{ route('dashboard') }}" 
                   class="group flex items-center gap-3 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all duration-200 mx-2
                   {{ request()->routeIs('dashboard') ? 'bg-[#138898] dark:bg-[#138898] text-white dark:text-white' : '' }}"
                   :class="$store.sidebar.collapsed ? 'justify-center px-0' : 'px-4'">
                    <div class="flex items-center justify-center min-w-[40px]">
                        <i class="fas fa-chart-pie w-5 text-center"></i>
                    </div>
                    <span class="sidebar-text font-medium whitespace-nowrap transition-all duration-300 overflow-hidden">Overview</span>
                </a>
                <div x-show="$store.sidebar.collapsed && tooltipVisible"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 translate-x-2"
                     x-transition:enter-end="opacity-100 translate-x-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 translate-x-0"
                     x-transition:leave-end="opacity-0 translate-x-2"
                     class="absolute left-full top-1/2 -translate-y-1/2 ml-3 px-3 py-2 bg-gray-900 dark:bg-gray-800 text-white text-sm font-medium rounded-lg whitespace-nowrap shadow-xl border border-gray-700/50"
                     style="pointer-events: none; z-index: 9999;">
                    <span class="block">Overview</span>
                    <div class="absolute right-full top-1/2 -translate-y-1/2 w-0 h-0 border-t-[6px] border-t-transparent border-b-[6px] border-b-transparent border-r-[6px] border-r-gray-900 dark:border-r-gray-800"></div>
                </div>
            </div>

            <div x-data="{ tooltipVisible: false }" @mouseenter="tooltipVisible = true" @mouseleave="tooltipVisible = false" class="relative">
                <a href="#" class="group flex items-center gap-3 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all duration-200 mx-2"
                   :class="$store.sidebar.collapsed ? 'justify-center px-0' : 'px-4'">
                    <div class="flex items-center justify-center min-w-[40px]">
                        <i class="fas fa-chart-line w-5 text-center"></i>
                    </div>
                    <span class="sidebar-text font-medium whitespace-nowrap transition-all duration-300 overflow-hidden">Fleet Status</span>
                </a>
                <div x-show="$store.sidebar.collapsed && tooltipVisible"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 translate-x-2"
                     x-transition:enter-end="opacity-100 translate-x-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 translate-x-0"
                     x-transition:leave-end="opacity-0 translate-x-2"
                     class="absolute left-full top-1/2 -translate-y-1/2 ml-3 px-3 py-2 bg-gray-900 dark:bg-gray-800 text-white text-sm font-medium rounded-lg whitespace-nowrap shadow-xl border border-gray-700/50"
                     style="pointer-events: none; z-index: 9999;">
                    <span class="block">Fleet Status</span>
                    <div class="absolute right-full top-1/2 -translate-y-1/2 w-0 h-0 border-t-[6px] border-t-transparent border-b-[6px] border-b-transparent border-r-[6px] border-r-gray-900 dark:border-r-gray-800"></div>
                </div>
            </div>

            <div x-data="{ tooltipVisible: false }" @mouseenter="tooltipVisible = true" @mouseleave="tooltipVisible = false" class="relative">
                <a href="{{ route('live-map') }}"
                   class="group flex items-center gap-3 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all duration-200 mx-2
                   {{ request()->routeIs('live-map') ? 'bg-[#138898] dark:bg-[#138898] text-white dark:text-white' : '' }}"
                   :class="$store.sidebar.collapsed ? 'justify-center px-0' : 'px-4'">
                    <div class="flex items-center justify-center min-w-[40px]">
                        <i class="fas fa-map-marker-alt w-5 text-center"></i>
                    </div>
                    <span class="sidebar-text font-medium whitespace-nowrap transition-all duration-300 overflow-hidden">Live Map</span>
                </a>
                <div x-show="$store.sidebar.collapsed && tooltipVisible"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 translate-x-2"
                     x-transition:enter-end="opacity-100 translate-x-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 translate-x-0"
                     x-transition:leave-end="opacity-0 translate-x-2"
                     class="absolute left-full top-1/2 -translate-y-1/2 ml-3 px-3 py-2 bg-gray-900 dark:bg-gray-800 text-white text-sm font-medium rounded-lg whitespace-nowrap shadow-xl border border-gray-700/50"
                     style="pointer-events: none; z-index: 9999;">
                    <span class="block">Live Map</span>
                    <div class="absolute right-full top-1/2 -translate-y-1/2 w-0 h-0 border-t-[6px] border-t-transparent border-b-[6px] border-b-transparent border-r-[6px] border-r-gray-900 dark:border-r-gray-800"></div>
                </div>
            </div>

            <!-- Shipments section -->
            <div class="sidebar-section-title transition-all duration-300 px-3">
                <span class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-500 block mb-1 mt-4">SHIPMENTS</span>
            </div>

            <div x-data="{ tooltipVisible: false }" @mouseenter="tooltipVisible = true" @mouseleave="tooltipVisible = false" class="relative">
                <a href="{{ route('shipments.index') }}"
                   class="group flex items-center gap-3 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all duration-200 mx-2
                   {{ request()->routeIs('shipments.index') ? 'bg-[#138898] dark:bg-[#138898] text-white dark:text-white' : '' }}"
                   :class="$store.sidebar.collapsed ? 'justify-center px-0' : 'px-4'">
                    <div class="flex items-center justify-center min-w-[40px]">
                        <i class="fas fa-list-ul w-5 text-center"></i>
                    </div>
                    <span class="sidebar-text font-medium whitespace-nowrap transition-all duration-300 overflow-hidden">All Shipments</span>
                </a>
                <div x-show="$store.sidebar.collapsed && tooltipVisible"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 translate-x-2"
                     x-transition:enter-end="opacity-100 translate-x-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 translate-x-0"
                     x-transition:leave-end="opacity-0 translate-x-2"
                     class="absolute left-full top-1/2 -translate-y-1/2 ml-3 px-3 py-2 bg-gray-900 dark:bg-gray-800 text-white text-sm font-medium rounded-lg whitespace-nowrap shadow-xl border border-gray-700/50"
                     style="pointer-events: none; z-index: 9999;">
                    <span class="block">All Shipments</span>
                    <div class="absolute right-full top-1/2 -translate-y-1/2 w-0 h-0 border-t-[6px] border-t-transparent border-b-[6px] border-b-transparent border-r-[6px] border-r-gray-900 dark:border-r-gray-800"></div>
                </div>
            </div>

            <div x-data="{ tooltipVisible: false }" @mouseenter="tooltipVisible = true" @mouseleave="tooltipVisible = false" class="relative">
                <a href="{{ route('shipments.track') }}"
                   class="group flex items-center gap-3 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all duration-200 mx-2
                   {{ request()->routeIs('shipments.track') ? 'bg-[#138898] dark:bg-[#138898] text-white dark:text-white' : '' }}"
                   :class="$store.sidebar.collapsed ? 'justify-center px-0' : 'px-4'">
                    <div class="flex items-center justify-center min-w-[40px]">
                        <i class="fas fa-route w-5 text-center"></i>
                    </div>
                    <span class="sidebar-text font-medium whitespace-nowrap transition-all duration-300 overflow-hidden">Track Shipment</span>
                </a>
                <div x-show="$store.sidebar.collapsed && tooltipVisible"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 translate-x-2"
                     x-transition:enter-end="opacity-100 translate-x-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 translate-x-0"
                     x-transition:leave-end="opacity-0 translate-x-2"
                     class="absolute left-full top-1/2 -translate-y-1/2 ml-3 px-3 py-2 bg-gray-900 dark:bg-gray-800 text-white text-sm font-medium rounded-lg whitespace-nowrap shadow-xl border border-gray-700/50"
                     style="pointer-events: none; z-index: 9999;">
                    <span class="block">Track Shipment</span>
                    <div class="absolute right-full top-1/2 -translate-y-1/2 w-0 h-0 border-t-[6px] border-t-transparent border-b-[6px] border-b-transparent border-r-[6px] border-r-gray-900 dark:border-r-gray-800"></div>
                </div>
            </div>

            <div x-data="{ tooltipVisible: false }" @mouseenter="tooltipVisible = true" @mouseleave="tooltipVisible = false" class="relative">
                <a href="#" class="group flex items-center gap-3 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all duration-200 mx-2"
                   :class="$store.sidebar.collapsed ? 'justify-center px-0' : 'px-4'">
                    <div class="flex items-center justify-center min-w-[40px]">
                        <i class="fas fa-clock w-5 text-center"></i>
                    </div>
                    <span class="sidebar-text font-medium whitespace-nowrap transition-all duration-300 overflow-hidden">Delayed</span>
                </a>
                <div x-show="$store.sidebar.collapsed && tooltipVisible"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 translate-x-2"
                     x-transition:enter-end="opacity-100 translate-x-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 translate-x-0"
                     x-transition:leave-end="opacity-0 translate-x-2"
                     class="absolute left-full top-1/2 -translate-y-1/2 ml-3 px-3 py-2 bg-gray-900 dark:bg-gray-800 text-white text-sm font-medium rounded-lg whitespace-nowrap shadow-xl border border-gray-700/50"
                     style="pointer-events: none; z-index: 9999;">
                    <span class="block">Delayed</span>
                    <div class="absolute right-full top-1/2 -translate-y-1/2 w-0 h-0 border-t-[6px] border-t-transparent border-b-[6px] border-b-transparent border-r-[6px] border-r-gray-900 dark:border-r-gray-800"></div>
                </div>
            </div>

            <!-- Fleet Management section -->
            <div class="sidebar-section-title transition-all duration-300 px-3">
                <span class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-500 block mb-1 mt-4">FLEET MANAGEMENT</span>
            </div>

            <div x-data="{ tooltipVisible: false }" @mouseenter="tooltipVisible = true" @mouseleave="tooltipVisible = false" class="relative">
                <a href="{{ route('drivers.index') }}"
                   class="group flex items-center gap-3 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all duration-200 mx-2
                   {{ request()->routeIs('drivers.index') ? 'bg-[#138898] dark:bg-[#138898] text-white dark:text-white' : '' }}"
                   :class="$store.sidebar.collapsed ? 'justify-center px-0' : 'px-4'">
                    <div class="flex items-center justify-center min-w-[40px]">
                        <i class="fas fa-users w-5 text-center"></i>
                    </div>
                    <span class="sidebar-text font-medium whitespace-nowrap transition-all duration-300 overflow-hidden">All Drivers</span>
                </a>
                <div x-show="$store.sidebar.collapsed && tooltipVisible"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 translate-x-2"
                     x-transition:enter-end="opacity-100 translate-x-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 translate-x-0"
                     x-transition:leave-end="opacity-0 translate-x-2"
                     class="absolute left-full top-1/2 -translate-y-1/2 ml-3 px-3 py-2 bg-gray-900 dark:bg-gray-800 text-white text-sm font-medium rounded-lg whitespace-nowrap shadow-xl border border-gray-700/50"
                     style="pointer-events: none; z-index: 9999;">
                    <span class="block">All Drivers</span>
                    <div class="absolute right-full top-1/2 -translate-y-1/2 w-0 h-0 border-t-[6px] border-t-transparent border-b-[6px] border-b-transparent border-r-[6px] border-r-gray-900 dark:border-r-gray-800"></div>
                </div>
            </div>

            <div x-data="{ tooltipVisible: false }" @mouseenter="tooltipVisible = true" @mouseleave="tooltipVisible = false" class="relative">
                <a href="{{ route('vehicles.index') }}"
                   class="group flex items-center gap-3 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all duration-200 mx-2
                   {{ request()->routeIs('vehicles.index') ? 'bg-[#138898] dark:bg-[#138898] text-white dark:text-white' : '' }}"
                   :class="$store.sidebar.collapsed ? 'justify-center px-0' : 'px-4'">
                    <div class="flex items-center justify-center min-w-[40px]">
                        <i class="fas fa-truck-moving w-5 text-center"></i>
                    </div>
                    <span class="sidebar-text font-medium whitespace-nowrap transition-all duration-300 overflow-hidden">Vehicle List</span>
                </a>
                <div x-show="$store.sidebar.collapsed && tooltipVisible"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 translate-x-2"
                     x-transition:enter-end="opacity-100 translate-x-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 translate-x-0"
                     x-transition:leave-end="opacity-0 translate-x-2"
                     class="absolute left-full top-1/2 -translate-y-1/2 ml-3 px-3 py-2 bg-gray-900 dark:bg-gray-800 text-white text-sm font-medium rounded-lg whitespace-nowrap shadow-xl border border-gray-700/50"
                     style="pointer-events: none; z-index: 9999;">
                    <span class="block">Vehicle List</span>
                    <div class="absolute right-full top-1/2 -translate-y-1/2 w-0 h-0 border-t-[6px] border-t-transparent border-b-[6px] border-b-transparent border-r-[6px] border-r-gray-900 dark:border-r-gray-800"></div>
                </div>
            </div>

            <div x-data="{ tooltipVisible: false }" @mouseenter="tooltipVisible = true" @mouseleave="tooltipVisible = false" class="relative">
                <a href="{{ route('driver-assignments.index') }}"
                   class="group flex items-center gap-3 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all duration-200 mx-2
                   {{ request()->routeIs('driver-assignments.index') ? 'bg-[#138898] dark:bg-[#138898] text-white dark:text-white' : '' }}"
                   :class="$store.sidebar.collapsed ? 'justify-center px-0' : 'px-4'">
                    <div class="flex items-center justify-center min-w-[40px]">
                        <i class="fas fa-user w-5 text-center"></i>
                    </div>
                    <span class="sidebar-text font-medium whitespace-nowrap transition-all duration-300 overflow-hidden">Driver Assignments</span>
                </a>
                <div x-show="$store.sidebar.collapsed && tooltipVisible"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 translate-x-2"
                     x-transition:enter-end="opacity-100 translate-x-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 translate-x-0"
                     x-transition:leave-end="opacity-0 translate-x-2"
                     class="absolute left-full top-1/2 -translate-y-1/2 ml-3 px-3 py-2 bg-gray-900 dark:bg-gray-800 text-white text-sm font-medium rounded-lg whitespace-nowrap shadow-xl border border-gray-700/50"
                     style="pointer-events: none; z-index: 9999;">
                    <span class="block">Driver Assignments</span>
                    <div class="absolute right-full top-1/2 -translate-y-1/2 w-0 h-0 border-t-[6px] border-t-transparent border-b-[6px] border-b-transparent border-r-[6px] border-r-gray-900 dark:border-r-gray-800"></div>
                </div>
            </div>

            <div x-data="{ tooltipVisible: false }" @mouseenter="tooltipVisible = true" @mouseleave="tooltipVisible = false" class="relative">
                <a href="{{ route('fuel-maintenance.index') }}"
                   class="group flex items-center gap-3 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all duration-200 mx-2
                   {{ request()->routeIs('fuel-maintenance.index') ? 'bg-[#138898] dark:bg-[#138898] text-white dark:text-white' : '' }}"
                   :class="$store.sidebar.collapsed ? 'justify-center px-0' : 'px-4'">
                    <div class="flex items-center justify-center min-w-[40px]">
                        <i class="fas fa-gas-pump w-5 text-center"></i>
                    </div>
                    <span class="sidebar-text font-medium whitespace-nowrap transition-all duration-300 overflow-hidden">Fuel & Maintenance</span>
                </a>
                <div x-show="$store.sidebar.collapsed && tooltipVisible"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 translate-x-2"
                     x-transition:enter-end="opacity-100 translate-x-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 translate-x-0"
                     x-transition:leave-end="opacity-0 translate-x-2"
                     class="absolute left-full top-1/2 -translate-y-1/2 ml-3 px-3 py-2 bg-gray-900 dark:bg-gray-800 text-white text-sm font-medium rounded-lg whitespace-nowrap shadow-xl border border-gray-700/50"
                     style="pointer-events: none; z-index: 9999;">
                    <span class="block">Fuel & Maintenance</span>
                    <div class="absolute right-full top-1/2 -translate-y-1/2 w-0 h-0 border-t-[6px] border-t-transparent border-b-[6px] border-b-transparent border-r-[6px] border-r-gray-900 dark:border-r-gray-800"></div>
                </div>
            </div>

            <!-- Orders section -->
            <div class="sidebar-section-title transition-all duration-300 px-3">
                <span class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-500 block mb-1 mt-4">ORDERS</span>
            </div>

            <div x-data="{ tooltipVisible: false }" @mouseenter="tooltipVisible = true" @mouseleave="tooltipVisible = false" class="relative">
                <a href="#" class="group flex items-center gap-3 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all duration-200 mx-2"
                   :class="$store.sidebar.collapsed ? 'justify-center px-0' : 'px-4'">
                    <div class="flex items-center justify-center min-w-[40px]">
                        <i class="fas fa-clipboard-list w-5 text-center"></i>
                    </div>
                    <span class="sidebar-text font-medium whitespace-nowrap transition-all duration-300 overflow-hidden">All Orders</span>
                </a>
                <div x-show="$store.sidebar.collapsed && tooltipVisible"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 translate-x-2"
                     x-transition:enter-end="opacity-100 translate-x-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 translate-x-0"
                     x-transition:leave-end="opacity-0 translate-x-2"
                     class="absolute left-full top-1/2 -translate-y-1/2 ml-3 px-3 py-2 bg-gray-900 dark:bg-gray-800 text-white text-sm font-medium rounded-lg whitespace-nowrap shadow-xl border border-gray-700/50"
                     style="pointer-events: none; z-index: 9999;">
                    <span class="block">All Orders</span>
                    <div class="absolute right-full top-1/2 -translate-y-1/2 w-0 h-0 border-t-[6px] border-t-transparent border-b-[6px] border-b-transparent border-r-[6px] border-r-gray-900 dark:border-r-gray-800"></div>
                </div>
            </div>

            <div x-data="{ tooltipVisible: false }" @mouseenter="tooltipVisible = true" @mouseleave="tooltipVisible = false" class="relative">
                <a href="#" class="group flex items-center gap-3 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all duration-200 mx-2"
                   :class="$store.sidebar.collapsed ? 'justify-center px-0' : 'px-4'">
                    <div class="flex items-center justify-center min-w-[40px]">
                        <i class="fas fa-calendar-alt w-5 text-center"></i>
                    </div>
                    <span class="sidebar-text font-medium whitespace-nowrap transition-all duration-300 overflow-hidden">Scheduled Deliveries</span>
                </a>
                <div x-show="$store.sidebar.collapsed && tooltipVisible"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 translate-x-2"
                     x-transition:enter-end="opacity-100 translate-x-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 translate-x-0"
                     x-transition:leave-end="opacity-0 translate-x-2"
                     class="absolute left-full top-1/2 -translate-y-1/2 ml-3 px-3 py-2 bg-gray-900 dark:bg-gray-800 text-white text-sm font-medium rounded-lg whitespace-nowrap shadow-xl border border-gray-700/50"
                     style="pointer-events: none; z-index: 9999;">
                    <span class="block">Scheduled Deliveries</span>
                    <div class="absolute right-full top-1/2 -translate-y-1/2 w-0 h-0 border-t-[6px] border-t-transparent border-b-[6px] border-b-transparent border-r-[6px] border-r-gray-900 dark:border-r-gray-800"></div>
                </div>
            </div>

            <div x-data="{ tooltipVisible: false }" @mouseenter="tooltipVisible = true" @mouseleave="tooltipVisible = false" class="relative">
                <a href="#" class="group flex items-center gap-3 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all duration-200 mx-2"
                   :class="$store.sidebar.collapsed ? 'justify-center px-0' : 'px-4'">
                    <div class="flex items-center justify-center min-w-[40px]">
                        <i class="fas fa-undo w-5 text-center"></i>
                    </div>
                    <span class="sidebar-text font-medium whitespace-nowrap transition-all duration-300 overflow-hidden">Returns</span>
                </a>
                <div x-show="$store.sidebar.collapsed && tooltipVisible"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 translate-x-2"
                     x-transition:enter-end="opacity-100 translate-x-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 translate-x-0"
                     x-transition:leave-end="opacity-0 translate-x-2"
                     class="absolute left-full top-1/2 -translate-y-1/2 ml-3 px-3 py-2 bg-gray-900 dark:bg-gray-800 text-white text-sm font-medium rounded-lg whitespace-nowrap shadow-xl border border-gray-700/50"
                     style="pointer-events: none; z-index: 9999;">
                    <span class="block">Returns</span>
                    <div class="absolute right-full top-1/2 -translate-y-1/2 w-0 h-0 border-t-[6px] border-t-transparent border-b-[6px] border-b-transparent border-r-[6px] border-r-gray-900 dark:border-r-gray-800"></div>
                </div>
            </div>

            <div x-data="{ tooltipVisible: false }" @mouseenter="tooltipVisible = true" @mouseleave="tooltipVisible = false" class="relative">
                <a href="#" class="group flex items-center gap-3 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all duration-200 mx-2"
                   :class="$store.sidebar.collapsed ? 'justify-center px-0' : 'px-4'">
                    <div class="flex items-center justify-center min-w-[40px]">
                        <i class="fas fa-ban w-5 text-center"></i>
                    </div>
                    <span class="sidebar-text font-medium whitespace-nowrap transition-all duration-300 overflow-hidden">Cancellations</span>
                </a>
                <div x-show="$store.sidebar.collapsed && tooltipVisible"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 translate-x-2"
                     x-transition:enter-end="opacity-100 translate-x-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 translate-x-0"
                     x-transition:leave-end="opacity-0 translate-x-2"
                     class="absolute left-full top-1/2 -translate-y-1/2 ml-3 px-3 py-2 bg-gray-900 dark:bg-gray-800 text-white text-sm font-medium rounded-lg whitespace-nowrap shadow-xl border border-gray-700/50"
                     style="pointer-events: none; z-index: 9999;">
                    <span class="block">Cancellations</span>
                    <div class="absolute right-full top-1/2 -translate-y-1/2 w-0 h-0 border-t-[6px] border-t-transparent border-b-[6px] border-b-transparent border-r-[6px] border-r-gray-900 dark:border-r-gray-800"></div>
                </div>
            </div>

            <!-- Vendors & Clients section -->
            <div class="sidebar-section-title transition-all duration-300 px-3">
                <span class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-500 block mb-1 mt-4">VENDORS & CLIENTS</span>
            </div>

            <div x-data="{ tooltipVisible: false }" @mouseenter="tooltipVisible = true" @mouseleave="tooltipVisible = false" class="relative">
                <a href="#" class="group flex items-center gap-3 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all duration-200 mx-2"
                   :class="$store.sidebar.collapsed ? 'justify-center px-0' : 'px-4'">
                    <div class="flex items-center justify-center min-w-[40px]">
                        <i class="fas fa-building w-5 text-center"></i>
                    </div>
                    <span class="sidebar-text font-medium whitespace-nowrap transition-all duration-300 overflow-hidden">Vendors Directory</span>
                </a>
                <div x-show="$store.sidebar.collapsed && tooltipVisible"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 translate-x-2"
                     x-transition:enter-end="opacity-100 translate-x-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 translate-x-0"
                     x-transition:leave-end="opacity-0 translate-x-2"
                     class="absolute left-full top-1/2 -translate-y-1/2 ml-3 px-3 py-2 bg-gray-900 dark:bg-gray-800 text-white text-sm font-medium rounded-lg whitespace-nowrap shadow-xl border border-gray-700/50"
                     style="pointer-events: none; z-index: 9999;">
                    <span class="block">Vendors Directory</span>
                    <div class="absolute right-full top-1/2 -translate-y-1/2 w-0 h-0 border-t-[6px] border-t-transparent border-b-[6px] border-b-transparent border-r-[6px] border-r-gray-900 dark:border-r-gray-800"></div>
                </div>
            </div>

            <div x-data="{ tooltipVisible: false }" @mouseenter="tooltipVisible = true" @mouseleave="tooltipVisible = false" class="relative">
                <a href="#" class="group flex items-center gap-3 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all duration-200 mx-2"
                   :class="$store.sidebar.collapsed ? 'justify-center px-0' : 'px-4'">
                    <div class="flex items-center justify-center min-w-[40px]">
                        <i class="fas fa-user-plus w-5 text-center"></i>
                    </div>
                    <span class="sidebar-text font-medium whitespace-nowrap transition-all duration-300 overflow-hidden">Add Vendor</span>
                </a>
                <div x-show="$store.sidebar.collapsed && tooltipVisible"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 translate-x-2"
                     x-transition:enter-end="opacity-100 translate-x-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 translate-x-0"
                     x-transition:leave-end="opacity-0 translate-x-2"
                     class="absolute left-full top-1/2 -translate-y-1/2 ml-3 px-3 py-2 bg-gray-900 dark:bg-gray-800 text-white text-sm font-medium rounded-lg whitespace-nowrap shadow-xl border border-gray-700/50"
                     style="pointer-events: none; z-index: 9999;">
                    <span class="block">Add Vendor</span>
                    <div class="absolute right-full top-1/2 -translate-y-1/2 w-0 h-0 border-t-[6px] border-t-transparent border-b-[6px] border-b-transparent border-r-[6px] border-r-gray-900 dark:border-r-gray-800"></div>
                </div>
            </div>

            <div x-data="{ tooltipVisible: false }" @mouseenter="tooltipVisible = true" @mouseleave="tooltipVisible = false" class="relative">
                <a href="#" class="group flex items-center gap-3 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all duration-200 mx-2"
                   :class="$store.sidebar.collapsed ? 'justify-center px-0' : 'px-4'">
                    <div class="flex items-center justify-center min-w-[40px]">
                        <i class="fas fa-users w-5 text-center"></i>
                    </div>
                    <span class="sidebar-text font-medium whitespace-nowrap transition-all duration-300 overflow-hidden">Client List</span>
                </a>
                <div x-show="$store.sidebar.collapsed && tooltipVisible"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 translate-x-2"
                     x-transition:enter-end="opacity-100 translate-x-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 translate-x-0"
                     x-transition:leave-end="opacity-0 translate-x-2"
                     class="absolute left-full top-1/2 -translate-y-1/2 ml-3 px-3 py-2 bg-gray-900 dark:bg-gray-800 text-white text-sm font-medium rounded-lg whitespace-nowrap shadow-xl border border-gray-700/50"
                     style="pointer-events: none; z-index: 9999;">
                    <span class="block">Client List</span>
                    <div class="absolute right-full top-1/2 -translate-y-1/2 w-0 h-0 border-t-[6px] border-t-transparent border-b-[6px] border-b-transparent border-r-[6px] border-r-gray-900 dark:border-r-gray-800"></div>
                </div>
            </div>

            <div x-data="{ tooltipVisible: false }" @mouseenter="tooltipVisible = true" @mouseleave="tooltipVisible = false" class="relative">
                <a href="#" class="group flex items-center gap-3 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all duration-200 mx-2"
                   :class="$store.sidebar.collapsed ? 'justify-center px-0' : 'px-4'">
                    <div class="flex items-center justify-center min-w-[40px]">
                        <i class="fas fa-comment-dots w-5 text-center"></i>
                    </div>
                    <span class="sidebar-text font-medium whitespace-nowrap transition-all duration-300 overflow-hidden">Client Feedback</span>
                </a>
                <div x-show="$store.sidebar.collapsed && tooltipVisible"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 translate-x-2"
                     x-transition:enter-end="opacity-100 translate-x-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 translate-x-0"
                     x-transition:leave-end="opacity-0 translate-x-2"
                     class="absolute left-full top-1/2 -translate-y-1/2 ml-3 px-3 py-2 bg-gray-900 dark:bg-gray-800 text-white text-sm font-medium rounded-lg whitespace-nowrap shadow-xl border border-gray-700/50"
                     style="pointer-events: none; z-index: 9999;">
                    <span class="block">Client Feedback</span>
                    <div class="absolute right-full top-1/2 -translate-y-1/2 w-0 h-0 border-t-[6px] border-t-transparent border-b-[6px] border-b-transparent border-r-[6px] border-r-gray-900 dark:border-r-gray-800"></div>
                </div>
            </div>

            <!-- Administration section -->
            <div class="sidebar-section-title transition-all duration-300 px-3">
                <span class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-500 block mb-1 mt-4">ADMINISTRATION</span>
            </div>

            <div x-data="{ tooltipVisible: false }" @mouseenter="tooltipVisible = true" @mouseleave="tooltipVisible = false" class="relative">
                <a href="#" class="group flex items-center gap-3 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all duration-200 mx-2"
                   :class="$store.sidebar.collapsed ? 'justify-center px-0' : 'px-4'">
                    <div class="flex items-center justify-center min-w-[40px]">
                        <i class="fas fa-file-invoice-dollar w-5 text-center"></i>
                    </div>
                    <span class="sidebar-text font-medium whitespace-nowrap transition-all duration-300 overflow-hidden">Invoicing & Billing</span>
                </a>
                <div x-show="$store.sidebar.collapsed && tooltipVisible"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 translate-x-2"
                     x-transition:enter-end="opacity-100 translate-x-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 translate-x-0"
                     x-transition:leave-end="opacity-0 translate-x-2"
                     class="absolute left-full top-1/2 -translate-y-1/2 ml-3 px-3 py-2 bg-gray-900 dark:bg-gray-800 text-white text-sm font-medium rounded-lg whitespace-nowrap shadow-xl border border-gray-700/50"
                     style="pointer-events: none; z-index: 9999;">
                    <span class="block">Invoicing & Billing</span>
                    <div class="absolute right-full top-1/2 -translate-y-1/2 w-0 h-0 border-t-[6px] border-t-transparent border-b-[6px] border-b-transparent border-r-[6px] border-r-gray-900 dark:border-r-gray-800"></div>
                </div>
            </div>

            <div x-data="{ tooltipVisible: false }" @mouseenter="tooltipVisible = true" @mouseleave="tooltipVisible = false" class="relative">
                <a href="#" class="group flex items-center gap-3 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all duration-200 mx-2"
                   :class="$store.sidebar.collapsed ? 'justify-center px-0' : 'px-4'">
                    <div class="flex items-center justify-center min-w-[40px]">
                        <i class="fas fa-chart-bar w-5 text-center"></i>
                    </div>
                    <span class="sidebar-text font-medium whitespace-nowrap transition-all duration-300 overflow-hidden">Reports & Analytics</span>
                </a>
                <div x-show="$store.sidebar.collapsed && tooltipVisible"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 translate-x-2"
                     x-transition:enter-end="opacity-100 translate-x-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 translate-x-0"
                     x-transition:leave-end="opacity-0 translate-x-2"
                     class="absolute left-full top-1/2 -translate-y-1/2 ml-3 px-3 py-2 bg-gray-900 dark:bg-gray-800 text-white text-sm font-medium rounded-lg whitespace-nowrap shadow-xl border border-gray-700/50"
                     style="pointer-events: none; z-index: 9999;">
                    <span class="block">Reports & Analytics</span>
                    <div class="absolute right-full top-1/2 -translate-y-1/2 w-0 h-0 border-t-[6px] border-t-transparent border-b-[6px] border-b-transparent border-r-[6px] border-r-gray-900 dark:border-r-gray-800"></div>
                </div>
            </div>

            <div x-data="{ tooltipVisible: false }" @mouseenter="tooltipVisible = true" @mouseleave="tooltipVisible = false" class="relative">
                <a href="#" class="group flex items-center gap-3 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all duration-200 mx-2"
                   :class="$store.sidebar.collapsed ? 'justify-center px-0' : 'px-4'">
                    <div class="flex items-center justify-center min-w-[40px]">
                        <i class="fas fa-user w-5 text-center"></i>
                    </div>
                    <span class="sidebar-text font-medium whitespace-nowrap transition-all duration-300 overflow-hidden">Add User</span>
                </a>
                <div x-show="$store.sidebar.collapsed && tooltipVisible"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 translate-x-2"
                     x-transition:enter-end="opacity-100 translate-x-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 translate-x-0"
                     x-transition:leave-end="opacity-0 translate-x-2"
                     class="absolute left-full top-1/2 -translate-y-1/2 ml-3 px-3 py-2 bg-gray-900 dark:bg-gray-800 text-white text-sm font-medium rounded-lg whitespace-nowrap shadow-xl border border-gray-700/50"
                     style="pointer-events: none; z-index: 9999;">
                    <span class="block">Add User</span>
                    <div class="absolute right-full top-1/2 -translate-y-1/2 w-0 h-0 border-t-[6px] border-t-transparent border-b-[6px] border-b-transparent border-r-[6px] border-r-gray-900 dark:border-r-gray-800"></div>
                </div>
            </div>

            <div x-data="{ tooltipVisible: false }" @mouseenter="tooltipVisible = true" @mouseleave="tooltipVisible = false" class="relative">
                <a href="#" class="group flex items-center gap-3 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all duration-200 mx-2"
                   :class="$store.sidebar.collapsed ? 'justify-center px-0' : 'px-4'">
                    <div class="flex items-center justify-center min-w-[40px]">
                        <i class="fas fa-user-cog w-5 text-center"></i>
                    </div>
                    <span class="sidebar-text font-medium whitespace-nowrap transition-all duration-300 overflow-hidden">User Management</span>
                </a>
                <div x-show="$store.sidebar.collapsed && tooltipVisible"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 translate-x-2"
                     x-transition:enter-end="opacity-100 translate-x-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 translate-x-0"
                     x-transition:leave-end="opacity-0 translate-x-2"
                     class="absolute left-full top-1/2 -translate-y-1/2 ml-3 px-3 py-2 bg-gray-900 dark:bg-gray-800 text-white text-sm font-medium rounded-lg whitespace-nowrap shadow-xl border border-gray-700/50"
                     style="pointer-events: none; z-index: 9999;">
                    <span class="block">User Management</span>
                    <div class="absolute right-full top-1/2 -translate-y-1/2 w-0 h-0 border-t-[6px] border-t-transparent border-b-[6px] border-b-transparent border-r-[6px] border-r-gray-900 dark:border-r-gray-800"></div>
                </div>
            </div>

        </div>
    </nav>
</aside>

<!-- Custom scrollbar styles -->
<style>
    .sidebar-scrollbar::-webkit-scrollbar { width: 4px; }
    .sidebar-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .sidebar-scrollbar::-webkit-scrollbar-thumb { background: rgba(0,0,0,0.1); border-radius: 10px; }
    .sidebar-scrollbar::-webkit-scrollbar-thumb:hover { background: rgba(0,0,0,0.2); }
    .dark .sidebar-scrollbar::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); }
    .dark .sidebar-scrollbar::-webkit-scrollbar-thumb:hover { background: rgba(255,255,255,0.2); }
</style>

<script>
document.addEventListener('alpine:init', () => {
    Alpine.store('sidebar', {
        collapsed: localStorage.getItem('sidebarCollapsed') === 'true' || false,
        
        toggle() {
            this.collapsed = !this.collapsed;
            localStorage.setItem('sidebarCollapsed', this.collapsed);
            
            const app = Alpine.$data(document.querySelector('[x-data]'));
            if (app) {
                app.sidebarCollapsed = this.collapsed;
            }
            
            window.dispatchEvent(new CustomEvent('sidebar-toggled', {
                detail: { collapsed: this.collapsed }
            }));
        }
    });
});
</script>