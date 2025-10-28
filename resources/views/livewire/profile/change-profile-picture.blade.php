<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Picture') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Upload a new profile picture to personalize your account.') }}
        </p>
    </header>

    <div class="mt-6 space-y-6">
        <!-- Current Profile Picture -->
        <div class="flex items-center gap-6">
            @if (auth()->user()->profile_photo)
                <div class="relative">
                    <img 
                        src="{{ Storage::url(auth()->user()->profile_photo) }}"
                        alt="{{ auth()->user()->name }}"
                        class="w-24 h-24 rounded-full object-cover ring-2 ring-gray-200 dark:ring-gray-700"
                    >
                </div>
            @else
                <div class="w-24 h-24 rounded-full bg-gradient-to-br from-indigo-400 to-indigo-600 flex items-center justify-center ring-2 ring-gray-200 dark:ring-gray-700">
                    <span class="text-2xl font-semibold text-white">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </span>
                </div>
            @endif

            <div class="flex flex-col gap-3">
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    {{ __('JPG, PNG or GIF (Max 5MB)') }}
                </p>
                <label for="photo" class="inline-block px-4 py-2 bg-indigo-600 hover:bg-indigo-700 dark:bg-indigo-500 dark:hover:bg-indigo-600 text-white text-sm font-medium rounded-lg cursor-pointer transition-colors duration-200">
                    {{ __('Choose Photo') }}
                </label>
                <input 
                    wire:model="photo" 
                    id="photo" 
                    type="file" 
                    accept="image/*" 
                    class="hidden"
                />
            </div>
        </div>

        <!-- Preview -->
        @if ($photo)
            <div class="space-y-4">
                <p class="text-sm font-medium text-gray-900 dark:text-gray-100">
                    {{ __('Preview') }}
                </p>
                <img 
                    src="{{ $photo->temporaryUrl() }}"
                    alt="Preview"
                    class="w-32 h-32 rounded-full object-cover ring-2 ring-indigo-500"
                >
            </div>
        @endif

        <!-- Actions -->
        <div class="flex items-center gap-4">
            @if ($photo)
                <x-primary-button wire:click="updateProfilePhoto">
                    {{ __('Upload') }}
                </x-primary-button>
                <button 
                    wire:click="$set('photo', null)" 
                    class="px-4 py-2 text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-lg font-medium text-sm transition-colors duration-200"
                >
                    {{ __('Cancel') }}
                </button>
            @else
                @if (auth()->user()->profile_photo)
                    <button 
                        wire:click="deleteProfilePhoto"
                        wire:confirm="{{ __('Are you sure you want to delete your profile picture?') }}"
                        class="px-4 py-2 text-red-600 dark:text-red-400 bg-red-50 dark:bg-red-900/20 hover:bg-red-100 dark:hover:bg-red-900/40 rounded-lg font-medium text-sm transition-colors duration-200"
                    >
                        {{ __('Remove') }}
                    </button>
                @endif
            @endif
        </div>

        <!-- Loading & Error States -->
        <div wire:loading.delay class="flex items-center gap-2 text-indigo-600 dark:text-indigo-400">
            <svg class="animate-spin h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <span class="text-sm">{{ __('Uploading...') }}</span>
        </div>

        <x-input-error :messages="$errors->get('photo')" />
    </div>
</section>