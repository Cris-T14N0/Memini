<div class="p-6 bg-white dark:bg-gray-800 rounded-lg">
    <div class="flex items-center mb-4">
        <div class="flex-shrink-0 w-12 h-12 rounded-full bg-red-100 dark:bg-red-900 flex items-center justify-center">
            <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
            </svg>
        </div>
        <div class="ml-4">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                Eliminar Ficheiro
            </h3>
            <p class="text-sm text-gray-600 dark:text-gray-400">
                Esta ação não pode ser revertida
            </p>
        </div>
    </div>

    <div class="mb-6 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
        <p class="text-sm text-gray-700 dark:text-gray-300 mb-2">
            <span class="font-semibold">Nome do ficheiro:</span><br>
            {{ $media->file_name }}
        </p>
        <p class="text-xs text-gray-500 dark:text-gray-400">
            Tipo: {{ ucfirst($media->file_type) }} • Tamanho: {{ number_format($media->file_size / 1024 / 1024, 2) }} MB
        </p>
    </div>

    <p class="text-gray-700 dark:text-gray-300 mb-6">
        Tens a certeza que queres eliminar este ficheiro? Esta ação é permanente e não pode ser desfeita.
    </p>

    <div class="flex justify-end space-x-3">
        <button 
            type="button"
            wire:click="$dispatch('closeModal')" 
            class="px-4 py-2 bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 font-semibold rounded-lg transition duration-150"
        >
            Cancelar
        </button>
        <button 
            wire:click="deleteMedia"
            class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition duration-150 flex items-center"
            wire:loading.attr="disabled"
        >
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
            </svg>
            <span wire:loading.remove wire:target="deleteMedia">Eliminar</span>
            <span wire:loading wire:target="deleteMedia">A eliminar...</span>
        </button>
    </div>
</div>