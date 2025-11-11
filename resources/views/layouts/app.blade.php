<!DOCTYPE html>
<html lang="en" x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }" :class="{ 'dark': darkMode }">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard - Ron Logistics' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

     <!-- Dark mode initialization -->
    <script>
        try {
            const darMode = localStorage.getItem('darkMode');
            if (darkMode === 'true') {
                document.documentElement.classList.add('dark');
                document.documentElement.style.colorScheme = 'dark';
            }
        } catch (e) {
            console.log('Dark mode initialization error:', e);
        }
    </script>
</head>

<body class="h-full bg-gray-50 dark:bg-[#252b3b] transition-colors duration-200">
    
    <div class="flex h-screen overflow-hidden">
        
        <!-- Sidebar -->
        <x-sidebar />
        
        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col overflow-hidden">
            
            <!-- Top Navbar -->
            <x-navbar />
            
            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-6 bg-gray-50 dark:bg-[#252b3b]">
                {{ $slot }}
            </main>
            
        </div>
    </div>
    
    @livewireScripts
</body>

</html>