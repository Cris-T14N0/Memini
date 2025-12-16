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
        $query = Folder::query()->withCount('projects');

        if ($this->search !== '') {
            $query->where('name', 'like', "%{$this->search}%");
        }

        match ($this->sortBy) {
            'date-asc'  => $query->orderBy('created_at', 'asc'),
            'date-desc' => $query->orderBy('created_at', 'desc'),
            'name-asc'  => $query->orderBy('name', 'asc'),
            'name-desc' => $query->orderBy('name', 'desc'),
            default     => $query->orderBy('created_at', 'desc'),
        };

        return $query->get();
    }

    public function render()
    {
        return view('livewire.folders.show-folders', [
            'folders' => $this->folders,
        ]);
    }
}
