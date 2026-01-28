<div class="flex flex-col h-full">

    <!-- Logo header -->
    <div class="h-18 flex items-center justify-center bg-[#232838] border-b border-gray-800/50">
        <div class="flex items-center gap-2" :class="{ 'justify-center': collapsed }">
            <div class="w-10 h-10 bg-[#138898] rounded-lg flex items-center justify-center flex-shrink-0">
                <i class="fas fa-truck text-white"></i>
            </div>
            <span class="text-xl font-bold text-white whitespace-nowrap" :class="{ 'hidden': collapsed }">
                Ron Logistics
            </span>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 overflow-y-auto py-4 sidebar-scrollbar">
        <div class="px-2 space-y-1">

            <span class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-500 block mb-1 mt-2 px-2"
                  :class="{ 'hidden': collapsed }">DASHBOARD</span>

            <a href="{{ route('dashboard') }}"
               class="flex items-center gap-3 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all group relative"
               :class="[collapsed ? 'justify-center px-3' : 'px-4', request()->routeIs('dashboard') ? 'bg-[#138898] text-white dark:text-white' : '']">
                <i class="fas fa-chart-pie w-5 flex-shrink-0"></i>
                <span class="font-medium whitespace-nowrap" :class="{ 'hidden': collapsed }">Overview</span>
                <div x-show="collapsed" class="absolute left-full ml-3 px-4 py-2 bg-gray-900 text-white text-sm rounded border border-gray-700 opacity-0 group-hover:opacity-100 pointer-events-none z-50 whitespace-nowrap shadow-xl">Overview</div>
            </a>

            <a href="#"
               class="flex items-center gap-3 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all group relative"
               :class="[collapsed ? 'justify-center px-3' : 'px-4']">
                <i class="fas fa-chart-line w-5 flex-shrink-0"></i>
                <span class="font-medium whitespace-nowrap" :class="{ 'hidden': collapsed }">Fleet Status</span>
                <div x-show="collapsed" class="absolute left-full ml-3 px-4 py-2 bg-gray-900 text-white text-sm rounded border border-gray-700 opacity-0 group-hover:opacity-100 pointer-events-none z-50 whitespace-nowrap shadow-xl">Fleet Status</div>
            </a>

            <a href="{{ route('live-map') }}"
               class="flex items-center gap-3 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all group relative"
               :class="[collapsed ? 'justify-center px-3' : 'px-4', request()->routeIs('live-map') ? 'bg-[#138898] text-white dark:text-white' : '']">
                <i class="fas fa-map-marker-alt w-5 flex-shrink-0"></i>
                <span class="font-medium whitespace-nowrap" :class="{ 'hidden': collapsed }">Live Map</span>
                <div x-show="collapsed" class="absolute left-full ml-3 px-4 py-2 bg-gray-900 text-white text-sm rounded border border-gray-700 opacity-0 group-hover:opacity-100 pointer-events-none z-50 whitespace-nowrap shadow-xl">Live Map</div>
            </a>

            <span class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-500 block mb-1 mt-4 px-2"
                  :class="{ 'hidden': collapsed }">SHIPMENTS</span>

            <a href="{{ route('shipments.index') }}"
               class="flex items-center gap-3 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all group relative"
               :class="[collapsed ? 'justify-center px-3' : 'px-4', request()->routeIs('shipments.index') ? 'bg-[#138898] text-white dark:text-white' : '']">
                <i class="fas fa-list-ul w-5 flex-shrink-0"></i>
                <span class="font-medium whitespace-nowrap" :class="{ 'hidden': collapsed }">All Shipments</span>
                <div x-show="collapsed" class="absolute left-full ml-3 px-4 py-2 bg-gray-900 text-white text-sm rounded border border-gray-700 opacity-0 group-hover:opacity-100 pointer-events-none z-50 whitespace-nowrap shadow-xl">All Shipments</div>
            </a>

            <a href="{{ route('shipments.track') }}"
               class="flex items-center gap-3 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all group relative"
               :class="[collapsed ? 'justify-center px-3' : 'px-4', request()->routeIs('shipments.track') ? 'bg-[#138898] text-white dark:text-white' : '']">
                <i class="fas fa-route w-5 flex-shrink-0"></i>
                <span class="font-medium whitespace-nowrap" :class="{ 'hidden': collapsed }">Track Shipment</span>
                <div x-show="collapsed" class="absolute left-full ml-3 px-4 py-2 bg-gray-900 text-white text-sm rounded border border-gray-700 opacity-0 group-hover:opacity-100 pointer-events-none z-50 whitespace-nowrap shadow-xl">Track Shipment</div>
            </a>

            <a href="#"
               class="flex items-center gap-3 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all group relative"
               :class="collapsed ? 'justify-center px-3' : 'px-4'">
                <i class="fas fa-clock w-5 flex-shrink-0"></i>
                <span class="font-medium whitespace-nowrap" :class="{ 'hidden': collapsed }">Delayed</span>
                <div x-show="collapsed" class="absolute left-full ml-3 px-4 py-2 bg-gray-900 text-white text-sm rounded border border-gray-700 opacity-0 group-hover:opacity-100 pointer-events-none z-50 whitespace-nowrap shadow-xl">Delayed</div>
            </a>

            <span class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-500 block mb-1 mt-4 px-2"
                  :class="{ 'hidden': collapsed }">FLEET MANAGEMENT</span>

            <a href="{{ route('drivers.index') }}"
               class="flex items-center gap-3 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all group relative"
               :class="[collapsed ? 'justify-center px-3' : 'px-4', request()->routeIs('drivers.index') ? 'bg-[#138898] text-white dark:text-white' : '']">
                <i class="fas fa-users w-5 flex-shrink-0"></i>
                <span class="font-medium whitespace-nowrap" :class="{ 'hidden': collapsed }">All Drivers</span>
                <div x-show="collapsed" class="absolute left-full ml-3 px-4 py-2 bg-gray-900 text-white text-sm rounded border border-gray-700 opacity-0 group-hover:opacity-100 pointer-events-none z-50 whitespace-nowrap shadow-xl">All Drivers</div>
            </a>

            <a href="{{ route('vehicles.index') }}"
               class="flex items-center gap-3 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all group relative"
               :class="[collapsed ? 'justify-center px-3' : 'px-4', request()->routeIs('vehicles.index') ? 'bg-[#138898] text-white dark:text-white' : '']">
                <i class="fas fa-truck-moving w-5 flex-shrink-0"></i>
                <span class="font-medium whitespace-nowrap" :class="{ 'hidden': collapsed }">Vehicle List</span>
                <div x-show="collapsed" class="absolute left-full ml-3 px-4 py-2 bg-gray-900 text-white text-sm rounded border border-gray-700 opacity-0 group-hover:opacity-100 pointer-events-none z-50 whitespace-nowrap shadow-xl">Vehicle List</div>
            </a>

            <a href="{{ route('driver-assignments.index') }}"
               class="flex items-center gap-3 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all group relative"
               :class="[collapsed ? 'justify-center px-3' : 'px-4', request()->routeIs('driver-assignments.index') ? 'bg-[#138898] text-white dark:text-white' : '']">
                <i class="fas fa-user w-5 flex-shrink-0"></i>
                <span class="font-medium whitespace-nowrap" :class="{ 'hidden': collapsed }">Driver Assignments</span>
                <div x-show="collapsed" class="absolute left-full ml-3 px-4 py-2 bg-gray-900 text-white text-sm rounded border border-gray-700 opacity-0 group-hover:opacity-100 pointer-events-none z-50 whitespace-nowrap shadow-xl">Driver Assignments</div>
            </a>

            <a href="{{ route('fuel-maintenance.index') }}"
               class="flex items-center gap-3 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all group relative"
               :class="[collapsed ? 'justify-center px-3' : 'px-4', request()->routeIs('fuel-maintenance.index') ? 'bg-[#138898] text-white dark:text-white' : '']">
                <i class="fas fa-gas-pump w-5 flex-shrink-0"></i>
                <span class="font-medium whitespace-nowrap" :class="{ 'hidden': collapsed }">Fuel & Maintenance</span>
                <div x-show="collapsed" class="absolute left-full ml-3 px-4 py-2 bg-gray-900 text-white text-sm rounded border border-gray-700 opacity-0 group-hover:opacity-100 pointer-events-none z-50 whitespace-nowrap shadow-xl">Fuel & Maintenance</div>
            </a>

            <span class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-500 block mb-1 mt-4 px-2"
                  :class="{ 'hidden': collapsed }">ORDERS</span>

            <a href="#"
               class="flex items-center gap-3 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all group relative"
               :class="collapsed ? 'justify-center px-3' : 'px-4'">
                <i class="fas fa-clipboard-list w-5 flex-shrink-0"></i>
                <span class="font-medium whitespace-nowrap" :class="{ 'hidden': collapsed }">All Orders</span>
                <div x-show="collapsed" class="absolute left-full ml-3 px-4 py-2 bg-gray-900 text-white text-sm rounded border border-gray-700 opacity-0 group-hover:opacity-100 pointer-events-none z-50 whitespace-nowrap shadow-xl">All Orders</div>
            </a>

            <a href="#"
               class="flex items-center gap-3 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all group relative"
               :class="collapsed ? 'justify-center px-3' : 'px-4'">
                <i class="fas fa-calendar-alt w-5 flex-shrink-0"></i>
                <span class="font-medium whitespace-nowrap" :class="{ 'hidden': collapsed }">Scheduled Deliveries</span>
                <div x-show="collapsed" class="absolute left-full ml-3 px-4 py-2 bg-gray-900 text-white text-sm rounded border border-gray-700 opacity-0 group-hover:opacity-100 pointer-events-none z-50 whitespace-nowrap shadow-xl">Scheduled Deliveries</div>
            </a>

            <a href="#"
               class="flex items-center gap-3 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all group relative"
               :class="collapsed ? 'justify-center px-3' : 'px-4'">
                <i class="fas fa-undo w-5 flex-shrink-0"></i>
                <span class="font-medium whitespace-nowrap" :class="{ 'hidden': collapsed }">Returns</span>
                <div x-show="collapsed" class="absolute left-full ml-3 px-4 py-2 bg-gray-900 text-white text-sm rounded border border-gray-700 opacity-0 group-hover:opacity-100 pointer-events-none z-50 whitespace-nowrap shadow-xl">Returns</div>
            </a>

            <a href="#"
               class="flex items-center gap-3 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all group relative"
               :class="collapsed ? 'justify-center px-3' : 'px-4'">
                <i class="fas fa-ban w-5 flex-shrink-0"></i>
                <span class="font-medium whitespace-nowrap" :class="{ 'hidden': collapsed }">Cancellations</span>
                <div x-show="collapsed" class="absolute left-full ml-3 px-4 py-2 bg-gray-900 text-white text-sm rounded border border-gray-700 opacity-0 group-hover:opacity-100 pointer-events-none z-50 whitespace-nowrap shadow-xl">Cancellations</div>
            </a>

            <span class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-500 block mb-1 mt-4 px-2"
                  :class="{ 'hidden': collapsed }">VENDORS & CLIENTS</span>

            <a href="#"
               class="flex items-center gap-3 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all group relative"
               :class="collapsed ? 'justify-center px-3' : 'px-4'">
                <i class="fas fa-building w-5 flex-shrink-0"></i>
                <span class="font-medium whitespace-nowrap" :class="{ 'hidden': collapsed }">Vendors Directory</span>
                <div x-show="collapsed" class="absolute left-full ml-3 px-4 py-2 bg-gray-900 text-white text-sm rounded border border-gray-700 opacity-0 group-hover:opacity-100 pointer-events-none z-50 whitespace-nowrap shadow-xl">Vendors Directory</div>
            </a>

            <a href="#"
               class="flex items-center gap-3 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all group relative"
               :class="collapsed ? 'justify-center px-3' : 'px-4'">
                <i class="fas fa-user-plus w-5 flex-shrink-0"></i>
                <span class="font-medium whitespace-nowrap" :class="{ 'hidden': collapsed }">Add Vendor</span>
                <div x-show="collapsed" class="absolute left-full ml-3 px-4 py-2 bg-gray-900 text-white text-sm rounded border border-gray-700 opacity-0 group-hover:opacity-100 pointer-events-none z-50 whitespace-nowrap shadow-xl">Add Vendor</div>
            </a>

            <a href="#"
               class="flex items-center gap-3 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all group relative"
               :class="collapsed ? 'justify-center px-3' : 'px-4'">
                <i class="fas fa-users w-5 flex-shrink-0"></i>
                <span class="font-medium whitespace-nowrap" :class="{ 'hidden': collapsed }">Client List</span>
                <div x-show="collapsed" class="absolute left-full ml-3 px-4 py-2 bg-gray-900 text-white text-sm rounded border border-gray-700 opacity-0 group-hover:opacity-100 pointer-events-none z-50 whitespace-nowrap shadow-xl">Client List</div>
            </a>

            <a href="#"
               class="flex items-center gap-3 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all group relative"
               :class="collapsed ? 'justify-center px-3' : 'px-4'">
                <i class="fas fa-comment-dots w-5 flex-shrink-0"></i>
                <span class="font-medium whitespace-nowrap" :class="{ 'hidden': collapsed }">Client Feedback</span>
                <div x-show="collapsed" class="absolute left-full ml-3 px-4 py-2 bg-gray-900 text-white text-sm rounded border border-gray-700 opacity-0 group-hover:opacity-100 pointer-events-none z-50 whitespace-nowrap shadow-xl">Client Feedback</div>
            </a>

            <span class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-500 block mb-1 mt-4 px-2"
                  :class="{ 'hidden': collapsed }">ADMINISTRATION</span>

            <a href="#"
               class="flex items-center gap-3 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all group relative"
               :class="collapsed ? 'justify-center px-3' : 'px-4'">
                <i class="fas fa-file-invoice-dollar w-5 flex-shrink-0"></i>
                <span class="font-medium whitespace-nowrap" :class="{ 'hidden': collapsed }">Invoicing & Billing</span>
                <div x-show="collapsed" class="absolute left-full ml-3 px-4 py-2 bg-gray-900 text-white text-sm rounded border border-gray-700 opacity-0 group-hover:opacity-100 pointer-events-none z-50 whitespace-nowrap shadow-xl">Invoicing & Billing</div>
            </a>

            <a href="#"
               class="flex items-center gap-3 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all group relative"
               :class="collapsed ? 'justify-center px-3' : 'px-4'">
                <i class="fas fa-chart-bar w-5 flex-shrink-0"></i>
                <span class="font-medium whitespace-nowrap" :class="{ 'hidden': collapsed }">Reports & Analytics</span>
                <div x-show="collapsed" class="absolute left-full ml-3 px-4 py-2 bg-gray-900 text-white text-sm rounded border border-gray-700 opacity-0 group-hover:opacity-100 pointer-events-none z-50 whitespace-nowrap shadow-xl">Reports & Analytics</div>
            </a>

            <a href="#"
               class="flex items-center gap-3 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all group relative"
               :class="collapsed ? 'justify-center px-3' : 'px-4'">
                <i class="fas fa-user w-5 flex-shrink-0"></i>
                <span class="font-medium whitespace-nowrap" :class="{ 'hidden': collapsed }">Add User</span>
                <div x-show="collapsed" class="absolute left-full ml-3 px-4 py-2 bg-gray-900 text-white text-sm rounded border border-gray-700 opacity-0 group-hover:opacity-100 pointer-events-none z-50 whitespace-nowrap shadow-xl">Add User</div>
            </a>

            <a href="#"
               class="flex items-center gap-3 py-3 text-gray-700 dark:text-gray-500 hover:bg-blue-200 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all group relative"
               :class="collapsed ? 'justify-center px-3' : 'px-4'">
                <i class="fas fa-user-cog w-5 flex-shrink-0"></i>
                <span class="font-medium whitespace-nowrap" :class="{ 'hidden': collapsed }">User Management</span>
                <div x-show="collapsed" class="absolute left-full ml-3 px-4 py-2 bg-gray-900 text-white text-sm rounded border border-gray-700 opacity-0 group-hover:opacity-100 pointer-events-none z-50 whitespace-nowrap shadow-xl">User Management</div>
            </a>

        </div>
    </nav>

</div>

<!-- Custom scrollbar -->
<style>
    .sidebar-scrollbar::-webkit-scrollbar { width: 6px; }
    .sidebar-scrollbar::-webkit-scrollbar-track { background: transparent; border-radius: 10px; }
    .sidebar-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
    .sidebar-scrollbar::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    .dark .sidebar-scrollbar::-webkit-scrollbar-thumb { background: #4b5563; }
    .dark .sidebar-scrollbar::-webkit-scrollbar-thumb:hover { background: #6b7280; }
    .sidebar-scrollbar { scrollbar-width: thin; scrollbar-color: #138898 transparent; }
    .dark .sidebar-scrollbar { scrollbar-color: #138898 transparent; }
</style>