<aside class="fixed left-0 top-0 h-full bg-[#E4EBE7] dark:bg-[#1f2431] flex flex-col transition-all duration-300 z-40 md:relative"
      :class="{
        'w-16': $store.sidebar.collapsed,
        'w-64': !$store.sidebar.collapsed,
        '-translate-x-full md:translate-x-0': $store.sidebar.collapsed && window.innerWidth < 768,
        'translate-x-0': !$store.sidebar.collapsed || window.innerWidth >= 768
      }"
      x-data="{
        isMobile: window.innerWidth < 768,
        checkScreenSize() {
          this.isMobile = window.innerWidth < 768;
          if (this.isMobile && !$store.sidebar.collapsed) {
            $store.sidebar.collapsed = true;
          }
        }
      }"
      x-init="
        checkScreenSize();
        window.addEventListener('resize', checkScreenSize);
      ">
    
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
                     x-transition
                     class="absolute left-full top-1/2 -translate-y-1/2 ml-2 px-2 py-1 bg-gray-900 dark:bg-gray-700 text-white text-xs rounded whitespace-nowrap z-50 shadow-lg">
                    Overview
                </div>
            </div>

            <div x-data="{ tooltipVisible: false }" @mouseenter="tooltipVisible = true" @mouseleave="tooltipVisible = false" class="relative">
                <a href="#"
                    class="group flex items-center gap-3 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all duration-200 mx-2"
                    :class="$store.sidebar.collapsed ? 'justify-center px-0' : 'px-4'">
                    <div class="flex items-center justify-center min-w-[40px]">
                        <i class="fas fa-chart-line w-5 text-center"></i>
                    </div>
                    <span class="sidebar-text font-medium whitespace-nowrap transition-all duration-300 overflow-hidden">Fleet Status</span>
                </a>
                <div x-show="$store.sidebar.collapsed && tooltipVisible" 
                     x-transition
                     class="absolute left-full top-1/2 -translate-y-1/2 ml-2 px-2 py-1 bg-gray-900 dark:bg-gray-700 text-white text-xs rounded whitespace-nowrap z-50 shadow-lg">
                    Fleet Status
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
                     x-transition
                     class="absolute left-full top-1/2 -translate-y-1/2 ml-2 px-2 py-1 bg-gray-900 dark:bg-gray-700 text-white text-xs rounded whitespace-nowrap z-50 shadow-lg">
                    Live Map
                </div>
            </div>

            <!-- Shipments section -->
            <div class="sidebar-section-title transition-all duration-300 px-3">
                <span class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-500 block mb-1 mt-4">
                    SHIPMENTS
                </span>
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
                     x-transition
                     class="absolute left-full top-1/2 -translate-y-1/2 ml-2 px-2 py-1 bg-gray-900 dark:bg-gray-700 text-white text-xs rounded whitespace-nowrap z-50 shadow-lg">
                    All Shipments
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
                     x-transition
                     class="absolute left-full top-1/2 -translate-y-1/2 ml-2 px-2 py-1 bg-gray-900 dark:bg-gray-700 text-white text-xs rounded whitespace-nowrap z-50 shadow-lg">
                    Track Shipment
                </div>
            </div>

            <div x-data="{ tooltipVisible: false }" @mouseenter="tooltipVisible = true" @mouseleave="tooltipVisible = false" class="relative">
                <a href="#"
                    class="group flex items-center gap-3 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all duration-200 mx-2"
                    :class="$store.sidebar.collapsed ? 'justify-center px-0' : 'px-4'">
                    <div class="flex items-center justify-center min-w-[40px]">
                        <i class="fas fa-clock w-5 text-center"></i>
                    </div>
                    <span class="sidebar-text font-medium whitespace-nowrap transition-all duration-300 overflow-hidden">Delayed</span>
                </a>
                <div x-show="$store.sidebar.collapsed && tooltipVisible" 
                     x-transition
                     class="absolute left-full top-1/2 -translate-y-1/2 ml-2 px-2 py-1 bg-gray-900 dark:bg-gray-700 text-white text-xs rounded whitespace-nowrap z-50 shadow-lg">
                    Delayed
                </div>
            </div>

            <!-- Fleet Management section -->
            <div class="sidebar-section-title transition-all duration-300 px-3">
                <span class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-500 block mb-1 mt-4">
                    FLEET MANAGEMENT
                </span>
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
                     x-transition
                     class="absolute left-full top-1/2 -translate-y-1/2 ml-2 px-2 py-1 bg-gray-900 dark:bg-gray-700 text-white text-xs rounded whitespace-nowrap z-50 shadow-lg">
                    All Drivers
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
                     x-transition
                     class="absolute left-full top-1/2 -translate-y-1/2 ml-2 px-2 py-1 bg-gray-900 dark:bg-gray-700 text-white text-xs rounded whitespace-nowrap z-50 shadow-lg">
                    Vehicle List
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
                     x-transition
                     class="absolute left-full top-1/2 -translate-y-1/2 ml-2 px-2 py-1 bg-gray-900 dark:bg-gray-700 text-white text-xs rounded whitespace-nowrap z-50 shadow-lg">
                    Driver Assignments
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
                     x-transition
                     class="absolute left-full top-1/2 -translate-y-1/2 ml-2 px-2 py-1 bg-gray-900 dark:bg-gray-700 text-white text-xs rounded whitespace-nowrap z-50 shadow-lg">
                    Fuel & Maintenance
                </div>
            </div>

            <!-- Orders section -->
            <div class="sidebar-section-title transition-all duration-300 px-3">
                <span class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-500 block mb-1 mt-4">Orders</span>
            </div>

            <div x-data="{ tooltipVisible: false }" @mouseenter="tooltipVisible = true" @mouseleave="tooltipVisible = false" class="relative">
                <a href="#"
                    class="group flex items-center gap-3 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all duration-200 mx-2"
                    :class="$store.sidebar.collapsed ? 'justify-center px-0' : 'px-4'">
                    <div class="flex items-center justify-center min-w-[40px]">
                        <i class="fas fa-clipboard-list w-5 text-center"></i>
                    </div>
                    <span class="sidebar-text font-medium whitespace-nowrap transition-all duration-300 overflow-hidden">All Orders</span>
                </a>
                <div x-show="$store.sidebar.collapsed && tooltipVisible" 
                     x-transition
                     class="absolute left-full top-1/2 -translate-y-1/2 ml-2 px-2 py-1 bg-gray-900 dark:bg-gray-700 text-white text-xs rounded whitespace-nowrap z-50 shadow-lg">
                    All Orders
                </div>
            </div>

            <div x-data="{ tooltipVisible: false }" @mouseenter="tooltipVisible = true" @mouseleave="tooltipVisible = false" class="relative">
                <a href="#"
                    class="group flex items-center gap-3 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all duration-200 mx-2"
                    :class="$store.sidebar.collapsed ? 'justify-center px-0' : 'px-4'">
                    <div class="flex items-center justify-center min-w-[40px]">
                        <i class="fas fa-calendar-alt w-5 text-center"></i>
                    </div>
                    <span class="sidebar-text font-medium whitespace-nowrap transition-all duration-300 overflow-hidden">Scheduled Deliveries</span>
                </a>
                <div x-show="$store.sidebar.collapsed && tooltipVisible" 
                     x-transition
                     class="absolute left-full top-1/2 -translate-y-1/2 ml-2 px-2 py-1 bg-gray-900 dark:bg-gray-700 text-white text-xs rounded whitespace-nowrap z-50 shadow-lg">
                    Scheduled Deliveries
                </div>
            </div>

            <div x-data="{ tooltipVisible: false }" @mouseenter="tooltipVisible = true" @mouseleave="tooltipVisible = false" class="relative">
                <a href="#"
                    class="group flex items-center gap-3 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all duration-200 mx-2"
                    :class="$store.sidebar.collapsed ? 'justify-center px-0' : 'px-4'">
                    <div class="flex items-center justify-center min-w-[40px]">
                        <i class="fas fa-undo w-5 text-center"></i>
                    </div>
                    <span class="sidebar-text font-medium whitespace-nowrap transition-all duration-300 overflow-hidden">Returns</span>
                </a>
                <div x-show="$store.sidebar.collapsed && tooltipVisible" 
                     x-transition
                     class="absolute left-full top-1/2 -translate-y-1/2 ml-2 px-2 py-1 bg-gray-900 dark:bg-gray-700 text-white text-xs rounded whitespace-nowrap z-50 shadow-lg">
                    Returns
                </div>
            </div>

            <div x-data="{ tooltipVisible: false }" @mouseenter="tooltipVisible = true" @mouseleave="tooltipVisible = false" class="relative">
                <a href="#"
                    class="group flex items-center gap-3 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all duration-200 mx-2"
                    :class="$store.sidebar.collapsed ? 'justify-center px-0' : 'px-4'">
                    <div class="flex items-center justify-center min-w-[40px]">
                        <i class="fas fa-ban w-5 text-center"></i>
                    </div>
                    <span class="sidebar-text font-medium whitespace-nowrap transition-all duration-300 overflow-hidden">Cancellations</span>
                </a>
                <div x-show="$store.sidebar.collapsed && tooltipVisible" 
                     x-transition
                     class="absolute left-full top-1/2 -translate-y-1/2 ml-2 px-2 py-1 bg-gray-900 dark:bg-gray-700 text-white text-xs rounded whitespace-nowrap z-50 shadow-lg">
                    Cancellations
                </div>
            </div>

            <!-- Vendors & Clients section -->
            <div class="sidebar-section-title transition-all duration-300 px-3">
                <span class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-500 block mb-1 mt-4">
                    VENDORS & CLIENTS
                </span>
            </div>

            <div x-data="{ tooltipVisible: false }" @mouseenter="tooltipVisible = true" @mouseleave="tooltipVisible = false" class="relative">
                <a href="#"
                    class="group flex items-center gap-3 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all duration-200 mx-2"
                    :class="$store.sidebar.collapsed ? 'justify-center px-0' : 'px-4'">
                    <div class="flex items-center justify-center min-w-[40px]">
                        <i class="fas fa-building w-5 text-center"></i>
                    </div>
                    <span class="sidebar-text font-medium whitespace-nowrap transition-all duration-300 overflow-hidden">Vendors Directory</span>
                </a>
                <div x-show="$store.sidebar.collapsed && tooltipVisible" 
                     x-transition
                     class="absolute left-full top-1/2 -translate-y-1/2 ml-2 px-2 py-1 bg-gray-900 dark:bg-gray-700 text-white text-xs rounded whitespace-nowrap z-50 shadow-lg">
                    Vendors Directory
                </div>
            </div>

            <div x-data="{ tooltipVisible: false }" @mouseenter="tooltipVisible = true" @mouseleave="tooltipVisible = false" class="relative">
                <a href="#"
                    class="group flex items-center gap-3 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all duration-200 mx-2"
                    :class="$store.sidebar.collapsed ? 'justify-center px-0' : 'px-4'">
                    <div class="flex items-center justify-center min-w-[40px]">
                        <i class="fas fa-user-plus w-5 text-center"></i>
                    </div>
                    <span class="sidebar-text font-medium whitespace-nowrap transition-all duration-300 overflow-hidden">Add Vendor</span>
                </a>
                <div x-show="$store.sidebar.collapsed && tooltipVisible" 
                     x-transition
                     class="absolute left-full top-1/2 -translate-y-1/2 ml-2 px-2 py-1 bg-gray-900 dark:bg-gray-700 text-white text-xs rounded whitespace-nowrap z-50 shadow-lg">
                    Add Vendor
                </div>
            </div>

            <div x-data="{ tooltipVisible: false }" @mouseenter="tooltipVisible = true" @mouseleave="tooltipVisible = false" class="relative">
                <a href="#"
                    class="group flex items-center gap-3 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all duration-200 mx-2"
                    :class="$store.sidebar.collapsed ? 'justify-center px-0' : 'px-4'">
                    <div class="flex items-center justify-center min-w-[40px]">
                        <i class="fas fa-users w-5 text-center"></i>
                    </div>
                    <span class="sidebar-text font-medium whitespace-nowrap transition-all duration-300 overflow-hidden">Client List</span>
                </a>
                <div x-show="$store.sidebar.collapsed && tooltipVisible" 
                     x-transition
                     class="absolute left-full top-1/2 -translate-y-1/2 ml-2 px-2 py-1 bg-gray-900 dark:bg-gray-700 text-white text-xs rounded whitespace-nowrap z-50 shadow-lg">
                    Client List
                </div>
            </div>

            <div x-data="{ tooltipVisible: false }" @mouseenter="tooltipVisible = true" @mouseleave="tooltipVisible = false" class="relative">
                <a href="#"
                    class="group flex items-center gap-3 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all duration-200 mx-2"
                    :class="$store.sidebar.collapsed ? 'justify-center px-0' : 'px-4'">
                    <div class="flex items-center justify-center min-w-[40px]">
                        <i class="fas fa-comment-dots w-5 text-center"></i>
                    </div>
                    <span class="sidebar-text font-medium whitespace-nowrap transition-all duration-300 overflow-hidden">Client Feedback</span>
                </a>
                <div x-show="$store.sidebar.collapsed && tooltipVisible" 
                     x-transition
                     class="absolute left-full top-1/2 -translate-y-1/2 ml-2 px-2 py-1 bg-gray-900 dark:bg-gray-700 text-white text-xs rounded whitespace-nowrap z-50 shadow-lg">
                    Client Feedback
                </div>
            </div>

            <!-- Administration section -->
            <div class="sidebar-section-title transition-all duration-300 px-3">
                <span class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-500 block mb-1 mt-4">
                    ADMINISTRATION
                </span>
            </div>

            <div x-data="{ tooltipVisible: false }" @mouseenter="tooltipVisible = true" @mouseleave="tooltipVisible = false" class="relative">
                <a href="#"
                    class="group flex items-center gap-3 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all duration-200 mx-2"
                    :class="$store.sidebar.collapsed ? 'justify-center px-0' : 'px-4'">
                    <div class="flex items-center justify-center min-w-[40px]">
                        <i class="fas fa-file-invoice-dollar w-5 text-center"></i>
                    </div>
                    <span class="sidebar-text font-medium whitespace-nowrap transition-all duration-300 overflow-hidden">Invoicing & Billing</span>
                </a>
                <div x-show="$store.sidebar.collapsed && tooltipVisible" 
                     x-transition
                     class="absolute left-full top-1/2 -translate-y-1/2 ml-2 px-2 py-1 bg-gray-900 dark:bg-gray-700 text-white text-xs rounded whitespace-nowrap z-50 shadow-lg">
                    Invoicing & Billing
                </div>
            </div>

            <div x-data="{ tooltipVisible: false }" @mouseenter="tooltipVisible = true" @mouseleave="tooltipVisible = false" class="relative">
                <a href="#"
                    class="group flex items-center gap-3 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all duration-200 mx-2"
                    :class="$store.sidebar.collapsed ? 'justify-center px-0' : 'px-4'">
                    <div class="flex items-center justify-center min-w-[40px]">
                        <i class="fas fa-chart-bar w-5 text-center"></i>
                    </div>
                    <span class="sidebar-text font-medium whitespace-nowrap transition-all duration-300 overflow-hidden">Reports & Analytics</span>
                </a>
                <div x-show="$store.sidebar.collapsed && tooltipVisible" 
                     x-transition
                     class="absolute left-full top-1/2 -translate-y-1/2 ml-2 px-2 py-1 bg-gray-900 dark:bg-gray-700 text-white text-xs rounded whitespace-nowrap z-50 shadow-lg">
                    Reports & Analytics
                </div>
            </div>

            <div x-data="{ tooltipVisible: false }" @mouseenter="tooltipVisible = true" @mouseleave="tooltipVisible = false" class="relative">
                <a href="#"
                    class="group flex items-center gap-3 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all duration-200 mx-2"
                    :class="$store.sidebar.collapsed ? 'justify-center px-0' : 'px-4'">
                    <div class="flex items-center justify-center min-w-[40px]">
                        <i class="fas fa-user w-5 text-center"></i>
                    </div>
                    <span class="sidebar-text font-medium whitespace-nowrap transition-all duration-300 overflow-hidden">Add User</span>
                </a>
                <div x-show="$store.sidebar.collapsed && tooltipVisible" 
                     x-transition
                     class="absolute left-full top-1/2 -translate-y-1/2 ml-2 px-2 py-1 bg-gray-900 dark:bg-gray-700 text-white text-xs rounded whitespace-nowrap z-50 shadow-lg">
                    Add User
                </div>
            </div>

            <div x-data="{ tooltipVisible: false }" @mouseenter="tooltipVisible = true" @mouseleave="tooltipVisible = false" class="relative">
                <a href="#"
                    class="group flex items-center gap-3 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all duration-200 mx-2"
                    :class="$store.sidebar.collapsed ? 'justify-center px-0' : 'px-4'">
                    <div class="flex items-center justify-center min-w-[40px]">
                        <i class="fas fa-user-cog w-5 text-center"></i>
                    </div>
                    <span class="sidebar-text font-medium whitespace-nowrap transition-all duration-300 overflow-hidden">User Management</span>
                </a>
                <div x-show="$store.sidebar.collapsed && tooltipVisible" 
                     x-transition
                     class="absolute left-full top-1/2 -translate-y-1/2 ml-2 px-2 py-1 bg-gray-900 dark:bg-gray-700 text-white text-xs rounded whitespace-nowrap z-50 shadow-lg">
                    User Management
                </div>
            </div>

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
        },
        
        // Add responsive behavior
        init() {
            // Check initial screen size
            this.checkScreenSize();
            
            // Add resize listener
            window.addEventListener('resize', () => {
                this.checkScreenSize();
            });
        },
        
        checkScreenSize() {
            // Check if screen is mobile (adjust breakpoint as needed)
            const isMobile = window.innerWidth < 768; // Tailwind's md: breakpoint
            
            if (isMobile && !this.collapsed) {
                // Auto-collapse on mobile
                this.collapsed = true;
                localStorage.setItem('sidebarCollapsed', true);
                
                // Dispatch event
                window.dispatchEvent(new CustomEvent('sidebar-toggled', { 
                    detail: { collapsed: true } 
                }));
            }
        }
    });
    
    // Initialize the store
    Alpine.store('sidebar').init();
});
</script>