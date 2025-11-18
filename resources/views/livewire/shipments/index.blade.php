<div class="space-y-6">
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
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <!-- Total Items -->
            <!-- Pending -->
            <!-- In Transit -->
            <!-- Delivered -->
        </div>

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