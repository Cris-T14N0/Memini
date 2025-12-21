<?php

namespace App\Livewire\Projects;

use App\Models\Project;
use LivewireUI\Modal\ModalComponent;

class LeaveSharedProjects extends ModalComponent
{
    public $projectId;
    public $project;

    public function mount($projectId)
    {
        $this->projectId = $projectId;
        
        // Load the project and verify user is a member (but not owner)
        $this->project = Project::whereHas('users', function($query) {
            $query->where('user_id', auth()->id());
        })->findOrFail($projectId);

        // Prevent owner from leaving their own project
        if ($this->project->user_id === auth()->id()) {
            session()->flash('error', 'Não podes sair do teu próprio projeto.');
            $this->closeModal();
        }
    }

    public function leaveProject()
    {
        // Remove user from project
        $this->project->users()->detach(auth()->id());

        session()->flash('message', 'Saíste do projeto com sucesso!');
        
        $this->dispatch('projectChanged');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.projects.leave-shared-projects');
    }

    public static function modalMaxWidth(): string
    {
        return 'md';
    }
}