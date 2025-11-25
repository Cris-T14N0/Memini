<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component {
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; 
?>

<!-- Sidebar Wrapper -->
<div x-data="{ open: false }">

    <!-- Mobile Hamburger -->
    <div
        class="sm:hidden fixed top-0 left-0 right-0 z-30 flex items-center p-4 bg-gray-50 dark:bg-gray-900 border-b border-gray-200 dark:border-gray-800">
        <button @click="open = true"
            class="p-2 rounded-md text-gray-500 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none">
            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
        <div class="flex-1 flex justify-center">
            <a href="{{ route('dashboard') }}" wire:navigate class="flex items-center">
                <!-- Light logo -->
                <img src="{{ asset('assets/img/logo-light.png') }}" alt="Logo Light" class="h-24 w-auto block dark:hidden">
                <!-- Dark logo -->
                <img src="{{ asset('assets/img/logo-dark.png') }}" alt="Logo Dark" class="h-24 w-auto hidden dark:block">
            </a>
        </div>
    </div>

    <!-- Sidebar (desktop + mobile slide-in) -->
    <nav :class="{'translate-x-0': open, '-translate-x-full': !open}"
        class="fixed inset-y-0 left-0 w-64 bg-gray-50 dark:bg-gray-900 border-r border-gray-200 dark:border-gray-800 transform sm:translate-x-0 sm:static sm:inset-auto transition-transform duration-300 ease-in-out z-50 flex flex-col h-screen">

        <!-- Close button (mobile only) -->
        <div class="sm:hidden flex items-center justify-end p-4">
            <button @click="open = false"
                class="p-2 rounded-md text-gray-500 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Logo (hidden on mobile since it's in the top bar) -->
        <div class="hidden sm:flex items-center justify-center px-6 pt-3">
            <a href="{{ route('dashboard') }}" wire:navigate
                class="flex items-center gap-2 px-4 py-2 rounded-full transition-colors">
                <!-- Light logo -->
                <img src="{{ asset('assets/img/logo-light.png') }}" alt="Logo Light" class="block dark:hidden">
                <!-- Dark logo -->
                <img src="{{ asset('assets/img/logo-dark.png') }}" alt="Logo Dark" class="hidden dark:block">
            </a>
        </div>

        <!-- Navigation Links -->
        <div class="flex-1 mt-8 space-y-2 px-4 overflow-y-auto">

            <!-- Dashboard Link -->
            <a href="{{ route('dashboard') }}" wire:navigate class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200
                @if(request()->routeIs('dashboard'))
                    bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 shadow-sm
                @else
                    text-gray-600 dark:text-gray-400 hover:bg-white/50 dark:hover:bg-gray-800/50
                @endif">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <span class="font-medium">Dashboard</span>
            </a>

            <!-- Pastas Link -->
            <a href="{{ route('pastas-dashboard') }}" wire:navigate class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200
                @if(request()->routeIs('pastas-dashboard'))
                    bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 shadow-sm
                @else
                    text-gray-600 dark:text-gray-400 hover:bg-white/50 dark:hover:bg-gray-800/50
                @endif">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                </svg>
                <span class="font-medium">Pastas</span>
            </a>

            <!-- Projetos Link -->
            <a href="{{ route('projetos-dashboard') }}" wire:navigate class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200
                @if(request()->routeIs('projetos-dashboard'))
                    bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 shadow-sm
                @else
                    text-gray-600 dark:text-gray-400 hover:bg-white/50 dark:hover:bg-gray-800/50
                @endif">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
                <span class="font-medium">Projetos</span>
            </a>

            <!-- Álbum Link -->
            <a href="{{ route('albuns-dashboard') }}" wire:navigate
                class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 text-gray-600 dark:text-gray-400 hover:bg-white/50 dark:hover:bg-gray-800/50">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4h7.5a1.5 1.5 0 0 1 1.5 1.5v13a1.5 1.5 0 0 1-1.5 1.5H12m0-16v16m0-16H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h6m0-16v16" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 8h3m-3 3h3m-3 3h3" />
                </svg>
                <span class="font-medium">Álbuns</span>
            </a>
        </div>

        <!-- User Dropdown -->
        <div class="border-t border-gray-200 dark:border-gray-800 p-4 mt-auto relative"
            x-data="{ dropdownOpen: false }">
            <button @click="dropdownOpen = !dropdownOpen" class="flex items-center justify-between w-full px-3 py-2 text-sm font-medium 
                text-gray-700 dark:text-gray-300 hover:bg-white/50 dark:hover:bg-gray-800/50 
                focus:outline-none transition ease-in-out duration-150 rounded-lg">

                <div class="flex items-center gap-2">
                    <!-- User avatar -->
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}"
                        alt="{{ Auth::user()->name }}" class="w-8 h-8 rounded-full object-cover">

                    <!-- Username -->
                    <div>{{ Auth::user()->name }}</div>
                </div>

                <!-- Dropdown arrow -->
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-4 w-4 fill-current transform transition-transform duration-200"
                    :class="{ 'rotate-180': dropdownOpen }" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                        clip-rule="evenodd" />
                </svg>
            </button>

            <!-- Dropdown menu -->
            <div x-show="dropdownOpen" @click.away="dropdownOpen = false" x-transition
                class="absolute bottom-full mb-2 w-full bg-white dark:bg-gray-800 rounded-lg shadow-lg py-1 z-[60] border border-gray-200 dark:border-gray-700">

                <a href="{{ route('profile') }}" wire:navigate
                    class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                    Profile
                </a>

                <button wire:click="logout"
                    class="w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                    Log Out
                </button>
            </div>
        </div>
    </nav>

</div>
