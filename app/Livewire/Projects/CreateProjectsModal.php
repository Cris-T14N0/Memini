<?php

namespace App\Livewire\Projects;

use App\Models\Project;
use Exception;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class CreateProjectsModal extends ModalComponent
{
    use WithFileUploads;

    public string $name = '';
    public string $description = '';
    public $cover_image;
    public ?int $folderId = null;

    public function mount(?int $folderId = null): void
    {
        $this->folderId = $folderId;
        
        // Debug log to verify the folder ID is received
        Log::info('CreateProjectsModal mounted with folderId: ' . ($folderId ?? 'null'));
    }

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

    public function createProject(): void
    {
        $this->validate();

        try {
            $userId = Auth::id();

            // Hash the image name first
            $filename = $this->cover_image->hashName();

            // Store in storage/app/public/{user_id}/projects/
            $path = $this->cover_image->storeAs("{$userId}/projects", $filename, 'public');
            
            Log::info('Image stored at path: ' . $path);
            Log::info('Creating project with folderId: ' . ($this->folderId ?? 'null'));

            // Create project with the correct path from the start
            $project = Project::create([
                'user_id' => $userId,
                'folder_id' => $this->folderId, // This can be null
                'name' => $this->name,
                'description' => $this->description,
                'cover_image_path' => $path,
                'completed' => false,
            ]);

            Log::info('Project created with ID: ' . $project->id);
            Log::info('Project folder_id: ' . ($project->folder_id ?? 'null'));
            Log::info('Path in DB: ' . $project->cover_image_path);

            session()->flash('success', 'Projeto criado com sucesso!');

            // Dispatch events to refresh the dashboard and folder view
            $this->dispatch('projectChanged');
            
            if ($this->folderId) {
                $this->dispatch('folderChanged');
            }

            $this->closeModal();
        } catch (Exception $e) {
            Log::error('Project creation failed: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            
            session()->flash('error', 'Erro ao criar projeto: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.projects.create-projects-modal');
    }

    public static function modalMaxWidth(): string
    {
        return '2xl';
    }
}