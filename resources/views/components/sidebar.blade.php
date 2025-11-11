<aside class="w-64 bg-white dark:bg-[#111111] border-r border-gray-200 dark:border-gray-800 flex flex-col transition-colors duration-200">
    
    <div class="h-16 flex items-center justify-center border-b border-gray-200 dark:border-gray-800">
        <div class="flex items-center gap-2">
            <div class="w-10 h-10 bg-blue-600 dark:bg-blue-500 rounded-lg flex items-center justify-center">
                <i class="fas fa-truck text-white"></i>
            </div>
            <span class="text-xl font-bold text-gray-900 dark:text-white">Ron Logistics</span>
        </div>
    </div>
    
    <nav class="flex-1 overflow-y-auto py-4">
        <div class="px-3 space-y-1">
            
            <a href="{{ route('dashboard') }}" 
                class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-300 hover:bg-blue-50 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all {{ request()->routeIs('dashboard') ? 'bg-blue-50 dark:bg-gray-900 text-blue-600 dark:text-blue-400' : '' }}">
                <i class="fas fa-th-large w-5"></i>
                <span class="font-medium">Dashboard</span>
            </a>
            
            <a href="#" 
                class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-300 hover:bg-blue-50 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all">
                <i class="fas fa-box w-5"></i>
                <span class="font-medium">Shipments</span>
            </a>
            
            <a href="#" 
                class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-300 hover:bg-blue-50 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all">
                <i class="fas fa-truck w-5"></i>
                <span class="font-medium">Fleet</span>
            </a>
            
            <a href="#" 
                class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-300 hover:bg-blue-50 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all">
                <i class="fas fa-chart-bar w-5"></i>
                <span class="font-medium">Reports</span>
            </a>
            
        </div>
        
        <div class="px-3 mt-auto border-t border-gray-200 dark:border-gray-800 pt-4">
            
            <a href="#" 
                class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-300 hover:bg-blue-50 dark:hover:bg-gray-800 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all">
                <i class="fas fa-cog w-5"></i>
                <span class="font-medium">Settings</span>
            </a>
            
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="w-full flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-300 hover:bg-red-50 dark:hover:bg-red-950/30 hover:text-red-600 dark:hover:text-red-400 rounded-lg transition-all">
                    <i class="fas fa-sign-out-alt w-5"></i>
                    <span class="font-medium">Logout</span>
                </button>
            </form>
            
        </div>
    </nav>
    
</aside>