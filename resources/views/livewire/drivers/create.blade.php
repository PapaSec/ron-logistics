<div class="space-y-6">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                <i class="fas fa-plus text-[#138898] mr-2"></i> Add New Driver
            </h2>
            <p class="text-gray-600 dark:text-gray-400">Register a new driver to your fleet</p>
        </div>

        <x-button style="back" href="{{ route('drivers.index') }}" icon="fas fa-arrow-left">
            Back to List
        </x-button>
    </div>

    <!-- Driver Number Display -->
    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 border border-blue-500/20 p-4 rounded-lg mb-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Driver Number</p>
                <p class="text-2xl font-bold text-[#138898] mt-1">{{ $driver_number }}</p>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                    <i class="fas fa-info-circle mr-1"></i>
                    This driver number will be auto-assigned
                    <span class="inline-block w-2 h-2 bg-[#138898] rounded-full animate-pulse ml-2"></span>
                </p>
            </div>
            <div class="flex items-center gap-3">
                <button 
                    type="button"
                    wire:click="generateDriverNumber"
                    class="text-sm text-[#138898] hover:text-[#023543] dark:text-[#138898] dark:hover:text-[#1fa8bd] transition font-medium"
                >
                    <i class="fas fa-sync-alt mr-1"></i> Regenerate
                </button>
                <div class="text-[#138898]">
                    <i class="fas fa-id-card text-4xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Flash Messages -->
    @if (session()->has('success'))
        <div class="bg-green-50 dark:bg-green-900/30 border-l-4 border-green-500 p-4 rounded-lg mb-4">
            <div class="flex items-center">
                <i class="fas fa-check-circle text-green-500 mr-3 text-xl"></i>
                <p class="text-green-800 dark:text-green-300 font-medium">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="bg-red-50 dark:bg-red-900/30 border-l-4 border-red-500 p-4 rounded-lg mb-4">
            <div class="flex items-center">
                <i class="fas fa-times-circle text-red-500 mr-3 text-xl"></i>
                <p class="text-red-800 dark:text-red-300 font-medium">{{ session('error') }}</p>
            </div>
        </div>
    @endif

    <!-- Driver Creation Form -->
    <div class="bg-[#E4EBE7] dark:bg-[#1f2431] rounded-lg shadow-sm p-6">
        <form wire:submit.prevent="save" class="space-y-6">
            @csrf

            <!-- Basic Information -->
            <div>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">
                    <i class="fas fa-user text-[#138898] mr-3"></i>Basic Information
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <x-inputs.text 
                        label="Driver Number" 
                        name="driver_number" 
                        model="driver_number" 
                        icon="fas fa-hashtag"
                        placeholder="DRV-001" 
                        required 
                    />
                    @error('driver_number')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror

                    <x-inputs.text 
                        label="First Name" 
                        name="first_name" 
                        model="first_name" 
                        icon="fas fa-user"
                        placeholder="John" 
                        required 
                    />
                    @error('first_name')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror

                    <x-inputs.text 
                        label="Last Name" 
                        name="last_name" 
                        model="last_name" 
                        icon="fas fa-user"
                        placeholder="Doe" 
                        required 
                    />
                    @error('last_name')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror

                    <x-inputs.text 
                        label="Email" 
                        name="email" 
                        model="email" 
                        type="email"
                        icon="fas fa-envelope"
                        placeholder="john.doe@example.com" 
                    />
                    @error('email')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror

                    <x-inputs.text 
                        label="Phone" 
                        name="phone" 
                        model="phone" 
                        type="tel"
                        icon="fas fa-phone"
                        placeholder="+1 234 567 8900" 
                        required 
                    />
                    @error('phone')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror

                    <x-inputs.text 
                        label="Alternative Phone" 
                        name="phone_alt" 
                        model="phone_alt" 
                        type="tel"
                        icon="fas fa-phone-alt"
                        placeholder="+1 234 567 8900" 
                    />
                    @error('phone_alt')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>
            </div>

            <!-- License Information -->
            <div>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">
                    <i class="fas fa-id-badge text-[#138898] mr-3"></i>License Information
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <x-inputs.text 
                        label="License Number" 
                        name="license_number" 
                        model="license_number" 
                        icon="fas fa-id-card"
                        placeholder="DL123456" 
                        required 
                    />
                    @error('license_number')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror

                    <x-inputs.select 
                        label="License Type" 
                        name="license_type" 
                        model="license_type" 
                        icon="fas fa-certificate"
                        :options="$licenseTypes"
                        required 
                    />
                    @error('license_type')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror

                    <x-inputs.date 
                        label="License Expiry" 
                        name="license_expiry" 
                        model="license_expiry" 
                        icon="fas fa-calendar-times"
                        required 
                    />
                    @error('license_expiry')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>
            </div>

            <!-- Employment Details -->
            <div>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">
                    <i class="fas fa-briefcase text-[#138898] mr-3"></i>Employment Details
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <x-inputs.date 
                        label="Hire Date" 
                        name="hire_date" 
                        model="hire_date" 
                        icon="fas fa-calendar-check"
                    />
                    @error('hire_date')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror

                    <x-inputs.select 
                        label="Employment Type" 
                        name="employment_type" 
                        model="employment_type" 
                        icon="fas fa-user-tie"
                        :options="[
                            'full_time' => 'Full Time',
                            'part_time' => 'Part Time',
                            'contract' => 'Contract'
                        ]"
                        required 
                    />
                    @error('employment_type')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror

                    <x-inputs.select 
                        label="Status" 
                        name="status" 
                        model="status" 
                        icon="fas fa-toggle-on"
                        :options="[
                            'active' => 'Active',
                            'inactive' => 'Inactive',
                            'on_leave' => 'On Leave',
                            'suspended' => 'Suspended'
                        ]"
                        required 
                    />
                    @error('status')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>
            </div>

            <!-- Address Information -->
            <div>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">
                    <i class="fas fa-map-marker-alt text-[#138898] mr-3"></i>Address Information
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <x-inputs.textarea 
                            label="Address" 
                            name="address" 
                            model="address" 
                            icon="fas fa-home"
                            rows="2"
                            placeholder="Street address..."
                        />
                        @error('address')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                    </div>

                    <x-inputs.text 
                        label="City" 
                        name="city" 
                        model="city" 
                        icon="fas fa-city"
                        placeholder="City" 
                    />
                    @error('city')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror

                    <x-inputs.text 
                        label="State/Province" 
                        name="state" 
                        model="state" 
                        icon="fas fa-map"
                        placeholder="State" 
                    />
                    @error('state')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror

                    <x-inputs.text 
                        label="Postal Code" 
                        name="postal_code" 
                        model="postal_code" 
                        icon="fas fa-mailbox"
                        placeholder="12345" 
                    />
                    @error('postal_code')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>
            </div>

            <!-- Emergency Contact -->
            <div>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">
                    <i class="fas fa-phone-square text-[#138898] mr-3"></i>Emergency Contact
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <x-inputs.text 
                        label="Contact Name" 
                        name="emergency_contact_name" 
                        model="emergency_contact_name" 
                        icon="fas fa-user-friends"
                        placeholder="Emergency contact name" 
                    />
                    @error('emergency_contact_name')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror

                    <x-inputs.text 
                        label="Contact Phone" 
                        name="emergency_contact_phone" 
                        model="emergency_contact_phone" 
                        type="tel"
                        icon="fas fa-phone"
                        placeholder="+1 234 567 8900" 
                    />
                    @error('emergency_contact_phone')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror

                    <x-inputs.text 
                        label="Relationship" 
                        name="emergency_contact_relationship" 
                        model="emergency_contact_relationship" 
                        icon="fas fa-heart"
                        placeholder="e.g., Spouse, Parent" 
                    />
                    @error('emergency_contact_relationship')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>
            </div>

            <!-- Medical Information -->
            <div>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">
                    <i class="fas fa-heartbeat text-[#138898] mr-3"></i>Medical Information
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <x-inputs.date 
                        label="Last Medical Checkup" 
                        name="last_medical_checkup" 
                        model="last_medical_checkup" 
                        icon="fas fa-calendar-check"
                    />
                    @error('last_medical_checkup')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror

                    <x-inputs.date 
                        label="Next Medical Checkup" 
                        name="next_medical_checkup" 
                        model="next_medical_checkup" 
                        icon="fas fa-calendar-plus"
                    />
                    @error('next_medical_checkup')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>
            </div>

            <!-- Additional Information -->
            <div>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">
                    <i class="fas fa-sticky-note text-[#138898] mr-3"></i>Additional Information
                </h3>
                <div>
                    <x-inputs.textarea 
                        label="Notes" 
                        name="notes" 
                        model="notes" 
                        icon="fas fa-sticky-note"
                        rows="4"
                        placeholder="Add any additional notes or comments about this driver..."
                    />
                    @error('notes')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex justify-end pt-4 space-x-4">
                <x-button type="button" style="clear" wire:click="cancel" icon="fas fa-times">
                    Cancel
                </x-button>

                <x-button type="submit" style="submit" icon="fas fa-save" wire:loading.attr="disabled">
                    <span wire:loading.remove wire:target="save">Create Driver</span>
                    <span wire:loading wire:target="save">
                        <i class="fas fa-spinner fa-spin mr-2"></i>Creating...
                    </span>
                </x-button>
            </div>
        </form>
    </div>
</div>