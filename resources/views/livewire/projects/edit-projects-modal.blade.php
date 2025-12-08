<div class="p-6 bg-white dark:bg-gray-800 rounded-lg">
    <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">
        Editar Projeto
    </h3>

    <form wire:submit.prevent="updateProject">
        <!-- Project Name -->
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Nome do Projeto <span class="text-red-500">*</span>
            </label>
            <input 
                type="text" 
                id="name"
                wire:model="name"
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-gray-100"
                placeholder="Nome do projeto"
            >
            @error('name') 
                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> 
            @enderror
        </div>

        <!-- Project Description -->
        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Descrição <span class="text-red-500">*</span>
            </label>
            <textarea 
                id="description"
                wire:model="description"
                rows="4"
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-gray-100 resize-none"
                placeholder="Descreve o teu projeto..."
            ></textarea>
            @error('description') 
                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> 
            @enderror
        </div>

        <!-- Current Cover Image -->
        @if($current_cover_image_path && !$cover_image)
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Imagem de Capa Atual
                </label>
                <div class="relative">
                    <img src="{{ Storage::url($current_cover_image_path) }}" 
                         class="w-full h-48 object-cover rounded-lg border border-gray-300 dark:border-gray-600">
                </div>
            </div>
        @endif

        <!-- Cover Image Upload -->
        <div class="mb-4">
            <label for="cover_image" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                {{ $current_cover_image_path ? 'Alterar Imagem de Capa' : 'Imagem de Capa' }}
            </label>
            
            <div class="flex items-center space-x-4">
                <!-- Upload Button -->
                <label class="flex items-center px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg cursor-pointer hover:bg-gray-200 dark:hover:bg-gray-600 transition">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    Escolher Nova Imagem
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
                    A carregar...
                </div>
            </div>

            @error('cover_image') 
                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> 
            @enderror

            <!-- New Image Preview -->
            @if ($cover_image)
                <div class="mt-4">
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Nova Imagem:</p>
                    <img src="{{ $cover_image->temporaryUrl() }}" class="w-full h-48 object-cover rounded-lg border border-gray-300 dark:border-gray-600">
                </div>
            @endif
        </div>

        <!-- Project Status -->
        <div class="mb-6">
            <label class="flex items-center cursor-pointer">
                <input 
                    type="checkbox" 
                    wire:model="completed"
                    class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700"
                >
                <span class="ml-3 text-sm font-medium text-gray-700 dark:text-gray-300">
                    Concluí o meu projeto.
                </span>
            </label>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-between space-x-3">
            <button 
                type="button"
                wire:click="$dispatch('closeModal')" 
                class="px-4 py-2 bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 font-semibold rounded-lg transition duration-150"
            >
                Cancelar
            </button>
            <button 
                type="submit"
                class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition duration-150 flex items-center"
                wire:loading.attr="disabled"
                wire:target="cover_image"
            >
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <span wire:loading.remove wire:target="updateProject">Guardar Alterações</span>
                <span wire:loading wire:target="updateProject">A guardar...</span>
            </button>
        </div>
    </form>
</div>