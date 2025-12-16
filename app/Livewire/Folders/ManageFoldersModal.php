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
        
        // Load folder with user authorization
        $this->folder = Folder::where('id', $folderId)
            ->where('user_id', auth()->id())
            ->firstOrFail();
    }

    public function getProjectsInFolderProperty(): Collection
    {
        return Project::where('folder_id', $this->folderId)
            ->where('user_id', auth()->id())
            ->when($this->search, fn($query) => 
                $query->where('name', 'like', "%{$this->search}%")
            )
            ->orderBy('name')
            ->get();
    }

    public function getAvailableProjectsProperty(): Collection
    {
        return Project::where('user_id', auth()->id())
            ->whereNull('folder_id') // only projects without a folder
            ->when($this->search, fn ($query) =>
                $query->where('name', 'like', "%{$this->search}%")
            )
            ->orderBy('name')
            ->get();
    }


    public function addProjectToFolder(int $projectId): void
    {
        $project = Project::where('id', $projectId)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $project->folder_id = $this->folderId;
        $project->save();

        $this->dispatch('projectChanged');
        $this->dispatch('folderChanged');
        
        session()->flash('message', 'Projeto adicionado à pasta com sucesso!');
    }

    public function removeProjectFromFolder(int $projectId): void
    {
        $project = Project::where('id', $projectId)
            ->where('user_id', auth()->id())
            ->where('folder_id', $this->folderId)
            ->firstOrFail();

        $project->folder_id = null;
        $project->save();

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