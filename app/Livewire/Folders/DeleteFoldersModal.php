<?php
namespace App\Livewire\Folders;

use App\Models\Folder;
use LivewireUI\Modal\ModalComponent;
use Log;

class DeleteFoldersModal extends ModalComponent
{
    public $folderId;
    public $folderName;
    public $projectsCount;

    public function mount($folderId)
    {
        $folder = Folder::withCount('projects')->findOrFail($folderId);
        
        $this->folderId = $folder->id;
        $this->folderName = $folder->name;
        $this->projectsCount = $folder->projects_count;
    }

    public function confirmDelete()
    {
        try {
            $folder = Folder::findOrFail($this->folderId);
            
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
