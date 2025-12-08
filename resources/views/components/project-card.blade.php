@props(['project', 'statusType'])

<div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition">
    
    {{-- Cover Image --}}
    @if($project->cover_image_path)
        <div class="h-48 w-full overflow-hidden bg-gray-200 dark:bg-gray-700">
            <img src="{{ Storage::url($project->cover_image_path) }}" 
                 alt="{{ $project->name }}" 
                 class="w-full h-full object-cover">
        </div>
    @else
        <div class="h-48 w-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
            <svg class="w-16 h-16 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
        </div>
    @endif

    <div class="p-6">
        {{-- Header with Date and Options --}}
        <div class="flex items-center justify-between mb-4">
            <div class="text-sm text-gray-400 dark:text-gray-500">
                {{ $project->created_at->format('M d, Y') }}
            </div>

            {{-- Three Dots Menu --}}
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" 
                        class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                    <svg class="w-5 h-5 text-gray-600 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"></path>
                    </svg>
                </button>

                {{-- Dropdown Menu --}}
                <div x-show="open" 
                     @click.away="open = false"
                     x-transition:enter="transition ease-out duration-100"
                     x-transition:enter-start="transform opacity-0 scale-95"
                     x-transition:enter-end="transform opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-75"
                     x-transition:leave-start="transform opacity-100 scale-100"
                     x-transition:leave-end="transform opacity-0 scale-95"
                     class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-700 rounded-lg shadow-lg border border-gray-200 dark:border-gray-600 z-10">
                    
                    {{-- Edit Option --}}
                    <button wire:click="editProject({{ $project->id }})"
                            class="w-full flex items-center px-4 py-3 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600 transition">
                        <svg class="w-5 h-5 mr-3 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Editar
                    </button>

                    {{-- Share Option --}}
                    <button wire:click="shareProject({{ $project->id }})"
                            class="w-full flex items-center px-4 py-3 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600 transition">
                        <svg class="w-5 h-5 mr-3 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path>
                        </svg>
                        Partilhar
                    </button>

                    {{-- Divider --}}
                    <div class="border-t border-gray-200 dark:border-gray-600"></div>

                    {{-- Delete Option --}}
                    <button wire:click="$dispatch('openModal', { component: 'projects.delete-projects-modal', arguments: { projectId: {{ $project->id }} } })"
                            class="w-full flex items-center px-4 py-3 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 transition rounded-b-lg">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Eliminar
                    </button>
                </div>
            </div>
        </div>

        {{-- Project Title --}}
        <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2">
            {{ $project->name }}
        </h3>

        {{-- Project Description --}}
        <p class="text-gray-600 dark:text-gray-400 mb-6 line-clamp-2">
            {{ $project->description ?? 'Sem descrição' }}
        </p>

        {{-- Footer with Owner and Status --}}
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-2">
                @if($project->owner->profile_photo)
                    <img src="{{ Storage::url($project->owner->profile_photo) }}" 
                         alt="{{ $project->owner->name }}" 
                         class="w-8 h-8 rounded-full object-cover ring-2 ring-gray-200 dark:ring-gray-700">
                @else
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($project->owner->name) }}&background=random" 
                         alt="{{ $project->owner->name }}" 
                         class="w-8 h-8 rounded-full object-cover ring-2 ring-gray-200 dark:ring-gray-700">
                @endif
                <span class="text-sm text-gray-600 dark:text-gray-400">{{ $project->owner->name }}</span>
            </div>

            @if($statusType === 'progress')
                <span class="bg-blue-100 dark:bg-blue-900 text-blue-700 dark:text-blue-300 px-3 py-1 rounded-full text-xs font-medium">
                    Em Progresso
                </span>
            @elseif($statusType === 'completed')
                <span class="bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300 px-3 py-1 rounded-full text-xs font-medium">
                    Concluído
                </span>
            @endif
        </div>
    </div>
</div>