<div class="p-6 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 rounded-xl">
    <!-- Header -->
    <div class="mb-6">
        <div class="flex items-center gap-3 mb-4">
            <div class="p-3 rounded-full bg-red-100 dark:bg-red-900/30">
                <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
            </div>
            <h2 class="text-2xl font-bold">
                Sair do Projeto
            </h2>
        </div>

        <p class="text-gray-600 dark:text-gray-400">
            Tens a certeza que queres sair do projeto <strong class="text-gray-900 dark:text-gray-100">"{{ $project->name }}"</strong>?
        </p>

        <div class="mt-4 p-4 rounded-lg bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800">
            <div class="flex gap-3">
                <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
                <div>
                    <p class="text-sm font-medium text-yellow-800 dark:text-yellow-200">
                        Atenção
                    </p>
                    <p class="text-sm text-yellow-700 dark:text-yellow-300 mt-1">
                        Ao sair do projeto, vais perder acesso a todos os álbuns e conteúdos. Para voltar, precisarás de um novo convite.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Actions -->
    <div class="flex justify-end gap-3">
        <button
            type="button"
            wire:click="$dispatch('closeModal')"
            class="px-6 py-2.5 rounded-lg font-medium
                   bg-gray-200 dark:bg-gray-700
                   text-gray-700 dark:text-gray-300
                   hover:bg-gray-300 dark:hover:bg-gray-600 transition">
            Cancelar
        </button>

        <button
            type="button"
            wire:click="leaveProject"
            wire:loading.attr="disabled"
            wire:loading.class="opacity-50 cursor-not-allowed"
            class="px-6 py-2.5 rounded-lg font-medium
                   bg-red-600 hover:bg-red-700
                   text-white
                   transition
                   disabled:opacity-50 disabled:cursor-not-allowed">
            <span wire:loading.remove wire:target="leaveProject">
                Sair do Projeto
            </span>
            <span wire:loading wire:target="leaveProject" class="flex items-center gap-2">
                <svg class="animate-spin h-4 w-4" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                A sair...
            </span>
        </button>
    </div>
</div>