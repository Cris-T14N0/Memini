<?php

namespace App\Livewire\Projects;

use App\Models\Project;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Computed;

class ShowProjects extends Component
{
    public string $search = '';
    public string $sortBy = 'date-desc';
    public bool $showProgress = true;
    public bool $showCompleted = true;

    // --- Listen for project created event ---
    #[On('projectChanged')]
    public function refreshProjects()
    {
        // Clear the cached computed property
        unset($this->projects);
        
        // Force a re-render
        $this->render();
    }

    // --- Edit Project ---
    public function editProject($projectId)
    {
        $this->dispatch('openModal', component: 'projects.edit-projects-modal', arguments: ['projectId' => $projectId]);
    }

    // --- Share Project ---
    public function shareProject($projectId)
    {
        $this->dispatch('openModal', component: 'projects.share-projects-modal', arguments: ['projectId' => $projectId]);
    }

    // --- Toggle filters ---
    public function toggleFilterProgress()
    {
        $this->showProgress = !$this->showProgress;
    }

    public function toggleFilterCompleted()
    {
        $this->showCompleted = !$this->showCompleted;
    }

    // --- Computed Projects ---
    #[Computed] // Add this attribute to properly mark it as computed
    public function projects()
    {
        $query = Project::query()
            ->where('user_id', auth()->id());

        // Search
        if ($this->search !== '') {
            $query->where(function ($q) {
                $q->where('name', 'like', "%{$this->search}%")
                  ->orWhere('description', 'like', "%{$this->search}%");
            });
        }

        // Sorting
        match ($this->sortBy) {
            'date-asc'  => $query->orderBy('created_at', 'asc'),
            'date-desc' => $query->orderBy('created_at', 'desc'),
            'name-asc'  => $query->orderBy('name', 'asc'),
            'name-desc' => $query->orderBy('name', 'desc'),
            default     => $query->orderBy('created_at', 'desc'),
        };

        $projects = $query->get();

        return [
            'progress'  => $projects->where('completed', false)->values(),
            'completed' => $projects->where('completed', true)->values(),
        ];
    }

    public function render()
    {
        return view('livewire.projects.show-projects', [
            'projects' => $this->projects, // This now properly calls the computed property
        ]);
    }
}