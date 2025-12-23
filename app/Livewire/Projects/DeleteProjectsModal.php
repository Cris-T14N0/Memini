<?php

namespace App\Livewire\Projects;

use App\Models\Project;
use Exception;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

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
        $project = Project::with(['albums.media'])->findOrFail($this->projectId);

        // Double check ownership
        if ($project->user_id !== auth()->id()) {
            $this->closeModal();
            session()->flash('error', 'Não tens permissão para eliminar este projeto.');
            return;
        }

        try {
            $userId = $project->user_id;

            // 1. Delete all media files from all albums
            foreach ($project->albums as $album) {
                foreach ($album->media as $media) {
                    // Delete media file from storage
                    if ($media->file_path && Storage::disk('public')->exists($media->file_path)) {
                        Storage::disk('public')->delete($media->file_path);
                        Log::info("Deleted media file: {$media->file_path}");
                    }
                }

                // Delete album folder (storage/app/public/{user_id}/albums/{album_id}/)
                $albumFolder = "{$userId}/albums/{$album->id}";
                if (Storage::disk('public')->exists($albumFolder)) {
                    Storage::disk('public')->deleteDirectory($albumFolder);
                    Log::info("Deleted album folder: {$albumFolder}");
                }

                // Delete album cover image
                if ($album->cover_image_path && Storage::disk('public')->exists($album->cover_image_path)) {
                    Storage::disk('public')->delete($album->cover_image_path);
                    Log::info("Deleted album cover: {$album->cover_image_path}");
                }
            }

            // 2. Delete project cover image
            if ($project->cover_image_path && Storage::disk('public')->exists($project->cover_image_path)) {
                Storage::disk('public')->delete($project->cover_image_path);
                Log::info("Deleted project cover: {$project->cover_image_path}");
            }

            // 3. Clean up empty directories
            // Delete albums folder if empty
            $albumsFolder = "{$userId}/albums";
            if (Storage::disk('public')->exists($albumsFolder)) {
                $files = Storage::disk('public')->allFiles($albumsFolder);
                $directories = Storage::disk('public')->directories($albumsFolder);
                
                if (empty($files) && empty($directories)) {
                    Storage::disk('public')->deleteDirectory($albumsFolder);
                    Log::info("Deleted empty albums folder: {$albumsFolder}");
                }
            }

            // Delete projects folder if empty
            $projectsFolder = "{$userId}/projects";
            if (Storage::disk('public')->exists($projectsFolder)) {
                $files = Storage::disk('public')->files($projectsFolder);
                
                if (empty($files)) {
                    Storage::disk('public')->deleteDirectory($projectsFolder);
                    Log::info("Deleted empty projects folder: {$projectsFolder}");
                }
            }

            // 4. Delete the project from database (will cascade delete albums and media records)
            $project->delete();

            Log::info("Project deleted successfully: ID {$this->projectId}");

            session()->flash('success', 'Projeto e todos os seus ficheiros foram eliminados com sucesso!');
            $this->dispatch('projectChanged');
            $this->dispatch('folderChanged');
            $this->closeModal();

        } catch (Exception $e)
        {
            Log::error('Project deletion failed: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            session()->flash('error', 'Erro ao eliminar projeto: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.projects.delete-projects-modal');
    }
}