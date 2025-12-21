<div class="pt-3 pb-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <!-- Header Card -->
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-2xl mb-8 p-8 flex items-center justify-between">
            <div class="flex-1">
                <a href="javascript:history.back()" 
                   class="inline-flex items-center text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 mb-4 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Voltar
                </a>

                <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-2">
                    {{ $album->title }}
                </h1>
                <p class="text-gray-600 dark:text-gray-400 text-sm">
                    {{ $album->created_at->format('M d, Y') }}
                </p>
                <p class="text-gray-700 dark:text-gray-300 mb-4">
                    {{ $album->description }}
                </p>

                <div class="flex gap-3">
                    @if($canUpload)
                        <button
                            wire:click="$dispatch('openModal', { component: 'media.upload-media-modal', arguments: { albumId: {{ $album->id }} }})"
                            class="bg-green-600 text-white px-6 py-2.5 rounded-lg hover:bg-green-700 transition inline-flex items-center"
                        >
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Enviar Ficheiros
                        </button>
                    @endif

                    <button
                        wire:click="downloadAllMedia"
                        class="bg-gray-900 dark:bg-gray-700 text-white px-6 py-2.5 rounded-lg hover:bg-gray-800 dark:hover:bg-gray-600 transition inline-flex items-center"
                        wire:loading.attr="disabled"
                        wire:target="downloadAllMedia"
                    >
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" wire:loading.remove wire:target="downloadAllMedia">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                        <svg class="animate-spin h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" wire:loading wire:target="downloadAllMedia">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span wire:loading.remove wire:target="downloadAllMedia">Download</span>
                        <span wire:loading wire:target="downloadAllMedia">A preparar...</span>
                    </button>

                    <button
                        class="bg-blue-600 text-white px-6 py-2.5 rounded-lg hover:bg-blue-700 transition inline-flex items-center"
                    >
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path>
                        </svg>
                        Partilhar
                    </button>
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
            
            <!-- Header with Filters -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                    Ficheiros do Álbum ({{ $medias->count() }})
                </h2>

                <!-- Filter Buttons -->
                <div class="flex gap-2 flex-wrap">
                    <button
                        wire:click="setFilter('all')"
                        class="px-4 py-2 rounded-lg font-medium transition-all text-sm
                            {{ $filterType === 'all'
                                ? 'bg-gray-900 dark:bg-gray-700 text-white'
                                : 'bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-600' }}"
                    >
                        Todos ({{ $this->getMediaCountByType('all') }})
                    </button>

                    <button
                        wire:click="setFilter('image')"
                        class="px-4 py-2 rounded-lg font-medium transition-all text-sm inline-flex items-center gap-2
                            {{ $filterType === 'image'
                                ? 'bg-green-600 text-white'
                                : 'bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-600' }}"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Imagens ({{ $this->getMediaCountByType('image') }})
                    </button>

                    <button
                        wire:click="setFilter('video')"
                        class="px-4 py-2 rounded-lg font-medium transition-all text-sm inline-flex items-center gap-2
                            {{ $filterType === 'video'
                                ? 'bg-purple-600 text-white'
                                : 'bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-600' }}"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                        </svg>
                        Vídeos ({{ $this->getMediaCountByType('video') }})
                    </button>

                    <button
                        wire:click="setFilter('audio')"
                        class="px-4 py-2 rounded-lg font-medium transition-all text-sm inline-flex items-center gap-2
                            {{ $filterType === 'audio'
                                ? 'bg-blue-600 text-white'
                                : 'bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-600' }}"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"></path>
                        </svg>
                        Áudio ({{ $this->getMediaCountByType('audio') }})
                    </button>
                </div>
            </div>

            @if($medias->count() > 0)
                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6">
                    @foreach($medias as $media)
                        <div class="group bg-gray-100 dark:bg-gray-700 rounded-xl p-4 shadow hover:shadow-lg transition relative">
                            
                            <!-- Media Content -->
                            @if($media->file_type === 'image')
                                <img 
                                    src="{{ Storage::url($media->file_path) }}" 
                                    alt="{{ $media->file_name }}"
                                    class="rounded-lg w-full h-32 object-cover cursor-pointer"
                                    onclick="window.open('{{ Storage::url($media->file_path) }}', '_blank')"
                                />
                            @elseif($media->file_type === 'video')
                                <video 
                                    class="rounded-lg w-full h-32 object-cover cursor-pointer" 
                                    controls
                                >
                                    <source src="{{ Storage::url($media->file_path) }}" type="{{ $media->mime_type }}">
                                    O teu navegador não suporta vídeos.
                                </video>
                            @elseif($media->file_type === 'audio')
                                <div class="flex flex-col items-center justify-center h-32">
                                    <svg class="w-12 h-12 text-gray-500 dark:text-gray-300 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"></path>
                                    </svg>
                                    <audio controls class="w-full">
                                        <source src="{{ Storage::url($media->file_path) }}" type="{{ $media->mime_type }}">
                                        O teu navegador não suporta áudio.
                                    </audio>
                                </div>
                            @endif

                            <!-- File Info on Hover -->
                            <div class="mt-2 opacity-0 group-hover:opacity-100 transition">
                                <p class="text-xs text-gray-600 dark:text-gray-400 truncate" title="{{ $media->file_name }}">
                                    {{ $media->file_name }}
                                </p>
                                <p class="text-xs text-gray-500 dark:text-gray-500">
                                    {{ number_format($media->file_size / 1024 / 1024, 2) }} MB
                                </p>
                            </div>

                            <!-- Delete Button (Only for Owner/Editor) -->
                            @if($canUpload)
                                <div class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition">
                                    <button
                                        wire:click="$dispatch('openModal', { component: 'media.delete-media-modal', arguments: { mediaId: {{ $media->id }} }})"
                                        class="bg-white dark:bg-gray-900 p-2 rounded-full shadow hover:bg-red-50 dark:hover:bg-red-900 group/btn transition"
                                        title="Eliminar ficheiro"
                                    >
                                        <svg class="w-5 h-5 text-gray-700 dark:text-gray-300 group-hover/btn:text-red-600 dark:group-hover/btn:text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-12">
                    <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    
                    @if($filterType !== 'all')
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">
                            Nenhum ficheiro deste tipo
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-4">
                            Não há {{ $filterType === 'image' ? 'imagens' : ($filterType === 'video' ? 'vídeos' : 'áudio') }} neste álbum.
                        </p>
                        <button
                            wire:click="setFilter('all')"
                            class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg transition"
                        >
                            Ver Todos os Ficheiros
                        </button>
                    @else
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">
                            Nenhum ficheiro ainda
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-4">
                            Começa por enviar alguns ficheiros para este álbum.
                        </p>
                        @if($canUpload)
                            <button
                                wire:click="$dispatch('openModal', { component: 'media.upload-media-modal', arguments: { albumId: {{ $album->id }} }})"
                                class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition"
                            >
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                Enviar Primeiro Ficheiro
                            </button>
                        @endif
                    @endif
                </div>
            @endif
        </div>

    </div>
</div>