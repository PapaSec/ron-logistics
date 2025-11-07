<div class="min-h-screen flex items-center justify-center p-8">
    <!-- Main container with shadow and rounded corners -->
    <div class="w-full max-w-7xl flex shadow-2xl rounded-xl overflow-hidden">
        
        <!-- Left side - Background image section (hidden on mobile) -->
        <div class="hidden lg:flex lg:w-1/2 relative">
            <!-- Background image -->
            <div class="absolute inset-0 bg-cover bg-center" 
                 style="background-image: url('{{ asset('images/background.jpg') }}');">
            </div>
            
            <!-- Dark overlay for better text readability -->
            <div class="absolute inset-0 bg-gradient-to-b from-black/40 via-black/30 to-black/60">
            </div>
            
            <!-- Content container for left side -->
            <div class="relative z-10 flex flex-col justify-between p-12 w-full">
                
                <!-- Logo section -->
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center">
                        <i class="fas fa-truck text-gray-800"></i>
                    </div>
                    <span class="text-white text-2xl font-semibold">Ron | Logistics</span>
                </div>
                
                <!-- Main text content -->
                <div class="text-white">
                    <h1 class="text-5xl font-bold mb-4">
                        We provide logistics solutions
                    </h1>
                    <p class="text-lg text-white/90">
                        We deliver your goods globally safe and quick.
                    </p>
                    
                    <!-- Carousel indicator dots -->
                    <div class="flex gap-2 mt-8">
                        <div class="w-12 h-1 bg-white rounded"></div>
                        <div class="w-2 h-1 bg-white/40 rounded"></div>
                        <div class="w-2 h-1 bg-white/40 rounded"></div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Right side - Login form section -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-white">
            <div class="w-full max-w-md">
                
                <!-- Mobile-only sign in button (top right on mobile) -->
                <div class="flex justify-end mb-8 lg:hidden">
                    <button class="px-6 py-2 bg-black text-white rounded-full">
                        Sign in
                    </button>
                </div>
                
                <!-- Welcome text section -->
                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">
                        Welcome to Ron Logistics!
                    </h2>
                    <p class="text-gray-600 font-bold text-center">
                        Create your account
                    </p>
                </div>
                
                <!-- Main login form -->
                <form wire:submit="login" class="space-y-6">
                    
                    <!-- Email input field -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Your Email
                        </label>
                        <input 
                            type="email"
                            wire:model="email"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="info@gmail.com"
                        >
                        <!-- Email validation error -->
                        @error('email')
                            <span class="text-sm text-red-600 mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <!-- Password input field with show/hide toggle -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Password
                        </label>
                        <div class="relative" x-data="{ show: false }">
                            <input 
                                :type="show ? 'text' : 'password'"
                                wire:model="password"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent pr-12"
                                placeholder="••••••••"
                            >
                            <!-- Password visibility toggle button -->
                            <button 
                                type="button"
                                @click="show = !show"
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600"
                            >
                                <i :class="show ? 'far fa-eye-slash' : 'far fa-eye'"></i>
                            </button>
                        </div>
                        <!-- Password validation error -->
                        @error('password')
                            <span class="text-sm text-red-600 mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Confirm Password input field with show/hide toggle -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Confirm Password
                        </label>
                        <div class="relative" x-data="{ show: false }">
                            <input 
                                :type="show ? 'text' : 'password'"
                                wire:model="password_confirmation"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent pr-12"
                                placeholder="••••••••"
                            >
                            <!-- Password visibility toggle button -->
                            <button 
                                type="button"
                                @click="show = !show"
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600"
                            >
                                <i :class="show ? 'far fa-eye-slash' : 'far fa-eye'"></i>
                            </button>
                        </div>
                        <!-- Confirm Password validation error -->
                        @error('password_confirmation')
                            <span class="text-sm text-red-600 mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <!-- Login submit button -->
                    <button 
                        type="submit"
                        class="w-full py-3 bg-black text-white rounded-lg font-medium hover:bg-gray-800 transition"
                    >
                        Register
                    </button>
                    
                    <!-- Divider between login and social buttons -->
                    <div class="relative my-6">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-4 bg-white text-gray-500">or Login</span>
                        </div>
                    </div>
                    
                    <!-- Registration link -->
                    <p class="text-center text-sm text-gray-600 mt-6">
                        Do you have any account? 
                        <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-700 font-medium">
                            Login
                        </a>
                    </p>
                    
                </form>
            </div>
        </div>
        
    </div>

</div>