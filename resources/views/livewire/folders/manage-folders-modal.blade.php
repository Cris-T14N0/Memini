<div class="p-6 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 rounded-xl">
    <!-- Header -->
    <div class="mb-6">
        <div class="flex items-center gap-3 mb-2">
            @if($folder->icon)
                <div class="text-3xl">{{ $folder->icon }}</div>
            @endif

            <h2 class="text-2xl font-bold">
                Gerir Pasta: {{ $folder->name }}
            </h2>
        </div>

        <p class="text-gray-600 dark:text-gray-400">
            Adicione ou remova projetos desta pasta
        </p>
    </div>

    <!-- Flash Message -->
    @if (session()->has('message'))
        <div class="mb-4 p-4 rounded-lg bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800">
            <p class="text-green-800 dark:text-green-200">{{ session('message') }}</p>
        </div>
    @endif

    <!-- Search -->
    <div class="mb-6">
        <input
            type="text"
            wire:model.live.debounce.300ms="search"
            placeholder="Procurar projetos..."
            class="w-full rounded-lg px-4 py-2.5 bg-gray-50 dark:bg-gray-800
                   border border-gray-200 dark:border-gray-700"
        >
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        <!-- Projects in Folder -->
        <div class="rounded-xl p-4 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800">
            <h3 class="font-semibold mb-4">
                Na Pasta ({{ $this->projectsInFolder->count() }})
            </h3>

            <div class="space-y-2">
                @forelse($this->projectsInFolder as $project)
                    <div class="flex justify-between items-center p-3 bg-white dark:bg-gray-800 rounded-lg">
                        <div class="min-w-0">
                            <div class="flex items-center gap-2">
                                <h4 class="font-medium truncate">{{ $project->name }}</h4>

                                @if($project->user_id !== auth()->id())
                                    <span class="text-xs px-2 py-0.5 rounded-full
                                                 bg-purple-100 text-purple-700
                                                 dark:bg-purple-900/40 dark:text-purple-300">
                                        Partilhado
                                    </span>
                                @endif
                            </div>
                        </div>

                        <button
                            wire:click="removeProjectFromFolder({{ $project->id }})"
                            class="text-red-600 hover:bg-red-50 p-2 rounded-lg">
                            ✕
                        </button>
                    </div>
                @empty
                    <p class="text-sm text-gray-500 text-center py-8">
                        Nenhum projeto nesta pasta
                    </p>
                @endforelse
            </div>
        </div>

        <!-- Available Projects -->
        <div class="rounded-xl p-4 bg-gray-50 dark:bg-gray-800 border">
            <h3 class="font-semibold mb-4">
                Projetos Disponíveis ({{ $this->availableProjects->count() }})
            </h3>

            <div class="space-y-2">
                @forelse($this->availableProjects as $project)
                    <div class="flex justify-between items-center p-3 bg-white dark:bg-gray-800 rounded-lg">
                        <div class="min-w-0">
                            <div class="flex items-center gap-2">
                                <h4 class="font-medium truncate">{{ $project->name }}</h4>

                                @if($project->user_id !== auth()->id())
                                    <span class="text-xs px-2 py-0.5 rounded-full
                                                 bg-purple-100 text-purple-700
                                                 dark:bg-purple-900/40 dark:text-purple-300">
                                        Partilhado
                                    </span>
                                @endif
                            </div>
                        </div>

                        <button
                            wire:click="addProjectToFolder({{ $project->id }})"
                            class="text-green-600 hover:bg-green-50 p-2 rounded-lg">
                            ＋
                        </button>
                    </div>
                @empty
                    <p class="text-sm text-gray-500 text-center py-8">
                        Nenhum projeto disponível
                    </p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="mt-6 text-right">
        <button
            wire:click="$dispatch('closeModal')"
            class="px-5 py-2 rounded-lg bg-gray-200 dark:bg-gray-700">
            Fechar
        </button>
    </div>
</div>
