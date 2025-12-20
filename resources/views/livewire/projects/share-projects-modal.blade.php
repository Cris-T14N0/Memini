<div class="p-4">
    <h3 class="text-lg font-semibold mb-3">Share Project: {{ $project->name ?? '' }}</h3>

    @if(session()->has('message'))
        <div class="mb-2 p-2 bg-green-100 text-green-800 rounded">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="sendInvitation" class="flex gap-2">
        <input type="email" wire:model.defer="email" placeholder="Email" class="flex-1 border rounded px-2 py-1">
        <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">
            Send
        </button>
    </form>
</div>
