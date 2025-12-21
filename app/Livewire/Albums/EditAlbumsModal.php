<?php

namespace App\Livewire\Albums;

use App\Models\Album;
use Exception;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class EditAlbumsModal extends ModalComponent
{
    use WithFileUploads;

    public int $albumId;
    public Album $album;
    public string $title = '';
    public string $description = '';
    public $cover_image;
    public ?string $existing_cover = null;

    public function mount(int $albumId): void
    {
        $this->albumId = $albumId;
        
        // Load album with project relationship
        $this->album = Album::with('project')->findOrFail($albumId);
        
        // Check if user can edit (must be project owner or editor)
        $project = $this->album->project;
        
        if ($project->user_id !== auth()->id()) {
            $userRole = $project->users()
                ->where('user_id', auth()->id())
                ->first()
                ?->pivot
                ?->role_id;

            if (!in_array($userRole, [1, 2])) { // 1 = admin, 2 = editor
                session()->flash('error', 'Não tens permissão para editar este álbum.');
                $this->closeModal();
            }
        }

        // Populate form
        $this->title = $this->album->title;
        $this->description = $this->album->description;
        $this->existing_cover = $this->album->cover_image_path;
    }

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'required|string|max:5000',
        'cover_image' => 'nullable|image|max:10240',
    ];

    protected $messages = [
        'title.required' => 'O título do álbum é obrigatório.',
        'title.max' => 'O título não pode exceder 255 caracteres.',
        'description.required' => 'A descrição do álbum é obrigatória.',
        'description.max' => 'A descrição não pode exceder 5000 caracteres.',
        'cover_image.image' => 'O ficheiro deve ser uma imagem.',
        'cover_image.max' => 'A imagem não pode exceder 10MB.',
    ];

    public function updateAlbum(): void
    {
        $this->validate();

        try {
            $data = [
                'title' => $this->title,
                'description' => $this->description,
            ];

            // Handle new cover image
            if ($this->cover_image) {
                $userId = Auth::id();
                
                // Delete old image if exists
                if ($this->existing_cover) {
                    Storage::disk('public')->delete($this->existing_cover);
                }
                
                // Store new image
                $filename = $this->cover_image->hashName();
                $path = $this->cover_image->storeAs("{$userId}/albums", $filename, 'public');
                
                $data['cover_image_path'] = $path;
                Log::info('New album cover stored at path: ' . $path);
            }

            $this->album->update($data);

            Log::info('Album updated with ID: ' . $this->album->id);

            session()->flash('message', 'Álbum atualizado com sucesso!');
            
            $this->dispatch('albumChanged');
            $this->closeModal();
            
        } catch (Exception $e) {
            Log::error('Album update failed: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            session()->flash('error', 'Erro ao atualizar álbum: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.albums.edit-albums-modal');
    }

    public static function modalMaxWidth(): string
    {
        return '2xl';
    }
}