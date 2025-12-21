<div class="p-6 bg-white dark:bg-gray-800 rounded-lg">
    <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">
        Enviar Ficheiros para {{ $album->title }}
    </h3>

    <form wire:submit.prevent="uploadMedia">
        <!-- File Upload Area -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Selecionar Ficheiros <span class="text-red-500">*</span>
            </label>
            
            <!-- Drag & Drop Zone -->
            <div 
                x-data="{ 
                    isDragging: false,
                    handleDrop(e) {
                        this.isDragging = false;
                        const files = Array.from(e.dataTransfer.files);
                        @this.upload('files', files);
                    }
                }"
                @dragover.prevent="isDragging = true"
                @dragleave.prevent="isDragging = false"
                @drop.prevent="handleDrop($event)"
                :class="isDragging ? 'border-blue-500 bg-blue-50 dark:bg-blue-900/20' : 'border-gray-300 dark:border-gray-600'"
                class="border-2 border-dashed rounded-lg p-8 text-center transition-colors"
            >
                <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                </svg>

                <div class="space-y-2">
                    <label class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg cursor-pointer transition">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Escolher Ficheiros
                        <input 
                            type="file" 
                            wire:model="files"
                            multiple
                            accept="image/*,video/*,audio/*"
                            class="hidden"
                        >
                    </label>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        ou arraste e solte ficheiros aqui
                    </p>
                    <p class="text-xs text-gray-400 dark:text-gray-500">
                        Imagens, Vídeos e Áudio (máx. 500MB cada)
                    </p>
                </div>
            </div>

            <!-- Loading Indicator -->
            <div wire:loading wire:target="files" class="mt-4 text-sm text-blue-600 dark:text-blue-400 flex items-center">
                <svg class="animate-spin h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                A carregar ficheiros...
            </div>

            @error('files.*') 
                <span class="text-red-500 text-sm mt-2 block">{{ $message }}</span> 
            @enderror
        </div>

        <!-- Preview Selected Files -->
        @if (!empty($files))
            <div class="mb-6">
                <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">
                    Ficheiros Selecionados ({{ count($files) }})
                </h4>
                
                <div class="space-y-2 max-h-64 overflow-y-auto">
                    @foreach($files as $index => $file)
                        <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                            <div class="flex items-center space-x-3 flex-1 min-w-0">
                                <!-- File Type Icon -->
                                @php
                                    $mimeType = $file->getMimeType();
                                    $isImage = str_starts_with($mimeType, 'image/');
                                    $isVideo = str_starts_with($mimeType, 'video/');
                                    $isAudio = str_starts_with($mimeType, 'audio/');
                                @endphp

                                @if($isImage)
                                    <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                @elseif($isVideo)
                                    <svg class="w-8 h-8 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                    </svg>
                                @elseif($isAudio)
                                    <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"></path>
                                    </svg>
                                @endif

                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 dark:text-gray-100 truncate">
                                        {{ $file->getClientOriginalName() }}
                                    </p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">
                                        {{ number_format($file->getSize() / 1024 / 1024, 2) }} MB
                                    </p>
                                </div>
                            </div>

                            <button 
                                type="button"
                                wire:click="removeFile({{ $index }})"
                                class="ml-4 text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Action Buttons -->
        <div class="flex justify-end space-x-3">
            <button 
                type="button"
                wire:click="$dispatch('closeModal')" 
                class="px-4 py-2 bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 font-semibold rounded-lg transition duration-150"
            >
                Cancelar
            </button>
            <button 
                type="submit"
                class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition duration-150 flex items-center disabled:opacity-50 disabled:cursor-not-allowed"
                wire:loading.attr="disabled"
                wire:target="files,uploadMedia"
                @disabled(empty($files))
            >
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                </svg>
                <span wire:loading.remove wire:target="uploadMedia">Enviar Ficheiros</span>
                <span wire:loading wire:target="uploadMedia">A enviar...</span>
            </button>
        </div>
    </form>
</div>