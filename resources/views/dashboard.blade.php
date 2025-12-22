<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Cartão de Boas-Vindas -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-2xl mb-8">
                <div class="p-8 flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-2">
                            Olá {{ Auth::user()->name }}!
                        </h1>
                        <p class="text-gray-600 dark:text-gray-400">
                            Revive momentos especiais e gere todas as tuas memórias.
                        </p>
                    </div>
                    <div class="hidden md:block ml-8">
                        <img src="{{ asset('assets/img/light-mode-cat.png') }}" 
                             alt="Cat" 
                             class="w-48 h-48 dark:hidden object-contain">
                        <img src="{{ asset('assets/img/dark-mode-cat.png') }}" 
                             alt="Cat" 
                             class="w-48 h-48 hidden dark:block object-contain">
                    </div>
                </div>
            </div>
            <livewire:dashboard/>
        </div>
    </div>
</x-app-layout>