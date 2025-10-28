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
        class="sm:hidden flex items-center p-4 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
        <button @click="open = true"
            class="p-2 rounded-md text-gray-500 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none">
            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
        <div class="flex-1 flex justify-center">
            <a href="{{ route('dashboard') }}" wire:navigate>
                <x-application-logo class="h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
            </a>
        </div>
    </div>

    <!-- Sidebar (desktop + mobile slide-in) -->
    <nav :class="{'translate-x-0': open, '-translate-x-full': !open}"
        class="fixed inset-y-0 left-0 w-64 bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 transform sm:translate-x-0 sm:static sm:inset-auto transition-transform duration-300 ease-in-out z-50 flex flex-col min-h-screen">

        <!-- Close button (mobile only) -->
        <div class="sm:hidden flex items-center justify-end p-4">
            <button @click="open = false"
                class="p-2 rounded-md text-gray-500 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Logo -->
        <div class="flex items-center justify-center h-16 border-b border-gray-100 dark:border-gray-700">
            <a href="{{ route('dashboard') }}" wire:navigate>
                <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
            </a>
        </div>

        <!-- Navigation Links -->
        <div class="flex-1 mt-4 space-y-2 px-2">
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate class="w-full text-center px-4 py-3 rounded-lg transition-colors duration-200
               bg-white dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700
               text-gray-800 dark:text-gray-200 font-medium
               focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-1
               flex items-center justify-center space-x-2">
                {{ __('Dashboard') }}
            </x-nav-link>

            {{-- Example additional button-style link --}}
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('projects')" wire:navigate class="w-full text-center px-4 py-3 rounded-lg transition-colors duration-200
               bg-white dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700
               text-gray-800 dark:text-gray-200 font-medium
               focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-1
               flex items-center justify-center space-x-2">
                {{ __('Projects') }}
            </x-nav-link>
        </div>


        <!-- User Dropdown -->
        <div class="border-t border-gray-100 dark:border-gray-700 p-4 mt-auto relative"
            x-data="{ dropdownOpen: false }">

            <button @click="dropdownOpen = !dropdownOpen" class="flex items-center justify-center w-full px-3 py-2 text-sm font-medium text-gray-500 dark:text-gray-400 
               bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none 
               transition ease-in-out duration-150 rounded-md">

                <!-- User avatar -->
                <img src="{{ auth()->user()->profile_photo ? Storage::url(auth()->user()->profile_photo) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) }}"
                    alt="{{ auth()->user()->name }}" class="w-6 h-6 rounded-full object-cover mr-2">

                <!-- Username -->
                <div x-data="{ name: '{{ auth()->user()->name }}' }" x-text="name"></div>

                <!-- Dropdown arrow -->
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="ml-2 h-4 w-4 fill-current transform transition-transform duration-200"
                    :class="{ 'rotate-180': dropdownOpen }" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 
                   10.586l3.293-3.293a1 1 0 
                   111.414 1.414l-4 4a1 1 0 
                   01-1.414 0l-4-4a1 1 0 
                   010-1.414z" clip-rule="evenodd" />
                </svg>

            </button>

            <!-- Dropdown menu -->
            <div x-show="dropdownOpen" @click.away="dropdownOpen = false" x-transition
                class="absolute bottom-full mb-2 w-full bg-white dark:bg-gray-800 rounded-md shadow-lg py-1 z-50">

                <x-dropdown-link :href="route('profile')" wire:navigate class="block text-center">
                    {{ __('Profile') }}
                </x-dropdown-link>

                <button wire:click="logout" class="w-full text-center">
                    <x-dropdown-link>
                        {{ __('Log Out') }}
                    </x-dropdown-link>
                </button>
            </div>
        </div>

    </nav>

    <!-- Overlay for mobile -->
    <div x-show="open" @click="open = false" class="fixed inset-0 bg-black bg-opacity-25 sm:hidden z-40"></div>

</div>