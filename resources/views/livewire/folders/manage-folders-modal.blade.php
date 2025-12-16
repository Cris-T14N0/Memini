<div class="p-6 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 rounded-xl">
    <!-- Header -->
    <div class="mb-6">
        <div class="flex items-center gap-3 mb-2">
            @if($folder->icon)
                <div class="text-3xl">{{ $folder->icon }}</div>
            @else
                <svg class="w-8 h-8 text-gray-700 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
                </svg>
            @endif

            <h2 class="text-2xl font-bold">
                Gerir Pasta: {{ $folder->name }}
            </h2>
        </div>

        <p class="text-gray-600 dark:text-gray-400">
            Adicione ou remova projetos desta pasta
        </p>
    </div>

    <!-- Flash Message -->
    @if (session()->has('message'))
        <div class="mb-4 p-4 rounded-lg bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800">
            <p class="text-green-800 dark:text-green-200">{{ session('message') }}</p>
        </div>
    @endif

    <!-- Search -->
    <div class="mb-6">
        <div class="relative">
            <input
                type="text"
                wire:model.live.debounce.300ms="search"
                placeholder="Procurar projetos..."
                class="w-full rounded-lg pl-11 pr-4 py-2.5
                       bg-gray-50 dark:bg-gray-800
                       border border-gray-200 dark:border-gray-700
                       text-gray-900 dark:text-gray-100
                       placeholder-gray-400 dark:placeholder-gray-500
                       focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400"
            >

            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400 dark:text-gray-500"
                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Projects in Folder -->
        <div class="rounded-xl p-4 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800">
            <h3 class="text-lg font-semibold mb-4 flex items-center gap-2 text-blue-900 dark:text-blue-100">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M5 13l4 4L19 7"/>
                </svg>
                Na Pasta ({{ $this->projectsInFolder->count() }})
            </h3>

            <div class="space-y-2 max-h-96 overflow-y-auto">
                @forelse($this->projectsInFolder as $project)
                    <div class="flex items-center justify-between rounded-lg p-3
                                bg-white dark:bg-gray-800
                                border border-gray-100 dark:border-gray-700
                                shadow-sm hover:shadow-md transition">
                        <div class="min-w-0 flex-1">
                            <h4 class="font-medium truncate">
                                {{ $project->name }}
                            </h4>

                            @if($project->description)
                                <p class="text-sm text-gray-500 dark:text-gray-400 truncate">
                                    {{ Str::limit($project->description, 50) }}
                                </p>
                            @endif
                        </div>

                        <button
                            type="button"
                            wire:click="removeProjectFromFolder({{ $project->id }})"
                            wire:loading.attr="disabled"
                            wire:loading.class="opacity-50 cursor-not-allowed"
                            class="ml-3 p-2 rounded-lg flex-shrink-0
                                   text-red-600 dark:text-red-400
                                   hover:bg-red-50 dark:hover:bg-red-900/30 transition
                                   disabled:opacity-50 disabled:cursor-not-allowed"
                            title="Remover da pasta">
                            <svg wire:loading.remove wire:target="removeProjectFromFolder({{ $project->id }})" 
                                 class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            <svg wire:loading wire:target="removeProjectFromFolder({{ $project->id }})" 
                                 class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </button>
                    </div>
                @empty
                    <div class="text-center py-12">
                        <svg class="w-16 h-16 mx-auto text-gray-300 dark:text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
                        </svg>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Nenhum projeto nesta pasta
                        </p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Available Projects -->
        <div class="rounded-xl p-4 bg-gray-50 dark:bg-gray-800/40 border border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-semibold mb-4 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 4v16m8-8H4"/>
                </svg>
                Projetos Disponíveis ({{ $this->availableProjects->count() }})
            </h3>

            <div class="space-y-2 max-h-96 overflow-y-auto">
                @forelse($this->availableProjects as $project)
                    <div class="flex items-center justify-between rounded-lg p-3
                                bg-white dark:bg-gray-800
                                border border-gray-100 dark:border-gray-700
                                shadow-sm hover:shadow-md transition">
                        <div class="min-w-0 flex-1">
                            <h4 class="font-medium truncate">
                                {{ $project->name }}
                            </h4>

                            @if($project->description)
                                <p class="text-sm text-gray-500 dark:text-gray-400 truncate">
                                    {{ Str::limit($project->description, 50) }}
                                </p>
                            @endif

                            @if($project->folder_id && $project->folder)
                                <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">
                                    📁 {{ $project->folder->name }}
                                </p>
                            @endif
                        </div>

                        <button
                            type="button"
                            wire:click="addProjectToFolder({{ $project->id }})"
                            wire:loading.attr="disabled"
                            wire:loading.class="opacity-50 cursor-not-allowed"
                            class="ml-3 p-2 rounded-lg flex-shrink-0
                                   text-green-600 dark:text-green-400
                                   hover:bg-green-50 dark:hover:bg-green-900/30 transition
                                   disabled:opacity-50 disabled:cursor-not-allowed"
                            title="Adicionar à pasta">
                            <svg wire:loading.remove wire:target="addProjectToFolder({{ $project->id }})" 
                                 class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            <svg wire:loading wire:target="addProjectToFolder({{ $project->id }})" 
                                 class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </button>
                    </div>
                @empty
                    <div class="text-center py-12">
                        <svg class="w-16 h-16 mx-auto text-gray-300 dark:text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                        </svg>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Nenhum projeto disponível
                        </p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="mt-6 flex justify-end gap-3">
        <button
            type="button"
            wire:click="$dispatch('closeModal')"
            class="px-6 py-2.5 rounded-lg font-medium
                   bg-gray-200 dark:bg-gray-700
                   text-gray-700 dark:text-gray-300
                   hover:bg-gray-300 dark:hover:bg-gray-600 transition">
            Fechar
        </button>
    </div>
</div>