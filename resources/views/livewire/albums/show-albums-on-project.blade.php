<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $project->name }} - Álbuns
        </h2>
    </x-slot>

    <div class="pb-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Project Header Card -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-2xl mb-8">
                <div class="p-8">
                    <!-- Back to Projects Link -->
                    <a href="{{ route('projects-dashboard') }}" class="inline-flex items-center text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 mb-4 transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Voltar para Projetos
                    </a>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <!-- Project Cover or Icon -->
                            @if($project->cover_image_path)
                                <img src="{{ Storage::url($project->cover_image_path) }}" 
                                     class="w-16 h-16 rounded-lg object-cover ring-2 ring-gray-200 dark:ring-gray-700">
                            @else
                                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                                    <svg class="w-8 h-8 text-white/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            @endif

                            <div>
                                <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-2">
                                    {{ $project->name }}
                                </h1>
                                <p class="text-gray-600 dark:text-gray-400">
                                    {{ $albums->count() }} 
                                    {{ $albums->count() === 1 ? 'álbum' : 'álbuns' }}
                                </p>
                            </div>
                        </div>

                        @if($canEdit)
                            <button
                                wire:click="$dispatch('openModal', { component: 'albums.create-albums-modal', arguments: { projectId: {{ $project->id }} }})"
                                class="inline-block bg-gradient-to-r from-blue-600 to-purple-600 text-white px-8 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl hover:scale-105 transform transition-all duration-200"
                            >
                                Criar Álbum
                            </button>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Flash Messages -->
            @if (session()->has('message'))
                <div class="mb-6 p-4 rounded-lg bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800">
                    <p class="text-green-800 dark:text-green-200">{{ session('message') }}</p>
                </div>
            @endif

            <!-- Search / Sort -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 mb-8">
                <div class="flex flex-col lg:flex-row gap-4">

                    <!-- SEARCH -->
                    <div class="flex-1">
                        <div class="relative">
                            <input
                                type="text"
                                wire:model.live.debounce.300ms="search"
                                placeholder="Procurar álbuns..."
                                class="w-full px-4 py-2.5 pl-11 rounded-lg bg-gray-50 dark:bg-gray-700
                                       border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-gray-100
                                       focus:outline-none focus:ring-2 focus:ring-gray-500 dark:focus:ring-gray-400"
                            >

                            <svg
                                class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400"
                                fill="none"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                                />
                            </svg>
                        </div>
                    </div>

                    <!-- SORT -->
                    <div class="lg:w-64">
                        <select
                            wire:model.live="sortBy"
                            class="w-full px-4 py-2.5 rounded-lg bg-gray-50 dark:bg-gray-700
                                   border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-gray-100
                                   focus:outline-none focus:ring-2 focus:ring-gray-500 dark:focus:ring-gray-400"
                        >
                            <option value="date-desc">Data (Mais Recente)</option>
                            <option value="date-asc">Data (Mais Antigo)</option>
                            <option value="name-asc">Nome (A-Z)</option>
                            <option value="name-desc">Nome (Z-A)</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Albums Grid -->
            @if($albums->count())
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($albums as $album)
                        <x-album-card
                            :album="$album"
                            :canEdit="$canEdit"
                        />
                    @endforeach
                </div>
            @else
                <div class="text-center py-16">
                    <svg class="mx-auto h-16 w-16 text-gray-400 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-gray-100">Nenhum álbum encontrado</h3>
                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                        @if($search)
                            Não foram encontrados álbuns com "{{ $search }}"
                        @else
                            Começa por criar o teu primeiro álbum neste projeto.
                        @endif
                    </p>
                    @if($canEdit && !$search)
                        <button
                            wire:click="$dispatch('openModal', { component: 'albums.create-albums-modal', arguments: { projectId: {{ $project->id }} }})"
                            class="mt-6 inline-block bg-gradient-to-r from-blue-600 to-purple-600 text-white px-8 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl hover:scale-105 transform transition-all duration-200"
                        >
                            Criar Primeiro Álbum
                        </button>
                    @endif
                </div>
            @endif

        </div>
    </div>
</div>