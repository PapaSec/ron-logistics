<aside x-data="{ collapsed: false }" 
    :class="collapsed ? 'w-20' : 'w-64'" 
    class="bg-[#E4EBE7] dark:bg-[#1f2431] dark:border-gray-800 flex flex-col transition-all duration-300 ease-in-out relative">
    
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

            <!-- Orders section -->
            <span x-show="!collapsed" x-transition
                class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-500 block mb-1 mt-4">
                Orders
            </span>

            <a href="#"
                class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all group relative"
                :class="collapsed ? 'justify-center' : ''">
                <i class="fas fa-clipboard-list w-5"></i> 
                <span x-show="!collapsed" x-transition class="font-medium">All Orders</span>
                <div x-show="collapsed" 
                    class="absolute left-full ml-2 px-2 py-1 bg-gray-900 text-white text-sm rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none z-50">
                    All Orders
                </div>
            </a>

            <a href="#"
                class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all group relative"
                :class="collapsed ? 'justify-center' : ''">
                <i class="fas fa-calendar-alt w-5"></i> 
                <span x-show="!collapsed" x-transition class="font-medium">Scheduled Deliveries</span>
                <div x-show="collapsed" 
                    class="absolute left-full ml-2 px-2 py-1 bg-gray-900 text-white text-sm rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none z-50">
                    Scheduled Deliveries
                </div>
            </a>

            <a href="#"
                class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all group relative"
                :class="collapsed ? 'justify-center' : ''">
                <i class="fas fa-undo w-5"></i> 
                <span x-show="!collapsed" x-transition class="font-medium">Returns</span>
                <div x-show="collapsed" 
                    class="absolute left-full ml-2 px-2 py-1 bg-gray-900 text-white text-sm rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none z-50">
                    Returns
                </div>
            </a>

            <a href="#"
                class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all group relative"
                :class="collapsed ? 'justify-center' : ''">
                <i class="fas fa-ban w-5"></i> 
                <span x-show="!collapsed" x-transition class="font-medium">Cancellations</span>
                <div x-show="collapsed" 
                    class="absolute left-full ml-2 px-2 py-1 bg-gray-900 text-white text-sm rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none z-50">
                    Cancellations
                </div>
            </a>

            <!-- Vendors & Clients section -->
            <span x-show="!collapsed" x-transition
                class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-500 block mb-1 mt-4">
                VENDORS & CLIENTS
            </span>

            <a href="#"
                class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all group relative"
                :class="collapsed ? 'justify-center' : ''">
                <i class="fas fa-building w-5"></i> 
                <span x-show="!collapsed" x-transition class="font-medium">Vendors Directory</span>
                <div x-show="collapsed" 
                    class="absolute left-full ml-2 px-2 py-1 bg-gray-900 text-white text-sm rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none z-50">
                    Vendors Directory
                </div>
            </a>

            <a href="#"
                class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all group relative"
                :class="collapsed ? 'justify-center' : ''">
                <i class="fas fa-user-plus w-5"></i> 
                <span x-show="!collapsed" x-transition class="font-medium">Add Vendor</span>
                <div x-show="collapsed" 
                    class="absolute left-full ml-2 px-2 py-1 bg-gray-900 text-white text-sm rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none z-50">
                    Add Vendor
                </div>
            </a>

            <a href="#"
                class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all group relative"
                :class="collapsed ? 'justify-center' : ''">
                <i class="fas fa-users w-5"></i> 
                <span x-show="!collapsed" x-transition class="font-medium">Client List</span>
                <div x-show="collapsed" 
                    class="absolute left-full ml-2 px-2 py-1 bg-gray-900 text-white text-sm rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none z-50">
                    Client List
                </div>
            </a>

            <a href="#"
                class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all group relative"
                :class="collapsed ? 'justify-center' : ''">
                <i class="fas fa-comment-dots w-5"></i> 
                <span x-show="!collapsed" x-transition class="font-medium">Client Feedback</span>
                <div x-show="collapsed" 
                    class="absolute left-full ml-2 px-2 py-1 bg-gray-900 text-white text-sm rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none z-50">
                    Client Feedback
                </div>
            </a>

            <!-- Administration section -->
            <span x-show="!collapsed" x-transition
                class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-500 block mb-1 mt-4">
                ADMINISTRATION
            </span>

            <a href="#"
                class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all group relative"
                :class="collapsed ? 'justify-center' : ''">
                <i class="fas fa-file-invoice-dollar w-5"></i> 
                <span x-show="!collapsed" x-transition class="font-medium">Invoicing & Billing</span>
                <div x-show="collapsed" 
                    class="absolute left-full ml-2 px-2 py-1 bg-gray-900 text-white text-sm rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none z-50">
                    Invoicing & Billing
                </div>
            </a>

            <a href="#"
                class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all group relative"
                :class="collapsed ? 'justify-center' : ''">
                <i class="fas fa-chart-bar w-5"></i>
                <span x-show="!collapsed" x-transition class="font-medium">Reports & Analytics</span>
                <div x-show="collapsed" 
                    class="absolute left-full ml-2 px-2 py-1 bg-gray-900 text-white text-sm rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none z-50">
                    Reports & Analytics
                </div>
            </a>

            <a href="#"
                class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all group relative"
                :class="collapsed ? 'justify-center' : ''">
                <i class="fas fa-user w-5"></i>
                <span x-show="!collapsed" x-transition class="font-medium">Add User</span>
                <div x-show="collapsed" 
                    class="absolute left-full ml-2 px-2 py-1 bg-gray-900 text-white text-sm rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none z-50">
                    Add User
                </div>
            </a>

            <a href="#"
                class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all group relative"
                :class="collapsed ? 'justify-center' : ''">
                <i class="fas fa-user-cog w-5"></i>
                <span x-show="!collapsed" x-transition class="font-medium">User Management</span>
                <div x-show="collapsed" 
                    class="absolute left-full ml-2 px-2 py-1 bg-gray-900 text-white text-sm rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none z-50">
                    User Management
                </div>
            </a>

        </div>
    </nav>
</aside>

<!-- Custom scrollbar styles -->
<style>
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