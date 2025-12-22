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
    public bool $showShared = true;

    #[On('projectChanged')]
    public function refreshProjects()
    {
        unset($this->projects);
        unset($this->sharedProjects);
        $this->render();
    }

    public function editProject($projectId)
    {
        $this->dispatch('openModal', component: 'projects.edit-projects-modal', arguments: ['projectId' => $projectId]);
    }

    public function shareProject($projectId)
    {
        $this->dispatch('openModal', component: 'projects.share-projects-modal', arguments: ['projectId' => $projectId]);
    }

    public function toggleFilterProgress()
    {
        $this->showProgress = !$this->showProgress;
    }

    public function toggleFilterCompleted()
    {
        $this->showCompleted = !$this->showCompleted;
    }

    public function toggleFilterShared()
    {
        $this->showShared = !$this->showShared;
    }

    #[Computed]
    public function projects()
    {
        $query = Project::query()
            ->where('user_id', auth()->id())
            ->with(['owner']);

        if ($this->search !== '') {
            $query->where(function ($q) {
                $q->where('name', 'like', "%{$this->search}%")
                  ->orWhere('description', 'like', "%{$this->search}%");
            });
        }

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

    #[Computed]
    public function sharedProjects()
    {
        $query = auth()->user()->projects()
            ->where('projects.user_id', '!=', auth()->id())
            ->with(['owner'])
            ->withPivot('role_id');

        if ($this->search !== '') {
            $query->where(function ($q) {
                $q->where('projects.name', 'like', "%{$this->search}%")
                  ->orWhere('projects.description', 'like', "%{$this->search}%");
            });
        }

        match ($this->sortBy) {
            'date-asc'  => $query->orderBy('projects.created_at', 'asc'),
            'date-desc' => $query->orderBy('projects.created_at', 'desc'),
            'name-asc'  => $query->orderBy('projects.name', 'asc'),
            'name-desc' => $query->orderBy('projects.name', 'desc'),
            default     => $query->orderBy('projects.created_at', 'desc'),
        };

        return $query->get();
    }

    public function render()
    {
        return view('livewire.projects.show-projects', [
            'projects' => $this->projects,
            'sharedProjects' => $this->sharedProjects,
        ]);
    }
}