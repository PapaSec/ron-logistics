<x-app-layout>
    <x-slot name="title">Dashboard - Ron Logistics</x-slot>
    
    <div class="space-y-6">
        
        <!-- Welcome Message -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-2xl font-bold text-gray-900">Welcome back, {{ auth()->user()->name }}! 👋</h2>
            <p class="text-gray-600 mt-2">Here's what's happening with your logistics today.</p>
        </div>
        
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            
            <!-- Card 1 -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Total Shipments</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">1,234</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-box text-blue-600 text-xl"></i>
                    </div>
                </div>
            </div>
            
            <!-- Card 2 -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Active Deliveries</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">89</p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-truck text-green-600 text-xl"></i>
                    </div>
                </div>
            </div>
            
            <!-- Card 3 -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Completed</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">567</p>
                    </div>
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-check-circle text-purple-600 text-xl"></i>
                    </div>
                </div>
            </div>
            
            <!-- Card 4 -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Revenue</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">$45K</p>
                    </div>
                    <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-dollar-sign text-yellow-600 text-xl"></i>
                    </div>
                </div>
            </div>
            
        </div>
        
    </div>
    
</x-app-layout>