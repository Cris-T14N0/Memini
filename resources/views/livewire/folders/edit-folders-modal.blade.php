<div class="p-6 bg-white dark:bg-gray-800 rounded-lg">
    <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">
        Editar Pasta
    </h3>

    <form wire:submit.prevent="updateFolder">
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Nome da Pasta <span class="text-red-500">*</span>
            </label>
            <input 
                type="text" 
                id="name"
                wire:model="name"
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-gray-100"
                placeholder="Ex: Aniversários, Férias, Eventos..."
            >
            @error('name') 
                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> 
            @enderror
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Ícone (Opcional)
            </label>
            
            @if($icon)
                <div class="mb-3 p-4 bg-purple-50 dark:bg-purple-900/20 rounded-lg border border-purple-200 dark:border-purple-800 flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <span class="text-4xl">{{ $icon }}</span>
                        <span class="text-sm text-gray-600 dark:text-gray-400">Ícone selecionado</span>
                    </div>
                    <button 
                        type="button"
                        wire:click="$set('icon', '')"
                        class="text-sm text-red-600 dark:text-red-400 hover:text-red-700 dark:hover:text-red-300 font-medium"
                    >
                        Remover
                    </button>
                </div>
            @endif

            <div class="grid grid-cols-5 gap-2 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg max-h-48 overflow-y-auto border border-gray-300 dark:border-gray-600">
                @foreach($availableIcons as $availableIcon)
                    <button 
                        type="button"
                        wire:click="selectIcon('{{ $availableIcon }}')"
                        class="p-3 text-3xl rounded-lg transition duration-150
                               {{ $icon === $availableIcon 
                                   ? 'bg-purple-100 dark:bg-purple-900/50 ring-2 ring-purple-500' 
                                   : 'bg-gray-100 dark:bg-gray-800 hover:bg-white dark:hover:bg-gray-600' }}"
                    >
                        {{ $availableIcon }}
                    </button>
                @endforeach
            </div>
            <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                Escolha um ícone para identificar facilmente a sua pasta.
            </p>
        </div>

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
            >
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <span wire:loading.remove wire:target="updateFolder">Guardar Alterações</span>
                <span wire:loading wire:target="updateFolder">A guardar...</span>
            </button>
        </div>
    </form>
</div>