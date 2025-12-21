@props(['album', 'canEdit' => false])

<div class="cursor-pointer bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition">

    {{-- Cover Image --}}
    @if($album->cover_image_path)
        <div class="h-48 w-full overflow-hidden bg-gray-200 dark:bg-gray-700">
            <img src="{{ Storage::url($album->cover_image_path) }}" alt="{{ $album->title }}"
                class="w-full h-full object-cover">
        </div>
    @else
        <div class="h-48 w-full bg-gradient-to-br from-purple-500 to-pink-600 flex items-center justify-center">
            <svg class="w-16 h-16 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
            </svg>
        </div>
    @endif

    <div class="p-6">

        {{-- Header --}}
        <div class="flex items-start justify-between mb-4">

            {{-- Date --}}
            <div class="flex flex-col">
                <div class="text-sm text-gray-400 dark:text-gray-500">
                    {{ $album->created_at->format('M d, Y') }}
                </div>
            </div>

            {{-- Options Menu (Only if user can edit) --}}
            @if($canEdit)
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="p-2 rounded-full text-gray-500 dark:text-gray-400
               hover:bg-gray-100 dark:hover:bg-gray-700
               focus:outline-none focus:ring-2 focus:ring-blue-500
               transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 6a2 2 0 110-4 2 2 0 010 4z
                     M10 12a2 2 0 110-4 2 2 0 010 4z
                     M10 18a2 2 0 110-4 2 2 0 010 4z" />
                        </svg>
                    </button>

                    <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-150"
                        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-100"
                        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="absolute right-0 mt-2 w-52
           bg-white dark:bg-gray-800
           rounded-xl shadow-xl
           border border-gray-100 dark:border-gray-700
           z-20 overflow-hidden">

                        {{-- Edit --}}
                        <button
                            @click="open = false; $dispatch('openModal', { component: 'albums.edit-albums-modal', arguments: { albumId: {{ $album->id }} } })"
                            class="flex items-center w-full px-4 py-3 text-sm
                                text-gray-700 dark:text-gray-200
                                hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                            ✏️ <span class="ml-3">Editar</span>
                        </button>

                        <div class="h-px bg-gray-100 dark:bg-gray-700"></div>

                        {{-- Delete --}}
                        <button
                            @click="open = false; $dispatch('openModal', { component: 'albums.delete-albums-modal', arguments: { albumId: {{ $album->id }} } })"
                            class="flex items-center w-full px-4 py-3 text-sm
               text-red-600 dark:text-red-400
               hover:bg-red-50 dark:hover:bg-red-900/20 transition">
                            🗑️ <span class="ml-3">Eliminar</span>
                        </button>
                    </div>
                </div>
            @endif

        </div>

        {{-- Title --}}
        <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2">
            {{ $album->title }}
        </h3>

        {{-- Description --}}
        <p class="text-gray-600 dark:text-gray-400 mb-6 line-clamp-2">
            {{ $album->description ?? 'Sem descrição' }}
        </p>

        {{-- Footer --}}
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                {{-- <span class="text-sm text-gray-600 dark:text-gray-400">
                    {{ $album->media()->count() }} 
                    {{ $album->media()->count() === 1 ? 'foto' : 'fotos' }}
                </span> --}}
            </div>

            <span class="bg-purple-100 dark:bg-purple-900 text-purple-700 dark:text-purple-300 px-3 py-1 rounded-full text-xs font-medium">
                Álbum
            </span>
        </div>
    </div>
</div>