<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard - Ron Logistics' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])    
    @livewireStyles
</head>
<body class="bg-gray-50">
    
    <div class="flex h-screen overflow-hidden">
        
        <!-- Sidebar -->
        <x-sidebar />
        
        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col overflow-hidden">
            
            <!-- Top Navbar -->
            <x-navbar />
            
            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-6">
                {{ $slot }}
            </main>
            
        </div>
    </div>
    
    @livewireScripts
</body>
</html>