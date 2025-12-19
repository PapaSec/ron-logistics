<aside class="w-64 bg-[#E4EBE7] dark:bg-[#1f2431] dark:border-gray-800 flex flex-col transition-colors duration-200">
    <!-- Sidebar header with logo -->
    <div class="h-18 flex items-center justify-center bg-[#232838] dark:border-gray-800">
        <div class="flex items-center gap-2">
            <div class="w-10 h-10 bg-[#138898] dark:bg-[#138898] rounded-lg flex items-center justify-center">
                <i class="fas fa-truck text-white"></i>
            </div>
            <span class="text-xl font-bold text-white">Ron Logistics</span>
        </div>
    </div>

    <!-- Scrollable navigation area -->
    <nav class="flex-1 overflow-y-auto py-4 sidebar-scrollbar">
        <div class="px-3 space-y-1">
            <!-- Dashboard section -->
            <span
                class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-500 block mb-1 mt-2">DASHBOARD</span>

            <!-- Active dashboard link -->
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all 
        {{ request()->routeIs('dashboard') ? 'bg-[#138898] dark:bg-[#138898] text-white dark:text-white' : '' }}">
                <i class="fas fa-chart-pie w-5"></i> <span class="font-medium">Overview</span>
            </a>

            <a href="#"
                class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all">
                <i class="fas fa-chart-line w-5"></i>
                <span class="font-medium">Fleet Status</span>
            </a>

            <a href="#"
                class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all">
                <i class="fas fa-map-marker-alt w-5"></i> <span class="font-medium">Live Map</span>
            </a>

            <!-- Shipments section -->
            <span
                class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-500 block mb-1 mt-4">SHIPMENTS</span>

            <a href="{{ route('shipments.index') }}"
                class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all 
                    {{ request()->routeIs('shipments.index') ? 'bg-[#138898] dark:bg-[#138898] text-white dark:text-white' : '' }}">
                <i class="fas fa-list-ul w-5"></i> <span class="font-medium">All Shipments</span>
            </a>

            <a href="{{ route('shipments.track') }}"
                class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all
                    {{ request()->routeIs('shipments.track') ? 'bg-[#138898] dark:bg-[#138898] text-white dark:text-white' : '' }}">
                <i class="fas fa-route w-5"></i> <span class="font-medium">Track Shipment</span>
            </a>

            <a href="#"
                class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all">
                <i class="fas fa-clock w-5"></i> <span class="font-medium">Delayed</span>
            </a>

            <!-- Fleet Management section -->
            <span
                class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-500 block mb-1 mt-4">FLEET
                MANAGEMENT</span>
                
            <a href="{{ route('drivers.index') }}"
                class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all
                    {{ request()->routeIs('drivers.index') ? 'bg-[#138898] dark:bg-[#138898] text-white dark:text-white' : '' }}">
                <i class="fas fa-users w-5"></i> <span class="font-medium">All Drivers</span>
            </a>

            <a href="{{ route('vehicles.index') }}"
                class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all
                    {{ request()->routeIs('vehicles.index') ? 'bg-[#138898] dark:bg-[#138898] text-white dark:text-white' : '' }}">
                <i class="fas fa-truck-moving w-5"></i> <span class="font-medium">Vehicle List</span>
            </a>

            <a href="{{ route('driver-assignments.index') }}"
                class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all
                    {{ request()->routeIs('driver-assignments.index') ? 'bg-[#138898] dark:bg-[#138898] text-white dark:text-white' : '' }}">
                <i class="fas fa-user w-5"></i> <span class="font-medium">Driver Assignments</span>
            </a>

            <a href="{{ route('fuel-maintenance.index') }}"
                class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all
                    {{ request()->routeIs('fuel-maintenance.index') ? 'bg-[#138898] dark:bg-[#138898] text-white dark:text-white' : '' }}">
                <i class="fas fa-gas-pump w-5"></i> <span class="font-medium">Fuel & Maintenance</span>
            </a>

            <!-- Orders section -->
            <span
                class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-500 block mb-1 mt-4">Orders</span>

            <a href="#"
                class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all">
                <i class="fas fa-clipboard-list w-5"></i> <span class="font-medium">All Orders</span>
            </a>

            <a href="#"
                class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all">
                <i class="fas fa-calendar-alt w-5"></i> <span class="font-medium">Scheduled Deliveries</span>
            </a>

            <a href="#"
                class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all">
                <i class="fas fa-undo w-5"></i> <span class="font-medium">Returns</span>
            </a>

            <a href="#"
                class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all">
                <i class="fas fa-ban w-5"></i> <span class="font-medium">Cancellations</span>
            </a>

            <!-- Vendors & Clients section -->
            <span
                class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-500 block mb-1 mt-4">VENDORS
                & CLIENTS</span>

            <a href="#"
                class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all">
                <i class="fas fa-building w-5"></i> <span class="font-medium">Vendors Directory</span>
            </a>

            <a href="#"
                class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all">
                <i class="fas fa-user-plus w-5"></i> <span class="font-medium">Add Vendor</span>
            </a>

            <a href="#"
                class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all">
                <i class="fas fa-users w-5"></i> <span class="font-medium">Client List</span>
            </a>

            <a href="#"
                class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all">
                <i class="fas fa-comment-dots w-5"></i> <span class="font-medium">Client Feedback</span>
            </a>

            <!-- Administration section -->
            <span
                class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-500 block mb-1 mt-4">ADMINISTRATION</span>

            <a href="#"
                class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all">
                <i class="fas fa-file-invoice-dollar w-5"></i> <span class="font-medium">Invoicing & Billing</span>
            </a>

            <a href="#"
                class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all">
                <i class="fas fa-chart-bar w-5"></i>
                <span class="font-medium">Reports & Analytics</span>
            </a>

            <a href="#"
                class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all">
                <i class="fas fa-user w-5"></i>
                <span class="font-medium">Add User</span>
            </a>

            <a href="#"
                class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all">
                <i class="fas fa-user-cog w-5"></i>
                <span class="font-medium">User Management</span>
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