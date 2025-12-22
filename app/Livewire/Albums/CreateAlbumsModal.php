<?php

namespace App\Livewire\Albums;

use App\Models\Album;
use App\Models\Project;
use Exception;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class CreateAlbumsModal extends ModalComponent
{
    use WithFileUploads;

    public int $projectId;
    public Project $project;
    public string $title = '';
    public string $description = '';
    public $cover_image;

    public function mount(int $projectId): void
    {
        $this->projectId = $projectId;
        
        // Load project and verify user has access (owner or member)
        $this->project = Project::where(function($query) {
            $query->where('user_id', auth()->id())
                  ->orWhereHas('users', function($q) {
                      $q->where('user_id', auth()->id());
                  });
        })->findOrFail($projectId);

        // Check if user can create albums (must be owner or editor - role_id 2 ONLY)
        if ($this->project->user_id !== auth()->id()) {
            $userRole = $this->project->users()
                ->where('user_id', auth()->id())
                ->first()
                ?->pivot
                ?->role_id;

            // Only Editor (role_id = 2) can create, not Viewer (role_id = 1)
            if ($userRole !== 2) {
                session()->flash('error', 'Não tens permissão para criar álbuns neste projeto.');
                $this->closeModal();
            }
        }
    }

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'required|string|max:5000',
        'cover_image' => 'required|image|max:10240',
    ];

    protected $messages = [
        'title.required' => 'O título do álbum é obrigatório.',
        'title.max' => 'O título não pode exceder 255 caracteres.',
        'description.required' => 'A descrição do álbum é obrigatória.',
        'description.max' => 'A descrição não pode exceder 5000 caracteres.',
        'cover_image.required' => 'A imagem de capa é obrigatória.',
        'cover_image.image' => 'O ficheiro deve ser uma imagem.',
        'cover_image.max' => 'A imagem não pode exceder 10MB.',
    ];

    public function createAlbum(): void
    {
        $this->validate();

        try {
            // Use project owner's ID for storage
            $ownerId = $this->project->user_id;

            // Hash the image name
            $filename = $this->cover_image->hashName();
            
            // Store in storage/app/public/{owner_id}/albums/
            $path = $this->cover_image->storeAs("{$ownerId}/albums", $filename, 'public');

            Log::info('Album cover stored at path: ' . $path);

            // Create album
            $album = Album::create([
                'project_id' => $this->projectId,
                'title' => $this->title,
                'description' => $this->description,
                'cover_image_path' => $path,
            ]);

            Log::info('Album created with ID: ' . $album->id);

            session()->flash('message', 'Álbum criado com sucesso!');
            $this->dispatch('albumChanged');
            $this->closeModal();

        } catch (Exception $e) {
            Log::error('Album creation failed: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            session()->flash('error', 'Erro ao criar álbum: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.albums.create-albums-modal');
    }

    public static function modalMaxWidth(): string
    {
        return '2xl';
    }
}