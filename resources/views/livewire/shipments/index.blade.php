<div class="space-y-6">
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <!-- Total Items -->
        <div class="bg-[#E4EBE7] dark:bg-[#272d3e] text-black/50 dark:text-white p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-2xl font-bold">898</p>
                    <p class="text-sm opacity-60">Total Items</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 dark:bg-blue-950/50 rounded-lg flex items-center justify-center">
                    <i class="fas fa-box text-blue-600 dark:text-blue-400 text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Pending -->
        <div class="bg-[#E4EBE7] dark:bg-[#272d3e] text-black/50 dark:text-white p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-2xl font-bold">898</p>
                    <p class="text-sm opacity-60">Pending</p>
                </div>
                <div class="w-12 h-12 bg-yellow-700 dark:bg-yellow-600 rounded-lg flex items-center justify-center">
                <i class="fa-solid fa-p text-yellow-600 dark:text-yellow-400"></i>
                </div>
            </div>
        </div>

        <!-- In Transit -->
        <div class="bg-[#E4EBE7] dark:bg-[#272d3e] text-black/50 dark:text-white p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-2xl font-bold">898</p>
                    <p class="text-sm opacity-60">In Transit</p>
                </div>
                <i class="fas fa-shipping-fast"></i>
            </div>
        </div>

        <!-- Delivered -->
        <div class="bg-[#E4EBE7] dark:bg-[#272d3e] text-black/50 dark:text-white p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-2xl font-bold">898</p>
                    <p class="text-sm opacity-60">Delivered</p>
                </div>
                <i class="fas fa-truck"></i>
            </div>
        </div>
    </div>

    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                <i class="fas fa-list-ul text-blue-500 mr-2"></i> All Shipments List
            </h2>
            <p class="text-gray-600 dark:text-gray-400">Manage and track all shipments across your logistics network</p>
        </div>

        <x-button href="{{ route('shipments.create') }}" icon="fas fa-plus-circle">
            New Shipments
        </x-button>
    </div>

    <div class="bg-[#E4EBE7] dark:bg-[#272d3e] rounded-lg shadow-sm border-gray-200 dark:border-gray-700 p-6">
        <!-- Filters -->
        <div class="grid grid-cols-4 gap-4">
            <div>
                <!-- Search input -->
                <!-- Status filter -->
                <!-- Priority filter -->
                <!-- Per page selector -->
                <!-- Clear Search button -->
            </div>
        </div>

        <!-- Shipments Table -->
        <div class="bg-white dark:bg-gray-900 rounded-lg shadow">
            <table class="w-full">
                <thead>
                    <!-- Headers -->
                </thead>
                <tbody>
                    <!-- Rows -->
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div>

        </div>
    </div>
</div>