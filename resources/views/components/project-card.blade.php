@props(['project', 'statusType']) {{-- *** ACCEPT THE NEW PROP HERE *** --}}

<div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 hover:shadow-xl transition">
    <div class="text-sm text-gray-400 dark:text-gray-500 mb-4">
        {{ $project->created_at->format('M d, Y') }}
    </div>

    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2">
        {{ $project->name }}
    </h3>

    <p class="text-gray-600 dark:text-gray-400 mb-6">
        {{ $project->description ?? 'Sem descrição' }}
    </p>

    <div class="flex items-center justify-between">
        <div class="flex items-center gap-2">
            {{-- ... (Owner photo logic) ... --}}
            @if($project->owner->profile_photo)
                <img src="{{ Storage::url($project->owner->profile_photo) }}" 
                     alt="{{ $project->owner->name }}" 
                     class="w-8 h-8 rounded-full object-cover">
            @else
                <img src="https://ui-avatars.com/api/?name={{ urlencode($project->owner->name) }}" 
                     alt="{{ $project->owner->name }}" 
                     class="w-8 h-8 rounded-full object-cover">
            @endif
        </div>

        @if($statusType === 'progress')
            <span class="bg-blue-100 dark:bg-blue-900 text-blue-700 dark:text-blue-300 px-4 py-1 rounded-full text-sm">
                Em Progresso
            </span>
        @elseif($statusType === 'completed')
            <span class="bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300 px-4 py-1 rounded-full text-sm">
                Concluído
            </span>
        @endif
    </div>
</div>