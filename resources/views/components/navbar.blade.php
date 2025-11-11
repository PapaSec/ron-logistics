<!-- Top Navbar -->
<header class="h-16 bg-white dark:bg-black border-b border-gray-200 dark:border-gray-800 flex items-center justify-between px-6 transition-colors duration-200" x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }" x-init="$watch('darkMode', val => { 
    if (val) { 
        document.documentElement.classList.add('dark'); 
        localStorage.setItem('darkMode', 'true'); 
    } else { 
        document.documentElement.classList.remove('dark'); 
        localStorage.setItem('darkMode', 'false'); 
    }
}); 
if (darkMode) { 
    document.documentElement.classList.add('dark'); 
}">

    <!-- Page Title -->
    <div class="flex items-center gap-4">
        <h1 class="text-xl font-semibold text-gray-900 dark:text-white">Dashboard Overview</h1>
    </div>

    <!-- Right Side: Theme Toggle, Notifications & Profile -->
    <div class="flex items-center gap-3">

        <!-- Theme Toggle -->
        <button 
            @click="darkMode = !darkMode"
            class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-900 transition-all duration-300"
            aria-label="Toggle dark mode"
        >
            <i class="fas text-lg transition-all duration-300"
                :class="darkMode ? 'fa-sun text-yellow-400' : 'fa-moon text-gray-600 dark:text-gray-400'"></i>
        </button>

        <!-- Notifications -->
        <button class="relative p-2 text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 rounded-lg transition-all duration-200">
            <i class="fas fa-bell text-lg"></i>
            <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
        </button>

        <!-- User Profile Dropdown -->
        <div class="relative" x-data="{ open: false }">
            <button 
                @click="open = !open"
                class="flex items-center gap-3 hover:bg-gray-100 dark:hover:bg-gray-900 rounded-lg px-3 py-2 transition-all duration-200"
            >
                <img 
                    src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=4F46E5&color=fff"
                    alt="{{ auth()->user()->name }}" 
                    class="w-9 h-9 rounded-full"
                >
                <div class="text-left hidden md:block">
                    <p class="text-sm font-medium text-gray-900 dark:text-white">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ auth()->user()->email }}</p>
                </div>
                <i class="fas fa-chevron-down text-gray-400 dark:text-gray-500 text-xs"></i>
            </button>

            <!-- Dropdown Menu -->
            <div 
                x-show="open" 
                @click.away="open = false" 
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                class="absolute top-full right-0 mt-2 w-56 bg-white dark:bg-gray-950 rounded-lg shadow-lg border border-gray-200 dark:border-gray-800 py-2 z-50"
                style="display: none;"
            >
                <!-- User Info -->
                <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-800">
                    <p class="text-sm font-medium text-gray-900 dark:text-white">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ auth()->user()->email }}</p>
                </div>
                
                <!-- Menu Items -->
                <a href="#" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-900 transition-colors">
                    <i class="fas fa-user w-4"></i>
                    <span>Profile</span>
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-900 transition-colors">
                    <i class="fas fa-cog w-4"></i>
                    <span>Settings</span>
                </a>
                
                <hr class="my-2 border-gray-200 dark:border-gray-800">
                
                <!-- Logout -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-950/30 transition-colors">
                        <i class="fas fa-sign-out-alt w-4"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>

    </div>

</header>