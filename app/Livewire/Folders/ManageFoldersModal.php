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
     * Projects currently inside THIS USER'S folder
     */
    public function getProjectsInFolderProperty(): Collection
    {
        $query = $this->folder->projectAssignments()
            ->wherePivot('user_id', auth()->id())
            ->where(function ($query) {
                $query->where('projects.user_id', auth()->id())
                    ->orWhereHas('users', function ($q) {
                        $q->where('users.id', auth()->id());
                    });
            });

        if ($this->search) {
            $query->where('projects.name', 'like', "%{$this->search}%");
        }

        return $query->with(['owner'])->orderBy('name')->get();
    }

    /**
     * Projects available to be added (not in any of MY folders)
     */
    public function getAvailableProjectsProperty(): Collection
    {
        // Get all MY folder IDs
        $myFolderIds = auth()->user()->folders()->pluck('id');

        return Project::query()
            ->where(function ($query) {
                $query->where('user_id', auth()->id())
                    ->orWhereHas('users', function ($q) {
                        $q->where('users.id', auth()->id());
                    });
            })
            ->whereDoesntHave('folderAssignments', function ($query) use ($myFolderIds) {
                $query->whereIn('folder_id', $myFolderIds)
                    ->where('folder_project_user.user_id', auth()->id());
            })
            ->when($this->search, fn ($query) =>
                $query->where('name', 'like', "%{$this->search}%")
            )
            ->with(['owner'])
            ->orderBy('name')
            ->get();
    }

    public function addProjectToFolder(int $projectId): void
    {
        $project = Project::where('id', $projectId)
            ->where(function ($query) {
                $query->where('user_id', auth()->id())
                    ->orWhereHas('users', function ($q) {
                        $q->where('users.id', auth()->id());
                    });
            })
            ->firstOrFail();

        // Detach from any other folder for this user first (one folder per user rule)
        $project->folderAssignments()
            ->wherePivot('user_id', auth()->id())
            ->detach();

        // Attach to this folder
        $project->folderAssignments()->attach($this->folderId, [
            'user_id' => auth()->id(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->dispatch('projectChanged');
        $this->dispatch('folderChanged');

        session()->flash('message', 'Projeto adicionado à pasta com sucesso!');
    }

    public function removeProjectFromFolder(int $projectId): void
    {
        $project = Project::where('id', $projectId)
            ->where(function ($query) {
                $query->where('user_id', auth()->id())
                    ->orWhereHas('users', function ($q) {
                        $q->where('users.id', auth()->id());
                    });
            })
            ->firstOrFail();

        // Remove from this folder for this user
        $project->folderAssignments()
            ->wherePivot('user_id', auth()->id())
            ->wherePivot('folder_id', $this->folderId)
            ->detach();

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