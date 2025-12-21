<?php

namespace App\Livewire\Folders;

use App\Models\Folder;
use App\Models\Project;
use Illuminate\Support\Collection;
use LivewireUI\Modal\ModalComponent;

class ManageFoldersModal extends ModalComponent
{
    public int $folderId;
    public ?Folder $folder = null;
    public string $search = '';

    public function mount($folderId): void
    {
        $this->folderId = $folderId;

        $this->folder = Folder::where('id', $folderId)
            ->where('user_id', auth()->id())
            ->firstOrFail();
    }

    /**
     * Projects currently inside this folder
     */
    public function getProjectsInFolderProperty(): Collection
    {
        return Project::where('folder_id', $this->folderId)
            ->where(function ($query) {
                $query->where('user_id', auth()->id())
                      ->orWhereHas('users', function ($q) {
                          $q->where('user_id', auth()->id());
                      });
            })
            ->when($this->search, fn ($query) =>
                $query->where('name', 'like', "%{$this->search}%")
            )
            ->orderBy('name')
            ->get();
    }

    /**
     * Projects available to be added
     */
    public function getAvailableProjectsProperty(): Collection
    {
        $ownedProjects = Project::where('user_id', auth()->id())
            ->whereNull('folder_id')
            ->when($this->search, fn ($query) =>
                $query->where('name', 'like', "%{$this->search}%")
            )
            ->get();

        $sharedProjects = auth()->user()->projects()
            ->whereNull('folder_id')
            ->when($this->search, fn ($query) =>
                $query->where('name', 'like', "%{$this->search}%")
            )
            ->get();

        return $ownedProjects
            ->merge($sharedProjects)
            ->unique('id')
            ->sortBy('name')
            ->values();
    }

    public function addProjectToFolder(int $projectId): void
    {
        $project = Project::where('id', $projectId)
            ->where(function ($query) {
                $query->where('user_id', auth()->id())
                      ->orWhereHas('users', function ($q) {
                          $q->where('user_id', auth()->id());
                      });
            })
            ->firstOrFail();

        $project->update([
            'folder_id' => $this->folderId,
        ]);

        $this->dispatch('projectChanged');
        $this->dispatch('folderChanged');

        session()->flash('message', 'Projeto adicionado à pasta com sucesso!');
    }

    public function removeProjectFromFolder(int $projectId): void
    {
        $project = Project::where('id', $projectId)
            ->where('folder_id', $this->folderId)
            ->where(function ($query) {
                $query->where('user_id', auth()->id())
                      ->orWhereHas('users', function ($q) {
                          $q->where('user_id', auth()->id());
                      });
            })
            ->firstOrFail();

        $project->update([
            'folder_id' => null,
        ]);

        $this->dispatch('projectChanged');
        $this->dispatch('folderChanged');

        session()->flash('message', 'Projeto removido da pasta com sucesso!');
    }

    public function render()
    {
        return view('livewire.folders.manage-folders-modal');
    }

    public static function modalMaxWidth(): string
    {
        return '4xl';
    }
}
