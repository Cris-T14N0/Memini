<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $folder->name }}
        </h2>
    </x-slot>

    <div class="pb-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Folder Header Card -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-2xl mb-8">
                <div class="p-8">
                    <!-- Back to Folders Link -->
                    <a href="{{ route('folders-dashboard') }}" class="inline-flex items-center text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 mb-4 transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Voltar para Pastas
                    </a>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <!-- Folder Icon -->
                            @if($folder->icon)
                                <div class="text-5xl">{{ $folder->icon }}</div>
                            @else
                                <svg class="w-12 h-12 text-gray-700 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                                </svg>
                            @endif

                            <div>
                                <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-2">
                                    {{ $folder->name }}
                                </h1>
                                <p class="text-gray-600 dark:text-gray-400">
                                    {{ $projects['progress']->count() + $projects['completed']->count() + $sharedProjects->count() }} 
                                    {{ ($projects['progress']->count() + $projects['completed']->count() + $sharedProjects->count()) === 1 ? 'projeto' : 'projetos' }}
                                </p>
                            </div>
                        </div>

                        <button
                            wire:click="$dispatch('openModal', { component: 'projects.create-projects-modal', arguments: { folderId: {{ $folder->id }} }})"
                            class="inline-block bg-gradient-to-r from-blue-600 to-purple-600 text-white px-8 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl hover:scale-105 transform transition-all duration-200"
                        >
                            Criar Projeto
                        </button>

                    </div>
                </div>
            </div>

            <!-- Search / Sort / Filters -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 mb-8">
                <div class="flex flex-col lg:flex-row gap-4">

                    <!-- SEARCH -->
                    <div class="flex-1">
                        <div class="relative">
                            <input
                                type="text"
                                wire:model.live.debounce.300ms="search"
                                placeholder="Procurar projetos..."
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

                    <!-- FILTER BUTTONS -->
                    <div class="flex gap-2">
                        <button
                            wire:click="toggleFilterProgress"
                            class="px-4 py-2.5 rounded-lg font-medium transition-all
                                {{ $showProgress
                                    ? 'bg-blue-100 dark:bg-blue-900 text-blue-700 dark:text-blue-300 border-2 border-blue-500'
                                    : 'bg-gray-100 dark:bg-gray-700 text-gray-500 dark:text-gray-400 border-2 border-gray-300 dark:border-gray-600' }}"
                        >
                            Em Progresso
                        </button>

                        <button
                            wire:click="toggleFilterCompleted"
                            class="px-4 py-2.5 rounded-lg font-medium transition-all
                                {{ $showCompleted
                                    ? 'bg-purple-100 dark:bg-purple-900 text-purple-700 dark:text-purple-300 border-2 border-purple-500'
                                    : 'bg-gray-100 dark:bg-gray-700 text-gray-500 dark:text-gray-400 border-2 border-gray-300 dark:border-gray-600' }}"
                        >
                            Concluídos
                        </button>

                        <button
                            wire:click="toggleFilterShared"
                            class="px-4 py-2.5 rounded-lg font-medium transition-all
                                {{ $showShared
                                    ? 'bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300 border-2 border-green-500'
                                    : 'bg-gray-100 dark:bg-gray-700 text-gray-500 dark:text-gray-400 border-2 border-gray-300 dark:border-gray-600' }}"
                        >
                            Partilhados
                        </button>
                    </div>
                </div>
            </div>

            <!-- MY PROJECTS IN PROGRESS -->
            @if($showProgress && $projects['progress']->count())
                <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">
                    Meus Projetos Em Progresso
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    @foreach($projects['progress'] as $project)
                        <x-project-card
                            :project="$project"
                            statusType="progress"
                            :isOwner="true"
                        />
                    @endforeach
                </div>
            @endif

            <!-- MY COMPLETED PROJECTS -->
            @if($showCompleted && $projects['completed']->count())
                <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">
                    Meus Projetos Concluídos
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    @foreach($projects['completed'] as $project)
                        <x-project-card
                            :project="$project"
                            statusType="completed"
                            :isOwner="true"
                        />
                    @endforeach
                </div>
            @endif

            <!-- SHARED PROJECTS -->
            @if($showShared && $sharedProjects->count())
                <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">
                    Projetos Partilhados Comigo
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    @foreach($sharedProjects as $project)
                        <x-project-card
                            :project="$project"
                            :statusType="$project->completed ? 'completed' : 'progress'"
                            :isOwner="false"
                        />
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</div>