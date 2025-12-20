<?php

namespace App\Livewire\Folders;

use App\Models\Folder;
use Livewire\Attributes\On;
use Livewire\Attributes\Computed;
use LivewireUI\Modal\ModalComponent;

class ShowFolders extends ModalComponent
{
    public string $search = '';
    public string $sortBy = 'date-desc';

    #[On('folderChanged')]
    public function refreshFolders()
    {
        unset($this->folders);
    }

    public function editFolder($folderId)
    {
        $this->dispatch('openModal', component: 'folders.edit-folders-modal', arguments: ['folderId' => $folderId]);
    }

    public function deleteFolder($folderId)
    {
        $this->dispatch('openModal', component: 'folders.delete-folders-modal', arguments: ['folderId' => $folderId]);
    }

    public function manageFolder($folderId)
    {
        $this->dispatch('openModal', component: 'folders.manage-folders-modal', arguments: ['folderId' => $folderId]);
    }

    #[Computed]
    public function folders()
    {
        $folders = auth()->user()->folders()->withCount('projects');

        if ($this->search !== '') {
            $folders->where('name', 'like', "%{$this->search}%");
        }

        match ($this->sortBy) {
            'date-asc'  => $folders->orderBy('created_at', 'asc'),
            'date-desc' => $folders->orderBy('created_at', 'desc'),
            'name-asc'  => $folders->orderBy('name', 'asc'),
            'name-desc' => $folders->orderBy('name', 'desc'),
            default     => $folders->orderBy('created_at', 'desc'),
        };

        return $folders->get();
    }

    public function render()
    {
        return view('livewire.folders.show-folders', [
            'folders' => $this->folders,
        ]);
    }
}
