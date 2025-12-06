<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Projetos') }}
        </h2>
    </x-slot>

    <div class="pt-3 pb-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Welcome Card -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-2xl mb-8">
                <div class="p-8 flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-2">
                            Olá {{ Auth::user()->name }}
                        </h1>
                        <p class="text-gray-600 dark:text-gray-400">
                            Revive momentos especiais e gera os teus álbuns familiares
                        </p>
                        <a href="{{ route('pastas-dashboard') }}" 
                           class="mt-4 inline-block bg-gray-900 dark:bg-gray-700 text-white px-6 py-2.5 rounded-lg hover:bg-gray-800 dark:hover:bg-gray-600 transition">
                            Ver Pastas
                        </a>
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

                    <!-- FILTER BUTTONS -->
                    <div class="flex gap-2">
                        <button 
                            wire:click="toggleFilterProgress"
                            class="px-4 py-2.5 rounded-lg font-medium transition-all 
                                   {{ $showProgress 
                                        ? 'bg-blue-100 dark:bg-blue-900 text-blue-700 dark:text-blue-300 border-2 border-blue-500' 
                                        : 'bg-gray-100 dark:bg-gray-700 text-gray-500 dark:text-gray-400 border-2 border-gray-300 dark:border-gray-600' }}">
                            Em Progresso
                        </button>

                        <button 
                            wire:click="toggleFilterCompleted"
                            class="px-4 py-2.5 rounded-lg font-medium transition-all 
                                   {{ $showCompleted 
                                        ? 'bg-purple-100 dark:bg-purple-900 text-purple-700 dark:text-purple-300 border-2 border-purple-500' 
                                        : 'bg-gray-100 dark:bg-gray-700 text-gray-500 dark:text-gray-400 border-2 border-gray-300 dark:border-gray-600' }}">
                            Concluídos
                        </button>
                    </div>
                </div>
            </div>

            <!-- PROGRESS PROJECTS -->
            @if($showProgress)
                <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">Projetos Em Progresso</h2>

                @if($projects['progress']->count())
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        @foreach($projects['progress'] as $project)
                            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 hover:shadow-xl transition">
                                <div class="text-sm text-gray-400 dark:text-gray-500 mb-4">
                                    {{ $project->created_at->format('M d, Y') }}
                                </div>

                                <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2">
                                    {{ $project->name }}
                                </h3>

                                <p class="text-gray-600 dark:text-gray-400 mb-6">
                                    {{ $project->description ?? 'Sem descrição' }}
                                </p>

                                <div class="flex items-center justify-between">
                                    <div class="w-8 h-8 rounded-full bg-blue-500 text-white flex items-center justify-center text-xs font-bold">
                                        {{ substr($project->name, 0, 1) }}
                                    </div>

                                    <span class="bg-blue-100 dark:bg-blue-900 text-blue-700 dark:text-blue-300 px-4 py-1 rounded-full text-sm">
                                        Em Progresso
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-8 text-center mb-8">
                        <p class="text-gray-500 dark:text-gray-400">Nenhum projeto em progresso encontrado.</p>
                    </div>
                @endif
            @endif

            <!-- COMPLETED PROJECTS -->
            @if($showCompleted)
                <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">Projetos Concluídos</h2>

                @if($projects['completed']->count())
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach($projects['completed'] as $project)
                            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 opacity-75 hover:opacity-100 transition">
                                <div class="text-sm text-gray-400 dark:text-gray-500 mb-4">
                                    {{ $project->created_at->format('M d, Y') }}
                                </div>

                                <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2">
                                    {{ $project->name }}
                                </h3>

                                <p class="text-gray-600 dark:text-gray-400 mb-6">
                                    {{ $project->description ?? 'Sem descrição' }}
                                </p>

                                <div class="flex items-center justify-between">
                                    <div class="w-8 h-8 rounded-full bg-purple-500 text-white flex items-center justify-center text-xs font-bold">
                                        {{ substr($project->name, 0, 1) }}
                                    </div>

                                    <span class="bg-purple-100 dark:bg-purple-900 text-purple-700 dark:text-purple-300 px-4 py-1 rounded-full text-sm">
                                        Concluído
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-8 text-center">
                        <p class="text-gray-500 dark:text-gray-400">Nenhum projeto concluído encontrado.</p>
                    </div>
                @endif
            @endif

            @if(!$showProgress && !$showCompleted)
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-8 text-center">
                    <p class="text-gray-500 dark:text-gray-400">Selecione pelo menos um filtro para ver os projetos.</p>
                </div>
            @endif

        </div>
    </div>
</div>