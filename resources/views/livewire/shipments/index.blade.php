<div class="space-y-6">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                <i class="fas fa-list-ul text-blue-500 mr-2"></i> All Shipments List
            </h2>
            <p class="text-gray-600 dark:text-gray-400">Manage all registered Shipments here!</p>
        </div>

        <x-button href="{{ route('shipments.create') }}" icon="fas fa-plus-circle">
            New Shipments
        </x-button>
    </div>

    <!-- Filters -->
    <div class="grid grid-cols-4 gap-4">
        <!-- Search input -->
        <!-- Status filter -->
        <!-- Priority filter -->
        <!-- Per page selector -->
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