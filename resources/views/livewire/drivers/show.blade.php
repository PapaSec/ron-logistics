<div class="space-y-6">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                <i class="fas fa-id-card text-[#138898] mr-2"></i> Driver Details
            </h2>
            <p class="text-gray-600 dark:text-gray-400">Complete information for driver: {{ $driver->driver_number }}</p>
        </div>

        <div class="flex items-center space-x-3">
            <x-button style="back" href="{{ route('drivers.index') }}" icon="fas fa-arrow-left">
                Back to List
            </x-button>
            <x-button href="{{ route('drivers.edit', $driver->id) }}" style="edit" icon="fas fa-edit">
                Edit Driver
            </x-button>
        </div>
    </div>

    <!-- Driver Banner -->
    <div class="bg-[#138898] rounded-xl p-6 text-white">
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="h-20 w-20 rounded-full bg-white/20 flex items-center justify-center text-3xl font-bold">
                    {{ substr($driver->first_name, 0, 1) }}{{ substr($driver->last_name, 0, 1) }}
                </div>
                <div>
                    <p class="text-sm font-medium text-blue-100">Driver Number</p>
                    <h1 class="text-3xl font-bold mt-1">{{ $driver->driver_number }}</h1>
                    <p class="text-blue-100 mt-2">
                        <i class="fas fa-user mr-2"></i>
                        {{ $driver->full_name }}
                    </p>
                </div>
            </div>
            <div class="mt-4 md:mt-0 text-right">
                <div class="text-sm text-blue-100">Current Status</div>
                <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium !text-white !border-white !bg-white/20 mt-1">
                    <i class="fas {{ $statusConfig['icon'] }} mr-2"></i>
                    {{ ucfirst(str_replace('_', ' ', $driver->status)) }}
                </span>
            </div>
        </div>
    </div>

    <!-- Alerts -->
    @if($driver->licenseExpiringSoon())
        <div class="bg-orange-50 dark:bg-orange-900/20 border-l-4 border-orange-500 p-4 rounded-lg">
            <div class="flex items-center">
                <i class="fas fa-exclamation-triangle text-orange-500 mr-3 text-xl"></i>
                <div>
                    <p class="text-orange-800 dark:text-orange-300 font-medium">License Expiring Soon</p>
                    <p class="text-sm text-orange-700 dark:text-orange-400 mt-1">
                        Driver's license expires on {{ $driver->license_expiry->format('M d, Y') }}
                        ({{ $driver->days_until_license_expiry }} days remaining)
                    </p>
                </div>
            </div>
        </div>
    @endif

    @if($driver->medicalCheckupDue())
        <div class="bg-red-50 dark:bg-red-900/20 border-l-4 border-red-500 p-4 rounded-lg">
            <div class="flex items-center">
                <i class="fas fa-heartbeat text-red-500 mr-3 text-xl"></i>
                <div>
                    <p class="text-red-800 dark:text-red-300 font-medium">Medical Checkup Overdue</p>
                    <p class="text-sm text-red-700 dark:text-red-400 mt-1">
                        Medical checkup was due on {{ $driver->next_medical_checkup->format('M d, Y') }}
                    </p>
                </div>
            </div>
        </div>
    @endif

    <!-- Main Information Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Contact Information -->
        <div class="bg-[#E4EBE7] dark:bg-[#1f2431] rounded-xl p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                <i class="fas fa-address-card text-blue-500 mr-3"></i>
                Contact Information
            </h3>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Full Name</label>
                    <p class="mt-1 text-sm text-gray-900 dark:text-white font-medium">{{ $driver->full_name }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Email</label>
                    <p class="mt-1 text-sm text-gray-900 dark:text-white">
                        @if($driver->email)
                            <a href="mailto:{{ $driver->email }}" class="text-[#138898] hover:underline">
                                {{ $driver->email }}
                            </a>
                        @else
                            <span class="text-gray-400">Not provided</span>
                        @endif
                    </p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Phone</label>
                    <p class="mt-1 text-sm text-gray-900 dark:text-white">
                        <a href="tel:{{ $driver->phone }}" class="text-[#138898] hover:underline">
                            {{ $driver->phone }}
                        </a>
                    </p>
                </div>
                @if($driver->phone_alt)
                    <div>
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Alternative Phone</label>
                        <p class="mt-1 text-sm text-gray-900 dark:text-white">
                            <a href="tel:{{ $driver->phone_alt }}" class="text-[#138898] hover:underline">
                                {{ $driver->phone_alt }}
                            </a>
                        </p>
                    </div>
                @endif
            </div>
        </div>

        <!-- License Information -->
        <div class="bg-[#E4EBE7] dark:bg-[#1f2431] rounded-xl p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                <i class="fas fa-id-badge text-green-500 mr-3"></i>
                License Information
            </h3>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">License Number</label>
                    <p class="mt-1">
                        <span class="inline-flex items-center px-3 py-1 rounded-md text-sm font-mono font-semibold bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-gray-100 border border-gray-300 dark:border-gray-700">
                            {{ $driver->license_number }}
                        </span>
                    </p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">License Type</label>
                    <p class="mt-1 text-sm text-gray-900 dark:text-white font-medium">{{ $driver->license_type }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Expiry Date</label>
                    <p class="mt-1 text-sm text-gray-900 dark:text-white font-medium">
                        {{ $driver->license_expiry->format('F d, Y') }}
                        <span class="block text-xs text-gray-500 mt-1">
                            ({{ $driver->license_expiry->diffForHumans() }})
                        </span>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Driver Stats -->
    <div class="bg-[#E4EBE7] dark:bg-[#1f2431] rounded-xl p-6">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-6 flex items-center">
            <i class="fas fa-chart-bar text-yellow-500 mr-3"></i>
            Driver Statistics
        </h3>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="text-center p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                <i class="fas fa-briefcase text-blue-500 text-2xl mb-3"></i>
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Employment Type</p>
                <p class="text-lg font-semibold text-gray-900 dark:text-white mt-1">
                    {{ ucfirst(str_replace('_', ' ', $driver->employment_type)) }}
                </p>
            </div>
            
            <div class="text-center p-4 bg-green-50 dark:bg-green-900/20 rounded-lg">
                <i class="fas fa-calendar-check text-green-500 text-2xl mb-3"></i>
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Hire Date</p>
                <p class="text-lg font-semibold text-gray-900 dark:text-white mt-1">
                    @if($driver->hire_date)
                        {{ $driver->hire_date->format('M d, Y') }}
                    @else
                        N/A
                    @endif
                </p>
            </div>
            
            <div class="text-center p-4 bg-purple-50 dark:bg-purple-900/20 rounded-lg">
                <i class="fas fa-truck text-purple-500 text-2xl mb-3"></i>
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Assigned Vehicles</p>
                <p class="text-lg font-semibold text-gray-900 dark:text-white mt-1">
                    {{ $driver->vehicles()->count() }}
                </p>
            </div>
            
            <div class="text-center p-4 bg-orange-50 dark:bg-orange-900/20 rounded-lg">
                <i class="fas fa-toggle-on text-orange-500 text-2xl mb-3"></i>
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Status</p>
                <p class="text-lg font-semibold text-gray-900 dark:text-white mt-1">
                    {{ ucfirst(str_replace('_', ' ', $driver->status)) }}
                </p>
            </div>
        </div>
    </div>

    <!-- Additional Information Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Address Information -->
        <div class="bg-[#E4EBE7] dark:bg-[#1f2431] rounded-xl p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                <i class="fas fa-map-marker-alt text-blue-500 mr-3"></i>
                Address
            </h3>
            <div class="space-y-3">
                @if($driver->address || $driver->city || $driver->state)
                    @if($driver->address)
                        <p class="text-sm text-gray-900 dark:text-white">{{ $driver->address }}</p>
                    @endif
                    <p class="text-sm text-gray-900 dark:text-white">
                        @if($driver->city){{ $driver->city }}@endif
                        @if($driver->city && $driver->state), @endif
                        @if($driver->state){{ $driver->state }}@endif
                        @if($driver->postal_code) {{ $driver->postal_code }}@endif
                    </p>
                @else
                    <p class="text-gray-400 text-sm italic">No address on file</p>
                @endif
            </div>
        </div>

        <!-- Emergency Contact -->
        <div class="bg-[#E4EBE7] dark:bg-[#1f2431] rounded-xl p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                <i class="fas fa-phone-square text-red-500 mr-3"></i>
                Emergency Contact
            </h3>
            <div class="space-y-3">
                @if($driver->emergency_contact_name)
                    <div>
                        <label class="block text-xs font-medium text-gray-500 dark:text-gray-400">Name</label>
                        <p class="text-sm text-gray-900 dark:text-white font-medium">{{ $driver->emergency_contact_name }}</p>
                    </div>
                    @if($driver->emergency_contact_phone)
                        <div>
                            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400">Phone</label>
                            <p class="text-sm text-gray-900 dark:text-white">
                                <a href="tel:{{ $driver->emergency_contact_phone }}" class="text-[#138898] hover:underline">
                                    {{ $driver->emergency_contact_phone }}
                                </a>
                            </p>
                        </div>
                    @endif
                    @if($driver->emergency_contact_relationship)
                        <div>
                            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400">Relationship</label>
                            <p class="text-sm text-gray-900 dark:text-white">{{ $driver->emergency_contact_relationship }}</p>
                        </div>
                    @endif
                @else
                    <p class="text-gray-400 text-sm italic">No emergency contact</p>
                @endif
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-[#E4EBE7] dark:bg-[#1f2431] rounded-xl p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                <i class="fas fa-bolt text-yellow-500 mr-3"></i>
                Quick Actions
            </h3>
            <div class="space-y-3">
                <x-button href="{{ route('drivers.edit', $driver->id) }}" style="edit" class="w-full justify-center" icon="fas fa-edit">
                    Edit Driver
                </x-button>
                <button 
                    wire:click="confirmDelete"
                    class="w-full px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition flex items-center justify-center"
                >
                    <i class="fas fa-trash mr-2"></i>
                    Delete Driver
                </button>
                <x-button style="back" href="{{ route('drivers.index') }}" class="w-full justify-center" icon="fas fa-arrow-left">
                    Back to List
                </x-button>
            </div>
        </div>
    </div>

    <!-- Medical & Metadata -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Medical Information -->
        <div class="bg-[#E4EBE7] dark:bg-[#1f2431] rounded-xl p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                <i class="fas fa-heartbeat text-red-500 mr-3"></i>
                Medical Information
            </h3>
            <div class="space-y-3">
                <div class="flex justify-between items-center py-2 border-b border-gray-200 dark:border-gray-700">
                    <span class="text-sm text-gray-500 dark:text-gray-400">Last Checkup</span>
                    <span class="text-sm text-gray-900 dark:text-white font-medium">
                        @if($driver->last_medical_checkup)
                            {{ $driver->last_medical_checkup->format('M d, Y') }}
                        @else
                            Not recorded
                        @endif
                    </span>
                </div>
                <div class="flex justify-between items-center py-2">
                    <span class="text-sm text-gray-500 dark:text-gray-400">Next Checkup</span>
                    <span class="text-sm text-gray-900 dark:text-white font-medium">
                        @if($driver->next_medical_checkup)
                            {{ $driver->next_medical_checkup->format('M d, Y') }}
                        @else
                            Not scheduled
                        @endif
                    </span>
                </div>
            </div>
        </div>

        <!-- Driver Metadata -->
        <div class="bg-[#E4EBE7] dark:bg-[#1f2431] rounded-xl p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                <i class="fas fa-info-circle text-gray-500 mr-3"></i>
                Record Information
            </h3>
            <div class="space-y-3">
                <div class="flex justify-between items-center py-2 border-b border-gray-200 dark:border-gray-700">
                    <span class="text-sm text-gray-500 dark:text-gray-400">Driver ID</span>
                    <span class="text-sm text-gray-900 dark:text-white font-medium">#{{ $driver->id }}</span>
                </div>
                <div class="flex justify-between items-center py-2 border-b border-gray-200 dark:border-gray-700">
                    <span class="text-sm text-gray-500 dark:text-gray-400">Created Date</span>
                    <span class="text-sm text-gray-900 dark:text-white">{{ $driver->created_at->format('M d, Y') }}</span>
                </div>
                <div class="flex justify-between items-center py-2">
                    <span class="text-sm text-gray-500 dark:text-gray-400">Last Updated</span>
                    <span class="text-sm text-gray-900 dark:text-white">{{ $driver->updated_at->format('M d, Y') }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Notes Section -->
    @if($driver->notes)
        <div class="bg-[#E4EBE7] dark:bg-[#1f2431] rounded-xl p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                <i class="fas fa-sticky-note text-yellow-500 mr-3"></i>
                Notes
            </h3>
            <div class="bg-white dark:bg-white/5 p-4 rounded-lg border border-gray-200 dark:border-white/10">
                <p class="text-sm text-gray-900 dark:text-white whitespace-pre-wrap">{{ $driver->notes }}</p>
            </div>
        </div>
    @endif

    <!-- Delete Modal -->
    @if ($showDeleteModal)
        <div class="fixed inset-0 z-50 overflow-y-auto">
            <div class="fixed inset-0 bg-black/50 backdrop-blur-sm transition-opacity"></div>
            
            <div class="flex min-h-screen items-center justify-center p-4">
                <div class="relative bg-white dark:bg-gray-800 rounded-lg shadow-xl max-w-md w-full p-6 z-10">
                    
                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 dark:bg-red-900/30">
                        <i class="fas fa-exclamation-triangle text-red-600 dark:text-red-400 text-xl"></i>
                    </div>
                    
                    <div class="mt-4 text-center">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">Delete Driver?</h3>
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                            Are you sure you want to delete <strong>{{ $driver->full_name }}</strong>? This action cannot be undone.
                        </p>
                    </div>
                    
                    <div class="mt-6 flex gap-3">
                        <button 
                            wire:click="cancelDelete"
                            class="flex-1 px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition"
                        >
                            Cancel
                        </button>
                        <button 
                            wire:click="delete"
                            class="flex-1 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition"
                        >
                            Delete
                        </button>
                    </div>
                    
                </div>
            </div>
        </div>
    @endif
</div>