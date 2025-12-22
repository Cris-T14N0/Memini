<?php

namespace App\Livewire\Folders;

use App\Models\Folder;
use App\Models\Project;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Computed;

class ShowProjectsOnFolders extends Component
{
    public Folder $folder;
    public string $search = '';
    public string $sortBy = 'date-desc';
    public bool $showProgress = true;
    public bool $showCompleted = true;
    public bool $showShared = true;

    public function mount(Folder $folder)
    {
        // Authorize: User can only view their own folders
        if ($folder->user_id !== auth()->id()) {
            abort(403);
        }

        $this->folder = $folder;
    }

    #[On('projectChanged')]
    public function refreshProjects()
    {
        unset($this->projects);
        unset($this->sharedProjects);
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
        // Get owned projects in THIS folder for THIS user
        $query = $this->folder->projectAssignments()
            ->wherePivot('user_id', auth()->id())
            ->where('projects.user_id', auth()->id())
            ->with(['owner']);

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

        $projects = $query->get();

        return [
            'progress'  => $projects->where('completed', false)->values(),
            'completed' => $projects->where('completed', true)->values(),
        ];
    }

    #[Computed]
    public function sharedProjects()
    {
        // Get shared projects (not owned by user) in THIS folder for THIS user
        $query = $this->folder->projectAssignments()
            ->wherePivot('user_id', auth()->id())
            ->where('projects.user_id', '!=', auth()->id())
            ->with(['owner']);

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
        return view('livewire.folders.show-projects-on-folders', [
            'projects' => $this->projects,
            'sharedProjects' => $this->sharedProjects,
        ]);
    }
}