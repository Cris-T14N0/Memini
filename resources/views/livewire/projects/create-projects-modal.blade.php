<div class="p-6 bg-white dark:bg-gray-800 rounded-lg">
    <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">
        Create New Project
    </h3>

    <form wire:submit.prevent="createProject">
        <!-- Project Name -->
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Project Name <span class="text-red-500">*</span>
            </label>
            <input 
                type="text" 
                id="name"
                wire:model="name"
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-gray-100"
                placeholder="Enter project name"
            >
            @error('name') 
                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> 
            @enderror
        </div>

        <!-- Project Description -->
        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Description <span class="text-red-500">*</span>
            </label>
            <textarea 
                id="description"
                wire:model="description"
                rows="4"
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-gray-100 resize-none"
                placeholder="Describe your project..."
            ></textarea>
            @error('description') 
                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> 
            @enderror
        </div>

        <!-- Cover Image Upload -->
        <div class="mb-6">
            <label for="cover_image" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Cover Image <span class="text-red-500">*</span>
            </label>
            
            <div class="flex items-center space-x-4">
                <!-- Upload Button -->
                <label class="flex items-center px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg cursor-pointer hover:bg-gray-200 dark:hover:bg-gray-600 transition">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    Choose Image
                    <input 
                        type="file" 
                        id="cover_image"
                        wire:model="cover_image"
                        accept="image/*"
                        class="hidden"
                    >
                </label>

                <!-- Loading Indicator -->
                <div wire:loading wire:target="cover_image" class="text-sm text-gray-500 dark:text-gray-400">
                    Uploading...
                </div>
            </div>

            @error('cover_image') 
                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> 
            @enderror

            <!-- Image Preview -->
            @if ($cover_image)
                <div class="mt-4">
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Preview:</p>
                    <img src="{{ $cover_image->temporaryUrl() }}" class="w-full h-48 object-cover rounded-lg border border-gray-300 dark:border-gray-600">
                </div>
            @endif
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-end space-x-3">
            <button 
                type="button"
                wire:click="$dispatch('closeModal')" 
                class="px-4 py-2 bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 font-semibold rounded-lg transition duration-150"
            >
                Cancel
            </button>
            <button 
                type="submit"
                class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition duration-150 flex items-center"
                wire:loading.attr="disabled"
                wire:target="cover_image"
            >
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                <span wire:loading.remove wire:target="createProject">Create Project</span>
                <span wire:loading wire:target="createProject">Creating...</span>
            </button>
        </div>
    </form>
</div>