<?php

namespace App\Livewire\Projects;


use App\Models\Project;
use Exception;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Log;

class EditProjectsModal extends ModalComponent
{
    use WithFileUploads;

    public $projectId;
    public $name = '';
    public $description = '';
    public $cover_image;
    public $current_cover_image_path;
    public $completed = false;

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'required|string|max:5000',
        'cover_image' => 'nullable|image|max:10240', // Optional on edit
    ];

    protected $messages = [
        'name.required' => 'Nome do projeto é obrigatório.',
        'name.max' => 'Nome não pode exceder 255 caracteres.',
        'description.required' => 'Descrição do projeto é obrigatória.',
        'description.max' => 'Descrição não pode exceder 5000 caracteres.',
        'cover_image.image' => 'O ficheiro deve ser uma imagem.',
        'cover_image.max' => 'Imagem não pode exceder 10MB.',
    ];

    public function mount($projectId)
    {
        $project = Project::findOrFail($projectId);
        
        // Check if user owns the project
        if ($project->user_id !== auth()->id()) {
            $this->closeModal();
            session()->flash('error', 'Não tens permissão para editar este projeto.');
            return;
        }

        $this->projectId = $project->id;
        $this->name = $project->name;
        $this->description = $project->description;
        $this->current_cover_image_path = $project->cover_image_path;
        $this->completed = $project->completed;
    }

    public function updateProject()
    {
        $this->validate();

        try {
            $project = Project::findOrFail($this->projectId);

            // Double check ownership
            if ($project->user_id !== auth()->id()) {
                session()->flash('error', 'Não tens permissão para editar este projeto.');
                $this->closeModal();
                return;
            }

            $updateData = [
                'name' => $this->name,
                'description' => $this->description,
                'completed' => $this->completed,
            ];

            // If new cover image uploaded
            if ($this->cover_image) {
                $userId = Auth::id();

                // Delete old cover image
                if ($project->cover_image_path && Storage::disk('public')->exists($project->cover_image_path)) {
                    Storage::disk('public')->delete($project->cover_image_path);
                }

                // Upload new image
                $filename = $this->cover_image->hashName();
                $path = $this->cover_image->storeAs("{$userId}/projects", $filename, 'public');
                
                $updateData['cover_image_path'] = $path;
            }

            // Update project
            $project->update($updateData);

            session()->flash('success', 'Projeto atualizado com sucesso!');
            
            $this->dispatch('projectChanged');
            $this->closeModal();

        } catch (Exception $e) {
            Log::error('Project update failed: ' . $e->getMessage());
            session()->flash('error', 'Erro ao atualizar projeto: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.projects.edit-projects-modal');
    }
}