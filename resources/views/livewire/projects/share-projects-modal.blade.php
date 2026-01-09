<div class="p-6 bg-white dark:bg-gray-800 rounded-lg">
    <!-- Header -->
    <div class="mb-6">
        <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100">
            Partilhar Projeto
        </h3>
        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
            {{ $project->name }}
        </p>
    </div>

    <!-- Flash Messages -->
    @if(session()->has('message'))
        <div class="mb-4 p-3 bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-200 rounded-lg border border-green-200 dark:border-green-800 flex items-start">
            <svg class="w-5 h-5 mr-2 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            {{ session('message') }}
        </div>
    @endif

    @if(session()->has('error'))
        <div class="mb-4 p-3 bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-200 rounded-lg border border-red-200 dark:border-red-800 flex items-start">
            <svg class="w-5 h-5 mr-2 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            {{ session('error') }}
        </div>
    @endif

    <!-- Invite Section -->
    <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-4 mb-6 border border-gray-200 dark:border-gray-600">
        <h4 class="text-sm font-semibold text-gray-900 dark:text-gray-100 mb-4">Convidar Novo Membro</h4>
        
        <form wire:submit.prevent="sendInvitation" class="space-y-4">
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Email <span class="text-red-500">*</span>
                </label>
                <input 
                    type="email" 
                    id="email"
                    wire:model.defer="email" 
                    placeholder="exemplo@email.com"
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-gray-100">
                @error('email') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="role" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Função <span class="text-red-500">*</span>
                </label>
                <select 
                    id="role"
                    wire:model.defer="selectedRoleId"
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-gray-100">
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
                @error('selectedRoleId') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>

            <button 
                type="submit"
                class="w-full px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition duration-150 flex items-center justify-center"
                wire:loading.attr="disabled"
                wire:target="sendInvitation">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
                <span wire:loading.remove wire:target="sendInvitation">Enviar Convite</span>
                <span wire:loading wire:target="sendInvitation">A enviar...</span>
            </button>
        </form>
    </div>

    <!-- Current Members -->
    <div class="mb-6">
        <h4 class="text-sm font-semibold text-gray-900 dark:text-gray-100 mb-3">
            Membros Atuais ({{ $project->users->count() }})
        </h4>
        
        <div class="space-y-2 max-h-64 overflow-y-auto">
            @forelse($project->users as $user)
                <div class="flex items-center justify-between p-3 bg-white dark:bg-gray-700 rounded-lg border border-gray-300 dark:border-gray-600">
                    <div class="flex items-center gap-3 flex-1 min-w-0">
                        <!-- Avatar -->
                        @if($user->profile_photo)
                            <img 
                                src="{{ Storage::url($user->profile_photo) }}" 
                                alt="{{ $user->name }}"
                                class="w-10 h-10 rounded-full object-cover flex-shrink-0"
                            >
                        @else
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-purple-500 flex items-center justify-center text-white font-semibold flex-shrink-0">
                                {{ $user->getInitials() }}
                            </div>
                        @endif
                        
                        <div class="min-w-0 flex-1">
                            <p class="font-medium text-gray-900 dark:text-gray-100 truncate">{{ $user->name }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ $user->email }}</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-2 flex-shrink-0">
                        @if($user->id === auth()->id())
                            <span class="px-2 py-1 text-xs font-medium bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-200 rounded">
                                Tu
                            </span>
                        @endif

                        <!-- Role Selector -->
                        <select 
                            wire:change="updateMemberRole({{ $user->id }}, $event.target.value)"
                            class="text-sm px-3 py-1.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-600 dark:text-gray-100"
                            {{ $user->id === auth()->id() ? 'disabled' : '' }}>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}" {{ $user->pivot->role_id == $role->id ? 'selected' : '' }}>
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>

                        <!-- Remove Button -->
                        @if($user->id !== auth()->id())
                            <button 
                                wire:click="removeMember({{ $user->id }})"
                                wire:confirm="Tens a certeza que queres remover este membro?"
                                class="p-2 text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        @endif
                    </div>
                </div>
            @empty
                <div class="text-center py-8 bg-gray-50 dark:bg-gray-700/50 rounded-lg border border-gray-200 dark:border-gray-600">
                    <svg class="mx-auto h-12 w-12 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Nenhum membro no projeto</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Pending Invitations -->
    @if($project->invitations->count() > 0)
        <div class="mb-4">
            <h4 class="text-sm font-semibold text-gray-900 dark:text-gray-100 mb-3">
                Convites Pendentes ({{ $project->invitations->count() }})
            </h4>
            
            <div class="space-y-2 max-h-48 overflow-y-auto">
                @foreach($project->invitations as $invitation)
                    <div class="flex items-center justify-between p-3 bg-yellow-50 dark:bg-yellow-900/20 rounded-lg border border-yellow-200 dark:border-yellow-800">
                        <div class="flex-1 min-w-0">
                            <p class="font-medium text-gray-900 dark:text-gray-100 truncate">{{ $invitation->email }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                Enviado em {{ $invitation->created_at->format('d/m/Y H:i') }}
                            </p>
                        </div>

                        <button 
                            wire:click="cancelInvitation({{ $invitation->id }})"
                            wire:confirm="Tens a certeza que queres cancelar este convite?"
                            class="ml-3 px-3 py-1.5 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-colors font-medium flex-shrink-0">
                            Cancelar
                        </button>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Close Button -->
    <div class="mt-6 pt-4 border-t border-gray-200 dark:border-gray-600">
        <button 
            type="button"
            wire:click="$dispatch('closeModal')" 
            class="w-full px-4 py-2 bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 font-semibold rounded-lg transition duration-150">
            Fechar
        </button>
    </div>
</div>