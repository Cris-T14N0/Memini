<?php

namespace App\Livewire\Folders;

use App\Models\Folder;
use App\Models\Project;
use LivewireUI\Modal\ModalComponent;
use Log;

class DeleteFoldersModal extends ModalComponent
{
    public $folderId;
    public $folderName;
    public $projectsCount;
    public $deleteProjects = false;

    public function mount($folderId)
    {
        $folder = Folder::findOrFail($folderId);
        
        $this->folderId = $folder->id;
        $this->folderName = $folder->name;
        
        // Count projects in THIS USER'S folder using relationship
        $this->projectsCount = $folder->projectAssignments()
            ->wherePivot('user_id', auth()->id())
            ->count();
    }

    public function confirmDelete()
    {
        try {
            $folder = Folder::findOrFail($this->folderId);

            if ($this->deleteProjects) {
                // Get projects that are in this folder for this user
                $projectIds = $folder->projectAssignments()
                    ->wherePivot('user_id', auth()->id())
                    ->pluck('projects.id');

                // Delete the projects (only if user owns them)
                Project::whereIn('id', $projectIds)
                    ->where('user_id', auth()->id())
                    ->delete();
            } else {
                // Just remove folder assignments for this user
                $folder->projectAssignments()
                    ->wherePivot('user_id', auth()->id())
                    ->detach();
            }

            // Delete the folder
            $folder->delete();

            Log::info('Folder deleted: ' . $this->folderName);
            session()->flash('success', 'Pasta eliminada com sucesso!');
            
            $this->dispatch('folderChanged');
            $this->closeModal();
        } catch (\Exception $e) {
            Log::error('Folder deletion failed: ' . $e->getMessage());
            session()->flash('error', 'Erro ao eliminar pasta: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.folders.delete-folders-modal');
    }
}