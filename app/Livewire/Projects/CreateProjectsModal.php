<?php

namespace App\Livewire\Projects;

use App\Models\Project;
use Exception;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Log;

class CreateProjectsModal extends ModalComponent
{
    use WithFileUploads;

    public $name = '';
    public $description = '';
    public $cover_image;

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'required|string|max:5000',
        'cover_image' => 'required|image|max:10240', // 10MB max
    ];

    protected $messages = [
        'name.required' => 'Project name is required.',
        'name.max' => 'Project name cannot exceed 255 characters.',
        'description.required' => 'Project description is required.',
        'description.max' => 'Description cannot exceed 5000 characters.',
        'cover_image.required' => 'Cover image is required.',
        'cover_image.image' => 'File must be an image.',
        'cover_image.max' => 'Image size cannot exceed 10MB.',
    ];

    public function createProject()
    {
        $this->validate();

        try
        {
            $userId = Auth::id();

            // Hash the image name first
            $filename = $this->cover_image->hashName();
            
            // Store in storage/app/public/{user_id}/projects/
            $path = $this->cover_image->storeAs("{$userId}/projects", $filename, 'public');
            
            Log::info('Image stored at path: ' . $path);

            // Create project with the correct path from the start
            $project = Project::create([
                'user_id' => $userId,
                'name' => $this->name,
                'description' => $this->description,
                'cover_image_path' => $path,
                'completed' => false,
            ]);

            Log::info('Project created with ID: ' . $project->id);
            Log::info('Path in DB: ' . $project->cover_image_path);

            session()->flash('success', 'Projeto criado com sucesso!');
            
            // Dispatch event to refresh the dashboard
            $this->dispatch('projectChanged');
            $this->closeModal();

        }
        catch (Exception $e)
        {
            Log::error('Project creation failed: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            session()->flash('error', 'Erro ao criar projeto: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.projects.create-projects-modal');
    }
}
