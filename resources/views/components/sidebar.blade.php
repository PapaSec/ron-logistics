<aside class="w-64 bg-[#E4EBE7] dark:bg-[#272d3e] dark:border-gray-800 flex flex-col transition-colors duration-200">
    <div class="h-18 flex items-center justify-center bg-[#1f2431] dark:border-gray-800">
        <div class="flex items-center gap-2">
            <div class="w-10 h-10 bg-blue-600 dark:bg-blue-500 rounded-lg flex items-center justify-center">
                <i class="fas fa-truck text-white"></i>
            </div>
            <span class="text-xl font-bold text-white">Ron Logistics</span>
        </div>
    </div>

    <!-- Add sidebar-scrollbar class here -->
    <nav class="flex-1 overflow-y-auto py-4 sidebar-scrollbar">
        <div class="px-3 space-y-1">
            <!-- Your existing navigation content -->
            <span class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-500 block mb-1 mt-2">DASHBOARD</span>
            
            <a href="{{ route('dashboard') }}"
                class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-300 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all {{ request()->routeIs('dashboard') ? 'bg-blue-300 dark:bg-gray-800 text-blue-600 dark:text-blue-400' : '' }}">
                <i class="fas fa-chart-pie w-5"></i> <span class="font-medium">Overview</span>
            </a>
            
            <a href="#"
                class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-300 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all">
                <i class="fas fa-chart-line w-5"></i>
                <span class="font-medium">Fleet Status</span>
            </a>

            <a href="#"
                class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-300 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all">
                <i class="fas fa-map-marker-alt w-5"></i> <span class="font-medium">Live Map</span>
            </a>

            <span
                class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-500 block mb-1 mt-4">SHIPMENTS</span>

            <a href="#"
                class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-300 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all">
                <i class="fas fa-list-ul w-5"></i> <span class="font-medium">All Shipments</span>
            </a>

            <a href="#"
                class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-300 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all">
                <i class="fas fa-route w-5"></i> <span class="font-medium">Track Shipment</span>
            </a>

            <a href="#"
                class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-300 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all">
                <i class="fas fa-plus-circle w-5"></i> <span class="font-medium">Create Shipment</span>
            </a>

            <a href="#"
                class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-300 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all">
                <i class="fas fa-exclamation-triangle w-5"></i> <span class="font-medium">Delayed</span>
            </a>

            <span
                class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-500 block mb-1 mt-4">FLEET
                MANAGEMENT</span>

            <a href="#"
                class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-300 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all">
                <i class="fas fa-truck-moving w-5"></i> <span class="font-medium">Vehicle List</span>
            </a>

            <a href="#"
                class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-300 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all">
                <i class="fas fa-users w-5"></i> <span class="font-medium">Drivers</span>
            </a>

            <a href="#"
                class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-300 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all">
                <i class="fas fa-gas-pump w-5"></i> <span class="font-medium">Fuel & Maintenance</span>
            </a>

            <span
                class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-500 block mb-1 mt-4">ADMINISTRATION</span>

            <a href="#"
                class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-300 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all">
                <i class="fas fa-file-invoice-dollar w-5"></i> <span class="font-medium">Invoicing & Billing</span>
            </a>

            <a href="#"
                class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-300 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all">
                <i class="fas fa-chart-bar w-5"></i>
                <span class="font-medium">Reports & Analytics</span>
            </a>

            <a href="#"
                class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-300 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all">
                <i class="fas fa-user w-5"></i>
                <span class="font-medium">Add User</span>
            </a>

            <a href="#"
                class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-300 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all">
                <i class="fas fa-user-cog w-5"></i>
                <span class="font-medium">User Management</span>
            </a>
            
        </div>
    </nav>
</aside>

<style>
    /* Custom scrollbar for sidebar */
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

    /* Dark mode styles */
    .dark .sidebar-scrollbar::-webkit-scrollbar-thumb {
        background: #4b5563;
    }

    .dark .sidebar-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #6b7280;
    }

    /* Firefox scrollbar */
    .sidebar-scrollbar {
        scrollbar-width: thin;
        scrollbar-color: #5c0852 transparent;
    }

    .dark .sidebar-scrollbar {
        scrollbar-color: #9f1313 transparent;
    }
</style>