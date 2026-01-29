<header class="h-18 bg-[#232838] border-b border-gray-800/50 backdrop-blur-sm shadow-lg" x-data="{ 
        darkMode: localStorage.getItem('darkMode') === 'true', 
        searchFocused: false,
        profileOpen: false 
    }" x-init="
        $watch('darkMode', val => { 
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
        }
    ">

    <div class="h-full flex items-center justify-between px-6 max-w-screen-2xl mx-auto">

        <!-- Left Section: Sidebar Toggle and Connection Status -->
        <div class="flex items-center gap-4">
            <!-- Sidebar Toggle Button -->
            <button @click="$store.sidebar.toggle()"
                    class="p-2.5 text-gray-400 hover:text-white hover:bg-white/10 rounded-lg transition-all duration-200 group"
                    aria-label="Toggle Sidebar"
                    x-tooltip="'Toggle Sidebar'">
                <i class="fas fa-bars text-lg transition-transform duration-300"
                   :class="$store.sidebar.collapsed ? '' : 'rotate-90'"></i>
            </button>

            <!-- Connection Status -->
            <div x-data="{ 
                isSlow: false,
                apiLatency: 150,
                slowThreshold: 500,
                checkConnection() {
                    const newLatency = Math.floor(Math.random() * 800) + 100; 
                    this.apiLatency = newLatency; 
                    this.isSlow = this.apiLatency > this.slowThreshold;
                }
            }" x-init="
                checkConnection();
                setInterval(() => checkConnection(), 5000); 
            ">

                <div class="hidden lg:flex items-center gap-3 px-3 py-1.5 rounded-lg transition-all duration-300"
                    :class="{ 
                        'bg-blue-600/10 border border-blue-500/20': !isSlow, 
                        'bg-yellow-600/10 border border-yellow-500/30': isSlow 
                    }">

                    <i class="w-4 h-4 transition-colors duration-300" :class="{ 
                        'fas fa-wifi text-green-500': !isSlow,
                        'fas fa-wifi text-yellow-500': isSlow
                    }"></i>

                    <span class="text-xs font-medium" :class="{ 
                        'text-blue-400': !isSlow, 
                        'text-yellow-400': isSlow 
                    }" x-text="isSlow ? 'Slow Connection' : 'Good Connection'">
                    </span>

                    <span class="text-xs font-mono text-gray-500 dark:text-gray-500 ml-2"
                        x-text="'(' + apiLatency + 'ms)'"></span>

                    <div class="w-2 h-2 rounded-full" :class="{ 
                        'bg-green-500 animate-pulse': !isSlow, 
                        'bg-yellow-500 animate-pulse': isSlow
                    }"></div>
                </div>
            </div>
        </div>

        <!-- Center Section: Search Bar -->
        <div class="hidden md:flex flex-1 max-w-2xl mx-8">
            <div class="relative w-full group">
                <i
                    class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 transition-colors duration-200 group-focus-within:text-blue-400"></i>
                <input type="text" placeholder="Search shipments, fleet, or users..." @focus="searchFocused = true"
                    @blur="searchFocused = false"
                    class="w-full pl-11 pr-4 py-2.5 bg-[#2a3042] text-white placeholder-gray-500 rounded-full focus:border-blue-500/50 focus:bg-white/10 focus:outline-none focus:ring-2 focus:ring-blue-500/20 transition-all duration-200">
                <div x-show="searchFocused" x-transition
                    class="absolute right-3 top-1/2 -translate-y-1/2 flex items-center gap-1">
                    <kbd
                        class="px-2 py-0.5 text-xs font-semibold text-gray-400 bg-white/5 rounded">Ctrl</kbd>
                    <kbd
                        class="px-2 py-0.5 text-xs font-semibold text-gray-400 bg-white/5 rounded">K</kbd>
                </div>
            </div>
        </div>

        <!-- Right Section: Actions -->
        <div class="flex items-center gap-2">

            <!-- Mobile Search Button -->
            <button
                class="md:hidden p-2.5 text-gray-400 hover:text-white hover:bg-white/10 rounded-lg transition-all duration-200">
                <i class="fas fa-search text-lg"></i>
            </button>

            <!-- Dark Mode Toggle -->
            <button @click="darkMode = !darkMode"
                class="relative p-2.5 text-gray-400 hover:text-white hover:bg-white/10 rounded-lg transition-all duration-200 group"
                aria-label="Toggle dark mode">
                <i class="fas text-lg transition-all duration-300"
                    :class="darkMode ? 'fa-sun text-yellow-400 rotate-180' : 'fa-moon text-gray-400 group-hover:text-blue-400 rotate-0'"></i>
            </button>

            <!-- Notifications -->
            <button
                class="relative p-2.5 text-gray-400 hover:text-white hover:bg-white/10 rounded-lg transition-all duration-200 group">
                <i class="fas fa-bell text-lg"></i>
                <span class="absolute top-1.5 right-1.5 flex h-2 w-2">
                    <span
                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-red-500"></span>
                </span>
                <!-- Notification Badge -->
                <span
                    class="absolute -top-1 -right-1 flex items-center justify-center w-5 h-5 text-xs font-bold text-white bg-red-500 border-2 border-[#1f2431] rounded-full">
                    3
                </span>
            </button>

            <!-- Divider -->
            <div class="hidden lg:block w-px h-8 bg-white/10 mx-2"></div>

            <!-- User Profile Dropdown -->
            <div class="relative">
                <button @click="profileOpen = !profileOpen"
                    class="flex items-center gap-3 hover:bg-white/10 rounded-lg pl-2 pr-3 py-1.5 transition-all duration-200 group">
                    <div class="relative">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=4F46E5&color=fff"
                            alt="{{ auth()->user()->name }}"
                            class="w-9 h-9 rounded-full ring-2 ring-white/10 group-hover:ring-blue-500/50 transition-all duration-200">
                        <span
                            class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 border-2 border-[#1f2431] rounded-full"></span>
                    </div>
                    <div class="text-left hidden lg:block">
                        <p class="text-sm font-medium text-white group-hover:text-blue-400 transition-colors">
                            {{ auth()->user()->name }}</p>
                        <p class="text-xs text-gray-400">Admin</p>
                    </div>
                    <i class="fas fa-chevron-down text-xs text-gray-400 group-hover:text-white transition-all duration-200"
                        :class="{ 'rotate-180': profileOpen }"></i>
                </button>

                <!-- Dropdown Menu -->
                <div x-show="profileOpen" @click.away="profileOpen = false"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
                    x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                    class="absolute top-full right-0 mt-3 w-72 bg-[#1a1f2e] border border-white/10 rounded-xl shadow-2xl overflow-hidden z-50"
                    style="display: none;">
                    <!-- Profile Header -->
                    <div class="p-4 bg-gradient-to-br from-blue-600/20 to-purple-600/20 border-b border-white/10">
                        <div class="flex items-center gap-3">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=4F46E5&color=fff"
                                alt="{{ auth()->user()->name }}" class="w-12 h-12 rounded-full ring-2 ring-white/20">
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold text-white truncate">{{ auth()->user()->name }}</p>
                                <p class="text-xs text-gray-400 truncate">{{ auth()->user()->email }}</p>
                                <span
                                    class="inline-flex items-center gap-1 mt-1 px-2 py-0.5 text-xs font-medium text-green-400 bg-green-500/10 border border-green-500/20 rounded-full">
                                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span>
                                    Active
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Menu Items -->
                    <div class="p-2">
                        <a href="#"
                            class="flex items-center gap-3 px-3 py-2.5 text-sm text-gray-300 hover:text-white hover:bg-white/10 rounded-lg transition-all duration-200 group">
                            <div
                                class="w-8 h-8 flex items-center justify-center bg-blue-500/10 text-blue-400 rounded-lg group-hover:bg-blue-500/20 transition-colors">
                                <i class="fas fa-user text-sm"></i>
                            </div>
                            <div class="flex-1">
                                <p class="font-medium">My Profile</p>
                                <p class="text-xs text-gray-500">View and edit profile</p>
                            </div>
                            <i class="fas fa-chevron-right text-xs text-gray-500 group-hover:text-gray-400"></i>
                        </a>

                        <a href="#"
                            class="flex items-center gap-3 px-3 py-2.5 text-sm text-gray-300 hover:text-white hover:bg-white/10 rounded-lg transition-all duration-200 group">
                            <div
                                class="w-8 h-8 flex items-center justify-center bg-purple-500/10 text-purple-400 rounded-lg group-hover:bg-purple-500/20 transition-colors">
                                <i class="fas fa-cog text-sm"></i>
                            </div>
                            <div class="flex-1">
                                <p class="font-medium">Settings</p>
                                <p class="text-xs text-gray-500">Preferences & security</p>
                            </div>
                            <i class="fas fa-chevron-right text-xs text-gray-500 group-hover:text-gray-400"></i>
                        </a>

                        <a href="#"
                            class="flex items-center gap-3 px-3 py-2.5 text-sm text-gray-300 hover:text-white hover:bg-white/10 rounded-lg transition-all duration-200 group">
                            <div
                                class="w-8 h-8 flex items-center justify-center bg-yellow-500/10 text-yellow-400 rounded-lg group-hover:bg-yellow-500/20 transition-colors">
                                <i class="fas fa-question-circle text-sm"></i>
                            </div>
                            <div class="flex-1">
                                <p class="font-medium">Help & Support</p>
                                <p class="text-xs text-gray-500">Get assistance</p>
                            </div>
                            <i class="fas fa-chevron-right text-xs text-gray-500 group-hover:text-gray-400"></i>
                        </a>
                    </div>

                    <div class="border-t border-white/10 p-2">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full flex items-center gap-3 px-3 py-2.5 text-sm text-red-400 hover:text-red-300 hover:bg-red-500/10 rounded-lg transition-all duration-200 group">
                                <div
                                    class="w-8 h-8 flex items-center justify-center bg-red-500/10 text-red-400 rounded-lg group-hover:bg-red-500/20 transition-colors">
                                    <i class="fas fa-sign-out-alt text-sm"></i>
                                </div>
                                <span class="flex-1 text-left font-medium">Sign Out</span>
                                <i class="fas fa-arrow-right text-xs"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>

</header>