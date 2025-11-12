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
                    <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center">
                        <i class="fas fa-truck text-white"></i>
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

        <!-- Right side - Register form section -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-white">
            <div class="w-full max-w-md">

                <!-- Mobile-only sign in button (top right on mobile) -->
                <div class="flex justify-end mb-8 lg:hidden">
                    <a href="{{ route('login') }}" class="px-6 py-2 bg-black text-white rounded-full">
                        Sign in
                    </a>
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

                <!-- Main register form -->
                <form wire:submit="register" class="space-y-6">

                    <!-- Name input field -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Your Full Name
                        </label>
                        <div class="relative group">
                            <i class="fas fa-user absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-blue-500 transition-colors pointer-events-none"
                                aria-hidden="true"></i>

                            <input type="text" wire:model="name" placeholder="Jack Doe"
                                class="w-full pl-10 px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-transparent"
                                required>
                        </div>
                        @error('name')
                            <span class="text-sm text-red-600 mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Email input field -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Your Email
                        </label>
                        <div class="relative group">
                            <i class="fas fa-envelope absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-blue-500 transition-colors pointer-events-none"
                                aria-hidden="true"></i>

                            <input type="email" wire:model="email" placeholder="info@gmail.com"
                                class="w-full pl-10 px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-transparent"
                                required>
                        </div>
                        @error('email')
                            <span class="text-sm text-red-600 mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password input field with show/hide toggle -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Password
                        </label>
                        <div class="relative group">
                            <i class="fas fa-lock absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-blue-500 transition-colors pointer-events-none"
                                aria-hidden="true"></i>
                            <div class="relative" x-data="{ show: false }">
                                <input :type="show ? 'text' : 'password'" wire:model="password"
                                    class="w-full pl-10 px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-transparent"
                                    placeholder="••••••••" required>
                                <!-- Password visibility toggle button -->
                                <button type="button" @click="show = !show"
                                    class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                    <i :class="show ? 'far fa-eye-slash' : 'far fa-eye'"></i>
                                </button>
                            </div>
                        </div>
                        <!-- Password validation error -->
                        @error('password')
                            <span class="text-sm text-red-600 mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Register submit button -->
                    <button type="submit" wire:loading.attr="disabled"
                        class="w-full py-3 bg-black text-white rounded-lg font-medium hover:bg-gray-800 active:bg-gray-900 transition disabled:opacity-70 disabled:cursor-not-allowed inline-flex items-center justify-center gap-2">

                        <i wire:loading.remove wire:target="register" class="fas fa-user-plus"></i> <i wire:loading
                            wire:target="register" class="fas fa-spinner fa-spin"></i>

                        <span wire:loading.remove wire:target="register">Register</span>
                        <span wire:loading wire:target="register">Registering...</span>
                    </button>

                    <!-- Divider between register and login option -->
                    <div class="relative my-6">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-4 bg-white text-gray-500">or Sign In Below</span>
                        </div>
                    </div>

                    <!-- Login link -->
                    <p class="text-center text-sm text-gray-600 mt-6">
                        Already have an account?
                        <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-700 font-medium">
                            Sign In
                        </a>
                    </p>

                </form>
            </div>
        </div>

    </div>

</div>