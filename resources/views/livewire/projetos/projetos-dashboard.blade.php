<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Projetos') }}
        </h2>
    </x-slot>

    <div class="pt-3 pb-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Cartão de Boas-Vindas -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-2xl mb-8">
                <div class="p-8 flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-2">
                            Olá {{ Auth::user()->name }}
                        </h1>
                        <p class="text-gray-600 dark:text-gray-400">
                            Revive momentos especiais e gere os teus álbuns familiares
                        </p>
                        <a href="{{ route('pastas-dashboard') }}" class="mt-4 inline-block bg-gray-900 dark:bg-gray-700 text-white px-6 py-2.5 rounded-lg hover:bg-gray-800 dark:hover:bg-gray-600 transition">
                            Ver Pastas
                        </a>
                    </div>
                    <div class="hidden md:block">
                        <svg class="w-32 h-32 text-green-600" fill="currentColor" viewBox="0 0 200 200">
                            <circle cx="100" cy="100" r="80" opacity="0.2"/>
                            <path d="M100 40 L120 80 L160 90 L130 120 L140 160 L100 140 L60 160 L70 120 L40 90 L80 80 Z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Search, Filter and Sort Bar -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 mb-8">
                <div class="flex flex-col lg:flex-row gap-4">
                    <!-- Search Bar -->
                    <div class="flex-1">
                        <div class="relative">
                            <input 
                                type="text" 
                                id="searchInput"
                                placeholder="Procurar projetos..." 
                                class="w-full px-4 py-2.5 pl-11 rounded-lg bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-500 dark:focus:ring-gray-400">
                            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>

                    <!-- Sort Dropdown -->
                    <div class="lg:w-64">
                        <select 
                            id="sortSelect"
                            class="w-full px-4 py-2.5 rounded-lg bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-500 dark:focus:ring-gray-400">
                            <option value="date-desc">Data (Mais Recente)</option>
                            <option value="date-asc">Data (Mais Antigo)</option>
                            <option value="name-asc">Nome (A-Z)</option>
                            <option value="name-desc">Nome (Z-A)</option>
                        </select>
                    </div>

                    <!-- Status Filter Buttons -->
                    <div class="flex gap-2">
                        <button 
                            id="filterProgress"
                            class="px-4 py-2.5 rounded-lg font-medium transition-all bg-blue-100 dark:bg-blue-900 text-blue-700 dark:text-blue-300 border-2 border-blue-500">
                            Em Progresso
                        </button>
                        <button 
                            id="filterCompleted"
                            class="px-4 py-2.5 rounded-lg font-medium transition-all bg-purple-100 dark:bg-purple-900 text-purple-700 dark:text-purple-300 border-2 border-purple-500">
                            Concluídos
                        </button>
                    </div>
                </div>
            </div>

            <!-- Projetos Em Progresso -->
            <div id="progressSection" class="mb-8">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">Projetos Em Progresso</h2>
                <div id="progressProjects" class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Projeto 1 -->
                    <div class="project-card progress-project bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 hover:shadow-xl transition" data-name="Crescimento da Ana" data-date="2025-11-11" data-status="progress">
                        <div class="text-sm text-gray-400 dark:text-gray-500 mb-4">Nov 11, 2025</div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2">Crescimento da Ana</h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-6">Filho</p>
                        <div class="flex items-center justify-between">
                            <div class="flex -space-x-2">
                                <div class="w-8 h-8 rounded-full bg-purple-500 border-2 border-white dark:border-gray-800 flex items-center justify-center text-white text-xs font-bold">C</div>
                            </div>
                            <span class="bg-purple-100 dark:bg-purple-900 text-purple-700 dark:text-purple-300 px-4 py-1 rounded-full text-sm">5 anos</span>
                        </div>
                    </div>

                    <!-- Projeto 2 -->
                    <div class="project-card progress-project bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 hover:shadow-xl transition" data-name="Aniversário do João" data-date="2025-06-05" data-status="progress">
                        <div class="text-sm text-gray-400 dark:text-gray-500 mb-4">Jun 05, 2025</div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2">Aniversário do João</h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-6">Evento Familiar</p>
                        <div class="flex items-center justify-between">
                            <div class="flex -space-x-2">
                                <div class="w-8 h-8 rounded-full bg-blue-500 border-2 border-white dark:border-gray-800 flex items-center justify-center text-white text-xs font-bold">J</div>
                                <div class="w-8 h-8 rounded-full bg-green-500 border-2 border-white dark:border-gray-800 flex items-center justify-center text-white text-xs font-bold">M</div>
                            </div>
                            <span class="bg-blue-100 dark:bg-blue-900 text-blue-700 dark:text-blue-300 px-4 py-1 rounded-full text-sm">Em 1 dias</span>
                        </div>
                    </div>

                    <!-- Projeto 3 -->
                    <div class="project-card progress-project bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 hover:shadow-xl transition" data-name="Natal 2025" data-date="2025-11-01" data-status="progress">
                        <div class="text-sm text-gray-400 dark:text-gray-500 mb-4">Nov 01, 2025</div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2">Natal 2025</h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-6">Evento Familiar</p>
                        <div class="flex items-center justify-between">
                            <div class="flex -space-x-2">
                                <div class="w-8 h-8 rounded-full bg-red-500 border-2 border-white dark:border-gray-800 flex items-center justify-center text-white text-xs font-bold">N</div>
                            </div>
                            <span class="bg-orange-100 dark:bg-orange-900 text-orange-700 dark:text-orange-300 px-4 py-1 rounded-full text-sm">Em 66 dias</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Projetos Concluídos -->
            <div id="completedSection">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">Projetos Concluídos</h2>
                <div id="completedProjects" class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Projeto Concluído 1 -->
                    <div class="project-card completed-project bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 hover:shadow-xl transition opacity-75" data-name="Natal 2024" data-date="2024-11-11" data-status="completed">
                        <div class="text-sm text-gray-400 dark:text-gray-500 mb-4">Nov 11, 2024</div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2">Natal 2024</h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-6">Evento Familiar</p>
                        <div class="flex items-center justify-between">
                            <div class="flex -space-x-2">
                                <div class="w-8 h-8 rounded-full bg-purple-500 border-2 border-white dark:border-gray-800 flex items-center justify-center text-white text-xs font-bold">A</div>
                                <div class="w-8 h-8 rounded-full bg-pink-500 border-2 border-white dark:border-gray-800 flex items-center justify-center text-white text-xs font-bold">B</div>
                            </div>
                            <span class="bg-purple-100 dark:bg-purple-900 text-purple-700 dark:text-purple-300 px-4 py-1 rounded-full text-sm">Concluído</span>
                        </div>
                    </div>

                    <!-- Projeto Concluído 2 -->
                    <div class="project-card completed-project bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 hover:shadow-xl transition opacity-75" data-name="Ginásio 2023" data-date="2023-11-05" data-status="completed">
                        <div class="text-sm text-gray-400 dark:text-gray-500 mb-4">Nov 05, 2023</div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2">Ginásio 2023</h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-6">Evento Pessoal</p>
                        <div class="flex items-center justify-between">
                            <div class="flex -space-x-2">
                                <div class="w-8 h-8 rounded-full bg-yellow-500 border-2 border-white dark:border-gray-800 flex items-center justify-center text-white text-xs font-bold">G</div>
                            </div>
                            <span class="bg-blue-100 dark:bg-blue-900 text-blue-700 dark:text-blue-300 px-4 py-1 rounded-full text-sm">Concluído</span>
                        </div>
                    </div>

                    <!-- Projeto Concluído 3 -->
                    <div class="project-card completed-project bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 hover:shadow-xl transition opacity-75" data-name="Aniversário da Júlia" data-date="2023-08-25" data-status="completed">
                        <div class="text-sm text-gray-400 dark:text-gray-500 mb-4">Aug 25, 2023</div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2">Aniversário da Júlia</h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-6">Evento Familiar</p>
                        <div class="flex items-center justify-between">
                            <div class="flex -space-x-2">
                                <div class="w-8 h-8 rounded-full bg-pink-500 border-2 border-white dark:border-gray-800 flex items-center justify-center text-white text-xs font-bold">J</div>
                                <div class="w-8 h-8 rounded-full bg-indigo-500 border-2 border-white dark:border-gray-800 flex items-center justify-center text-white text-xs font-bold">P</div>
                            </div>
                            <span class="bg-pink-100 dark:bg-pink-900 text-pink-700 dark:text-pink-300 px-4 py-1 rounded-full text-sm">Concluído</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const sortSelect = document.getElementById('sortSelect');
            const filterProgress = document.getElementById('filterProgress');
            const filterCompleted = document.getElementById('filterCompleted');
            const progressSection = document.getElementById('progressSection');
            const completedSection = document.getElementById('completedSection');

            let activeFilters = {
                progress: true,
                completed: true
            };

            // Search functionality
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                const allProjects = document.querySelectorAll('.project-card');

                allProjects.forEach(project => {
                    const name = project.dataset.name.toLowerCase();
                    const matchesSearch = name.includes(searchTerm);
                    const matchesFilter = activeFilters[project.dataset.status];

                    if (matchesSearch && matchesFilter) {
                        project.style.display = 'block';
                    } else {
                        project.style.display = 'none';
                    }
                });
            });

            // Sort functionality
            sortSelect.addEventListener('change', function() {
                sortProjects(this.value);
            });

            // Filter toggle functionality
            filterProgress.addEventListener('click', function() {
                activeFilters.progress = !activeFilters.progress;
                updateFilterButton(this, activeFilters.progress, 'blue');
                applyFilters();
            });

            filterCompleted.addEventListener('click', function() {
                activeFilters.completed = !activeFilters.completed;
                updateFilterButton(this, activeFilters.completed, 'purple');
                applyFilters();
            });

            function updateFilterButton(button, isActive, color) {
                if (isActive) {
                    button.classList.remove('bg-gray-100', 'dark:bg-gray-700', 'text-gray-600', 'dark:text-gray-400', 'border-gray-300', 'dark:border-gray-600');
                    button.classList.add(`bg-${color}-100`, `dark:bg-${color}-900`, `text-${color}-700`, `dark:text-${color}-300`, `border-${color}-500`);
                } else {
                    button.classList.add('bg-gray-100', 'dark:bg-gray-700', 'text-gray-600', 'dark:text-gray-400', 'border-gray-300', 'dark:border-gray-600');
                    button.classList.remove(`bg-${color}-100`, `dark:bg-${color}-900`, `text-${color}-700`, `dark:text-${color}-300`, `border-${color}-500`);
                }
            }

            function applyFilters() {
                const searchTerm = searchInput.value.toLowerCase();
                
                // Show/hide sections
                progressSection.style.display = activeFilters.progress ? 'block' : 'none';
                completedSection.style.display = activeFilters.completed ? 'block' : 'none';

                // Filter individual cards
                const allProjects = document.querySelectorAll('.project-card');
                allProjects.forEach(project => {
                    const name = project.dataset.name.toLowerCase();
                    const matchesSearch = name.includes(searchTerm);
                    const matchesFilter = activeFilters[project.dataset.status];

                    if (matchesSearch && matchesFilter) {
                        project.style.display = 'block';
                    } else {
                        project.style.display = 'none';
                    }
                });
            }

            function sortProjects(sortType) {
                const containers = [
                    document.getElementById('progressProjects'),
                    document.getElementById('completedProjects')
                ];

                containers.forEach(container => {
                    const projects = Array.from(container.children);

                    projects.sort((a, b) => {
                        switch(sortType) {
                            case 'date-desc':
                                return new Date(b.dataset.date) - new Date(a.dataset.date);
                            case 'date-asc':
                                return new Date(a.dataset.date) - new Date(b.dataset.date);
                            case 'name-asc':
                                return a.dataset.name.localeCompare(b.dataset.name);
                            case 'name-desc':
                                return b.dataset.name.localeCompare(a.dataset.name);
                        }
                    });

                    // Clear and re-append sorted projects
                    container.innerHTML = '';
                    projects.forEach(project => container.appendChild(project));
                });
            }
        });
    </script>
</x-app-layout>