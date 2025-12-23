<div class="p-6 bg-white dark:bg-gray-800 rounded-lg">
    <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-2">
        Partilhar Álbum
    </h3>
    <p class="text-sm text-gray-600 dark:text-gray-400 mb-6">
        {{ $album->title }}
    </p>

    <!-- Existing Shared Links -->
    @if($sharedLinks->count() > 0)
        <div class="mb-6 p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
            <h4 class="text-sm font-semibold text-gray-900 dark:text-gray-100 mb-3">
                Links Partilhados
            </h4>
            <div class="space-y-2 max-h-48 overflow-y-auto">
                @foreach($sharedLinks as $link)
                    <div class="flex items-center justify-between p-3 bg-white dark:bg-gray-700 rounded border border-gray-200 dark:border-gray-600">
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 dark:text-gray-100 truncate">
                                {{ $link->email }}
                            </p>
                            <div class="flex items-center space-x-3 mt-1">
                                <span class="text-xs text-gray-500 dark:text-gray-400">
                                    @if($link->sent_at)
                                        Enviado em {{ $link->sent_at->format('d/m/Y H:i') }}
                                    @else
                                        Agendado para {{ $link->deliver_at->format('d/m/Y H:i') }}
                                    @endif
                                </span>
                                @if($link->expires_at)
                                    <span class="text-xs {{ $link->isExpired() ? 'text-red-500' : 'text-gray-500 dark:text-gray-400' }}">
                                        {{ $link->isExpired() ? 'Expirado' : 'Expira em ' . $link->expires_at->format('d/m/Y') }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        <button 
                            wire:click="deleteSharedLink({{ $link->id }})"
                            wire:confirm="Tens a certeza que queres remover este link?"
                            class="ml-3 text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </button>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <form wire:submit.prevent="shareAlbum">
        <!-- Email Address -->
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Email <span class="text-red-500">*</span>
            </label>
            <input 
                type="email" 
                id="email"
                wire:model="email"
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-gray-100"
                placeholder="destinatario@exemplo.com"
            >
            @error('email') 
                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> 
            @enderror
        </div>

        <!-- Optional Message -->
        <div class="mb-4">
            <label for="message" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Mensagem Personalizada (Opcional)
            </label>
            <textarea 
                id="message"
                wire:model="message"
                rows="4"
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-gray-100 resize-none"
                placeholder="Adiciona uma mensagem pessoal para o destinatário..."
            ></textarea>
            @error('message') 
                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> 
            @enderror
        </div>

        <!-- Send Immediately Toggle -->
        <div class="mb-4">
            <label class="flex items-center cursor-pointer">
                <input 
                    type="checkbox" 
                    wire:model.live="sendImmediately"
                    class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                >
                <span class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                    Enviar agora
                </span>
            </label>
        </div>

        <!-- Schedule Delivery -->
        @if(!$sendImmediately)
            <div class="mb-4">
                <label for="deliverAt" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Agendar Envio Para <span class="text-red-500">*</span>
                </label>
                <input 
                    type="datetime-local" 
                    id="deliverAt"
                    wire:model="deliverAt"
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-gray-100"
                    min="{{ now()->addMinutes(5)->format('Y-m-d\TH:i') }}"
                >
                @error('deliverAt') 
                    <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> 
                @enderror
            </div>
        @endif

        <!-- Link Expiration -->
        <div class="mb-6">
            <label for="expiresAt" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Link Expira Em (Opcional)
            </label>
            <input 
                type="date" 
                id="expiresAt"
                wire:model="expiresAt"
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-gray-100"
                min="{{ now()->addDay()->format('Y-m-d') }}"
            >
            @error('expiresAt') 
                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> 
            @enderror
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                O link deixará de funcionar após esta data
            </p>
        </div>

        <!-- Info Box -->
        <div class="mb-6 p-4 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg">
            <div class="flex">
                <svg class="w-5 h-5 text-blue-600 dark:text-blue-400 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div class="text-sm text-blue-800 dark:text-blue-300">
                    <p class="font-medium mb-1">O destinatário receberá:</p>
                    <ul class="list-disc list-inside space-y-1 text-xs">
                        <li>Um link direto para visualizar todos os ficheiros do álbum</li>
                        <li>Não precisa de conta para aceder</li>
                        <li>Pode ver e fazer download dos ficheiros</li>
                    </ul>
                </div>
            </div>
        </div>

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
                class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition duration-150 flex items-center"
                wire:loading.attr="disabled"
            >
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path>
                </svg>
                <span wire:loading.remove wire:target="shareAlbum">
                    {{ $sendImmediately ? 'Enviar' : 'Agendar' }}
                </span>
                <span wire:loading wire:target="shareAlbum">A processar...</span>
            </button>
        </div>
    </form>
</div>