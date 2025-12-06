{{-- resources/views/components/project-card.blade.php --}}
@props(['project'])

@php
    $isCompleted = $project->completed;
    $daysLeft = $isCompleted ? null : now()->diffInDays($project->created_at->addYear(), false);
@endphp

<div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 hover:shadow-xl transition {{ $isCompleted ? 'opacity-75' : '' }}">
    <div class="text-sm text-gray-400 dark:text-gray-500 mb-4">
        {{ $project->created_at->format('d M, Y') }}
    </div>
    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2">
        <a href="#" class="hover:text-indigo-600 dark:hover:text-indigo-400">
            {{ $project->name }}
        </a>
    </h3>
    <p class="text-gray-600 dark:text-gray-400 mb-6">
        {{ Str::limit($project->description, 60) }}
    </p>

    <div class="flex items-center justify-between">
        <div class="flex -space-x-2">
            <div class="w-10 h-10 rounded-full bg-gradient-to-r from-indigo-500 to-purple-500 border-2 border-white dark:border-gray-800 flex items-center justify-center text-white font-bold">
                {{ Str::upper($project->owner?->name[0] ?? '?') }}
            </div>
        </div>

        <span class="px-4 py-1.5 rounded-full text-sm font-medium {{ $isCompleted 
            ? 'bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300' 
            : 'bg-blue-100 dark:bg-blue-900 text-blue-700 dark:text-blue-300' }}">
            {{ $isCompleted ? 'Concluído' : 'Em Progresso' }}
        </span>
    </div>
</div>
