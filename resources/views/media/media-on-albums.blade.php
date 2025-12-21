<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
            {{ __('Gerir Álbum') }}
        </h2>
    </x-slot>

    <livewire:media.show-media-on-albums :album="$album" />
</x-app-layout>