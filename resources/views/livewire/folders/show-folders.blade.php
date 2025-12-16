<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pastas') }}
        </h2>
    </x-slot>

    <div class="pb-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Welcome Card -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-2xl mb-8">
                <div class="p-8 flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-2">
                            As tuas pastas
                        </h1>
                        <p class="text-gray-600 dark:text-gray-400">
                            Nesta página vais poder fazer a gestão das tuas pastas!
                        </p>

                        <button wire:click="$dispatch('openModal', { component: 'folders.create-folders-modal' })"
                        class="mt-4 inline-block bg-gradient-to-r from-blue-600 to-purple-600 text-white px-8 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl hover:scale-105 transform transition-all duration-200">
                            Criar Pasta
                        </button>
                    </div>
                </div>
            </div>

            <!-- Search / Sort -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 mb-8">
                <div class="flex flex-col lg:flex-row gap-4">

                    <!-- SEARCH -->
                    <div class="flex-1">
                        <div class="relative">
                            <input 
                                type="text" 
                                wire:model.live.debounce.300ms="search"
                                placeholder="Procurar pastas..." 
                                class="w-full px-4 py-2.5 pl-11 rounded-lg bg-gray-50 dark:bg-gray-700 
                                       border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-gray-100 
                                       focus:outline-none focus:ring-2 focus:ring-gray-500 dark:focus:ring-gray-400">

                            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" 
                                 fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>

                    <!-- SORT -->
                    <div class="lg:w-64">
                        <select 
                            wire:model.live="sortBy"
                            class="w-full px-4 py-2.5 rounded-lg bg-gray-50 dark:bg-gray-700 
                                   border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-gray-100 
                                   focus:outline-none focus:ring-2 focus:ring-gray-500 dark:focus:ring-gray-400">
                            <option value="date-desc">Data (Mais Recente)</option>
                            <option value="date-asc">Data (Mais Antigo)</option>
                            <option value="name-asc">Nome (A-Z)</option>
                            <option value="name-desc">Nome (Z-A)</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Folders Section -->
            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">Pastas</h2>

            @if($folders->count())
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($folders as $folder)
                        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-200 hover:scale-105 transform group relative">
                            
                            <!-- Three Dots Menu -->
                            <div class="absolute top-4 right-4 z-10" x-data="{ open: false }">
                                <button @click.stop="open = !open" class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                                    <svg class="w-5 h-5 text-gray-600 dark:text-gray-400" fill="currentColor" viewBox="0 0 16 16">
                                        <circle cx="8" cy="3" r="1.5"/>
                                        <circle cx="8" cy="8" r="1.5"/>
                                        <circle cx="8" cy="13" r="1.5"/>
                                    </svg>
                                </button>

                                <!-- Dropdown Menu -->
                                <div x-show="open" 
                                     @click.away="open = false"
                                     x-transition:enter="transition ease-out duration-100"
                                     x-transition:enter-start="transform opacity-0 scale-95"
                                     x-transition:enter-end="transform opacity-100 scale-100"
                                     x-transition:leave="transition ease-in duration-75"
                                     x-transition:leave-start="transform opacity-100 scale-100"
                                     x-transition:leave-end="transform opacity-0 scale-95"
                                     class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-700 rounded-lg shadow-lg border border-gray-200 dark:border-gray-600 py-1"
                                     style="display: none;">
                                    
                                    <button wire:click="manageFolder({{ $folder->id }})"
                                            class="w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors">
                                        <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                        </svg>
                                        Gerir
                                    </button>

                                    <button wire:click="editFolder({{ $folder->id }})"
                                            class="w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors">
                                        <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                        Editar
                                    </button>

                                    <button wire:click="deleteFolder({{ $folder->id }})"
                                            class="w-full text-left px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">
                                        <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                        Eliminar
                                    </button>
                                </div>
                            </div>

                            <!-- Clickable Card Content -->
                            <a href="{{ route('folders.show', $folder->id) }}" class="block p-6">
                                <!-- Icon -->
                                <div class="flex justify-center mb-4">
                                    @if($folder->icon)
                                        <div class="text-5xl">{{ $folder->icon }}</div>
                                    @else
                                        <svg class="w-12 h-12 text-gray-700 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                                        </svg>
                                    @endif
                                </div>

                                <!-- Folder Name -->
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-1 text-center">
                                    {{ $folder->name }}
                                </h3>

                                <!-- Project Count -->
                                <p class="text-sm text-gray-500 dark:text-gray-400 text-center">
                                    {{ $folder->projects_count }} {{ $folder->projects_count === 1 ? 'projeto' : 'projetos' }}
                                </p>
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-gray-100">Nenhuma pasta</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Comece criando uma nova pasta.</p>
                </div>
            @endif
        </div>
    </div>
</div>