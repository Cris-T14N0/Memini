<!-- Album Management Page (Blade Template) -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
            {{ __('Gerir Álbum') }}
        </h2>
    </x-slot>

    <div class="pt-3 pb-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Header Card -->
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-2xl mb-8 p-8 flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-2">
                        Crescimento da Ana
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">Nov 11, 2025</p>
                    <p class="text-gray-700 dark:text-gray-300 mb-4">Momentos especiais do crescimento da nossa pequena
                        Ana</p>

                    <div class="flex gap-3">
                        <a href="#"
                            class="bg-gray-900 dark:bg-gray-700 text-white px-6 py-2.5 rounded-lg hover:bg-gray-800 dark:hover:bg-gray-600 transition">
                            Download
                        </a>

                        <a href="#"
                            class="bg-green-600 text-white px-6 py-2.5 rounded-lg hover:bg-green-700 transition">
                            Partilhar
                        </a>
                    </div>
                </div>

                <div class="hidden md:block">
                    <svg class="w-32 h-32 text-green-600" fill="currentColor" viewBox="0 0 200 200">
                        <circle cx="100" cy="100" r="80" opacity="0.2" />
                        <path d="M100 40 L120 80 L160 90 L130 120 L140 160 L100 140 L60 160 L70 120 L40 90 L80 80 Z" />
                    </svg>
                </div>
            </div>

            <!-- Media Grid -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">Ficheiros do Álbum</h2>

                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6">

                    <!-- Image 1 -->
                    <div
                        class="group bg-gray-100 dark:bg-gray-700 rounded-xl p-4 shadow hover:shadow-lg transition relative">
                        <img src="https://images.unsplash.com/photo-1503454537195-1dcabb73ffb9?w=400"
                            class="rounded-lg w-full h-32 object-cover" />

                        <div class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition">
                            <button
                                class="bg-white dark:bg-gray-900 p-2 rounded-full shadow hover:bg-gray-100 dark:hover:bg-gray-700">
                                <svg class="w-5 h-5 text-gray-700 dark:text-gray-300" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 12h12" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Image 2 -->
                    <div
                        class="group bg-gray-100 dark:bg-gray-700 rounded-xl p-4 shadow hover:shadow-lg transition relative">
                        <img src="https://images.unsplash.com/photo-1515488764276-beab7607c1e6?w=400"
                            class="rounded-lg w-full h-32 object-cover" />

                        <div class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition">
                            <button
                                class="bg-white dark:bg-gray-900 p-2 rounded-full shadow hover:bg-gray-100 dark:hover:bg-gray-700">
                                <svg class="w-5 h-5 text-gray-700 dark:text-gray-300" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 12h12" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Image 3 -->
                    <div
                        class="group bg-gray-100 dark:bg-gray-700 rounded-xl p-4 shadow hover:shadow-lg transition relative">
                        <img src="https://images.unsplash.com/photo-1522771930-78848d9293e8?w=400"
                            class="rounded-lg w-full h-32 object-cover" />

                        <div class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition">
                            <button
                                class="bg-white dark:bg-gray-900 p-2 rounded-full shadow hover:bg-gray-100 dark:hover:bg-gray-700">
                                <svg class="w-5 h-5 text-gray-700 dark:text-gray-300" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 12h12" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Video -->
                    <div
                        class="group bg-gray-100 dark:bg-gray-700 rounded-xl p-4 shadow hover:shadow-lg transition relative">
                        <video class="rounded-lg w-full h-32 object-cover" muted>
                            <source src="https://www.w3schools.com/html/mov_bbb.mp4" type="video/mp4">
                        </video>

                        <div class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition">
                            <button
                                class="bg-white dark:bg-gray-900 p-2 rounded-full shadow hover:bg-gray-100 dark:hover:bg-gray-700">
                                <svg class="w-5 h-5 text-gray-700 dark:text-gray-300" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 12h12" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Audio -->
                    <div
                        class="group bg-gray-100 dark:bg-gray-700 rounded-xl p-4 shadow hover:shadow-lg transition relative">
                        <div class="flex flex-col items-center justify-center h-32">
                            <svg class="w-12 h-12 text-gray-500 dark:text-gray-300" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19V6l12-2v13" />
                            </svg>
                            <span class="text-sm text-gray-600 dark:text-gray-300 mt-2">Áudio</span>
                        </div>

                        <div class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition">
                            <button
                                class="bg-white dark:bg-gray-900 p-2 rounded-full shadow hover:bg-gray-100 dark:hover:bg-gray-700">
                                <svg class="w-5 h-5 text-gray-700 dark:text-gray-300" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 12h12" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Image 4 -->
                    <div
                        class="group bg-gray-100 dark:bg-gray-700 rounded-xl p-4 shadow hover:shadow-lg transition relative">
                        <img src="https://images.unsplash.com/photo-1476703993599-0035a21b17a9?w=400"
                            class="rounded-lg w-full h-32 object-cover" />

                        <div class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition">
                            <button
                                class="bg-white dark:bg-gray-900 p-2 rounded-full shadow hover:bg-gray-100 dark:hover:bg-gray-700">
                                <svg class="w-5 h-5 text-gray-700 dark:text-gray-300" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 12h12" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Image 5 -->
                    <div
                        class="group bg-gray-100 dark:bg-gray-700 rounded-xl p-4 shadow hover:shadow-lg transition relative">
                        <img src="https://images.unsplash.com/photo-1503454537195-1dcabb73ffb9?w=400"
                            class="rounded-lg w-full h-32 object-cover" />

                        <div class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition">
                            <button
                                class="bg-white dark:bg-gray-900 p-2 rounded-full shadow hover:bg-gray-100 dark:hover:bg-gray-700">
                                <svg class="w-5 h-5 text-gray-700 dark:text-gray-300" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 12h12" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Image 6 -->
                    <div
                        class="group bg-gray-100 dark:bg-gray-700 rounded-xl p-4 shadow hover:shadow-lg transition relative">
                        <img src="https://images.unsplash.com/photo-1515488764276-beab7607c1e6?w=400"
                            class="rounded-lg w-full h-32 object-cover" />

                        <div class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition">
                            <button
                                class="bg-white dark:bg-gray-900 p-2 rounded-full shadow hover:bg-gray-100 dark:hover:bg-gray-700">
                                <svg class="w-5 h-5 text-gray-700 dark:text-gray-300" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 12h12" />
                                </svg>
                            </button>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
