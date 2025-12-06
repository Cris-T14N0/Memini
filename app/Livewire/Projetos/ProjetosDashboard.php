<?php

namespace App\Livewire\Projetos;

use App\Models\Project;
use Livewire\Component;

class ProjetosDashboard extends Component
{
    public string $search = '';
    public string $sortBy = 'date-desc';
    public bool $showProgress = true;
    public bool $showCompleted = true;

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
    public function getProjectsProperty()
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
        return view('livewire.projetos.projetos-dashboard', [
            'projects' => $this->projects,
        ]);
    }
}
