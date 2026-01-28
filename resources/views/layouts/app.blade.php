<!DOCTYPE html>
<html lang="en" 
      x-data="{
          darkMode: localStorage.getItem('darkMode') === 'true',
          pageLoaded: false,
          sidebarCollapsed: localStorage.getItem('sidebarCollapsed') === 'true'
      }" 
      :class="{ 'dark': darkMode }">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard - Ron Logistics' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <!-- Leaflet CSS (adjust if needed) -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script>
        try {
            const darkMode = localStorage.getItem('darkMode');
            if (darkMode === 'true') {
                document.documentElement.classList.add('dark');
                document.documentElement.style.colorScheme = 'dark';
            }
        } catch (e) {
            console.log('Dark mode initialization error:', e);
        }
    </script>
</head>

<body class="h-full bg-gray-100 dark:bg-[#252b3b] transition-colors duration-200"
      x-init="
          $watch('darkMode', val => {
              if (val) {
                  document.documentElement.classList.add('dark');
                  localStorage.setItem('darkMode', 'true');
              } else {
                  document.documentElement.classList.remove('dark');
                  localStorage.setItem('darkMode', 'false');
              }
          });
          $watch('sidebarCollapsed', val => {
              localStorage.setItem('sidebarCollapsed', val);
          });
          window.addEventListener('load', () => {
              setTimeout(() => { pageLoaded = true }, 200);
          });
          document.addEventListener('livewire:initialized', () => {
              setTimeout(() => { pageLoaded = true }, 200);
          });
      ">

    <!-- Loading overlay -->
    <div x-show="!pageLoaded" x-transition:leave.duration.500ms
         class="fixed inset-0 bg-[#252b3b] dark:bg-[#1a1f2e] z-[9999] flex items-center justify-center flex-col gap-4">
        <div class="relative flex items-center justify-center w-24 h-24">
            <div class="absolute inset-0 border-4 border-blue-500/50 rounded-full animate-spin-slow"></div>
            <i class="fas fa-truck-moving text-4xl text-blue-400 animate-pulse"></i>
        </div>
        <div class="text-white text-lg font-semibold tracking-wider flex items-center gap-2">
            <span class="text-blue-400">RON</span>
            <span class="text-gray-300">LOGISTICS</span>
            <span class="text-sm font-light text-blue-500 animate-pulse">. . .</span>
        </div>
        <div class="w-64 h-1 bg-gray-700 rounded-full overflow-hidden mt-2">
            <div class="h-full bg-blue-500 animate-progress w-1/2"></div>
        </div>
    </div>

    <div class="flex h-screen overflow-hidden">
        <!-- Collapsible Sidebar -->
        <aside x-data
              class="bg-[#E4EBE7] dark:bg-[#1f2431] border-r border-gray-200 dark:border-gray-800 flex flex-col transition-all duration-300 ease-in-out z-30"
              :class="sidebarCollapsed ? 'w-16' : 'w-64'">

            <!-- Sidebar content with collapsed prop -->
            <x-sidebar :collapsed="sidebarCollapsed" />

        </aside>

        <!-- Main content wrapper -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <x-navbar @toggle-sidebar="sidebarCollapsed = !sidebarCollapsed" :sidebar-collapsed="sidebarCollapsed" />
            <main class="flex-1 overflow-y-auto p-6 bg-gray-300 dark:bg-[#141822] transition-colors duration-200">
                {{ $slot }}
            </main>
        </div>
    </div>

    @livewireScripts
    @stack('scripts')
</body>

<style>
    @keyframes progress {
        0% { transform: translateX(-100%) }
        100% { transform: translateX(100%) }
    }
    .animate-progress {
        animation: progress 2s infinite linear;
    }
    .animate-spin-slow {
        animation: spin 3s linear infinite;
    }
</style>
</html>