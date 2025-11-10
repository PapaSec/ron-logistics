<!-- Sidebar -->
<aside class="w-64 bg-white border-r border-gray-200 flex flex-col">
    
    <!-- Logo -->
    <div class="h-16 flex items-center justify-center border-b border-gray-200">
        <div class="flex items-center gap-2">
            <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
                <i class="fas fa-truck text-white"></i>
            </div>
            <span class="text-xl font-bold text-gray-900">Ron Logistics</span>
        </div>
    </div>
    
    <!-- Navigation Menu -->
    <nav class="flex-1 overflow-y-auto py-4">
        <div class="px-3 space-y-1">
            
            <!-- Dashboard -->
            <a href="{{ route('dashboard') }}" 
               class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-600' : '' }}">
                <i class="fas fa-th-large w-5"></i>
                <span class="font-medium">Dashboard</span>
            </a>
            
            <!-- Shipments -->
            <a href="#" 
               class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition">
                <i class="fas fa-box w-5"></i>
                <span class="font-medium">Shipments</span>
            </a>
            
            <!-- Fleet -->
            <a href="#" 
               class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition">
                <i class="fas fa-truck w-5"></i>
                <span class="font-medium">Fleet</span>
            </a>
            
            <!-- Reports -->
            <a href="#" 
               class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition">
                <i class="fas fa-chart-bar w-5"></i>
                <span class="font-medium">Reports</span>
            </a>
            
        </div>
        
        <!-- Bottom Menu -->
        <div class="px-3 mt-auto border-t border-gray-200 pt-4">
            
            <!-- Settings -->
            <a href="#" 
               class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition">
                <i class="fas fa-cog w-5"></i>
                <span class="font-medium">Settings</span>
            </a>
            
            <!-- Logout -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                   class="w-full flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-red-50 hover:text-red-600 rounded-lg transition">
                    <i class="fas fa-sign-out-alt w-5"></i>
                    <span class="font-medium">Logout</span>
                </button>
            </form>
            
        </div>
    </nav>
    
</aside>