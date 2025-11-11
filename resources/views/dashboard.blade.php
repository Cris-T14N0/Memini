<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
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
                        <button class="mt-4 bg-gray-900 dark:bg-gray-700 text-white px-6 py-2.5 rounded-lg hover:bg-gray-800 dark:hover:bg-gray-600 transition">
                            Ver Pastas
                        </button>
                    </div>
                    <div class="hidden md:block">
                        <svg class="w-32 h-32 text-green-600" fill="currentColor" viewBox="0 0 200 200">
                            <circle cx="100" cy="100" r="80" opacity="0.2"/>
                            <path d="M100 40 L120 80 L160 90 L130 120 L140 160 L100 140 L60 160 L70 120 L40 90 L80 80 Z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Projetos Próximos -->
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">Projetos Próximos</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Projeto 1 -->
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 hover:shadow-xl transition">
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
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 hover:shadow-xl transition">
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
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 hover:shadow-xl transition">
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
            <div>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">Projetos Concluídos</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Projeto Concluído 1 -->
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 hover:shadow-xl transition opacity-75">
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
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 hover:shadow-xl transition opacity-75">
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
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 hover:shadow-xl transition opacity-75">
                        <div class="text-sm text-gray-400 dark:text-gray-500 mb-4">Aug 25, 2023</div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2">Aniversário da Júlia</h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-6">Evento Familiar</p>
                        <div class="flex items-center justify-between">
                            <div class="flex -space-x-2">
                                <div class="w-8 h-8 rounded-full bg-pink-500 border-2 border-white dark:border-gray-800 flex items-center justify-center text-white text-xs font-bold">J</div>
                                <div class="w-8 h-8 rounded-full bg-indigo-500 border-2 border-white dark:border-gray-800 flex items-center justify-center text-white text-xs font-bold">P</div>
                            </div>
                            <span class="bg-pink-100 dark:bg-pink-900 text-pink-700 dark:text-pink-300 px-4 py-1 rounded-full text-sm">Em 66 dias</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>