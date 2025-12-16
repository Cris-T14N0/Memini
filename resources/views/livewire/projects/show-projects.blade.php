<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pastas') }}
        </h2>
    </x-slot>

    <div class="pb-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Header Card -->
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

            <!-- Folders Section -->
            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">Pastas</h2>

            @if($folders->count())
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($folders as $folder)
                        <div 
                            class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 hover:shadow-xl transition-all duration-200 hover:scale-105 transform relative group cursor-pointer"
                            onclick="window.location='{{ route('folders.show', $folder) }}'">
                            
                            <!-- Top-right three dots -->
                            <div class="absolute top-3 right-3 text-gray-400 hover:text-gray-600 dark:hover:text-gray-200">
                                <div x-data="{ open: false }" @click.stop>
                                    <button @click="open = !open" class="text-xl font-bold">⋮</button>

                                    <div x-show="open" @click.outside="open = false"
                                         class="absolute right-0 mt-2 w-32 bg-white dark:bg-gray-700 rounded-lg shadow-lg z-50">
                                        <button wire:click.stop="manageFolder({{ $folder->id }})"
                                                class="block w-full text-left px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600">
                                            Gerir
                                        </button>
                                        <button wire:click.stop="editFolder({{ $folder->id }})"
                                                class="block w-full text-left px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600">
                                            Editar
                                        </button>
                                        <button wire:click.stop="deleteFolder({{ $folder->id }})"
                                                class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100 dark:hover:bg-gray-600">
                                            Eliminar
                                        </button>
                                    </div>
                                </div>
                            </div>

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
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-4 text-center">
                                {{ $folder->projects_count }} {{ $folder->projects_count === 1 ? 'projeto' : 'projetos' }}
                            </p>

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
