<div class="p-6 bg-white dark:bg-gray-800 rounded-lg">
    <div class="flex items-center justify-center mb-6">
        <div class="w-16 h-16 bg-red-100 dark:bg-red-900/30 rounded-full flex items-center justify-center">
            <svg class="w-8 h-8 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
            </svg>
        </div>
    </div>

    <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-3 text-center">
        Eliminar Pasta
    </h3>

    <p class="text-gray-600 dark:text-gray-400 mb-2 text-center">
        Tem a certeza que quer apagar a pasta:
    </p>

    <p class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4 text-center">
        "{{ $folderName }}"
    </p>

    <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4 mb-6">
        <div class="flex items-start">
            <svg class="w-5 h-5 text-red-600 dark:text-red-400 mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
            </svg>
            <div class="text-sm text-red-800 dark:text-red-300">
                @if($projectsCount > 0)
                    <p class="font-semibold mb-1">Atenção!</p>
                    <p>Esta pasta contém <strong>{{ $projectsCount }}</strong> {{ $projectsCount === 1 ? 'projeto' : 'projetos' }}.</p>
                @else
                    <p class="font-semibold mb-1">Atenção: Esta ação é irreversível!</p>
                    <p>Você não vai poder voltar atrás. A pasta será permanentemente eliminada.</p>
                @endif
            </div>
        </div>
    </div>

    @if($projectsCount > 0)
        <div class="mb-6 bg-gray-50 dark:bg-gray-700/50 rounded-lg p-4">
            <label class="flex items-start cursor-pointer group">
                <input 
                    type="checkbox" 
                    wire:model="deleteProjects"
                    class="w-5 h-5 text-red-600 bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-600 rounded focus:ring-red-500 dark:focus:ring-red-600 focus:ring-2 mt-0.5"
                >
                <div class="ml-3">
                    <span class="text-sm font-semibold text-gray-900 dark:text-gray-100 block mb-1">
                        Eliminar também os projetos
                    </span>
                    <span class="text-xs text-gray-600 dark:text-gray-400">
                        Se não selecionar esta opção, os projetos serão mantidos sem pasta associada.
                    </span>
                </div>
            </label>
        </div>
    @endif

    <div class="flex justify-between space-x-3">
        <button 
            type="button"
            wire:click="$dispatch('closeModal')" 
            class="px-5 py-2.5 bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 font-semibold rounded-lg transition duration-150"
        >
            Cancelar
        </button>
        <button 
            type="button"
            wire:click="confirmDelete"
            class="px-5 py-2.5 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition duration-150 flex items-center"
        >
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
            </svg>
            Eliminar Permanentemente
        </button>
    </div>
</div>