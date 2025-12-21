<?php

namespace App\Livewire\Albums;

use App\Models\Album;
use App\Models\Project;
use Livewire\Attributes\On;
use Livewire\Attributes\Computed;
use LivewireUI\Modal\ModalComponent;

class ShowAlbumsOnProject extends ModalComponent
{
    public int $projectId;
    public Project $project;
    public string $search = '';
    public string $sortBy = 'date-desc';

    public function mount(int $projectId)
    {
        $this->projectId = $projectId;
        
        // Load project and verify user has access
        $this->project = Project::where(function($query) {
            $query->where('user_id', auth()->id())
                  ->orWhereHas('users', function($q) {
                      $q->where('user_id', auth()->id());
                  });
        })->findOrFail($projectId);
    }

    #[On('albumChanged')]
    public function refreshAlbums()
    {
        unset($this->albums);
    }

    #[Computed]
    public function albums()
    {
        $query = Album::query()
            ->where('project_id', $this->projectId)
            ->with(['project']);

        // Search
        if ($this->search !== '') {
            $query->where(function ($q) {
                $q->where('title', 'like', "%{$this->search}%")
                  ->orWhere('description', 'like', "%{$this->search}%");
            });
        }

        // Sorting
        match ($this->sortBy) {
            'date-asc'  => $query->orderBy('created_at', 'asc'),
            'date-desc' => $query->orderBy('created_at', 'desc'),
            'name-asc'  => $query->orderBy('title', 'asc'),
            'name-desc' => $query->orderBy('title', 'desc'),
            default     => $query->orderBy('created_at', 'desc'),
        };

        return $query->get();
    }

    /**
     * Check if current user can edit albums (owner or editor)
     */
    public function canEditAlbums(): bool
    {
        if ($this->project->user_id === auth()->id()) {
            return true;
        }

        $userRole = $this->project->users()
            ->where('user_id', auth()->id())
            ->first()
            ?->pivot
            ?->role_id;

        return in_array($userRole, [1, 2]); // admin or editor
    }

    public function render()
    {
        return view('livewire.albums.show-albums-on-project', [
            'albums' => $this->albums,
            'canEdit' => $this->canEditAlbums(),
        ]);
    }
}