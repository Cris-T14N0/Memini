<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Convite Aceite') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Success Card -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-2xl">
                <div class="p-8 text-center">
                    
                    <!-- Success Icon -->
                    <div class="flex justify-center mb-6">
                        <div class="bg-green-100 dark:bg-green-900/30 rounded-full p-6">
                            <svg class="w-16 h-16 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>

                    <!-- Title -->
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-4">
                        Bem-vindo ao projeto!
                    </h1>

                    <!-- Description -->
                    <p class="text-lg text-gray-600 dark:text-gray-400 mb-8">
                        Juntaste-te ao projeto com sucesso. Já podes começar a colaborar com a tua equipa.
                    </p>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('dashboard') }}" 
                           class="inline-flex items-center justify-center bg-gradient-to-r from-blue-600 to-purple-600 text-white px-8 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl hover:scale-105 transform transition-all duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            Ir para o Dashboard
                        </a>

                        <a href="{{ route('projects-dashboard') }}" 
                           class="inline-flex items-center justify-center bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 px-8 py-3 rounded-xl font-semibold border-2 border-gray-200 dark:border-gray-600 hover:border-gray-300 dark:hover:border-gray-500 hover:scale-105 transform transition-all duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                            </svg>
                            Ver Projetos
                        </a>
                    </div>

                </div>
            </div>

            <!-- Additional Info Card -->
            <div class="bg-blue-50 dark:bg-blue-900/20 rounded-2xl p-6 mt-6 border border-blue-200 dark:border-blue-800">
                <div class="flex items-start">
                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-400 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div>
                        <h3 class="font-semibold text-blue-900 dark:text-blue-100 mb-1">Próximos passos</h3>
                        <p class="text-sm text-blue-800 dark:text-blue-200">
                            Explora o projeto, comunica com a tua equipa e começa a contribuir. Se tiveres dúvidas, contacta o administrador do projeto.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>