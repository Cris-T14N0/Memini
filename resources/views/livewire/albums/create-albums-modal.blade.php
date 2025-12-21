<div class="p-6 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 rounded-xl">
    <!-- Header -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold mb-2">Criar Novo Álbum</h2>
        <p class="text-gray-600 dark:text-gray-400">
            Adiciona um novo álbum ao projeto <strong>{{ $project->name }}</strong>
        </p>
    </div>

    <!-- Flash Messages -->
    @if (session()->has('error'))
        <div class="mb-4 p-4 rounded-lg bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800">
            <p class="text-red-800 dark:text-red-200">{{ session('error') }}</p>
        </div>
    @endif

    <form wire:submit.prevent="createAlbum">
        <!-- Title -->
        <div class="mb-4">
            <label for="title" class="block text-sm font-medium mb-2">
                Título do Álbum <span class="text-red-500">*</span>
            </label>
            <input
                type="text"
                id="title"
                wire:model="title"
                class="w-full rounded-lg px-4 py-2.5
                       bg-gray-50 dark:bg-gray-800
                       border border-gray-200 dark:border-gray-700
                       text-gray-900 dark:text-gray-100
                       focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Ex: Cerimónia de Casamento"
            >
            @error('title')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <!-- Description -->
        <div class="mb-4">
            <label for="description" class="block text-sm font-medium mb-2">
                Descrição <span class="text-red-500">*</span>
            </label>
            <textarea
                id="description"
                wire:model="description"
                rows="4"
                class="w-full rounded-lg px-4 py-2.5
                       bg-gray-50 dark:bg-gray-800
                       border border-gray-200 dark:border-gray-700
                       text-gray-900 dark:text-gray-100
                       focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Descreve o álbum..."
            ></textarea>
            @error('description')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <!-- Cover Image -->
        <div class="mb-6">
            <label class="block text-sm font-medium mb-2">
                Imagem de Capa <span class="text-red-500">*</span>
            </label>
            
            <div class="mt-2 flex justify-center rounded-lg border-2 border-dashed border-gray-300 dark:border-gray-700 px-6 py-10">
                <div class="text-center">
                    @if ($cover_image)
                        <img src="{{ $cover_image->temporaryUrl() }}" class="mx-auto h-32 w-32 object-cover rounded-lg mb-4">
                    @else
                        <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-500" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    @endif
                    
                    <div class="mt-4 flex text-sm leading-6 text-gray-600 dark:text-gray-400">
                        <label for="cover_image" class="relative cursor-pointer rounded-md font-semibold text-blue-600 dark:text-blue-400 hover:text-blue-500">
                            <span>Carregar ficheiro</span>
                            <input id="cover_image" wire:model="cover_image" type="file" class="sr-only" accept="image/*">
                        </label>
                        <p class="pl-1">ou arrastar e largar</p>
                    </div>
                    <p class="text-xs leading-5 text-gray-500 dark:text-gray-400">PNG, JPG, GIF até 10MB</p>
                </div>
            </div>

            @error('cover_image')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror

            <div wire:loading wire:target="cover_image" class="mt-2 text-sm text-blue-600 dark:text-blue-400">
                A carregar imagem...
            </div>
        </div>

        <!-- Actions -->
        <div class="flex justify-end gap-3">
            <button
                type="button"
                wire:click="$dispatch('closeModal')"
                class="px-6 py-2.5 rounded-lg font-medium
                       bg-gray-200 dark:bg-gray-700
                       text-gray-700 dark:text-gray-300
                       hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                Cancelar
            </button>

            <button
                type="submit"
                wire:loading.attr="disabled"
                wire:loading.class="opacity-50 cursor-not-allowed"
                class="px-6 py-2.5 rounded-lg font-medium
                       bg-gradient-to-r from-blue-600 to-purple-600
                       text-white hover:from-blue-700 hover:to-purple-700
                       transition disabled:opacity-50 disabled:cursor-not-allowed">
                <span wire:loading.remove wire:target="createAlbum">Criar Álbum</span>
                <span wire:loading wire:target="createAlbum">A criar...</span>
            </button>
        </div>
    </form>
</div>