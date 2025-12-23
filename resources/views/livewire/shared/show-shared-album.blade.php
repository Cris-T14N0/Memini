<div class="min-h-screen bg-gradient-to-br from-green-50/30 via-white to-green-50/20 dark:from-gray-900 dark:to-gray-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Header Section -->
        <div class="bg-white/90 dark:bg-gray-800/80 backdrop-blur-sm rounded-2xl shadow-xl p-8 mb-8 border border-green-100/50 dark:border-gray-700">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-3">
                        {{ $album->title }}
                    </h1>
                    
                    @if($sharedLink->message)
                        <div class="mt-4 p-4 bg-green-50/50 dark:bg-gray-700/50 rounded-lg border-l-4 border-green-400/50 dark:border-green-400">
                            <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                                {{ $sharedLink->message }}
                            </p>
                        </div>
                    @endif
                </div>
                
                @if($medias->count() > 0)
                    <div class="ml-6">
                        <button 
                            wire:click="downloadAllMedia" 
                            class="group relative inline-flex items-center gap-2 px-6 py-3 bg-green-600/90 hover:bg-green-700 dark:from-green-500 dark:to-emerald-500 dark:hover:from-green-600 dark:hover:to-emerald-600 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105">
                            <svg class="w-5 h-5 transition-transform group-hover:translate-y-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                            </svg>
                            <span>Download ZIP</span>
                        </button>
                    </div>
                @endif
            </div>
            
            <!-- Media Count Badge -->
            <div class="mt-4 inline-flex items-center gap-2 px-4 py-2 bg-green-50/70 dark:bg-gray-700 rounded-full text-sm font-medium text-green-700 dark:text-green-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <span>{{ $medias->count() }} {{ $medias->count() === 1 ? 'ficheiro' : 'ficheiros' }}</span>
            </div>
        </div>

        <!-- Media Grid -->
        @if($medias->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($medias as $media)
                    <div class="group relative bg-white dark:bg-gray-800 rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300 overflow-hidden border border-green-100/30 dark:border-gray-700 hover:border-green-200 dark:hover:border-green-600 transform hover:-translate-y-1">
                        <!-- Media Container -->
                        <div class="aspect-square bg-gradient-to-br from-green-50/40 via-white to-green-50/30 dark:from-gray-900 dark:to-gray-800 p-6 relative overflow-hidden">
                            @if($media->file_type === 'image')
                                <img 
                                    src="{{ Storage::url($media->file_path) }}" 
                                    alt="{{ $media->file_name }}"
                                    class="w-full h-full object-cover rounded-xl cursor-pointer transition-transform duration-300 group-hover:scale-110" 
                                    onclick="openImageModal('{{ Storage::url($media->file_path) }}', '{{ $media->file_name }}')">
                                
                                <!-- Overlay on hover -->
                                <div class="absolute inset-6 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-xl flex items-center justify-center pointer-events-none">
                                    <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/>
                                    </svg>
                                </div>

                            @elseif($media->file_type === 'video')
                                <div class="relative w-full h-full flex items-center justify-center bg-black rounded-xl">
                                    <video 
                                        controls 
                                        class="max-w-full max-h-full rounded-xl"
                                        preload="metadata">
                                        <source src="{{ Storage::url($media->file_path) }}" type="{{ $media->mime_type }}">
                                    </video>
                                </div>
                                
                            @elseif($media->file_type === 'audio')
                                <div class="w-full h-full flex flex-col items-center justify-center p-6">
                                    <svg class="w-24 h-24 text-green-500/70 dark:text-green-400 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"/>
                                    </svg>
                                    <audio controls class="w-full">
                                        <source src="{{ Storage::url($media->file_path) }}" type="{{ $media->mime_type }}">
                                    </audio>
                                </div>
                            @endif

                            <!-- File type badge -->
                            <div class="absolute top-3 right-3 px-3 py-1.5 bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm rounded-full text-xs font-semibold text-gray-700 dark:text-gray-300 shadow-lg">
                                {{ strtoupper($media->file_type) }}
                            </div>
                        </div>

                        <!-- File Info -->
                        <div class="p-5 bg-gradient-to-br from-green-50/30 via-white to-transparent dark:from-gray-800 dark:to-gray-900">
                            <p class="text-sm font-medium text-gray-900 dark:text-white truncate" title="{{ $media->file_name }}">
                                {{ $media->file_name }}
                            </p>
                            @if($media->file_size)
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1.5">
                                    {{ number_format($media->file_size / 1024, 2) }} KB
                                </p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-16 bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-green-100/30 dark:border-gray-700">
                <svg class="mx-auto h-24 w-24 text-gray-400 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <h3 class="mt-4 text-lg font-semibold text-gray-900 dark:text-white">Sem ficheiros</h3>
                <p class="mt-2 text-gray-500 dark:text-gray-400">Este álbum ainda não tem ficheiros.</p>
            </div>
        @endif
    </div>

    <!-- Image Preview Modal -->
    <div id="imageModal" class="hidden fixed inset-0 z-50 overflow-hidden bg-black/90 backdrop-blur-sm" onclick="closeImageModal()">
        <div class="flex items-center justify-center min-h-screen p-4">
            <!-- Close button -->
            <button class="absolute top-6 right-6 text-white hover:text-gray-300 transition-colors z-10" onclick="closeImageModal()">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            <!-- Image container -->
            <div class="relative max-w-7xl max-h-[90vh] w-full" onclick="event.stopPropagation()">
                <img 
                    id="modalImage" 
                    src="" 
                    alt="" 
                    class="w-full h-full object-contain rounded-lg shadow-2xl">
                
                <!-- Image filename -->
                <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/80 to-transparent p-6 rounded-b-lg">
                    <p id="modalImageName" class="text-white text-lg font-medium text-center"></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function openImageModal(imageSrc, imageName) {
    const modal = document.getElementById('imageModal');
    const modalImage = document.getElementById('modalImage');
    const modalImageName = document.getElementById('modalImageName');
    
    modalImage.src = imageSrc;
    modalImage.alt = imageName;
    modalImageName.textContent = imageName;
    
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeImageModal() {
    const modal = document.getElementById('imageModal');
    modal.classList.add('hidden');
    document.body.style.overflow = 'auto';
}

// Close modal on Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeImageModal();
    }
});
</script>