<!-- Top Navbar -->
<header class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-6">
    
    <!-- Page Title / Search -->
    <div class="flex items-center gap-4">
        <h1 class="text-xl font-semibold text-gray-900">Dashboard Overview</h1>
    </div>
    
    <!-- Right Side: Notifications & Profile -->
    <div class="flex items-center gap-4">
        
        <!-- Notifications -->
        <button class="relative p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition">
            <i class="fas fa-bell text-xl"></i>
            <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
        </button>
        
        <!-- User Profile Dropdown -->
        <div class="flex items-center gap-3" x-data="{ open: false }">
            <button @click="open = !open" class="flex items-center gap-3 hover:bg-gray-100 rounded-lg px-3 py-2 transition">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=4F46E5&color=fff" 
                     alt="{{ auth()->user()->name }}" 
                     class="w-10 h-10 rounded-full">
                <div class="text-left">
                    <p class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-gray-500">{{ auth()->user()->email }}</p>
                </div>
                <i class="fas fa-chevron-down text-gray-400 text-sm"></i>
            </button>
            
            <!-- Dropdown Menu -->
            <div x-show="open" 
                 @click.away="open = false"
                 x-transition
                 class="absolute top-14 right-6 w-48 bg-white rounded-lg shadow-lg border border-gray-200 py-2 z-50">
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a>
                <hr class="my-2">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                        Logout
                    </button>
                </form>
            </div>
        </div>
        
    </div>
    
</header>