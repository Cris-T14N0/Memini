<?php

namespace App\Livewire\Projects;

use App\Models\Project;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Facades\Storage;

class DeleteProjectsModal extends ModalComponent
{
    public $projectId;
    public $projectName;

    public function mount($projectId)
    {
        $project = Project::findOrFail($projectId);
        
        // Check if user owns the project
        if ($project->user_id !== auth()->id()) {
            $this->closeModal();
            session()->flash('error', 'Não tens permissão para eliminar este projeto.');
            return;
        }

        $this->projectId = $project->id;
        $this->projectName = $project->name;
    }

    public function confirmDelete()
    {
        $project = Project::findOrFail($this->projectId);

        // Double check ownership
        if ($project->user_id !== auth()->id()) {
            $this->closeModal();
            session()->flash('error', 'Não tens permissão para eliminar este projeto.');
            return;
        }

        // Delete cover image from storage
        if ($project->cover_image_path && Storage::disk('public')->exists($project->cover_image_path)) {
            Storage::disk('public')->delete($project->cover_image_path);
        }

        // Delete the entire project folder if empty
        $userId = auth()->id();
        $projectFolder = "{$userId}/projects";
        if (Storage::disk('public')->exists($projectFolder)) {
            $files = Storage::disk('public')->files($projectFolder);
            if (empty($files)) {
                Storage::disk('public')->deleteDirectory($projectFolder);
            }
        }

        // Delete project (hard delete)
        $project->delete();

        session()->flash('success', 'Projeto eliminado com sucesso!');
        
        $this->dispatch('projectChanged');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.projects.delete-projects-modal');
    }
}